Laravel News Portal – End‑to‑End Project Specification

1. Vision & Non‑Negotiable Goals

This project defines a modern, SEO‑first, high‑performance news portal built entirely on Laravel, designed for long‑term operational sanity rather than short‑term hacks.

Primary goals:

First‑class Google Search & Google News performance

Editorial velocity without technical friction

Deterministic performance under traffic spikes

Zero plugin chaos, zero hidden magic

Full ownership of data, markup, and rendering


This specification intentionally removes decision fatigue. All architectural choices are fixed, battle‑tested, and aligned with current best practices used by serious publishers.


---

2. High‑Level Architecture

2.1 Technology Stack (Locked)

Backend & CMS

Laravel (latest LTS)

PHP 8.3+

Filament Admin Panel (primary CMS)


Frontend Rendering

Blade (Server‑Side Rendering)

Minimal Alpine.js for CMS UI only

Zero SPA for public pages


Data & Infra

MySQL 8 / MariaDB

Redis (cache, queues, counters)

Cloudflare CDN


Search & Discovery

Laravel Scout

Typesense (primary search engine)


Media & Assets

Spatie Media Library

Imagick (WebP + AVIF generation)

Object Storage (S3‑compatible)



---

3. Backend Editorial System (CMS) – Complete Specification

This section specifies the entire newsroom backend: editorial workflow, Filament resources, permissions, UI modules, validation rules, and operational tooling.

3.1 Admin Areas & Modules (Filament)

A. Content

Articles

Categories

Tags

Pages (static)

Breaking/Ticker items

Trending rules/overrides

Home Layout (section builder)


B. Media

Media Library (uploads, reuse, metadata)

Photo Galleries

Videos


C. People

Reporters/Authors

Users & Roles


D. Ads/Campaigns

Placements

Units/Creatives

Campaign schedules


E. SEO & Distribution

SEO defaults

Sitemap controls

RSS feed controls

Social auto-post templates


F. Ops

Cache controls (purge/warm)

Queue monitoring

Audit logs

System settings



---

3.2 Editorial Workflow (Enforced)

Article lifecycle states

draft: writer-only visibility unless shared with editors

in_review: editor can comment/request changes

scheduled: publish time set; immutable fields locked except by editor/admin

published: public; updates create revision records

archived: removed from lists but preserved for compliance/history


Workflow rules

Moving to in_review requires: headline, body, category, hero image, excerpt, SEO title/description

Moving to scheduled/published requires: canonical slug, NewsArticle schema fields complete (author, published_at, updated_at, image, section)

Any update to published content must:

create a revision entry

invalidate response cache for affected routes

update search index

update sitemaps/news-sitemap



Embargo & scheduled publishing

embargo_until blocks public visibility even if published flag is set

Scheduler releases embargo automatically and triggers cache warm



---

3.3 Roles, Permissions & Guardrails

Roles

Journalist

Editor

Admin

(Optional) SEO Manager, Ad Manager


Permission matrix (minimum)

Journalist: create/edit own drafts, submit for review, upload media

Editor: edit any article, approve, schedule/publish, feature, manage ticker/trending

Admin: manage users/roles, system settings, campaigns, SEO defaults, cache


Guardrails

Field-level locking in Filament based on status (e.g., slug locked after publish except admin)

Rate-limited uploads

Mandatory image credit + caption on hero

Prevent “empty publish”: validation blocks



---

3.4 Filament Resources (Exact UI Scope)

3.4.1 Article Resource

Tabs

1. Content



Headline (required)

Subheadline

Body (structured HTML editor)

Excerpt (required)

Category (required)

Tags


2. Media



Hero image (required)

Gallery attachments

Inline images

Caption + Credit required for hero


3. Publishing



Status (controlled)

Published at (required for scheduled/published)

Embargo until

Featured toggle

Breaking toggle

Priority score (editor/admin)


4. SEO



SEO title (fallback headline)

SEO description (fallback excerpt)

Canonical URL

OpenGraph overrides

Twitter Card overrides


5. Compliance / Meta



Source attribution

Location / Geo

Content warnings (optional)


Actions

Save draft

Submit for review

Approve

Schedule

Publish

Unpublish (admin only)

Archive

Duplicate

Preview (public template)


Revisioning (required)

Store diffs for: headline, excerpt, body, category, tags, media, SEO

Show “Compare versions” view

“Restore this version” (editor/admin)


Editorial comments (required)

Inline notes + general thread

Status-aware (open/resolved)



---

3.4.2 Category Resource

Name, slug, description

Position/order

SEO meta defaults

Category template options (if needed)


3.4.3 Tag Resource

Name, slug

Merge tags tool (admin)


3.4.4 Pages Resource

Title, slug

Content

SEO fields

Publish status


3.4.5 Reporter/Author Resource

Name, bio, avatar

Social links

Verification badge (optional)

Author page SEO


3.4.6 Media Library

Upload, edit metadata

Batch operations

Rights/license fields


3.4.7 Photo Gallery Resource

Title, description

Images (ordered)

Publish status


3.4.8 Video Resource

Title

Embed URL

Thumbnail

Category association

Publish status


3.4.9 Trending & Ticker

Ticker items CRUD with schedule

Trending override list (manual pin/unpin)

Trending engine settings (weights)


3.4.10 Campaigns & Ads

Placements (key, size, devices)

Units (creative, URL, tracking)

Scheduling & caps



---

3.5 Backend Operational Tooling

Cache panel

Purge homepage

Purge category

Purge article

Purge all (admin)

Warm selected routes


Queue visibility

Job failures list

Retry action


Audit logs

Every publish/unpublish/schedule

User/role changes

Settings changes



---

4. Public Frontend (News Site) – Complete Specification

This section defines the public-facing website: routes, page templates, SEO rules, caching behavior, UX patterns, and content modules.

4.1 Rendering Strategy

100% SSR via Blade

JS optional and minimal (progressive enhancement)

HTML is canonical (Googlebot sees full content)


4.2 Required Public Routes (IA)

Homepage

/


Article

/{category_slug}/{article_slug} (canonical)

Alternate old URLs 301 → canonical


Category

/{category_slug}


Tag

/tag/{tag_slug}


Author

/author/{author_slug}


Search

/search?q=


Latest

/latest


Trending

/trending


Media

/photos

/photos/{gallery_slug}

/videos

/videos/{video_slug} (or list-only embeds)


Static pages

/page/{slug} (or direct /{slug} if reserved)


Feeds & sitemaps

/rss.xml

/rss/{category_slug}.xml

/news-sitemap.xml

/sitemap.xml


4.3 Page Template Requirements

Article Page

Clean semantic HTML5

Proper headings structure

Above-the-fold: headline, subheadline, author, date, hero image

Body supports:

inline images

pull quotes

related links

embedded video


Must output:

canonical

OG/Twitter

NewsArticle schema

Breadcrumb schema



Category Page

Intro block + SEO copy

Latest list with pagination

Featured/Top stories slot


Homepage

Section builder-driven layout

Lead story module

Featured grid

Latest feed

Trending

Video/photo blocks


Search Page

SSR results

Typesense-backed

Highlighted matches


Author Page

Bio + social

Latest authored articles


Tag Page

Tag description

Latest list


4.4 Frontend Modules (Reusable)

Lead story card

Featured grid card

Standard article card

Compact list item

Trending widget

Ticker bar

Breadcrumbs

Related articles block

More-from-category

Newsletter/signup module (optional)


4.5 Performance Rules (Public)

Hero image is LCP: preload + no lazy-load

All other images lazy-loaded

Response cache for anonymous users on:

homepage

category

article

tag

author


Purge targeted caches on content changes

Cloudflare edge caching enabled for anonymous


4.6 Ads on Frontend

Placement keys map to templates

Device-aware rendering

Lazy-load below-the-fold units


4.7 Accessibility & UX

Keyboard navigable

Proper contrast

Skip-to-content link

Alt text required for hero



---

3.2 Editorial Workflow

Workflow is enforced, not optional:

1. Journalist creates draft


2. Editor reviews & edits


3. SEO fields must be completed


4. Publish immediately or schedule


5. Cache invalidation triggered automatically



Roles:

Journalist: create & edit own drafts

Editor: approve, publish, feature

Admin: system‑wide control


Filament enforces permissions at field, action, and resource level.


---

4. Media & Image Handling (SEO‑Critical)

4.1 Image Processing Pipeline

On upload:

Original preserved

Auto‑generate:

Hero (1200px)

Card (600px)

Thumbnail (300px)


Convert to:

WebP

AVIF



Responsive <picture> tags are mandatory.

4.2 Media Rules

Every article must have:

Hero image

Caption

Credit


Lazy loading everywhere except LCP image



---

5. SEO & Structured Data (Non‑Optional)

5.1 Metadata Control

Using artesaos/seotools:

Title

Meta description

Canonical URL

Open Graph

Twitter Cards


SEO exists at:

Article level

Category level

Static pages


5.2 Structured Data

Using Spatie Schema:

NewsArticle

BreadcrumbList

Organization

WebSite


Schema is rendered server‑side, never injected by JS.

5.3 Sitemaps

Using Spatie Sitemap:

/sitemap.xml

/news-sitemap.xml

Index sitemap


Automatically refreshed on publish.


---

6. Performance & Caching Strategy

6.1 HTML Response Caching

Using Spatie Response Cache:

Full HTML cached per URL

Cache invalidated on:

Article update

Category update

Homepage config change



6.2 Redis Usage

Redis stores:

Homepage blocks

Trending lists

Category listings

Real‑time counters


6.3 CDN Strategy

Cloudflare:

Cache HTML + assets

Edge caching for anonymous users

Bypass for logged‑in editors



---

7. Homepage & Section Architecture

Homepage is configuration‑driven, not hardcoded.

Sections:

Lead story

Featured grid

Category blocks

Trending now

Latest news

Video block

Photo gallery


Configuration stored as JSON and editable via CMS.


---

8. Search & Discovery

8.1 Internal Search

Using Scout + Typesense:

Full‑text article search

Author search

Tag filtering

Typo tolerance


Search is instant, SSR‑friendly.


---

9. Feeds & Syndication

Using spatie/laravel-feed:

Global RSS

Category RSS

Author RSS


Google News compatibility is enforced.


---

10. Engagement & Community

10.1 Comments

Threaded comments with:

Moderation queue

Spam protection

Rate limiting


10.2 Reactions

Likes

Emoji reactions

Poll blocks


Reactions feed trending logic.


---

11. Scheduling & Automation

11.1 Scheduler

Runs:

Scheduled publishing

Sitemap regeneration

Cache warming

Analytics aggregation


11.2 Queues

Queued jobs:

Image processing

Feed updates

Notification dispatch

Social auto‑posting


Queue failures are logged and retryable.


---

12. Analytics & Editorial Intelligence

Using Spatie Laravel Analytics:

Page views

Popular content


Combined with Redis counters for real‑time trending.


---

13. Security & Reliability

Laravel Sanctum for API auth

Strict rate limiting on:

Search

Comments

Login


Audit logs for editorial actions

Daily backups



---

14. Deployment & Environment

14.1 Environments

Local

Staging

Production


14.2 Deployment

Zero‑downtime deploys

Config caching

Route caching

View caching



---

15. What This System Is Not

Not a plugin‑driven CMS

Not a SPA

Not dependent on third‑party widgets

Not SEO‑by‑accident



---

16. Final Principle

Laravel provides the tools. This architecture provides the rankings, the speed, and the sanity.

This specification is sufficient to build, scale, and operate a professional news organization without architectural regret.

You’re right — the original spec was strong on platform pieces but too light on the two halves that actually ship:

1. the backend newsroom/editorial machine (Filament CMS)


2. the public-facing news site (frontend pages + routes + templates + SEO)



I’ve now updated the spec to include both as fully defined, decision-complete sections:

Backend Editorial System (CMS): modules, workflow states, permissions matrix, Filament resources (tabs/actions), revisioning, editorial comments, cache tools, audit logs, queue visibility.

Public Frontend (News Site): route map, SSR rendering rules, page templates (article/category/home/search/author/tag), reusable modules, caching rules, CDN behavior, ads placement integration, accessibility requirements.


It’s now a proper “build from scratch with no decision fatigue” blueprint: the newsroom can operate, and the public site can rank and scale.
