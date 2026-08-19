<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Área do Cliente — MUT Telecom';
$pageDescription = 'Acesse suas faturas, plano e suporte na Área do Cliente da MUT Telecom.';

$faturas = mut_faturas_mock();

require __DIR__ . '/includes/header.php';
?>
<div>
      <section id="mut-logged-out" style="padding:72px 0; min-height:60vh; display:flex; align-items:center;">
        <div style="max-width:440px; margin:0 auto; padding:0 24px; width:100%;">
          <div style="text-align:center; margin-bottom:28px;">
            <div style="position:relative; display:inline-block; font-family:'Archivo',sans-serif; font-weight:800; font-size:32px; letter-spacing:-1.5px; color:var(--primary); line-height:1;">MUT<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="15" height="15" fill="var(--accent)" style="position:absolute; top:-9px; right:-8px;"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg></div>
            <h1 style="font-family:'Archivo',sans-serif; font-weight:700; font-size:24px; margin:18px 0 6px;">Área do Cliente</h1>
            <p style="font-size:14.5px; color:var(--muted); margin:0;">Acesse suas faturas, plano e suporte.</p>
          </div>
          <form id="mut-login-form" novalidate style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:28px; display:grid; gap:16px;">
            <div>
              <label for="mut-login-cpf" style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">CPF</label>
              <input id="mut-login-cpf" name="cpf" autocomplete="username" class="mut-input" placeholder="000.000.000-00" aria-describedby="mut-login-error" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
            </div>
            <div>
              <label for="mut-login-senha" style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Senha</label>
              <input id="mut-login-senha" type="password" name="senha" autocomplete="current-password" class="mut-input" placeholder="••••••••" aria-describedby="mut-login-error" style="width:100%; padding:13px 15px; border-radius:11px; border:1.5px solid var(--border); background:var(--background); color:var(--foreground); font-size:15px; font-family:inherit; outline:none;">
            </div>
            <div id="mut-login-error" class="hidden" role="alert" style="font-size:13px; color:var(--accent); font-weight:600;"></div>
            <button type="submit" style="padding:14px; border-radius:12px; font-weight:700; font-size:15.5px; color:#fff; background:var(--primary); border:none; cursor:pointer;">Entrar</button>
            <div style="text-align:center; font-size:12px; color:var(--muted); font-family:ui-monospace,monospace;">// autenticação mockada — integração futura via API</div>
          </form>
        </div>
      </section>
      <section id="mut-logged-in" class="hidden sec-pad" style="padding:48px 0 80px;">
        <div style="max-width:1100px; margin:0 auto; padding:0 24px;">
          <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:center; justify-content:space-between; margin-bottom:32px;">
            <div><h1 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:30px; letter-spacing:-1px; margin:0;">Olá, cliente 👋</h1><p style="font-size:14.5px; color:var(--muted); margin:6px 0 0;">Bem-vindo à sua área MUT.</p></div>
            <button type="button" id="mut-logout" class="mut-outline-hover" style="padding:11px 18px; border-radius:11px; font-weight:600; font-size:14px; color:var(--foreground); background:var(--surface); border:1px solid var(--border); cursor:pointer;">Sair</button>
          </div>
          <div class="grid-3" style="display:grid; grid-template-columns:1.2fr 1fr 1fr; gap:18px; margin-bottom:28px;">
            <div style="background:linear-gradient(135deg, var(--primary), #062f6e); color:#fff; border-radius:20px; padding:26px;"><div style="font-size:12.5px; opacity:.85; text-transform:uppercase; letter-spacing:1px;">Plano atual</div><div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:30px; margin:8px 0 2px;">MUT 500 Mega</div><div style="font-size:14px; opacity:.9;">R$ 99,90/mês · próxima fatura 10/06/2026</div></div>
            <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;"><div style="font-size:12.5px; color:var(--muted); text-transform:uppercase; letter-spacing:1px;">Status da conexão</div><div style="display:flex; align-items:center; gap:10px; margin-top:14px;"><span style="width:11px; height:11px; border-radius:50%; background:#1f8a5b; box-shadow:0 0 0 4px rgba(31,138,91,.18);"></span><span style="font-family:'Archivo',sans-serif; font-weight:700; font-size:18px;">Online</span></div><div style="font-size:13px; color:var(--muted); margin-top:8px;">Sinal estável</div></div>
            <div style="background:var(--surface); border:1px solid var(--border); border-radius:20px; padding:26px;"><div style="font-size:12.5px; color:var(--muted); text-transform:uppercase; letter-spacing:1px;">Suporte</div><a href="ajuda.php" style="margin-top:14px; padding:11px 16px; border-radius:11px; font-weight:600; font-size:14px; color:var(--primary); background:var(--soft); border:none; cursor:pointer; width:100%; text-decoration:none; display:block; text-align:center; box-sizing:border-box;">Abrir chamado</a></div>
          </div>
          <div role="table" aria-label="Minhas faturas" style="background:var(--background); border:1px solid var(--border); border-radius:18px; overflow:hidden;">
            <div style="padding:18px 22px; border-bottom:1px solid var(--border); font-family:'Archivo',sans-serif; font-weight:700; font-size:17px;">Minhas faturas</div>
            <div role="row" style="display:grid; grid-template-columns:1.1fr 1fr 1fr 1fr; gap:8px; padding:14px 22px; background:var(--surface); border-bottom:1px solid var(--border); font-size:12.5px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.4px;"><div role="columnheader">Vencimento</div><div role="columnheader">Valor</div><div role="columnheader">Status</div><div role="columnheader" style="text-align:right;">Ação</div></div>
<?php foreach ($faturas as $b): ?>
            <div role="row" style="display:grid; grid-template-columns:1.1fr 1fr 1fr 1fr; gap:8px; padding:16px 22px; border-bottom:1px solid var(--border); align-items:center; font-size:14.5px;"><div role="cell" style="font-weight:600;"><?= e($b['venc']) ?></div><div role="cell" style="font-family:'Archivo',sans-serif; font-weight:700;"><?= e($b['valor']) ?></div><div role="cell"><span style="font-size:12px; font-weight:700; padding:5px 11px; border-radius:999px; color:<?= e($b['cor']) ?>; background:<?= e($b['bg']) ?>;"><?= e($b['status']) ?></span></div><div role="cell" style="text-align:right;"><a href="segunda-via.php" aria-label="Ver 2ª via da fatura de <?= e($b['venc']) ?>" style="padding:7px 13px; border-radius:9px; border:1px solid var(--border); background:var(--surface); color:var(--primary); font-size:12.5px; font-weight:600; cursor:pointer; text-decoration:none;">2ª via</a></div></div>
<?php endforeach; ?>
          </div>
          <div style="margin-top:18px; font-size:12px; color:var(--muted); font-family:ui-monospace,monospace;">// dashboard e faturas mockados — integração futura via API</div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
