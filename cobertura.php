<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Cobertura — MUT Telecom';
$pageDescription = 'Veja se a fibra óptica da MUT Telecom já chegou até você em Murici, Messias, Rio Largo ou Branquinha.';

require __DIR__ . '/includes/header.php';
?>
<div data-screen-label="Cobertura">
      <section style="padding:64px 0 36px; background:var(--surface); border-bottom:1px solid var(--border); text-align:center;">
        <div style="max-width:760px; margin:0 auto; padding:0 24px;">
          <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Cobertura</div>
          <h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:46px; letter-spacing:-1.6px; margin:0 0 14px;">Veja se já chegamos até você</h1>
          <p style="font-size:17px; color:var(--muted); margin:0; line-height:1.55;">Fibra óptica em Murici, Messias, Rio Largo e Branquinha — e expandindo.</p>
        </div>
      </section>
      <section class="sec-pad" style="padding:56px 0 64px;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div style="position:relative; background:var(--surface); border:1px solid var(--border); border-radius:24px; padding:36px; display:flex; flex-direction:column; align-items:center; justify-content:center;">
            <div style="width:100%; max-width:760px; margin:0 auto;">
              <img src="assets/alagoas-full.svg" alt="Mapa do estado de Alagoas com a área de cobertura da MUT" style="width:100%; height:auto; display:block;">
            </div>
            <div style="margin-top:18px; font-size:12px; color:var(--muted); text-align:center;">Mapa do estado de Alagoas — regiões atendidas em destaque</div>
          </div>
        </div>
      </section>

      <!-- viabilidade por e-mail -->
      <section class="sec-pad" style="padding:20px 0 80px;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div class="split" style="background:var(--surface); border:1px solid var(--border); border-radius:24px; padding:36px; display:grid; grid-template-columns:1fr 1.1fr; gap:36px; align-items:center;">
            <div>
              <div style="width:48px; height:48px; border-radius:13px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:16px;"><svg viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg></div>
              <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:26px; letter-spacing:-.8px; margin:0 0 10px;">Ainda não tem certeza? Peça uma análise de viabilidade</h2>
              <p style="font-size:14.5px; line-height:1.55; color:var(--muted); margin:0;">Envie seu endereço completo por e-mail e nossa equipe técnica confirma a viabilidade de instalação na sua região.</p>
            </div>
            <div>
              <div id="mut-viab-success" class="hidden" style="text-align:center; padding:28px 16px;">
                <div style="width:56px; height:56px; margin:0 auto 16px; border-radius:50%; background:rgba(31,138,91,.14); color:#1f8a5b; display:flex; align-items:center; justify-content:center;"><svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>
                <h3 style="font-family:'Archivo',sans-serif; font-size:19px; margin:0 0 6px;">Pedido enviado!</h3>
                <p style="font-size:14px; color:var(--muted); margin:0;">Vamos analisar e responder no e-mail informado.</p>
              </div>
              <form id="mut-viab-form" style="display:grid; gap:14px;">
                <div>
                  <input name="email" type="email" class="mut-input" placeholder="Seu e-mail" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
                  <div id="mut-viab-err-email" class="hidden" style="font-size:12.5px; color:var(--accent); margin-top:6px;"></div>
                </div>
                <div>
                  <input name="endereco" class="mut-input" placeholder="Endereço completo (rua, número, bairro, cidade)" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
                  <div id="mut-viab-err-endereco" class="hidden" style="font-size:12.5px; color:var(--accent); margin-top:6px;"></div>
                </div>
                <button type="submit" class="mut-lift" style="padding:14px; border-radius:11px; font-weight:700; font-size:15px; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; transition:transform .18s;">Solicitar análise de viabilidade</button>
              </form>
            </div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
