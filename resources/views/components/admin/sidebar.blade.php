<div class="sidebar">
            <div class="sidebar-header">
                <div class="profile">
                    <div class="profile-img">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-info">
                        <h3>M. AUFA RAHMAN</h3>
                        <p><i class="fas fa-circle" style="font-size: 8px;"></i> {{ ucfirst($role) }}</p>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item {{ $activeMenu == 'home' ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-home" style="margin-right: 10px;"></i> Home</a>
                </div>
                @if ($id_role == 1 || $id_role == 4)
                    <div class="nav-item {{ $activeMenu == 'bimbingan' ? 'active' : '' }}">
                        <a href="{{ route('admin.bimbingan.create')}}"><i class="fas fa-hands-helping" style="margin-right: 10px;"></i> Bimbingan</a>
                    </div>
                @endif
                @if ($id_role == 2 || $id_role == 4)
                    <div class="nav-item {{ $activeMenu == 'prestasi' ? 'active' : '' }}">
                        <a href="{{ route('admin.prestasi.create') }}"><i class="fas fa-trophy" style="margin-right: 10px;"></i> Prestasi</a>
                    </div>
                @endif
                @if ($id_role == 3 || $id_role == 4)
                    <div class="nav-item {{ $activeMenu == 'ekskul' ? 'active' : '' }}">
                        <a href="{{ route('admin.ekskul.create') }}"><i class="fas fa-calendar-alt" style="margin-right: 10px;"></i> Ekskul</a>
                    </div>
                @endif
                <div class="nav-item {{ $activeMenu == 'profil' ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}"><i class="fas fa-user-circle" style="margin-right: 10px;"></i> Profil</a>
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