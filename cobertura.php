<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Cobertura — MUT Telecom';
$pageDescription = 'Veja se a fibra óptica da MUT Telecom já chegou até você em Murici, Messias, Rio Largo ou Branquinha.';

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-misc-6">
        <div class="mut-container-760">
          <div class="mut-eyebrow">Cobertura</div>
          <h1 class="mut-heading-46">Cobertura de fibra óptica em Murici, Messias, Rio Largo e Branquinha</h1>
          <p class="mut-muted-17">Fibra óptica em Murici, Messias, Rio Largo e Branquinha — e expandindo.</p>
        </div>
      </section>
      <section class="sec-pad mut-misc-74">
        <div class="mut-container-1240">
          <div class="mut-card-27">
            <div class="mut-misc-90">
              <?php require __DIR__ . '/includes/mapa-cobertura.php'; ?>
            </div>
            <div class="mut-muted-12-4">Mapa do estado de Alagoas — regiões atendidas em destaque</div>
          </div>
        </div>
      </section>

      <!-- escritórios físicos por cidade -->
      <section class="sec-pad mut-misc-74">
        <div class="mut-container-1240">
          <div class="mut-eyebrow">Onde estamos</div>
          <h2 class="mut-heading-26-2">Pontos de atendimento</h2>
          <div class="grid-4 mut-grid-23">
<?php foreach (mut_office_addresses() as $office): ?>
            <div class="mut-card-5">
              <div style="display: flex; align-items: center; gap: 0.5rem;">
                <div class="mut-iconbox-48-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-7.5-7-12a7 7 0 0 1 14 0c0 4.5-7 12-7 12z"/><circle cx="12" cy="9" r="2.5"/></svg></div>
                <h3 class="mut-misc-10"><?= e($office['cidade']) ?></h3>
              </div>
              <p class="mut-muted-145-2"><?= e($office['endereco']) ?></p>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- viabilidade por e-mail -->
      <section class="sec-pad mut-misc-73">
        <div class="mut-container-1240">
          <div class="split mut-misc-33">
            <div>
              <div class="mut-iconbox-48"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg></div>
              <h2 class="mut-heading-26-2">Ainda não tem certeza? Peça uma análise de viabilidade</h2>
              <p class="mut-muted-145-5">Envie seu endereço completo por e-mail e nossa equipe técnica confirma a viabilidade de instalação na sua região.</p>
            </div>
            <div>
              <div id="mut-viab-success" class="hidden mut-misc-88" role="status" aria-live="polite">
                <div class="mut-iconbox-56" aria-hidden="true"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>
                <h3 class="mut-misc-40">Pedido enviado!</h3>
                <p class="mut-muted-14-3">Vamos analisar e responder no e-mail informado.</p>
              </div>
              <form class="mut-grid-4" id="mut-viab-form" novalidate>
                <div>
                  <label for="mut-viab-email" class="mut-visually-hidden">Seu e-mail</label>
                  <input id="mut-viab-email" name="email" type="email" class="mut-input" placeholder="Seu e-mail" aria-describedby="mut-viab-err-email">
                  <div id="mut-viab-err-email" class="hidden mut-misc-2" role="alert"></div>
                </div>
                <div>
                  <label for="mut-viab-endereco" class="mut-visually-hidden">Endereço completo (rua, número, bairro, cidade)</label>
                  <input id="mut-viab-endereco" name="endereco" class="mut-input" placeholder="Endereço completo (rua, número, bairro, cidade)" aria-describedby="mut-viab-err-endereco">
                  <div id="mut-viab-err-endereco" class="hidden mut-misc-2" role="alert"></div>
                </div>
                <button type="submit" class="mut-lift mut-btn-14">Solicitar análise de viabilidade</button>
              </form>
            </div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
