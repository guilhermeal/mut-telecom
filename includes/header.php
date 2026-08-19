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
<link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
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
  <header class="mut-pos-22" id="mut-header">
    <nav class="mut-misc-64" aria-label="Navegação principal">
      <!-- logo -->
      <a class="mut-row-15" href="index.php" aria-label="MUT Telecom — página inicial">
        <div class="mut-heading-27" aria-hidden="true">MUT<svg class="mut-pos-9" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="var(--accent)"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg></div>
        <div class="hide-xs mut-muted-85" aria-hidden="true">CONECTADOS<br>AO FUTURO</div>
      </a>
      <!-- center links -->
      <div class="nav-desktop mut-row-18">
<?php foreach (mut_main_nav_items() as $navItem): ?>
        <?php mut_render_nav_link($navItem['href'], $navItem['label'], 'mut-nav-link'); ?>
<?php endforeach; ?>
      </div>
      <!-- right actions -->
      <div class="nav-desktop mut-row-10">
        <a href="segunda-via.php" class="mut-btn-outline mut-btn-21"<?= mut_nav_current('segunda-via.php') ?>>2ª via de boleto</a>
        <a href="area-do-cliente.php" class="mut-client-link mut-misc-43"<?= mut_nav_current('area-do-cliente.php') ?>>Área do Cliente</a>
        <?php mut_render_theme_toggle_button('mut-theme-toggle', withTransition: true); ?>
        <a href="planos.php" class="mut-cta-accent mut-btn-8">Assine já</a>
      </div>
      <!-- mobile burger -->
      <div class="nav-burger mut-misc-39">
        <?php mut_render_theme_toggle_button('mut-theme-toggle-mobile', withTransition: false); ?>
        <button class="mut-card-29" type="button" id="mut-drawer-open" aria-label="Abrir menu" aria-haspopup="dialog" aria-expanded="false" aria-controls="mut-drawer"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 6h18M3 12h18M3 18h18"/></svg></button>
      </div>
    </nav>
  </header>

  <!-- ============ MOBILE DRAWER ============ -->
  <div id="mut-drawer" class="hidden mut-pos-13" role="dialog" aria-modal="true" aria-label="Menu de navegação">
    <div class="mut-pos-11">
      <div class="mut-row-27">
        <div class="mut-heading-22-2" aria-hidden="true">MUT</div>
        <button class="mut-card-28" type="button" id="mut-drawer-close" aria-label="Fechar menu"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
      </div>
      <nav class="mut-row-20" aria-label="Menu mobile">
<?php foreach (mut_main_nav_items() as $navItem): ?>
        <?php mut_render_nav_link($navItem['href'], $navItem['label'], 'mut-drawer-link'); ?>
<?php endforeach; ?>
      </nav>
      <div class="mut-misc-54" role="separator"></div>
      <a href="segunda-via.php" class="mut-btn-10"<?= mut_nav_current('segunda-via.php') ?>>2ª via de boleto</a>
      <a href="area-do-cliente.php" class="mut-misc-71"<?= mut_nav_current('area-do-cliente.php') ?>>Área do Cliente</a>
      <a class="mut-btn-4" href="planos.php">Assine já</a>
    </div>
  </div>

  <main id="main-content">
