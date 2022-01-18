@extends('layouts.eln')

@section('title', 'Kemaskini maklumat pengguna')

@section('link')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kemaskini Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">kemaskini Pengguna</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                {{-- <div class="col-md-2">
                </div> --}}
                <div class="col-md-12">
                    @include('flash::message')
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>Kemaskini Butiran Pengguna</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['method' => 'POST', 'url' => 'kemaskiniDataPengguna']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $users->nama }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>No KP (Username)</label>
                                <div class="input-group">
                                    <input class="form-control" value="{{ $users->nokp }}" disabled>
                                    <input type="hidden" id="nokp" name="nokp" value="{{ $users->nokp }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $users->email }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jabatan</label>
                                <select class="form-control select2bs4" name="jabatan" style="width: 100%;"
                                    required>
                                    <option value="">Sila Pilih</option>
                                    @foreach ($jabatan as $jaw)
                                        <option value="{{ $jaw->jabatan_id }}" {{ $jaw->jabatan_id == $users->jabatan ? 'selected' : '' }}>{{ $jaw->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <select class="form-control select2bs4" name="jawatan" style="width: 100%;"
                                            required>
                                            <option value="">Sila Pilih</option>
                                            @foreach ($jawatan as $jaw)
                                                <option value="{{ $jaw->idJawatan }}" {{ $jaw->idJawatan == $users->jawatan ? 'selected' : '' }}>{{ $jaw->namaJawatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Kod Gred</label>
                                        <select class="form-control select2bs4" name="kod" style="width: 100%;"
                                            required>
                                            <option value="">Sila Pilih</option>
                                            @foreach ($kod as $jaw)
                                            <option value="{{ $jaw->gred_kod_ID }}" {{ $jaw->gred_kod_ID == $users->gredKod ? 'selected' : '' }}>{{ $jaw->gred_kod_abjad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Gred</label>
                                        <select class="form-control select2bs4" name="gred" style="width: 100%;"
                                        required>
                                        <option value="">Sila Pilih</option>
                                            @foreach ($angka as $jaw)
                                                <option value="{{ $jaw->gred_angka_ID }}" {{ $jaw->gred_angka_ID == $users->gredAngka ? 'selected' : '' }}>{{ $jaw->gred_angka_nombor }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div class="">
                                <a href="{{ url('senaraiPengguna') }}" class="btn btn-danger">Kembali</a>
                                <a href="{{ url('reset-kata-laluan', [$users->usersID]) }}" class="btn btn-info">Set
                                    Semula Kata Luluan</a>
                                {!! Form::submit('Kemaskini', ['class' => 'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
@endsection
