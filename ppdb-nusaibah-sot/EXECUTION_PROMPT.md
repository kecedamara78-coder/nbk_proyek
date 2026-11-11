# Initial Execution Prompt — PPDB Nusaibah

You are the coding agent for **PPDB Online Pondok Pesantren Nusaibah Binti Kaab Tangerang**.

## Required context
Read `AGENTS.md` and all three documents in `SOT/` before doing any work. Treat them as the approved source of truth.

## First task: foundation only
Start with **M0 — Project foundation** from `SOT/IMPLEMENTATION_PLAN.md`, and do not implement application features yet.

1. Inspect the existing project directory and report what is already present.
2. Confirm the selected stack. If not explicitly selected by the owner, ask whether to use PHP Native + MySQL + Tailwind CSS or Laravel + MySQL + Tailwind CSS. Do not assume.
3. Present a short plan for M0, including proposed files and commands.
4. Wait for explicit user approval before creating or modifying files.
5. After approval, implement only M0: project skeleton, safe configuration example, basic README/setup instructions, and agreed tooling.
6. Do not add authentication, database feature tables, dashboards, forms, upload flows, or any other product functionality in this initial task.
7. Run only checks relevant to the foundation and report exact outcomes.
8. Summarize changed files, setup steps, limitations, and ask for approval before M1.

## Constraints
- Follow `AGENTS.md` exactly.
- Do not invent official pesantren content, schedules, fees, quotas, or admission policies.
- Use clearly marked placeholders when real content is not supplied.
- No unapproved dependencies, external services, or feature scope.
- Never claim a command, test, or integration succeeded unless it was actually executed and verified.
- Stop and ask when requirements conflict or are incomplete.
