@extends('layouts.eln')

@section('title', 'Kemaskini')

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
    @include('flash::message')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Maklumat permohonan perjalanan Keluar Negara</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                        {!! Form::model($permohonan, ['method' => 'POST', 'url' => ['updatePermohonan', $permohonan->permohonansID], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                        {!! Form::hidden('id', $permohonan->permohonansID) !!}

                        <div class="panel box box-success">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        .::Maklumat permohonan perjalanan Keluar Negara::.
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="box-body">


                                    <table class="table table-responsive">
                                        <tr>
                                            <td>
                                                <label>Tarikh Terima Insuran</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    @php
                                                        $da = date('d-m-Y', strtotime($permohonan->tarikhInsuran));
                                                    @endphp
                                                    <input type="text" class="form-control pull-right" id="datepicker"
                                                        name="tarikh" value="{{ $da }}">
                                                </div>
                                            </td>
                                            <td><label>Tarikh Mula Perjalanan</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    @php
                                                        $mula = date('d-m-Y', strtotime($permohonan->tarikhMulaPerjalanan));
                                                    @endphp
                                                    <input type="text" class="form-control pull-right" id="datepicker3"
                                                        name="tarikhMulaPerjalanan" value="{{ $mula }}">
                                                </div>
                                            </td>
                                            <td><label>Tarikh Akhir Perjalanan</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    @php
                                                        $akhir = date('d-m-Y', strtotime($permohonan->tarikhAkhirPerjalanan));
                                                    @endphp
                                                    <input type="text" class="form-control pull-right" id="datepicker4"
                                                        name="tarikhAkhirPerjalanan" value="{{ $akhir }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Negara</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <select style="width: 100%;" id="negara" class="form-control select2"
                                                        name="negara">
                                                        <option value="" selected="selected"></option>
                                                        @foreach ($negara as $jaw)
                                                            @if ($permohonan->negara == $jaw->namaNegara)
                                                                <option value="{{ $jaw->namaNegara }}"
                                                                    selected="selected">{{ $jaw->namaNegara }}</option>
                                                            @else
                                                                <option value="{{ $jaw->namaNegara }}">
                                                                    {{ $jaw->namaNegara }}</option>
                                                                {{ $jaw->namaNegara }}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>{{-- {{$k->anugerah}} --}}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($typeForm == 'rasmi')

                                                    <label>Tujuan Permohonan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" name="tujuan" class="form-control"
                                                            value="{{ $permohonan->lainTujuan }}">
                                                    </div>

                                                @elseif($typeForm =="tidakRasmi")

                                                    <label>Tujuan Permohonan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" id="tujuan" name="tujuan" class="form-control"
                                                            value="{{ $permohonan->lainTujuan }}">
                                                    </div>

                                                @endif
                                            </td>
                                            <td>
                                                <label>Alamat semasa Bercuti</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="alamat" class="form-control"
                                                        value="{{ $permohonan->alamat }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>No. Telefon</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="{{ $permohonan->telefonPemohon }}">
                                                </div>
                                            </td>
                                            <td>
                                                @if ($typeForm == 'rasmi')

                                                    <label>Jenis Kewangan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        {!! Form::select('jenisKewangan', ['' => 'Sila pilih', 'Kerajaan' => 'Kerajaan', 'Federal' => 'Federal', 'Persendirian' => 'Persendirian', 'Jabatan' => 'Jabatan', 'Syarikat' => 'Syarikat', 'lain-lain' => 'lain-lain'], $permohonan->jenisKewangan, ['class' => 'form-control', 'required']) !!}
                                                    </div>
                                            </td>
                                            <td>
                                                <label>Dokumen Rasmi</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>

                                                    <?php
                                                      if($dokumen->isEmpty())
                                                      {  ?>
                                                      <label for="nama" class="label-danger">Tiada Dokumen</label>
                                                      <?php     }
                                                      else
                                                      { 
                                                        ?>
                                                    @foreach ($dokumen as $doku)
                                                        <a class="btn btn-sm btn-info"
                                                            href="{{ route('detailPermohonanDokumen.download', ['id' => $doku->dokumens_id]) }}">{{ $doku->namaFile }}</a><a
                                                            href="{{ route('detailPermohonan.deleteFileRasmi', ['id' => $doku->dokumens_id]) }}"><i
                                                                class="fa fa-remove"></i></a>
                                                    @endforeach

                                                    <?php } ?>
                                                    {{-- @if (is_null($permohonan->namaFileCuti))
                                  <label class="label label-warning">NO File</label>
                                @else
                                <a class="btn btn-sm btn-info" href="{{ route('detailPermohonan.download', ['id' => $permohonan->permohonansID]) }}">{{ $permohonan->namaFileCuti }}</a>
                                @endif --}}


                                                    <input type="file" class="form-control" name="fileRasmi[]" multiple />
                                                </div>
                                            @elseif($typeForm =="tidakRasmi")

                                                <input type="hidden" name="jenisKewangan" value="Persendirian">

                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel box box-success">
                            <div class="box-header with-border">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        .:::Maklumat Pasangan / Keluarga / Saudara Pegawai Keluar negara:::.
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <table class="table table-responsive">
                                        <tr>
                                            <td>
                                                <label>Nama Pasangan</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="namaPasangan" class="form-control"
                                                        value="{{ $permohonan->pasanganPermohonan->namaPasangan }}">
                                                </div>
                                            </td>
                                            <td>
                                                <label>No. Telefon Pasangan</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="phonePasangan" class="form-control"
                                                        value="{{ $permohonan->pasanganPermohonan->phonePasangan }}">
                                                </div>
                                            </td>
                                            <td>
                                                <label>E-mel Pasangan</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="email" name="emailPasangan" class="form-control"
                                                        value="{{ $permohonan->pasanganPermohonan->emailPasangan }}">
                                                </div>
                                            </td>
                                            <td>
                                                <label>Hubungan</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="hubungan" class="form-control"
                                                        value="{{ $permohonan->pasanganPermohonan->hubungan }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <label>Alamat Pasangan</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <textarea class="form-control" name="alamatPasangan"
                                                        id="alamatPasangan"
                                                        cols="170">{{ $permohonan->pasanganPermohonan->alamatPasangan }}</textarea>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>


                        @if ($typeForm == 'tidakRasmi')
                            <div class="panel box box-success">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                            .:::Maklumat kelulusan cuti rehat(Sekiranya memerlukan kelulusan cuti rehat):::.
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseFour" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <table class="table table-responsive">
                                            <tr>
                                                <td><label>Tarikh Mula Cuti</label>

                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        @php
                                                            $mula = date('d-m-Y', strtotime($permohonan->tarikhMulaCuti));
                                                        @endphp
                                                        <input type="text" class="form-control pull-right" id="datepicker5"
                                                            name="tarikhMulaCuti" value="{{ $mula }}">
                                                    </div>
                                                </td>
                                                <td><label>Tarikh Akhir Cuti</label>

                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        @php
                                                            $akhir = date('d-m-Y', strtotime($permohonan->tarikhAkhirCuti));
                                                        @endphp
                                                        <input type="text" class="form-control pull-right" id="datepicker6"
                                                            name="tarikhAkhirCuti" value="{{ $akhir }}">
                                                    </div>
                                                </td>
                                                <td><label>Tarikh Kembali Bertugas</label>

                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        @php
                                                            $kembali = date('d-m-Y', strtotime($permohonan->tarikhKembaliBertugas));
                                                        @endphp
                                                        <input type="text" class="form-control pull-right" id="datepicker7"
                                                            name="tarikhKembaliBertugas" value="{{ $kembali }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label>Dokumen Cuti</label>
                                                    <div class="input-group">
                                                        @if (is_null($permohonan->namaFileCuti))
                                                            <label class="label label-warning">NO File</label>
                                                        @else
                                                            <a class="btn btn-sm btn-info"
                                                                href="{{ route('detailPermohonan.download', ['id' => $permohonan->permohonansID]) }}">{{ $permohonan->namaFileCuti }}</a><a
                                                                href="{{ route('detailPermohonan.deleteFileCuti', ['id' => $permohonan->permohonansID]) }}"><i
                                                                    class="fa fa-remove"></i></a>
                                                        @endif


                                                        <input type="file" class="form-control" name="fileCuti[]"
                                                            multiple />
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        @endif

                        @if ($typeForm == 'rasmi')
                            <input type="hidden" name="jenisPermohonan" value="Rasmi">
                        @elseif($typeForm =="tidakRasmi")
                            <input type="hidden" name="jenisPermohonan" value="Tidak Rasmi">
                        @endif
                        <input type="hidden" name="pasanganID" value="{{ $permohonan->pasanganPermohonan->pasangansID }}">

                        <div class="btn-group pull-left">
                            {{-- {!! Form::reset("Semula", ['class' => 'btn btn-warning']) !!} --}}
                            {!! Form::submit('Hantar', ['class' => 'btn btn-primary']) !!}
                        </div>


                        {!! Form::close() !!}
                        <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>


                    </div>
                </div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
    </div>
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
            $('#datepicker3').datepicker({
                autoclose: true
            })
            $('#datepicker4').datepicker({
                autoclose: true
            })
            $('#datepicker5').datepicker({
                autoclose: true
            })
            $('#datepicker6').datepicker({
                autoclose: true
            })
            $('#datepicker7').datepicker({
                autoclose: true
            })
        })
    </script>

@endsection
