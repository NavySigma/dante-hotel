<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# 🏨 Dante Hotel

Sistem manajemen pemesanan kamar hotel berbasis web yang dibangun dengan Laravel. Proyek ini dirancang untuk mempermudah pengelolaan kamar, kategori, dan transaksi sewa antara admin dan pelanggan.

---

## 💡 Latar Belakang

Proyek ini dibuat sebagai solusi sederhana untuk manajemen hotel skala kecil hingga menengah. Banyak hotel masih mengelola pemesanan secara manual, sehingga rentan terhadap kesalahan dan tidak efisien. Dante Hotel hadir untuk menyederhanakan proses tersebut melalui sistem berbasis web yang mudah digunakan oleh admin maupun pelanggan.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi                               | Keterangan                    |
| --------------------------------------- | ----------------------------- |
| [Laravel 11](https://laravel.com)       | PHP Framework utama           |
| [Tailwind CSS](https://tailwindcss.com) | Styling UI                    |
| [Vite](https://vitejs.dev)              | Asset bundler                 |
| [MySQL](https://www.mysql.com)          | Database                      |
| [XAMPP](https://www.apachefriends.org)  | Local server (Apache + MySQL) |
| Blade Templating                        | Template engine Laravel       |

---

## ⚙️ Cara Install

### Prasyarat

- PHP >= 8.2
- Composer
- Node.js & NPM
- XAMPP (atau MySQL server lainnya)

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/username/dante-hotel.git
cd dante-hotel

# 2. Install dependencies PHP
composer install

# 3. Install dependencies Node
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate app key
php artisan key:generate
```

Sesuaikan konfigurasi database di file `.env`:

```env
DB_DATABASE=dante_hotel
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 6. Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# 7. Build assets
npm run build

# 8. Jalankan aplikasi
php artisan serve
```

Akses di browser: `http://localhost:8000`

---

## ✨ Fitur

### 👤 Autentikasi

- Login & Register pelanggan
- Role-based access (Admin & Customer)
- Middleware proteksi halaman per role

### 🛎️ Admin

- **Dashboard** — ringkasan data hotel
- **Manajemen Kategori** — tambah, edit, hapus kategori kamar
- **Manajemen Kamar** — tambah, edit, hapus data kamar beserta foto
- **Manajemen Sewa** — lihat detail transaksi, update status, checkout, dan hapus data sewa

### 🙋 Customer

- **Lihat Kamar** — browse kamar yang tersedia beserta harga dan detail
- **Pemesanan** — pesan kamar dengan pilihan tanggal check-in, lama menginap, dan metode pembayaran
- **Riwayat Pemesanan** — lihat histori sewa yang pernah dilakukan
- **Rating Kamar** — beri rating bintang untuk kamar yang pernah disewa
- **Pengaturan Akun** — update data profil

---

## 📁 Struktur Direktori Utama

```
app/
├── Http/Controllers/
│   ├── Admin/          # Controller untuk admin
│   └── Anggota/        # Controller untuk customer
├── Models/             # Eloquent models
resources/views/
├── pages/
│   ├── admin/          # Halaman admin
│   ├── customer/       # Halaman customer
│   └── auth/           # Halaman login & register
└── components/         # Layout & komponen reusable
```

---

## 🚀 Saran Pengembangan

Beberapa hal yang bisa dikembangkan ke depannya:

- Integrasi payment gateway (Midtrans / Xendit)
- Notifikasi email konfirmasi pemesanan
- Export laporan sewa ke PDF / Excel
- Fitur pencarian dan filter kamar yang lebih lengkap
- Tampilan mobile yang lebih optimal (PWA)

---

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
