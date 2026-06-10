# Donor Stewardship Ops Console

WordPress and nonprofit control plane for donor follow-up, stewardship evidence, pledge-risk review, and acknowledgment-safe workflow posture.

## Why this exists

- Donor trust usually degrades when executive notes, stewardship packets, and campaign exports drift apart across too many tools.
- Development, finance, executive giving, and audience teams need one view of which donor lanes are safe, which pledge notes are stale, and which acknowledgments are still incomplete.
- Stewardship quality breaks when the donor packet, executive follow-up, and finance-safe pledge posture all say different things.

## Why this matters (KG Embedded tie-back)

This repo demonstrates the donor-stewardship primitive for Kinetic Gain Embedded: follow-up evidence, pledge posture, executive handoff notes, and campaign-safe donor routing exposed through one operator surface. In a real embedded setting, the same primitive lets nonprofits and foundations keep stewardship workflow, donor messaging, and finance-safe review aligned without shipping outreach changes blindly.

## Product depth

Donor Stewardship Ops Console turns relationship risk into an operating lane. It gives nonprofit, foundation, development, finance, campaign, and executive-giving teams one review surface for donor promises, acknowledgment state, pledge posture, evidence packets, owner assignment, and next follow-up action.

For non-technical leaders, it answers: which donor packets are safe, where trust is exposed, which pledge or acknowledgment issue needs executive attention, and what story can we tell the board or funders? For technical reviewers, it exposes routes, static pages, JSON payloads, WordPress plugin hooks, sitemap assets, screenshots, and validation commands.

## What these repos have in common

This repo follows the Kinetic Gain control-plane pattern:

- name the operational ambiguity instead of hiding it inside screenshots or generic landing-page copy
- expose the decision surface as UI, JSON payloads, docs, screenshots, and validation commands
- connect GTM value, product narrative, technical proof, and executive review into the same public artifact
- keep public demos synthetic and safe while preserving enough structure to show how a real deployment would work

## Operating workflow

1. Review donor lanes by packet state, owner, risk, and next action.
2. Inspect the stewardship queue for canonical artifacts, acknowledgment anchors, and campaign-safe exports.
3. Use pledge posture gates to block outreach or board packets when stewardship and finance notes disagree.
4. Verify the public surface contains only synthetic demonstration data before shipping.

## Routes

- `/`
- `/donor-lane`
- `/stewardship-queue`
- `/pledge-posture`
- `/verification`
- `/docs`

## API

- `/api/dashboard/summary`
- `/api/donor-lane`
- `/api/stewardship-queue`
- `/api/verification`
- `/api/sample`

## Screenshots

![Overview](./screenshots/01-overview-proof.png)
![Donor lane](./screenshots/02-donor-lane-proof.png)
![Stewardship queue](./screenshots/03-stewardship-queue-proof.png)
![Verification](./screenshots/04-verification-proof.png)

## Local development

```powershell
cd donor-stewardship-ops-console
php -S 127.0.0.1:5442 .\router.php
```

Open:
- [http://127.0.0.1:5442/](http://127.0.0.1:5442/)
- [http://127.0.0.1:5442/donor-lane](http://127.0.0.1:5442/donor-lane)
- [http://127.0.0.1:5442/stewardship-queue](http://127.0.0.1:5442/stewardship-queue)
- [http://127.0.0.1:5442/pledge-posture](http://127.0.0.1:5442/pledge-posture)
- [http://127.0.0.1:5442/verification](http://127.0.0.1:5442/verification)

## Validation

- `php -l public\index.php`
- `php -l src\Services\DonorStewardshipOpsConsoleService.php`
- `php -l src\Views\render.php`
- `php -l plugin\donor-stewardship-ops-console.php`
- `php scripts\run_demo.php`
- `php scripts\prerender.php`
- `powershell -ExecutionPolicy Bypass -File .\scripts\smoke_check.ps1`
- `powershell -ExecutionPolicy Bypass -File .\scripts\render_readme_assets.ps1`

## Production status

| Aspect | Status |
|--------|--------|
| License | [AGPL-3.0-or-later](./LICENSE) |
| Security | [SECURITY.md](./SECURITY.md) |
| Deploy | Static prerender -> **https://stewardship.kineticgain.com/** |
| WordPress primitive | Donor stewardship snapshot shortcode + REST route |

## Docs

- [Architecture](./docs/architecture.md)
- [Origin](./docs/ORIGIN.md)
- [Kinetic Gain Embedded tie-back](./docs/KINETIC_GAIN_EMBEDDED.md)
- [Changelog](./CHANGELOG.md)

## Part of the Kinetic Gain Suite

Operator surface in the [Kinetic Gain Suite](https://suite.kineticgain.com/) — a portfolio of buyer-readable control planes spanning compliance evidence, nonprofit stewardship, property operations, FinOps, identity posture, and operator workflows. Apex: [kineticgain.com](https://kineticgain.com/).
