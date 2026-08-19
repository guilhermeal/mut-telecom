<?php
/**
 * Cabeçalho comum: <head>, abertura do <body>, navbar e drawer mobile.
 * Cada página define $pageTitle e $pageDescription antes de incluir este arquivo.
 */

declare(strict_types=1);

require_once __DIR__ . '/data.php';

$pageTitle = $pageTitle ?? 'MUT Telecom — Fibra óptica em Alagoas';
$pageDescription = $pageDescription ?? 'Internet de fibra óptica em Murici, Messias, Rio Largo e Branquinha, com atendimento local e suporte de verdade.';

/** Página atual, usada para marcar o link ativo do menu com aria-current. */
$mutCurrentPage = basename($_SERVER['SCRIPT_NAME'] ?? '');

/**
 * Retorna 'page' quando $file é a página atual, para uso em aria-current.
 */
function mut_nav_current(string $file): string
{
    global $mutCurrentPage;
    return $mutCurrentPage === $file ? ' aria-current="page"' : '';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($pageDescription) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<script>
  /* Aplica o tema salvo antes da primeira pintura, evitando flash de tela clara/escura. */
  (function () {
    try {
      var saved = localStorage.getItem('mut-theme');
      var dark = saved ? saved === 'dark' : (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
      if (dark) document.documentElement.classList.add('mut-dark-pending');
    } catch (e) {}
  })();
</script>
</head>
<body>
<script>
  if (document.documentElement.classList.contains('mut-dark-pending')) {
    document.body.classList.add('dark');
    document.documentElement.classList.remove('mut-dark-pending');
  }
</script>

  <a href="#main-content" class="mut-skip-link">Pular para o conteúdo principal</a>

  <!-- ============ NAVBAR ============ -->
  <header id="mut-header" style="position:sticky; top:0; z-index:50; background:var(--nav-bg); backdrop-filter:saturate(180%) blur(14px); -webkit-backdrop-filter:saturate(180%) blur(14px); border-bottom:1px solid var(--border); transition:box-shadow .3s ease;">
    <nav aria-label="Navegação principal" style="max-width:1240px; margin:0 auto; padding:0 24px; height:74px; display:flex; align-items:center; justify-content:space-between; gap:20px;">
      <!-- logo -->
      <a href="index.php" aria-label="MUT Telecom — página inicial" style="display:flex; align-items:center; gap:11px; cursor:pointer; flex-shrink:0; text-decoration:none;">
        <div style="position:relative; font-family:'Archivo',sans-serif; font-weight:800; font-size:27px; letter-spacing:-1.5px; color:var(--primary); line-height:1;" aria-hidden="true">MUT<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="var(--accent)" style="position:absolute; top:-9px; right:-7px;"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg></div>
        <div class="hide-xs" aria-hidden="true" style="font-family:'Archivo',sans-serif; font-size:8.5px; font-weight:600; letter-spacing:2.5px; color:var(--muted); line-height:1; padding-top:9px;">CONECTADOS<br>AO FUTURO</div>
      </a>
      <!-- center links -->
      <div class="nav-desktop" style="display:flex; align-items:center; gap:6px;">
        <a href="planos.php" class="mut-nav-link" style="padding:9px 13px; border-radius:9px; font-size:15px; font-weight:500; color:var(--foreground); cursor:pointer; transition:background .15s; text-decoration:none;"<?= mut_nav_current('planos.php') ?>>Planos</a>
        <a href="cobertura.php" class="mut-nav-link" style="padding:9px 13px; border-radius:9px; font-size:15px; font-weight:500; color:var(--foreground); cursor:pointer; transition:background .15s; text-decoration:none;"<?= mut_nav_current('cobertura.php') ?>>Cobertura</a>
        <a href="empresas.php" class="mut-nav-link" style="padding:9px 13px; border-radius:9px; font-size:15px; font-weight:500; color:var(--foreground); cursor:pointer; transition:background .15s; text-decoration:none;"<?= mut_nav_current('empresas.php') ?>>Para Empresas</a>
        <a href="sobre.php" class="mut-nav-link" style="padding:9px 13px; border-radius:9px; font-size:15px; font-weight:500; color:var(--foreground); cursor:pointer; transition:background .15s; text-decoration:none;"<?= mut_nav_current('sobre.php') ?>>Sobre</a>
        <a href="ajuda.php" class="mut-nav-link" style="padding:9px 13px; border-radius:9px; font-size:15px; font-weight:500; color:var(--foreground); cursor:pointer; transition:background .15s; text-decoration:none;"<?= mut_nav_current('ajuda.php') ?>>Ajuda</a>
      </div>
      <!-- right actions -->
      <div class="nav-desktop" style="display:flex; align-items:center; gap:10px;">
        <a href="segunda-via.php" class="mut-btn-outline" style="padding:8px 14px; border-radius:10px; font-size:13.5px; font-weight:600; color:var(--primary); border:1.5px solid var(--primary); cursor:pointer; white-space:nowrap; transition:all .15s; text-decoration:none;"<?= mut_nav_current('segunda-via.php') ?>>2ª via de boleto</a>
        <a href="area-do-cliente.php" class="mut-client-link" style="font-size:14px; font-weight:500; color:var(--muted); cursor:pointer; white-space:nowrap; padding:6px; text-decoration:none;"<?= mut_nav_current('area-do-cliente.php') ?>>Área do Cliente</a>
        <button type="button" id="mut-theme-toggle" class="mut-theme-btn" aria-label="Ativar tema escuro" aria-pressed="false" style="width:40px; height:40px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border); background:var(--surface); color:var(--foreground); cursor:pointer; transition:all .15s;">
          <svg class="theme-icon-sun" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg class="theme-icon-moon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
        </button>
        <a href="planos.php" class="mut-cta-accent" style="padding:11px 20px; border-radius:11px; font-size:14.5px; font-weight:700; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; box-shadow:0 6px 18px rgba(195,9,8,.28); transition:transform .18s, box-shadow .18s; text-decoration:none; display:inline-block;">Assine já</a>
      </div>
      <!-- mobile burger -->
      <div class="nav-burger" style="display:none; align-items:center; gap:8px;">
        <button type="button" id="mut-theme-toggle-mobile" class="mut-theme-btn" aria-label="Ativar tema escuro" aria-pressed="false" style="width:40px; height:40px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border); background:var(--surface); color:var(--foreground); cursor:pointer;">
          <svg class="theme-icon-sun" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg class="theme-icon-moon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
        </button>
        <button type="button" id="mut-drawer-open" aria-label="Abrir menu" aria-haspopup="dialog" aria-expanded="false" aria-controls="mut-drawer" style="width:42px; height:42px; display:inline-flex; align-items:center; justify-content:center; border-radius:10px; border:1px solid var(--border); background:var(--surface); color:var(--foreground); cursor:pointer;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg></button>
      </div>
    </nav>
  </header>

  <!-- ============ MOBILE DRAWER ============ -->
  <div id="mut-drawer" class="hidden" role="dialog" aria-modal="true" aria-label="Menu de navegação" style="position:fixed; inset:0; z-index:60; background:rgba(8,14,26,.5); backdrop-filter:blur(2px);">
    <div style="position:absolute; top:0; right:0; height:100%; width:min(82vw,340px); background:var(--background); border-left:1px solid var(--border); padding:22px; display:flex; flex-direction:column; gap:6px; box-shadow:-20px 0 60px rgba(0,0,0,.25);">
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
        <div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:22px; letter-spacing:-1px; color:var(--primary);" aria-hidden="true">MUT</div>
        <button type="button" id="mut-drawer-close" aria-label="Fechar menu" style="width:38px; height:38px; border-radius:9px; border:1px solid var(--border); background:var(--surface); color:var(--foreground); cursor:pointer; display:inline-flex; align-items:center; justify-content:center;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
      </div>
      <nav aria-label="Menu mobile" style="display:flex; flex-direction:column; gap:6px;">
        <a href="planos.php" class="mut-drawer-link" style="padding:13px 12px; border-radius:11px; font-weight:600; color:var(--foreground); cursor:pointer; text-decoration:none;"<?= mut_nav_current('planos.php') ?>>Planos</a>
        <a href="cobertura.php" class="mut-drawer-link" style="padding:13px 12px; border-radius:11px; font-weight:600; color:var(--foreground); cursor:pointer; text-decoration:none;"<?= mut_nav_current('cobertura.php') ?>>Cobertura</a>
        <a href="empresas.php" class="mut-drawer-link" style="padding:13px 12px; border-radius:11px; font-weight:600; color:var(--foreground); cursor:pointer; text-decoration:none;"<?= mut_nav_current('empresas.php') ?>>Para Empresas</a>
        <a href="sobre.php" class="mut-drawer-link" style="padding:13px 12px; border-radius:11px; font-weight:600; color:var(--foreground); cursor:pointer; text-decoration:none;"<?= mut_nav_current('sobre.php') ?>>Sobre</a>
        <a href="ajuda.php" class="mut-drawer-link" style="padding:13px 12px; border-radius:11px; font-weight:600; color:var(--foreground); cursor:pointer; text-decoration:none;"<?= mut_nav_current('ajuda.php') ?>>Ajuda</a>
      </nav>
      <div style="height:1px; background:var(--border); margin:10px 0;" role="separator"></div>
      <a href="segunda-via.php" style="padding:13px 12px; border-radius:11px; font-weight:600; color:var(--primary); border:1.5px solid var(--primary); text-align:center; cursor:pointer; text-decoration:none;"<?= mut_nav_current('segunda-via.php') ?>>2ª via de boleto</a>
      <a href="area-do-cliente.php" style="padding:13px 12px; border-radius:11px; font-weight:500; color:var(--muted); text-align:center; cursor:pointer; text-decoration:none;"<?= mut_nav_current('area-do-cliente.php') ?>>Área do Cliente</a>
      <a href="planos.php" style="margin-top:6px; padding:14px; border-radius:11px; font-weight:700; color:var(--accent-fg); background:var(--accent); border:none; cursor:pointer; text-align:center; text-decoration:none; display:block;">Assine já</a>
    </div>
  </div>

  <main id="main-content">
