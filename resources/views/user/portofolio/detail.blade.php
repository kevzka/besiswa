<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Angkatan 25 - ADASISWA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* --- HEADER DETAIL PAGE --- */
        .header {
            /* Pastikan header tetap flex atau sesuaikan untuk tata letak baru */
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .back-link {
            text-decoration: none;
            color: #cc3333;
            font-size: 2em;
            font-weight: bold;
            margin-right: 15px;
        }

        .batch-title-bar {
            background-color: #cc3333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .batch-title {
            font-size: 1.2em;
            margin: 0;
        }

        /* --- MAIN CONTENT DETAIL (Grid Layout) --- */
        .detail-main-content {
            padding-top: 6rem;
            padding-left: 2rem;
            box-sizing: border-box;
            /* max-width: 1200px; */
            width: 100%;
            height: 100vh;
            /* margin: 20px auto; */
            /* padding: 0 20px; */
            display: grid;
            /* 1 kolom untuk sidebar (sekitar 30%) dan 2 kolom untuk daftar siswa (sekitar 70%) */
            gap: 40px;
            display: grid;
            grid-template-columns: 30% auto;
            grid-template-rows: repeat(2, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
        }

        /* --- DETAIL SIDEBAR (Kiri) --- */
        .detail-sidebar {
            padding: 20px;
            grid-area: 1 / 1 / 2 / 2;
            box-sizing: border-box;
            /* border: 1px solid black; */
            /* Biasanya sidebar tidak membutuhkan background kecuali ada elemen chart */
        }

        /* Chart Area Styling */
        .chart-area {
            /* margin-bottom: 30px; */
            position: relative;
            /* padding: 20px; */
        }

        .donut-chart-placeholder {
            width: 250px;
            height: 250px;
            background-color: #f5f5f5;
            /* Placeholder latar belakang */
            border: 15px solid #cc3333;
            /* Border luar chart */
            border-radius: 50%;
            margin: 0 auto;
            position: relative;
        }


        /* Global Stats Styling */
        .global-stats {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-box {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.9em;
            color: #666;
        }

        /* Participation Rate Styling */
        .participation-rate {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .rate-number {
            font-size: 1.5em;
            font-weight: bold;
            color: #cc3333;
            margin-bottom: 5px;
        }

        .rate-detail {
            font-size: 0.8em;
            color: #666;
        }


        /* --- STUDENT LIST SECTION (Kanan) --- */
        .student-list-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 10px 0;

            /* Membatasi tinggi dan mengaktifkan scroll saat overflow */
            max-height: 30rem;
            /* sesuaikan sesuai kebutuhan */
            overflow-y: auto;
        }

        /* Ubah layout item agar "ngarah ke bawah" (baris per pasangan info/action)
           menggunakan CSS grid: setiap pasangan (.student-info + .student-action)
           akan membentuk satu baris, lalu berlanjut ke baris berikutnya. */
        .student-list-item {
            display: grid;
            grid-template-columns: 1fr auto;
            /* kiri = info, kanan = action */
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #eee;
        }

        .student-list-item:last-child {
            border-bottom: none;
        }

        /* Pastikan elemen info tetap rapi */
        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Action berada di kolom kanan */
        .student-action {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-self: end;
            /* posisikan ke kanan dalam grid */
        }

        /* Minor: tombol dan scrollbar */
        .prestasi-button {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            color: #333;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .student-list-container::-webkit-scrollbar {
            width: 10px;
        }

        .student-list-container::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.12);
            border-radius: 6px;
        }

        /* --- LEGEND FOOTER --- */
        .legend-footer {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 3 kolom untuk legenda */
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 0.9em;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 10px;
            display: inline-block;
        }

        /* Warna Dot (sesuaikan dengan warna chart/icon) */
        .dot.red {
            background-color: #cc3333;
        }

        .dot.brown {
            background-color: #a0522d;
        }

        .dot.green {
            background-color: #5cb85c;
        }

        .dot.orange {
            background-color: #f0ad4e;
        }

        .icon-legend {
            font-size: 1em;
            margin-right: 10px;
        }

        .legend-totals p {
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* --- MEDIA QUERIES DETAIL PAGE --- */
        @media (max-width: 900px) {
            .detail-main-content {
                grid-template-columns: 1fr;
                /* Kolom tunggal di tablet/mobile */
            }

            .legend-footer {
                grid-template-columns: 1fr 1fr;
                /* 2 kolom di tablet */
                gap: 20px;
            }

            .batch-title-bar {
                padding: 8px 15px;
            }
        }

        @media (max-width: 500px) {
            .legend-footer {
                grid-template-columns: 1fr;
                /* Kolom tunggal di mobile */
            }

            .student-list-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .student-action {
                align-self: stretch;
                /* Memanjang penuh */
                justify-content: space-between;
            }
        }

        /* CSS Tambahan untuk Chart */
        .chart-wrapper {
            width: 250px;
            /* Lebar chart */
            height: 250px;
            /* Tinggi chart */
            margin: 0 auto;
            position: relative;
            /* Penting untuk penempatan angka-angka di sekitar */
        }

        /* Penyesuaian angka di sekitar chart, jika diperlukan */
        .chart-value.top {
            top: -10px;
            left: 50%;
            transform: translate(-50%, 0);
            color: #cc3333;
        }

        .chart-value.left-top {
            top: 50px;
            left: -30px;
        }

        .chart-value.right-bottom {
            bottom: 50px;
            right: -30px;
            color: #cc3333;
        }

        .chart-value.bottom {
            bottom: -10px;
            left: 50%;
            transform: translate(-50%, 0);
        }

        /* Container Utama: Mengatur tata letak vertikal */
        .global-stats-container {
            display: flex;
            flex-direction: column;
            /* Menyusun item dari atas ke bawah */
            /* gap: 30px; */
            /* Jarak antara setiap blok statistik */
            padding: 20px;
            /* Sesuaikan jika Anda ingin latar belakang khusus */
            grid-area: 2 / 1 / 3 / 2;
            box-sizing: border-box;
            /* border: 1px solid black; */
        }

        /* Grup Statistik (TOTAL PRESTASI & TOTAL JIWA) */
        .stat-group {
            text-align: left;
        }

        .stat-number-box-wrapper {
            background-color: #fff;
            /* Border tipis jika diperlukan */
            border-radius: 50px;
            /* Membuat sudut sangat melengkung (pill shape) */
            width: 100%;
            height: 3rem;
            /* Lebar kotak angka */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
        }

        .stat-number-box-wrapper .stat-number-box {
            background-color: red;
            border: none;
            width: 30%;
            height: 100%;
        }

        /* Kotak Angka (0) */
        .stat-number-box {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ccc;
            /* Border tipis jika diperlukan */
            border-radius: 50px;
            /* Membuat sudut sangat melengkung (pill shape) */
            padding: 10px 20px;
            width: 150px;
            height: 3rem;
            /* Lebar kotak angka */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
        }

        .stat-number {
            font-family: 'Times New Roman', serif;
            /* Font yang terlihat elegan/serif di gambar */
            font-size: 2.5em;
            font-weight: 300;
            /* Tipis */
            color: #333;
            line-height: 1;
            margin: 0;
        }

        .stat-label {
            font-family: 'Times New Roman', serif;
            font-size: 1em;
            font-weight: 500;
            color: #333;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        /* Grup Partisipasi (0.9%) */
        .participation-rate-group {
            margin-top: 20px;
        }

        .participation-box {
            background-color: #cc3333;
            /* Warna merah gelap */
            color: #fff;
            border-radius: 50px;
            padding: 10px 20px;
            width: 200px;
            /* Lebar kotak angka partisipasi yang lebih panjang */
            display: flex;
            align-items: center;
            justify-content: flex-start;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .rate-number {
            font-size: 1.5em;
            font-weight: bold;
            margin: 0;
        }

        .rate-detail {
            font-size: 0.8em;
            color: #333;
            line-height: 1.4;
            max-width: 200px;
            /* Batasi lebar teks detail */
            margin-top: 10px;
        }

        .student-list-section {
            padding: 0 20px;
            grid-area: 1 / 2 / 3 / 3;
            /* background-color: red; */
            box-sizing: border-box;
            /* border: 1px solid black; */
        }

        .angkatan-title {
            position: absolute;
            top: 4rem;
            left: -1rem;
            background-color: #ff0000;
            /* Border tipis jika diperlukan */
            border-radius: 50px;
            /* Membuat sudut sangat melengkung (pill shape) */
            width: 17rem;
            height: 3rem;
            /* Lebar kotak angka */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .angkatan-title p {
            margin: 0;
            color: white;
            font-size: 1rem;
        }

        .logo-title {
            position: absolute;
            right: 2rem;
            width: 10rem;
            display: flex;
            align-items: center;
        }

        .logo-title .logo img {
            width: 100%;
        }

        .logo-title p{
            color:red;
        }
    </style>

</head>

<body>
    <div class="container">

        <div class="angkatan-title">
            <p>ANGKATAN 25</p>
        </div>

        <div class="logo-title">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <p>ADASISWA</p>
        </div>

        {{-- <header class="header">
        <div class="header-left">
            <a href="#" class="back-link">
                <span class="back-icon">&lt;</span>
            </a>
            <div class="batch-title-bar">
                <h1 class="batch-title">ANGKATAN 25</h1>
            </div>
        </div>
        <div class="logo-container">
            <img src="logo.png" alt="Logo ADASISWA" class="logo">
            <span class="brand-name">ADASISWA</span>
        </div>
    </header> --}}

        <main class="detail-main-content">
            <aside class="detail-sidebar">

                <div class="chart-area">
                    <div class="chart-wrapper">
                        <canvas id="prestasiDonutChart"></canvas>
                    </div>
                </div>

            </aside>

            <div class="global-stats-container">
                <div class="stat-group">
                    <div class="stat-number-box">
                        <p class="stat-number">0</p>
                    </div>
                    <p class="stat-label">TOTAL PRESTASI</p>
                </div>

                <div class="stat-group">
                    <div class="stat-number-box">
                        <p class="stat-number">0</p>
                    </div>
                    <p class="stat-label">TOTAL JIWA</p>
                </div>

                <div class="stat-group">
                    <div class="stat-number-box-wrapper">
                        <div class="stat-number-box">
                            <p class="stat-number">0.9%</p>
                        </div>
                    </div>
                    <p class="stat-label">Tingkat partisipasi prestasi siswa/i SMK Telkom Banjarbaru</p>
                </div>
            </div>

            <section class="student-list-section">
                <div class="student-list-container">

                    <div class="student-list-item">
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 10+</span>
                        </div>
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 10+</span>
                        </div>
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 10+</span>
                        </div>
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 10+</span>
                        </div>
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 10+</span>
                        </div>
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 10+</span>
                        </div>
                    </div>

                    <div class="student-list-item">
                        <div class="student-info">
                            <span class="profile-icon">👤</span>
                            <div>
                                <p class="student-name">Nama Siswa</p>
                                <p class="student-achievements">0 Prestasi</p>
                            </div>
                        </div>
                        <div class="student-action">
                            <button class="prestasi-button">
                                <span>0 Prestasi</span>
                            </button>
                            <span class="achievement-count">🌟 2</span>
                        </div>
                    </div>
                </div>

                <div class="legend-footer">
                    <div class="legend-column">
                        <p class="legend-item"><span class="dot red"></span> Tingkat Internasional</p>
                        <p class="legend-item"><span class="dot brown"></span> Tingkat Nasional</p>
                        <p class="legend-item"><span class="dot green"></span> Tingkat Provinsi</p>
                        <p class="legend-item"><span class="dot orange"></span> Tingkat Kota/Kabupaten</p>
                    </div>
                    <div class="legend-column">
                        <p class="legend-item"><span class="icon-legend">👑</span> Tingkat Internasional</p>
                        <p class="legend-item"><span class="icon-legend">🏆</span> Tingkat Nasional</p>
                        <p class="legend-item"><span class="icon-legend">🥉</span> Tingkat Provinsi</p>
                        <p class="legend-item"><span class="icon-legend">⭐</span> Tingkat Kota/Kabupaten</p>
                    </div>
                    <div class="legend-totals">
                        <p>Total Prestasi Internasional: 10</p>
                        <p>Total Nasional: 10</p>
                        <p>Total Provinsi: 10</p>
                        <p>Total Kota/Kabupaten: 10</p>
                    </div>
                </div>

            </section>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data yang sesuai dengan angka-angka di sekitar chart
        const chartData = {
            // Angka-angka 147, 392, 20, 667
            data: [147, 392, 20, 667],
            // Label yang sesuai dengan tingkatan prestasi (misalnya, A, B, C, D)
            labels: [
                'Tingkat Internasional', // 147
                'Tingkat Nasional', // 392
                'Tingkat Provinsi', // 20
                'Tingkat Kota/Kabupaten' // 667
            ],
            // Warna yang sesuai dengan desain (merah gelap dan varian)
            backgroundColor: [
                'rgba(204, 51, 51, 1)', // Merah ADASISWA
                'rgba(204, 51, 51, 0.7)',
                'rgba(204, 51, 51, 0.5)',
                'rgba(204, 51, 51, 0.3)'
            ],
            hoverBackgroundColor: [
                '#A52A2A', // Warna hover
                '#A52A2A',
                '#A52A2A',
                '#A52A2A'
            ]
        };

        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('prestasiDonutChart').getContext('2d');

            const prestasiDonutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        backgroundColor: chartData.backgroundColor,
                        hoverBackgroundColor: chartData.hoverBackgroundColor,
                        borderWidth: 0 // Menghilangkan border antar segmen
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting untuk mengontrol ukuran canvas dengan CSS
                    cutout: '75%', // Mengatur ketebalan Donut Chart
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda default Chart.js
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
