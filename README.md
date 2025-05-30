# Content Approval Platform with Media Handling & Automation

## Project Overview
This Laravel 11 project is a content management platform where users submit posts with images. Admins review and approve posts. The system includes job queues for sending approval/rejection emails, scheduled jobs for archiving unreviewed posts, custom image upload helpers with thumbnail generation, and complex model relationships.

---

## Features

- User submission of posts with images
- Admin review and approval workflow
- Job Queues (Redis) for asynchronous email notifications
- Scheduled Jobs to archive posts after 3 days if unreviewed
- Custom Helpers for image upload and thumbnail generation (300x200)
- Model relationships:
    - User ↔ Posts (one-to-many)
    - Post ↔ Categories (many-to-many)
    - Post ↔ Tags (polymorphic)
- Soft Deletes with optional restore
- Service Layer for post creation logic

---

## Redis Caching in the Project

This project uses **Redis** for caching key parts of the application to improve performance and reduce database load.

- Admin panel Post list
- User list
- Frontend post list on the home page

## Models & Relationships


| Model    | Relationships                                         | Notes                                                    |
| -------- | ---------------------------------------------------- | --------------------------------------------------------|
| User     | hasMany(Post)                                        | `role` enum ('admin', 'user'), indexed                   |
| Post     | belongsTo(User), belongsToMany(Category), morphMany(Tag), SoftDeletes | Indexed fields: user_id, status, created_at, archived_at, title |
| Category | belongsToMany(Post)                                  | Unique category names                                    |
| Tag      | morphTo(Post)                 | Polymorphic tagging  

---

## Installation & Setup

### Prerequisites

- PHP >= 8.1
- Composer
- Laravel 11
- Redis server (running)
- Database (MySQL, PostgreSQL, etc.)
---

### Step 1: Clone the repository

```bash
git clone https://github.com/Faruque5698/Content-approval-platform.git
cd content-approval-platform
```
### Step 2: Copy the example environment file

```bash
cp .env.example .env
```
### Step 3: Install dependencies

```bash
composer install
```
### Step 4: Generate application key

```bash
php artisan key:generate
```

### Step 5: Configure your database
Edit the `.env` file to set your database connection details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Your_DB_Name
DB_USERNAME=Your_DB_Username
DB_PASSWORD=Your_DB_Password
```

### Step 6: Run migrations

```bash
php artisan migrate
```

### Step 7: Seed the database (optional)
If you want to seed the database with sample data, you can run:

```bash
php artisan db:seed
```
#### You will get 2 sample users.
- **Admin**  
  Email: admin@example.com  
  Password: password

- **User**  
  Email: user@example.com  
  Password: password

### Step 8: Set up Email Configuration
Edit the `.env` file to configure your email settings. For example, using SMTP:

```env
MAIL_MAILER=Your_Mailer
MAIL_HOST=Your_SMTP_Host
MAIL_PORT=Your_SMTP_Port
MAIL_USERNAME=Your_SMTP_Username
MAIL_PASSWORD=Your_SMTP_Password
MAIL_ENCRYPTION=Your_SMTP_Encryption
```

# Redis Setup for Laravel Project (Required)

## Prerequisites
- Make sure Redis server is installed and running on your machine or server.
- You can install Redis locally or use a managed Redis service.

---

## Step 1: Install Redis PHP extension
If you haven't already, install the Redis PHP extension. You can do this via Composer:

```bash
composer require predis/predis
```
## Step 2: Configure Redis in Laravel
Open the `.env` file and set the Redis connection details:

```env
QUEUE_CONNECTION=redis

CACHE_STORE=redis

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

```

## Step 3: Run Redis server
If you have Redis installed locally, you can start the Redis server using:

```bash
redis-server
```
## Step 4: Test Redis connection
You can test the Redis connection by running a simple command in Tinker:

```bash
php artisan tinker
```

Then, in the Tinker shell, run:

```php
use Illuminate\Support\Facades\Redis;
Redis::set('test_key', 'Hello, Redis!');
echo Redis::get('test_key');
```

If you see `Hello, Redis!`, your Redis setup is working correctly.

## Step 5: Start the queue worker
```bash
php artisan queue:work
```
---

## Step 6: Start the scheduler
```bash
php artisan schedule:work
```

