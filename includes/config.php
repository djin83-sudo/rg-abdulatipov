<?php
/**
 * includes/config.php
 * Основная конфигурация сайта
 */

// Настройки базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'rg_abdulatipov');
define('DB_USER', 'rg_user');
define('DB_PASS', 'CHANGE_ME_STRONG_PASSWORD');
define('DB_CHARSET', 'utf8mb4');

// Настройки сайта
define('SITE_URL', 'https://rg-abdulatipov.ru');
define('SITE_NAME', 'Рамзан Абдулатипов');
define('SITE_DESCRIPTION', 'Официальный сайт Рамзана Гаджимуратовича Абдулатипова — государственного деятеля, Героя Труда России');
define('SITE_KEYWORDS', 'Абдулатипов, Дагестан, политик, государственный деятель');

// Пути
define('BASE_PATH', dirname(__DIR__));
define('UPLOADS_PATH', BASE_PATH . '/assets/img/uploads');
define('PDF_PATH', BASE_PATH . '/assets/pdf');
define('UPLOADS_URL', SITE_URL . '/assets/img/uploads');

// Администратор
define('ADMIN_LOGIN', 'admin');
// Хэш пароля (bcrypt) — смените при первом входе
// Генерация: php -r "echo password_hash('YOUR_PASSWORD', PASSWORD_BCRYPT);"
define('ADMIN_HASH', '$2y$12$CHANGE_THIS_HASH_IN_CONFIG');

// Режим отладки
define('DEBUG_MODE', false);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Таймзон
date_default_timezone_set('Europe/Moscow');

// Кодировка
if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
}
