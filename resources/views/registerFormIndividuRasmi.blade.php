@extends('layouts.eln')

@section('title', 'Permohonan Individu')

@section('link')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($typeForm == 'rasmi')
                        <h3 class="box-title">Borang Pemohonan Rasmi</h3>
                    @elseif($typeForm =="tidakRasmi")
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
        </div><!-- /.container-fluid -->
    </section>
    @include('flash::message')
    {!! Form::model($userDetail, ['method' => 'POST', 'url' => ['daftarPermohonan', $userDetail->usersID], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}

    {!! Form::hidden('id', $userDetail->usersID) !!}
    <section class="content">
        <div class="container-fluid">
            <!-- general form elements disabled -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Maklumat Permohonan Perjalanan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tarikh Terima Insuran</label>
                                {{-- <input type="text" class="form-control" id="datepicker" name="tarikh"> --}}
                                <input type="date" class="form-control" name="tarikh">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fas fa-calendar"></i> Tempoh lawatan<span
                                        style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="reservation" name="tempohPerjalanan" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><i class="fas fa-globe"></i> Negara<span style="color:red;">*</span></label>
                                <select class="form-control select2bs4" name="negara" style="width: 100%;"
                                    required>
                                    @foreach ($negara as $jaw)
                                        <option value="{{ $jaw->namaNegara }}">{{ $jaw->namaNegara }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            @if ($typeForm == 'rasmi')
                                <div class="form-group">
                                    <label><i class="fa fa-edit"> </i> Tujuan Permohonan<span
                                            style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="tujuan" required>
                                </div>
                            @elseif($typeForm =="tidakRasmi")
                                <div class="form-group">
                                    <label><i class="fa fa-edit"> </i> Tujuan Permohonan<span
                                            style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="tujuan" required>
                                </div>
                            @endif
                            <!-- text input -->
                        </div>
                        <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-edit"> </i> Alamat semasa bertugas / bercuti <span
                                        style="color:red;">*</span></label>
                                <input type="text" name="alamat" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><i class="fa fa-phone"> </i> No. Telefon<span style="color:red;">*</span></label>
                                <input type="text" name="phone" class="form-control" data-inputmask='"mask": "(99) 99-99999999"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if ($typeForm == 'rasmi')
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="fas fa-money-bill-alt"></i> Jenis Kewangan<span
                                            style="color:red;">*</span></label>
                                    <select class="form-control" id="jenisKewangan" name="jenisKewangan"
                                        required="required">
                                        <option value="Kerajaan">Kerajaan</option>
                                        <option value="Federal">Federal</option>
                                        <option value="Persendirian">Persendirian</option>
                                        <option value="Jabatan">Jabatan</option>
                                        <option value="Syarikat">Syarikat</option>
                                        <option value="lain-lain">lain-lain</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label><i class="fa fa-file"> </i> Dokumen Rasmi<span style="color:red;">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileRasmi[]" id="exampleInputFile" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                </div>
                            </div>
                        @elseif($typeForm =="tidakRasmi")
                            <input type="hidden" name="jenisKewangan" value="Persendirian">
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
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
                                <input type="text" name="namaPasangan" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-user-friends"></i> Hubungan</label>
                                <input type="text" name="hubungan" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-phone"></i> No Tel Pasangan</label>
                                <input type="text" name="phonePasangan" class="form-control" data-inputmask='"mask": "(99) 99-99999999"' data-mask>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label><i class="fa fa-envelope"></i> Email Pasangan (Jika Ada)</label>
                                <input type="email" name="emailPasangan" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label><i class="fa fa-edit"></i> Alamat Pasangan</label>
                                <textarea class="form-control" name="alamatPasangan" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->
            </div>
            @if ($typeForm == 'tidakRasmi')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Maklumat Kelulusan Cuti rehat (Jika Perlu)</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label><i class="fas fa-calendar"></i> Tempoh Cuti</label>
                                    <input type="text" class="form-control" id="reservation2" name="tempohCuti">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label><i class="fas fa-calendar"></i> Tarikh Kembali Bertugas</label>
                                    <input type="date" class="form-control" name="tarikhKembaliBertugas">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label><i class="fa fa-file"> </i> Dokumen Cuti</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="fileCuti[]" id="exampleInputFile" multiple>
                                        <label class="custom-file-label" for="exampleInputFile">Pilih Fail</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Perakuan Permohonan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- checkbox -->
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tick" id="tick" value="yes"
                                        required>
                                    <label class="form-check-label">Segala keterangan adalah benar dan mematuhi
                                        peraturan.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            @if ($typeForm == 'rasmi')
                                <input type="hidden" name="jenisPermohonan" value="Rasmi">
                            @elseif($typeForm =="tidakRasmi")
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
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker()
            $('#reservation2').daterangepicker()
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
            $('#datepicker2').datepicker({
                autoclose: true
            })
        })
    </script>

@endsection
