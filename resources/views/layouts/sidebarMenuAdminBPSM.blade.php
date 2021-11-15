<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Pentadbir</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ url('/') }}"><i class="fa fa-link"></i> <span>Halaman Utama</span></a></li>
        
       
         {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Individu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('registerFormIndividu', $userDetail -> usersID )}}" data-toggle="tooltip" title="Permohonan rasmi untuk individu." data-placement="right" ><i class="glyphicon glyphicon-pencil"></i>Rasmi</a></li>
            <li><a href="{{route('registerFormIndividu', $userDetail -> usersID )}}" data-toggle="tooltip" title="Permohonan tidak rasmi untuk individu." data-placement="right"><i class="fa fa-edit"></i>Tidak Rasmi</a></li>
            <li><a href="{{route('registerFormIndividuRombongan', $userDetail -> usersID )}}" data-toggle="tooltip" title="Permohonan individu untuk menyertai rombongan." data-placement="right"><i class="glyphicon glyphicon-briefcase"></i>Rombongan</a></li>
            <li><a href="#" data-toggle="tooltip" title="Permohonan secara blanket aproval untuk individu" data-placement="right"><i class="fa fa-child"></i>Blanket Aproval</a></li>
          </ul>
        </li> --}}

         <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Senarai Permohonan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('senaraiPending')}}"><i class="fa fa-navicon"></i> <span>Individu</span></a></li>
          <li><a href="{{route('senaraiPendingRombongan')}}"><i class="fa fa-navicon"></i> <span>Rombongan</span></a></li>
          </ul>
        </li>
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Rekod Permohonan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('senaraiRekodIndividu')}}"><i class="fa fa-navicon"></i> <span>Individu</span></a></li>
          <li><a href="{{route('senaraiRekodRombongan')}}"><i class="fa fa-navicon"></i> <span>Rombongan</span></a></li>
          </ul>
        </li> --}}

          <li class="header">Kelulusan Permohonan YB Dato'</li>
        {{--  <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Kelulusan Permohonan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('semakkanDato')}}"><i class="fa fa-navicon"></i> <span>Individu</span></a></li>    
          <li><a href="{{route('senaraiRombonganKetua')}}"><i class="fa fa-navicon"></i> <span>Rombongan</span></a></li>
          </ul>
        </li>
         --}}

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Rekod Permohonan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('senaraiRekodIndividu')}}"><i class="fa fa-navicon"></i> <span>Individu</span></a></li>
          <li><a href="{{route('senaraiRekodRombongan')}}"><i class="fa fa-navicon"></i> <span>Rombongan</span></a></li>
          </ul>
        </li>
        
        

        <li class="header">Laporan</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Tahunan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('laporanLP')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Lelaki & Perempuan</span></a></li>
          <li><a href="{{route('laporanJabatan')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Jabatan</span></a></li>
          <li><a href="{{route('laporanViewIndividu')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Individu</span></a></li>
          <li><a href="{{route('laporanNegara')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Negara</span></a></li>
          <li><a href="{{route('laporanViewBG')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Lulus / Gagal</span></a></li>
          <li><a href="{{route('laporanViewTahun')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Tahun</span></a></li>
          <li><a href="{{route('laporanBulanan')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')"><i class="fa fa-navicon"></i> <span>Berjaya Setiap Bulan</span></a></li>
          </ul>
        </li>
        {{-- <li><a href="{{route('carian')}}"><i class="fa fa-search"></i> <span>Carian</span></a></li> --}}
        <li>
          <a href="{{route('laporanDato')}}" onclick="return confirm('Adakah anda pasti untuk mencetak laporan ini?')">
            <i class="fa fa-print"></i><span>Cetak</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ Auth::user()->countSideCetak() }}</small> 
            </span>
          </a>
        </li>

        <li><a href="{{route('jumlahKeluarnegara')}}"><i class="fa fa-book"></i><span>Jumlah Keluar Negara</span></a>

        <li class="header">Pengguna</li>
        <li><a href="{{route('senaraiPengguna')}}"><i class="fa fa-user-plus"></i> <span>Senarai Pengguna</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-child"></i> <span>Pic Jabatan</span> 
            <span class="pull-right-container"> 
              <i class="fa fa-angle-left pull-right"></i> 
            </span> 
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('daftarPic')}}"><i class="fa fa-navicon"></i> <span>Daftar</span></a></li>
          <li><a href="{{route('senaraiPic')}}"><i class="fa fa-navicon"></i> <span>Senarai</span></a></li>
          </ul>
        </li>

        <li class="header">Konfigurasi</li>
        {{-- <li><a href="{{route('tambahJabatan')}}"><i class="fa fa-link"></i> <span>Tambah Jabatan</span></a></li> --}}
        <li><a href="{{route('senaraiJabatan')}}"><i class="fa fa-building"></i> <span>Senarai Jabatan</span></a></li>
        <li><a href="{{route('senaraiJawatan')}}"><i class="fa fa-briefcase"></i> <span>Senarai Jawatan</span></a></li>
        <li><a href="{{route('senaraiGredKod')}}"><i class="fa fa-briefcase"></i> <span>Senarai Gred Kod</span></a></li>
        <li><a href="{{route('senaraiGredAngka')}}"><i class="fa fa-briefcase"></i> <span>Senarai Gred Angka</span></a></li>
        <li><a href="{{route('terusDato')}}"><i class="fa fa-briefcase"></i> <span>Permohonan Terus Dato</span></a></li>
        <li><a href="{{route('infoSurat')}}"><i class="fa fa-briefcase"></i> <span>Maklumat Surat</span></a></li>
        
        
        
</ul>