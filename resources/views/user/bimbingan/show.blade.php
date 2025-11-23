<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Sekolah - Contoh Layout</title>
    <script src="https://kit.fontawesome.com/f6479b8b4c.js" crossorigin="anonymous"></script>
</head>
<style>
    /* Reset Dasar */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
        /* Warna latar belakang halaman */
        color: #333;
    }

    /* Header (Bagian Atas) */
    .header {
        display: flex;
        justify-content: space-between;
        /* Logo dan nama brand di kanan */
        align-items: center;
        padding: 20px 50px;
        background-color: #fff;
        border-bottom: 1px solid #eee;
    }

    .logo-container {
        /* Container untuk logo jika diperlukan */
    }

    .logo {
        width: 40px;
        /* Ukuran logo */
        height: auto;
        margin-right: 10px;
    }

    .brand-name {
        color: #cc3333;
        /* Warna merah sesuai contoh */
        font-size: 1.5em;
        font-weight: bold;
    }

    /* Container Utama untuk Konten */
    .container {
        max-width: 900px;
        /* Lebar maksimal konten */
        margin: 40px auto;
        padding: 0 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        /* Sedikit bayangan */
        padding: 50px;
    }

    /* Konten Artikel */
    .content h1 {
        font-size: 2.2em;
        font-weight: bold;
        color: #333;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .date {
        color: #666;
        font-size: 0.9em;
        margin-bottom: 30px;
    }

    /* Badan Artikel - Menggunakan Grid untuk tata letak gambar */
    .article-body {
        display: grid;
        grid-template-columns: 1fr;
        /* Kolom Teks (2/3) dan Gambar (1/3) */
        /* Jarak antar kolom */
        align-items: start;
        /* Konten dimulai dari atas */
    }

    .article-body p {
        line-height: 1.6;
        margin-bottom: 20px;
        grid-column: 1 / 2;
        /* Teks default di kolom pertama */
    }

    .image-box {
        max-width: 25rem;
        grid-column: 2 / 3;
        /* Gambar di kolom kedua */
        grid-row: 1 / 3;
        /* Gambar meluas hingga baris ketiga (mencakup 2 paragraf awal) */
        background-color: #eee;
        /* Latar belakang placeholder */
        overflow: hidden;
        float: right;
        margin: 20px;
    }

    .article-image {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Blok Kutipan */
    .quote-box {
        grid-column: 1 / -1;
        /* Meluas ke semua kolom (di bawah gambar) */
        background-color: #f9f9f9;
        border-left: 5px solid #cc3333;
        /* Garis merah di kiri */
        padding: 20px;
        margin: 0;
        font-style: italic;
        color: #555;
    }

    .quote-box p:last-child {
        margin-bottom: 0;
    }

    /* Footer */
    .footer {
        background-color: #303030;
        text-align: center;
        padding: 20px;
        margin-top: 50px;
        font-size: 0.8em;
        font-weight: bold;
        color: #aaa;
        border-top: 1px solid #eee;
    }

    /* Media Query untuk Layar Kecil (Responsif) */
    @media (max-width: 768px) {
        .header {
            padding: 15px 20px;
        }

        .container {
            padding: 30px 15px;
            margin: 20px auto;
        }

        .article-body {
            grid-template-columns: 1fr;
            /* Satu kolom di layar kecil */
        }

        .image-box {
            grid-column: 1 / 2;
            /* Gambar kembali ke kolom 1 */
            grid-row: auto;
            /* Posisi gambar normal */
            margin-bottom: 20px;
        }

        .article-body p {
            grid-column: 1 / 2;
            /* Teks kembali ke kolom 1 */
        }

        .quote-box {
            grid-column: 1 / 2;
            /* Kutipan tetap di kolom 1 */
        }
    }
</style>

<body>

    <header class="header">
        <i class="fa-solid fa-angle-left" style="font-size: 1.5rem; cursor: pointer;" onclick="history.back()"></i>
        <div class="logo-container-wrapper" style="display: flex; align-items: center;">
            <div class="logo-container" style="display: inline-block">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Sekolah" class="logo">
            </div>
            <div class="brand-name" style="display: inline">
                ADASISWA
            </div>
        </div>
    </header>

    <div class="container">
        <main class="content">
            <h1>{{ $response['data']['title'] }}</h1>
            <p class="date">{{ date("D, d-m-Y", strtotime($response['data']['date'])) }}</p>

            <div class="article-body">
                <div>

                    <div class="image-box">
                        <img src="{{ asset('storage/' . $response['data']['file']) }}" alt="Upacara Pembukaan PMB" class="article-image">
                    </div>
                    @php
                        //cek jika response data ada sebuah kutipan
                        //lalu pisahkan kutipan tersebut dari deskripsi utama
                        $description = $response['data']['description'];
                        $quote = '';
                        if (strpos($description, '"') !== false) {
                            $parts = explode('"', $description);
                            $newDescription = '';
                            for ($i = 0; $i < count($parts); $i++) {
                                if ($i % 2 == 0) {
                                    // Bagian deskripsi
                                    $newDescription .= $parts[$i];
                                } else {
                                    // Bagian kutipan
                                    $quote .= '"' . $parts[$i] . "\"\n\n";
                                }
                            }
                            //trim spasi awal dan akhir
                            $description = trim($newDescription);
                        }
                        //jika sudah pisahkan tampilkan deskripsi utama
                        //dan tampilkan kutipan di blok kutipan
                        echo '<p>' . nl2br(e($description)) . '</p>';
                        if (!empty($quote)) {
                            echo '<blockquote class="quote-box">' . nl2br(e($quote)) . '</blockquote>';
                        }
                    @endphp

            </div>
        </main>
    </div>

    <footer class="footer">
        © 2025 - ADASISWA
    </footer>

</body>

</html>
