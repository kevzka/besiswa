<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="sidebar">
    <div class="sidebar-header">
        <div class="profile">
            <div class="profile-image"
                style="width:40px;height:40px;border-radius:50%;background:#eee;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-right:12px;">
                <img src="{{ asset('img/profile_dummy.jpg') }}" alt="User"
                    style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="profile-info">
                <h3>{{ $adminName }}</h3>
                <p><img src="{{ asset('icons/location-dot-solid-full (1).svg') }}" alt="" class="location-icon"
                        style="width:12px;height:12px;filter:invert(1);"></i> Admin {{ ucfirst($role) }}</p>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-item {{ $activeMenu == 'home' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home" style="margin-right: 10px;"></i> Home</a>
        </div>
        @if ($id_role == 1 || $id_role == 4)
            <div class="nav-item {{ $activeMenu == 'bimbingan' ? 'active' : '' }}">
                <a href="{{ route('admin.bimbingan.create') }}"><i class="fas fa-hands-helping"
                        style="margin-right: 10px;"></i> Bimbingan</a>
            </div>
        @endif
        @if ($id_role == 2 || $id_role == 4)
            <div class="nav-item {{ $activeMenu == 'prestasi' ? 'active' : '' }}">
                <a href="{{ route('admin.prestasi.create') }}"><i class="fas fa-trophy"
                        style="margin-right: 10px;"></i> Prestasi</a>
            </div>
        @endif
        @if ($id_role == 3 || $id_role == 4)
            <div class="nav-item {{ $activeMenu == 'ekskul' ? 'active' : '' }}">
                <a href="{{ route('admin.ekskul.create') }}"><i class="fas fa-calendar-alt"
                        style="margin-right: 10px;"></i> Ekskul</a>
            </div>
        @endif
        <div class="nav-item {{ $activeMenu == 'profil' ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}"><i class="fas fa-user-circle" style="margin-right: 10px;"></i>
                Profil</a>
        </div>
        <div class="nav-item " style="cursor: pointer;">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <a href="#" onclick="confirmLogout()" id="logoutBtn">
                    <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i> Logout
                </a>
            </form>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: "Yakin ingin keluar?", // Judul pop-up
            text: "Anda akan diarahkan ke halaman login.", // Deskripsi atau pesan
            icon: "warning", // Ikon yang ditampilkan (pilihan lain: 'info', 'question', 'success', 'error')
            showCancelButton: true, // Tampilkan tombol 'Batal'
            confirmButtonColor: "#d33", // Warna tombol 'Ya, Keluar' (merah)
            cancelButtonColor: "#3085d6", // Warna tombol 'Batal' (biru)
            confirmButtonText: "Ya, Keluar!", // Teks tombol konfirmasi
            cancelButtonText: "Batal" // Teks tombol batal
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('form[action="{{ route('logout') }}"]').submit();
            }
        });
    }
</script>
{{-- <div id="logoutModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);justify-content:center;align-items:center;">
        <div style="background:#fff;padding:48px 32px 36px 32px;border-radius:6px;box-shadow:0 2px 16px #0002;min-width:400px;max-width:90vw;text-align:center;">
            <div style="font-size:2em;font-weight:500;margin-bottom:36px;color:black;">YAKIN INGIN LOGOUT?</div>
            <div style="display:flex;justify-content:center;gap:32px;">
                <button id="logoutYes" style="background:#7cf34a;color:#111;font-size:2em;font-weight:600;padding:8px 38px;border:none;border-radius:6px;box-shadow:0 2px 4px #0001;cursor:pointer;">YA</button>
                <button id="logoutNo" style="background:#d81c1c;color:#111;font-size:2em;font-weight:600;padding:8px 28px;border:none;border-radius:6px;box-shadow:0 2px 4px #0001;cursor:pointer;">TIDAK</button>
            </div>
        </div>
    </div> --}}
<script>
    // Show modal on logout click
    /* document.getElementById('logoutBtn').onclick = function(e) {
    	e.preventDefault();
    	document.getElementById('logoutModal').style.display = 'flex';
    	document.body.style.overflow = 'hidden';
    }
    // Hide modal on TIDAK
    document.getElementById('logoutNo').onclick = function() {
    	document.getElementById('logoutModal').style.display = 'none';
    	document.body.style.overflow = '';
    }
    // Redirect or handle logout on YA
    document.getElementById('logoutYes').onclick = function() {
        console.log('Logging out...');
        document.querySelector('form[action="{{ route('logout') }}"]').submit();
    } */
</script>
