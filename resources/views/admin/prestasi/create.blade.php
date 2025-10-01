<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>prestasi CRUD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #893939;
            --primary-dark: #6d2323;
            --white: #fff;
            --gray: #f5f5f5;
            --gray-light: #ededed;
            --gray-border: #e0e0e0;
            --text: #222;
            --text-light: #666;
            --btn: #893939;
            --btn-hover: #6d2323;
            --btn-secondary: #ededed;
            --btn-secondary-text: #893939;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            --radius: 8px;
        }

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

        .main-content {
            background: var(--gray);
            margin-left: 313px;
            min-height: 100vh;
            padding: 40px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-content .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
            max-width: 900px;
            margin-bottom: 24px;
            gap: 16px;
        }

        .main-content .search-bar {
            flex: 1;
            display: flex;
            align-items: center;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 0 12px;
            max-width: 260px;
            height: 36px;
        }

        .main-content .search-bar input {
            border: none;
            outline: none;
            background: transparent;
            flex: 1;
            font-size: 15px;
            color: var(--text);
            padding: 6px 0;
        }

        .main-content .search-bar i {
            color: var(--primary);
            font-size: 16px;
        }

        .main-content .logout-btn {
            background: none;
            border: none;
            color: var(--primary);
            font-size: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: var(--radius);
            transition: background 0.2s;
        }

        .main-content .logout-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .main-content .page-header {
            width: 100%;
            max-width: 900px;
            margin-bottom: 24px;
        }

        .main-content .page-header h1 {
            font-size: 22px;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .main-content .page-header p {
            color: var(--text-light);
            font-size: 15px;
        }

        .main-content .form-container {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 32px 32px 24px 32px;
            width: 100%;
            max-width: 700px;
            margin-bottom: 32px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .main-content .form-title {
            font-size: 18px;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .main-content .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }

        .main-content .form-group label {
            font-size: 15px;
            color: var(--text-light);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .main-content .form-control {
            border: none;
            border-bottom: 2px solid var(--gray-border);
            background: transparent;
            font-size: 16px;
            color: var(--text);
            padding: 8px 0;
            outline: none;
            transition: border 0.2s;
            border-radius: 0;
        }

        .main-content .form-control:focus {
            border-bottom: 2px solid var(--primary);
            background: transparent;
        }

        .main-content textarea.form-control {
            resize: none;
            min-height: 38px;
            max-height: 120px;
        }

        .main-content input[type="date"].form-control {
            color: var(--text-light);
            font-size: 15px;
            padding-right: 8px;
        }

        .main-content .file-upload {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 4px;
        }

        .main-content .file-upload input[type="file"] {
            display: none;
        }

        .main-content .file-upload-btn {
            background: var(--btn-secondary);
            color: var(--btn-secondary-text);
            border: none;
            border-radius: 20px;
            padding: 8px 22px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .main-content .file-upload-btn:hover {
            background: var(--gray-light);
        }

        .main-content .file-info {
            font-size: 13px;
            color: var(--text-light);
            margin-top: 2px;
            margin-left: 2px;
        }

        .main-content .file-preview {
            display: none;
            margin-top: 10px;
        }

        .main-content .file-preview.show {
            display: flex;
        }

        .main-content .preview-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--gray-light);
            border-radius: 8px;
            padding: 6px 12px;
            margin: 0;
        }

        .main-content .thumbnail {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid var(--gray-border);
        }

        .main-content .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .main-content .file-icon {
            font-size: 32px;
        }

        .main-content .file-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .main-content .file-name {
            font-size: 14px;
            color: var(--text);
            font-weight: 500;
        }

        .main-content .file-info-details {
            font-size: 12px;
            color: var(--text-light);
        }

        .main-content .remove-file {
            background: none;
            border: none;
            color: #b71c1c;
            font-size: 15px;
            cursor: pointer;
            margin-left: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .main-content .remove-file:hover {
            background: #f8d7da;
        }

        .main-content .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 14px;
            margin-top: 12px;
        }

        .main-content .btn {
            border: none;
            border-radius: 20px;
            padding: 8px 28px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s, color 0.2s;
            box-shadow: none;
            outline: none;
            text-decoration: none;
        }

        .main-content .btn-primary {
            background: var(--btn);
            color: var(--white);
        }

        .main-content .btn-primary:hover {
            background: var(--btn-hover);
        }

        .main-content .btn-secondary {
            background: var(--btn-secondary);
            color: var(--btn-secondary-text);
            border: 1px solid var(--gray-border);
        }

        .main-content .btn-secondary:hover {
            background: var(--gray-light);
        }

        /* Table Styles */
        .main-content .table-container {
            width: 100%;
            max-width: 700px;
            margin-top: 0;
            background: transparent;
            box-shadow: none;
        }

        .main-content .table-header {
            font-size: 16px;
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .main-content .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .main-content .table th,
        .main-content .table td {
            padding: 12px 10px;
            text-align: left;
            font-size: 15px;
            color: var(--text);
            border-bottom: 1px solid var(--gray-border);
        }

        .main-content .table th {
            background: var(--gray-light);
            font-weight: 600;
            color: var(--primary);
        }

        .main-content .table tr:nth-child(even) td {
            background: var(--gray-light);
        }

        .main-content .table tr:last-child td {
            border-bottom: none;
        }

        .main-content .action-buttons {
            display: flex;
            gap: 8px;
        }

        .main-content .btn-sm {
            padding: 4px 12px;
            font-size: 14px;
            border-radius: 14px;
        }

        .main-content .btn-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .main-content .btn-warning:hover {
            background: #ffeeba;
        }

        .main-content .btn-danger {
            background: #f8d7da;
            color: #b71c1c;
            border: 1px solid #f5c6cb;
        }

        .main-content .btn-danger:hover {
            background: #f5c6cb;
        }

        .main-content .btn-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .main-content .btn-success:hover {
            background: #c3e6cb;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <x-admin.sidebar :role="$role" :id-role="$id_role" active-menu='prestasi' />

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
                        @foreach ($activities as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['description'] }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-user" style="color: #8B4513;"></i>
                                        <span>{{ $item['admin_username'] ?? 'Admin' }}</span>
                                    </div>
                                </td>
                                <td>{{ $item['date'] }}</td>
                                <td>
                                    <div class="preview-item" style="margin: 0; padding: 5px;">
                                        <div class="thumbnail" style="width: 40px; height: 40px;">
                                            <img src="{{ $item['file'] ? asset('storage/' . $item['file']) : '' }}"
                                                alt="">
                                        </div>
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.prestasi.edit', ['kegiatan' => $item['id']]) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', ['kegiatan' => $item['id']]) }}"
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
