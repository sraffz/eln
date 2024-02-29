@extends('layouts.elnegeri.master')

@section('title', 'E-Luar Negeri | Senarai Permohonan')

@section('link')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>E-Luar Negeri | Senarai Permohonan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('halamanUtamaNegeri') }}">E-Luar Negeri</a></li>
                        <li class="breadcrumb-item active">Senarai Permohonan</li>
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
                            <h3 class="card-title">Senarai Permohonan</h3>
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
                                            <th>Tarikh Mula Program</th>
                                            <th>Tarikh Akhir Program</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $permohonan)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('negeri.butiran-permohonan', [$permohonan->id]) }}"
                                                        class="badge bg-dark">{{ $permohonan->program }}</a>
                                                </td>
                                                <td>{{ $permohonan->negeri }}</td>
                                                <td>{{ \Carbon\Carbon::parse($permohonan->tarikh_mula)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($permohonan->tarikh_akhir)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#lulusPermohonan-{{ $permohonan->id }}">
                                                        <i class="far fa-thumbs-up"></i>
                                                    </button>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade text-left" id="lulusPermohonan-{{ $permohonan->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-center" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Lulus Permohonan</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                </div>
                                                                <form action="{{ route('negeri.lulus_permohonan', ['id' => $permohonan->id]) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-body">
                                                                        Luluskan Permohonan ini? 
                                                                        {{-- <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="catatan_permohonan">Sila Pilih Jenis Perjalanan <span
                                                                                            style="color:red;">*</span> : - </label>
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input class="custom-control-input custom-control-input-teal" type="radio"
                                                                                            id="customPejabat" name="jenisKenderaan" value="Kenderaan Pejabat" checked>
                                                                                        <label for="customPejabat" class="custom-control-label">Kenderaan Pejabat</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input class="custom-control-input custom-control-input-teal" type="radio"
                                                                                            id="customUdara" name="jenisKenderaan" value="Waran Udara">
                                                                                        <label for="customUdara" class="custom-control-label">Waran Udara</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input class="custom-control-input custom-control-input-teal" type="radio"
                                                                                            id="customSendiri" name="jenisKenderaan" value="Kenderaan Sendiri">
                                                                                        <label for="customSendiri" class="custom-control-label">Kenderaan Sendiri</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> --}}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-success">Luluskan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('negeri.tolak_permohonan', ['id' => $permohonan->id]) }}"
                                                        class="btn btn-danger btn-xs"
                                                        onclick="javascript: return confirm('Anda pasti untuk menolak permohonan ini?');"><i
                                                            class="far fa-thumbs-down"></i>
                                                    </a>
                                                    <a href="{{ route('negeri.cetak-butiran-permohonan', [$permohonan->id]) }}"
                                                        class="btn btn-dark btn-xs">
                                                        <i class="fa fa-print"></i>
                                                    </a>
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
