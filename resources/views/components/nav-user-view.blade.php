<div class="nav-actions">
    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ $activeMenu == 'dashboard' ? 'active' : '' }}">AdaSiswa</a>
        <a href="{{ route('bimbingan') }}" class="{{ $activeMenu == 'bimbingan' ? 'active' : '' }}">Bimbingan</a>
        <a href="{{ route('prestasi') }}" class="{{ $activeMenu == 'prestasi' ? 'active' : '' }}">Prestasi</a>
        <a href="{{ route('ekskul') }}" class="{{ $activeMenu == 'ekskul' ? 'active' : '' }}">Ekskul</a>
        <a href="{{ route('portofolio') }}" class="{{ $activeMenu == 'portofolio' ? 'active' : '' }}">Portofolio</a>
    </div>
</div>
