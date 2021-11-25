<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">MENU PENTADBIR</li>
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Halaman Utama</p>
            </a>
        </li>

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
                    <a href="{{ route('registerFormIndividuRombongan', Auth::user()->usersID) }}"
                        class="nav-link">
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
        <li class="nav-item">
            <a href="{{ url('profil') }}" class="nav-link">
                {{-- <i class="nav-icon far fa-circle text-warning"></i> --}}
                <i class="nav-icon fas fa-id-card"></i>
                <p class="text">Profil</p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p class="text">Log Keluar</p>
          </a>
      </li>
    </ul>
</nav>
