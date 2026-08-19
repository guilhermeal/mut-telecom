<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = '2ª via de boleto — MUT Telecom';
$pageDescription = 'Consulte e gere a 2ª via do seu boleto MUT Telecom pelo CPF ou CNPJ, sem precisar fazer login.';

$boletos = mut_faturas_mock();

require __DIR__ . '/includes/header.php';
?>
<div>
      <section style="padding:64px 0 36px; background:var(--surface); border-bottom:1px solid var(--border); text-align:center;">
        <div style="max-width:680px; margin:0 auto; padding:0 24px;">
          <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Financeiro</div>
          <h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:44px; letter-spacing:-1.6px; margin:0 0 14px;">2ª via de boleto</h1>
          <p style="font-size:16.5px; color:var(--muted); margin:0; line-height:1.55;">Consulte seus boletos pelo CPF ou CNPJ. Rápido e sem login.</p>
        </div>
      </section>
      <section class="sec-pad" style="padding:48px 0 80px;">
        <div style="max-width:880px; margin:0 auto; padding:0 24px;">
          <form id="mut-boleto-form" novalidate style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px; max-width:560px; margin:0 auto;">
            <label for="mut-boleto-input" style="display:block; font-size:14px; font-weight:600; margin-bottom:10px;">CPF ou CNPJ do titular</label>
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
              <input id="mut-boleto-input" class="mut-input" placeholder="000.000.000-00" aria-describedby="mut-boleto-error" style="flex:1; min-width:200px; padding:14px 16px; border-radius:12px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
              <button type="submit" style="padding:14px 24px; border-radius:12px; font-weight:700; font-size:15px; color:#fff; background:var(--primary); border:none; cursor:pointer; display:inline-flex; align-items:center; gap:8px; white-space:nowrap;"><span id="mut-boleto-spinner" class="hidden" aria-hidden="true" style="width:16px; height:16px; border:2px solid rgba(255,255,255,.4); border-top-color:#fff; border-radius:50%; animation:mutSpin .7s linear infinite; display:inline-block;"></span>Consultar boletos</button>
            </div>
            <div id="mut-boleto-error" class="hidden" role="alert" style="margin-top:12px; font-size:13.5px; color:var(--accent); font-weight:600;"></div>
            <div style="margin-top:14px; font-size:12px; color:var(--muted); font-family:ui-monospace,monospace;">// dados mockados — ponto de integração futura com a API de boletos</div>
          </form>

          <div id="mut-boleto-result" class="hidden" role="table" aria-label="Resultado da consulta de boletos" aria-live="polite" style="margin-top:32px; background:var(--background); border:1px solid var(--border); border-radius:18px; overflow:hidden;">
            <div role="row" style="display:grid; grid-template-columns:1.1fr 1fr 1fr 1.4fr; gap:8px; padding:16px 22px; background:var(--surface); border-bottom:1px solid var(--border); font-size:12.5px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.4px;">
              <div role="columnheader">Vencimento</div><div role="columnheader">Valor</div><div role="columnheader">Status</div><div role="columnheader" style="text-align:right;">Ações</div>
            </div>
<?php foreach ($boletos as $b): ?>
            <div role="row" style="display:grid; grid-template-columns:1.1fr 1fr 1fr 1.4fr; gap:8px; padding:18px 22px; border-bottom:1px solid var(--border); align-items:center; font-size:14.5px;">
              <div role="cell" style="font-weight:600;"><?= e($b['venc']) ?></div>
              <div role="cell" style="font-family:'Archivo',sans-serif; font-weight:700;"><?= e($b['valor']) ?></div>
              <div role="cell"><span style="font-size:12.5px; font-weight:700; padding:5px 11px; border-radius:999px; color:<?= e($b['cor']) ?>; background:<?= e($b['bg']) ?>;"><?= e($b['status']) ?></span></div>
              <div role="cell" style="display:flex; gap:8px; justify-content:flex-end; flex-wrap:wrap;">
                <button type="button" class="mut-boleto-copy" aria-label="Copiar código de barras do boleto de <?= e($b['venc']) ?>" title="Copiar código de barras" style="display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:9px; border:1px solid var(--border); background:var(--surface); color:var(--foreground); font-size:12.5px; font-weight:600; cursor:pointer;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="12" height="12" rx="2"/><path d="M5 15V5a2 2 0 0 1 2-2h10"/></svg><span class="mut-boleto-copy-label" aria-live="polite">Código</span></button>
                <button type="button" class="mut-boleto-pix" aria-label="Copiar Pix copia e cola do boleto de <?= e($b['venc']) ?>" title="Pix copia e cola" style="display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:9px; border:1px solid var(--border); background:var(--surface); color:var(--foreground); font-size:12.5px; font-weight:600; cursor:pointer;">Pix</button>
                <a href="#" class="mut-noop-link" aria-label="Baixar PDF do boleto de <?= e($b['venc']) ?>" title="Baixar PDF" style="display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:9px; background:var(--primary); color:#fff; font-size:12.5px; font-weight:600; cursor:pointer; text-decoration:none;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12M7 10l5 5 5-5M5 21h14"/></svg>PDF</a>
              </div>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
