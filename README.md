# GODuls - Travel E-Commerce Laravel
    
## Stack Teknologi

| Layer       | Teknologi                          |
|-------------|------------------------------------|
| Framework   | Laravel (PHP 8.2+)                 |
| View Engine | Blade Templates                    |
| ORM         | Eloquent                           |
| CSS         | Tailwind CSS (CDN) + Custom CSS    |
| Icons       | Lucide Icons + Font Awesome        |
| Fonts       | Google Fonts (Inter + Poppins)     |
| Database    | Supabase (PostgreSQL) / MySQL      |

---

## Struktur Folder Laravel

```text
GODuls-Laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php          # Login & Register
│   │       ├── HomeController.php          # Halaman beranda
│   │       ├── DestinationController.php   # Halaman & API destinations
│   │       ├── BookingController.php       # Form booking
│   │       ├── PaymentController.php       # Proses pembayaran
│   │       └── NewsletterController.php    # Langganan newsletter
│   └── Models/
│       ├── User.php                        # Model user
│       ├── Destination.php                 # Model destinasi
│       └── Booking.php                     # Model pemesanan
├── database/
│   └── migrations/
│       ├── ..._create_users_table.php
│       ├── ..._create_destinations_table.php
│       ├── ..._create_bookings_table.php
│       └── ..._create_newsletter_subscribers_table.php
├── public/
│   └── assets/
│       └── css/
│           └── app.css                     # Custom CSS
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php             # Halaman login
│       │   └── register.blade.php          # Halaman register
│       ├── layouts/
│       │   ├── app.blade.php               # Layout utama
│       │   ├── header.blade.php            # Header + navigasi + search
│       │   └── footer.blade.php            # Footer + newsletter
│       └── pages/
│           ├── home.blade.php              # Halaman utama
│           ├── destinations.blade.php      # Semua destinasi
│           ├── booking.blade.php           # Form booking
│           └── payment.blade.php           # Form pembayaran
└── routes/
    └── web.php                             # Semua route
```

---

## Instalasi & Setup

### Persyaratan
- PHP >= 8.2
- Composer
- Node.js (opsional)

### Langkah-langkah

```bash
# 1. Clone atau ekstrak project
cd GODuls-Laravel

# 2. Install PHP dependencies
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# Jika menggunakan Supabase Connection Pooler:
# DB_URL=postgresql://postgres.[project]:[password]@[pooler-url]:5432/postgres

# 6. Jalankan migrasi
php artisan migrate

# 7. Jalankan server development
php artisan serve
```

Buka browser dan akses: **http://localhost:8000**

---

## Routes

| Method | URL                                   | Nama Route             | Deskripsi              |
|--------|---------------------------------------|------------------------|------------------------|
| GET    | `/`                                   | `home`                 | Halaman beranda        |
| GET    | `/login`                              | `login`                | Halaman login          |
| POST   | `/login`                              | `login.submit`         | Proses login           |
| GET    | `/register`                           | `register`             | Halaman register       |
| POST   | `/register`                           | `register.submit`      | Proses register        |
| POST   | `/logout`                             | `logout`               | Proses logout          |
| GET    | `/destinations`                       | `destinations.index`   | Semua destinasi        |
| GET    | `/destinations/{id}/booking`          | `booking.show`         | Form booking           |
| POST   | `/destinations/{id}/booking`          | `booking.store`        | Simpan booking         |
| GET    | `/destinations/{id}/payment`          | `payment.show`         | Form pembayaran        |
| POST   | `/destinations/{id}/payment`          | `payment.process`      | Proses pembayaran      |
| POST   | `/newsletter/subscribe`               | `newsletter.subscribe` | Langganan newsletter   |

---

## Fitur UI

- **Hero Section**: Background gradient + parallax image + animasi.
- **Navbar**: Transparan saat di atas, dark saat scroll; mobile responsive.
- **Search Bar**: Expandable dengan dropdown hasil pencarian.
- **Destination Cards**: Hover zoom + rating badge + book button.
- **Category Filters**: Filter aktif + sort dropdown + price range slider.
- **Booking Form**: Date picker + guest counter + total price dinamis.
- **Payment Form**: Card number formatter + order summary.
- **Auth Flow**: Form login/register dengan validasi dan alert messages.

---

## Keamanan

- CSRF Protection pada semua form.
- Request Validation di setiap Controller.
- Pengecekan autentikasi (Auth check) sebelum booking.
- Pengecekan ketersediaan akun saat login.
- Input sanitization via Laravel Validation.

---

**GODuls** © 2026 — All rights reserved.
