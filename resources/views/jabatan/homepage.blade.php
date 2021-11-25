@extends('layouts.eln')

@section('title', 'Halaman utama')

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
        
       
      </div>

		{{-- <a href="registerForm/{{ $userDetail -> id }}">Daftar Permohonan</a> --}}

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">

            @foreach ($senarai1 as $sena)
              <!-- timeline time label -->
            <li class="time-label">
              @php
                $status=$sena->statusPermohonan;
                // echo $status;
              @endphp
              @if($status=="Permohonan Berjaya")
                  <span class="bg-green">
              @elseif($status=="Permohonan Gagal")
                  <span class="bg-red">
              @endif
                  @php
                      $create=$sena->tarikhLulusan;
                      $DateNew3= strtotime( $create );
                      $mula = date( 'd-m-Y', $DateNew3);
                      echo $mula;
                    @endphp 
                </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                {{-- <span class="time"><i class="fa fa-clock-o"></i> 

              </span> --}}

                <h3 class="timeline-header">{{$sena->statusPermohonan}} ke<a href="#"> {{$sena->negara}}</a> pada 
                @php
                  $mula=$sena->tarikhMulaPerjalanan;
                  $jale= strtotime( $mula );
                  $mulaJale = date( 'd-m-Y', $jale);
                  echo $mulaJale;
                  echo " .";
                @endphp</h3>

                <div class="timeline-body">
                  {{$sena->JenisPermohonan}} {{$sena->lainTujuan}}
                </div>
                {{-- <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                </div> --}}
              </div>
            </li>
            <!-- END timeline item -->
            @endforeach
            


            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-blue">
                    @php
                      $m=$mula;
                      $u= strtotime( $m );
                      $l = date( 'd-m-Y', $u);
                      echo $l;
                    @endphp
                  </span>
            </li>
            <!-- /.timeline-label -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


@endsection