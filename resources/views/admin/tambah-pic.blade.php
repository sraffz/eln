@extends('layouts.eln')

@section('title', 'Senarai Pic Jabatan')

@section('link')

@endsection

@section('content')
    @include('flash::message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12"> <br>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5>Tambah Pentadbir</h5>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['method' => 'POST', 'url' => 'daftarJabatan', 'autocomplete' => 'off']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">
                            <label>Nama</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <label>No KP (Username)</label>
                            <div class="input-group">
                                <input maxlength="12" data-inputmask='"mask": "999999999999"' data-mask type="text" class="form-control" id="nokp" name="nokp" placeholder="999999999999" required>
                            </div>
                            <label>Jabatan</label>
                            <div class="input-group">
                                <select style="width: 100%;" id="jabatan" class="form-control select2bs4" name="jabatan"
                                    required>
                                    <option value="">Sila Pilih</option>
                                    @foreach ($jabatan as $jab)
                                        <option value="{{ $jab->jabatan_id }}">{{ $jab->nama_jabatan }}</option>
                                    @endforeach
                                </select>{{-- {{$k->anugerah}} --}}
                            </div>
                            <label>Peranan</label>
                            <div class="input-group">
                                <select style="width: 100%;" id="role" class="form-control select2bs4" name="role"
                                    required=>
                                    <option value="">Sila Pilih</option>
                                    <option value="jabatan">Ketua Jabatan</option>
                                    <option value="adminBPSM">Admin PSM</option>
                                    <option value="DatoSUK">Admin Pejabat Dato</option>
                                    <option value="pengguna">Pengguna</option>
                                </select>{{-- {{$k->anugerah}} --}}
                            </div>
                            <label>Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <label>Katalaluan</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="katalaluan" name="katalaluan" required>
                            </div> 
                          </div>
                          <div class="card-footer text-center">
                          <div class="btn-group pull-right">
                              {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
                              {!! Form::submit('Daftar', ['class' => 'btn btn-success']) !!}
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
