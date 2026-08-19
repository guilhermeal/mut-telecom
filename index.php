<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'MUT Telecom — Fibra óptica em Alagoas';
$pageDescription = 'A internet que a sua cidade esperava: fibra óptica em Murici, Messias, Rio Largo e Branquinha, com atendimento local.';

$residentialPlans = mut_plans_with_links(mut_residential_plans());
$businessPlans = mut_plans_with_links(mut_business_plans());
$faqs = mut_faqs();
$depoimentos = mut_depoimentos();
$cidades = mut_cidades();
$partners = mut_partners();

require __DIR__ . '/includes/header.php';
?>
<div>

<!-- HERO -->
      <section class="mut-pos-20">
        <div class="mut-pos-2"></div>
        <div class="hero-grid mut-pos-21">
          <div class="mut-misc-68">
            <div class="mut-misc-37"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0" stroke-linecap="round"/><circle cx="12" cy="19.5" r="1.4" fill="currentColor" stroke="none"/></svg>FIBRA ÓPTICA EM ALAGOAS</div>
            <div class="mut-row-9">
              <span class="mut-heading-118">500</span>
              <span class="mut-heading-28">MEGA</span>
            </div>
            <div class="mut-eyebrow-3">★ Nosso plano mais assinado</div>
            <h1 class="h1 mut-heading-38-3">A internet que a sua cidade esperava.</h1>
            <p class="mut-misc-51">Fibra óptica com sinal firme e atendimento de gente da região, em Murici, Messias, Rio Largo e Branquinha.</p>
            <div class="mut-row-23">
              <a href="planos.php" class="mut-lift mut-btn-13">Ver planos e preços</a>
              <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-outline-hover mut-misc-72"><?= mut_icon_whatsapp() ?>Falar no WhatsApp</a>
            </div>
          </div>
        </div>
      </section>

      <!-- social proof strip -->
      <div class="mut-pos-15">
        <div class="grid-3 mut-misc-65">
          <div><div class="mut-heading-26">+[X] mil</div><div class="mut-muted-135">clientes conectados</div></div>
          <div class="mut-misc-34"><div class="mut-heading-26">[4,8] ★</div><div class="mut-muted-135">nota no Google</div></div>
          <div><div class="mut-heading-26">100%</div><div class="mut-muted-135">fibra óptica</div></div>
        </div>
      </div>

      <!-- VERIFICADOR DE COBERTURA -->
      <section class="mut-misc-79">
        <div class="mut-container-760-2">
          <h2 class="mut-heading-32">Veja se a MUT já chegou na sua rua</h2>
          <p class="mut-misc-46">Digite seu CEP ou cidade e descubra na hora.</p>
          <form class="mut-misc-29" id="mut-coverage-form">
            <div class="mut-row-8">
              <input id="mut-coverage-input" class="mut-input mut-input--inline-surface" placeholder="Digite seu CEP ou cidade" aria-label="CEP ou cidade">
              <button class="mut-btn-11" type="submit" id="mut-coverage-submit">
                <span id="mut-coverage-spinner" class="hidden mut-misc-24" aria-hidden="true"></span>
                Verificar cobertura
              </button>
            </div>
            <div id="mut-coverage-yes" class="hidden mut-misc-58" role="status" aria-live="polite"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Boa notícia! Temos cobertura na sua região 🎉</div>
            <div id="mut-coverage-no" class="hidden mut-misc-57" role="status" aria-live="polite"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4M12 17h.01"/><circle cx="12" cy="12" r="9"/></svg>Ainda não chegamos aí — deixe seu contato e avisamos você.</div>
          </form>
        </div>
      </section>

      <!-- DIFERENCIAIS -->
      <section class="sec-pad mut-misc-21">
        <div class="mut-container-1240">
          <div class="mut-misc-12">
            <div class="mut-eyebrow">POR DENTRO DA MUT</div>
            <h2 class="mut-heading-40">O que muda quando o provedor é daqui</h2>
            <p class="mut-muted-16-5">Estrutura de fibra própria, equipe na rua e atendimento que conhece o nome da sua rua.</p>
          </div>
          <div class="grid-3 mut-grid-2">
            <div class="mut-card-hover mut-card-2">
              <div class="mut-iconbox-50"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1.2" fill="currentColor"/></svg></div>
              <h3 class="mut-heading-18">Fibra até dentro de casa</h3>
              <p class="mut-muted-145">Sem cabo velho no meio do caminho: sinal firme do poste à sua sala.</p>
            </div>
            <div class="mut-card-hover mut-card-2">
              <div class="mut-iconbox-50"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8.5C5 6 9 4.5 12 4.5s7 1.5 10 4M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1.2" fill="currentColor"/></svg></div>
              <h3 class="mut-heading-18">Wi-Fi que alcança a casa toda</h3>
              <p class="mut-muted-145">Roteador moderno incluso e configurado na instalação.</p>
            </div>
            <div class="mut-card-hover mut-card-2">
              <div class="mut-iconbox-50"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg></div>
              <h3 class="mut-heading-18">Instalado em até 48h</h3>
              <p class="mut-muted-145">Nossa equipe é daqui, então a visita não demora.</p>
            </div>
            <div class="mut-card-hover mut-card-2">
              <div class="mut-iconbox-50"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h1a2 2 0 0 1 2 2zM3 19a2 2 0 0 0 2 2h1v-7H5a2 2 0 0 0-2 2z"/></svg></div>
              <h3 class="mut-heading-18">Atendimento com gente de verdade</h3>
              <p class="mut-muted-145">Fala com quem mora na região, sem menu automático.</p>
            </div>
            <div class="mut-card-hover mut-card-2">
              <div class="mut-iconbox-50"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
              <h3 class="mut-heading-18">A conta que você combinou</h3>
              <p class="mut-muted-145">Preço fixo, sem taxa escondida na fatura.</p>
            </div>
            <div class="mut-card-hover mut-card-2">
              <div class="mut-iconbox-50"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="3"/><path d="M11 18h2"/></svg></div>
              <h3 class="mut-heading-18">Resolva pelo celular</h3>
              <p class="mut-muted-145">2ª via, suporte e upgrade de plano no seu aparelho.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- COBERTURA (mapa) -->
      <section class="sec-pad mut-misc-20">
        <div class="split mut-misc-63">
          <div>
            <div class="mut-eyebrow">Cobertura própria</div>
            <h2 class="mut-heading-36">Nossa fibra já está desenhada no mapa de Alagoas</h2>
            <p class="mut-muted-16-4">Cada ponto no mapa é rua atendida pela MUT. Acompanhe o avanço da nossa rede pelas cidades da região.</p>
            <div class="grid-3 mut-grid-19">
              <div class="mut-card-4"><div class="mut-heading-24">4</div><div class="mut-muted-12">cidades atendidas</div></div>
              <div class="mut-card-4"><div class="mut-heading-24">+[X] mil</div><div class="mut-muted-12">clientes conectados</div></div>
              <div class="mut-card-4"><div class="mut-heading-24">100%</div><div class="mut-muted-12">fibra óptica</div></div>
            </div>
            <div class="mut-row-17">
              <div class="mut-row-6"><span class="mut-misc-93"></span>Área com fibra MUT</div>
              <div class="mut-row-6"><span class="mut-misc-92"></span>Ponto de rede ativo</div>
            </div>
            <a class="mut-btn-3" href="cobertura.php">Verificar cobertura completa</a>
          </div>
          <div class="mut-card-16">
            <img class="mut-misc-23" src="assets/mapa-cobertura.svg" alt="Mapa de cobertura da MUT em Alagoas">
          </div>
        </div>
      </section>

      <!-- PLANOS -->
      <section class="sec-pad mut-misc-22">
        <div class="mut-container-1240">
          <div class="mut-misc-86">
            <div class="mut-eyebrow">NOSSOS PLANOS</div>
            <h2 class="mut-heading-40">Escolha a velocidade que a sua casa precisa</h2>
            <p class="mut-muted-16-3">Todos os planos com Wi-Fi incluso, instalação gratuita e suporte local.</p>
          </div>
<?php mut_render_plan_toggle('on-background'); ?>
          <div id="mut-plan-panel-residencial" role="tabpanel" aria-labelledby="mut-plan-tab-residencial" class="mut-plan-group grid-4 is-visible mut-grid-8" data-plan-group="residencial">
<?php foreach ($residentialPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <div id="mut-plan-panel-empresarial" role="tabpanel" aria-labelledby="mut-plan-tab-empresarial" class="mut-plan-group grid-3 mut-grid-7" data-plan-group="empresarial">
<?php foreach ($businessPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <p class="mut-muted-13-5">Valores e velocidades são placeholders — substituir pelos planos reais. Consulte condições e disponibilidade por endereço.</p>
        </div>
      </section>

      <!-- COMBOS / PARCEIROS -->
      <section class="sec-pad mut-misc-19">
        <div class="mut-container-1240-2">
          <h2 class="mut-heading-30-3">Sua internet com seus apps favoritos</h2>
          <p class="mut-muted-155">Combos de streaming e parceiros para assistir, ouvir e jogar sem limites.</p>
          <div class="grid-3 mut-grid-24">
<?php foreach ($partners as $p): ?>
            <div class="mut-misc-26"><?= e($p) ?></div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

<!-- COBERTURA -->
      <section class="sec-pad mut-misc-82">
        <div class="mut-container-1240">
          <div class="mut-misc-87">
            <div class="mut-eyebrow-4">Cobertura</div>
            <h2 class="mut-heading-38">Já estamos na sua cidade</h2>
            <p class="mut-misc-47">Cobertura própria em quatro cidades de Alagoas — e crescendo.</p>
          </div>
          <div class="grid-4 mut-grid-6">
<?php foreach ($cidades as $c): ?>
            <div class="mut-misc-30">
              <div class="mut-iconbox-46-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="2.5"/></svg></div>
              <div class="mut-heading-18-3"><?= e($c) ?></div>
              <div class="mut-muted-13-3">[X] bairros atendidos</div>
              <a class="mut-misc-70" href="cobertura.php">Ver cobertura</a>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- COMO FUNCIONA -->
      <section class="sec-pad mut-misc-21">
        <div class="mut-container-1240">
          <div class="mut-misc-12">
            <div class="mut-eyebrow">Passo a passo</div>
            <h2 class="mut-heading-40-2">Conectar é simples</h2>
          </div>
          <div class="grid-4 mut-grid-21">
            <div class="mut-misc-7"><div class="mut-iconbox-58">1</div><h3 class="mut-misc-5">Escolha seu plano</h3><p class="mut-muted-14">Compare as velocidades e ache a ideal.</p></div>
            <div class="mut-misc-7"><div class="mut-iconbox-58">2</div><h3 class="mut-misc-5">Verifique a cobertura</h3><p class="mut-muted-14">Confirme que chegamos no seu endereço.</p></div>
            <div class="mut-misc-7"><div class="mut-iconbox-58">3</div><h3 class="mut-misc-5">Agende a instalação</h3><p class="mut-muted-14">Escolha o melhor dia e horário pra você.</p></div>
            <div class="mut-misc-7"><div class="mut-iconbox-58-3">4</div><h3 class="mut-misc-5">Conecte-se ao futuro</h3><p class="mut-muted-14">Pronto! É só aproveitar a sua fibra.</p></div>
          </div>
        </div>
      </section>

      <!-- DEPOIMENTOS -->
      <section class="sec-pad mut-misc-22">
        <div class="mut-container-1240">
          <div class="mut-misc-12">
            <div class="mut-eyebrow">Depoimentos</div>
            <h2 class="mut-heading-40-2">Quem é MUT, recomenda</h2>
          </div>
          <div class="grid-3 mut-grid-2" role="list">
<?php foreach ($depoimentos as $d): ?>
            <figure class="mut-card-13" role="listitem">
              <div class="mut-row-25" role="img" aria-label="Avaliação 5 de 5 estrelas">
                <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623" stroke="none"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg>
              </div>
              <blockquote class="mut-misc-45">"<?= e($d['texto']) ?>"</blockquote>
              <figcaption class="mut-row-16">
                <div class="mut-iconbox-46" aria-hidden="true"><?= e($d['inicial']) ?></div>
                <div><div class="mut-misc-53"><?= e($d['nome']) ?></div><div class="mut-muted-13"><?= e($d['cidade']) ?></div></div>
              </figcaption>
            </figure>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- EMPRESAS CTA -->
      <section class="sec-pad mut-misc-19">
        <div class="mut-container-1240">
          <div class="split mut-misc-27">
            <div class="mut-pos-6"></div>
            <div class="mut-pos-14">
              <h2 class="mut-heading-34-2">Soluções de internet para o seu negócio</h2>
              <p class="mut-misc-48">Link dedicado, IP fixo, SLA e suporte prioritário para empresas que não podem ficar offline.</p>
            </div>
            <div class="mut-pos-16"><a href="empresas.php" class="mut-lift mut-btn-16">Conhecer planos empresariais <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a></div>
          </div>
        </div>
      </section>

      <!-- FAQ -->
      <section class="sec-pad mut-misc-83">
        <div class="mut-container-820">
          <div class="mut-misc-85">
            <div class="mut-eyebrow">Dúvidas frequentes</div>
            <h2 class="mut-heading-38-2">Perguntas frequentes</h2>
          </div>
          <div class="mut-faq-list mut-grid" role="list">
<?php foreach ($faqs as $i => $f): ?>
            <div class="mut-faq-item mut-card-11" role="listitem">
              <button type="button" id="mut-faq-btn-home-<?= $i ?>" class="mut-faq-toggle mut-misc-14" aria-expanded="false" aria-controls="mut-faq-panel-home-<?= $i ?>">
                <?= e($f['q']) ?>
                <span class="mut-faq-icon"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </button>
              <div id="mut-faq-panel-home-<?= $i ?>" class="mut-faq-answer mut-muted-15" role="region" aria-labelledby="mut-faq-btn-home-<?= $i ?>"><?= e($f['a']) ?></div>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- CTA FINAL -->
      <section class="mut-misc-20">
        <div class="mut-container-1240-2">
          <h2 class="mut-heading-42">Pronto para se conectar ao futuro?</h2>
          <p class="mut-muted-17-2">Fibra de verdade, suporte da sua região. Assine em minutos.</p>
          <div class="mut-row-24">
            <a href="planos.php" class="mut-lift mut-btn-19">Assine já</a>
            <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-outline-hover mut-btn-18"><?= mut_icon_whatsapp(19) ?>Falar no WhatsApp</a>
          </div>
        </div>
      </section>

</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
