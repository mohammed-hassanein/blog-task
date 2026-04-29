<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Blog Task (Laravel)

A complete blog application built with Laravel 13, featuring a full admin panel for managing posts and a public-facing blog for viewing published content.

## ✨ Features Implemented

### 📄 Post Model & Database

- **Post Model** with fillable attributes, casts, and a relationship to `User`
- **Auto-generated Slugs**: Slugs are automatically generated from the title using Laravel's `Str::slug()` with unique constraint handling
- **Status Management**: Draft and published statuses with `published_at` timestamp
- **Database Migration**: Complete posts table with indexes and proper structure

### 🔍 Query Scopes

The `Post` model includes powerful query scopes for filtering and searching:

- `scopePublished($query)` — Returns published posts with a valid `published_at` timestamp
- `scopeDraft($query)` — Returns draft posts
- `scopeSearch($query, $term)` — Full-text search across title, content, and slug

Example usage:

```php
Post::published()->latest('published_at')->get();
Post::draft()->get();
Post::search($searchTerm)->paginate();
```

### 🛠️ Admin Panel (PostController)

Complete CRUD operations for managing posts:

- **Index**: List all posts with search and pagination (10 per page)
- **Create**: Display form to create new post
- **Store**: Validate and save new post with unique slug generation
- **Show**: Display single post details
- **Edit**: Load post for editing
- **Update**: Validate and update post data
- **Destroy**: Delete post
- **Toggle Status**: Switch between draft/published with automatic `published_at` handling

Features:

- Search functionality across posts
- Form validation using `PostRequest`
- Flash messages for user feedback
- Pagination with query string preservation

### 📰 Public Blog (BlogController)

Frontend display of published posts:

- **Index**: Display published posts with search and pagination
- **Show**: Display single post (404 if not published)
- Features full-text search, latest posts first, and proper access control

### 🛣️ Routes Structure

**Public Blog Routes:**

```
GET  /                    - Blog homepage (list published posts)
GET  /posts/{post:slug}   - View single post by slug
```

**Admin Panel Routes (prefix: `/admin`, name: `admin.`):**

```
GET    /posts                      - List all posts
GET    /posts/create              - Show create form
POST   /posts                      - Store new post
GET    /posts/{post}              - Show post details
GET    /posts/{post}/edit         - Show edit form
PUT    /posts/{post}              - Update post
DELETE /posts/{post}              - Delete post
PATCH  /posts/{post}/toggle-status - Toggle draft/published status
```

### 📋 Form Validation (PostRequest)

Dedicated form request class for post validation. Currently configured with authorization rules (can be extended with specific rules).

### 📁 Project Structure

```
app/
  Http/
    Controllers/
      PostController.php    - Admin CRUD operations
      BlogController.php    - Public blog display
    Requests/
      PostRequest.php       - Form validation
  Models/
    Post.php                - Post model with scopes and relationships
database/
  migrations/
    2026_04_29_221400_create_posts_table.php  - Posts table definition
routes/
  web.php                   - All route definitions
resources/
  views/
    admin/posts/          - Admin panel views
    blog/                 - Public blog views
```

## 🔧 Technology Stack

- **Framework**: Laravel 13
- **Database**: MySQL/Mariadb (via Laragon)
- **Frontend**: Tailwind CSS 4, Vite
- **Testing**: Pest
- **PHP Version**: 8.3+

## 🚀 Getting Started

```bash
# Install dependencies
composer install
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
php artisan serve

# In another terminal, run Vite
npm run dev
```

## 🧪 Running Tests

```bash
php artisan test
# or with Pest
./vendor/bin/pest
```

## 📝 Status Field Design

The migration uses a string column for status instead of an enum for flexibility:

```php
$table->string('status', 20)->default('draft');  // 'draft', 'published'
```

Benefits:

- Easier to add new statuses later without modifying old migrations
- No need to alter enum types across different database systems
- Status constants defined in the model for consistency

## 📖 Next Steps (Optional)

- Implement authorization checks in PostController (restrict admin access)
- Add categories/tags for posts
- Add comments functionality
- Create seeders for sample data
- Build complete blade templates for admin and public views
- Add image upload support

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
