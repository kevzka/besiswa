# 🎓 ADASISWA - Sistem Informasi Kesiswaan SMK Telkom Banjarbaru

> **💡 Catatan**: Untuk saran judul repository yang lebih baik dan deskriptif, silakan lihat [REPOSITORY_TITLE_SUGGESTIONS.md](REPOSITORY_TITLE_SUGGESTIONS.md)

<p align="center">
  <img src="public/img/logo.png" alt="ADASISWA Logo" width="200">
</p>

<p align="center">
  <strong>Sarana digital untuk menghimpun informasi, menyalurkan kreativitas, dan mempererat hubungan antar siswa dan guru demi terciptanya sekolah yang aktif, inovatif, dan berprestasi.</strong>
</p>

<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel" alt="Laravel"></a>
  <a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php" alt="PHP"></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=flat&logo=tailwind-css" alt="Tailwind CSS"></a>
  <a href="https://livewire.laravel.com"><img src="https://img.shields.io/badge/Livewire-3.x-FB70A9?style=flat" alt="Livewire"></a>
</p>

---

## 📸 Screenshot

> **Note**: Screenshot tampilan aplikasi akan ditambahkan segera. Sementara itu, Anda dapat melihat panduan lengkap untuk mengambil screenshot di file [SCREENSHOT_GUIDE.md](SCREENSHOT_GUIDE.md).

**Untuk melihat tampilan aplikasi:**
1. Clone repository ini
2. Ikuti langkah instalasi di bawah
3. Jalankan aplikasi di `http://localhost:8000`

---

## 📖 Tentang ADASISWA

**ADASISWA** adalah platform manajemen informasi kesiswaan berbasis web yang dikembangkan khusus untuk **SMK Telkom Banjarbaru**. Sistem ini dirancang untuk mengelola berbagai aspek kegiatan siswa, mulai dari pencatatan prestasi, bimbingan konseling, kegiatan ekstrakurikuler, hingga portofolio siswa.

### ✨ Fitur Utama

ADASISWA memiliki 4 modul utama yang mengelola berbagai aspek kesiswaan:

#### 1. 📚 **Bimbingan & Konseling**
- Pengelolaan data kegiatan bimbingan dan konseling siswa
- Pencatatan riwayat konseling
- Dokumentasi bukti dan evidence kegiatan
- Dashboard monitoring untuk guru BK

#### 2. 🏆 **Prestasi**
- Pencatatan prestasi siswa di berbagai bidang
- Manajemen tingkat lomba (Sekolah, Kecamatan, Kota, Provinsi, Nasional, Internasional)
- Sistem poin prestasi berdasarkan tingkat juara
- Dokumentasi sertifikat dan bukti prestasi
- Statistik prestasi per siswa dan angkatan

#### 3. 🎨 **Ekstrakurikuler**
- Manajemen kegiatan ekstrakurikuler
- Pencatatan partisipasi siswa
- Dokumentasi kegiatan ekskul
- Laporan aktivitas per periode

#### 4. 📁 **Portofolio**
- Portofolio digital siswa per angkatan
- Dokumentasi karya dan projek siswa
- Galeri foto kegiatan
- Filter berdasarkan kelas dan jurusan

### 🎯 Tujuan

- **Digitalisasi** data kesiswaan untuk memudahkan akses dan pengelolaan
- **Transparansi** informasi prestasi dan kegiatan siswa
- **Dokumentasi** sistematis terhadap pencapaian siswa
- **Monitoring** perkembangan siswa secara real-time
- **Peningkatan** kualitas pembinaan dan bimbingan siswa

---

## 🛠 Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 12.x
- **PHP**: 8.2+
- **Database**: SQLite (dapat diganti dengan MySQL/PostgreSQL)
- **Authentication**: JWT Auth (tymon/jwt-auth)

### Frontend
- **CSS Framework**: Tailwind CSS 4.0
- **JavaScript**: Livewire 3.x untuk interaktivitas real-time
- **Build Tool**: Vite
- **Icons**: Font Awesome 5
- **Alerts**: SweetAlert2

### Development Tools
- **Package Manager**: Composer & NPM
- **Code Quality**: Laravel Pint
- **Database Tools**: Laravel Migrations Generator
- **Development Server**: Laravel Sail

---

## 📋 Prasyarat

Sebelum menginstal ADASISWA, pastikan sistem Anda memiliki:

- PHP >= 8.2
- Composer
- Node.js >= 18.x dan NPM
- SQLite (atau MySQL/PostgreSQL)
- Extension PHP yang diperlukan:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/kevzka/besiswa.git
cd besiswa
```

### 2. Install Dependencies

```bash
# Install dependencies PHP
composer install

# Install dependencies JavaScript
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate JWT secret key
php artisan jwt:secret
```

### 4. Setup Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=sqlite
# Atau untuk MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=besiswa
# DB_USERNAME=root
# DB_PASSWORD=
```

Jalankan migrasi dan seeder:

```bash
# Jalankan migrasi database
php artisan migrate

# Jalankan seeder untuk data awal
php artisan db:seed
```

### 5. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 6. Jalankan Aplikasi

```bash
# Menggunakan artisan serve
php artisan serve

# Atau menggunakan Laravel Sail (Docker)
./vendor/bin/sail up
```

Aplikasi akan berjalan di `http://localhost:8000`

---

## 👤 Default User

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

**Admin Utama**
- Username: `admin`
- Password: `password`

*(Silakan ubah password setelah login pertama kali)*

---

## 📁 Struktur Database

### Tabel Utama

- **users (admins)**: Data admin/guru pengelola sistem
- **tb_roles**: Role/peran pengguna (BK, Prestasi, Ekskul, Utama)
- **tb_siswas**: Data siswa (NIS, nama, kelas, jurusan, angkatan)
- **tb_evidences**: Dokumentasi kegiatan (title, file, description, date)
- **tb_lombas**: Data lomba/kompetisi (tingkat, juara, poin)
- **tb_siswas_lombas**: Relasi siswa dengan lomba

---

## 🎨 Fitur Unggulan

### 1. Dashboard Interaktif
- Statistik prestasi siswa
- Grafik perkembangan kegiatan
- Notifikasi kegiatan terbaru

### 2. Sistem Poin
- Perhitungan otomatis poin berdasarkan tingkat lomba
- Akumulasi poin per siswa (poin_jiwa)
- Leaderboard prestasi

### 3. Manajemen File
- Upload dokumen (PDF, gambar)
- Preview PDF dengan thumbnail
- Penyimpanan terorganisir per kategori

### 4. Filter & Pencarian
- Filter berdasarkan angkatan
- Filter berdasarkan kelas dan jurusan
- Pencarian siswa dan kegiatan

### 5. Responsive Design
- Tampilan optimal di desktop, tablet, dan mobile
- UI/UX modern dengan Tailwind CSS
- Loading states dan animations

---

## 🔐 Keamanan

- **Authentication**: JWT-based authentication
- **Authorization**: Role-based access control
- **CSRF Protection**: Built-in Laravel CSRF protection
- **Password Hashing**: Bcrypt password hashing
- **Input Validation**: Server-side validation untuk semua input

---

## 📱 API Endpoints

Untuk integrasi dengan sistem lain, ADASISWA menyediakan API endpoints:

```
POST /api/login          - Login dan dapatkan JWT token
POST /api/logout         - Logout user
POST /api/getProfile     - Ambil data profil user
GET  /api/evidences      - List semua evidence
POST /api/evidences      - Tambah evidence baru
```

*(Detail lengkap API ada di dokumentasi API)*

---

## 🧪 Testing

Jalankan test suite:

```bash
# Jalankan semua test
php artisan test

# Jalankan test tertentu
php artisan test --filter=ExampleTest
```

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📝 Development Notes

### Auto Login (Development Only)

Untuk kemudahan testing di environment lokal:

```
GET /dev-login/{id}?token=SECRET_TOKEN
```

*(Fitur ini hanya aktif di environment `local`)*

### Available Commands

```bash
# Jalankan development server dengan semua services
composer run dev

# Format code dengan Laravel Pint
./vendor/bin/pint

# Generate migration dari database existing
php artisan migrate:generate
```

---

## 📞 Kontak & Media Sosial

**SMK Telkom Banjarbaru**

- 📷 Instagram: [@smktelkombanjarbaru](https://www.instagram.com/smktelkombanjarbaru/)
- 🎥 YouTube: [SMK Telkom Banjarbaru](https://www.youtube.com/@telkomschoolbanjarbaru4509)
- 🌐 Website: [smktelkom-bjb.sch.id](https://smktelkom-bjb.sch.id)

---

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

---

## 👨‍💻 Developer

Dikembangkan dengan ❤️ oleh Tim IT SMK Telkom Banjarbaru

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - Web application framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Livewire](https://livewire.laravel.com) - Full-stack framework for Laravel
- [Font Awesome](https://fontawesome.com) - Icon library
- [SweetAlert2](https://sweetalert2.github.io) - Beautiful, responsive alerts

---

<p align="center">
  Made with ❤️ for SMK Telkom Banjarbaru
</p>
