<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Blog Task (Laravel)

This README summarizes the work completed so far for the posts feature.

## What’s implemented

- `Post` model with fillable attributes, casts, and a `user` relationship.
- Migration that creates the `posts` table with the basic fields.
- Resource controller scaffold: `PostController` (methods are scaffolded but not implemented).

## Status field design

- The migration uses a string column for status instead of an `enum`:
  `$table->string('status', 20)->default('draft'); // 'draft', 'published'`
  Using `string` makes it easier to add new statuses later without modifying old migrations.

- Status values are defined in the model as constants (e.g. `STATUS_DRAFT`, `STATUS_PUBLISHED`).
  This keeps the codebase consistent and lets you add new statuses in one place.

## Scopes in `Post` model

- `scopePublished($query)` — returns posts where status is `published` and `published_at` is not null.
- `scopeDraft($query)` — returns posts where status is `draft`.
- `scopeSearch($query, $term)` — searches `title`, `content`, and `slug` using `LIKE`.

Usage examples:

```php
Post::published()->latest()->get();
Post::draft()->get();
Post::search($term)->get();
```

## Main files structure

```
app/
	Http/
		Controllers/
			PostController.php
	Models/
		Post.php
database/
	migrations/
		2026_04_29_221400_create_posts_table.php
routes/
	web.php
```

If you want, I can now implement CRUD in the `PostController`, add routes, or create a seeder for sample posts.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
