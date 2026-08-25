<?php
/**
 * Leitor mínimo de arquivo .env (formato CHAVE=valor, uma por linha).
 * Não usa dependência externa — o projeto já baixa o PHPMailer via Composer,
 * mas ler algumas linhas de config não justifica outra lib.
 *
 * As credenciais reais ficam em .env (git-ignored); .env.example documenta
 * as chaves esperadas sem valores sensíveis.
 */

declare(strict_types=1);

/**
 * Carrega o .env (se existir) para variáveis de ambiente do processo,
 * sem sobrescrever variáveis já definidas pelo servidor/hosting.
 */
function mut_load_env(): void
{
    static $loaded = false;
    if ($loaded) {
        return;
    }
    $loaded = true;

    $path = __DIR__ . '/../.env';
    if (!is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (!str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        // Remove aspas simples/duplas envolvendo o valor, se houver.
        if (strlen($value) >= 2 && (
            ($value[0] === '"' && str_ends_with($value, '"'))
            || ($value[0] === "'" && str_ends_with($value, "'"))
        )) {
            $value = substr($value, 1, -1);
        }
        if ($key === '' || getenv($key) !== false) {
            continue;
        }
        putenv($key . '=' . $value);
    }
}

/**
 * Lê uma variável de ambiente (do .env ou do próprio servidor), com valor
 * padrão opcional.
 */
function mut_env(string $key, ?string $default = null): ?string
{
    mut_load_env();
    $value = getenv($key);
    return $value === false ? $default : $value;
}
