@extends('layouts.elnegeri.master')

@section('title', 'E-Luar Negeri | Keputusan Permohonan')

@section('link')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>E-Luar Negeri | Keputusan Permohonan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('halamanUtamaNegeri') }}">E-Luar Negeri</a></li>
                        <li class="breadcrumb-item active">Keputusan Permohonan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Keputusan Permohonan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Program</th>
                                            <th>Negeri</th>
                                            <th>Tarikh Permohonan</th>
                                            <th>Tarikh Mula Program</th>
                                            <th>Tarikh Akhir Program</th>
                                            <th>Tarikh Kelulusan</th>
                                            <th>Status Permohonan</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rekod as $permohonan)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('negeri.butiran-permohonan', [$permohonan->id]) }}"
                                                        class="badge bg-dark" >{{ $permohonan->program }}</a >
                                                </td>
                                                <td>{{ $permohonan->negeri }}</td>
                                                <td>{{ \Carbon\Carbon::parse($permohonan->created_at)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($permohonan->tarikh_mula)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($permohonan->tarikh_akhir)->format('d/m/Y') }}</td>
                                                 <td>Tarikh Kelulusan</td>
                                                 <td>
                                                    @if ($permohonan->status == 'Berjaya')
                                                    <span class="badge bg-success" >{{ $permohonan->status }}</span>
                                                    @else
                                                    <span class="badge bg-danger" >{{ $permohonan->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-xs" href="#" role="button" >Surat/Memo</a >
                                                    <a class="btn btn-dark btn-xs" href="#" role="button" >Batal</a >
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
