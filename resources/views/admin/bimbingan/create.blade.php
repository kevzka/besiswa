<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekskul Admin</title>
    <link rel="stylesheet" href="../css/globals.css">
    <link rel="stylesheet" href="../css/login.css">

    <style>
        :root {
            --sidebar-bg: #ffffffff;
            --sidebar-bg-dark: #581B1B;
            --sidebar-hover: #a04a4a;
            --sidebar-active: #581B1B;
            --sidebar-border: #fff2;
            --main-bg: #fff;
            --card-border: #DCDCDC;
            --button-main: #843737;
            --button-main-hover: #581B1B;
            --button-disabled: #ccc;
            --input-bg: #f5f5f5;
            --input-border: #ccc;
            --table-row-alt: #f5f5f5;
        }

        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: var(--main-bg);
        }

        .main-content {
            margin-left: 313px;
            min-height: 100vh;
            background: var(--main-bg);
        }

        .topbar {
            display: flex;
            align-items: center;
            background: var(--sidebar-bg);
            padding: 0 0 0 2rem;
            height: 88.8px;
        }

        .menu-icon {
            /* font-size: 2em;
   margin: 0 18px 0 0;
   color: #fff;
   cursor: pointer; */
            width: 2rem;
        }

        .search-bar {
            flex: 1;
            display: flex;
            align-items: center;
        }

        .search-bar input {
            width: 260px;
            padding: 11px 16px;
            border-radius: 6px;
            border: 1.5px solid #DBD0D0;
            font-size: 1em;
            outline: none;
            box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.37);
        }

        .content-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-form {
            box-sizing: border-box;
            margin-top: 5rem;
            background: #fff;
            border: 2px solid var(--card-border);
            border-radius: 8px;
            padding: 32px 32px 24px 32px;
            margin-bottom: 32px;
            z-index: 1;
            width: 90%;
            box-shadow: 0 2px 8px #0001;
        }

        .card-form input[type="text"],
        .card-form textarea,
        .card-form input[type="date"] {
            box-sizing: border-box;
            width: 100%;
            padding: 10px 14px;
            border-radius: 5px;
            border: 1.5px solid var(--input-border);
            background: var(--input-bg);
            font-size: 1.1em;
            margin-bottom: 18px;
            color: #222;
            font-family: inherit;
        }

        .card-form textarea {
            box-sizing: border-box;
            min-height: 60px;
            resize: vertical;
        }

        .card-form .input-row {
            display: flex;
            gap: 16px;
        }

        .card-form .input-row input[type="date"] {
            flex: 1;
        }

        .card-form .file-upload {
            display: flex;
            width: fit-content;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .card-form .file-upload label {
            background: var(--input-bg);
            border-radius: 20px;
            padding: 8px 18px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1em;
        }

        .card-form .file-upload input[type="file"] {
            display: none;
        }

        .card-form .submit-btn {
            background: var(--button-main);
            color: #fff;
            font-size: 1.1em;
            font-weight: 600;
            border: none;
            border-radius: 20px;
            padding: 8px 28px;
            float: right;
            cursor: pointer;
            transition: background 0.2s;
        }

        .card-form .submit-btn:hover {
            background: var(--button-main-hover);
        }

        .table-card {
            background: #fff;
            border: 2px solid var(--card-border);
            border-radius: 8px;
            box-shadow: 0 2px 8px #0001;
            margin-bottom: 32px;
            overflow-x: auto;
            z-index: 1;
            width: 90%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 8px;
            text-align: center;
            font-size: 1.1em;
        }

        th,
        td:first-child {
            text-align: left;
        }

        th {
            text-align: center;
            background: #fff;
            font-weight: 700;
            border-bottom: 2px solid #ccc;
        }

        tr:nth-child(even) {
            background: var(--table-row-alt);
        }

        tr:nth-child(odd) {
            background: #fff;
        }

        .table-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        .table-actions i {
            cursor: pointer;
            font-size: 1.2em;
        }

        .banner-box {
            z-index: 0;
            position: absolute;
            width: 100%;
            height: 271px;
            background-color: #953636;
        }

        .upload-icon {
            height: 20px;
        }

        .form-action-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 0;
        }

        .form-action-row .file-upload {
            margin-bottom: 0;
        }

        .form-action-row .submit-btn {
            float: none;
        }

        a {
            text-decoration: none;
            color: black;
        }
		.filePreview{
			background-color: var(--input-bg);
			border: 1.5px solid var(--input-border);
			width: fit-content; height: 40px; align-items: center; justify-content: space-between; box-sizing: border-box;  display: none;
		}
		.show {
			display: flex;
		}
		.card-form .file-upload.disnone{
			display: none;
		}

        @media (max-width: 900px) {
            .main-content {
                padding: 20px;
                margin-left: 0;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .topbar {
                padding-left: 0;
            }

            .card-form,
            .table-card {
                width: 98vw;
            }
        }
    </style>
</head>

<body>
    <x-admin.sidebar :role="$role" :id-role="$id_role" active-menu='bimbingan' />
    <div class="main-content">
        <div class="topbar">
            <div class="menu-icon"><img src=" {{ asset('icons/bars-solid-full.svg') }}" alt="ini gambar"
                    style="width: 100%;"></div>
            <div class="search-bar">
                <input type="text" placeholder="Search">
            </div>
        </div>
        <div class="content-wrapper">
            <div class="banner-box"></div>
            <div class="card-form">
                <form action="{{ route('admin.bimbingan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" placeholder="Judul berita" required>
                    <textarea name="description" placeholder="Deskripsi" required></textarea>
                    <div class="input-row">
                        <input type="date" name="date" placeholder="00/00/00" required>
                    </div>
                    <div class="form-action-row">
                        <div class="file-upload" id="fileUploadContainer">
                            <label for="fileInput"><span style="font-size:1.2em;">
                                    <div class="upload-icon"><img
                                            src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar"
                                            style="height: 100%;"></div>
                                </span> Pilih file</label>
                            <input type="file" name="file" id="fileInput" class="file-upload-btn" required>
                        </div>
						<div class="filePreview" id="filePreview" style="">
							<div class="tes2" id="thumbnail" style="width: fit-content; height: 100%;">
							</div>
							<p style="display: inline-block; margin: 0px 10px;" id="fileName"></p>
						</div>
                        <button class="submit-btn" type="submit">Terbitkan</button>
                    </div>
                </form>
            </div>
            <div class="table-card">
                <table>
                    <!-- <thead>
      <tr>
       <th>1</th>
       <th>SPMB 26/27</th>
       <th>10/9/25</th>
       <th></th>
                            <th class="table-actions">
        <i title="Edit">&#9998;</i>
        <i title="Move">&#9776;</i>
        <i title="Delete">&#128465;</i>
       </th>
      </tr>
     </thead> -->
                    <tbody>
                        @foreach ($activities as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['date'] }}</td>
                                <td></td>
                                <td class="table-actions">
                                    <a href=""><i title="Edit" class="fa-solid fa-pencil"></i></a>
                                    <a href=""><i title="Move">||</i></a>
                                    <form action="{{ route('admin.bimbingan.destroy', ['kegiatan' => $item['id']]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

										<a href="" onclick="if(confirm('Are you sure you want to delete this item?')) { event.preventDefault(); this.closest('form').submit(); }"><i title="Delete"class="fa-solid fa-trash"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const filePreview = document.getElementById('filePreview'); // Changed from 'filePreview' to 'filepreview'
			const fileUploadContainer = document.getElementById('fileUploadContainer');
            const thumbnail = document.getElementById('thumbnail');
            const fileName = document.getElementById('fileName');
            const fileInfo = document.getElementById('fileInfo');
            const label = document.querySelector('label[for="fileInput"]'); // Changed selector to match your HTML

            if (file) {
                console.log('ada file');

                // Show preview container
                if (filePreview) {
                    filePreview.classList.add('show');
					fileUploadContainer.classList.add('disnone');
                }

                // Set file details
                if (fileName) {
                    fileName.innerHTML = file.name + '<a class="fa-solid fa-x" id="removeFile" style="padding: 0px 10px;"></a>';
                }
                if (fileInfo) {
                    fileInfo.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB - ${file.type}`;
                }

                // Update upload button label
                if (label) {
                    label.innerHTML =
                        `<span style="font-size:1.2em;"><div class="upload-icon"><img src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar" style="height: 100%;"></div></span> File dipilih: ${file.name}`;
                }

                // Clear previous thumbnail
                if (thumbnail) {
                    thumbnail.innerHTML = '';
                    thumbnail.className = 'thumbnail';
                }

                // Generate thumbnail based on file type
                if (file.type.startsWith('image/')) {
                    // Image thumbnail
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.onload = () => URL.revokeObjectURL(img.src);
                    if (thumbnail) thumbnail.appendChild(img);

                } else if (file.type.startsWith('video/')) {
                    // Video thumbnail
                    if (thumbnail) {
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
                    }

                } else if (file.type === 'application/pdf') {
                    // PDF icon - using text since you might not have FontAwesome
                    if (thumbnail) {
                        thumbnail.innerHTML = '<div style="font-size: 40px; color: #dc3545;">📄</div>';
                    }

                } else if (file.type.includes('word') || file.type.includes('document')) {
                    // Word document icon
                    if (thumbnail) {
                        thumbnail.innerHTML = '<div style="font-size: 40px; color: #2b579a;">📝</div>';
                    }

                } else if (file.type.includes('excel') || file.type.includes('sheet')) {
                    // Excel icon
                    if (thumbnail) {
                        thumbnail.innerHTML = '<div style="font-size: 40px; color: #217346;">📊</div>';
                    }

                } else if (file.type.includes('powerpoint') || file.type.includes('presentation')) {
                    // PowerPoint icon
                    if (thumbnail) {
                        thumbnail.innerHTML = '<div style="font-size: 40px; color: #d24726;">📈</div>';
                    }

                } else {
                    // Generic file icon
                    if (thumbnail) {
                        thumbnail.innerHTML = '<div style="font-size: 40px;">📁</div>';
                    }
                }

            } else {
                // Hide preview if no file
                if (filePreview) {
                    filePreview.classList.remove('show');
                }
                if (label) {
                    label.innerHTML =
                        '<span style="font-size:1.2em;"><div class="upload-icon"><img src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar" style="height: 100%;"></div></span> Pilih file';
                }
            }
        });
		document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'removeFile') {
        e.preventDefault();
        
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview'); // Fixed: should be 'filePreview' not 'filepreview'
        const fileUploadContainer = document.getElementById('fileUploadContainer');
        const label = document.querySelector('label[for="fileInput"]');
        
        // Clear the file input
        if (fileInput) {
            fileInput.value = '';
        }
        
        // Hide file preview
        if (filePreview) {
            filePreview.classList.remove('show');
        }
        
        // Show file upload container again
        if (fileUploadContainer) {
            fileUploadContainer.classList.remove('disnone');
        }
        
        // Reset the label text
        if (label) {
            label.innerHTML = '<span style="font-size:1.2em;"><div class="upload-icon"><img src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar" style="height: 100%;"></div></span> Pilih file';
        }
        
        console.log('File removed successfully');
    }
});
    </script>
</body>

</html>
