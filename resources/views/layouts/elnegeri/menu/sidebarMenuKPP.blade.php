@php
$url = url()->current();
@endphp
<li class="nav-header">SENARAI PERMOHONAN</li>
        {{-- <li class="nav-header">KELULUSAN PERMOHONAN YB DATO'</li> --}}
        <li
        <li class="nav-item">
            <a href="{{ route('negeri.pelulus.senarai-permohonan') }}"
                class="nav-link {{ $url == route('negeri.pelulus.senarai-permohonan') ? 'active' : '' }}">
                <i class="nav-icon fab fa-wpforms"></i>
                 <p>Senarai Permohonan</p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ url()->current() == route('negeri.pelulus.rekod-permohonan') ? 'active' : '' }}"
                href="{{ route('negeri.pelulus.rekod-permohonan') }}">
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

        <li class="nav-header">LAPORAN</li>
        {{-- <li class="nav-item {{ request()->is('laporan-*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('laporan-*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-vote-yea"></i>
                <p>
                    Tahunan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('laporan-jantina') ? 'active' : '' }}"
                        href="{{ url('laporan-jantina?tahun=' . now()->year) }}">
                        <i class="far fa-circle nav-icon"></i>
                        <span>Lelaki & Perempuan</span>
                    </a>
                </li>
                <li class="nav-item"><a
                        class="nav-link {{ request()->is('laporan-individu') ? 'active' : '' }}"
                        href="{{ url('laporan-individu') }}"><i class="far fa-circle nav-icon"></i>
                        <span>Individu</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('laporan-jabatan') ? 'active' : '' }}"
                        href="{{ url('laporan-jabatan?tahun=' . now()->year) }}"><i
                            class="far fa-circle nav-icon"></i>
                        <span>Jabatan</span></a></li>

                <li class="nav-item"><a class="nav-link {{ request()->is('laporan-negara') ? 'active' : '' }} "
                        href="{{ url('laporan-negara?tahun=' . now()->year) }}"><i
                            class="far fa-circle nav-icon"></i>
                        <span>Negara</span></a></li>

                <li class="nav-item"><a class="nav-link {{ request()->is('laporan-bulanan') ? 'active' : '' }}"
                        href="{{ url('laporan-bulanan?tahun=' . now()->year) }}"><i
                            class="far fa-circle nav-icon"></i>
                        <span>Bulanan</span></a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('laporan-tahunan') ? 'active' : '' }}"
                        href="{{ route('laporan-tahunan') }}"><i class="far fa-circle nav-icon"></i>
                        <span>Tahun</span></a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ url('laporanDato') }}" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p class="text"> Cetak</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jumlahKeluarnegara') }}"
                class="nav-link {{ request()->is('jumlahKeluarnegara') ? 'active' : '' }}">
                <i class="nav-icon fas fa-print"></i>
                <p> Jumlah Keluar Negara</p>
            </a>
        </li> --}}
        <li class="nav-header">PENGGUNA</li>
