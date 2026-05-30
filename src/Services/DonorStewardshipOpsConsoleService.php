<?php

declare(strict_types=1);

namespace DonorStewardshipOpsConsole\Services;

final class DonorStewardshipOpsConsoleService
{
    /** @var array<string, mixed> */
    private array $payload;

    public function __construct()
    {
        /** @var array<string, mixed> $payload */
        $payload = require __DIR__ . '/../Data/sample_donor_stewardship_ops.php';
        $this->payload = $payload;
    }

    /**
     * @return array<string, mixed>
     */
    public function summary(): array
    {
        $lanes = $this->donorLanes();
        $critical = array_values(array_filter($lanes, static fn(array $lane): bool => $lane['status'] === 'critical'));
        $watch = array_values(array_filter($lanes, static fn(array $lane): bool => $lane['status'] === 'watch'));
        $healthy = array_values(array_filter($lanes, static fn(array $lane): bool => $lane['status'] === 'healthy'));

        return [
            'donorCount' => count($lanes),
            'healthyCount' => count($healthy),
            'watchCount' => count($watch),
            'criticalCount' => count($critical),
            'queueCount' => count($this->stewardshipQueue()),
            'operatorPosture' => (string) $this->payload['summary']['operatorPosture'],
            'leadRecommendation' => (string) $this->payload['summary']['leadRecommendation'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function donorLanes(): array
    {
        /** @var array<int, array<string, mixed>> $lanes */
        $lanes = $this->payload['donorLanes'];

        return $lanes;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function stewardshipQueue(): array
    {
        /** @var array<int, array<string, mixed>> $queue */
        $queue = $this->payload['stewardshipQueue'];

        return $queue;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function verificationGates(): array
    {
        /** @var array<int, array<string, mixed>> $gates */
        $gates = $this->payload['verificationGates'];

        return $gates;
    }

    /**
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        return [
            'product' => 'Donor Stewardship Ops Console',
            'purpose' => 'WordPress and nonprofit operator surface for donor follow-up, stewardship evidence, pledge-risk review, and acknowledgment-safe workflow posture.',
            'routes' => [
                '/',
                '/donor-lane',
                '/stewardship-queue',
                '/pledge-posture',
                '/verification',
                '/docs',
            ],
            'priorities' => [
                'Keep donor follow-up, acknowledgment promises, and pledge risk in the same operator lane.',
                'Expose stale stewardship packets before finance, development, or executive teams discover them after a missed touchpoint.',
                'Make acknowledgment evidence and donor history point at the same canonical record before another campaign launches.',
                'Turn donor stewardship governance into a visible operating system instead of scattered CRM reminders and spreadsheet residue.',
            ],
            'entity' => (string) $this->payload['summary']['entity'],
        ];
    }
}
