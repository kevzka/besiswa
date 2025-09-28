<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>prestasi CRUD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset and base styles */
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

        /* Sidebar styles - Same as dashboard */
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

        /* Main content styles */
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

        /* Page header */
        .page-header {
            background: linear-gradient(135deg, #8B4513, #A0522D);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }

        .page-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        /* Form styles */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .form-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 25px;
            border-bottom: 2px solid #8B4513;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #8B4513;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-btn {
            display: inline-block;
            padding: 12px 20px;
            background: #8B4513;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .file-upload-btn:hover {
            background: #A0522D;
        }

        .file-preview {
            margin-top: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            display: none;
        }

        .file-preview.show {
            display: block;
        }

        .preview-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .thumbnail img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }

        .thumbnail .file-icon {
            font-size: 30px;
            color: #6c757d;
        }

        .file-details {
            flex: 1;
        }

        .file-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .file-info-details {
            font-size: 12px;
            color: #6c757d;
        }

        .remove-file {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .remove-file:hover {
            background: #c82333;
        }

        .video-thumbnail {
            position: relative;
            background: #000;
        }

        .video-thumbnail::after {
            content: '\f04b';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 20px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #8B4513;
            color: white;
        }

        .btn-primary:hover {
            background: #A0522D;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-header {
            background: #8B4513;
            color: white;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .file-info {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
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
                        <p><i class="fas fa-circle" style="font-size: 8px;"></i> Admin</p>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home" style="margin-right: 10px;"></i> Home
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.bimbingan.index')}}"><i class="fas fa-hands-helping"
                            style="margin-right: 10px;"></i> Bimbingan</a>
                </div>
                <div class="nav-item active">
                    <a href="{{ route('admin.prestasi.index') }}"><i class="fas fa-trophy" style="margin-right: 10px;"></i> Prestasi</a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.ekskul.index') }}"><i class="fas fa-calendar-alt" style="margin-right: 10px;"></i> Ekskul</a>
                </div>
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

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-hands-helping"></i> prestasi Management</h1>
                <p>Kelola data prestasi siswa</p>
            </div>

            <!-- Form -->
            <div class="form-container">
                <h2 class="form-title"><i class="fas fa-plus-circle"></i> Tambah Data prestasi</h2>

                <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">
                            <i class="fas fa-heading"></i> Judul prestasi
                        </label>
                        <input type="text" id="title" name="title" class="form-control"
                            placeholder="Masukkan judul prestasi..." required>
                    </div>

                    <div class="form-group">
                        <label for="description">
                            <i class="fas fa-align-left"></i> Deskripsi
                        </label>
                        <textarea id="description" name="description" class="form-control"
                            placeholder="Masukkan deskripsi prestasi..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">
                            <i class="fas fa-calendar-alt"></i> Tanggal
                        </label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="file">
                            <i class="fas fa-file-upload"></i> Upload File
                        </label>
                        <div class="file-upload">
                            <input type="file" id="file" name="file"
                                accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.mp4,.mov,.avi">
                            <label for="file" class="file-upload-btn">
                                <i class="fas fa-cloud-upload-alt"></i> Pilih File
                            </label>
                        </div>
                        <div class="file-info">Format yang didukung: PDF, DOC, DOCX, JPG, PNG, MP4, MOV, AVI (Max: 10MB)
                        </div>

                        <!-- File Preview -->
                        <div id="filePreview" class="file-preview">
                            <div class="preview-item">
                                <div id="thumbnail" class="thumbnail"></div>
                                <div class="file-details">
                                    <div id="fileName" class="file-name"></div>
                                    <div id="fileInfo" class="file-info-details"></div>
                                </div>
                                <button type="button" id="removeFile" class="remove-file">
                                    <i class="fas fa-times"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="table-container">
                <div class="table-header">
                    <i class="fas fa-list"></i> Data prestasi
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Penginput</th>
                            <th>Tanggal</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityList as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-user" style="color: #8B4513;"></i>
                                        <span>{{ $item->admin->username ?? 'Admin' }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <div class="preview-item" style="margin: 0; padding: 5px;">
                                        <div class="thumbnail" style="width: 40px; height: 40px;">
                                            <img src="{{ $item->file ? asset('storage/' . $item->file) : '' }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.prestasi.edit', ['kegiatan' => $item->id]) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', ['kegiatan' => $item->id]) }}" 
                                              method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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

        // File upload dengan thumbnail preview
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const filePreview = document.getElementById('filePreview');
            const thumbnail = document.getElementById('thumbnail');
            const fileName = document.getElementById('fileName');
            const fileInfo = document.getElementById('fileInfo');
            const label = document.querySelector('.file-upload-btn');

            if (file) {
                // Show preview container
                filePreview.classList.add('show');

                // Set file details
                fileName.textContent = file.name;
                fileInfo.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB - ${file.type}`;

                // Update upload button
                label.innerHTML = `<i class="fas fa-check"></i> File dipilih: ${file.name}`;

                // Clear previous thumbnail
                thumbnail.innerHTML = '';
                thumbnail.className = 'thumbnail';

                // Generate thumbnail based on file type
                if (file.type.startsWith('image/')) {
                    // Image thumbnail
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.onload = () => URL.revokeObjectURL(img.src);
                    thumbnail.appendChild(img);

                } else if (file.type.startsWith('video/')) {
                    // Video thumbnail
                    thumbnail.classList.add('video-thumbnail');
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.addEventListener('loadeddata', function() {
                        video.currentTime = 1; // Seek to 1 second for thumbnail
                    });
                    video.addEventListener('seeked', function() {
                        const canvas = document.createElement('canvas');
                        canvas.width = 80;
                        canvas.height = 80;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(video, 0, 0, 80, 80);
                        const img = document.createElement('img');
                        img.src = canvas.toDataURL();
                        thumbnail.innerHTML = '';
                        thumbnail.appendChild(img);
                        URL.revokeObjectURL(video.src);
                    });

                } else if (file.type === 'application/pdf') {
                    // PDF icon
                    thumbnail.innerHTML = '<i class="fas fa-file-pdf file-icon" style="color: #dc3545;"></i>';

                } else if (file.type.includes('word') || file.type.includes('document')) {
                    // Word document icon
                    thumbnail.innerHTML = '<i class="fas fa-file-word file-icon" style="color: #2b579a;"></i>';

                } else if (file.type.includes('excel') || file.type.includes('sheet')) {
                    // Excel icon
                    thumbnail.innerHTML = '<i class="fas fa-file-excel file-icon" style="color: #217346;"></i>';

                } else if (file.type.includes('powerpoint') || file.type.includes('presentation')) {
                    // PowerPoint icon
                    thumbnail.innerHTML =
                    '<i class="fas fa-file-powerpoint file-icon" style="color: #d24726;"></i>';

                } else {
                    // Generic file icon
                    thumbnail.innerHTML = '<i class="fas fa-file file-icon"></i>';
                }

            } else {
                // Hide preview if no file
                filePreview.classList.remove('show');
                label.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Pilih File';
            }
        });

        // Remove file function
        document.getElementById('removeFile').addEventListener('click', function() {
            document.getElementById('file').value = '';
            document.getElementById('filePreview').classList.remove('show');
            document.querySelector('.file-upload-btn').innerHTML =
                '<i class="fas fa-cloud-upload-alt"></i> Pilih File';
        });

        // Set today's date as default
        document.getElementById('date').valueAsDate = new Date();
    </script>
</body>

</html>
