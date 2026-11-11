# AGENTS.md — Contract for AI Coding Agents

## 1. Authority
The approved files in `SOT/` are the sole product and design source of truth:
- `SOT/PRD.md`
- `SOT/UI-GUIDELINE.md`
- `SOT/IMPLEMENTATION_PLAN.md`

If this contract conflicts with an approved SOT, follow the SOT. If documents conflict with each other or a requirement is ambiguous, stop and ask the user. Do not guess.

## 2. Scope lock
- Implement only approved requirements.
- Do not add features, pages, libraries, integrations, or architecture without explicit approval.
- Do not silently change approved behavior, colors, role permissions, or data model.
- Keep changes minimal and relevant to the current approved milestone.

## 3. Approval gates
- Work only on the milestone explicitly approved by the user.
- Do not proceed to the next phase/milestone automatically.
- At completion, report files changed, behavior implemented, tests actually run and results, known limitations, and the exact next approval needed.
- Never claim success for commands/tests that were not run.

## 4. Engineering rules
- Follow the selected stack and folder structure in `IMPLEMENTATION_PLAN.md`.
- Keep presentation, business logic, validation, and persistence separated.
- Validate all input on the server; client validation is supplemental.
- Use prepared statements, secure password hashing, session protections, CSRF defenses, output escaping, and role/ownership authorization.
- Treat uploaded files as untrusted. Enforce allowed MIME/type and size, use safe generated names, and prevent direct execution/access.
- Never commit secrets, real applicant data, or sensitive uploaded documents.
- Use accessible labels, keyboard focus, responsive layouts, and UI states from the UI guideline.
- Prefer existing dependencies; do not install new dependencies without approval.

## 5. Data and migrations
- Keep schema changes explicit and reversible where practical.
- Preserve referential integrity.
- Use dummy data only for development.
- Do not alter or delete user data outside the approved task.

## 6. Workflow
1. Read all SOT files and this contract.
2. Identify the approved milestone and acceptance criteria.
3. State a concise implementation plan before editing.
4. Implement only the approved work.
5. Run relevant checks; record exact commands and outcomes.
6. Review changed files for scope, security, and consistency.
7. Summarize and stop for user approval.

## 7. Prohibited behavior
- No unrelated refactors or speculative features.
- No hardcoded credentials or secrets.
- No weakening authorization to make a demo work.
- No fake integrations, fabricated data claims, or unverified test claims.
- No edits to SOT or this contract without explicit user approval.
