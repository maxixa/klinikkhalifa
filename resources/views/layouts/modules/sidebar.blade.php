
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{request()->routeIs('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Home
        </p>
    </a>
</li>
<hr>
<li class="nav-item">
    <a href="{{ route('pasien.index') }}" class="nav-link {{request()->routeIs('pasien.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Pasien
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('terapis.index') }}" class="nav-link {{request()->routeIs('terapis.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Terapis
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('produk.index') }}" class="nav-link {{request()->routeIs('produk.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Data Obat Herbal
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('terapi.index') }}" class="nav-link {{request()->routeIs('terapi.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Jenis Terapi
        </p>
    </a>
</li>
<hr>
<li class="nav-item">
    <a href="{{ route('obat-herbal.index') }}" class="nav-link {{request()->routeIs('obat-herbal.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Admin Obat Herbal
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('rawat-jalan.index') }}" class="nav-link {{request()->routeIs('rawat-jalan.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Admin Rawat Jalan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('rawat-inap.index') }}" class="nav-link {{request()->routeIs('rawat-inap.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Admin Rawat Inap
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('rawat-kunjungan.index') }}" class="nav-link {{request()->routeIs('rawat-kunjungan.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Admin Rawat Kunjungan
        </p>
    </a>
</li>