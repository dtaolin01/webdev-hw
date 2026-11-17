# CRUD Produk Sederhana (Laravel + MySQL)

## 1. Buat project Laravel baru
    composer create-project laravel/laravel test-webdev-app
    cd test-webdev-app

## 2. Salin folder dari zip ini ke project (timpa routes/web.php)
    app/, database/, resources/, routes/

## 3. Buat database di MySQL
    CREATE DATABASE `test-webdev`;
(tanda backtick wajib karena ada tanda minus)

## 4. Edit .env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=test-webdev
    DB_USERNAME=root
    DB_PASSWORD=

## 5. Migrasi & jalankan
    php artisan migrate
    php artisan serve

Buka http://localhost:8000
