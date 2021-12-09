        <li class="nav-header">SENARAI PERMOHONAN</li>
        {{-- <li class="nav-header">KELULUSAN PERMOHONAN YB DATO'</li> --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p> Permohonan Baru
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('semakkanDato') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Individu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('senaraiRombonganKetua') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rombongan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Rekod Permohonan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('senaraiRekodIndividu') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Individu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('senaraiRekodRombongan') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rombongan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-header">LAPORAN</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-vote-yea"></i>
                <p>
                    Tahunan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanLP') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Lelaki & Perempuan</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanJabatan') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Jabatan</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanViewIndividu') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Individu</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanNegara') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Negara</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanViewBG') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Lulus / Gagal</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanViewTahun') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Tahun</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('laporanBulanan') }}"
                        onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i
                            class="far fa-circle nav-icon"></i> <span>Berjaya Setiap Bulan</span></a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ url('laporanDato') }}" class="nav-link">
                {{-- <i class="nav-icon far fa-circle text-warning"></i> --}}
                <i class="nav-icon fas fa-print"></i>
                <p class="text"> Bundle</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('jumlahKeluarnegara') }}" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p> Jumlah Keluar Negara</p>
            </a>
        </li>
        <li class="nav-header">PENGGUNA</li>
