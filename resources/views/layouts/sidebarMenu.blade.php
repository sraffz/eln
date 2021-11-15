<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Pentadbir</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ url('/') }}"><i class="fa fa-link"></i> <span>Halaman Utama</span></a></li>
       <li class="header">Pendaftaran</li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Individu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('registerFormIndividu', "rasmi" )}}" data-toggle="tooltip" title="Permohonan rasmi untuk individu." data-placement="right" ><i class="glyphicon glyphicon-pencil"></i>Rasmi</a></li>
            <li><a href="{{route('registerFormIndividu', "tidakRasmi" )}}" data-toggle="tooltip" title="Permohonan tidak rasmi untuk individu." data-placement="right"><i class="fa fa-edit"></i>Tidak Rasmi</a></li>
            <li><a href="{{route('registerFormIndividuRombongan', Auth::user()->usersID )}}" data-toggle="tooltip" title="Permohonan individu untuk menyertai rombongan." data-placement="right"><i class="glyphicon glyphicon-briefcase"></i>Rombongan</a></li>
            {{-- <li><a href="#" data-toggle="tooltip" title="Permohonan secara blanket aproval untuk individu" data-placement="right"><i class="fa fa-child"></i>Blanket Aproval</a></li> --}}
          </ul>
        </li>

         <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Rombongan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('registerFormRombangan', Auth::user()->usersID )}}" data-toggle="tooltip" title="Permohonan secara rombongan." data-placement="right"><i class="fa fa-edit"></i>Permohonanan</a></li> 
            
          </ul>
        </li>

        <li class="header">Permohonan</li>
        <li><a href="{{route('senaraiPermohonanProses',Auth::user()->usersID )}}"><i class="fa fa-link"></i> <span>Permohonan Baru</span></a></li>
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Keputusan Permohonan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('senaraiPermohonanIndividu',Auth::user()->usersID )}}"><i class="fa fa-user-times"></i>Individu</a></li>
            <li><a href="{{route('senaraiPermohonanRombongan',Auth::user()->usersID )}}"><i class="fa fa-user-times"></i>Rombongan</a></li>
          </ul>
        </li>

        

         <li class="header">Configurasi</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ url('profil') }}"><i class="fa fa-circle-o text-red"></i> <span>Profil</span></a></li>
       
 
 
</ul>