![Tampilan HomePage Hadirin](https://github.com/Wira630/Hadirku/public/doc/IndexHadirin.png)
![Tampilan Index Users](https://github.com/Wira630/Hadirku/public/doc/IndexUsers.png)
![Tampilan Index Event](https://github.com/Wira630/Hadirku/public/doc/IndexEvent.png)
![Tampilan Index Print ID ](https://github.com/Wira630/Hadirku/public/doc/PrintID.png)
![Tampilan Index Rekap Harian](https://github.com/Wira630/Hadirku/public/doc/RekapHarian.png)
![Tampilan Index Rekap Bulanan](https://github.com/Wira630/Hadirku/public/doc/RekapBulanan.png)

## 🛠️ Tech Stack
- Laravel 12
- Tailwind CSS

## ⚙️ Setup Guide

### 1. Copy file .env.example
```bash
copy .env.example .env
```
### 2. Setup database pada komputer anda, lalu masukkan kredensial-kredensialnya ke file .env.
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hadirkan
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Install dependency
```bash
composer install
```

### 4. Generate application key
```bash
php artisan key:generate
```
### 5. Link storage untuk file upload
```bash
php artisan storage:link
```
### 6. Migrasi database
```bash
php artisan migrate
```
### 7. Jalankan aplikasi
```bash
php artisan serve
```

### 8. Kalau eror SQLSTATE[42S02]: Base table or view not found: 1146 Table 'hadirkan.sessions' doesn't exist (Connection: mysql, SQL: select * from sessions where id = Suo58Euw1g688Pj7R9Eq8XMjgGaADBkQTacjtoRq limit 1)
```bash
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
