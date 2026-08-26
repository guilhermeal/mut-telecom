<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Área do Cliente — MUT Telecom';
$pageDescription = 'Acesse suas faturas, plano e suporte na Área do Cliente da MUT Telecom.';

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-misc-81" id="mut-logged-out">
        <div class="mut-misc-67">
          <div class="mut-misc-84">
            <img src="assets/MUT_full_logo.png" alt="MUT Telecom" class="mut-logo mut-logo--lg mut-logo-light">
            <img src="assets/MUT_full_logo_dark.png" alt="MUT Telecom" class="mut-logo mut-logo--lg mut-logo-dark">
            <h1 class="mut-heading-24-2">Área do Cliente MUT Telecom em Alagoas</h1>
            <p class="mut-muted-145-3">Acesse suas faturas, plano e suporte.</p>
          </div>
          <form class="mut-misc-32" id="mut-login-form" novalidate>
            <div>
              <label class="mut-misc" for="mut-login-cpf">CPF</label>
              <input id="mut-login-cpf" name="cpf" autocomplete="username" class="mut-input" placeholder="000.000.000-00" aria-describedby="mut-login-error">
            </div>
            <div>
              <label class="mut-misc" for="mut-login-senha">Senha</label>
              <input id="mut-login-senha" type="password" name="senha" autocomplete="current-password" class="mut-input" placeholder="••••••••" aria-describedby="mut-login-error">
            </div>
            <div id="mut-login-error" class="hidden mut-misc-42" role="alert"></div>
            <button class="mut-btn-15" type="submit"><span id="mut-login-spinner" class="hidden mut-misc-24" aria-hidden="true"></span>Entrar</button>
          </form>
        </div>
      </section>
      <section id="mut-logged-in" class="hidden sec-pad mut-misc-17">
        <div class="mut-container-1100">
          <div class="mut-row-21">
            <div><h2 id="mut-saudacao" class="mut-heading-30-4">Olá 👋</h2><p class="mut-muted-145-4">Bem-vindo à sua área MUT.</p></div>
            <button type="button" id="mut-logout" class="mut-outline-hover mut-card-23">Sair</button>
          </div>
          <div class="grid-3 mut-grid-17">
            <div class="mut-misc-28"><div class="mut-eyebrow-2">Plano atual</div><div id="mut-plano-nome" class="mut-heading-30-5">—</div><div id="mut-plano-status" class="mut-misc-44"></div></div>
            <div class="mut-card"><div class="mut-muted-125">Status da conexão</div><div class="mut-row-14"><span class="mut-misc-94"></span><span class="mut-heading-18-2">Online</span></div><div class="mut-muted-13-2">Sinal estável</div></div>
            <div class="mut-card"><div class="mut-muted-125">Próximo vencimento</div><div id="mut-proximo-vencimento" class="mut-heading-18-2">—</div></div>
          </div>
          <div class="mut-card-12" role="table" aria-label="Minhas faturas">
            <div class="mut-row-21" style="padding:18px 22px 0;">
              <div class="mut-heading-17">Minhas faturas</div>
              <div>
                <label class="mut-misc" for="mut-faturas-ano" style="margin-right:8px;">Ano</label>
                <select id="mut-faturas-ano" class="mut-input" style="width:auto; padding:8px 12px;"></select>
              </div>
            </div>
            <div id="mut-faturas-loading" class="mut-misc-55" style="padding:18px 22px;">Carregando faturas…</div>
            <div id="mut-faturas-empty" class="hidden mut-misc-55" style="padding:18px 22px;">Nenhuma fatura encontrada neste ano.</div>
            <div id="mut-faturas-error" class="hidden mut-misc-55" role="alert" style="padding:18px 22px;"></div>
            <div id="mut-faturas-table" class="hidden">
              <div class="mut-grid-15" role="row"><div role="columnheader">Vencimento</div><div role="columnheader">Valor</div><div role="columnheader">Status</div><div class="mut-misc-13" role="columnheader">Ação</div></div>
              <div id="mut-faturas-rows"></div>
            </div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
