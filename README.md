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

## Post Fields

- Title
- Slug (auto-generated)
- Content
- Status (`draft` / `published`)
- Published Date (`published_at`)

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

### 4. Run the project

Option A (Laragon, recommended):

- Open via: `http://blog-task.test`

Option B (artisan server):

```bash
php artisan serve
```

Then open the shown URL (usually `http://127.0.0.1:8000`).

## Test Command

```bash
php artisan test
```

## Delivery Checklist

- Project uploaded to GitHub
- README with setup instructions
