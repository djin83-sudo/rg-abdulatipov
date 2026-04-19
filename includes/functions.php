<?php
/**
 * includes/functions.php
 * Вспомогательные функции
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/config.php';
}

/**
 * Безопасный вывод текста
 */
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Получить SEO-данные страницы из БД
 */
function getSeoData(string $page_slug): array {
    try {
        $stmt = db()->prepare('SELECT * FROM seo_pages WHERE slug = ? LIMIT 1');
        $stmt->execute([$page_slug]);
        $row = $stmt->fetch();
        if ($row) return $row;
    } catch (Exception $e) {}
    return [
        'title'       => SITE_NAME . ' | ' . $page_slug,
        'description' => SITE_DESCRIPTION,
        'keywords'    => SITE_KEYWORDS,
        'og_image'    => SITE_URL . '/assets/img/og-default.jpg',
    ];
}

/**
 * Получить последние новости
 */
function getLatestNews(int $limit = 5): array {
    try {
        $stmt = db()->prepare(
            'SELECT * FROM news WHERE published = 1 ORDER BY created_at DESC LIMIT ?'
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Фотогалерея
 */
function getGalleryImages(int $limit = 20): array {
    try {
        $stmt = db()->prepare(
            'SELECT * FROM gallery ORDER BY sort_order ASC, id DESC LIMIT ?'
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Формат даты на русском
 */
function formatDateRu(string $date): string {
    $months = [
        1 => 'января', 2 => 'февраля', 3 => 'марта',
        4 => 'апреля', 5 => 'мая', 6 => 'июня',
        7 => 'июля', 8 => 'августа', 9 => 'сентября',
        10 => 'октября', 11 => 'ноября', 12 => 'декабря',
    ];
    $ts = strtotime($date);
    return date('j', $ts) . ' ' . $months[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

/**
 * Безопасный slug из строки
 */
function makeSlug(string $str): string {
    $str = mb_strtolower(trim($str));
    $str = str_replace(
        ['а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
         'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'],
        ['a','b','v','g','d','e','yo','zh','z','i','j','k','l','m','n','o','p',
         'r','s','t','u','f','h','ts','ch','sh','shch','','y','','e','yu','ya'],
        $str
    );
    $str = preg_replace('/[^a-z0-9]+/', '-', $str);
    return trim($str, '-');
}

/**
 * Редирект с кодом 301
 */
function redirect(string $url, int $code = 302): void {
    header('Location: ' . $url, true, $code);
    exit;
}

/**
 * Проверка CSRF-токена
 */
function csrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(): void {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(403);
        die('Ошибка безопасности: неверный CSRF-токен.');
    }
}
