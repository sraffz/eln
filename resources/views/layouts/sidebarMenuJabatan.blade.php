
        <li class="nav-item">
            <a class="nav-link  {{ url()->current() == url('senaraiPermohonanLepas') ? 'active' : '' }}" href="{{ route('senaraiPermohonanLepas') }}">
                <i class="nav-icon  fas fa-list"></i>
                <P>Senarai Permohonan</P>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link  {{ url()->current() == url('senaraiPermohonanJabatan') ? 'active' : '' }}" href="{{ route('senaraiPermohonanJabatan') }}">
                <i class="nav-icon fa fa-link"></i>
                <P>Permohonan Baru</P>
            </a>
        </li>
        <li class="nav-header">PERMOHONAN</li>
        <li class="nav-item {{ url()->current() == url('senaraiPending') ||  url()->current() == url('senaraiPendingRombongan') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  {{ url()->current() == url('senaraiPending') ||  url()->current() == url('senaraiPendingRombongan') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Senarai Permohonan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a class="nav-link  {{ url()->current() == url('senaraiPending') ? 'active' : '' }}" href="{{ route('senaraiPending') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Individu
                        </p>
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link  {{ url()->current() == url('senaraiPendingRombongan') ? 'active' : '' }}" href="{{ route('senaraiPendingRombongan') }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rombongan</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{  url()->current() == url('registerFormRombangan', Auth::user()->usersID) ||  url()->current() ==  url('registerFormIndividu', 'rasmi') || url()->current() == url('registerFormIndividu', 'tidakRasmi') || url()->current() == url('registerFormIndividuRombongan', Auth::user()->usersID) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( url()->current() == url('registerFormRombangan', Auth::user()->usersID) ||  url()->current() ==  url('registerFormIndividu', 'rasmi') || url()->current() == url('registerFormIndividu', 'tidakRasmi') || url()->current() == url('registerFormIndividuRombongan', Auth::user()->usersID)) ? 'active' : '' }}">
                <i class="nav-icon fa fa-users"></i>
                <p>Borang
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item {{ url()->current() == url('registerFormIndividu', 'rasmi') || url()->current() == url('registerFormIndividu', 'tidakRasmi') || url()->current() == url('registerFormIndividuRombongan', Auth::user()->usersID) ? 'menu-open' : '' }}"">
                    <a href="#" class="nav-link  {{ url()->current() == url('registerFormIndividu', 'rasmi') || url()->current() == url('registerFormIndividu', 'tidakRasmi') || url()->current() == url('registerFormIndividuRombongan', Auth::user()->usersID) ? 'active' : '' }}"">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Individu
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link  {{ url()->current() == url('registerFormIndividu', 'rasmi') ? 'active' : '' }}" href="{{ route('registerFormIndividu', 'rasmi') }}"><i
                                    class="nav-icon fa fa-edit"></i>Rasmi</a>
                        </li>
                        <li class="nav-item"><a class="nav-link  {{ url()->current() == url('registerFormIndividu', 'tidakRasmi') ? 'active' : '' }}"
                                href="{{ route('registerFormIndividu', 'tidakRasmi') }}"><i
                                    class="nav-icon fa fa-edit"></i>Tidak Rasmi</a></li>
                        <li class="nav-item"><a class="nav-link  {{ url()->current() == url('registerFormIndividuRombongan', Auth::user()->usersID) ? 'active' : '' }}"
                                href="{{ route('registerFormIndividuRombongan', Auth::user()->usersID) }}"><i
                                    class="nav-icon fa fa-edit"></i>Rombongan</a></li>
                        {{-- <li class="nav-item"><a href="#" data-toggle="tooltip" title="Permohonan secara blanket aproval untuk individu" data-placement="right"><i class="nav-icon fa fa-child"></i>Blanket Aproval</a></li> --}}
                    </ul>
                </li>

                <li class="nav-item {{ url()->current() == url('registerFormRombangan', Auth::user()->usersID) ? 'menu-open' : '' }}">
                    <a class="nav-link  {{ url()->current() == url('registerFormRombangan', Auth::user()->usersID) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>Rombongan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link  {{ url()->current() == url('registerFormRombangan', Auth::user()->usersID) ? 'active' : '' }}"
                                href="{{ route('registerFormRombangan', Auth::user()->usersID) }}"><i
                                    class="nav-icon fa fa-edit"></i>Permohonanan</a></li>

                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-header">PENGGUNA</li>

