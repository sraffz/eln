@extends('layouts.starter')

@section('title', 'Maklumat Diri')

@section('link') 

@endsection

@section('content')

 <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $user->nama }}</h3>

              <p class="text-muted text-center">{{ $user->nokp }}</p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat Diri</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Email</strong>
              <p class="text-muted">{{ $user->email }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Jawatan</strong>
              <p class="text-muted">{{ $user->userJawatan->namaJawatan }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Gred</strong>
              <p class="text-muted">
                {{ $user->userGredKod->gred_kod_abjad }}
                {{ $user->userGredAngka->gred_angka_nombor }}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Peranan</strong>
              <p class="text-muted">
                {{ $user->role }}</p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Jabatan</strong>
              <p>{{ $user->userJabatan->nama_jabatan }} ({{ $user->userJabatan->kod_jabatan }})</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Negara</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <!-- /.user-block -->
                  <p>
                    <ul><h3 class="text-danger"><strong>Negara Pernah Kunjungi:</strong></h3>
                      @foreach ($senaraiNegara as $senaraiNegaras)           
                        <li>{{ $senaraiNegaras }}</li>        
                      @endforeach  
                    </ul>  
                  </p>
                    
                </div>
                <!-- /.post -->
 
              
                <!-- /.post -->
              </div>
              <!-- /.tab-pane --> 
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
@endsection
