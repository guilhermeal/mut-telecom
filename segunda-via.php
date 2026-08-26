<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = '2ª via de boleto — MUT Telecom';
$pageDescription = 'Consulte e gere a 2ª via do seu boleto MUT Telecom pelo CPF ou CNPJ, sem precisar fazer login.';

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-misc-6">
        <div class="mut-container-680">
          <div class="mut-eyebrow">Financeiro</div>
          <h1 class="mut-heading-44">2ª via de boleto MUT Telecom em Alagoas</h1>
          <p class="mut-muted-165">Consulte seus boletos pelo CPF ou CNPJ. Rápido e sem login.</p>
        </div>
      </section>
      <section class="sec-pad mut-misc-17">
        <div class="mut-container-880">
          <form class="mut-card-14" id="mut-boleto-form" novalidate>
            <label class="mut-misc-35" for="mut-boleto-input">CPF ou CNPJ do titular</label>
            <div class="mut-row-8">
              <input id="mut-boleto-input" class="mut-input mut-input--inline" placeholder="000.000.000-00" aria-describedby="mut-boleto-error">
              <button class="mut-btn-12" type="submit"><span id="mut-boleto-spinner" class="hidden mut-misc-24" aria-hidden="true"></span>Consultar boletos</button>
            </div>
            <div id="mut-boleto-error" class="hidden mut-misc-55" role="alert"></div>
          </form>

          <div id="mut-boleto-empty" class="hidden mut-card-20 mut-misc-55" style="padding:22px; text-align:center;" role="status" aria-live="polite"></div>

          <div id="mut-boleto-result" class="hidden mut-card-20" role="table" aria-label="Resultado da consulta de boletos" aria-live="polite">
            <div class="mut-grid-13" role="row">
              <div role="columnheader">Vencimento</div><div role="columnheader">Valor</div><div role="columnheader">Situação</div><div class="mut-misc-13" role="columnheader">Ações</div>
            </div>
            <div id="mut-boleto-rows"></div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
