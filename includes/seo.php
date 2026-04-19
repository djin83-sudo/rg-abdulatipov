<?php
/**
 * includes/seo.php
 * Функция вывода SEO-метатегов, Open Graph, Schema.org
 */

function renderSeoHead(array $seo, string $canonical = ''): void {
    $title       = e($seo['title'] ?? SITE_NAME);
    $description = e($seo['description'] ?? SITE_DESCRIPTION);
    $keywords    = e($seo['keywords'] ?? SITE_KEYWORDS);
    $ogImage     = e($seo['og_image'] ?? SITE_URL . '/assets/img/og-default.jpg');
    $url         = $canonical ?: SITE_URL;
    echo "<title>{$title}</title>\n";
    echo '<meta name="description" content="' . $description . '">'. "\n";
    echo '<meta name="keywords" content="' . $keywords . '">'. "\n";
    echo '<link rel="canonical" href="' . e($url) . '">'. "\n";
    // Open Graph
    echo '<meta property="og:type" content="website">'. "\n";
    echo '<meta property="og:title" content="' . $title . '">'. "\n";
    echo '<meta property="og:description" content="' . $description . '">'. "\n";
    echo '<meta property="og:image" content="' . $ogImage . '">'. "\n";
    echo '<meta property="og:url" content="' . e($url) . '">'. "\n";
    echo '<meta property="og:locale" content="ru_RU">'. "\n";
    echo '<meta property="og:site_name" content="' . e(SITE_NAME) . '">'. "\n";
    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">'. "\n";
    echo '<meta name="twitter:title" content="' . $title . '">'. "\n";
    echo '<meta name="twitter:description" content="' . $description . '">'. "\n";
    echo '<meta name="twitter:image" content="' . $ogImage . '">'. "\n";
}

function renderPersonSchema(): void {
    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'Person',
        'name'     => 'Рамзан Гаджимуратович Абдулатипов',
        'honorificPrefix' => 'Герой Труда Российской Федерации',
        'birthDate'  => '1946-08-04',
        'birthPlace' => ['@type'=>'Place','name'=>'с. Гечада, Дагестанская АССР'],
        'nationality' => 'Россия',
        'jobTitle'   => [
            'Государственный деятель',
            'Дипломат',
            'Учёный',
        ],
        'alumniOf'   => 'Дагестанский государственный университет',
        'award'      => [
            'Герой Труда Российской Федерации',
            'Орден За заслуги перед Отечеством IV степени',
        ],
        'url'        => SITE_URL,
        'image'      => SITE_URL . '/assets/img/abdulatipov-portrait.jpg',
        'sameAs'     => [],
    ];
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

function renderBreadcrumbs(array $crumbs): void {
    if (empty($crumbs)) return;
    $schema = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [],
    ];
    foreach ($crumbs as $pos => $crumb) {
        $schema['itemListElement'][] = [
            '@type'    => 'ListItem',
            'position' => $pos + 1,
            'name'     => $crumb['name'],
            'item'     => $crumb['url'],
        ];
    }
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    // HTML хлебные крошки
    echo '<nav aria-label="Хлебные крошки" class="breadcrumbs"><ol>';
    foreach ($crumbs as $i => $crumb) {
        $isLast = ($i === count($crumbs) - 1);
        if ($isLast) {
            echo '<li aria-current="page">' . e($crumb['name']) . '</li>';
        } else {
            echo '<li><a href="' . e($crumb['url']) . '">' . e($crumb['name']) . '</a></li>';
        }
    }
    echo '</ol></nav>' . "\n";
}
