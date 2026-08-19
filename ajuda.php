<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Central de Ajuda — MUT Telecom';
$pageDescription = 'Tire dúvidas sobre conexão, Wi-Fi, faturas, contrato e mais na Central de Ajuda da MUT Telecom.';

$faqs = mut_faqs();

require __DIR__ . '/includes/header.php';
?>
<div data-screen-label="Ajuda">
      <section style="padding:64px 0 48px; background:linear-gradient(135deg, var(--primary), #062f6e); color:#fff; text-align:center;">
        <div style="max-width:720px; margin:0 auto; padding:0 24px;">
          <h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:44px; letter-spacing:-1.6px; margin:0 0 22px;">Como podemos ajudar?</h1>
          <div style="position:relative; max-width:560px; margin:0 auto;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--muted)" stroke-width="2" stroke-linecap="round" style="position:absolute; left:18px; top:50%; transform:translateY(-50%);"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
            <input placeholder="Busque por um tema (ex.: instalação, boleto, Wi-Fi)" style="width:100%; padding:16px 18px 16px 48px; border-radius:14px; border:none; background:#fff; color:#131313; font-size:15.5px; font-family:inherit; outline:none; box-shadow:0 10px 30px rgba(0,0,0,.2);">
          </div>
        </div>
      </section>
      <section class="sec-pad" style="padding:56px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div class="grid-3" style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:56px;">
            <div style="display:flex; flex-direction:column; gap:10px; padding:24px; border-radius:18px; background:var(--surface); border:1px solid var(--border);"><div style="width:44px; height:44px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center;"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1.2" fill="currentColor"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0;">Conexão e Wi-Fi</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">Resolver lentidão, reiniciar o roteador, melhorar o sinal.</p></div>
            <div style="display:flex; flex-direction:column; gap:10px; padding:24px; border-radius:18px; background:var(--surface); border:1px solid var(--border);"><div style="width:44px; height:44px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center;"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0;">Faturas e pagamento</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">2ª via, Pix, boleto, datas de vencimento.</p></div>
            <div style="display:flex; flex-direction:column; gap:10px; padding:24px; border-radius:18px; background:var(--surface); border:1px solid var(--border);"><div style="width:44px; height:44px; border-radius:12px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center;"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:17px; margin:0;">Conta e contrato</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">Mudança de plano, endereço, cancelamento.</p></div>
          </div>
          <!-- atalhos -->
          <div class="grid-3" style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:56px;">
            <a href="segunda-via.php" class="mut-outline-hover-2" style="display:flex; align-items:center; gap:12px; padding:18px; border-radius:14px; background:var(--background); border:1.5px solid var(--border); cursor:pointer; text-align:left; font-family:inherit; transition:border-color .18s; text-decoration:none; color:inherit;"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/></svg><span style="font-weight:600; font-size:14.5px;">2ª via de boleto</span></a>
            <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-outline-hover-2" style="display:flex; align-items:center; gap:12px; padding:18px; border-radius:14px; background:var(--background); border:1.5px solid var(--border); cursor:pointer; transition:border-color .18s; text-decoration:none; color:inherit;"><svg viewBox="0 0 24 24" width="20" height="20" fill="#25d366"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg><span style="font-weight:600; font-size:14.5px;">Falar no WhatsApp</span></a>
            <a href="area-do-cliente.php" class="mut-outline-hover-2" style="display:flex; align-items:center; gap:12px; padding:18px; border-radius:14px; background:var(--background); border:1.5px solid var(--border); cursor:pointer; text-align:left; font-family:inherit; transition:border-color .18s; text-decoration:none; color:inherit;"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg><span style="font-weight:600; font-size:14.5px;">Área do Cliente</span></a>
          </div>
          <div style="max-width:820px; margin:0 auto;">
            <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:28px; letter-spacing:-1px; margin:0 0 24px; text-align:center;">Perguntas frequentes</h2>
            <div class="mut-faq-list" style="display:grid; gap:12px;">
<?php foreach ($faqs as $f): ?>
              <div class="mut-faq-item" style="background:var(--surface); border:1px solid var(--border); border-radius:16px; overflow:hidden;">
                <button type="button" class="mut-faq-toggle" style="width:100%; display:flex; align-items:center; justify-content:space-between; gap:16px; padding:20px 22px; background:transparent; border:none; cursor:pointer; text-align:left; font-family:'Archivo',sans-serif; font-weight:600; font-size:16.5px; color:var(--foreground);"><?= e($f['q']) ?><span class="mut-faq-icon"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="var(--primary)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg></span></button>
                <div class="mut-faq-answer" style="padding:0 22px 20px; font-size:15px; line-height:1.6; color:var(--muted);"><?= e($f['a']) ?></div>
              </div>
<?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
