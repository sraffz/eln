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
                    <h1>kemaskini Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">kemaskini Pengguna</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                {{-- <div class="col-md-2">
            </div> --}}
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>Kemaskini</h3>
                        </div>
                        <div class="card-body">
                            <br>
                            {!! Form::open(['method' => 'POST', 'url' => 'kemaskiniDataPengguna']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">

                            <label>Nama</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $users->nama }}"
                                    required>
                            </div>
                            <br>

                            <label>No KP (Username)</label>
                            <div class="input-group">
                                <input class="form-control" value="{{ $users->nokp }}" disabled>
                                <input type="hidden" id="nokp" name="nokp" value="{{ $users->nokp }}" required>
                            </div>
                            <br>
                            <label>Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $users->email }}" required>
                            </div>
                            <br>
                            <label>Katalaluan</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="katalaluan" name="katalaluan" required><br><br>
                                {{-- <input type="checkbox" onclick="myFunction()">Show Password --}}
                            </div>
                          </div>
                          <div class="card-footer text-center">
                            <div class="btn-group pull-right">
                                <a href="{{ url('senaraiPengguna') }}" class="btn btn-warning">Kembali</a>
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
