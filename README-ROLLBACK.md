# Rollback ke versi sebelum ZIP lengkap

Paket ini mengembalikan kode utama ke kondisi sebelum paket ZIP lengkap dipasang.

## Fitur yang dipertahankan
- Beranda statis dengan desain hijau sebelumnya
- Login admin/operator memakai username
- Dashboard lama tanpa sidebar
- CRUD berita: daftar, tambah, edit, hapus, upload gambar
- Tombol login pengelola pada beranda
- Banner ajakan PPDB selalu tampil

## Cara memasang
1. Cadangkan folder project saat ini.
2. Ekstrak ZIP ini.
3. Salin isi folder hasil ekstrak ke:
   C:\xampp\htdocs\web-mts-arridho
4. Pilih Replace/Timpa saat Windows meminta konfirmasi.
5. Pastikan file berikut tetap ada:
   public/images/logo-mts.png
   public/images/kepmad.jpeg
6. Jalankan:
   php artisan optimize:clear
   npm run dev
7. Buka terminal kedua dan jalankan:
   php artisan serve

## Catatan database
Tabel tambahan dari ZIP lengkap, seperti pengumuman, agenda, galeri, dan pengaturan, tidak dihapus oleh paket ini. Tabel tersebut tidak digunakan dan aman dibiarkan.

Jangan menjalankan `php artisan migrate:fresh`, karena akan menghapus seluruh data.
