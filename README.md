# Blog Task (Laravel)

Simple blog management system built with Laravel 13.

## Overview

This project implements the required task features:

- Public page that shows published posts only
- Admin pages to manage all posts
- Create, edit, delete posts
- Publish / unpublish posts
- Auto slug generation from title
- Form validation
- Clean MVC structure
- Blade templates with a simple, clean Tailwind UI

## Scope And Assumptions

- This submission focuses on the requested task scope only.
- Authentication and role-based authorization are not included by default.
- Admin routes are available directly for review/testing purposes.

## Post Fields

- Title
- Slug (auto-generated)
- Content
- Status (`draft` / `published`)
- Published Date (`published_at`)

### Why `string` Instead of `enum` for Status?

The `status` column is intentionally defined as `string` in migration:

```php
$table->string('status', 20)->default('draft');
```

This choice keeps the schema flexible and easier to evolve (for example: adding `archived` later) without modifying existing enum definitions.

## Implemented Features

### Public Blog

- List published posts with search and pagination
- View single post by slug
- Draft posts are blocked from public view (404)

### Admin Panel

- List all posts with search and pagination
- Add new post
- Edit existing post
- Delete post
- Toggle publish status

## Validation

Validation is implemented in `PostRequest`:

- `title`: required, string, max 255
- `content`: required, string, min 10
- `status`: required, one of `draft` or `published`

## Slug Generation

Slug is generated automatically from the title in `Post` model (`creating` event) with unique handling (adds `-1`, `-2`, etc. when needed).

## Routes

### Public

- `GET /` -> blog index
- `GET /posts/{post:slug}` -> blog show

### Admin (`/admin`, name prefix `admin.`)

- `GET /posts` -> list
- `GET /posts/create` -> create form
- `POST /posts` -> store
- `GET /posts/{post}` -> show
- `GET /posts/{post}/edit` -> edit form
- `PUT /posts/{post}` -> update
- `DELETE /posts/{post}` -> delete
- `PATCH /posts/{post}/toggle-status` -> publish/unpublish

## UI Notes

- Shared Blade layout for all pages
- Tailwind CSS via CDN
- Responsive layout
- Flash messages (success/error)
- Consistent card/table/form styling
- Modern SaaS-style visual language (clean spacing, soft slate palette, blue primary accents)

### Key Screens

- Public Blog Index: search + published posts + pagination
- Public Blog Show: readable article layout
- Admin Posts Index: table dashboard with status badges and actions
- Admin Create/Edit: centered form cards with validation states

## Tech Stack

- PHP 8.3+
- Laravel 13
- Blade
- MySQL/MariaDB
- Tailwind CSS (CDN)
- Pest (testing)

## Setup Instructions

### 1. Install dependencies

```bash
composer install
```

### 2. Create environment file

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Then generate app key:

```bash
php artisan key:generate
```

### 3. Configure database in `.env`

Set your DB credentials, then run:

```bash
php artisan migrate
```

### Required `.env` variables

- `APP_URL`
- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

### 4. Run the project

Option A (Laragon, recommended):

- Open via: `http://blog-task.test`

Option B (artisan server):

```bash
php artisan serve
```

Then open the shown URL (usually `http://127.0.0.1:8000`).

## User Flows

### Public flow

- Open home page
- Search and browse published posts
- Open a single post by slug

### Admin flow

- Open admin posts list
- Create or edit post content
- Publish / unpublish post
- Delete post if needed

## Test Strategy

- Tests run with Pest.
- Feature test uses database refresh so migrations run for test context.
- Main command:

```bash
php artisan test
```

## Troubleshooting

### `localhost:8000` is not reachable

- If using Laragon, prefer opening `http://blog-task.test`.
- If `php artisan serve` fails due to busy ports, use Laragon domain instead.

### `vite is not recognized`

- Run:

```bash
npm install
```

Then:

```bash
npm run dev
```

### Test fails with missing `posts` table

- Ensure tests are executed with:

```bash
php artisan test
```

- The test setup refreshes database state for feature tests.

## Known Limitations

- No authentication/authorization layer yet.
- No categories/tags.
- No image upload workflow.

## Test Command

```bash
php artisan test
```

## Delivery Checklist

- Project uploaded to GitHub
- README with setup instructions
