<?php

declare(strict_types=1);

use DonorStewardshipOpsConsole\Services\DonorStewardshipOpsConsoleService;

require __DIR__ . '/../src/Services/DonorStewardshipOpsConsoleService.php';
require __DIR__ . '/../src/Views/render.php';

$service = new DonorStewardshipOpsConsoleService();
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if (str_starts_with($path, '/api/')) {
    header('Content-Type: application/json; charset=utf-8');

    $payload = match ($path) {
        '/api/dashboard/summary' => $service->summary(),
        '/api/donor-lane' => $service->donorLanes(),
        '/api/stewardship-queue' => $service->stewardshipQueue(),
        '/api/verification' => $service->verificationGates(),
        '/api/sample' => $service->payload(),
        default => ['error' => 'Not found'],
    };

    if ($payload === ['error' => 'Not found']) {
        http_response_code(404);
    }

    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    return;
}

$html = match ($path) {
    '/' => DonorStewardshipOpsConsole\Views\render_overview(),
    '/donor-lane' => DonorStewardshipOpsConsole\Views\render_donor_lane(),
    '/stewardship-queue' => DonorStewardshipOpsConsole\Views\render_stewardship_queue(),
    '/pledge-posture' => DonorStewardshipOpsConsole\Views\render_pledge_posture(),
    '/verification' => DonorStewardshipOpsConsole\Views\render_verification(),
    '/docs' => DonorStewardshipOpsConsole\Views\render_docs(),
    default => null,
};

if ($html === null) {
    http_response_code(404);
    echo 'Not found';
    return;
}

header('Content-Type: text/html; charset=utf-8');
echo $html;
