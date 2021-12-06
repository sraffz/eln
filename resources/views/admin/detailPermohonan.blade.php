@extends('layouts.eln')

@section('title', 'E-Luar Negara')

@section('link')

@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Butiran Permohonan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ url('senaraiPermohonanProses', [Auth::user()->usersID]) }}">Senarai
                                Permohonan</a></li>
                        <li class="breadcrumb-item active">Butiran Permohonan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Pendaftar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="row">
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Nama</strong>
                            <p class="text-muted">
                                {{ $permohonan->user->nama }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Kad Pengenalan</strong>
                            <p class="text-muted">
                                {{ $permohonan->user->nokp }}
                            </p>
                          </div>
                            <hr>
                            <strong><i class="fas fa-book mr-1"></i> Email</strong>
                            <p class="text-muted">
                                {{ $permohonan->user->email }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Jawatan & Gred</strong>
                            <p class="text-muted">
                                {{ $permohonan->user->userJawatan->namaJawatan }}
                                ({{ $permohonan->user->userGredKod->gred_kod_abjad }}{{ $permohonan->user->userGredAngka->gred_angka_nombor }})
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Jabatan</strong>
                            <p class="text-muted">
                                {{ $permohonan->user->userJabatan->nama_jabatan }}
                                ({{ $permohonan->user->userJabatan->kod_jabatan }})
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Permohonan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Negara</strong>
                            <p class="text-muted">
                                {{ $permohonan->negara }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                            <p class="text-muted">
                                {{ $permohonan->alamat }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Jenis Permohonan</strong>
                            <p class="text-muted">
                                {{ $permohonan->JenisPermohonan }}
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Tujuan</strong>
                            <p class="text-muted">
                                {{ $permohonan->lainTujuan }}
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Tarikh Perjalanan</strong>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mula">Mula</label>
                                        <input id="mula" type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($permohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="akhir">Akhir</label>
                                        <input id="akhir" type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($permohonan->tarikhAkhirPerjalanan)->format('d/m/Y') }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input id="jumlah" type="text" class="form-control"
                                            value="{{ $jumlahDate }} Hari" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            @php
                $type = $permohonan->JenisPermohonan;
            @endphp
            @if ($type == 'Tidak Rasmi')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Maklumat Cuti</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mula">Mula</label>
                                            <input id="mula" type="text" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($permohonan->tarikhMulaCuti)->format('d/m/Y') }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="akhir">Akhir</label>
                                            <input id="akhir" type="text" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($permohonan->tarikhAkhirCuti)->format('d/m/Y') }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jumlah">Kembali bertugas</label>
                                            <input id="jumlah" type="text" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($permohonan->tarikhKembaliBertugas)->format('d/m/Y') }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Cuti</label>
                                            <input id="jumlah" type="text" class="form-control"
                                                value="{{ $jumlahDateCuti }} Hari" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dokumen</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @php
                                $type = $permohonan->JenisPermohonan;
                            @endphp

                            @if ($type == 'Rasmi')
                                <strong><i class="fa fa-book margin-r-5"></i>Dokumen Rasmi</strong>
                                <p class="text-muted">
                                    @if ($dokumen->isEmpty())
                                        Tiada Dokumen
                                    @else
                                        @foreach ($dokumen as $doku)
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('detailPermohonanDokumen.download', ['id' => $doku->dokumens_id]) }}">{{ $doku->namaFile }}</a>
                                        @endforeach
                                    @endif
                                </p>
                            @elseif ($type=='Tidak Rasmi')
                                <strong><i class="fa fa-book margin-r-5"></i>Dokumen Cuti</strong>
                                <p class="text-muted">
                                    @if ($permohonan->namaFileCuti == '')
                                        Tiada Dokumen
                                    @else
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('detailPermohonan.download', ['id' => $permohonan->permohonansID]) }}">{{ $permohonan->namaFileCuti }}</a>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ url('senaraiPermohonanProses', [Auth::user()->usersID]) }}"
                        class="btn btn-primary">Kembali</a>
                </div>
            </div>
            <br>
        </div>
    </section>
@endsection
