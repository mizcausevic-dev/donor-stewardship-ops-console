# Architecture

`donor-stewardship-ops-console` is a local-first PHP + static Pages operator surface.

## Layers

1. `src/Data/sample_donor_stewardship_ops.php`
   - synthetic donor lanes, stewardship queue artifacts, and verification gates
2. `src/Services/DonorStewardshipOpsConsoleService.php`
   - in-memory service layer that assembles dashboard payloads and route-safe summaries
3. `src/Views/render.php`
   - renders the overview, donor lane, stewardship queue, pledge posture, verification, and docs routes
4. `scripts/prerender.php`
   - prerenders the static custom-domain site plus API payloads
5. `plugin/donor-stewardship-ops-console.php`
   - shortcode and REST primitive exposing one canonical stewardship snapshot

## Operator primitive

The repo models a nonprofit truth that often gets lost: donor follow-up, pledge notes, and acknowledgment proof belong in one review lane, not in separate CRM tasks, executive inboxes, and campaign spreadsheets.
