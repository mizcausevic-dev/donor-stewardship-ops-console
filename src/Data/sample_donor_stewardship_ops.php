<?php

declare(strict_types=1);

return [
    'summary' => [
        'entity' => 'Kinetic Gain Foundation Ops',
        'operatorPosture' => 'Stewardship-safe donor operation',
        'leadRecommendation' => 'Escalate the major-donor renewal lane now: acknowledgment proof, pledge follow-up, and executive handoff notes are still split across three tools and the next board-touch window is already at risk.',
    ],
    'donorLanes' => [
        [
            'donor' => 'North Harbor Circle renewal',
            'segment' => 'Major donor stewardship',
            'owner' => 'Development director',
            'packet' => 'Q2 renewal stewardship packet',
            'proof' => 'Renewal pledge notes were logged, but the handwritten board follow-up never made it into the canonical donor packet.',
            'risk' => 'Major-donor trust can erode if leadership references a stale pledge state.',
            'nextAction' => 'Merge executive handoff notes into the donor record and regenerate the renewal packet.',
            'status' => 'critical',
        ],
        [
            'donor' => 'Community builder monthly cohort',
            'segment' => 'Recurring donors',
            'owner' => 'Stewardship manager',
            'packet' => 'Monthly appreciation and impact recap',
            'proof' => 'Appeal copy is aligned, but the acknowledgment queue still has two donors without a completed touch log.',
            'risk' => 'Missed acknowledgments weaken donor retention on the next campaign cycle.',
            'nextAction' => 'Clear the open touch logs and rerun the appreciation export packet.',
            'status' => 'watch',
        ],
        [
            'donor' => 'Corporate matching partner lane',
            'segment' => 'Corporate giving',
            'owner' => 'Partnership ops',
            'packet' => 'Matching-funds verification bundle',
            'proof' => 'Matching receipts, acknowledgment language, and partner owner state are aligned.',
            'risk' => 'Low. Current lane is stewardship-safe.',
            'nextAction' => 'Monitor only.',
            'status' => 'healthy',
        ],
        [
            'donor' => 'Lapsed donor reactivation wave',
            'segment' => 'Reactivation donors',
            'owner' => 'Audience fundraising',
            'packet' => 'Reactivation contact packet',
            'proof' => 'Touch history is present, but the last executive note still references an obsolete giving preference.',
            'risk' => 'Reactivation outreach can feel tone-deaf and reduce re-engagement response.',
            'nextAction' => 'Update preference notes and hold the next outreach packet until reviewed.',
            'status' => 'watch',
        ],
        [
            'donor' => 'Leadership giving anniversary',
            'segment' => 'Leadership annual donors',
            'owner' => 'Executive giving',
            'packet' => 'Anniversary acknowledgment packet',
            'proof' => 'Acknowledgment language, giving history, and contact plan are converged to the same reviewed packet.',
            'risk' => 'Low. No visible stewardship drift.',
            'nextAction' => 'Monitor only.',
            'status' => 'healthy',
        ],
    ],
    'stewardshipQueue' => [
        [
            'artifact' => 'Executive follow-up memo',
            'purpose' => 'Canonical summary of the last major-donor conversation and next stewardship promise.',
            'owner' => 'Executive office',
            'anchor' => '/evidence/executive-follow-up-memo',
            'status' => 'critical',
        ],
        [
            'artifact' => 'Acknowledgment completion log',
            'purpose' => 'Proof that appreciation notes and thank-you touches actually reached the right donor lane.',
            'owner' => 'Stewardship operations',
            'anchor' => '/evidence/acknowledgment-log',
            'status' => 'watch',
        ],
        [
            'artifact' => 'Pledge-risk review packet',
            'purpose' => 'Shows pledge softness, donor intent drift, and next-touch timing before leadership review.',
            'owner' => 'Finance + development',
            'anchor' => '/evidence/pledge-risk-packet',
            'status' => 'approved',
        ],
        [
            'artifact' => 'Campaign audience stewardship export',
            'purpose' => 'Ensures campaign recipients, exclusions, and executive notes reflect the latest donor reality.',
            'owner' => 'Audience fundraising',
            'anchor' => '/evidence/stewardship-export',
            'status' => 'watch',
        ],
    ],
    'verificationGates' => [
        [
            'gate' => 'Donor acknowledgment packet matches the reviewed source',
            'detail' => 'Block release if the live donor-touch packet drifts from the approved stewardship language.',
            'status' => 'approved',
        ],
        [
            'gate' => 'Executive and development notes resolve to one canonical donor state',
            'detail' => 'Block follow-up when executive notes and CRM stewardship records disagree on pledge or next touch.',
            'status' => 'critical',
        ],
        [
            'gate' => 'Campaign and stewardship cohorts match the latest donor posture',
            'detail' => 'Keep reactivation, recurring, and major-donor lanes from mixing stale donor preferences and unresolved exclusions.',
            'status' => 'watch',
        ],
        [
            'gate' => 'Finance-safe pledge posture is present before board review',
            'detail' => 'Ensure pledge-risk summaries and donor-touch commitments converge before executive reporting.',
            'status' => 'approved',
        ],
    ],
];
