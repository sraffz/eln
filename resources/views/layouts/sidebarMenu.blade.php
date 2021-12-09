<li class="nav-header">PERMOHONAN</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
            individu
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('registerFormIndividu', 'rasmi') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Rasmi</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('registerFormIndividu', 'tidakRasmi') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tidak Rasmi</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Rombongan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('registerFormRombangan', Auth::user()->usersID) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permohonan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('registerFormIndividuRombongan', Auth::user()->usersID) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sertai Rombongan</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-header">SENARAI & KEPUTUSAN</li>
<li class="nav-item">
    <a href="{{ route('senaraiPermohonanProses', Auth::user()->usersID) }}" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>Permohonan Baru</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Senarai Permohonan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('senaraiPermohonanIndividu', Auth::user()->usersID) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Individu</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('senaraiPermohonanRombongan', Auth::user()->usersID) }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Rombongan</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-header">PENGGUNA</li>
