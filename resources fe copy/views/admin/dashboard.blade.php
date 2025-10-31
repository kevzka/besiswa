<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: #8B4A42;
            color: white;
            height: 100vh;
            position: fixed;
        }

        .profile-section {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-text h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .profile-text p {
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-menu {
            padding: 20px 0;
        }

        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .nav-item:hover,
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        .search-container {
            flex: 1;
            max-width: 400px;
        }

        .search-container input {
            width: 100%;
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
        }

        .welcome-section {
            background: #8B4A42;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .welcome-section h1 {
            font-size: 32px;
            font-weight: normal;
        }

        .stats-section {
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            position: relative;
        }

        .stat-card .icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #333;
        }

        .stat-card h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .stat-card .number {
            font-size: 48px;
            font-weight: bold;
            color: #333;
        }

        .table-section {
            padding: 0 20px 40px;
        }

        .data-table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            display: grid;
            grid-template-columns: 50px 1fr 1fr;
            font-weight: 600;
            color: #333;
        }

        .table-row {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: grid;
            grid-template-columns: 50px 1fr 1fr;
            align-items: center;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {
            .stats-section {
                flex-direction: column;
                align-items: center;
            }

            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="profile-section">
            <div class="profile-info">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-text">
                    <h4>M. AUFA RAHMAN</h4>
                    <p><i class="fas fa-circle" style="font-size: 6px;"></i> {{ ucfirst($role) }}</p>
                </div>
            </div>
        </div>

        <nav class="nav-menu">
            <div class="nav-item active">
                <a href="#"><i class="fas fa-home"></i> Home</a>
            </div>
            @if ($id_role == 1 || $id_role == 4)
            <div class="nav-item">
                <a href="{{ route('admin.bimbingan.index')}}"><i class="fas fa-hands-helping"></i> Bimbingan</a>
            </div>
            @endif
            @if ($id_role == 2 || $id_role == 4)
            <div class="nav-item">
                <a href="{{ route('admin.prestasi.index') }}"><i class="fas fa-trophy"></i> Prestasi</a>
            </div>
            @endif
            @if ($id_role == 3 || $id_role == 4)
            <div class="nav-item">
                <a href="{{ route('admin.ekskul.index') }}"><i class="fas fa-calendar-alt"></i> Ekskul</a>
            </div>
            @endif
            <div class="nav-item">
                <a href="{{ route('admin.profile') }}"><i class="fas fa-user-circle"></i> Profil</a>
            </div>
            <div class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <a href="#" onclick="this.parentElement.submit(); return false;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </nav>
    </div>

    <div class="main-content">
        <div class="header">
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="search-container">
                <input type="text" placeholder="Search">
            </div>
        </div>

        <div class="welcome-section">
            <h1>Ada berita apa hari ini?</h1>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <i class="fas fa-list icon"></i>
                <h3>Berita<br>Bimbingan</h3>
                <div class="number">0</div>
            </div>

            <div class="stat-card">
                <i class="fas fa-trophy icon"></i>
                <h3>Berita<br>Prestasi</h3>
                <div class="number">0</div>
            </div>

            <div class="stat-card">
                <i class="fas fa-calendar-alt icon"></i>
                <h3>Berita<br>Ekskul</h3>
                <div class="number">0</div>
            </div>
        </div>

        <div class="table-section">
            <div class="data-table">
                <div class="table-header">
                    <div></div>
                    <div>SPMB 26/27</div>
                    <div>10/9/25</div>
                </div>
                <div class="table-row">
                    <div>1</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>2</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>3</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>4</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>5</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>6</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>7</div>
                    <div></div>
                    <div></div>
                </div>
                <div class="table-row">
                    <div>8</div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add click functionality to nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
