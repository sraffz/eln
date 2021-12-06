@extends('layouts.eln')

@section('title', 'eluarNegara')

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
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Rombongan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong><i class="fa fa-book margin-r-5"></i>Negara</strong>
                                    <p class="text-muted">
                                        {{ $rombongan->negaraRom }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="fa fa-book margin-r-5"></i>Kod Rombongan</strong>
                                    <p class="text-muted">
                                        {{ $rombongan->codeRom }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Alamat</strong>
                            <p class="text-muted">
                                {{ $rombongan->alamatRom }}
                            </p>
                            <hr>
                            <strong><i class="fa fa-map-marker margin-r-5"></i>Tarikh Perjalanan </strong>
                            <table border="0" class="table table-responsive">
                                <tr bgcolor="#94ccc7">
                                    <th>Mula</th>
                                    <th>Akhir</th>
                                    <th>Jumlah</th>
                                </tr>
                                <tr>
                                    <th>{{ \Carbon\Carbon::parse($rombongan->tarikhMulaRom)->format('d/m/Y') }} </th>
                                    <th>{{ \Carbon\Carbon::parse($rombongan->tarikhAkhirRom)->format('d/m/Y') }}</th>
                                    <th>{{ $jumlahDate }} Hari</th>
                                </tr>
                            </table>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Tujuan</strong>
                            <p class="text-muted">
                                {{ $rombongan->tujuanRom }}
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Jenis Kewangan Rombongan</strong>
                            <p class="text-muted">
                                {{ $rombongan->jenisKewanganRom }}
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Anggaran Perbelanjaan</strong>
                            <p class="text-muted">
                                RM{{ $rombongan->anggaranBelanja }}
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Status</strong>
                            <p class="text-muted">
                                {{ $rombongan->statusPermohonanRom }}
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Senarai Peserta</strong>
                            <p class="text-muted">
                                @foreach ($peserta as $peser)
                                    <a data-toggle="modal" href='#mdl-kemaskini' data-nama="{{ $peser->user->nama }}"
                                        data-nokp="{{ $peser->user->nokp }}" data-email="{{ $peser->user->email }}"
                                        data-jawatan="{{ $peser->user->jawatan }}"
                                        data-jabatan="{{ $peser->user->jabatan }}">{{ $peser->user->nama }}</a>
                                    <br>
                                @endforeach
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i>Dokumen Rasmi</strong>
                            <p class="text-muted">
                                @if (is_null($dokumen))
                                    Tiada Dokumen
                                @else
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('detailPermohonanDokumen.download', ['id' => $dokumen->dokumens_id]) }}">{{ $dokumen->namaFile }}</a>
                                @endif
                            </p>
                            <hr>
                            <p class="text-center">
                                <a class="btn btn-primary" href="{{ url('senaraiPermohonanProses', [Auth::user()->usersID]) }}" role="button">Kembali</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
