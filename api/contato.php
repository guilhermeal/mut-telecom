<?php
/**
 * Endpoint do formulário de contato — recebe POST via fetch (assets/js/main.js,
 * initContactForm), valida e envia e-mail real para contato@muttelecom.com.br
 * via SMTP autenticado (includes/mailer.php).
 *
 * Camadas de proteção: CSRF, honeypot anti-bot, rate limiting por IP,
 * sanitização contra header injection. Ver includes/security.php.
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/mailer.php';

header('Content-Type: application/json; charset=utf-8');
// Este endpoint só faz sentido chamado pelo próprio site via fetch — não é
// uma API pública para terceiros consumirem.
header('X-Content-Type-Options: nosniff');

/**
 * Responde em JSON e encerra a execução.
 */
function mut_api_responder(int $statusCode, bool $ok, string $message, array $extra = []): void
{
    http_response_code($statusCode);
    echo json_encode(['ok' => $ok, 'message' => $message] + $extra, JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    mut_api_responder(405, false, 'Método não permitido.');
}

// CSRF: token de sessão precisa bater com o enviado no formulário.
if (!mut_csrf_valido($_POST['csrf_token'] ?? null)) {
    mut_api_responder(403, false, 'Sessão expirada. Recarregue a página e tente novamente.');
}

// Honeypot: campo invisível que só bots costumam preencher.
if (($_POST['empresa'] ?? '') !== '') {
    // Resposta "de sucesso" propositalmente — não dá pista ao bot de que foi
    // filtrado, mas nenhum e-mail é de fato enviado.
    mut_api_responder(200, true, 'Mensagem enviada!');
}

// Rate limiting por IP: evita abuso/spam por volume, sem precisar de banco.
$ip = mut_client_ip();
if (!mut_rate_limit_ok('contato:' . $ip, maxTentativas: 3, janelaSegundos: 600)) {
    mut_api_responder(429, false, 'Muitas tentativas em pouco tempo. Aguarde alguns minutos e tente novamente, ou fale pelo WhatsApp.');
}

// Validação e sanitização dos campos (mesmas regras do client-side, reforçadas no servidor).
$resultado = mut_validar_contato($_POST);
if (!$resultado['ok']) {
    mut_api_responder(422, false, 'Confira os campos destacados e tente novamente.', ['errors' => $resultado['errors']]);
}

$emailVisitante = trim((string) ($_POST['email'] ?? ''));
$emailVisitante = $emailVisitante !== '' && filter_var($emailVisitante, FILTER_VALIDATE_EMAIL) ? $emailVisitante : null;

try {
    mut_enviar_email_contato($resultado['data'], $emailVisitante);
} catch (RuntimeException $e) {
    // Log local para diagnóstico — nunca expor detalhes de SMTP/erro interno ao cliente.
    error_log('[mut-contato] falha ao enviar e-mail: ' . $e->getMessage());
    mut_api_responder(502, false, 'Não foi possível enviar sua mensagem agora. Tente novamente em instantes ou fale pelo WhatsApp.');
}

mut_api_responder(200, true, 'Mensagem enviada!');
