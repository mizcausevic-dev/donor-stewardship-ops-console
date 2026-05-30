<?php
/**
 * Plugin Name: Donor Stewardship Ops Console
 * Plugin URI: https://stewardship.kineticgain.com/
 * Description: Publishes donor stewardship snapshots, pledge-risk review packets, and machine-readable nonprofit workflow payloads for WordPress sites.
 * Version: 0.1.0
 * Author: Kinetic Gain
 * License: AGPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/agpl-3.0.html
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('kg_donor_stewardship_snapshot_payload')) {
    /**
     * @return array<string, mixed>
     */
    function kg_donor_stewardship_snapshot_payload(): array
    {
        return [
            'entity' => 'Kinetic Gain Foundation Ops',
            'kit' => 'Donor Stewardship Ops Console',
            'version' => '0.1.0',
            'updatedAt' => gmdate('c'),
            'donorLanes' => [
                'major-donor-renewal',
                'monthly-appreciation',
                'corporate-matching',
                'reactivation-wave',
                'leadership-anniversary',
            ],
            'operatorNote' => 'Synthetic demonstration payload only. Review donor commitments, acknowledgment policy, and stewardship workflow before production use.',
        ];
    }
}

if (! function_exists('kg_render_donor_stewardship_snapshot')) {
    function kg_render_donor_stewardship_snapshot(): string
    {
        $payload = kg_donor_stewardship_snapshot_payload();

        return '<pre class="kg-donor-stewardship-snapshot">' . esc_html(wp_json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) . '</pre>';
    }
}

add_shortcode('kg_donor_stewardship_snapshot', 'kg_render_donor_stewardship_snapshot');

add_action('rest_api_init', static function (): void {
    register_rest_route(
        'kg-foundation-ops/v1',
        '/stewardship-snapshot',
        [
            'methods' => 'GET',
            'permission_callback' => '__return_true',
            'callback' => static function () {
                return rest_ensure_response(kg_donor_stewardship_snapshot_payload());
            },
        ]
    );
});
