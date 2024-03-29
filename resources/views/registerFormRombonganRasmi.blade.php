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

    {!! Form::model($userDetail, [
        'method' => 'POST',
        'url' => ['daftar-rombongan', $userDetail->usersID],
        'class' => 'form-horizontal',
        'autocomplete' => 'off',
        'enctype' => 'multipart/form-data',
    ]) !!}
    {!! Form::hidden('id', $userDetail->usersID) !!}
    <section class="content">
        <div class="container-fluid">
            @include('flash::message')
            @php
            // $url != url('senaraiRekodIndividu')
            if (Route::current()->getName() == 'borangLewat.permohonan-rombongan') {
                $tema = 'danger';
                $nilai = 1;
                $bilhari = 0;
            } else {
                $tema = 'primary';
                $nilai = 0;
                $bilhari = 15;

            }
        @endphp
            <!-- general form elements disabled -->
            <div class="card card-{{ $tema }}">
                <div class="card-header">
                    <h3 class="card-title">Maklumat Permohonan Perjalanan</h3> &nbsp;<input type="hidden" name="borang_lewat" id="borang_lewat" value="{{ $nilai }}">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-archive"></i> Jenis Rombongan<span
                                        style="color:red;">*</span></label>
                                <select class="form-control" id="jenisRombongan" name="jenisRombongan"
                                    onChange="changetextbox();" required>
                                    <option value="">Sila Pilih</option>
                                    <option value="Rasmi" {{ 'Rasmi' == old('jenisRombongan') ? 'selected' : '' }}>Rasmi
                                    </option>
                                    <option value="Tidak Rasmi"
                                        {{ 'Tidak Rasmi' == old('jenisRombongan') ? 'selected' : '' }}>Tidak Rasmi
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Terima Insuran </label>
                                <input type="date" class="form-control" name="tarikhInsuranRom"
                                    value="{{ old('tarikhInsuranRom') }}">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <!-- text input -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar"></i> Tarikh Mula Rombongan<span
                                                style="color:red;">*</span></label>
                                        <input type="date" class="form-control" id="tarikhMulaRom" name="tarikhMulaRom"
                                            value="{{ old('tarikhMulaRom') }}" onblur="myFunction()"
                                            min="{{ \Carbon\Carbon::now()->addDays($bilhari)->format('Y-m-d') }}" required>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar"></i> Tarikh Akhir Rombongan<span
                                                style="color:red;">*</span></label>
                                        <input type="date" class="form-control" id="tarikhAkhirRom" name="tarikhAkhirRom"
                                            value="{{ old('tarikhAkhirRom') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group mt-2">
                                <label><i class="fas fa-edit"></i> Tujuan Permohonan<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="tujuanRom" name="tujuanRom"
                                    value="{{ old('tujuanRom') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group mt-2">
                                <label><i class="fas fa-globe"></i> Negara<span style="color:red;">*</span></label>
                                <select class="form-control select2bs4" name="negaraRom" id="negaraRom" style="width: 100%;"
                                    required>
                                    <option value="">SILA PILIH</option>
                                    @foreach ($negara as $jaw)
                                        <option value="{{ $jaw->namaNegara }}"
                                            {{ $jaw->namaNegara == old('negaraRom') ? 'selected' : '' }}>
                                            {{ $jaw->namaNegara }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                            <div class="form-group">
                                <div class="icheck-primary mb-2">
                                    <input class="form-check-input" OnChange="javascript:pilihNegaraLain();" type="checkbox"
                                        value="1" name="negaraRom_lebih" id="negaraRom_lebih"
                                        @checked(old('negaraRom_lebih') == '1')>
                                    <label class="form-check-label" for="negaraRom_lebih">
                                        Adakah rombongan lebih daripada 1 negera?
                                    </label>
                                </div>
                                <label><i class="fas fa-globe"></i> Negara Tambahan<span style="color:red;">*</span></label>
                                <select class="form-control select2bs4" name="negaraRom_tambahan[]" id="negaraRom_tambahan"
                                    style="width: 100%;" disabled multiple>
                                    <option value="">SILA PILIH</option>
                                    @foreach ($negara as $jaw)
                                        <option value="{{ $jaw->namaNegara }}"
                                            {{ $jaw->namaNegara == old('negaraRom_tambahan') ? 'selected' : '' }}>
                                            {{ $jaw->namaNegara }}</option>
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
                                        style="color:red;">*</span></label>
                                <select class="form-control" id="jenisKewanganRom" name="jenisKewanganRom" required>
                                    <option value="Kerajaan" {{ 'Kerajaan' == old('jenisKewangan') ? 'selected' : '' }}>
                                        Kerajaan</option>
                                    <option value="Federal" {{ 'Federal' == old('jenisKewangan') ? 'selected' : '' }}>
                                        Federal</option>
                                    <option value="Persendirian"
                                        {{ 'Persendirian' == old('jenisKewangan') ? 'selected' : '' }}>Persendirian
                                    </option>
                                    <option value="Jabatan" {{ 'Jabatan' == old('jenisKewangan') ? 'selected' : '' }}>
                                        Jabatan</option>
                                    <option value="Syarikat" {{ 'Syarikat' == old('jenisKewangan') ? 'selected' : '' }}>
                                        Syarikat</option>
                                    <option value="lain-lain" {{ 'lain-lain' == old('jenisKewangan') ? 'selected' : '' }}>
                                        lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-money-bill-alt"></i> Anggaran Belanja(RM)<span
                                        style="color:red;">*</span></label>
                                <input class="form-control " type="number" placeholder="0.00" required
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
                                    <textarea class="form-control" name="alamatRom" id="alamatRom" cols="170" required>{{ old('alamatRom') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label><i class="fa fa-file"> </i> Dokumen Sokongan</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="filesokonganRom[]"
                                    id="exampleInputFile" multiple>
                                <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                <small><i>*tertakluk kepada kelulusan dalaman bagi pejabat daerah atau perkara
                                        berkaitan.</i></small>
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
                                <label><i class="fa fa-file"> </i> Dokumen Rasmi<span style="color:red;">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileRasmiRom[]" id="filerasmi"
                                        multiple {{ 'Rasmi' == old('jenisRombongan') ? '' : 'disabled' }}>
                                    <label class="custom-file-label" for="filerasmi">Pilih Fail</label>
                                </div>
                                @if ($errors->has('fileRasmiRom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fileRasmiRom') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-{{ $tema }}">
                <div class="card-header">
                    <h3 class="card-title">Maklumat kelulusan cuti rehat(Sekiranya memerlukan kelulusan cuti rehat)</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Mula Cuti</label>
                                <input type="date" class="form-control" id="tarikhMulaCuti"
                                    name="tarikhMulaCuti" value="{{ old('tarikhMulaCuti') }}" onblur="myFunctionCuti()">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Akhir Cuti</label>
                                <input type="date" class="form-control" id="tarikhAkhirCuti"
                                    name="tarikhAkhirCuti" value="{{ old('tarikhAkhirCuti') }}" onblur="myFunctionKembali()">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Kembali Bertugas</label>
                                <input type="date" class="form-control" id="tarikhKembaliBertugas"
                                    name="tarikhKembaliBertugas" value="{{ old('tarikhKembaliBertugas') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-file"> </i> Dokumen Cuti</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileCuti[]" id="filcuti"
                                        multiple>
                                    <label class="custom-file-label" for="filcuti">Pilih Fail</label>
                                </div>
                            </div>
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
        <br>
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
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'd-m-yyyy'
            })
        })
    </script>

    <script>
        $('#jenisRombongan').change(function() {
            if ($(this).val() == 'Rasmi') {
                $('#tarikhMulaCuti').prop("disabled", true);
                $('#tarikhAkhirCuti').prop("disabled", true);
                $('#tarikhKembaliBertugas').prop("disabled", true);
                $('#filcuti').prop("disabled", true);
                $('#filerasmi').prop("disabled", false);
            } else if ($(this).val() == 'Tidak Rasmi') {
                $('#tarikhMulaCuti').prop("disabled", false);
                $('#tarikhAkhirCuti').prop("disabled", false);
                $('#tarikhKembaliBertugas').prop("disabled", false);
                $('#filcuti').prop("disabled", false);
                $('#filerasmi').prop("disabled", true);
            }
        });
    </script>

    <script type="text/javascript" language="javascript">
        function pilihNegaraLain() {
            if (document.getElementById("negaraRom_lebih").checked == true)
                document.getElementById("negaraRom_tambahan").disabled = false;
            else
                document.getElementById("negaraRom_tambahan").disabled = true;
        }
    </script>

    <script>
        function myFunction() {
            var minToDate = document.getElementById("tarikhMulaRom").value;
            document.getElementById("tarikhAkhirRom").setAttribute("min", minToDate);
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
