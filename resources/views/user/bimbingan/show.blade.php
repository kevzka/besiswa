<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Sekolah</title>
    <script src="https://kit.fontawesome.com/f6479b8b4c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/showUserVIew.css')}}">
</head>

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
