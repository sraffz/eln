@extends('layouts.master.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Utama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner" style="height: 180px">
                            <h3>E-Luar Negara</h3>
                            <p>Permohonan untuk keluar negara bagi urusan rasmi dan tidak rasmi.</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fighter-jet"></i>
                        </div>
                        <a href="{{ route('halamanUtamaNegara') }}" class="small-box-footer">Selanjut <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner" style="height: 180px">
                            <h3>E-Luar Negeri</h3>
                            <p>Permohonan untuk keluar negeri bagi urusan rasmi seperti mesyuarat / bengkel / taklimat /
                                kursus dan lain - lain urusan rasmi.</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car-side"></i>
                        </div>
                        <a href="{{ route('halamanUtamaNegeri') }}" class="small-box-footer">Selanjut <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
    </section>
@endsection
