UTS Pemrograman Web 
Aplikasi Biodata Tim

Aplikasi web sederhana untuk mengelola biodata anggota tim, dibuat sebagai tugas Ujian Tengah Semester (UTS) mata kuliah Pemrograman Web. Aplikasi ini mengimplementasikan operasi CRUD (Create, Read, Update, Delete) lengkap dengan unggah foto untuk setiap anggota.
Fitur
- Tambah biodata** lewat modal form (nama, deskripsi tugas, dan foto)
- Tampilkan biodata** dalam bentuk kartu (card) yang responsif
- Edit biodata** anggota yang sudah ada
- Hapus biodata** anggota
- Unggah foto untuk setiap anggota
- Notifikasi berhasil/gagal setelah setiap aksi, misalnya "Biodata berhasil diperbarui."

Tampilan Aplikasi

Halaman Utama

Halaman utama menampilkan daftar biodata dalam bentuk kartu. Tombol hijau **+** dipakai untuk menambah biodata baru, sedangkan tombol **Edit** dan **Hapus** ada di setiap kartu.

![Halaman Utama](docs/screenshots/home.png)

Form Tambah Biodata

Klik tombol + untuk membuka modal Tambah Biodata. Isi nama, deskripsi tugas, dan pilih foto, lalu klik Simpan.

![Form Tambah Biodata](docs/screenshots/tambah-biodata.png)

Teknologi yang Digunakan
- [Laravel](https://laravel.com/) (PHP) sebagai framework back-end
- Blade Template Engine untuk tampilan
- [Bootstrap 5](https://getbootstrap.com/) untuk antarmuka

Cara Menjalankan di Lokal

Langkah Instalasi

UTS-Pemrograman-WEB/
├── app/
│   ├── Http/Controllers/     # Logika CRUD biodata
│   └── Models/               # Model biodata
├── database/migrations/      # Struktur tabel
├── resources/views/          # Tampilan Blade
├── routes/web.php            # Routing aplikasi
├── public/                   # Aset publik
└── docs/screenshots/         # Gambar untuk README

Tim Pengembang


Bagus Zyga W 24010110193 (Master Frontend)
Iklimah 24010110193 (Backend)

Lisensi
Proyek ini dibuat untuk keperluan akademik.
