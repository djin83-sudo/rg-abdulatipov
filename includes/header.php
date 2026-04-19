<?php
/**
 * includes/header.php
 * Шаблон шапки сайта
 */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php renderSeoHead($seo ?? [], $canonical ?? ''); ?>
<?php if (isset($isHome) && $isHome): ?>
<?php renderPersonSchema(); ?>
<?php endif; ?>
<!-- Favicons -->
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<!-- CSS -->
<link rel="preload" href="/assets/css/style.css" as="style">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="<?= $bodyClass ?? 'page' ?>">

<header class="site-header" role="banner">
  <div class="container">
    <div class="header-inner">
      <a class="site-logo" href="/" aria-label="На главную">
        <span class="logo-monogram">РА</span>
        <span class="logo-text">
          <strong>Рамзан Абдулатипов</strong>
          <em>Государственный деятель &bull; Герой Труда России</em>
        </span>
      </a>

      <button class="nav-toggle" aria-label="Меню" aria-expanded="false" aria-controls="main-nav">
        <span></span><span></span><span></span>
      </button>

      <nav id="main-nav" class="main-nav" role="navigation" aria-label="Основное меню">
        <ul>
          <li><a href="/" <?= (($_SERVER['REQUEST_URI'] === '/') ? 'aria-current="page"' : '') ?>>На главную</a></li>
          <li><a href="/biography/" <?= (strpos($_SERVER['REQUEST_URI'], '/biography') !== false ? 'aria-current="page"' : '') ?>>Биография</a></li>
          <li><a href="/activities/" <?= (strpos($_SERVER['REQUEST_URI'], '/activities') !== false ? 'aria-current="page"' : '') ?>>Деятельность</a></li>
          <li><a href="/publications/" <?= (strpos($_SERVER['REQUEST_URI'], '/publications') !== false ? 'aria-current="page"' : '') ?>>Публикации</a></li>
          <li><a href="/gallery/" <?= (strpos($_SERVER['REQUEST_URI'], '/gallery') !== false ? 'aria-current="page"' : '') ?>>Галерея</a></li>
          <li><a href="/contacts/" <?= (strpos($_SERVER['REQUEST_URI'], '/contacts') !== false ? 'aria-current="page"' : '') ?>>Контакты</a></li>
          <li><a href="/assets/pdf/buklet.pdf" class="btn-buklet" target="_blank" rel="noopener">Скачать буклет</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>
