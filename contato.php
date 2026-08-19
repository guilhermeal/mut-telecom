<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Contato — MUT Telecom';
$pageDescription = 'Fale com a MUT Telecom por WhatsApp, telefone, e-mail ou formulário. Tire dúvidas, peça orçamento ou agende sua instalação.';

require __DIR__ . '/includes/header.php';
?>
<div data-screen-label="Contato">
      <section style="padding:64px 0 36px; background:var(--surface); border-bottom:1px solid var(--border); text-align:center;">
        <div style="max-width:760px; margin:0 auto; padding:0 24px;">
          <div style="font-size:14px; font-weight:700; color:var(--accent); letter-spacing:.5px; text-transform:uppercase; margin-bottom:12px;">Contato</div>
          <h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:46px; letter-spacing:-1.6px; margin:0 0 14px;">Fale com a gente</h1>
          <p style="font-size:17px; color:var(--muted); margin:0; line-height:1.55;">Tire dúvidas, peça orçamento ou agende sua instalação. Respondemos rapidinho.</p>
        </div>
      </section>
      <section class="sec-pad" style="padding:56px 0 80px;">
        <div class="split" style="max-width:1240px; margin:0 auto; padding:0 24px; display:grid; grid-template-columns:1.3fr 1fr; gap:40px; align-items:start;">
          <!-- form -->
          <div style="background:var(--surface); border:1px solid var(--border); border-radius:22px; padding:32px;">
            <div id="mut-contact-success" class="hidden" style="text-align:center; padding:40px 16px;">
              <div style="width:64px; height:64px; margin:0 auto 20px; border-radius:50%; background:rgba(31,138,91,.14); color:#1f8a5b; display:flex; align-items:center; justify-content:center;"><svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>
              <h3 style="font-family:'Archivo',sans-serif; font-size:24px; margin:0 0 10px;">Mensagem enviada!</h3>
              <p style="font-size:15px; color:var(--muted); margin:0;">Recebemos seu contato e retornaremos em breve. Obrigado!</p>
            </div>
            <form id="mut-contact-form" style="display:grid; gap:18px;">
              <div>
                <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Nome completo</label>
                <input name="nome" class="mut-input" placeholder="Seu nome" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
                <div id="mut-err-nome" class="hidden" style="font-size:12.5px; color:var(--accent); margin-top:6px;"></div>
              </div>
              <div class="grid-2" style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                <div>
                  <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Telefone / WhatsApp</label>
                  <input name="tel" class="mut-input" placeholder="(82) 9 9999-9999" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
                  <div id="mut-err-tel" class="hidden" style="font-size:12.5px; color:var(--accent); margin-top:6px;"></div>
                </div>
                <div>
                  <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Cidade</label>
                  <select name="cidade" class="mut-input" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
                    <option value="">Selecione...</option><option value="Murici">Murici</option><option value="Messias">Messias</option><option value="Rio Largo">Rio Largo</option><option value="Branquinha">Branquinha</option>
                  </select>
                  <div id="mut-err-cidade" class="hidden" style="font-size:12.5px; color:var(--accent); margin-top:6px;"></div>
                </div>
              </div>
              <div>
                <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Assunto</label>
                <select name="assunto" class="mut-input" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
                  <option>Contratar plano</option><option>Suporte técnico</option><option>Financeiro / 2ª via</option><option>Planos empresariais</option><option>Outro assunto</option>
                </select>
              </div>
              <div>
                <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Mensagem</label>
                <textarea name="mensagem" class="mut-input" placeholder="Como podemos ajudar?" rows="4" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none; resize:vertical;"></textarea>
                <div id="mut-err-mensagem" class="hidden" style="font-size:12.5px; color:var(--accent); margin-top:6px;"></div>
              </div>
              <button type="submit" class="mut-lift" style="padding:15px; border-radius:12px; font-weight:700; font-size:15.5px; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; transition:transform .18s;">Enviar mensagem</button>
            </form>
          </div>
          <!-- contact cards -->
          <div style="display:grid; gap:14px;">
            <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-lift" style="display:flex; align-items:center; gap:14px; padding:20px; border-radius:16px; background:var(--surface); border:1px solid var(--border); cursor:pointer; transition:transform .18s; text-decoration:none; color:inherit;"><div style="width:44px; height:44px; border-radius:12px; background:rgba(37,211,102,.14); color:#25d366; display:flex; align-items:center; justify-content:center; flex-shrink:0;"><svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg></div><div><div style="font-weight:700; font-family:'Archivo',sans-serif; font-size:15px;">WhatsApp</div><div style="font-size:13.5px; color:var(--muted);">(82) 9 9999-9999</div></div></a>
            <div style="display:flex; align-items:center; gap:14px; padding:20px; border-radius:16px; background:var(--surface); border:1px solid var(--border);"><div style="width:44px; height:44px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; flex-shrink:0;"><svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg></div><div><div style="font-weight:700; font-family:'Archivo',sans-serif; font-size:15px;">Telefone</div><div style="font-size:13.5px; color:var(--muted);">(82) 3000-0000</div></div></div>
            <div style="display:flex; align-items:center; gap:14px; padding:20px; border-radius:16px; background:var(--surface); border:1px solid var(--border);"><div style="width:44px; height:44px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; flex-shrink:0;"><svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg></div><div><div style="font-weight:700; font-family:'Archivo',sans-serif; font-size:15px;">E-mail</div><div style="font-size:13.5px; color:var(--muted);">contato@muttelecom.com.br</div></div></div>
            <div style="display:flex; align-items:flex-start; gap:14px; padding:20px; border-radius:16px; background:var(--surface); border:1px solid var(--border);"><div style="width:44px; height:44px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; flex-shrink:0;"><svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="2.5"/></svg></div><div><div style="font-weight:700; font-family:'Archivo',sans-serif; font-size:15px;">Endereço</div><div style="font-size:13.5px; color:var(--muted);">[Av. Principal, 000 — Centro, Murici/AL]</div></div></div>
            <div style="aspect-ratio:16/10; border-radius:16px; border:1px dashed var(--border); background:repeating-linear-gradient(45deg,var(--surface),var(--surface) 10px,transparent 10px,transparent 20px); display:flex; align-items:center; justify-content:center; font-family:ui-monospace,monospace; font-size:12px; color:var(--muted);">mapa do Google (incorporar)</div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
