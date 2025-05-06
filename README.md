<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Faratrans

Faratrans adalah aplikasi berbasis Laravel yang dirancang untuk mempermudah pengelolaan layanan transportasi, seperti pemesanan mobil, paket wisata, dan lainnya.

## Fitur Utama

- **Manajemen Pemesanan**: Kelola pemesanan transportasi dengan mudah.
- **Manajemen Mobil**: Tambah, edit, dan hapus data mobil.
- **Paket Wisata**: Kelola paket wisata yang tersedia.
- **Galeri**: Tampilkan galeri foto untuk promosi.
- **FAQ**: Kelola daftar pertanyaan yang sering diajukan.
- **Kontak**: Kelola informasi kontak pelanggan.

## Instalasi

1. Clone repositori ini:
   ```bash
   git clone <repository-url>
   cd faratrans
   ```

2. Instal dependensi PHP menggunakan Composer:
   ```bash
   composer install
   ```

3. Instal dependensi JavaScript menggunakan npm:
   ```bash
   npm install
   ```

4. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi:
   ```bash
   cp .env.example .env
   ```

5. Generate kunci aplikasi:
   ```bash
   php artisan key:generate
   ```

6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

7. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```

## Struktur Proyek

- **`app/`**: Berisi logika aplikasi, termasuk model, controller, dan resource.
- **`config/`**: Berisi file konfigurasi aplikasi.
- **`database/`**: Berisi migrasi, seeder, dan file database SQLite.
- **`public/`**: Berisi file yang dapat diakses publik, seperti gambar dan file build.
- **`resources/`**: Berisi view dan aset yang dapat dikompilasi.
- **`routes/`**: Berisi definisi rute aplikasi.
- **`tests/`**: Berisi pengujian unit dan fitur.

## Kontribusi

Kami menyambut kontribusi dari siapa saja. Silakan buat pull request atau laporkan masalah di [issue tracker](<repository-url>/issues).

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).
