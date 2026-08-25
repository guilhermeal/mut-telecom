<?php
/**
 * Camadas de proteção do formulário de contato: token CSRF, honeypot
 * anti-bot, rate limiting por IP (sem banco de dados) e sanitização de
 * campos contra header injection em e-mail.
 */

declare(strict_types=1);

/**
 * Gera (ou reaproveita) o token CSRF da sessão atual e retorna seu valor,
 * pronto para ser embutido em um campo hidden do formulário.
 */
function mut_csrf_token(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['mut_csrf_token'])) {
        $_SESSION['mut_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['mut_csrf_token'];
}

/**
 * Valida um token CSRF recebido do cliente contra o da sessão, em tempo
 * constante (evita timing attack).
 */
function mut_csrf_valido(?string $token): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $esperado = $_SESSION['mut_csrf_token'] ?? null;
    if (!is_string($esperado) || !is_string($token) || $token === '') {
        return false;
    }
    return hash_equals($esperado, $token);
}

/**
 * Retorna o IP do visitante, considerando cabeçalhos de proxy comum
 * (Cloudflare/hosting compartilhado) com fallback para REMOTE_ADDR.
 * Usado só para throttling — não é uma fonte de identidade confiável,
 * então nunca deve ser usado para decisões de segurança além de limitar
 * volume de envios.
 */
function mut_client_ip(): string
{
    $candidatos = [
        $_SERVER['HTTP_CF_CONNECTING_IP'] ?? null,
        $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null,
        $_SERVER['REMOTE_ADDR'] ?? null,
    ];
    foreach ($candidatos as $valor) {
        if (!is_string($valor) || $valor === '') {
            continue;
        }
        // X-Forwarded-For pode vir como lista "ip1, ip2, ip3" — usa o primeiro.
        $ip = trim(explode(',', $valor)[0]);
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
    }
    return '0.0.0.0';
}

/**
 * Limite simples de envios por IP, persistido em storage/rate-limit.json
 * (fora do webroot público — bloqueado por .htaccess de qualquer forma).
 * Sem banco de dados: guarda só os timestamps recentes de cada IP.
 *
 * @return bool true se o envio pode prosseguir, false se o limite foi excedido.
 */
function mut_rate_limit_ok(string $chave, int $maxTentativas = 3, int $janelaSegundos = 600): bool
{
    $arquivo = __DIR__ . '/../storage/rate-limit.json';
    $agora = time();

    $dados = [];
    if (is_readable($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        $decodificado = $conteudo !== false ? json_decode($conteudo, true) : null;
        if (is_array($decodificado)) {
            $dados = $decodificado;
        }
    }

    // Limpa entradas de todos os IPs fora da janela, para o arquivo não crescer indefinidamente.
    foreach ($dados as $ip => $timestamps) {
        $dados[$ip] = array_values(array_filter(
            is_array($timestamps) ? $timestamps : [],
            static fn ($t): bool => is_int($t) && ($agora - $t) < $janelaSegundos
        ));
        if ($dados[$ip] === []) {
            unset($dados[$ip]);
        }
    }

    $tentativasAtuais = $dados[$chave] ?? [];
    if (count($tentativasAtuais) >= $maxTentativas) {
        // Ainda persiste a limpeza acima, mas não conta uma nova tentativa.
        @file_put_contents($arquivo, json_encode($dados), LOCK_EX);
        return false;
    }

    $tentativasAtuais[] = $agora;
    $dados[$chave] = $tentativasAtuais;
    @file_put_contents($arquivo, json_encode($dados), LOCK_EX);
    return true;
}

/**
 * Remove quebras de linha (CR/LF) de um valor — proteção contra header
 * injection em e-mail (ex.: alguém tentando injetar "Bcc:" via campo nome).
 * O PHPMailer já sanitiza isso internamente, mas aplicamos na entrada
 * também, em defesa de profundidade e para não propagar o valor "sujo"
 * para logs/outras partes do sistema.
 */
function mut_sanitize_single_line(string $value): string
{
    $value = str_replace(["\r", "\n"], ' ', $value);
    return trim($value);
}

/**
 * Valida e normaliza os campos do formulário de contato.
 *
 * @param array<string, mixed> $input
 * @return array{ok: bool, errors: array<string, string>, data: array<string, string>}
 */
function mut_validar_contato(array $input): array
{
    $errors = [];

    $nome = mut_sanitize_single_line((string) ($input['nome'] ?? ''));
    $tel = mut_sanitize_single_line((string) ($input['tel'] ?? ''));
    $cidade = mut_sanitize_single_line((string) ($input['cidade'] ?? ''));
    $assunto = mut_sanitize_single_line((string) ($input['assunto'] ?? ''));
    $mensagem = trim(str_replace("\r\n", "\n", (string) ($input['mensagem'] ?? '')));

    if ($nome === '' || mb_strlen($nome) < 2) {
        $errors['nome'] = 'Informe seu nome.';
    } elseif (mb_strlen($nome) > 150) {
        $errors['nome'] = 'Nome muito longo.';
    }

    $telDigits = preg_replace('/\D/', '', $tel) ?? '';
    if (strlen($telDigits) < 10 || strlen($telDigits) > 11) {
        $errors['tel'] = 'Telefone/WhatsApp inválido.';
    }

    $cidadesValidas = ['Murici', 'Messias', 'Rio Largo', 'Branquinha'];
    if (!in_array($cidade, $cidadesValidas, true)) {
        $errors['cidade'] = 'Selecione sua cidade.';
    }

    if (mb_strlen($mensagem) < 5) {
        $errors['mensagem'] = 'Escreva uma mensagem.';
    } elseif (mb_strlen($mensagem) > 4000) {
        $errors['mensagem'] = 'Mensagem muito longa.';
    }

    if ($assunto === '' || mb_strlen($assunto) > 100) {
        $assunto = 'Outro assunto';
    }

    return [
        'ok' => $errors === [],
        'errors' => $errors,
        'data' => [
            'nome' => $nome,
            'tel' => $tel,
            'cidade' => $cidade,
            'assunto' => $assunto,
            'mensagem' => $mensagem,
        ],
    ];
}
