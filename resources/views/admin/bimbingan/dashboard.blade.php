<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home - Admin Utama</title>
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
         #DataTable { table-layout: fixed; width: 100%; }
         #DataTable th {
            background-color: #c7c7c7;
            font-weight: normal;
         }
         .dataTables_wrapper .page-item.active .page-link {

            background-color: #4f93ce;
            border: 1px solid #4f93ce;
        }
    </style>
</head>
<body>
    <x-deleteButton1 title="YAKIN INGIN HAPUS?"></x-deleteButton1>
    <x-admin.sidebar :role="$role" :id-role="$id_role" :adminName="$adminName" active-menu='home' :adminName="$adminName"/>
    <div class="main-content">
		<div class="topbar">
			<div class="menu-icon"><img src="{{asset('icons/bars-solid-full.svg')}}" alt="" style="width: 100%;"></div>
			
		</div>
		<div class="content-wrapper">
            <div class="banner-box"></div>

            <h2 class="headline">Ada berita apa hari ini?</h2>

            <div class="stats-boxes">
                <div class="stat-card">
                    <div class="stat-header">
                        <span>Berita Bimbingan</span>
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-number">{{ $data['countBimbingan'] ?? 0 }}</div>
                </div>
            </div>

            <div class="table-card">
				<table id="DataTable" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($data['activities']))
                            
                        @else
                        @foreach ($data['activities'] as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ date('Y-m-d', strtotime($item['date'])) }}</td>
                                
                                <td class="table-actions">
                                    <form action="{{ route('admin.bimbingan.edit', ['kegiatan' => $item['id_evidence']]) }}"
                                        method="GET" style="display: inline;">
                                        @csrf
                                        <a href="javascript:void(0)" onclick="this.parentElement.submit()">
                                                <i title="Edit" class="fa-solid fa-pencil" ></i>
                                            </a>
                                    </form>
                                    <i >||</i>
                                    <form action="{{ route('admin.bimbingan.destroy', ['kegiatan' => $item['id_evidence']]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <a href="javascript:void(0)" onclick="showButtonModal(this)">
                                                <i title="Delete" class="fa-solid fa-trash" ></i>
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
	<script src="https://code.jquery.com/jquery-3.7.1.js" ></script>
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
    <script>
        let DataTable1 = new DataTable('#DataTable',{
            columnDefs: [
                { className: 'dt-center', targets: [0,1,2,3] },
                {
                    width: '60px',
                    targets: 0
                },{
                    width: '120px',
                    orderable: false,
                    targets: 3
                }
            ],
            fixedHeader: true,
            autoWidth: false,
            layout: {
                topStart: false,
                topEnd: {
                    search: {
                        placeholder: 'Search'
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/create1.js') }}"></script>
</body>
</html>
