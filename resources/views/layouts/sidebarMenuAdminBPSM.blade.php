<li class="nav-item {{ url()->current() == route('senaraiPending') || url()->current() == route('senaraiPendingRombongan') ? 'menu-open' : ''}}">
    <a href="#" class="nav-link {{ url()->current() == route('senaraiPending') || url()->current() == route('senaraiPendingRombongan') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Senarai Permohonan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a class="nav-link  {{ url()->current() == route('senaraiPending') ? ' active' : '' }}" href="{{ route('senaraiPending') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Individu
                </p>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link  {{ url()->current() == route('senaraiPendingRombongan') ? ' active' : '' }}" href="{{ route('senaraiPendingRombongan') }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Rombongan</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">KELULUSAN PERMOHONAN YB DATO'</li>
<li class="nav-item {{ url()->current() == route('senaraiRekodIndividu') || url()->current() == route('senaraiRekodRombongan') ? 'menu-open' : ''}}">
    <a href="#" class="nav-link {{ url()->current() == route('senaraiRekodIndividu') || url()->current() == route('senaraiRekodRombongan') ? 'active' : ''}}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Rekod Permohonan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item"><a class="nav-link {{ url()->current() == url('senaraiRekodIndividu') ? ' active' : '' }}" href="{{ route('senaraiRekodIndividu') }}"><i
                    class="far fa-circle nav-icon"></i>
                <P>Individu</P>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link {{ url()->current() == url('/senaraiRekodRombongan') ? ' active' : '' }}" href="{{ route('senaraiRekodRombongan') }}"><i
                    class="far fa-circle nav-icon"></i>
                <P>Rombongan</P>
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
        <p class="text"> Cetak</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('jumlahKeluarnegara') }}" class="nav-link {{ url()->current() == route('jumlahKeluarnegara') ? 'active' : '' }}">
        <i class="nav-icon fas fa-print"></i>
        <p> Jumlah Keluar Negara</p>
    </a>
</li>
<li class="nav-header">PENGGUNA</li>
<li class="nav-item">
    <a href="{{ url('senaraiPengguna') }}" class="nav-link {{ url()->current() == url('senaraiPengguna') ? ' active' : '' }}">
        {{-- <i class="nav-icon far fa-circle text-warning"></i> --}}
        <i class="nav-icon fa fa-user-plus"></i>
        <p class="text">Senarai Pengguna</p>
    </a>
</li>
<li class="nav-item {{ url()->current() == route('daftarPic') || url()->current() == route('senaraiPic') ? 'menu-open' : ''}}">
    <a href="#" class="nav-link {{ url()->current() == route('daftarPic') || url()->current() == route('senaraiPic') ? 'active' : ''}}">
        <i class="nav-icon fas fa-child"></i>
        <p>
            Pic Jabatan
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item"><a class="nav-link {{ url()->current() == route('daftarPic') ? 'active' : '' }}" href="{{ route('daftarPic') }}">
                <i class="far fa-circle nav-icon"></i> <span>Daftar</span></a></li>
        <li class="nav-item"><a class="nav-link {{ url()->current() == route('senaraiPic') ? 'active' : '' }}" href="{{ route('senaraiPic') }}"><i
                    class="far fa-circle nav-icon"></i> <span>Senarai</span></a></li>
    </ul>
</li>
<li class="nav-header">KONFIGURASI</li>
<li class="nav-item"><a class="nav-link {{ url()->current() == route('senaraiJabatan') ? 'active' : '' }}" href="{{ route('senaraiJabatan') }}"><i
            class="nav-icon fa fa-building"></i> <span>Senarai Jabatan</span></a></li>
<li class="nav-item"><a class="nav-link {{ url()->current() == route('senaraiJawatan') ? 'active' : '' }}" href="{{ route('senaraiJawatan') }}"><i
            class="nav-icon fa fa-briefcase"></i> <span>Senarai Jawatan</span></a>
</li>
<li class="nav-item"><a class="nav-link {{ url()->current() == route('senaraiGredKod') ? 'active' : '' }}" href="{{ route('senaraiGredKod') }}"><i
            class="nav-icon fa fa-briefcase"></i> <span>Senarai Gred Kod</span></a>
</li>
<li class="nav-item"><a class="nav-link {{ url()->current() == route('senaraiGredAngka') ? 'active' : '' }}" href="{{ route('senaraiGredAngka') }}"><i
            class="nav-icon fa fa-briefcase"></i> <span>Senarai Gred
            Angka</span></a>
</li>
<li class="nav-item"><a class="nav-link {{ url()->current() == route('terusDato') ? 'active' : '' }}" href="{{ route('terusDato') }}"><i
            class="nav-icon fa fa-briefcase"></i> <span>Permohonan Terus Dato</span></a>
</li>
<li class="nav-item"><a class="nav-link {{ url()->current() == route('infoSurat') ? 'active' : '' }}" href="{{ route('infoSurat') }}"><i
            class="nav-icon fa fa-briefcase"></i> <span>Maklumat Surat</span></a></li>
<li class="nav-header">ADMIN</li>
