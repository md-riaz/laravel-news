# Laravel News Portal

A Laravel-first news publishing platform. This repository currently focuses on the project specification and setup plan, along with a bootstrap script to initialize the Laravel application and required packages.

## Documentation

- Project specification: `docs/specs/project-specification.md`
- Delivery plan: `docs/plans/ai-delivery-plan.md`
- Scaffold setup: `docs/setup/scaffold-setup.md`
- Completion checklist: `docs/checklists/project-completion-checklist.md`

## Bootstrap Laravel

Run the bootstrap script to create the Laravel application and install required packages:

```bash
./scripts/bootstrap-laravel.sh
```

The script creates a fresh Laravel app, restores repository documentation, and installs the packages listed in the scaffold guide.

## Next Implementation Steps

1. Configure `.env` for local services.
2. Run migrations and seeders.
3. Implement core models, migrations, and factories.
4. Build Filament resources and public Blade templates.
