<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Planos de fibra — MUT Telecom';
$pageDescription = 'Planos residenciais e empresariais de fibra óptica MUT Telecom. Wi-Fi incluso, instalação gratuita e suporte local.';

$residentialPlans = mut_plans_with_links(mut_residential_plans());
$businessPlans = mut_plans_with_links(mut_business_plans());
$faqs = mut_faqs();

require __DIR__ . '/includes/header.php';
?>
<div>
      <section style="padding:64px 0 36px; background:var(--surface); border-bottom:1px solid var(--border); text-align:center;">
        <div style="max-width:760px; margin:0 auto; padding:0 24px;">
          <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">NOSSOS PLANOS</div>
          <h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:46px; letter-spacing:-1.6px; margin:0 0 14px;">Planos de fibra para todo jeito de usar</h1>
          <p style="font-size:17px; color:var(--muted); margin:0; line-height:1.55;">Residencial ou empresarial — escolha a velocidade, assine pelo WhatsApp e conecte-se.</p>
        </div>
      </section>
      <section class="sec-pad" style="padding:56px 0 80px;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
<?php mut_render_plan_toggle('var(--surface)'); ?>
          <div id="mut-plan-panel-residencial" role="tabpanel" aria-labelledby="mut-plan-tab-residencial" class="mut-plan-group grid-4 is-visible" data-plan-group="residencial" style="grid-template-columns:repeat(4,1fr); gap:20px; align-items:stretch;">
<?php foreach ($residentialPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <div id="mut-plan-panel-empresarial" role="tabpanel" aria-labelledby="mut-plan-tab-empresarial" class="mut-plan-group grid-3" data-plan-group="empresarial" style="grid-template-columns:repeat(3,1fr); gap:20px; align-items:stretch;">
<?php foreach ($businessPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <!-- comparativo -->
          <div style="margin-top:56px; background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:30px;">
            <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:22px; margin:0 0 22px;">O que está incluso em todos os planos</h3>
            <div class="grid-4" style="display:grid; grid-template-columns:repeat(4,1fr); gap:18px;">
              <div style="display:flex; align-items:center; gap:11px; font-size:14.5px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Instalação grátis</div>
              <div style="display:flex; align-items:center; gap:11px; font-size:14.5px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Roteador Wi-Fi incluso</div>
              <div style="display:flex; align-items:center; gap:11px; font-size:14.5px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Suporte local</div>
              <div style="display:flex; align-items:center; gap:11px; font-size:14.5px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>App do assinante</div>
            </div>
          </div>
        </div>
      </section>
      <!-- FAQ -->
      <section class="sec-pad" style="padding:0 0 90px;">
        <div style="max-width:820px; margin:0 auto; padding:0 24px;">
          <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:30px; letter-spacing:-1px; margin:0 0 28px; text-align:center;">Dúvidas sobre os planos</h2>
          <div class="mut-faq-list" role="list" style="display:grid; gap:12px;">
<?php foreach ($faqs as $i => $f): ?>
            <div class="mut-faq-item" role="listitem" style="background:var(--surface); border:1px solid var(--border); border-radius:16px; overflow:hidden;">
              <button type="button" id="mut-faq-btn-planos-<?= $i ?>" class="mut-faq-toggle" aria-expanded="false" aria-controls="mut-faq-panel-planos-<?= $i ?>" style="width:100%; display:flex; align-items:center; justify-content:space-between; gap:16px; padding:20px 22px; background:transparent; border:none; cursor:pointer; text-align:left; font-family:'Archivo',sans-serif; font-weight:600; font-size:16.5px; color:var(--foreground);"><?= e($f['q']) ?><span class="mut-faq-icon"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span></button>
              <div id="mut-faq-panel-planos-<?= $i ?>" class="mut-faq-answer" role="region" aria-labelledby="mut-faq-btn-planos-<?= $i ?>" style="padding:0 22px 20px; font-size:15px; line-height:1.6; color:var(--muted);"><?= e($f['a']) ?></div>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
