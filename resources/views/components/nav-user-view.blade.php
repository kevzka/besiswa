<div class="nav-actions">
    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ $activeMenu == 'dashboard' ? 'active' : '' }}">Home</a>
        <a href="{{ route('bimbingan', $deg) }}" class="{{ $activeMenu == 'bimbingan' ? 'active' : '' }}">Bimbingan</a>
        <a href="{{ route('prestasi', $deg) }}" class="{{ $activeMenu == 'prestasi' ? 'active' : '' }}">Prestasi</a>
        <a href="{{ route('ekskul', $deg) }}" class="{{ $activeMenu == 'ekskul' ? 'active' : '' }}">Ekskul</a>
        <a href="{{ route('portofolio', $deg) }}" class="{{ $activeMenu == 'portofolio' ? 'active' : '' }}">Portofolio</a>
    </div>
</div>
