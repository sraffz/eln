@php
$url = url()->current();
@endphp
<li class="nav-header">PERMOHONAN DARI JABATAN</li>

<li class="nav-item">
    <a href="{{ route('negeri.jabatan.senarai-permohonan') }}"
        class="nav-link {{ $url == route('negeri.jabatan.senarai-permohonan') ? 'active' : '' }}">
        <i class="nav-icon fab fa-wpforms"></i>
         <p>Senarai Permohonan</p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link  {{ url()->current() == route('negeri.jabatan.rekod-permohonan') ? 'active' : '' }}"
        href="{{ route('negeri.jabatan.rekod-permohonan') }}">
        <i class="nav-icon fas fa-chalkboard"></i>
        <P>Keputusan Permohonan</P>
    </a>
</li>

<li class="nav-header">PERMOHONAN</li>
 
<li class="nav-item">
    <a href="{{ route('negeri.borang-permohonan') }}"
        class="nav-link {{ $url == route('negeri.borang-permohonan') ? 'active' : '' }}">
        <i class="nav-icon fab fa-wpforms"></i>
         <p>Borang</p>
    </a>
</li>
 
<li class="nav-header">SENARAI & KEPUTUSAN</li>
<li class="nav-item">
    <a href="{{ route('negeri.senarai-permohonan') }}"
        class="nav-link {{ $url == route('negeri.senarai-permohonan') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Permohonan</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('negeri.keputusan-permohonan') }}"
        class="nav-link {{ $url == route('negeri.keputusan-permohonan') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chalkboard"></i>
        <p>Keputusan</p>
    </a>
</li>
 
<li class="nav-header">PENGGUNA</li>

