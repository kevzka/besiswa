<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Admin Dashboard</title>
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

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
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
            padding: 20px;
        }

        .header {
            background: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
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

        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-card .avatar {
            width: 80px;
            height: 80px;
            background: #666;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
        }

        .profile-card .info h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .profile-card .info p {
            color: #777;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }

        .info-section h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .info-item {
            margin-bottom: 20px;
        }

        .info-item label {
            display: block;
            color: #888;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .info-item .value {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            color: #333;
            font-size: 15px;
            font-weight: 500;
        }

        .edit-btn {
            background: #8B4A42;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .edit-btn:hover {
            background: #7a3d36;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            
            .main-content {
                margin-left: 200px;
                padding: 15px;
            }

            .profile-card {
                flex-direction: column;
                text-align: center;
            }

            .profile-card .avatar {
                width: 60px;
                height: 60px;
                font-size: 28px;
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
                    <p><i class="fas fa-circle" style="font-size: 6px;"></i> {{ $role ?? 'Admin utama' }}</p>
                </div>
            </div>
        </div>

        <nav class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.bimbingan.index') ?? '#' }}"><i class="fas fa-hands-helping"></i> Bimbingan</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.prestasi.index') ?? '#' }}"><i class="fas fa-trophy"></i> Prestasi</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.ekskul.index') ?? '#' }}"><i class="fas fa-calendar-alt"></i> Ekskul</a>
            </div>
            <div class="nav-item active">
                <a href="{{ route('admin.profile') ?? '#' }}"><i class="fas fa-user-circle"></i> Profil</a>
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

        <div class="profile-card">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="info">
                <h2>M. AUFA RAHMAN</h2>
                <p><i class="fas fa-map-marker-alt"></i> Admin utama</p>
            </div>
        </div>

        <div class="info-section">
            <h3>Informasi Pribadi</h3>
            <div class="info-item">
                <label>Alamat E-Mail</label>
                <div class="value">aufa123@gmail.com</div>
            </div>
            <div class="info-item">
                <label>No. Telp</label>
                <div class="value">00000000000</div>
            </div>
            <button class="edit-btn">
                <i class="fas fa-edit"></i> Edit Profil
            </button>
        </div>

        <div class="info-section">
            <h3>Sosial Media</h3>
            <div class="info-item">
                <label>Instagram</label>
                <div class="value">https://www.instagram.com/mhmmd_kmalll</div>
            </div>
            <div class="info-item">
                <label>Facebook</label>
                <div class="value">https://www.facebook.com/mhmmd_kmalll</div>
            </div>
            <button class="edit-btn">
                <i class="fas fa-edit"></i> Edit Sosial Media
            </button>
        </div>
    </div>

    <script>
        // Add click functionality to nav items
        document.querySelectorAll('.nav-item').forEach(item => {    
            item.addEventListener('click', function() {
                // Don't remove active class from current page
                if (!this.classList.contains('active')) {
                    document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Edit button functionality
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Edit functionality will be implemented here');
            });
        });
    </script>
</body>

</html>