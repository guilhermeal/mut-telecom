<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Área do Cliente — MUT Telecom';
$pageDescription = 'Acesse suas faturas, plano e suporte na Área do Cliente da MUT Telecom.';

$faturas = mut_faturas_mock();

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
            <button class="mut-btn-15" type="submit">Entrar</button>
            <div class="mut-muted-12-5">// autenticação mockada — integração futura via API</div>
          </form>
        </div>
      </section>
      <section id="mut-logged-in" class="hidden sec-pad mut-misc-17">
        <div class="mut-container-1100">
          <div class="mut-row-21">
            <div><h2 class="mut-heading-30-4">Olá, cliente 👋</h2><p class="mut-muted-145-4">Bem-vindo à sua área MUT.</p></div>
            <button type="button" id="mut-logout" class="mut-outline-hover mut-card-23">Sair</button>
          </div>
          <div class="grid-3 mut-grid-17">
            <div class="mut-misc-28"><div class="mut-eyebrow-2">Plano atual</div><div class="mut-heading-30-5">MUT 500 Mega</div><div class="mut-misc-44">R$ 89,90/mês · próxima fatura 10/06/2026</div></div>
            <div class="mut-card"><div class="mut-muted-125">Status da conexão</div><div class="mut-row-14"><span class="mut-misc-94"></span><span class="mut-heading-18-2">Online</span></div><div class="mut-muted-13-2">Sinal estável</div></div>
            <div class="mut-card"><div class="mut-muted-125">Suporte</div><a class="mut-misc-56" href="ajuda">Abrir chamado</a></div>
          </div>
          <div class="mut-card-12" role="table" aria-label="Minhas faturas">
            <div class="mut-heading-17">Minhas faturas</div>
            <div class="mut-grid-15" role="row"><div role="columnheader">Vencimento</div><div role="columnheader">Valor</div><div role="columnheader">Status</div><div class="mut-misc-13" role="columnheader">Ação</div></div>
<?php foreach ($faturas as $b): ?>
            <div class="mut-grid-16" role="row"><div class="mut-misc-16" role="cell"><?= e($b['venc']) ?></div><div class="mut-heading-x" role="cell"><?= e($b['valor']) ?></div><div role="cell"><span class="mut-status mut-status--<?= e($b['statusClasse']) ?>"><?= e($b['status']) ?></span></div><div class="mut-misc-13" role="cell"><a href="segunda-via" aria-label="Ver 2ª via da fatura de <?= e($b['venc']) ?>" class="mut-card-24">2ª via</a></div></div>
<?php endforeach; ?>
          </div>
          <div class="mut-muted-12-3">// dashboard e faturas mockados — integração futura via API</div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
