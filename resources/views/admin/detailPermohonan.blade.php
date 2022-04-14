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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                                <a href="{{ URL::previous() }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-chevron-left"></i> KEMBALI</a>
                            </div>
                            <div class="float-right">
                                @if ($permohonan->statusPermohonan == 'Ketua Jabatan')
                                    <a onClick="setUserData({{ $permohonan->permohonansID }});" data-toggle="modal"
                                        data-target="#terimapermohonan" class="btn btn-success  btn-sm"><i
                                            class="fa fa-thumbs-up"></i> Lulus
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger  btn-sm" data-toggle="modal"
                                        data-id="{{ $permohonan->permohonansID }}" data-target="#tolakpermohonan">
                                        <i class="fa fa-thumbs-down"></i> Tolak
                                    </button>
        
                                    <a href="{{ url('cetak-butiran-permohonan', [$permohonan->permohonansID]) }}"
                                        class="btn btn-dark  btn-sm">
                                        <i class="fa fa-print"></i> Cetak
                                    </a>
                                @elseif($permohonan->statusPermohonan == 'Permohonan Berjaya')
        
                                @elseif($permohonan->statusPermohonan == 'Permohonan Gagal')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Pemohon</h3>
                        </div>
                        <!-- /.card-header -->
                        @if ($permohonan->status_pengesah != '')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" disabled value="{{ $permohonan->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Kad Pengenalan</label>
                                    <input type="text" class="form-control" disabled value="{{ $permohonan->nokp }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" disabled value="{{ $permohonan->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Jawatan & Gred</label>
                                    <textarea style="resize: none" class="form-control" cols="30" rows="2"
                                        disabled>{{ $permohonan->jawatan_pemohon }}({{ $permohonan->gred_pemohon }})</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <textarea style="resize: none" class="form-control" cols="30" rows="2"
                                        disabled>{{ $permohonan->nama_jabatan }} ({{ $permohonan->kod_jabatan }})</textarea>
                                </div>
                            </div>
                        @else
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" disabled value="{{ $permohonan->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Kad Pengenalan</label>
                                    <input type="text" class="form-control" disabled value="{{ $permohonan->nokp }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" disabled value="{{ $permohonan->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Jawatan & Gred</label>
                                    <textarea style="resize: none" class="form-control" cols="30" rows="2"
                                        disabled>{{ $permohonan->namaJawatan }} ({{ $permohonan->gred_kod_abjad }}{{ $permohonan->gred_angka_nombor }})</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <textarea style="resize: none" class="form-control" cols="30" rows="2"
                                        disabled>{{ Auth::user()->userJabatan->nama_jabatan }} ({{ Auth::user()->userJabatan->kod_jabatan }})</textarea>
                                </div>
                            </div>
                        @endif
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Negara</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $permohonan->negara }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea style="resize: none" class="form-control" disabled rows="3">{{ $permohonan->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jenis Permohonan</label>
                                        <input type="text" class="form-control" disabled
                                            value=" {{ $permohonan->JenisPermohonan }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tujuan</label>
                                        <input type="text" class="form-control" disabled
                                            value=" {{ $permohonan->lainTujuan }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mula">Mula Perjalanan</label>
                                        <input id="mula" type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($permohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="akhir">Tamat Perjalanan</label>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea style="resize: none" class="form-control" disabled
                                            disabled>{{ $permohonan->catatan_permohonan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>

            @php
                $jumlah = 0;
            @endphp

            @foreach ($pasangan as $ppp)
                @php
                    $jumlah++;
                @endphp
                {{-- {{ $jumlah }} --}}
                @if ($ppp->namaPasangan != null || $ppp->namaPasangan != '')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Pasangan/Keluarga/Saudara Pegawai Di Luar Negara</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label><i class="fa fa-user"></i> Nama Pasangan</label>
                                        <input type="text" name="namaPasangan" class="form-control"
                                            value="{{ $ppp->namaPasangan }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label><i class="fa fa-user-friends"></i> Hubungan</label>
                                        <input type="text" name="hubungan" class="form-control"
                                            value="{{ $ppp->hubungan }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label><i class="fa fa-phone"></i> No Tel Pasangan</label>
                                        <input type="text" name="phonePasangan" class="form-control"
                                            data-inputmask='"mask": "(99) 99-99999999"' data-mask
                                            value="{{ $ppp->phonePasangan }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label><i class="fa fa-envelope"></i> Email Pasangan (Jika Ada)</label>
                                        <input type="email" name="emailPasangan" class="form-control"
                                            value="{{ $ppp->emailPasangan }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label><i class="fa fa-edit"></i> Alamat Pasangan</label>
                                        <textarea class="form-control" name="alamatPasangan" rows="3" value=""
                                            disabled>{{ $ppp->alamatPasangan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                @endif
            @endforeach

            @php
                $type = $permohonan->JenisPermohonan;
            @endphp
            @if ($type == 'Tidak Rasmi' || $type == 'rombongan')
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
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($dokumen as $doku)
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('detailPermohonanDokumen.download', ['id' => $doku->dokumens_id]) }}">Dokumen
                                                Rasmi {{ $i++ }}</a>
                                        @endforeach
                                    @endif
                                </p>
                            @elseif ($type == 'Tidak Rasmi' || $type == 'rombongan')
                                <strong><i class="fa fa-book margin-r-5"></i>Dokumen Cuti</strong>
                                <p class="text-muted">
                                    @if ($permohonan->namaFileCuti == '')
                                        Tiada Dokumen
                                    @else
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('detailPermohonan.download', ['id' => $permohonan->permohonansID]) }}">Dokumen
                                            Cuti</a>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ URL::previous() }}" class="btn btn-primary">Kembali</a>
                </div>
            </div> --}}
            <br>
        </div>
    </section>

    <div class="modal fade" id="terimapermohonan" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="favoritesModalLabel">Sokong Permohonan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form method="GET" action="{{ url('pengesahan-permohonan') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="ulasan">Catatan (Jika perlu).</label>
                            <textarea name="ulasan" class="form-control"></textarea>
                            <input name="kopeID" id="kopeID" type="hidden" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Hantar" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tolak permohonan-->
    <div class="modal fade" id="tolakpermohonan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Permohonan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="GET" action="{{ url('pengesahan-permohonan-tolak') }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <input name="id" id="id" type="hidden" value="">
                                <label for="ulasan">Catatan</label>
                                <textarea name="ulasan" required="required" class="form-control"></textarea>
                            </div>
                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
