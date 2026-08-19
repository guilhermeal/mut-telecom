<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Planos empresariais — MUT Telecom';
$pageDescription = 'Internet dedicada para empresas em Alagoas: link dedicado, IP fixo, SLA e suporte prioritário com a MUT Telecom.';

$businessPlans = mut_plans_with_links(mut_business_plans());

require __DIR__ . '/includes/header.php';
?>
<div data-screen-label="Empresas">
      <section style="position:relative; overflow:hidden; background:linear-gradient(135deg, var(--primary), #062f6e); color:#fff; padding:80px 0;">
        <div style="position:absolute; top:-60px; right:-40px; width:280px; height:280px; border-radius:50%; background:rgba(255,255,255,.06);"></div>
        <div style="position:relative; max-width:1240px; margin:0 auto; padding:0 24px; max-width:760px;">
          <div style="display:inline-flex; align-items:center; gap:8px; padding:7px 14px; border-radius:999px; background:rgba(255,255,255,.14); font-size:13px; font-weight:600; margin-bottom:20px;">MUT Empresas</div>
          <h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:48px; letter-spacing:-1.6px; margin:0 0 16px; line-height:1.05;">Internet que não pode parar o seu negócio</h1>
          <p style="font-size:18px; line-height:1.55; opacity:.9; margin:0 0 28px; max-width:560px;">Link dedicado, IP fixo, SLA e suporte prioritário para empresas de Alagoas que dependem de conexão estável.</p>
          <a href="contato.php" style="padding:15px 28px; border-radius:13px; font-weight:700; font-size:15.5px; color:var(--primary); background:#fff; border:none; cursor:pointer; text-decoration:none; display:inline-block;">Falar com um consultor</a>
        </div>
      </section>
      <section class="sec-pad" style="padding:72px 0;">
        <div style="max-width:1240px; margin:0 auto; padding:0 24px;">
          <div class="grid-4" style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:60px;">
            <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;"><div style="width:48px; height:48px; border-radius:13px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:16px;"><svg viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><path d="M6 10v4M10 10v4"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:16.5px; margin:0 0 7px;">Link dedicado</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">Banda garantida, simétrica, só para a sua empresa.</p></div>
            <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;"><div style="width:48px; height:48px; border-radius:13px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:16px;"><svg viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M2 12h20M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:16.5px; margin:0 0 7px;">IP fixo</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">Ideal para servidores, câmeras e acesso remoto.</p></div>
            <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;"><div style="width:48px; height:48px; border-radius:13px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:16px;"><svg viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:16.5px; margin:0 0 7px;">SLA garantido</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">Acordo de nível de serviço com prazos de reparo.</p></div>
            <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;"><div style="width:48px; height:48px; border-radius:13px; background:var(--soft); color:var(--primary); display:flex; align-items:center; justify-content:center; margin-bottom:16px;"><svg viewBox="0 0 24 24" width="23" height="23" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1v-7h1a2 2 0 0 1 2 2zM3 19a2 2 0 0 0 2 2h1v-7H5a2 2 0 0 0-2 2z"/></svg></div><h3 style="font-family:'Archivo',sans-serif; font-size:16.5px; margin:0 0 7px;">Suporte prioritário</h3><p style="font-size:13.5px; color:var(--muted); margin:0; line-height:1.5;">Atendimento dedicado e gerente de conta.</p></div>
          </div>
          <h2 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:32px; letter-spacing:-1px; margin:0 0 28px; text-align:center;">Planos empresariais</h2>
          <div class="grid-3" style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; align-items:stretch;">
<?php foreach ($businessPlans as $plan): ?>
            <div style="position:relative; background:var(--background); border:1px solid var(--border); border-radius:24px; padding:30px 26px; display:flex; flex-direction:column; box-shadow:var(--shadow-sm);">
<?php if ($plan['destaque']): ?>
              <div style="position:absolute; inset:0; border:2px solid var(--accent); border-radius:24px; pointer-events:none;"></div>
              <div style="position:absolute; top:-13px; left:50%; transform:translateX(-50%); background:var(--accent); color:#fff; font-size:12px; font-weight:700; padding:6px 16px; border-radius:999px; white-space:nowrap;">★ Recomendado</div>
<?php endif; ?>
              <div style="font-family:'Archivo',sans-serif; font-weight:700; font-size:16px; color:var(--muted);"><?= e($plan['nome']) ?></div>
              <div style="display:flex; align-items:baseline; gap:6px; margin:10px 0 4px;"><span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:44px; line-height:1; letter-spacing:-2px; color:var(--primary);"><?= e($plan['vel']) ?></span><span style="font-size:17px; font-weight:600;"><?= e($plan['unit']) ?></span></div>
              <div style="display:flex; align-items:baseline; gap:3px; margin-top:14px; padding-bottom:18px; border-bottom:1px solid var(--border);"><span style="font-size:15px; color:var(--muted);">R$</span><span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:28px;"><?= e($plan['preco']) ?></span><span style="font-size:14px; color:var(--muted);">/mês</span></div>
              <div style="display:grid; gap:11px; margin:20px 0 22px;">
<?php foreach ($plan['features'] as $feat): ?>
                <div style="display:flex; align-items:center; gap:10px; font-size:14px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M20 6L9 17l-5-5"/></svg><?= e($feat) ?></div>
<?php endforeach; ?>
              </div>
              <a href="contato.php" style="margin-top:auto; padding:13px; border-radius:12px; font-weight:700; font-size:14.5px; color:#fff; background:var(--primary); border:none; cursor:pointer; text-decoration:none; text-align:center; display:block;">Solicitar proposta</a>
            </div>
<?php endforeach; ?>
          </div>
          <p style="text-align:center; font-size:13px; color:var(--muted); margin-top:24px;">Valores placeholder — proposta personalizada conforme a necessidade da empresa.</p>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
