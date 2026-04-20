<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель управления CMS</title>
    <style>
        body { font-family: sans-serif; margin: 0; display: flex; }
        .sidebar { width: 250px; background: #1a365d; color: white; min-height: 100vh; padding: 20px; }
        .content { flex: 1; padding: 40px; background: #f7fafc; }
        .sidebar h2 { margin-bottom: 30px; }
        .nav-link { display: block; color: white; text-decoration: none; padding: 10px 0; border-bottom: 1px solid #2c5282; }
        .nav-link:hover { color: #ebf8ff; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>CMS Admin</h2>
        <nav>
            <a href="index.php" class="nav-link">Рабочий стол</a>
            <a href="news.php" class="nav-link">Новости</a>
            <a href="pages.php" class="nav-link">Страницы</a>
            <a href="gallery.php" class="nav-link">Галерея</a>
            <a href="settings.php" class="nav-link">Настройки</a>
            <a href="logout.php" class="nav-link" style="margin-top: 50px; color: #fc8181;">Выход</a>
        </nav>
    </div>
    <div class="content">
        <h1>Добро пожаловать в панель управления</h1>
        <p>Здесь вы можете управлять контентом персонального сайта Р.Г. Абдулатипова.</p>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Новости</h3>
                <p>Всего: 12</p>
            </div>
            <div class="stat-card">
                <h3>Просмотры</h3>
                <p>За месяц: 1,240</p>
            </div>
            <div class="stat-card">
                <h3>Запросы</h3>
                <p>Новых сообщений: 3</p>
            </div>
        </div>
    </div>
</body>
</html>
