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
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #8B4513, #A0522D);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .profile-info h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-info p {
            font-size: 14px;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #fff;
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: #fff;
        }

        .nav-item a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar {
            flex: 1;
            max-width: 400px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 14px;
            outline: none;
        }

        .search-bar i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .greeting {
            background: linear-gradient(135deg, #8B4513, #A0522D);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }

        .greeting h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        .card .number {
            font-size: 48px;
            font-weight: bold;
            color: #8B4513;
            margin-bottom: 10px;
        }

        .card .add-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 35px;
            height: 35px;
            background: #333;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="profile">
                    <div class="profile-img">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-info">
                        <h3>M. AUFA RAHMAN</h3>
                        <p><i class="fas fa-circle" style="font-size: 8px;"></i> {{ ucfirst($role) }}</p>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item active">
                    <a href="#"><i class="fas fa-home" style="margin-right: 10px;"></i> Home</a>
                </div>
                @if ($id_role == 1 || $id_role == 4)
                    <div class="nav-item">
                        <a href="{{ route('admin.bimbingan.index'/* , ['id_role' => 4] */) }}"><i class="fas fa-hands-helping" style="margin-right: 10px;"></i> Bimbingan</a>
                    </div>
                @endif
                @if ($id_role == 2 || $id_role == 4)
                    <div class="nav-item">
                        <a href="#"><i class="fas fa-trophy" style="margin-right: 10px;"></i> Prestasi</a>
                    </div>
                @endif
                @if ($id_role == 3 || $id_role == 4)
                    <div class="nav-item">
                        <a href="#"><i class="fas fa-calendar-alt" style="margin-right: 10px;"></i> Ekskul</a>
                    </div>
                @endif
                <div class="nav-item">
                    <a href="#"><i class="fas fa-user-circle" style="margin-right: 10px;"></i> Profil</a>
                </div>
                <div class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <a href="#" onclick="this.parentElement.submit(); return false;">
                            <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i> Logout
                        </a>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search"></i>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <div class="greeting">
                <h1>Ada berita apa hari ini?</h1>
            </div>

            <div class="cards-container">
                <div class="card">
                    <button class="add-btn">+</button>
                    <h3>Berita<br>Bimbingan</h3>
                    <div class="number">0</div>
                </div>

                <div class="card">
                    <button class="add-btn">+</button>
                    <h3>Berita<br>Prestasi</h3>
                    <div class="number">0</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add click functionality to nav items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
