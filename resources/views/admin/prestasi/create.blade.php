<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Prestasi Admin</title>
</head>

<body>
    <x-deleteButton1 title="YAKIN INGIN HAPUS?"></x-deleteButton1>
    <x-admin.sidebar :role="$role" :id-role="$id_role" :adminName="$adminName" active-menu='prestasi' />
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
                <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
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
                            <input type="file" name="file" id="fileInput" class="file-upload-btn"
                                accept="image/*,video/*,application/pdf" required>
                        </div>
                        <div class="filePreview" id="filePreview" style="">
                            <div class="tes2" id="thumbnail" style="width: fit-content; height: 100%;">
                            </div>
                            <p style="display: inline-block; margin: 0px 10px;" id="fileName"></p>
                        </div>
                        <button class="submit-btn" type="submit" id="submitBtnForm">Terbitkan</button>
                    </div>
                </form>
            </div>
            <div class="table-card">
                <table>
                    <tbody>
                        @if (empty($activities))
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px 0;">
                                    Tidak ada data kegiatan prestasi.
                                </td>
                            </tr>
                        @else
                        @foreach ($activities as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['date'] }}</td>
                                <td></td>
                                <td class="table-actions">
                                    <form action="{{ route('admin.prestasi.edit', ['kegiatan' => $item['id']]) }}"
                                        method="GET" style="display: inline;">
                                        @csrf
                                        <a href="javascript:void(0)" onclick="this.parentElement.submit()">
                                            <i title="Edit" class="fa-solid fa-pencil"></i>
                                        </a>
                                    </form>
                                    <a href=""><i title="Move">||</i></a>
                                    <form action="{{ route('admin.prestasi.destroy', ['kegiatan' => $item['id']]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <a href="javascript:void(0)" onclick="showButtonModal(this)">
                                            <i title="Delete" class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/create1.js') }}"></script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const filePreview = document.getElementById(
            'filePreview'); // Changed from 'filePreview' to 'filepreview'
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
                    fileName.innerHTML = file.name +
                        '<a class="fa-solid fa-x" id="removeFile" style="padding: 0px 10px;"></a>';
                }
                if (fileInfo) {
                    fileInfo.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB - ${file.type}`;
                }

                // Update upload button label
                if (label) {
                    label.innerHTML =
                        `<span style="font-size:1.2em;"><div class="upload-icon"><img src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar" style="height: 100%; cursor: pointer;"></div></span> File dipilih: ${file.name}`;
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
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '4px';
                    img.onload = () => URL.revokeObjectURL(img.src);
                    if (thumbnail) thumbnail.appendChild(img);

                } else if (file.type.startsWith('video/')) {
                    // Video thumbnail - extract first frame
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.muted = true;

                    video.addEventListener('loadeddata', function() {
                        video.currentTime = 0.5;
                    });

                    video.addEventListener('seeked', function() {
                        const canvas = document.createElement('canvas');
                        canvas.width = 200;
                        canvas.height = 200;
                        const ctx = canvas.getContext('2d');

                        const aspectRatio = video.videoWidth / video.videoHeight;
                        let drawWidth, drawHeight, offsetX = 0,
                            offsetY = 0;

                        if (aspectRatio > 1) {
                            drawHeight = canvas.height;
                            drawWidth = drawHeight * aspectRatio;
                            offsetX = (canvas.width - drawWidth) / 2;
                        } else {
                            drawWidth = canvas.width;
                            drawHeight = drawWidth / aspectRatio;
                            offsetY = (canvas.height - drawHeight) / 2;
                        }

                        ctx.drawImage(video, offsetX, offsetY, drawWidth, drawHeight);

                        const img = document.createElement('img');
                        img.src = canvas.toDataURL('image/jpeg', 0.8);
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '4px';

                        if (thumbnail) {
                            thumbnail.innerHTML = '';
                            thumbnail.appendChild(img);
                        }

                        URL.revokeObjectURL(video.src);
                    });

                } else if (file.type === 'application/pdf') {
                    // PDF thumbnail using PDF.js
                    const fileReader = new FileReader();
                    fileReader.onload = function(e) {
                        const typedarray = new Uint8Array(e.target.result);

                        pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                            pdf.getPage(1).then(function(page) {
                                const viewport = page.getViewport({
                                    scale: 1
                                });
                                const canvas = document.createElement('canvas');
                                const context = canvas.getContext('2d');

                                const scale = Math.min(200 / viewport.width, 200 / viewport
                                    .height);
                                const scaledViewport = page.getViewport({
                                    scale: scale
                                });

                                canvas.width = scaledViewport.width;
                                canvas.height = scaledViewport.height;

                                const renderContext = {
                                    canvasContext: context,
                                    viewport: scaledViewport
                                };

                                page.render(renderContext).promise.then(function() {
                                    const img = document.createElement('img');
                                    img.src = canvas.toDataURL('image/jpeg', 0.8);
                                    img.style.width = '100%';
                                    img.style.height = '100%';
                                    img.style.objectFit = 'cover';
                                    img.style.borderRadius = '4px';

                                    if (thumbnail) {
                                        thumbnail.innerHTML = '';
                                        thumbnail.appendChild(img);
                                    }
                                });
                            });
                        }).catch(function(error) {
                            if (thumbnail) {
                                thumbnail.innerHTML =
                                    '<div style="font-size: 40px; color: #dc3545;">📄</div>';
                            }
                        });
                    };
                    fileReader.readAsArrayBuffer(file);

                } else {
                    // Other file types - keep your existing icon logic
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
                const filePreview = document.getElementById(
                'filePreview'); // Fixed: should be 'filePreview' not 'filepreview'
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
                    label.innerHTML =
                        '<span style="font-size:1.2em;"><div class="upload-icon"><img src="{{ asset('icons/cloud-arrow-up-solid-full.svg') }}" alt="ini gambar" style="height: 100%;"></div></span> Pilih file';
                }

                console.log('File removed successfully');
            }
        });
    </script>
</body>

</html>
