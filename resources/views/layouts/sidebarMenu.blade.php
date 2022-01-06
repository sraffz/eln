@php
$url = url()->current();
@endphp
<li class="nav-header">PERMOHONAN</li>
<li
    class="nav-item {{ $url == route('registerFormIndividu', 'tidakRasmi') || $url == route('registerFormIndividu', 'rasmi') ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ $url == route('registerFormIndividu', 'tidakRasmi') || $url == route('registerFormIndividu', 'rasmi') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Individu
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('registerFormIndividu', 'rasmi') }}"
                class="nav-link {{ $url == route('registerFormIndividu', 'rasmi') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Rasmi</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('registerFormIndividu', 'tidakRasmi') }}"
                class="nav-link {{ $url == route('registerFormIndividu', 'tidakRasmi') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Tidak Rasmi</p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item {{ $url == route('registerFormRombangan', Auth::user()->usersID) || $url == route('registerFormIndividuRombongan', Auth::user()->usersID) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ $url == route('registerFormRombangan', Auth::user()->usersID) || $url == route('registerFormIndividuRombongan', Auth::user()->usersID) ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Rombongan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('registerFormRombangan', Auth::user()->usersID) }}"
                class="nav-link {{ $url == route('registerFormRombangan', Auth::user()->usersID) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Permohonan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('registerFormIndividuRombongan', Auth::user()->usersID) }}"
                class="nav-link {{ $url == route('registerFormIndividuRombongan', Auth::user()->usersID) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Sertai Rombongan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">SENARAI & KEPUTUSAN</li>
<li class="nav-item">
    <a href="{{ route('senaraiPermohonanProses', Auth::user()->usersID) }}"
        class="nav-link {{ $url == route('senaraiPermohonanProses', Auth::user()->usersID) ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Permohonan Baru</p>
    </a>
</li>
<li
    class="nav-item {{ $url == route('senaraiPermohonanIndividu', Auth::user()->usersID) || $url == route('senaraiPermohonanRombongan', Auth::user()->usersID) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ $url == route('senaraiPermohonanIndividu', Auth::user()->usersID) || $url == route('senaraiPermohonanRombongan', Auth::user()->usersID) ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Keputusan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('senaraiPermohonanIndividu', Auth::user()->usersID) }}"
                class="nav-link {{ $url == route('senaraiPermohonanIndividu', Auth::user()->usersID) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Individu</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('senaraiPermohonanRombongan', Auth::user()->usersID) }}"
                class="nav-link {{ $url == route('senaraiPermohonanRombongan', Auth::user()->usersID) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Rombongan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">PENGGUNA</li>
