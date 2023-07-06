@extends('layouts.eln')

@section('title', 'Permohonan Individu')

@section('link')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($typeForm == 'rasmi')
                        <h3 class="box-title">Borang Pemohonan Rasmi</h3>
                    @elseif($typeForm == 'tidakRasmi')
                        <h3 class="box-title">Borang Pemohonan Tidak Rasmi</h3>
                    @endif
                    {{-- <h1>Borang Permohonan (Rasmi)</h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item active">Permohonan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    {!! Form::model($userDetail, [
        'method' => 'POST',
        'url' => ['daftarPermohonan', $userDetail->usersID],
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
        'autocomplete' => 'off',
    ]) !!}

    {!! Form::hidden('id', $userDetail->usersID) !!}
    <section class="content">
        <div class="container-fluid">
            @include('flash::message')
            <div class="row">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- general form elements disabled -->
            @php
                // $url != url('senaraiRekodIndividu')
                if (Route::current()->getName() == 'borangLewat') {
                    $tema = 'danger';
                    $nilai = 1;
                    $lastDate = 0;
                } else {
                    $tema = 'primary';
                    $nilai = 0;
                
                    if ($typeForm == 'rasmi') {
                        $lastDate = 8;
                    } elseif ($typeForm == 'tidakRasmi') {
                        $lastDate = 15;
                    }
                }
            @endphp
            <div class="card card-{{ $tema }}">
                <div class="card-header">
                    <h3 class="card-title">Maklumat Permohonan Perjalanan</h3> <input type="hidden" name="borang_lewat"
                        id="borang_lewat" value="{{ $nilai }}">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="tarikh"><i class="fas fa-calendar"></i> Tarikh Terima Insuran</label>
                                {{-- <input type="text" class="form-control" id="datepicker" name="tarikh"> --}}
                                <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}" name="tarikh"
                                    id="tarikh" value="{{ old('tarikh') }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <!-- text input -->

                            <div class="form-group">
                                <label for="tarikhMula"><i class="fas fa-calendar"></i> Tarikh Mula Perjalanan<span
                                        style="color:red;">*</span></label>
                                <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}" name="tarikhMula"
                                    value="{{ old('tarikhMula') }}" onBlur="myFunction()" id="tarikhMula"
                                    min="{{ \Carbon\Carbon::now()->addDays($lastDate)->format('Y-m-d') }}" required>
                                @if ($typeForm == 'tidakRasmi')
                                    <small><i>*Permohonan mesti dihantar sebelum 14 hari dari tarikh perjalanan.</i></small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="tarikhAkhir"><i class="fas fa-calendar"></i> Tarikh Akhir Perjalanan<span
                                        style="color:red;">*</span></label>
                                <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}" name="tarikhAkhir"
                                    value="{{ old('tarikhAkhir') }}" id="tarikhAkhir" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <label for="negara"><i class="fas fa-globe"></i> Negara<span
                                        style="color:red;">*</span></label>
                                <select class="form-control select2bs4" id="negara" name="negara" style="width: 100%;"
                                    required>
                                    <option value="">SILA PILIH</option>
                                    @foreach ($negara as $jaw)
                                        <option value="{{ $jaw->namaNegara }}"
                                            {{ $jaw->namaNegara == old('negara') ? 'selected' : '' }}>
                                            {{ $jaw->namaNegara }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 mt-4 text-center">
                            <div class="icheck-primary mb-2">
                                <input class="icheck-primary" OnChange="javascript:enableTextBox();" type="checkbox"
                                    value="1" name="negara_lebih" id="negara_lebih" @checked(old('negara_lebih') == '1')>
                                <label class="form-check-label" for="negara_lebih">
                                    Adakah melawati lebih daripada 1 negera?
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <label for="negara_tambahan"><i class="fas fa-globe"></i> Negara Tambahan<span
                                        style="color:red;">*</span>
                                </label>
                                <select class="form-control select2bs4" name="negara_tambahan[]" id="negara_tambahan"
                                    style="width: 100%;" {{ old('negara_lebih') == 1 ? '' : 'disabled' }} multiple>
                                    <option value="">SILA PILIH</option>
                                    @foreach ($negara as $jaw)
                                        <option value="{{ $jaw->namaNegara }}"
                                            {{ $jaw->namaNegara == old('negara_tambahan') ? 'selected' : '' }}>
                                            {{ $jaw->namaNegara }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            @if ($typeForm == 'rasmi')
                                <div class="form-group">
                                    <label for="tujuan"><i class="fa fa-edit"> </i> Tujuan Permohonan<span
                                            style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="tujuan" name="tujuan"
                                        value="{{ old('tujuan') }}" required>
                                </div>
                            @elseif($typeForm == 'tidakRasmi')
                                <div class="form-group">
                                    <label for="tujuan"><i class="fa fa-edit"> </i> Tujuan Permohonan<span
                                            style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="tujuan" id="tujuan"
                                        value="{{ old('tujuan') }}" required>
                                </div>
                            @endif
                            <!-- text input -->
                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="alamat"><i class="fa fa-edit"> </i> Alamat semasa bertugas / bercuti <span
                                        style="color:red;">*</span></label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    value="{{ old('alamat') }}" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phone"><i class="fa fa-phone"> </i> No. Telefon<span
                                        style="color:red;">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="{{ old('phone') }}" data-inputmask='"mask": "999-99999999"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($typeForm == 'rasmi')
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="jenisKewangan"><i class="fas fa-money-bill-alt"></i> Jenis Kewangan<span
                                            style="color:red;">*</span></label>
                                    <select class="form-control" id="jenisKewangan" name="jenisKewangan"
                                        required="required">
                                        <option value="Kerajaan"
                                            {{ 'Kerajaan' == old('jenisKewangan') ? 'selected' : '' }}>Kerajaan</option>
                                        <option value="Federal" {{ 'Federal' == old('jenisKewangan') ? 'selected' : '' }}>
                                            Federal</option>
                                        <option value="Persendirian"
                                            {{ 'Persendirian' == old('jenisKewangan') ? 'selected' : '' }}>Persendirian
                                        </option>
                                        <option value="Jabatan" {{ 'Jabatan' == old('jenisKewangan') ? 'selected' : '' }}>
                                            Jabatan</option>
                                        <option value="Syarikat"
                                            {{ 'Syarikat' == old('jenisKewangan') ? 'selected' : '' }}>Syarikat</option>
                                        <option value="lain-lain"
                                            {{ 'lain-lain' == old('jenisKewangan') ? 'selected' : '' }}>lain-lain
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleInputFile"><i class="fa fa-file"> </i> Dokumen Rasmi<span
                                        style="color:red;">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileRasmi[]"
                                        id="exampleInputFile" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                </div>
                                @if ($errors->has('fileRasmi'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fileRasmi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @elseif($typeForm == 'tidakRasmi')
                            <input type="hidden" name="jenisKewangan" value="Persendirian">
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="exampleInputFile"><i class="fa fa-file"> </i> Dokumen Sokongan</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="filesokongan[]"
                                    id="exampleInputFile" multiple>
                                <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                <small><i>*tertakluk kepada kelulusan dalaman bagi pejabat daerah atau perkara
                                        berkaitan.</i></small>
                                @if ($errors->has('filesokongan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('filesokongan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="catatan_permohonan">Catatan</label>
                                <textarea class="form-control" name="catatan_permohonan" id="catatan_permohonan" rows="3">{{ old('catatan_permohonan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-{{ $tema }}">
                <div class="card-header">
                    <h3 class="card-title">Maklumat Pasangan/Keluarga/Saudara Pegawai Di Luar Negara</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="namaPasangan"><i class="fa fa-user"></i> Nama Pasangan</label>
                                <input type="text" id="namaPasangan" name="namaPasangan" class="form-control"
                                    placeholder="" value="{{ old('namaPasangan') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="hubungan"><i class="fa fa-user-friends"></i> Hubungan</label>
                                <input type="text" id="hubungan" name="hubungan" class="form-control"
                                    placeholder="" value="{{ old('hubungan') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="phonePasangan"><i class="fa fa-phone"></i> No Tel Pasangan</label>
                                <input type="text" id="phonePasangan" name="phonePasangan" class="form-control"
                                    value="{{ old('phonePasangan') }}" data-mask>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="emailPasangan"><i class="fa fa-envelope"></i> Email Pasangan (Jika
                                    Ada)</label>
                                <input type="email" id="emailPasangan" name="emailPasangan" class="form-control"
                                    placeholder="" value="{{ old('emailPasangan') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label for="alamatPasangan"><i class="fa fa-edit"></i> Alamat Pasangan</label>
                                <textarea class="form-control" id="alamatPasangan" name="alamatPasangan" rows="3" placeholder="">{{ old('alamatPasangan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->
            </div>
            @if ($typeForm == 'tidakRasmi')
                <div class="card card-{{ $tema }}">
                    <div class="card-header">
                        <h3 class="card-title">Maklumat Kelulusan Cuti rehat (Jika Perlu)</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="tarikhMulaCuti"><i class="fas fa-calendar"></i> Tarikh Mula Cuti</label>
                                    <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}"
                                        name="tarikhMulaCuti" id="tarikhMulaCuti" onblur="myFunctionCuti()"
                                        value="{{ old('tarikhMulaCuti') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="tarikhAkhirCuti"><i class="fas fa-calendar"></i> Tarikh Akhir Cuti</label>
                                    <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}"
                                        name="tarikhAkhirCuti" id="tarikhAkhirCuti" onblur="myFunctionKembali()"
                                        value="{{ old('tarikhAkhirCuti') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="tarikhKembaliBertugas"><i class="fas fa-calendar"></i> Tarikh Kembali
                                        Bertugas</label>
                                    <input type="date" class="form-control" pattern="\d{2}-\d{2}-\d{4}"
                                        name="tarikhKembaliBertugas" id="tarikhKembaliBertugas"
                                        value="{{ old('tarikhKembaliBertugas') }}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="exampleInputFile"><i class="fa fa-file"> </i> Dokumen Cuti</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fileCuti[]"
                                            id="exampleInputFile" multiple>
                                        <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card card-{{ $tema }}">
                <div class="card-header">
                    <h3 class="card-title">Perakuan Permohonan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            <div class="form-group">
                                <div class="icheck-info">
                                    <input class="form-check-input" type="checkbox" name="tick" id="tick"
                                        value="yes" required>
                                    <label class="form-check-label" for="tick">Segala keterangan adalah benar dan
                                        mematuhi
                                        peraturan.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            @if ($typeForm == 'rasmi')
                                <input type="hidden" name="jenisPermohonan" value="Rasmi">
                            @elseif($typeForm == 'tidakRasmi')
                                <input type="hidden" name="jenisPermohonan" value="Tidak Rasmi">
                            @endif
                            <div class="">
                                {!! Form::reset('Semula', ['class' => 'btn btn-danger']) !!}
                                {!! Form::submit('Hantar', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
    {!! Form::close() !!}

@endsection

@section('script')
    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
            orientation: "bottom",
        })

        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date range picker
            $('#reservation').daterangepicker({
                locale: {
                    format: 'MM/DD/YYYY'
                }
            })

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            });
        });
    </script>

    <script type="text/javascript" language="javascript">
        function enableTextBox() {
            if (document.getElementById("negara_lebih").checked == true)
                document.getElementById("negara_tambahan").disabled = false;
            else
                document.getElementById("negara_tambahan").disabled = true;
        }
    </script>

    <script>
        function myFunction() {
            var minToDate = document.getElementById("tarikhMula").value;
            document.getElementById("tarikhAkhir").setAttribute("min", minToDate);
        }

        function myFunctionCuti() {
            var minToDate = document.getElementById("tarikhMulaCuti").value;
            document.getElementById("tarikhAkhirCuti").setAttribute("min", minToDate);
        }

        function myFunctionKembali() {
            var minToDate2 = document.getElementById("tarikhAkhirCuti").value;
            document.getElementById("tarikhKembaliBertugas").setAttribute("min", minToDate2);
        }
    </script>
@endsection
