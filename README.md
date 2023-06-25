<h1 align="center">IntelliPlan</h1>

## About

IntelliPlan merupakan aplikasi berbasis web yang dirancang untuk membantu pengguna dalam merencanakan
perjalanan pembelajaran yang efektif dan efisien.

Site URL: [https://intelliplan.aydinpramasta.me](https://intelliplan.aydinpramasta.me)

## Tech Stacks

- [Laravel 10](https://laravel.com)
- [AlpineJS 3](https://alpinejs.dev)
- [TailwindCSS 3](https://tailwindcss.com)

## Setup Guide

```bash
# Clone the repo
git clone https://github.com/aydinpramasta/sevima-intelliplan.git

# Change to repo directory
cd sevima-intelliplan

# Install PHP dependencies
composer install

# Copy environment variables
cp .env.example .env
```

> Environment variable yang wajib dikonfigurasi:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sevima_intelliplan
DB_USERNAME=root
DB_PASSWORD=

OPENAI_API_KEY=
```

```bash
# Generate app key
php artisan key:generate

# Migrate
php artisan migrate

# Install frontend assets
npm install

# Compile frontend assets
npm run build

# Serve the application
php artisan serve
```

> Access the app at http://localhost:8000
