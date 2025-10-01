<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            margin-left: 313px;
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
        <x-admin.sidebar :role="$role" :id-role="$id_role" active-menu='home'/>

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
</body>

</html>
