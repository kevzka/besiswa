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
    <x-admin.sidebar :role="$role" :id-role="$id_role" :adminName="$adminName" active-menu='home'/>
    <div class="main-content">
		<div class="topbar">
			<div class="menu-icon"><img src="{{asset('icons/bars-solid-full.svg')}}" alt="" style="width: 100%;"></div>
			<div class="search-bar">
				<input type="text" placeholder="Search">
			</div>
		</div>
		<div class="content-wrapper">
            <div class="banner-box"></div>

            <!-- Tambahan headline + box statistik -->
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
				<table>
					<tbody>
                        @foreach ($data['activities'] as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['date'] }}</td>
                                <td></td>
                                <td class="table-actions">
                                    <form action="{{ route('admin.bimbingan.edit', ['kegiatan' => $item['id']]) }}"
                                        method="GET" style="display: inline;">
                                        @csrf
                                        <a href="javascript:void(0)" onclick="this.parentElement.submit()">
                                            <i title="Edit" class="fa-solid fa-pencil"></i>
                                        </a>
                                    </form>
                                    <a href=""><i title="Move">||</i></a>
                                    <form action="{{ route('admin.bimbingan.destroy', ['kegiatan' => $item['id']]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <a href="javascript:void(0)" onclick="alertDelete(this, event)">
                                            <i title="Delete" class="fa-solid fa-trash"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
            
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/create1.js') }}"></script>
</body>
</html>
