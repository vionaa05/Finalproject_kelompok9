# 📘 Final Project RPL-Sistem Absensi UKM PIKMA


## 👨‍💻 Nama kelompok & anggota

| No |     Nama Anggota     |                                                    NIM / Jobdesk                                                 |
| -- | -------------------- | ---------------------------------------------------------------------------------------------------------------- |
| 1. | Viona Ardila         | 701230202 (Menyusun dokumen SRS, Membuat ERD, Use Case, Arsitektur Desain, Coding Website, Deployment, Hosting)  |
| 2. | Adhelia Amanda Silvy | 701230394 (Membuat Arsitektur Diagram, Activity Diagram, Membuat Mockup, Membuat PPT, Wawancara kepada User)     |
| 3. | Eka Puteri S.N       | 701230308 (Membuat Class Diagram, Melakukan Testing, Membantu membuat PPT)                                       |


## 📝 Deskripsi Singkat Aplikasi

Sistem ini dibuat berdasarkan permintaan dari klien (kelompok 7)

Sistem Absensi UKM PIKMA adalah aplikasi web yang dirancang untuk mendigitalkan proses pencatatan kehadiran anggota dalam setiap kegiatan organisasi. Sistem ini menghilangkan penggunaan absensi manual (kertas) dan menyediakan bukti kehadiran yang akurat melalui fitur Absensi Swafoto Langsung (Live Camera).


## 🎯 Tujuan Sistem 

Mengatasi risiko data hilang dan sulitnya rekapitulasi manual.
Mencapai akuntabilitas data melalui bukti foto dan pencatatan waktu otomatis.
Menyediakan akses yang mudah dan responsif di perangkat mobile (smartphone).


## 🛠️ Teknologi yang Digunakan (framework, database, bahasa pemrograman)

    -Pola Arsitektur: Monolitik (Berbasis Server)

    -Design Pattern: Model-View-Controller (MVC)

    -Bahasa Pemrograman: PHP 8.2+ dan JavaScript.

    -Framework: Laravel.

    -Database: MySQL.

    -Antarmuka: Bootstrap 5 (Responsive Design).

    -Tools Tambahan: Composer (Dependency Management), Git.


## 🚀 Cara Menjalankan Aplikasi

    Instalasi dan Konfigurasi

    1. Clone Repository:
    git clone [https://github.com/USERNAME/Finalproject_kelompok9.git](https://github.com/USERNAME/Finalproject_kelompok9.git) srs-absensi-pikma
    cd srs-absensi-pikma
    2. Instalasi Dependencies:
    composer install
    3. Setup Environment:
      -Salin .env.example menjadi .env.
      -Generate Application Key: php artisan key:generate
    4. Konfigurasi Database:
      -Buat database baru di phpMyAdmin (misal: srs_absensi_pikma).
      -Atur koneksi DB di .env (DB_HOST=127.0.0.1, DB_USERNAME=root, dll.).
    5. Migrasi Database:
       php artisan migrate:fresh
    6. Seed Data Admin (Wajib Login Awal):
       php artisan db:seed --class=AdminSeeder


## 🔐 Akun Demo (jika ada login):

    - 🛡️ Login Admin
    • username: admin_pikma
    • password: password123

## Tampilan Website
https://drive.google.com/drive/folders/1GuM3Ca1Erwoxphh_xPXxXrksDWcXNtLr?usp=sharing


## 📋 Keterangan tugas

Project ini ditujukan untuk memenuhi tugas Final Project mata kuliah Rekayasa Perangkat Lunak (RPL) pada Semester 5 dengan dosen pengampu: Dila Nurlaila, M.Kom.
