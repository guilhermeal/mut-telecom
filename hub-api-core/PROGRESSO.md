# Progresso — Integração HubSoft (BFF Laravel)

> Este arquivo documenta, fase por fase, o que já foi feito neste projeto Laravel.
> Leia-o no início de qualquer conversa nova sobre este assunto para retomar o
> contexto sem precisar reexplicar tudo. O plano completo (contexto, decisões
> fechadas, arquitetura) mora fora deste repo, no histórico do Claude Code.

## Visão geral

Este é o **BFF (Backend For Frontend)** que fica entre o site institucional
PHP puro da MUT Telecom e a API real da HubSoft (ERP do provedor). Roda em
`/hub-api` (subpasta pública) enquanto o código real do Laravel mora em
`hub-api-core/` (fora do nome exposto na URL). Ninguém no navegador fala
direto com a HubSoft — tudo passa por aqui, com credenciais só no `.env`
deste projeto.

Escopo é **estritamente read-only**: nunca escrevemos, confirmamos pagamento
ou alteramos cadastro. Só consultamos boletos/faturas e dados básicos de
plano.

## Status por fase

- [x] **Fase 0** — Preparação / estrutura de pastas (`hub-api` público + `hub-api-core` real)
- [x] **Fase 1** — Scaffolding Laravel + "ponte" funcionando localmente via Apache
- [x] **Fase 2** — Service layer (`HubSoftClient`): oAuth de aplicação, cache de token, consulta de faturas
- [x] **Fase 3** — Endpoint público "2ª via de boleto" (sem login), com anti-enumeração e proteção de Origin
- [x] **Fase 4** — Área do Cliente (login + sessão + faturas + plano + proxy de PDF) — concluída e validada por completo
- [x] **Fase 5** — Integração com o frontend PHP puro — validada pelo usuário em produção (26/08/2026): saudação com nome, próximo vencimento, login completo, botões de copiar código/PIX, tudo confirmado funcionando em `https://muttelecom.com.br`
- [ ] **Fase 6** — Hardening final (checklist de produção) — retomar aqui na próxima sessão
- [x] **Deploy real (primeira publicação)** — feito em 26/08/2026, `POST /hub-api/api/boletos/consultar` confirmado funcionando em `https://muttelecom.com.br` (ver "Deploy real — histórico" abaixo)

## Como rodar localmente

```bash
# a partir de /var/www/html/mut, acessível via Apache em:
http://localhost/mut/hub-api/ping   # smoke test → {"ok":true,"app":"hub-api-core"}
```

Não usa `php artisan serve` — depende do Apache local servindo a pasta
`/var/www/html/mut/hub-api/` (a "ponte") que aponta para
`hub-api-core/public/index.php` com paths ajustados.

## Rotas existentes

### Públicas (sem login) — `routes/api.php`
- `POST /hub-api/api/boletos/consultar` — recebe `cpf_cnpj`, retorna só
  faturas **em aberto** (nunca PDF, nunca nome/CPF do cliente), do início do
  ano corrente até o fim do mês seguinte ao atual (range fixo, sem seletor
  nesta tela). Resposta idêntica para "CPF não é cliente" e "cliente em
  dia" (anti-enumeração). Cada boleto vem com `pagamento_presencial` — se
  `true`, `linha_digitavel`/`codigo_barras`/`pix_copia_cola` vêm `null` (ver
  "Forma de cobrança presencial" abaixo). Rate limit: 5 tentativas / 10 min
  por IP.

### Área do Cliente (login + sessão) — `routes/web.php`
- `POST /hub-api/cliente/login` — CPF+senha reais, valida contra a HubSoft,
  cria sessão (`cliente_cpf_cnpj`). Mensagem genérica em caso de erro
  (não revela se o CPF existe).
- `POST /hub-api/cliente/logout` — encerra sessão.
- `GET /hub-api/cliente/faturas?ano=AAAA` *(exige sessão)* — todas as
  faturas (pagas ou não) do ano informado, do CPF **da sessão**, nunca de
  um CPF vindo do request. `ano` é opcional (seletor de ano na tela),
  default = ano atual, faixa aceita `[ano_atual-1, ano_atual+1]` — fora
  disso cai silenciosamente no ano atual. Resposta inclui `"ano"` (o que
  foi de fato usado) e cada fatura vem com `pagamento_presencial` (ver
  abaixo).
- `GET /hub-api/cliente/plano` *(exige sessão)* — dados básicos do(s)
  plano(s) contratado(s), filtrados (nunca RG/telefone/senha de conexão).
- `GET /hub-api/cliente/faturas/{idFatura}/pdf?ano=AAAA` *(exige sessão)* —
  proxy do PDF da fatura: o Laravel baixa o arquivo da HubSoft server-side e
  devolve os bytes (`Content-Type: application/pdf`) ao navegador. O
  link/domínio real da HubSoft **nunca** aparece em nenhuma resposta JSON
  nem é visível ao cliente. Antes de baixar: confirma que a fatura pertence
  ao CPF da sessão (id de outro cliente ou inexistente → `404` genérico) E
  que a forma de cobrança não é presencial (→ `403` com aviso para pagar no
  escritório). `ano` precisa bater com o ano em que a fatura foi listada.

### Forma de cobrança presencial ("Banco Interno")

Alguns clientes da MUT pagam presencialmente na tesouraria (não têm boleto/
PIX bancário real — só um carnê de controle interno, forma de cobrança
`id_forma_cobranca = 4` / descrição "Banco Interno" na HubSoft). Para esses
clientes, **nunca** exibimos `linha_digitavel`, `codigo_barras`,
`pix_copia_cola` nem permitimos baixar PDF — só o valor/vencimento, com a
flag `pagamento_presencial: true` para o frontend mostrar o aviso
"dirija-se ao escritório da MUT".

**Detalhe técnico importante**: o campo `tipo_cobranca` do endpoint que já
usamos para listar faturas (`/integracao/cliente/financeiro`) é sempre
`"boleto_bancario"`, mesmo para clientes presenciais — **não é confiável**
para essa decisão. A forma de cobrança real só existe no endpoint
`/integracao/financeiro/fatura` (campo `forma_cobranca.id_forma_cobranca`).
Por isso `HubSoftClient::consultarFormasCobrancaPorCpfCnpj()` faz uma
SEGUNDA chamada a esse outro endpoint, monta um mapa `id_fatura =>
id_forma_cobranca`, e `marcarPagamentoPresencial()`/`ehPagamentoPresencial()`
cruzam esse mapa com a lista principal de faturas antes de responder.
Falha segura: fatura sem forma de cobrança encontrada no mapa é tratada
como presencial por padrão (melhor esconder demais do que expor boleto de
quem paga na tesouraria).

Todas as rotas de `/cliente/*` passam por `origem_permitida` (Origin/Referer
precisa bater com um domínio da lista em `.env: ORIGENS_PERMITIDAS`) +
`throttle:10,10`.

## Decisões de segurança já implementadas

- **Nenhuma credencial da HubSoft chega ao navegador** — fica só no `.env`
  deste projeto (`HUBSOFT_*`), nunca em resposta HTTP nem log.
- **Anti-enumeração de CPF**: respostas idênticas para "não é cliente" e
  "cliente sem pendência"; para "CPF errado" e "senha errada" no login.
- **PDF de fatura só no fluxo autenticado** — o fluxo público (sem login)
  nunca retorna link de PDF nem nome/CPF/endereço do cliente, porque o PDF
  em si carrega todos os dados pessoais.
- **Sessão sem CPF forjável** — rotas autenticadas usam sempre
  `session()->get('cliente_cpf_cnpj')`, nunca um valor vindo do corpo/query
  do request (testado via curl, injeção de CPF de terceiro não tem efeito).
- **Cookie de sessão**: `SESSION_SAME_SITE=strict` + `httponly` (confirmado
  via curl) — defesa principal contra CSRF nas rotas `/cliente/*`, que não
  usam token CSRF clássico do Laravel (chamadas via fetch externo).
  `SESSION_SECURE_COOKIE` está `false` só em desenvolvimento local (sem
  HTTPS) — **precisa virar `true` em produção**.
- **Proteção de Origin/Referer** (`VerificarOrigemPermitida`) em todas as
  rotas expostas, lista em `.env: ORIGENS_PERMITIDAS`.
- **Rate limiting** em todas as rotas (boletos: 5/10min; cliente: 10/10min).
- **Session fixation**: `session()->regenerate()` a cada login/logout.
- **Dados sensíveis nunca repassados**: a resposta bruta de
  `/integracao/cliente` da HubSoft inclui RG, telefone, data de nascimento
  e **senha de conexão em texto puro** (`servicos[].senha`) — sempre
  filtrada por um Resource dedicado antes de sair do backend
  (`PlanoClienteResource`, `BoletoPublicoResource`, `FaturaResource`).
  O mesmo vale para `/integracao/cliente/financeiro`: cada fatura crua traz
  um bloco `cliente` completo (nome completo, CPF, **4 endereços completos
  com coordenadas GPS**) e um bloco `empresa` — nenhum dos dois é repassado,
  `FaturaResource`/`BoletoPublicoResource` só extraem os campos financeiros.
- **PDF nunca exposto por link direto**: o campo `link` que a HubSoft
  retorna (URL própria dela, ex. `api.muricinet.hubsoft.com.br/pdf/...`)
  **não é enviado ao frontend em nenhum JSON** — é usado só internamente
  pelo backend para buscar o PDF via proxy (`GET
  /cliente/faturas/{id}/pdf`), que verifica posse (`buscarFaturaDoCliente`)
  antes de baixar/servir o arquivo. Testado: id de outro cliente ou
  inexistente → `404`, sem sessão → `401`.

## Pendências conhecidas (não são bugs, são follow-ups)

1. **Stack trace técnico vazando em erros** (visto no rate limit
   `ThrottleRequestsException`) — vai ser corrigido na Fase 6 com um
   exception handler central que nunca expõe detalhe técnico.
2. **Prefixo duplicado** nas rotas públicas: `/hub-api/api/boletos/consultar`
   (o `api` do Laravel + o `hub-api` da pasta) — decisão de limpar isso
   adiada, não é bug de segurança, só estética de URL.
3. **Deploy real na hospedagem** (`/home/dh_sqk6rs/muttelecom.com.br/`)
   ainda não iniciado — tudo validado só localmente até agora.
4. **Permissões `chmod 777`** em `storage/`/`bootstrap/cache/` usadas
   localmente para desenvolvimento — em produção precisa ser `775` +
   grupo correto do usuário do Apache/PHP-FPM da hospedagem (item da Fase 6).

## Fase 4.1 — Forma de cobrança presencial + seletor de ano ✅ CONCLUÍDA
(caminho "não-presencial" 100% validado nos dois fluxos; caminho "presencial" revisado por código, teste real pendente de credencial)

Adicionado depois da Fase 4 original, a partir de um requisito trazido pela
MUT: clientes com pagamento presencial (Banco Interno) nunca podem ver
boleto/PIX/PDF. Ver seção "Forma de cobrança presencial" acima para os
detalhes técnicos. Também entrou o seletor de ano na Área do Cliente
(`?ano=AAAA`), substituindo o limite fixo de "últimas 12 faturas".

**Testado em 25/08/2026** (mesma sessão de credencial real da Fase 4):
- `GET /cliente/faturas` (ano atual, cliente com Banco do Brasil) → cada
  fatura com `pagamento_presencial: false`, boleto/PIX presentes
  normalmente ✅
- `GET /cliente/faturas?ano=2027` (ano seguinte, sem faturas) →
  `{"ano":2027,"faturas":[]}` ✅
- `GET /cliente/faturas?ano=2030` (fora do range permitido) → caiu
  silenciosamente para o ano atual (2026) ✅
- `GET /cliente/faturas/{id}/pdf` (fatura não-presencial) → continua
  funcionando, PDF válido ✅
- **Pendente**: não foi possível testar o caso "fatura presencial de
  verdade" (`pagamento_presencial: true`, PDF bloqueado com `403`) porque
  não há CPF de teste disponível com forma de cobrança Banco Interno.
  Revalidar assim que houver uma credencial desse tipo disponível.
- `POST /boletos/consultar` (2ª via pública) — reaproveita a mesma lógica
  (`marcarPagamentoPresencial`); testado com sucesso após o rate limit
  resetar: `200 OK`, sem stack trace, `pagamento_presencial: false`
  calculado corretamente (cliente Banco do Brasil), boleto/PIX visíveis ✅

## Fase 4 — validada por completo ✅

Login com credencial real testado ponta a ponta em 25/08/2026:
- Login com CPF+senha corretos → `200`, sessão criada.
- `GET /cliente/faturas` com sessão válida → `200`, faturas reais (12 mais
  recentes, pagas e em aberto), campos filtrados corretamente — nenhum dado
  pessoal (nome/CPF/endereço) presente na resposta.
- `GET /cliente/plano` com sessão válida → `200`, só `nome_plano, valor,
  status, status_prefixo` — sem RG/telefone/senha de conexão.
- `GET /cliente/faturas/{id}/pdf` com id de fatura própria → `200`, PDF
  binário válido (confirmado com `file`, "PDF document, 1 page(s)").
- `GET /cliente/faturas/{id}/pdf` com id inexistente/de outro cliente →
  `404` genérico.
- `GET /cliente/faturas/{id}/pdf` sem sessão → `401`.

## Fase 5 — Integração com o frontend PHP puro (em andamento, 26/08/2026)

Mocks trocados por `fetch` real em `assets/js/main.js` (`initBoletoForm`,
`initLoginForm`), preservando IDs/estrutura HTML. Também implementado nesta
fase:

- Botões "Código"/"Pix" com cópia real (com fallback para
  `document.execCommand('copy')` quando `navigator.clipboard` não está
  disponível — só funciona em contexto seguro/HTTPS ou `localhost`).
- Botão de PDF removido da 2ª via pública (nunca deveria aparecer lá).
- Fatura paga: esconde código/PIX/PDF, mostra só "Pago em {data}" — novo
  campo `data_pagamento` em `FaturaResource`; `pdfFatura()` também recusa
  (`403`) servir PDF de fatura já quitada, mesmo por acesso direto à URL.
- Máscara de CPF/CNPJ com suporte a CNPJ alfanumérico (novo formato da
  Receita, 12 posições alfanuméricas + 2 dígitos verificadores) nos campos
  de 2ª via e login — mas o **envio continua restrito a CPF/CNPJ numérico
  puro** por decisão do usuário (backend não foi atualizado ainda para
  aceitar CNPJ alfanumérico; se digitado, o formulário barra o envio com
  mensagem explicando).
- Saudação com o primeiro nome do cliente ("Olá, Elione 👋") — novo campo
  `primeiro_nome` retornado por `POST /cliente/login` (extraído de
  `nome_razaosocial`, nunca o array `cliente` inteiro, que tem data de
  nascimento e telefones).
- Card "Suporte" trocado por "Próximo vencimento" no dashboard (calculado
  no frontend a partir da fatura em aberto mais próxima do ano atual).

**Ambiente de teste criado**: vhost dedicado `mut.local` (Apache,
`/etc/apache2/sites-available/mut-local.conf`) servindo
`/var/www/html/mut` na RAIZ do host — necessário porque as URLs usadas no
JS (`/hub-api/...`, mesmo padrão de `/api/contato.php` já existente) são
absolutas a partir da raiz do domínio, e produção roda na raiz (confirmado
com o usuário), mas o ambiente de dev local antigo usava `/mut/` como
subpasta. Exceção de HTTPS forçado no `.htaccess` raiz do site também
ganhou `mut.local` na lista. `hub-api-core/.env`: `ORIGENS_PERMITIDAS`
ganhou `http://mut.local`.

✅ **FASE 5 CONCLUÍDA E VALIDADA POR COMPLETO** — usuário confirmou em
produção (`https://muttelecom.com.br`, 26/08/2026): saudação com primeiro
nome real, card "Próximo vencimento", login completo (form → sessão →
faturas na tela), botões "Código"/"Pix" copiando corretamente em HTTPS
real. Fluxo público (2ª via) e autenticado (Área do Cliente) ambos
funcionando ponta a ponta no ambiente real.

## Deploy real — histórico (26/08/2026)

Primeira publicação em produção (`https://muttelecom.com.br`) tentada e
resolvida nesta data. Duas causas raiz encontradas, nessa ordem:

1. **`vendor/` ausente na hospedagem → 500 Internal Server Error logo na
   primeira chamada, sem log nenhum ainda em `storage/logs/`.**
   `hub-api-core/.gitignore` tinha `/vendor` (padrão gerado pelo
   `composer create-project`, pensado para projetos que rodam
   `composer install` no servidor — mas esta hospedagem NÃO tem Composer
   disponível). Como consequência, `vendor/` nunca foi commitado, e o
   deploy (git pull) nunca trouxe essa pasta — sem
   `vendor/autoload.php`, o Laravel nem inicializa.
   **Corrigido**: removida a linha `/vendor` do `.gitignore`, `vendor/`
   (92MB, ~8822 arquivos) commitado — mesmo padrão já usado para o
   PHPMailer do site PHP puro em `/vendor` (raiz do repo). Ver comentário
   deixado no `.gitignore` para nunca reativar essa exclusão.

2. **PHP da hospedagem (8.2.30) mais antigo que o exigido pelo projeto
   (`composer.json`: `"php": "^8.3"`) → `Composer detected issues in your
   platform` ao rodar `php artisan key:generate`.**
   Editar só o número no `composer.json` NÃO seria suficiente — o código
   real já instalado em `vendor/` (Laravel e dependências) pode usar
   sintaxe/recursos exclusivos do PHP 8.3+, então rebaixar a exigência
   sem trocar o PHP real quebraria de outro jeito.
   **Corrigido**: a hospedagem oferece múltiplas versões de PHP via
   painel — trocada a versão do domínio para 8.3+ ali (resolve o
   Apache/mod_php, que serve as páginas web). Mas o **PHP CLI via SSH
   continua apontando pro binário antigo** (`php` no PATH = 8.2.30,
   mesmo depois de trocar no painel) — a hospedagem disponibiliza
   binários versionados separados em `/usr/local/bin/php-8.3`,
   `php-8.4`, `php-8.5` etc. Use **`php-8.3`** (não o `php` genérico) para
   qualquer comando artisan/composer via SSH nesta hospedagem daqui pra
   frente (`php-8.3 artisan ...`), já que o projeto exige especificamente
   `^8.3` e não foi testado nem contra 8.4 nem 8.5.

**Resultado confirmado**: `GET /hub-api/ping` → `200 {"ok":true,...}`;
`POST /hub-api/api/boletos/consultar` (o mesmo endpoint que dava 500) →
`200`, resposta correta com boleto real do cliente de teste, sem stack
trace vazando.

**Ainda não verificado no deploy**: se o `.env` de produção já tem
`SESSION_SECURE_COOKIE=true`/`APP_DEBUG=false`/`ORIGENS_PERMITIDAS`
correto (ver checklist de Fase 6 abaixo) — o `.env` de produção já
existia na hospedagem antes desta sessão (não foi criado agora), então
seu conteúdo real não foi conferido aqui.

## Próximo passo — Fase 6 (hardening), a retomar na próxima sessão

Fases 0–5 concluídas e validadas em produção. Falta só a Fase 6 antes do
projeto estar 100% fechado. Checklist mínimo, nenhum item confirmado
ainda (o `.env` de produção já existia antes desta sessão — seu conteúdo
real nunca foi conferido linha por linha):

1. **Conferir o `.env` de produção de verdade** — item mais urgente, já
   que o site está no ar:
   - `APP_DEBUG` deve ser `false` (hoje erros vazam stack trace completo
     ao visitante — visto de verdade no teste de rate limit da Fase 3;
     isso é exatamente o tipo de vazamento que o projeto foi pensado pra
     evitar).
   - `SESSION_SECURE_COOKIE` deve ser `true` (há HTTPS real em produção).
   - `ORIGENS_PERMITIDAS` sem `mut.local`/`localhost` (só os domínios
     reais: `https://muttelecom.com.br`, `https://www.muttelecom.com.br`).
2. Exception handler central no Laravel que nunca expõe detalhe técnico
   (stack trace, caminho de arquivo) em nenhuma resposta ao cliente.
3. Permissões de arquivo na hospedagem: confirmar que `storage/` e
   `bootstrap/cache/` não estão com `777` (gambiarra só válida
   localmente) — usar algo como `775` + grupo correto do usuário do PHP.
4. Auditoria de `storage/logs/laravel.log` na hospedagem — garantir que
   nenhum CPF, senha, ou dado sensível da HubSoft foi logado por engano.
5. Revisão final: nenhuma rota sobrando além das documentadas acima,
   `vendor/`/`.env`/`app/` de fato não acessíveis via HTTP direto (checar
   com `curl` se `https://muttelecom.com.br/hub-api/.env` ou similar
   retorna 403/404, nunca o conteúdo do arquivo).
