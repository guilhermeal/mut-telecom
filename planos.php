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
      <section class="mut-misc-6">
        <div class="mut-container-760">
          <div class="mut-eyebrow">NOSSOS PLANOS</div>
          <h1 class="mut-heading-46">Planos de fibra para todo jeito de usar</h1>
          <p class="mut-muted-17">Residencial ou empresarial — escolha a velocidade, assine pelo WhatsApp e conecte-se.</p>
        </div>
      </section>
      <section class="sec-pad mut-misc-18">
        <div class="mut-container-1240">
<?php mut_render_plan_toggle('on-surface'); ?>
          <div id="mut-plan-panel-residencial" role="tabpanel" aria-labelledby="mut-plan-tab-residencial" class="mut-plan-group grid-4 is-visible mut-grid-8" data-plan-group="residencial">
<?php foreach ($residentialPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <div id="mut-plan-panel-empresarial" role="tabpanel" aria-labelledby="mut-plan-tab-empresarial" class="mut-plan-group grid-3 mut-grid-7" data-plan-group="empresarial">
<?php foreach ($businessPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <!-- comparativo -->
          <div class="mut-card-21">
            <h3 class="mut-heading-22">O que está incluso em todos os planos</h3>
            <div class="grid-4 mut-grid-6">
              <div class="mut-row"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Instalação grátis</div>
              <div class="mut-row"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Roteador Wi-Fi incluso</div>
              <div class="mut-row"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Suporte local</div>
              <div class="mut-row"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>App do assinante</div>
            </div>
          </div>
        </div>
      </section>
      <!-- FAQ -->
      <section class="sec-pad mut-misc-69">
        <div class="mut-container-820">
          <h2 class="mut-heading-30-2">Dúvidas sobre os planos</h2>
          <div class="mut-faq-list mut-grid" role="list">
<?php foreach ($faqs as $i => $f): ?>
            <div class="mut-faq-item mut-card-7" role="listitem">
              <button type="button" id="mut-faq-btn-planos-<?= $i ?>" class="mut-faq-toggle mut-misc-14" aria-expanded="false" aria-controls="mut-faq-panel-planos-<?= $i ?>"><?= e($f['q']) ?><span class="mut-faq-icon"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span></button>
              <div id="mut-faq-panel-planos-<?= $i ?>" class="mut-faq-answer mut-muted-15" role="region" aria-labelledby="mut-faq-btn-planos-<?= $i ?>"><?= e($f['a']) ?></div>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
