<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
require_once 'includes/seo.php';

$pageTitle = 'Фотогалерея';
$pageDescription = 'Фотографии и архивные снимки Рамзана Абдулатипова: официальные встречи, рабочие поездки и личный архив';
$pageKeywords = 'Абдулатипов фото, галерея, архивные фото, Дагестан, официальные встречи';

include 'includes/header.php';
?>

<main class="container">
    <section class="gallery-page">
        <h1>Фотогалерея</h1>
        
        <div class="gallery-grid">
            <div class="gallery-item">
                <div class="placeholder-img">Фото: Официальные встречи</div>
                <p>Официальные встречи и приемы</p>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Фото: Рабочие поездки</div>
                <p>Рабочие поездки по районам Дагестана</p>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Фото: Культурные мероприятия</div>
                <p>Участие в культурных и просветительских форумах</p>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Фото: Научная деятельность</div>
                <p>Выступления в университетах и академиях</p>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Фото: Из личного архива</div>
                <p>Снимки из личного и семейного архива</p>
            </div>
            <div class="gallery-item">
                <div class="placeholder-img">Фото: Творческие вечера</div>
                <p>Презентации книг и творческие встречи</p>
            </div>
        </div>

        <style>
            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 20px;
                margin-top: 30px;
            }
            .gallery-item {
                background: #f4f4f4;
                border: 1px solid #ddd;
                padding: 10px;
                text-align: center;
            }
            .placeholder-img {
                width: 100%;
                height: 200px;
                background: #2c3e50;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }
        </style>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
