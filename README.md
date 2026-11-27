# KUNING EMAS — Fine Dining Nasi Kuning Management

Aplikasi web manajemen restoran fine dining **KUNING EMAS** berbasis **Laravel 11**, **Laravel Breeze**, **MySQL**, dan **Blade**.

## Fitur Utama
- Autentikasi pengguna (Register, Login, Logout) dengan Laravel Breeze dan proteksi rute (`middleware('auth')`).
- **CRUD Kategori (`categories`)** berelasi *one-to-many* dengan **CRUD Menu (`menus`)**, termasuk upload foto menu, filter kategori, pencarian, dan ubah status ketersediaan.
- **CRUD Promo (`promotions`)** untuk kode promo, diskon, dan status aktif.
- **Manajemen Reservasi (`reservations`)** untuk pemesanan meja tamu dari halaman depan serta pembaruan status/penghapusan oleh admin.

## Cara Menjalankan di Lokal
1. Install dependensi: `composer install`
2. Salin konfigurasi: `cp .env.example .env`
3. Generate key: `php artisan key:generate`
4. Atur database MySQL di file `.env`, lalu jalankan:
   - `php artisan migrate`
   - `php artisan storage:link`
5. Jalankan server: `php artisan serve`
