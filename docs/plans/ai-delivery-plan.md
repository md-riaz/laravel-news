# AI Delivery Plan: Laravel News Portal

This plan translates the project specification into a multi‑agent execution strategy. Each agent owns a discrete slice of the system, with clear handoffs, dependencies, and acceptance checks.

For current status and sequencing, see [Feature Tracking Plan](feature-tracking.md).

## 1. Project Phases

### Phase 0 — Repository Bootstrap
- Initialize Laravel (latest LTS) and baseline tooling.
- Create environment templates and baseline configuration.
- Establish CI checks and formatting rules.

**Exit criteria**
- App boots locally with a clean `php artisan serve` and database connection.
- Base configuration tracked in version control.

### Phase 1 — Core Domain Modeling
- Define core entities: Article, Category, Tag, Page, Author, Media, Gallery, Video.
- Implement migrations, factories, and seeders.
- Establish relationships and constraints required by the editorial workflow.

**Exit criteria**
- All models are migrated, seeded, and pass basic CRUD verification.

### Phase 2 — Editorial Workflow & CMS (Filament)
- Implement Filament resources for all editorial modules.
- Enforce workflow transitions and field‑level permissions.
- Add revisioning, comments, and audit logs.

**Exit criteria**
- Editorial workflow is enforceable in the CMS.
- Role permissions align with the spec.

### Phase 3 — Frontend Templates & Routing
- Implement Blade templates for required public routes.
- Add reusable components for cards and widgets.
- Implement response caching, sitemaps, RSS, and schema output.

**Exit criteria**
- All routes render SSR HTML with required metadata.
- Cache invalidation hooks work on publish/update.

### Phase 4 — Search, Media, and Performance
- Wire Scout + Typesense for search.
- Implement Spatie Media Library conversions.
- Enforce image rules and responsive markup.

**Exit criteria**
- Search results are accurate and SSR‑friendly.
- Image pipeline generates WebP/AVIF.

### Phase 5 — Ops & Reliability
- Cache warm/purge tools.
- Queue dashboards and failure retries.
- Backup and audit logging.

**Exit criteria**
- Operational tools verified and documented.

## 2. Agent Roles & Responsibilities

### Agent: Platform Lead
- Owns global architecture, app skeleton, and config.
- Sets up CI, formatting, and deployment workflow.
- Coordinates dependencies across agents.

### Agent: Data Modeler
- Owns migrations, models, factories, and seed data.
- Defines data integrity rules and indexes.

### Agent: CMS/Filament Engineer
- Builds Filament resources and workflow actions.
- Implements permissions and guardrails.
- Adds revisioning and editorial comments.

### Agent: Frontend/SEO Engineer
- Implements Blade templates and reusable components.
- Adds structured data, SEO metadata, and canonical rules.
- Ensures accessibility and layout consistency.

### Agent: Search & Media Engineer
- Configures Scout + Typesense and indexing jobs.
- Implements Spatie Media Library conversions and responsive images.

### Agent: Ops/Performance Engineer
- Sets up response caching, Redis usage, queue monitoring.
- Adds sitemap generation and cache invalidation.

## 3. Task Breakdown & Handoffs

### Bootstrap → Data Modeler
- **Input:** Laravel project initialized and configuration templates.
- **Output:** Models, migrations, factories, and seed data committed.

### Data Modeler → CMS Engineer
- **Input:** Stable data model with relationships.
- **Output:** Filament resources and workflow actions.

### CMS Engineer → Frontend/SEO Engineer
- **Input:** CMS publishing and statuses finalized.
- **Output:** Route templates, components, and SEO rules.

### Search/Media Engineer → Ops Engineer
- **Input:** Indexing pipeline and media conversions complete.
- **Output:** Cache policies and performance tooling wired.

## 4. Definition of Done (Per Feature)

Each feature must include:
- Automated tests (unit/feature where applicable).
- Documentation updates (README or docs pages).
- Validation of SEO metadata and schema output.
- Cache invalidation rules and queue jobs where required.

## 5. Communication & Review Loop

- Each agent posts a daily update with:
  - Completed tasks
  - Blockers
  - Next steps
- The Platform Lead merges only when acceptance criteria are met.

## 6. Risks & Mitigations

| Risk | Mitigation |
| --- | --- |
| Workflow validation gaps | Add policy checks + integration tests |
| SEO regressions | Snapshot tests for meta/schema output |
| Cache staleness | Centralized cache invalidation events |
| Media pipeline failure | Queue retries + monitoring alerts |

## 7. Initial Milestones (Suggested)

1. Scaffold + baseline config.
2. Core models + migrations + seeders.
3. Article CMS resource with workflow enforcement.
4. Public article page + metadata + schema.
5. Search and media pipeline.
6. Ops tooling + documentation.
