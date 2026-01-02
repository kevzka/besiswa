# 📸 Panduan Screenshot untuk README

## Status Screenshot
Saat ini, dokumentasi README sudah dibuat dengan lengkap. Namun, **screenshot tampilan aplikasi** belum dapat diambil karena keterbatasan environment development.

## Screenshot yang Direkomendasikan

Untuk melengkapi README.md, disarankan untuk menambahkan screenshot berikut:

### 1. **Landing Page** 
   - **File**: `screenshots/landing-page.png`
   - **URL**: `/dashboard` atau `/`
   - **Deskripsi**: Halaman utama ADASISWA dengan hero section dan navigasi

### 2. **Dashboard Admin**
   - **File**: `screenshots/admin-dashboard.png`
   - **URL**: `/admin/dashboard`
   - **Deskripsi**: Dashboard utama untuk admin dengan statistik

### 3. **Halaman Prestasi**
   - **File**: `screenshots/prestasi-page.png`
   - **URL**: `/prestasi/{deg}` atau `/admin/prestasi`
   - **Deskripsi**: Tampilan daftar prestasi siswa

### 4. **Halaman Bimbingan & Konseling**
   - **File**: `screenshots/bimbingan-page.png`
   - **URL**: `/bimbingan/{deg}` atau `/admin/bimbingan`
   - **Deskripsi**: Halaman manajemen bimbingan konseling

### 5. **Halaman Ekstrakurikuler**
   - **File**: `screenshots/ekskul-page.png`
   - **URL**: `/ekskul/{deg}` atau `/admin/ekskul`
   - **Deskripsi**: Tampilan kegiatan ekstrakurikuler

### 6. **Halaman Portofolio**
   - **File**: `screenshots/portofolio-page.png`
   - **URL**: `/portofolio/{deg}`
   - **Deskripsi**: Galeri portofolio siswa per angkatan

### 7. **Form Input/Edit**
   - **File**: `screenshots/form-input.png`
   - **URL**: `/admin/prestasi/create` atau `/admin/bimbingan/create`
   - **Deskripsi**: Form untuk menambah data baru

### 8. **Mobile Responsive View**
   - **File**: `screenshots/mobile-view.png`
   - **Deskripsi**: Tampilan responsive di perangkat mobile

## Cara Mengambil Screenshot

### Opsi 1: Manual (Direkomendasikan)
1. Jalankan aplikasi: `php artisan serve`
2. Install NPM dependencies: `npm install`
3. Build assets: `npm run dev`
4. Setup database: `php artisan migrate --seed`
5. Buka browser dan akses `http://localhost:8000`
6. Login dengan kredensial default
7. Navigasi ke setiap halaman dan ambil screenshot
8. Simpan ke folder `screenshots/` di root project

### Opsi 2: Menggunakan Screenshot Tools
- **Windows**: Snipping Tool atau Win + Shift + S
- **Mac**: Cmd + Shift + 4
- **Linux**: Flameshot, GNOME Screenshot
- **Browser Extension**: Full Page Screen Capture, Awesome Screenshot

### Opsi 3: Otomatis dengan Playwright/Puppeteer
```javascript
// Contoh script untuk ambil screenshot otomatis
const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage();
  
  await page.goto('http://localhost:8000');
  await page.screenshot({ path: 'screenshots/landing-page.png', fullPage: true });
  
  await browser.close();
})();
```

## Menambahkan Screenshot ke README

Setelah screenshot diambil, tambahkan section berikut ke README.md:

```markdown
## 📸 Screenshot

### Landing Page
![Landing Page](screenshots/landing-page.png)

### Dashboard Admin
![Admin Dashboard](screenshots/admin-dashboard.png)

### Halaman Prestasi
![Prestasi](screenshots/prestasi-page.png)

### Halaman Bimbingan & Konseling
![Bimbingan](screenshots/bimbingan-page.png)

### Mobile Responsive
<p align="center">
  <img src="screenshots/mobile-view.png" alt="Mobile View" width="300">
</p>
```

## Tips Screenshot yang Baik

1. ✅ **Resolusi Tinggi**: Minimal 1920x1080 untuk desktop view
2. ✅ **Clean Data**: Gunakan data dummy yang bersih dan realistis
3. ✅ **Full Page**: Untuk landing page, ambil full page screenshot
4. ✅ **Fokus pada Fitur**: Highlight fitur-fitur utama
5. ✅ **Konsisten**: Gunakan akun yang sama untuk semua screenshot
6. ✅ **Kompres**: Kompres gambar untuk mengurangi ukuran file (gunakan TinyPNG)

## File Structure yang Disarankan

```
besiswa/
├── screenshots/
│   ├── landing-page.png
│   ├── admin-dashboard.png
│   ├── prestasi-page.png
│   ├── bimbingan-page.png
│   ├── ekskul-page.png
│   ├── portofolio-page.png
│   ├── form-input.png
│   └── mobile-view.png
├── README.md
└── ...
```

---

**Catatan**: Setelah screenshot diambil, jangan lupa untuk:
1. Commit screenshot ke repository
2. Update README.md dengan path screenshot yang benar
3. Test apakah gambar muncul dengan benar di GitHub
4. Optimalkan ukuran gambar agar repository tidak terlalu besar

---

_Panduan ini akan membantu dalam mengambil screenshot yang tepat untuk dokumentasi README._
