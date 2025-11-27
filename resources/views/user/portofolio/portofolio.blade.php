<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio - ADASISWA</title>
    <style>
        /* RESET DASAR */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('{{ asset('img/bgporto.png') }}');
            background-size: cover;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            padding-top: 100px;
        }

        /* --- BAGIAN PRESTASI BERDASARKAN TINGKAT --- */
        .achievement-level-section {
            margin-top: 30px;
        }

        .level-cards-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            background-color: #F7F7F7;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .level-card {
            height: 14rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
            padding-bottom: 20px;
            transition: box-shadow 0.18s ease, transform 0.12s ease;
        }

        .batch-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            transition: box-shadow 0.18s ease, transform 0.12s ease;
            font-family: 'Poppins', sans-serif;
        }

        /* Hover: pertegas / menghitamkan box-shadow dan sedikitangkat */
        /* .level-card:hover, */
        .batch-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.38);
            transform: translateY(-6px);
        }

        .card-header {
            background-color: #AE2727;
            color: #fff;
            padding: 15px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .level-title {
            font-size: 0.9em;
            font-weight: bold;
            margin-left: 10px;
            font-family: 'Aboreto', cursive;
        }

        .icon {
            font-size: 1.5em;
        }

        /* Level / header icons (SVG) */
        .level-icon {
            width: 36px;
            height: 36px;
            object-fit: contain;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .score {
            font-size: 3em;
            font-weight: bold;
            color: #333;
            margin: 30px 0 5px 0;
            font-family: 'Poppins', sans-serif;
        }

        .detail {
            font-size: 0.9em;
            font-family: 'Poppins', sans-serif;
            color: #666;
        }

        /* --- BAGIAN PERFORMA ANGKATAN --- */
        .batch-performance-section {
            margin-top: 40px;
            background-color: #F7F7F7;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .section-title-bar {
            background-color: #AE2727;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.2em;
            letter-spacing: 1px;
            font-family: 'Aboreto', cursive;
        }

        .batch-cards-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .batch-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            transition: box-shadow 0.18s ease, transform 0.12s ease;
            font-family: 'Poppins', sans-serif;
        }

        .batch-number {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .arrow-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2em;
            color: #cc3333;
        }

        .batch-stats {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 15px 0;
        }

        .stat-item {
            display: flex;
            align-items: center;
            font-size: 0.9em;
            color: #666;
        }

        .stat-icon {
            width: 28px;
            height: 28px;
            object-fit: contain;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .batch-detail {
            font-size: 0.9em;
            font-weight: bold;
            color: #cc3333;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        /* --- MEDIA QUERIES untuk Responsif --- */
        @media (max-width: 900px) {
            .level-cards-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .batch-cards-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 500px) {
            .level-cards-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiko:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/userView.css') }}">
</head>

<body>
    <nav>
        <div class="navbar-container">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Adasiswa Logo">
                <p>ADASISWA</p>
            </div>

            <x-nav-user-view :activeMenu="'portofolio'" :deg="4" />
        </div>
    </nav>


    <main class="main-content">
        <section class="achievement-level-section">
            <div class="level-cards-container">

                <div class="level-card international">
                    <div class="card-header">
                        <img src="{{ asset('icons/tinternational.svg') }}" alt="Internasional" class="level-icon">
                        <h3 class="level-title">TINGKAT INTERNASIONAL</h3>
                    </div>
                    <div class="card-body">
                        <p class="score">{{ $response['data']['totalInternasional'][0] }}</p>
                        <p class="detail">{{ number_format($response['data']['totalInternasional'][1], 1) }}% Dari total
                        </p>
                    </div>
                </div>

                <div class="level-card national">
                    <div class="card-header">
                        <img src="{{ asset('icons/tnational.svg') }}" alt="Nasional" class="level-icon">
                        <h3 class="level-title">TINGKAT NASIONAL</h3>
                    </div>
                    <div class="card-body">
                        <p class="score">{{ $response['data']['totalNasional'][0] }}</p>
                        <p class="detail">{{ number_format($response['data']['totalNasional'][1], 1) }}% Dari total</p>
                    </div>
                </div>

                <div class="level-card province">
                    <div class="card-header">
                        <img src="{{ asset('icons/tprovinsi.svg') }}" alt="Provinsi" class="level-icon">
                        <h3 class="level-title">TINGKAT PROVINSI</h3>
                    </div>
                    <div class="card-body">
                        <p class="score">{{ $response['data']['totalProvinsi'][0] }}</p>
                        <p class="detail">{{ number_format($response['data']['totalProvinsi'][1], 1) }}% Dari total</p>
                    </div>
                </div>

                <div class="level-card city-regency">
                    <div class="card-header">
                        <img src="{{ asset('icons/tkotakabupaten.svg') }}" alt="Kota/Kabupaten" class="level-icon">
                        <h3 class="level-title">TINGKAT KOTA/KABUPATEN</h3>
                    </div>
                    <div class="card-body">
                        <p class="score">{{ $response['data']['totalKotaKabupaten'][0] }}</p>
                        <p class="detail">{{ number_format($response['data']['totalKotaKabupaten'][1], 1) }}% Dari
                            total</p>
                    </div>
                </div>

            </div>
        </section>

        <section class="batch-performance-section">
            <div class="section-title-bar">
                <h2 class="section-title">PERFORMA ANGKATAN</h2>
            </div>

            <div class="batch-cards-container">
                @if ($response['data']['angkatan'] == null)
                    <p>Tidak ada data angkatan tersedia.</p>
                @else
                    @foreach ($response['data']['angkatan'] as $item)
                        <div class="batch-card"
                            onclick="location.href='{{ url('/portofolio/angkatan/' . $item['angkatan']) }}'">
                            <h3 class="batch-number">Angkatan
                                {{ $item['angkatan']-1999 }}
                            </h3>
                            <span class="arrow-icon">></span>
                            <div class="batch-stats">
                                <div class="stat-item">
                                    <img src="{{ asset('icons/tprestasi.svg') }}" alt="Prestasi" class="stat-icon">
                                    <p class="stat-label">{{ $item['totalPrestasi'] }} Total prestasi</p>
                                </div>
                                <div class="stat-item">
                                    <img src="{{ asset('icons/tjiwa.svg') }}" alt="JIWA" class="stat-icon">
                                    <p class="stat-label">{{ $item['totalJiwa'][0] }} Total JIWA</p>
                                </div>
                            </div>
                            <p class="batch-detail">{{ $item['totalJiwa'][1] }}% Dari total JIWA</p>
                        </div>
                    @endforeach
                @endif

                <div class="batch-card">
                    <h3 class="batch-number">Angkatan 27</h3>
                    <span class="arrow-icon">></span>
                    <div class="batch-stats">
                        <div class="stat-item">
                            <img src="{{ asset('icons/tprestasi.svg') }}" alt="Prestasi" class="stat-icon">
                            <p class="stat-label">{{ $response['data']['angkatan'][2021]['totalPrestasi'] }} Total
                                prestasi</p>
                        </div>
                        <div class="stat-item">
                            <img src="{{ asset('icons/tjiwa.svg') }}" alt="JIWA" class="stat-icon">
                            <p class="stat-label">{{ $response['data']['angkatan'][2021]['totalJiwa'][0] }} Total JIWA
                            </p>
                        </div>
                    </div>
                    <p class="batch-detail">{{ $response['data']['angkatan'][2021]['totalJiwa'][1] }}% Dari total JIWA
                    </p>
                </div>

            </div>
        </section>

    </main>

</body>

</html>
