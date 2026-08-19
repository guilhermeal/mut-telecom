<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Central de Ajuda — MUT Telecom';
$pageDescription = 'Tire dúvidas sobre conexão, Wi-Fi, faturas, contrato e mais na Central de Ajuda da MUT Telecom.';

$faqs = mut_faqs();

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-misc-77">
        <div class="mut-container-720">
          <h1 class="mut-heading-44-2">Como podemos ajudar?</h1>
          <form class="mut-pos-18" role="search" onsubmit="return false;">
            <label for="mut-help-search" class="mut-visually-hidden">Buscar na Central de Ajuda</label>
            <svg class="mut-pos-3" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--muted)" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
            <input class="mut-misc-91" id="mut-help-search" type="search" placeholder="Busque por um tema (ex.: instalação, boleto, Wi-Fi)">
          </form>
        </div>
      </section>
      <section class="sec-pad mut-misc-75">
        <div class="mut-container-1240">
          <div class="grid-3 mut-grid-5">
            <div class="mut-card-6"><div class="mut-iconbox-44"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1.2" fill="currentColor"/></svg></div><h3 class="mut-misc-9">Conexão e Wi-Fi</h3><p class="mut-muted-135-2">Resolver lentidão, reiniciar o roteador, melhorar o sinal.</p></div>
            <div class="mut-card-6"><div class="mut-iconbox-44"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div><h3 class="mut-misc-9">Faturas e pagamento</h3><p class="mut-muted-135-2">2ª via, Pix, boleto, datas de vencimento.</p></div>
            <div class="mut-card-6"><div class="mut-iconbox-44"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg></div><h3 class="mut-misc-9">Conta e contrato</h3><p class="mut-muted-135-2">Mudança de plano, endereço, cancelamento.</p></div>
          </div>
          <!-- atalhos -->
          <div class="grid-3 mut-grid-5">
            <a href="segunda-via.php" class="mut-outline-hover-2 mut-row-5"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/></svg><span class="mut-misc-11">2ª via de boleto</span></a>
            <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-outline-hover-2 mut-row-5"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="#25d366"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg><span class="mut-misc-11">Falar no WhatsApp</span></a>
            <a href="area-do-cliente.php" class="mut-outline-hover-2 mut-row-5"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg><span class="mut-misc-11">Área do Cliente</span></a>
          </div>
          <div class="mut-container-820-2">
            <h2 class="mut-heading-28-4">Perguntas frequentes</h2>
            <div class="mut-faq-list mut-grid" role="list">
<?php foreach ($faqs as $i => $f): ?>
              <div class="mut-faq-item mut-card-7" role="listitem">
                <button type="button" id="mut-faq-btn-ajuda-<?= $i ?>" class="mut-faq-toggle mut-misc-14" aria-expanded="false" aria-controls="mut-faq-panel-ajuda-<?= $i ?>"><?= e($f['q']) ?><span class="mut-faq-icon"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span></button>
                <div id="mut-faq-panel-ajuda-<?= $i ?>" class="mut-faq-answer mut-muted-15" role="region" aria-labelledby="mut-faq-btn-ajuda-<?= $i ?>"><?= e($f['a']) ?></div>
              </div>
<?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
