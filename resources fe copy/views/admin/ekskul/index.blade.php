<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kegiatan Bimbingan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <style>
        /* Global Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #495057;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            margin: 0;
            font-size: 1.4rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3d8bfe 0%, #00d4fe 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #8b4513;
            border: 1px solid #ffc107;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #fed7aa 0%, #fb9f7f 100%);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: 1px solid #dc3545;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #ff7a7e 0%, #fe8fef 100%);
            transform: translateY(-1px);
        }

        .btn-info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #0c5460;
            border: 1px solid #17a2b8;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #88ddda 0%, #fd96d3 100%);
            transform: translateY(-1px);
        }

        /* Table Styles */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .table {
            margin: 0;
            background: white;
        }

        .table thead th {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
            padding: 1rem 0.75rem;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
            border-bottom: 1px solid #f1f3f4;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.001);
        }

        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border: none;
        }

        /* Thumbnail Styles */
        .img-thumbnail {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
            border-color: #007bff;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
        }

        .file-thumbnail {
            min-height: 80px;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .file-thumbnail:hover {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            transform: translateY(-2px);
        }

        .file-thumbnail i {
            margin-bottom: 0.5rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .no-file {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80px;
            background: linear-gradient(135deg, #f1f3f4 0%, #e8eaf6 100%);
            border-radius: 8px;
            padding: 1rem;
        }

        /* Badge Styles */
        .badge {
            font-size: 0.75rem;
            padding: 0.5rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-info {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
            color: white;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            border: none;
            padding: 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 2rem;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 2rem;
            text-align: center;
        }

        .empty-state i {
            color: #6c757d;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin: 0;
        }

        /* Button Group */
        .btn-group .btn {
            margin: 0 2px;
        }

        /* Container Fluid */
        .container-fluid {
            padding: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.85rem;
            }

            .btn-sm {
                padding: 0.25rem 0.4rem;
                font-size: 0.75rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.6s ease-out;
        }

        /* DataTable Custom Styles */
        .dataTables_wrapper {
            padding: 0;
        }

        .dataTables_filter input {
            border-radius: 20px;
            border: 2px solid #e9ecef;
            padding: 0.5rem 1rem;
            transition: border-color 0.3s ease;
        }

        .dataTables_filter input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .dataTables_length select {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.375rem 0.75rem;
        }

        .page-link {
            border-radius: 8px;
            margin: 0 2px;
            border: none;
            color: #495057;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-1px);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }
    </style>
</head>
<body>
    {{-- @extends('layouts.app') --}}

    {{-- @section('content') --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Kegiatan Bimbingan</h4>
                        <div class="card-header">
                            <h4 class="card-title">Data Kegiatan Bimbingan</h4>
                            <button type="button" class="btn btn-primary btn-sm float-right"
                                onclick="window.location.href='{{ route('admin.bimbingan.create') }}'">
                                <i class="fas fa-plus"></i> Tambah Kegiatan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="kegiatanTable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Thumbnail</th>
                                        <th width="20%">Title</th>
                                        <th width="25%">Deskripsi</th>
                                        <th width="10%">Tanggal</th>
                                        <th width="10%">User</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activityList as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                @if ($item->file)
                                                    @php
                                                        $fileExtension = pathinfo($item->file, PATHINFO_EXTENSION);
                                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                    @endphp

                                                    @if (in_array(strtolower($fileExtension), $imageExtensions))
                                                        <img src="{{ asset('storage/' . $item->file) }}" alt="Thumbnail"
                                                            class="img-thumbnail"
                                                            style="max-width: 80px; max-height: 80px; cursor: pointer;"
                                                            onclick="showImageModal('{{ asset('storage/' . $item->file) }}', '{{ $item->title }}')">
                                                    @else
                                                        <div
                                                            class="file-thumbnail d-flex flex-column align-items-center">
                                                            @if (strtolower($fileExtension) == 'pdf')
                                                                <i class="fas fa-file-pdf text-danger"
                                                                    style="font-size: 2rem;"></i>
                                                            @elseif(in_array(strtolower($fileExtension), ['doc', 'docx']))
                                                                <i class="fas fa-file-word text-primary"
                                                                    style="font-size: 2rem;"></i>
                                                            @elseif(in_array(strtolower($fileExtension), ['xls', 'xlsx']))
                                                                <i class="fas fa-file-excel text-success"
                                                                    style="font-size: 2rem;"></i>
                                                            @elseif(in_array(strtolower($fileExtension), ['ppt', 'pptx']))
                                                                <i class="fas fa-file-powerpoint text-warning"
                                                                    style="font-size: 2rem;"></i>
                                                            @else
                                                                <i class="fas fa-file text-secondary"
                                                                    style="font-size: 2rem;"></i>
                                                            @endif
                                                            <small
                                                                class="text-muted mt-1">{{ strtoupper($fileExtension) }}</small>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="no-file text-muted">
                                                        <i class="fas fa-image" style="font-size: 2rem;"></i>
                                                        <small class="d-block mt-1">No File</small>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->title }}</strong>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    {{ Str::limit($item->description, 100) }}
                                                </p>
                                                @if (strlen($item->description) > 100)
                                                    <button type="button" class="btn btn-link btn-sm p-0"
                                                        onclick="showDescriptionModal('{{ $item->title }}', '{{ addslashes($item->description) }}')">
                                                        Lihat selengkapnya...
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                                </small>
                                            </td>
                                            <td>
                                                @if ($item->admin)
                                                    <span class="badge badge-info">
                                                        {{ $item->admin->username }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    @if ($item->file)
                                                        <a href="{{ asset('storage/kegiatan/' . $item->file) }}"
                                                            class="btn btn-sm btn-info" target="_blank"
                                                            title="Lihat File">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        onclick="editKegiatan({{ $item->id }})" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.bimbingan.destroy', $item->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="fas fa-inbox text-muted" style="font-size: 3rem;"></i>
                                                    <p class="text-muted mt-2">Tidak ada data kegiatan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{-- @if ($activityList->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $activityList->links() }}
                        </div>
                    @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTitle">Preview Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Deskripsi -->
    <div class="modal fade" id="descriptionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalTitle">Deskripsi Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalDescription"></p>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .file-thumbnail {
                min-height: 80px;
                justify-content: center;
            }

            .img-thumbnail:hover {
                transform: scale(1.05);
                transition: transform 0.2s;
            }

            .empty-state {
                padding: 2rem;
            }

            .table td {
                vertical-align: middle;
            }

            .no-file {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 80px;
            }
        </style>
    @endpush

    {{-- @push('scripts') --}}
        <script>
            // Fungsi untuk menampilkan modal gambar
            function showImageModal(imageSrc, title) {
                document.getElementById('modalImage').src = imageSrc;
                document.getElementById('imageModalTitle').textContent = title;
                $('#imageModal').modal('show');
            }

            // Fungsi untuk menampilkan modal deskripsi
            function showDescriptionModal(title, description) {
                document.getElementById('descriptionModalTitle').textContent = title;
                document.getElementById('modalDescription').textContent = description;
                $('#descriptionModal').modal('show');
            }

            // Initialize DataTable jika ingin menggunakan
            $(document).ready(function() {
                $('#kegiatanTable').DataTable({
                    "pageLength": 10,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                    }
                });
            });

            // Fungsi edit kegiatan (placeholder)
            function editKegiatan(id) {
                // Implementasi edit kegiatan
                console.log('Edit kegiatan ID:', id);
                // Redirect ke halaman edit atau tampilkan modal edit
                window.location.href = `/admin/bimbingan/${id}/edit`;
            }
        </script>
    {{-- @endpush --}}
    {{-- @endsection --}}
</body>

</html>
