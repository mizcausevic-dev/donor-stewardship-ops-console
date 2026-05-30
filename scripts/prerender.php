<?php

declare(strict_types=1);

require __DIR__ . '/../src/Services/DonorStewardshipOpsConsoleService.php';
require __DIR__ . '/../src/Views/render.php';

$root = dirname(__DIR__);
$site = $root . '/site';

if (is_dir($site)) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($site, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($iterator as $item) {
        if ($item->isDir()) {
            rmdir($item->getPathname());
        } else {
            unlink($item->getPathname());
        }
    }
}

if (! is_dir($site) && ! mkdir($site, 0777, true) && ! is_dir($site)) {
    throw new RuntimeException('Failed to create site directory.');
}

$apiDir = $site . '/api/dashboard/summary';
if (! is_dir($apiDir) && ! mkdir($apiDir, 0777, true) && ! is_dir($apiDir)) {
    throw new RuntimeException('Failed to create API directory.');
}

$service = new DonorStewardshipOpsConsole\Services\DonorStewardshipOpsConsoleService();

$pages = [
    'index.html' => DonorStewardshipOpsConsole\Views\render_overview(),
    'donor-lane/index.html' => DonorStewardshipOpsConsole\Views\render_donor_lane(),
    'stewardship-queue/index.html' => DonorStewardshipOpsConsole\Views\render_stewardship_queue(),
    'pledge-posture/index.html' => DonorStewardshipOpsConsole\Views\render_pledge_posture(),
    'verification/index.html' => DonorStewardshipOpsConsole\Views\render_verification(),
    'docs/index.html' => DonorStewardshipOpsConsole\Views\render_docs(),
];

foreach ($pages as $file => $html) {
    $target = $site . '/' . $file;
    $dir = dirname($target);
    if (! is_dir($dir) && ! mkdir($dir, 0777, true) && ! is_dir($dir)) {
        throw new RuntimeException('Failed to create page directory: ' . $dir);
    }
    file_put_contents($target, $html);
}

$payloads = [
    $site . '/api/dashboard/summary/index.json' => $service->summary(),
    $site . '/api/donor-lane.json' => $service->donorLanes(),
    $site . '/api/stewardship-queue.json' => $service->stewardshipQueue(),
    $site . '/api/verification.json' => $service->verificationGates(),
    $site . '/api/sample.json' => $service->payload(),
];

foreach ($payloads as $file => $payload) {
    $dir = dirname($file);
    if (! is_dir($dir) && ! mkdir($dir, 0777, true) && ! is_dir($dir)) {
        throw new RuntimeException('Failed to create payload directory: ' . $dir);
    }

    file_put_contents($file, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

file_put_contents($site . '/CNAME', trim((string) file_get_contents($root . '/CNAME')));

$domain = trim((string) file_get_contents($root . '/CNAME'));
$today = gmdate('Y-m-d');

file_put_contents(
    $site . '/robots.txt',
    "User-agent: *\nAllow: /\nSitemap: https://{$domain}/sitemap.xml\n"
);

$urls = [
    "https://{$domain}/",
    "https://{$domain}/donor-lane/",
    "https://{$domain}/stewardship-queue/",
    "https://{$domain}/pledge-posture/",
    "https://{$domain}/verification/",
    "https://{$domain}/docs/",
];

$sitemap = [
    '<?xml version="1.0" encoding="UTF-8"?>',
    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
];

foreach ($urls as $url) {
    $sitemap[] = "  <url><loc>{$url}</loc><lastmod>{$today}</lastmod></url>";
}

$sitemap[] = '</urlset>';

file_put_contents($site . '/sitemap.xml', implode("\n", $sitemap) . "\n");
