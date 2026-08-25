# MUT Telecom

Site institucional da MUT Telecom — operadora regional de fibra óptica em Alagoas. Feito pra carregar rápido, funcionar sem enrolação e ser fácil de manter.

## Sobre

PHP puro, servidor a servidor, sem framework e sem build step. Cada página é um arquivo `.php` na raiz; o que se repete — cabeçalho, rodapé, dados de planos, FAQ, links de WhatsApp — vive em `includes/`. Estilo em `assets/css/style.css`, interações em `assets/js/main.js`, ambos sem dependências externas.

Tema claro/escuro, formulários com validação client-side, URLs limpas e SEO local já configurados.

## Rodando localmente

```bash
php -S localhost:8000
```

Sem `npm`, sem passo de build. A única dependência do projeto é o PHPMailer (usado pelo formulário de contato), já commitado em `vendor/` — não é preciso rodar `composer install` para o site funcionar.

Para o formulário de contato enviar e-mails de verdade, copie `.env.example` para `.env` e preencha com as credenciais SMTP reais (veja [Formulário de contato](#formulário-de-contato) abaixo).

## Estrutura

```
├── index.php, planos.php, ...   → uma página, um arquivo
├── api/
│   └── contato.php              → endpoint do formulário de contato (POST, JSON)
├── includes/
│   ├── header.php               → <head>, navbar, drawer mobile
│   ├── footer.php               → rodapé, WhatsApp float, cookie banner
│   ├── data.php                 → planos, FAQ, cidades, helpers compartilhados
│   ├── security.php             → CSRF, honeypot, rate limiting, sanitização
│   ├── mailer.php                → envio de e-mail via SMTP (PHPMailer)
│   └── env.php                  → leitor de .env
├── storage/                     → rate-limit.json (git-ignored, bloqueado por .htaccess)
├── vendor/                      → PHPMailer (Composer), commitado — não precisa de composer install
└── assets/
    ├── css/style.css
    ├── js/main.js
    └── favicon/
```

## Formulário de contato

O formulário em `contato.php` envia e-mail real via SMTP autenticado (PHPMailer) para `contato@muttelecom.com.br`, com proteções contra spam/abuso:

- **CSRF**: token de sessão validado a cada envio.
- **Honeypot**: campo invisível (`empresa`) que só bots preenchem — se vier preenchido, a resposta finge sucesso mas nenhum e-mail é enviado.
- **Rate limiting**: até 3 envios por IP a cada 10 minutos, sem banco de dados (`storage/rate-limit.json`).
- **Sanitização**: remoção de quebras de linha nos campos de texto simples (proteção contra header injection em e-mail), além do escaping já feito pelo PHPMailer.

Para funcionar, crie um `.env` na raiz (copie de `.env.example`) com host/porta/usuário/senha SMTP fornecidos pela hospedagem. Sem essas variáveis preenchidas, o formulário responde com erro amigável ("não foi possível enviar agora") sem expor detalhes técnicos — o erro real vai para o log do servidor (`error_log`).

## Versionamento

Histórico de mudanças em [`CHANGELOG.md`](./CHANGELOG.md). Cada versão marcada com `git tag` corresponde a um ponto que foi publicado.

---

Desenvolvido por **Guilherme Almeida** — [guilhermeal.com.br](https://www.guilhermeal.com.br)
