$ErrorActionPreference = "Stop"

$root = Split-Path -Parent $PSScriptRoot
$site = Join-Path $root "site"

$expected = @(
    "index.html",
    "donor-lane\index.html",
    "stewardship-queue\index.html",
    "pledge-posture\index.html",
    "verification\index.html",
    "docs\index.html",
    "robots.txt",
    "sitemap.xml",
    "api\dashboard\summary\index.json",
    "api\donor-lane.json",
    "api\stewardship-queue.json",
    "api\verification.json",
    "api\sample.json"
)

foreach ($relative in $expected) {
    $full = Join-Path $site $relative
    if (-not (Test-Path $full)) {
        throw "Missing expected file: $relative"
    }
}

Write-Output "Smoke check passed for $site"
