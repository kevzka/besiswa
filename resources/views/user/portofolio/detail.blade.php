<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Angkatan 25 - ADASISWA</title>
    <style>
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            display: grid;
            /* 1 kolom untuk sidebar (sekitar 30%) dan 2 kolom untuk daftar siswa (sekitar 70%) */
            grid-template-columns: 1fr 2fr;
            gap: 40px;
        }

        /* --- DETAIL SIDEBAR (Kiri) --- */
        .detail-sidebar {
            padding: 20px;
            /* Biasanya sidebar tidak membutuhkan background kecuali ada elemen chart */
        }

        /* Chart Area Styling */
        .chart-area {
            margin-bottom: 30px;
            position: relative;
            padding: 20px;
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

        /* Posisi angka-angka di sekitar chart */
        .chart-value {
            position: absolute;
            font-weight: bold;
            font-size: 0.9em;
            color: #333;
        }

        .chart-value.top {
            top: 0;
            left: 50%;
            transform: translate(-50%, -150%);
            color: #cc3333;
        }

        .chart-value.left-top {
            top: 20%;
            left: -20px;
        }

        .chart-value.right-bottom {
            bottom: 20%;
            right: -20px;
            color: #cc3333;
        }

        .chart-value.bottom {
            bottom: 0;
            left: 50%;
            transform: translate(-50%, 100%);
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
        }

        .student-list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        .student-list-item:last-child {
            border-bottom: none;
        }

        .student-info {
            display: flex;
            align-items: center;
        }

        .profile-icon {
            font-size: 1.5em;
            margin-right: 15px;
            color: #333;
        }

        .student-name {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .student-achievements {
            font-size: 0.9em;
            color: #999;
        }

        .student-action {
            display: flex;
            align-items: center;
            gap: 10px;
        }

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

        .prestasi-button:hover {
            background-color: #eee;
        }

        .achievement-count {
            font-size: 0.9em;
            font-weight: bold;
            color: #cc3333;
            /* Warna merah untuk icon/angka prestasi */
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
    </style>

</head>

<body>

    <header class="header">
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
    </header>

    <main class="detail-main-content">
        <aside class="detail-sidebar">

            <div class="chart-area">
                <div class="chart-wrapper">
                    <canvas id="prestasiDonutChart"></canvas>
                </div>

                <span class="chart-value top">392</span>
                <span class="chart-value left-top">147</span>
                <span class="chart-value right-bottom">20</span>
                <span class="chart-value bottom">667</span>
            </div>

        </aside>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data yang sesuai dengan angka-angka di sekitar chart
        const chartData = {
            // Angka-angka 147, 392, 20, 667
            data: [147, 392, 20, 667],
            // Label yang sesuai dengan tingkatan prestasi (misalnya, A, B, C, D)
            labels: [
                'Tingkat A', // 147
                'Tingkat B', // 392
                'Tingkat C', // 20
                'Tingkat D' // 667
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
