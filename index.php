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
      <section style="position:relative; overflow:hidden; border-bottom:1px solid var(--border); background-image:url('assets/hero-mut.png'); background-size:cover; background-position:center 30%; min-height:680px; display:flex; align-items:center;">
        <div style="position:absolute; inset:0; background:linear-gradient(100deg, rgba(6,13,26,.95) 0%, rgba(6,13,26,.86) 26%, rgba(6,13,26,.55) 48%, rgba(6,13,26,.18) 68%, rgba(6,13,26,0) 84%);"></div>
        <div class="hero-grid" style="position:relative; width:100%; max-width:1240px; margin:0 auto; padding:96px 24px 100px; display:block;">
          <div style="max-width:640px;">
            <div style="display:inline-flex; align-items:center; gap:8px; padding:7px 14px; border-radius:999px; background:rgba(255,255,255,.14); color:#fff; font-size:13px; font-weight:600; margin-bottom:20px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0" stroke-linecap="round"/><circle cx="12" cy="19.5" r="1.4" fill="currentColor" stroke="none"/></svg>FIBRA ÓPTICA EM ALAGOAS</div>
            <div style="display:flex; align-items:baseline; gap:12px; margin-bottom:6px;">
              <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:118px; line-height:.9; letter-spacing:-4px; color:#fff;">500</span>
              <span style="font-family:'Archivo',sans-serif; font-weight:700; font-size:28px; color:rgba(255,255,255,.9);">MEGA</span>
            </div>
            <div style="font-size:13px; font-weight:700; letter-spacing:1.5px; color:var(--accent); text-transform:uppercase; margin-bottom:22px;">★ Nosso plano mais assinado</div>
            <h1 class="h1" style="font-family:'Archivo',sans-serif; font-weight:800; font-size:38px; line-height:1.14; letter-spacing:-1.2px; margin:0 0 16px; color:#fff; text-wrap:balance;">A internet que a sua cidade esperava.</h1>
            <p style="font-size:18px; line-height:1.55; color:rgba(255,255,255,.86); margin:0 0 30px; max-width:520px;">Fibra óptica com sinal firme e atendimento de gente da região, em Murici, Messias, Rio Largo e Branquinha.</p>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
              <a href="planos.php" class="mut-lift" style="padding:14px 26px; border-radius:12px; font-weight:700; font-size:15.5px; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; box-shadow:0 10px 26px rgba(195,9,8,.35); transition:transform .18s; text-decoration:none; display:inline-block;">Ver planos e preços</a>
              <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-outline-hover" style="padding:14px 26px; border-radius:12px; font-weight:600; font-size:15.5px; color:#fff; background:rgba(255,255,255,.08); border:1.5px solid rgba(255,255,255,.5); cursor:pointer; display:inline-flex; align-items:center; gap:9px; transition:all .18s; text-decoration:none;"><?= mut_icon_whatsapp() ?>Falar no WhatsApp</a>
            </div>
          </div>
        </div>
      </section>

      <!-- social proof strip -->
      <div style="position:relative; border-bottom:1px solid var(--border); background:var(--surface);">
        <div class="grid-3" style="max-width:1240px; margin:0 auto; padding:22px 24px; display:grid; grid-template-columns:repeat(3,1fr); gap:18px; text-align:center;">
          <div><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:26px; color:var(--primary);">+[X] mil</div><div style="font-size:13.5px; color:var(--muted);">clientes conectados</div></div>
          <div style="border-left:1px solid var(--border); border-right:1px solid var(--border);"><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:26px; color:var(--primary);">[4,8] ★</div><div style="font-size:13.5px; color:var(--muted);">nota no Google</div></div>
          <div><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:26px; color:var(--primary);">100%</div><div style="font-size:13.5px; color:var(--muted);">fibra óptica</div></div>
        </div>
      </div>

      <!-- VERIFICADOR DE COBERTURA -->
      <section style="padding:64px 0; background:var(--primary);">
        <div style="max-width:760px; margin:0 auto; padding:0 24px; text-align:center;">
          <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:32px; letter-spacing:-1px; margin:0 0 12px; color:#fff;">Veja se a MUT já chegou na sua rua</h2>
          <p style="font-size:16px; color:rgba(255,255,255,.85); margin:0 0 28px;">Digite seu CEP ou cidade e descubra na hora.</p>
          <form id="mut-coverage-form" style="background:var(--background); border-radius:18px; padding:18px; box-shadow:0 20px 50px rgba(0,0,0,.25); max-width:560px; margin:0 auto;">
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
              <input id="mut-coverage-input" class="mut-input" placeholder="Digite seu CEP ou cidade" aria-label="CEP ou cidade" style="flex:1; min-width:180px; padding:14px 16px; border-radius:12px; border:1.5px solid var(--border); background:var(--surface); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
              <button type="submit" id="mut-coverage-submit" style="padding:14px 22px; border-radius:12px; font-weight:700; font-size:15px; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; display:inline-flex; align-items:center; gap:8px; white-space:nowrap; transition:transform .18s;">
                <span id="mut-coverage-spinner" class="hidden" aria-hidden="true" style="width:16px; height:16px; border:2px solid rgba(255,255,255,.4); border-top-color:#fff; border-radius:50%; animation:mutSpin .7s linear infinite; display:inline-block;"></span>
                Verificar cobertura
              </button>
            </div>
            <div id="mut-coverage-yes" class="hidden" role="status" aria-live="polite" style="margin-top:14px; padding:13px 15px; border-radius:12px; background:rgba(31,138,91,.12); color:#1f8a5b; font-weight:600; font-size:14.5px; display:flex; align-items:center; gap:9px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>Boa notícia! Temos cobertura na sua região 🎉</div>
            <div id="mut-coverage-no" class="hidden" role="status" aria-live="polite" style="margin-top:14px; padding:13px 15px; border-radius:12px; background:rgba(195,9,8,.10); color:var(--accent); font-weight:600; font-size:14.5px; display:flex; align-items:center; gap:9px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4M12 17h.01"/><circle cx="12" cy="12" r="9"/></svg>Ainda não chegamos aí — deixe seu contato e avisamos você.</div>
          </form>
        </div>
      </section>

      <!-- DIFERENCIAIS -->
      <section class="sec-pad" style="padding:96px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div style="text-align:center; max-width:640px; margin:0 auto 52px;">
            <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">POR DENTRO DA MUT</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:40px; letter-spacing:-1.2px; margin:0 0 14px; text-wrap:balance;">O que muda quando o provedor é daqui</h2>
            <p style="font-size:16px; line-height:1.55; color:var(--muted); margin:0;">Estrutura de fibra própria, equipe na rua e atendimento que conhece o nome da sua rua.</p>
          </div>
          <div class="grid-3" style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;">
            <div class="mut-card-hover" style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
              <div style="width:50px; height:50px; border-radius:14px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:18px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1.2" fill="currentColor"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px; margin:0 0 8px;">Fibra até dentro de casa</h3>
              <p style="font-size:14.5px; line-height:1.5; color:var(--muted); margin:0;">Sem cabo velho no meio do caminho: sinal firme do poste à sua sala.</p>
            </div>
            <div class="mut-card-hover" style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
              <div style="width:50px; height:50px; border-radius:14px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:18px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8.5C5 6 9 4.5 12 4.5s7 1.5 10 4M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1.2" fill="currentColor"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px; margin:0 0 8px;">Wi-Fi que alcança a casa toda</h3>
              <p style="font-size:14.5px; line-height:1.5; color:var(--muted); margin:0;">Roteador moderno incluso e configurado na instalação.</p>
            </div>
            <div class="mut-card-hover" style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
              <div style="width:50px; height:50px; border-radius:14px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:18px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px; margin:0 0 8px;">Instalado em até 48h</h3>
              <p style="font-size:14.5px; line-height:1.5; color:var(--muted); margin:0;">Nossa equipe é daqui, então a visita não demora.</p>
            </div>
            <div class="mut-card-hover" style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
              <div style="width:50px; height:50px; border-radius:14px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:18px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h1a2 2 0 0 1 2 2zM3 19a2 2 0 0 0 2 2h1v-7H5a2 2 0 0 0-2 2z"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px; margin:0 0 8px;">Atendimento com gente de verdade</h3>
              <p style="font-size:14.5px; line-height:1.5; color:var(--muted); margin:0;">Fala com quem mora na região, sem menu automático.</p>
            </div>
            <div class="mut-card-hover" style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
              <div style="width:50px; height:50px; border-radius:14px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:18px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px; margin:0 0 8px;">A conta que você combinou</h3>
              <p style="font-size:14.5px; line-height:1.5; color:var(--muted); margin:0;">Preço fixo, sem taxa escondida na fatura.</p>
            </div>
            <div class="mut-card-hover" style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
              <div style="width:50px; height:50px; border-radius:14px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:18px;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="3"/><path d="M11 18h2"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px; margin:0 0 8px;">Resolva pelo celular</h3>
              <p style="font-size:14.5px; line-height:1.5; color:var(--muted); margin:0;">2ª via, suporte e upgrade de plano no seu aparelho.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- COBERTURA (mapa) -->
      <section class="sec-pad" style="padding:90px 0;">
        <div class="split" style="max-width:1240px; margin:0 auto; padding:0 24px; display:grid; grid-template-columns:1fr 1.05fr; gap:48px; align-items:center;">
          <div>
            <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Cobertura própria</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:36px; letter-spacing:-1.1px; margin:0 0 14px; text-wrap:balance;">Nossa fibra já está desenhada no mapa de Alagoas</h2>
            <p style="font-size:16px; line-height:1.55; color:var(--muted); margin:0 0 28px; max-width:460px;">Cada ponto no mapa é rua atendida pela MUT. Acompanhe o avanço da nossa rede pelas cidades da região.</p>
            <div class="grid-3" style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:28px;">
              <div style="background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:18px; text-align:center;"><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:24px; color:var(--primary);">4</div><div style="font-size:12px; color:var(--muted); margin-top:4px;">cidades atendidas</div></div>
              <div style="background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:18px; text-align:center;"><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:24px; color:var(--primary);">+[X] mil</div><div style="font-size:12px; color:var(--muted); margin-top:4px;">clientes conectados</div></div>
              <div style="background:var(--surface); border:1px solid var(--border); border-radius:16px; padding:18px; text-align:center;"><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:24px; color:var(--primary);">100%</div><div style="font-size:12px; color:var(--muted); margin-top:4px;">fibra óptica</div></div>
            </div>
            <div style="display:flex; align-items:center; gap:18px; flex-wrap:wrap;">
              <div style="display:flex; align-items:center; gap:7px; font-size:13px; color:var(--muted);"><span style="width:10px; height:10px; border-radius:50%; background:var(--primary); display:inline-block;"></span>Área com fibra MUT</div>
              <div style="display:flex; align-items:center; gap:7px; font-size:13px; color:var(--muted);"><span style="width:10px; height:10px; border-radius:50%; background:#ff0000; display:inline-block;"></span>Ponto de rede ativo</div>
            </div>
            <a href="cobertura.php" style="margin-top:26px; padding:13px 24px; border-radius:12px; font-weight:700; font-size:14.5px; color:#fff; background:var(--primary); border:none; cursor:pointer; text-decoration:none; display:inline-block;">Verificar cobertura completa</a>
          </div>
          <div style="background:var(--surface); border:1px solid var(--border); border-radius:26px; padding:24px; box-shadow:var(--shadow-sm);">
            <img src="assets/mapa-cobertura.svg" alt="Mapa de cobertura da MUT em Alagoas" style="width:100%; height:auto; display:block;">
          </div>
        </div>
      </section>

      <!-- PLANOS -->
      <section class="sec-pad" style="padding:96px 0; background:var(--surface); border-top:1px solid var(--border); border-bottom:1px solid var(--border);">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div style="text-align:center; max-width:640px; margin:0 auto 34px;">
            <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">NOSSOS PLANOS</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:40px; letter-spacing:-1.2px; margin:0 0 14px; text-wrap:balance;">Escolha a velocidade que a sua casa precisa</h2>
            <p style="font-size:16px; color:var(--muted); margin:0;">Todos os planos com Wi-Fi incluso, instalação gratuita e suporte local.</p>
          </div>
<?php mut_render_plan_toggle('var(--background)'); ?>
          <div id="mut-plan-panel-residencial" role="tabpanel" aria-labelledby="mut-plan-tab-residencial" class="mut-plan-group grid-4 is-visible" data-plan-group="residencial" style="grid-template-columns:repeat(4,1fr); gap:20px; align-items:stretch;">
<?php foreach ($residentialPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <div id="mut-plan-panel-empresarial" role="tabpanel" aria-labelledby="mut-plan-tab-empresarial" class="mut-plan-group grid-3" data-plan-group="empresarial" style="grid-template-columns:repeat(3,1fr); gap:20px; align-items:stretch;">
<?php foreach ($businessPlans as $plan) mut_render_plan_card($plan); ?>
          </div>
          <p style="text-align:center; font-size:13px; color:var(--muted); margin-top:26px;">Valores e velocidades são placeholders — substituir pelos planos reais. Consulte condições e disponibilidade por endereço.</p>
        </div>
      </section>

      <!-- COMBOS / PARCEIROS -->
      <section class="sec-pad" style="padding:80px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px; text-align:center;">
          <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:30px; letter-spacing:-1px; margin:0 0 8px;">Sua internet com seus apps favoritos</h2>
          <p style="font-size:15.5px; color:var(--muted); margin:0 0 36px;">Combos de streaming e parceiros para assistir, ouvir e jogar sem limites.</p>
          <div class="grid-3" style="display:grid; grid-template-columns:repeat(6,1fr); gap:16px;">
<?php foreach ($partners as $p): ?>
            <div style="aspect-ratio:16/9; border-radius:14px; border:1px dashed var(--border); background:repeating-linear-gradient(45deg,var(--surface),var(--surface) 8px,transparent 8px,transparent 16px); display:flex; align-items:center; justify-content:center; font-family:ui-monospace,monospace; font-size:11px; color:var(--muted);"><?= e($p) ?></div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

<!-- COBERTURA -->
      <section class="sec-pad" style="padding:96px 0; background:var(--primary);">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div style="text-align:center; max-width:640px; margin:0 auto 44px;">
            <div style="font-size:14px; font-weight:700; color:#fff; opacity:.8; letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Cobertura</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:38px; letter-spacing:-1.2px; margin:0 0 16px; color:#fff; text-wrap:balance;">Já estamos na sua cidade</h2>
            <p style="font-size:16px; line-height:1.55; color:rgba(255,255,255,.85); margin:0;">Cobertura própria em quatro cidades de Alagoas — e crescendo.</p>
          </div>
          <div class="grid-4" style="display:grid; grid-template-columns:repeat(4,1fr); gap:18px;">
<?php foreach ($cidades as $c): ?>
            <div style="background:var(--background); border-radius:22px; padding:28px 22px; text-align:center;">
              <div style="width:46px; height:46px; margin:0 auto 16px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="2.5"/></svg></div>
              <div style="font-weight:700; font-size:18px; font-family:'Archivo',sans-serif; color:var(--foreground);"><?= e($c) ?></div>
              <div style="font-size:13px; color:var(--muted); margin:6px 0 18px;">[X] bairros atendidos</div>
              <a href="cobertura.php" style="padding:10px 18px; border-radius:10px; font-weight:600; font-size:13.5px; color:var(--primary); background:var(--soft); border:none; cursor:pointer; width:100%; text-decoration:none; display:block; text-align:center;">Ver cobertura</a>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- COMO FUNCIONA -->
      <section class="sec-pad" style="padding:96px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div style="text-align:center; max-width:640px; margin:0 auto 52px;">
            <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Passo a passo</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:40px; letter-spacing:-1.2px; margin:0;">Conectar é simples</h2>
          </div>
          <div class="grid-4" style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;">
            <div style="text-align:center; padding:8px;"><div style="width:58px; height:58px; margin:0 auto 18px; border-radius:50%; background:var(--primary); color:#fff; font-family:'Archivo',sans-serif; font-weight:800; font-size:22px; display:flex; align-items:center; justify-content:center;">1</div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0 0 7px;">Escolha seu plano</h3><p style="font-size:14px; color:var(--muted); margin:0; line-height:1.5;">Compare as velocidades e ache a ideal.</p></div>
            <div style="text-align:center; padding:8px;"><div style="width:58px; height:58px; margin:0 auto 18px; border-radius:50%; background:var(--primary); color:#fff; font-family:'Archivo',sans-serif; font-weight:800; font-size:22px; display:flex; align-items:center; justify-content:center;">2</div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0 0 7px;">Verifique a cobertura</h3><p style="font-size:14px; color:var(--muted); margin:0; line-height:1.5;">Confirme que chegamos no seu endereço.</p></div>
            <div style="text-align:center; padding:8px;"><div style="width:58px; height:58px; margin:0 auto 18px; border-radius:50%; background:var(--primary); color:#fff; font-family:'Archivo',sans-serif; font-weight:800; font-size:22px; display:flex; align-items:center; justify-content:center;">3</div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0 0 7px;">Agende a instalação</h3><p style="font-size:14px; color:var(--muted); margin:0; line-height:1.5;">Escolha o melhor dia e horário pra você.</p></div>
            <div style="text-align:center; padding:8px;"><div style="width:58px; height:58px; margin:0 auto 18px; border-radius:50%; background:var(--accent); color:#fff; font-family:'Archivo',sans-serif; font-weight:800; font-size:22px; display:flex; align-items:center; justify-content:center;">4</div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0 0 7px;">Conecte-se ao futuro</h3><p style="font-size:14px; color:var(--muted); margin:0; line-height:1.5;">Pronto! É só aproveitar a sua fibra.</p></div>
          </div>
        </div>
      </section>

      <!-- DEPOIMENTOS -->
      <section class="sec-pad" style="padding:96px 0; background:var(--surface); border-top:1px solid var(--border); border-bottom:1px solid var(--border);">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div style="text-align:center; max-width:640px; margin:0 auto 52px;">
            <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Depoimentos</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:40px; letter-spacing:-1.2px; margin:0;">Quem é MUT, recomenda</h2>
          </div>
          <div class="grid-3" role="list" style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;">
<?php foreach ($depoimentos as $d): ?>
            <figure role="listitem" style="background:var(--background); border:1px solid var(--border); border-radius:22px; padding:28px; box-shadow:var(--shadow-sm); margin:0;">
              <div role="img" aria-label="Avaliação 5 de 5 estrelas" style="display:flex; gap:3px; margin-bottom:16px;">
                <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623" stroke="none"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="17" height="17" fill="#f5a623"><path d="M12 2l3 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.9 21l1.2-6.8-5-4.9 6.9-1z"/></svg>
              </div>
              <blockquote style="font-size:15.5px; line-height:1.6; margin:0 0 22px; color:var(--foreground);">"<?= e($d['texto']) ?>"</blockquote>
              <figcaption style="display:flex; align-items:center; gap:13px;">
                <div aria-hidden="true" style="width:46px; height:46px; border-radius:50%; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; font-family:'Archivo',sans-serif; font-weight:700; font-size:17px;"><?= e($d['inicial']) ?></div>
                <div><div style="font-weight:700; font-size:14.5px;"><?= e($d['nome']) ?></div><div style="font-size:13px; color:var(--muted);"><?= e($d['cidade']) ?></div></div>
              </figcaption>
            </figure>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- EMPRESAS CTA -->
      <section class="sec-pad" style="padding:80px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div class="split" style="background:linear-gradient(135deg, var(--primary), #062f6e); border-radius:28px; padding:52px; display:grid; grid-template-columns:1.4fr 1fr; gap:32px; align-items:center; color:#fff; box-shadow:0 30px 70px rgba(10,68,154,.3); position:relative; overflow:hidden;">
            <div style="position:absolute; top:-60px; right:-30px; width:240px; height:240px; border-radius:50%; background:rgba(255,255,255,.06);"></div>
            <div style="position:relative;">
              <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:34px; letter-spacing:-1px; margin:0 0 12px;">Soluções de internet para o seu negócio</h2>
              <p style="font-size:16px; line-height:1.55; opacity:.9; margin:0; max-width:480px;">Link dedicado, IP fixo, SLA e suporte prioritário para empresas que não podem ficar offline.</p>
            </div>
            <div style="position:relative; display:flex; justify-content:flex-start;"><a href="empresas.php" class="mut-lift" style="padding:15px 28px; border-radius:13px; font-weight:700; font-size:15.5px; color:var(--primary); background:#fff; border:none; cursor:pointer; display:inline-flex; align-items:center; gap:9px; transition:transform .18s; text-decoration:none;">Conhecer planos empresariais <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a></div>
          </div>
        </div>
      </section>

      <!-- FAQ -->
      <section class="sec-pad" style="padding:96px 0; background:var(--surface); border-top:1px solid var(--border);">
        <div style="max-width:820px; margin:0 auto; padding:0 24px;">
          <div style="text-align:center; margin-bottom:46px;">
            <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Dúvidas frequentes</div>
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:38px; letter-spacing:-1.2px; margin:0;">Perguntas frequentes</h2>
          </div>
          <div class="mut-faq-list" role="list" style="display:grid; gap:12px;">
<?php foreach ($faqs as $i => $f): ?>
            <div class="mut-faq-item" role="listitem" style="background:var(--background); border:1px solid var(--border); border-radius:16px; overflow:hidden;">
              <button type="button" id="mut-faq-btn-home-<?= $i ?>" class="mut-faq-toggle" aria-expanded="false" aria-controls="mut-faq-panel-home-<?= $i ?>" style="width:100%; display:flex; align-items:center; justify-content:space-between; gap:16px; padding:20px 22px; background:transparent; border:none; cursor:pointer; text-align:left; font-family:'Archivo',sans-serif; font-weight:600; font-size:16.5px; color:var(--foreground);">
                <?= e($f['q']) ?>
                <span class="mut-faq-icon"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span>
              </button>
              <div id="mut-faq-panel-home-<?= $i ?>" class="mut-faq-answer" role="region" aria-labelledby="mut-faq-btn-home-<?= $i ?>" style="padding:0 22px 20px; font-size:15px; line-height:1.6; color:var(--muted);"><?= e($f['a']) ?></div>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- CTA FINAL -->
      <section style="padding:90px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px; text-align:center;">
          <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:42px; letter-spacing:-1.5px; margin:0 0 14px; text-wrap:balance;">Pronto para se conectar ao futuro?</h2>
          <p style="font-size:17px; color:var(--muted); margin:0 0 30px;">Fibra de verdade, suporte da sua região. Assine em minutos.</p>
          <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap;">
            <a href="planos.php" class="mut-lift" style="padding:15px 30px; border-radius:13px; font-weight:700; font-size:16px; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; box-shadow:0 8px 22px rgba(195,9,8,.3); transition:transform .18s; text-decoration:none;">Assine já</a>
            <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-outline-hover" style="padding:15px 30px; border-radius:13px; font-weight:600; font-size:16px; color:var(--foreground); background:transparent; border:1.5px solid var(--border); cursor:pointer; display:inline-flex; align-items:center; gap:9px; transition:all .18s; text-decoration:none;"><?= mut_icon_whatsapp(19) ?>Falar no WhatsApp</a>
          </div>
        </div>
      </section>

</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
