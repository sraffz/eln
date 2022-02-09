@extends('layouts.eln')

@section('title', 'Permohonan Bagi Rombongan: Rasmi')

@section('link')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="box-title">Borang Pemohonan Rombongan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item active">Permohonan Rombongan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {!! Form::model($userDetail, ['method' => 'POST', 'url' => ['daftarPermohonanRombongan', $userDetail->usersID], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
    {!! Form::hidden('id', $userDetail->usersID) !!}
    <section class="content">
        <div class="container-fluid">
            @include('flash::message')
            <!-- general form elements disabled -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Maklumat Permohonan Perjalanan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Terima Insuran </label>
                                <input type="date" class="form-control"  name="tarikhInsuranRom" value="{{ old('tarikhInsuranRom') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Mula Rombongan dan sehingga<span
                                        style="color:red;">**</span></label>
                                <input type="text" class="form-control" id="reservation" name="tarikhmulaAkhir" value="{{ old('tarikhmulaAkhir') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-edit"></i> Tujuan Permohonan<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="tujuanRom" value="{{ old('tujuanRom') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-globe"></i> Negara<span style="color:red;">**</span></label>
                                <select class="form-control select2bs4" name="negaraRom" id="negaraRom" style="width: 100%;"
                                    required>
                                    @foreach ($negara as $jaw)
                                        <option value="{{ $jaw->namaNegara }}" {{ $jaw->namaNegara == old('negaraRom') ? 'selected' : '' }}>{{ $jaw->namaNegara }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-money-bill-alt"></i> Sumber Kewangan<span
                                        style="color:red;">**</span></label>
                                <select class="form-control" id="jenisKewanganRom" name="jenisKewanganRom" required>
                                    <option value="Kerajaan" {{ 'Kerajaan' == old('jenisKewangan') ? 'selected' : '' }}>Kerajaan</option>
                                    <option value="Federal" {{ 'Federal' == old('jenisKewangan') ? 'selected' : '' }}>Federal</option>
                                    <option value="Persendirian" {{ 'Persendirian' == old('jenisKewangan') ? 'selected' : '' }}>Persendirian</option>
                                    <option value="Jabatan" {{ 'Jabatan' == old('jenisKewangan') ? 'selected' : '' }}>Jabatan</option>
                                    <option value="Syarikat" {{ 'Syarikat' == old('jenisKewangan') ? 'selected' : '' }}>Syarikat</option>
                                    <option value="lain-lain" {{ 'lain-lain' == old('jenisKewangan') ? 'selected' : '' }}>lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-money-bill-alt"></i> Anggaran Belanja(RM)<span
                                        style="color:red;">*</span></label>
                                <input class="form-control" type="number" placeholder="0.00" required
                                    name="anggaranBelanja" min="0" step="0.01" title="Currency"
                                    pattern="^\d+(?:\.\d{1,2})?$"
                                    onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"
                                    value="{{ old('anggaranBelanja') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><i class="fa fa-edit"></i> Alamat Rombongan</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-o"></i>
                                    </div>
                                    <textarea class="form-control" name="alamatRom" id="alamatRom" cols="170">{{ old('alamatRom') }}</textarea>
                                </div>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><i class="fa fa-file"> </i> Dokumen Rasmi<span
                                        style="color:red;">**</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileRasmiRom[]" id="exampleInputFile"
                                        multiple required>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            {!! Form::submit('Hantar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Date range picker
            $('#reservation').daterangepicker()
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
        })
    </script>

@endsection
