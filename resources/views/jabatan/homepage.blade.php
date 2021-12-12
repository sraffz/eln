{{-- @extends('layouts.starter') --}}
@extends('layouts.eln')

@section('title', 'Halaman utama')

@section('link')


@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $TotalPerm1 }}</h3>

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
                            <h3>{{ $TotalBerjaya1 }}</h3>

                            <p>Permohonan Berjaya</p>
                        </div>
                        <div class="icon">
                            <i class="fa  fa-check-square"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $TotalGagal1 }}</h3>

                            <p>Permohonan Gagal</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-minus-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $TotalProces1 }}</h3>

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

            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline timeline-inverse">
                        @foreach ($senarai1 as $sena)
                            <!-- timeline time label -->
                            <div class="time-label">
                                @php
                                    $status = $sena->statusPermohonan;
                                    // echo $status;
                                @endphp
                                @if ($status == 'Permohonan Berjaya')
                                    <span class="bg-green">
                                    @elseif($status=="Permohonan Gagal")
                                        <span class="bg-red">
                                @endif
                                @php
                                    $create = $sena->tarikhLulusan;
                                    $DateNew3 = strtotime($create);
                                    $mula = date('d-m-Y', $DateNew3);
                                    echo $mula;
                                @endphp
                                </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">{{ $sena->statusPermohonan }} ke<a href="#">
                                            {{ $sena->negara }}</a> pada
                                        @php
                                            $mula = $sena->tarikhMulaPerjalanan;
                                            $jale = strtotime($mula);
                                            $mulaJale = date('d-m-Y', $jale);
                                            echo $mulaJale;
                                            echo ' .';
                                        @endphp</h3>
                                    <div class="timeline-body">
                                        {{ $sena->JenisPermohonan }} {{ $sena->lainTujuan }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-blue">
                                @php
                                    $m = $mula;
                                    $u = strtotime($m);
                                    $l = date('d-m-Y', $u);
                                    echo $l;
                                @endphp
                            </span>
                        </div>
                        <!-- /.timeline-label -->
                        <div>
                            <i class="fa fa-clock bg-gray"></i>
                        </div>
                      </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
