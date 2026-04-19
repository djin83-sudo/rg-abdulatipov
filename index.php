<?php
/**
 * index.php - Главная страница
 */

session_start();
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo.php';

$seo = getSeoData('home');
$isHome = true;
$bodyClass = 'page-home';
$canonical = SITE_URL;
$latestNews = getLatestNews(3);

require_once __DIR__ . '/includes/header.php';
?>

<main class="main-content" role="main">
  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-image">
          <img src="/assets/img/abdulatipov-hero.jpg" alt="Рамзан Гаджимуратович Абдулатипов" width="600" height="800">
        </div>
        <div class="hero-text">
          <h1>Рамзан Гаджимуратович Абдулатипов</h1>
          <p class="hero-subtitle">Государственный деятель, Герой Труда России, дипломат, учёный</p>
          <p class="hero-description">
            Бывший Глава Республики Дагестан (2013—2017),
            член Совета Федерации, заместитель Председателя Правительства РФ,
            полномочный представитель России при СНГ.
          </p>
          <div class="hero-actions">
            <a href="/biography/" class="btn btn-primary">Биография</a>
            <a href="/contacts/" class="btn btn-outline">Контакты</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Достижения -->
  <section class="achievements section">
    <div class="container">
      <h2 class="section-title">Ключевые достижения</h2>
      <div class="achievements-grid">
        <div class="achievement-card">
          <h3>Герой Труда России</h3>
          <p>2018 г. — За многолетнюю плодотворную деятельность на благо России</p>
        </div>
        <div class="achievement-card">
          <h3>Глава Республики Дагестан</h3>
          <p>2013—2017 гг. — Руководство республикой, укрепление стабильности</p>
        </div>
        <div class="achievement-card">
          <h3>Дипломатическая деятельность</h3>
          <p>Посол России в Таджикистане, полномочный представитель при СНГ</p>
        </div>
        <div class="achievement-card">
          <h3>Научная деятельность</h3>
          <p>Доктор философских наук, автор более 150 научных трудов</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Новости -->
  <?php if (!empty($latestNews)): ?>
  <section class="news section">
    <div class="container">
      <h2 class="section-title">Последние новости</h2>
      <div class="news-grid">
        <?php foreach ($latestNews as $news): ?>
        <article class="news-card">
          <time datetime="<?= e($news['created_at']) ?>"><?= formatDateRu($news['created_at']) ?></time>
          <h3><a href="/publications/#news-<?= e($news['id']) ?>"><?= e($news['title']) ?></a></h3>
          <p><?= e(mb_substr($news['content'], 0, 120)) ?>...</p>
        </article>
        <?php endforeach; ?>
      </div>
      <a href="/publications/" class="btn btn-outline">Все публикации</a>
    </div>
  </section>
  <?php endif; ?>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
