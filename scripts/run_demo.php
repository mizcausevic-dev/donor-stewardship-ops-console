<?php

declare(strict_types=1);

require __DIR__ . '/../src/Services/DonorStewardshipOpsConsoleService.php';

$service = new DonorStewardshipOpsConsole\Services\DonorStewardshipOpsConsoleService();
$summary = $service->summary();

echo "Product: Donor Stewardship Ops Console\n";
echo "Tracked donors: {$summary['donorCount']}\n";
echo "Healthy donors: {$summary['healthyCount']}\n";
echo "Watch donors: {$summary['watchCount']}\n";
echo "Critical donors: {$summary['criticalCount']}\n";
echo "Queue items: {$summary['queueCount']}\n";
echo "Lead recommendation: {$summary['leadRecommendation']}\n";
