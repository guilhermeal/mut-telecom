<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = '2ª via de boleto — MUT Telecom';
$pageDescription = 'Consulte e gere a 2ª via do seu boleto MUT Telecom pelo CPF ou CNPJ, sem precisar fazer login.';

$boletos = mut_faturas_mock();

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-misc-6">
        <div class="mut-container-680">
          <div class="mut-eyebrow">Financeiro</div>
          <h1 class="mut-heading-44">2ª via de boleto</h1>
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
            <div class="mut-muted-12-2">// dados mockados — ponto de integração futura com a API de boletos</div>
          </form>

          <div id="mut-boleto-result" class="hidden mut-card-20" role="table" aria-label="Resultado da consulta de boletos" aria-live="polite">
            <div class="mut-grid-13" role="row">
              <div role="columnheader">Vencimento</div><div role="columnheader">Valor</div><div role="columnheader">Status</div><div class="mut-misc-13" role="columnheader">Ações</div>
            </div>
<?php foreach ($boletos as $b): ?>
            <div class="mut-grid-14" role="row">
              <div class="mut-misc-16" role="cell"><?= e($b['venc']) ?></div>
              <div class="mut-heading-x" role="cell"><?= e($b['valor']) ?></div>
              <div role="cell"><span class="mut-status mut-status--<?= e($b['statusClasse']) ?>"><?= e($b['status']) ?></span></div>
              <div class="mut-row-26" role="cell">
                <button type="button" class="mut-boleto-copy mut-card-9" aria-label="Copiar código de barras do boleto de <?= e($b['venc']) ?>" title="Copiar código de barras"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg><span class="mut-boleto-copy-label" aria-live="polite">Código</span></button>
                <button type="button" class="mut-boleto-pix mut-card-9" aria-label="Copiar Pix copia e cola do boleto de <?= e($b['venc']) ?>" title="Pix copia e cola">Pix</button>
                <a href="#" class="mut-noop-link mut-btn-2" aria-label="Baixar PDF do boleto de <?= e($b['venc']) ?>" title="Baixar PDF"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12M7 10l5 5 5-5M5 21h14"/></svg>PDF</a>
              </div>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
