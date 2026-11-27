# KUNING EMAS — Fine Dining Nasi Kuning Management

Aplikasi web manajemen restoran fine dining **KUNING EMAS** berbasis **Laravel 11**, **Laravel Breeze**, **MySQL**, dan **Blade Template**. Proyek ini disusun sebagai Tugas Pengganti UTS mata kuliah **Penerapan Teknologi Internet (PTI)** dengan dosen pengampu **Donny Reza, M.Kom**.

## Identitas Mahasiswa & Mata Kuliah
- **Nama:** Adrian Mulya Wijaya
- **NIM:** 10124016
- **Kelas:** IF-1
- **Mata Kuliah:** Penerapan Teknologi Internet (PTI)
- **Dosen Pengampu:** Donny Reza, M.Kom
- **Status Pengerjaan:** Mandiri (1 orang — jumlah mahasiswa di kelas ganjil)

## Teknologi yang Digunakan
- **Backend & Framework:** PHP, Laravel 11
- **Authentication:** Laravel Breeze
- **Database & ORM:** MySQL, Eloquent ORM, Laravel Migrations & Seeders
- **Frontend & View:** Blade Template, HTML5, CSS3

## Fitur Utama
- **Autentikasi Pengguna:** Register, login, logout menggunakan Laravel Breeze serta proteksi rute privat (`middleware('auth')`) dan CSRF protection.
- **CRUD Kategori (`categories`) & Relasi Menu:** Kelola kategori menu (`name`, `slug`, `description`) dengan relasi *one-to-many* ke tabel `menus` dan proteksi penghapusan bila masih dipakai menu.
- **CRUD Menu (`menus`):** Tambah, ubah, hapus, upload foto menu (`storage/app/public/menus`), ubah status ketersediaan (`is_available`), serta filter kategori & pencarian di halaman utama.
- **CRUD Promo (`promotions`):** Kelola kode promo, persentase diskon, deskripsi, dan status aktif (`is_active`).
- **Manajemen Reservasi (`reservations`):** Pemesanan meja oleh tamu dari halaman depan serta pembaruan status dan penghapusan reservasi oleh admin.

## Cara Menjalankan di Lokal
1. Install dependensi: `composer install`
2. Salin konfigurasi: `cp .env.example .env`
3. Generate key: `php artisan key:generate`
4. Atur database MySQL di file `.env`, lalu jalankan:
   - `php artisan migrate`
   - `php artisan storage:link`
5. Jalankan server: `php artisan serve`