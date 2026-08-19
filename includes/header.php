<?php
/**
 * Cabeçalho comum: <head>, abertura do <body>, navbar e drawer mobile.
 * Cada página define $pageTitle e $pageDescription antes de incluir este arquivo.
 */

declare(strict_types=1);

require_once __DIR__ . '/data.php';

$pageTitle = $pageTitle ?? 'MUT Telecom — Fibra óptica em Alagoas';
$pageDescription = $pageDescription ?? 'Internet de fibra óptica em Murici, Messias, Rio Largo e Branquinha, com atendimento local e suporte de verdade.';

/**
 * Página atual sem extensão (ex.: 'planos'), usada para marcar o link ativo do
 * menu com aria-current — as URLs públicas não têm mais ".php" (ver .htaccess).
 */
$mutCurrentPage = preg_replace('/\.php$/', '', basename($_SERVER['SCRIPT_NAME'] ?? ''));

/** URL canônica e imagem de preview social (absolutas, para OG/Twitter/JSON-LD). */
$mutCanonicalUrl = MUT_SITE_URL . ($mutCurrentPage === 'index' || $mutCurrentPage === '' ? '/' : '/' . $mutCurrentPage);
$mutOgImageUrl = MUT_SITE_URL . '/assets/og-image.jpg';

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
<meta name="geo.region" content="BR-AL">
<meta name="geo.placename" content="Alagoas">
<link rel="canonical" href="<?= e($mutCanonicalUrl) ?>">

<!-- Favicons (assets/favicon/) -->
<link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
<link rel="shortcut icon" href="assets/favicon/favicon.ico">
<link rel="manifest" href="assets/favicon/manifest.json">
<meta name="msapplication-config" content="assets/favicon/browserconfig.xml">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!-- Open Graph (Facebook, WhatsApp, LinkedIn, etc.) -->
<meta property="og:site_name" content="MUT Telecom">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($pageDescription) ?>">
<meta property="og:url" content="<?= e($mutCanonicalUrl) ?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="pt_BR">
<meta property="og:image" content="<?= e($mutOgImageUrl) ?>">
<meta property="og:image:secure_url" content="<?= e($mutOgImageUrl) ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="MUT Telecom — fibra óptica em Alagoas">

<!-- Twitter/X Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($pageTitle) ?>">
<meta name="twitter:description" content="<?= e($pageDescription) ?>">
<meta name="twitter:image" content="<?= e($mutOgImageUrl) ?>">

<!-- Dados estruturados LocalBusiness (schema.org) -->
<script type="application/ld+json"><?= json_encode(mut_local_business_jsonld(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>

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
      <a class="mut-row-15" href="/" aria-label="MUT Telecom — página inicial">
        <img src="assets/MUT_full_logo.png" alt="" class="mut-logo mut-logo--nav">
      </a>
      <!-- center links -->
      <div class="nav-desktop mut-row-18">
<?php foreach (mut_main_nav_items() as $navItem): ?>
        <?php mut_render_nav_link($navItem['href'], $navItem['label'], 'mut-nav-link'); ?>
<?php endforeach; ?>
      </div>
      <!-- right actions -->
      <div class="nav-desktop mut-row-10">
        <a href="segunda-via" class="mut-btn-outline mut-btn-21"<?= mut_nav_current('segunda-via') ?>>2ª via de boleto</a>
        <a href="area-do-cliente" class="mut-client-link mut-misc-43"<?= mut_nav_current('area-do-cliente') ?>>Área do Cliente</a>
        <?php mut_render_theme_toggle_button('mut-theme-toggle', withTransition: true); ?>
        <a href="planos" class="mut-cta-accent mut-btn-8">Assine já</a>
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
        <img src="assets/MUT_full_logo.png" alt="MUT Telecom" class="mut-logo mut-logo--sm">
        <button class="mut-card-28" type="button" id="mut-drawer-close" aria-label="Fechar menu"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
      </div>
      <nav class="mut-row-20" aria-label="Menu mobile">
<?php foreach (mut_main_nav_items() as $navItem): ?>
        <?php mut_render_nav_link($navItem['href'], $navItem['label'], 'mut-drawer-link'); ?>
<?php endforeach; ?>
      </nav>
      <div class="mut-misc-54" role="separator"></div>
      <a href="segunda-via" class="mut-btn-10"<?= mut_nav_current('segunda-via') ?>>2ª via de boleto</a>
      <a href="area-do-cliente" class="mut-misc-71"<?= mut_nav_current('area-do-cliente') ?>>Área do Cliente</a>
      <a class="mut-btn-4" href="planos">Assine já</a>
    </div>
  </div>

  <main id="main-content">
