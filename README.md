# Sistem Informasi PPDB (Penerimaan Peserta Didik Baru)

Sistem ini dikembangkan menggunakan framework **Laravel** untuk mengelola proses pendaftaran siswa baru, mulai dari manajemen jadwal, jurusan, hingga verifikasi berkas oleh admin.

---

## 🛠 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Persyaratan Sistem

* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL / MariaDB

---

### 2. Kloning Repositori

```bash
git clone https://github.com/username/repository-name.git
cd repository-name
```

---

### 3. Instalasi Dependency

Instal dependensi PHP menggunakan Composer:

```bash
composer install
```

Instal dependensi JavaScript menggunakan NPM:

```bash
npm install
```

---

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian sesuaikan konfigurasi berikut:

* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD

> ⚠️ Karena aplikasi menggunakan fitur email (verifikasi), pastikan konfigurasi MAIL_* juga sudah diisi dengan benar.

---

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

### 6. Migrasi Database

```bash
php artisan migrate
```

---

### 7. Jalankan Aplikasi

Gunakan dua terminal:

**Terminal 1 - Laravel Server**

```bash
php artisan serve
```

**Terminal 2 - Vite**

```bash
npm run dev
```

---

## 🗄️ Panduan Database

Aplikasi ini memiliki struktur database yang saling berelasi untuk mendukung proses PPDB.
Sebagian besar tabel menggunakan fitur **SoftDeletes**.

---

### 📊 Tabel Utama & Relasi

| Nama Tabel        | Deskripsi                           | Relasi Utama                |
| ----------------- | ----------------------------------- | --------------------------- |
| users             | Menyimpan data akun (Admin & Siswa) | hasOne siswa                |
| siswa             | Detail identitas calon siswa        | belongsTo users & orang_tua |
| orang_tua         | Data ayah dan ibu calon siswa       | hasOne siswa                |
| jadwal_ppdb       | Pengaturan tahun ajaran dan kuota   | hasMany pendaftaran         |
| jurusan           | Daftar pilihan jurusan              | hasMany pendaftaran         |
| kategori_prestasi | Jalur prestasi                      | hasMany pendaftaran         |
| pendaftaran       | Tabel utama                         | belongsTo semua tabel       |

---

### 🔗 Detail Relasi Penting

* Pendaftaran adalah pusat sistem
* Menyimpan:

  * status_verifikasi
  * status_aktual

---

### ♻️ Soft Deletes

Data tidak dihapus permanen, tetapi ditandai di kolom `deleted_at`.

---

### 🔄 Casting

* is_active → boolean
* is_announced → boolean

---

## 🚀 Fitur Utama

### 📊 Dashboard Statistik

* Visualisasi data menggunakan Highcharts

### 👤 Manajemen User

* CRUD user
* Hapus relasi otomatis

### ✅ Verifikasi Berkas

* Setujui, tolak, atau revisi

### 📧 Notifikasi Email

* Menggunakan queue

### 📄 Export Data

* PDF (DomPDF)
* Excel (SimpleExcel)

---

## 📌 Catatan

```bash
php artisan queue:work
```

---

## 👨‍💻 Kontributor

* Developer: Rodhiyati
* Framework: Laravel
