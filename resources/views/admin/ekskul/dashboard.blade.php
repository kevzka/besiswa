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
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <x-deleteButton1 title="YAKIN INGIN HAPUS?"></x-deleteButton1>
    <x-admin.sidebar :role="$role" :id-role="$id_role" :adminName="$adminName" active-menu='home' :adminName="$adminName"/>
    <div class="main-content">
		<div class="topbar">
			<div class="menu-icon"><img src="{{asset('icons/bars-solid-full.svg')}}" alt="" style="width: 100%;"></div>
			<div class="search-bar">
				<input type="text" placeholder="Search">
			</div>
		</div>
		<div class="content-wrapper">
            <div class="banner-box"></div>

            <h2 class="headline">Ada berita apa hari ini?</h2>

            <div class="stats-boxes">
                <div class="stat-card">
                    <div class="stat-header">
                        <span>Berita ekskul</span>
                        <i class="fas fa-theater-masks"></i>
                    </div>
                    <div class="stat-number">{{ $data['countEkskul'] ?? 0 }}</div>
                </div>
            </div>

            <div class="table-card">
				<table>
					<tbody>
                        @if (empty($data['activities']))
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px 0;">
                                    Kamu belum menambahkan kegiatan apapun.
                                </td>
                            </tr>
                        @else
                        @foreach ($data['activities'] as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ date('Y-m-d', strtotime($item['date'])) }}</td>
                                <td></td>
                                <td class="table-actions">
                                    <form action="{{ route('admin.ekskul.edit', ['kegiatan' => $item['id_evidence']]) }}"
                                        method="GET" style="display: inline;">
                                        @csrf
                                        <a href="javascript:void(0)" onclick="this.parentElement.submit()">
                                            <i title="Edit" class="fa-solid fa-pencil"></i>
                                        </a>
                                    </form>
                                    <i>||</i>
                                    <form action="{{ route('admin.ekskul.destroy', ['kegiatan' => $item['id_evidence']]) }}"
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
</body>
</html>
