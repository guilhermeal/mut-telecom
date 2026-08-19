<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Planos empresariais — MUT Telecom';
$pageDescription = 'Internet dedicada para empresas em Alagoas: link dedicado, IP fixo, SLA e suporte prioritário com a MUT Telecom.';

$businessPlans = mut_plans_with_links(mut_business_plans());

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-pos-19">
        <div class="mut-pos-7"></div>
        <div class="mut-pos-17">
          <div class="mut-misc-38">MUT Empresas</div>
          <h1 class="mut-heading-48">Internet que não pode parar o seu negócio</h1>
          <p class="mut-misc-52">Link dedicado, IP fixo, SLA e suporte prioritário para empresas de Alagoas que dependem de conexão estável.</p>
          <a class="mut-btn-17" href="contato.php">Falar com um consultor</a>
        </div>
      </section>
      <section class="sec-pad mut-misc-80">
        <div class="mut-container-1240">
          <div class="grid-4 mut-grid-22">
            <div class="mut-card"><div class="mut-iconbox-48"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M6 10v4M10 10v4"/></svg></div><h3 class="mut-misc-4">Link dedicado</h3><p class="mut-muted-135-2">Banda garantida, simétrica, só para a sua empresa.</p></div>
            <div class="mut-card"><div class="mut-iconbox-48"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M2 12h20M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg></div><h3 class="mut-misc-4">IP fixo</h3><p class="mut-muted-135-2">Ideal para servidores, câmeras e acesso remoto.</p></div>
            <div class="mut-card"><div class="mut-iconbox-48"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg></div><h3 class="mut-misc-4">SLA garantido</h3><p class="mut-muted-135-2">Acordo de nível de serviço com prazos de reparo.</p></div>
            <div class="mut-card"><div class="mut-iconbox-48"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h1a2 2 0 0 1 2 2zM3 19a2 2 0 0 0 2 2h1v-7H5a2 2 0 0 0-2 2z"/></svg></div><h3 class="mut-misc-4">Suporte prioritário</h3><p class="mut-muted-135-2">Atendimento dedicado e gerente de conta.</p></div>
          </div>
          <h2 class="mut-heading-32-2">Planos empresariais</h2>
          <div class="grid-3 mut-grid-20">
<?php foreach ($businessPlans as $plan): ?>
            <div class="mut-card-25">
<?php if ($plan['destaque']): ?>
              <div class="mut-pos"></div>
              <div class="mut-pos-4">★ Recomendado</div>
<?php endif; ?>
              <div class="mut-muted-16"><?= e($plan['nome']) ?></div>
              <div class="mut-row-4"><span class="mut-heading-44-3"><?= e($plan['vel']) ?></span><span class="mut-misc-49"><?= e($plan['unit']) ?></span></div>
              <div class="mut-row-3"><span class="mut-muted-15-2">R$</span><span class="mut-heading-28-2"><?= e($plan['preco']) ?></span><span class="mut-muted-14-2">/mês</span></div>
              <div class="mut-grid-3">
<?php foreach ($plan['features'] as $feat): ?>
                <div class="mut-row-11"><svg class="mut-misc-15" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><?= e($feat) ?></div>
<?php endforeach; ?>
              </div>
              <a class="mut-btn-5" href="contato.php">Solicitar proposta</a>
            </div>
<?php endforeach; ?>
          </div>
          <p class="mut-muted-13-4">Valores placeholder — proposta personalizada conforme a necessidade da empresa.</p>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
