# GODuls - Travel E-Commerce Laravel

GODuls adalah platform e-commerce modern berbasis Laravel yang dirancang khusus untuk memudahkan pemesanan tiket wisata dan travel. Dengan antarmuka pengguna yang menarik, responsif, serta terintegrasi dengan gateway pembayaran populer, GODuls menawarkan pengalaman pemesanan liburan yang mulus dari pencarian destinasi hingga pembayaran.

---

## 🚀 Fitur Utama (Product Features)

1. **Sistem Autentikasi Pengguna**
   - Registrasi dan Login pengguna.
   - Keamanan dengan proteksi CSRF dan enkripsi password.
   - Sesi pengguna untuk manajemen akun.

2. **Eksplorasi & Pencarian Destinasi**
   - Katalog destinasi wisata yang komprehensif.
   - Fitur pencarian interaktif dan dropdown hasil pencarian.
   - Filter kategori dan pengurutan harga.

3. **Sistem Pemesanan (Booking System)**
   - Formulir pemesanan dinamis dengan pemilihan tanggal (date picker).
   - Penyesuaian jumlah tamu dan perhitungan harga otomatis secara real-time.
   - Ringkasan pesanan sebelum melanjutkan ke pembayaran.

4. **Integrasi Pembayaran (Payment Gateway)**
   - Terintegrasi dengan **Midtrans Snap API** untuk proses pembayaran yang aman dan profesional.
   - Mendukung berbagai metode pembayaran (Kartu Kredit, Bank Transfer/VA, e-Wallet, dll).
   - Popup pembayaran interaktif tanpa harus berpindah halaman.

5. **Antarmuka Modern & Responsif (UI/UX)**
   - Desain premium dengan animasi mikro, efek parallax, dan efek transisi.
   - Desain yang ramah pengguna baik untuk perangkat mobile maupun desktop.
   - Sistem newsletter untuk berlangganan info wisata terbaru.

---

## 🛠️ Stack Teknologi (Tech Stack)

| Kategori    | Teknologi                          |
|-------------|------------------------------------|
| **Backend** | Laravel (PHP 8.2+)                 |
| **Frontend**| Blade Templates, HTML5             |
| **Styling** | Tailwind CSS (CDN), Custom CSS     |
| **Database**| MySQL / PostgreSQL (Supabase)      |
| **Payment** | Midtrans API (Snap)                |
| **Icons**   | Lucide Icons, Font Awesome         |
| **Fonts**   | Google Fonts (Inter, Poppins)      |

---

## 🏗️ Struktur Detail Produk & Arsitektur

Platform GODuls dibangun dengan pola arsitektur MVC (Model-View-Controller) yang kokoh melalui kerangka kerja Laravel. 

- **Model Layer**: Menangani representasi data dan interaksi dengan database (menggunakan Eloquent ORM). Tabel utama meliputi `users`, `destinations`, dan `bookings`.
- **View Layer**: Dibangun menggunakan Laravel Blade yang dikombinasikan dengan Tailwind CSS untuk menghasilkan UI yang cepat, dinamis, dan terstruktur ke dalam berbagai layout dan komponen.
- **Controller Layer**: Memproses logika bisnis, validasi request, dan menghubungkan data antara Model dan View.
- **Service Layer (Eksternal)**: Menggunakan layanan pihak ketiga seperti Midtrans untuk memproses transaksi dengan aman, mengurangi beban pada server utama.

### Struktur Folder Laravel

```text
GODuls-Laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php          # Logika Login & Register
│   │       ├── HomeController.php          # Pengatur Halaman Beranda
│   │       ├── DestinationController.php   # Manajemen & Tampilan Destinasi
│   │       ├── BookingController.php       # Logika Pembuatan & Perhitungan Booking
│   │       ├── PaymentController.php       # Integrasi Midtrans & Callback
│   │       └── NewsletterController.php    # Modul Langganan Newsletter
│   └── Models/
│       ├── User.php                        # Representasi entitas User
│       ├── Destination.php                 # Representasi entitas Destinasi Wisata
│       └── Booking.php                     # Representasi transaksi Pemesanan
├── config/
│   └── midtrans.php                        # Konfigurasi kunci Midtrans
├── database/
│   └── migrations/                         # Skema database (users, destinations, bookings)
├── public/
│   └── assets/
│       └── css/
│           └── app.css                     # Gaya CSS khusus & utilitas UI
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php             # Antarmuka Login
│       │   └── register.blade.php          # Antarmuka Register
│       ├── layouts/
│       │   ├── app.blade.php               # Template Master (Kerangka Utama)
│       │   ├── header.blade.php            # Navigasi & Pencarian
│       │   └── footer.blade.php            # Footer aplikasi
│       └── pages/
│           ├── home.blade.php              # Halaman Utama (Hero, Featured, dll)
│           ├── destinations.blade.php      # Daftar Seluruh Destinasi
│           ├── booking.blade.php           # Halaman Form Booking Terintegrasi
│           └── payment.blade.php           # Tampilan Sukses Pembayaran / Invoice
└── routes/
    └── web.php                             # Definisi Seluruh Rute Aplikasi
```

---

## ⚙️ Prasyarat & Instalasi (Setup)

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & npm (Opsional, untuk kompilasi asset jika dibutuhkan)
- Database (MySQL atau PostgreSQL)
- Akun Midtrans (Sandbox/Production untuk Gateway Pembayaran)

### Langkah-langkah Instalasi

1. **Clone atau Ekstrak Project**
   ```bash
   cd GODuls-Pesan-TIket-Mudah
   ```

2. **Install Dependensi PHP**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   Salin file environment example:
   ```bash
   cp .env.example .env
   ```
   Generate application key:
   ```bash
   php artisan key:generate
   ```

4. **Konfigurasi Database & Layanan**
   Buka file `.env` dan atur koneksi database Anda:
   ```env
   DB_CONNECTION=mysql # atau pgsql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Tambahkan juga Kredensial Midtrans Anda di bagian bawah file `.env`:
   ```env
   MIDTRANS_MERCHANT_ID=your_merchant_id
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_IS_PRODUCTION=false
   ```

5. **Jalankan Migrasi Database**
   Buat tabel ke dalam database:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server Development**
   ```bash
   php artisan serve
   ```
   Buka browser dan akses proyek pada URL: **http://localhost:8000**

---

## 🗺️ Daftar Rute Aplikasi (Routes)

| Method | URL                                   | Nama Route             | Fungsi                 |
|--------|---------------------------------------|------------------------|------------------------|
| GET    | `/`                                   | `home`                 | Halaman beranda        |
| GET    | `/login`                              | `login`                | Halaman form login     |
| POST   | `/login`                              | `login.submit`         | Proses autentikasi     |
| GET    | `/register`                           | `register`             | Halaman form registrasi|
| POST   | `/register`                           | `register.submit`      | Proses simpan akun     |
| POST   | `/logout`                             | `logout`               | Proses keluar akun     |
| GET    | `/destinations`                       | `destinations.index`   | Katalog destinasi      |
| GET    | `/destinations/{id}/booking`          | `booking.show`         | Tampilan form booking  |
| POST   | `/destinations/{id}/booking`          | `booking.store`        | Simpan data & dapatkan Token Midtrans Snap |
| POST   | `/newsletter/subscribe`               | `newsletter.subscribe` | Langganan email newsletter |

---

## 🔒 Keamanan (Security)

Aplikasi ini mengimplementasikan best-practice keamanan Laravel:
- **CSRF Protection**: Melindungi aplikasi dari aksi pengiriman form yang tidak sah (Cross-Site Request Forgery).
- **Sanitasi Input**: Menggunakan validasi di tingkat Controller untuk semua data masuk pengguna (Input Sanitization & Validation).
- **Verifikasi Autentikasi**: Sistem middleware melindungi rute yang memerlukan status login (seperti proses pemesanan dan checkout).
- **Keamanan Pembayaran**: Semua kunci rahasia disimpan di sisi server (`.env`). Proses verifikasi token Midtrans dilakukan di backend dengan *Server Key* yang dirahasiakan, sehingga integritas transaksi terjamin.

---

**GODuls Travel E-Commerce** © 2026 — *Pesan Tiket Mudah dan Aman*. All rights reserved.
