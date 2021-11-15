@extends('layouts.starter')

@section('title', 'Halaman Utama')

@section('link')


@endsection

@section('content')

		 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$TotalPerm1}}</h3>

              <p>Jumlah Permohonan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$TotalProces1}}</h3>

              <p>Permohonan dalam proses</p>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$TotalBerjaya1}}</h3>

              <p>Permohonan Berjaya</p>
            </div>
            <div class="icon">
              <i class="fa  fa-check-square-o"></i>
            </div>
            <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$TotalGagal1}}</h3>

              <p>Permohonan Gagal</p>
            </div>
            <div class="icon">
              <i class="fa fa-remove"></i>
            </div>
            <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        
       
      </div>

		{{-- <a href="registerForm/{{ $userDetail -> id }}">Daftar Permohonan</a> --}}

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <div class="row">
          <div class="col col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Google Map</h3>

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      
                  </div>
              </div>
            
             {{--  <div class="box-body">
              <div class="iframe-container col-xs-12 text-center">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16300243.318149967!2d100.55885159479593!3d4.111215970346342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3034d3975f6730af%3A0x745969328211cd8!2sMalaysia!5e0!3m2!1sen!2sus!4v1600042864792!5m2!1sen!2sus" width="800" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>
              </div> --}}
              
          </div>
            
          </div>
        </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


@endsection