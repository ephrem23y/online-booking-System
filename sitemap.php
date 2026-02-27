<?php
/**
 * XML Sitemap Generator for Google
 * Access: http://localhost/online_bookstore/sitemap.php
 */

require_once 'config.php';

header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Homepage
echo '<url>';
echo '<loc>' . BASE_URL . '</loc>';
echo '<lastmod>' . date('Y-m-d') . '</lastmod>';
echo '<changefreq>daily</changefreq>';
echo '<priority>1.0</priority>';
echo '</url>';

// Static pages
$static_pages = [
    'student/register.php' => ['weekly', '0.8'],
    'student/login.php' => ['weekly', '0.8'],
    'admin/login.php' => ['monthly', '0.5']
];

foreach ($static_pages as $page => $data) {
    echo '<url