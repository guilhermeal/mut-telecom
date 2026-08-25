<?php
/**
 * Envio de e-mail via SMTP autenticado (PHPMailer), usado pelo formulário
 * de contato. Credenciais vêm de variáveis de ambiente (.env) — nunca
 * hardcoded no código-fonte.
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/env.php';

use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Envia a mensagem do formulário de contato para a caixa institucional da
 * MUT, com o e-mail do visitante como Reply-To (responder o e-mail vai
 * direto para o cliente, mesmo o remetente técnico sendo outra conta).
 *
 * @param array{nome: string, tel: string, cidade: string, assunto: string, mensagem: string} $dados
 * @throws RuntimeException se a configuração SMTP estiver incompleta ou o envio falhar.
 */
function mut_enviar_email_contato(array $dados, ?string $emailVisitante): void
{
    $host = mut_env('MAIL_SMTP_HOST');
    $port = (int) (mut_env('MAIL_SMTP_PORT', '587'));
    $secure = mut_env('MAIL_SMTP_SECURE', 'tls');
    $username = mut_env('MAIL_SMTP_USERNAME');
    $password = mut_env('MAIL_SMTP_PASSWORD');
    $fromAddress = mut_env('MAIL_FROM_ADDRESS');
    $fromName = mut_env('MAIL_FROM_NAME', 'MUT Telecom — Site');
    $toAddress = mut_env('MAIL_TO_ADDRESS', 'contato@muttelecom.com.br');
    $toName = mut_env('MAIL_TO_NAME', 'MUT Telecom');

    if (!$host || !$username || !$password || !$fromAddress) {
        // Configuração ausente (.env não preenchido) — erro operacional, não
        // um problema do formulário/usuário. Fica só no log do servidor.
        throw new RuntimeException('Configuração SMTP incompleta (.env). Veja .env.example.');
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = $secure === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $port;
        $mail->CharSet = PHPMailer::CHARSET_UTF8;

        $mail->setFrom($fromAddress, $fromName);
        $mail->addAddress($toAddress, $toName);

        if ($emailVisitante && filter_var($emailVisitante, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($emailVisitante, $dados['nome']);
        }

        $mail->Subject = 'Contato pelo site — ' . $dados['assunto'] . ' — ' . $dados['nome'];

        $corpoTexto = "Nova mensagem recebida pelo formulário de contato do site.\n\n"
            . "Nome: {$dados['nome']}\n"
            . "Telefone/WhatsApp: {$dados['tel']}\n"
            . "Cidade: {$dados['cidade']}\n"
            . "Assunto: {$dados['assunto']}\n\n"
            . "Mensagem:\n{$dados['mensagem']}\n";

        $mail->isHTML(false);
        $mail->Body = $corpoTexto;

        $mail->send();
    } catch (PHPMailerException $e) {
        throw new RuntimeException('Falha ao enviar e-mail: ' . $mail->ErrorInfo, previous: $e);
    }
}
