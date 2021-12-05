@extends('layouts.eln')

@section('title', 'Kemaskini Permohonan Rombongan')

@section('link')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> --}}
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Maklumat permohonan perjalanan Keluar Negara</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ url('kemaskini-rombongan') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        @foreach ($rombongan as $rmbgn)
                            <input type="hidden" name="id" id="id" value="{{ $rmbgn->rombongans_id }}">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tarikh Terima Insuran</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" class="form-control pull-right" id="datepicker"
                                                name="tarikhInsuranRom" required="required"
                                                value="{{ $rmbgn->tarikhInsuranRom->format('d/m/Y') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tarikh Mula Rombongan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tarikhmula" id="datepicker1"
                                                    value="{{ $rmbgn->tarikhMulaRom->format('d/m/Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tarikh Akhir Rombongan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tarikhakhir"
                                                    id="datepicker2"
                                                    value="{{ $rmbgn->tarikhAkhirRom->format('d/m/Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tujuan Permohonan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="tujuanRom" id="tujuanRom"
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $rmbgn->tujuanRom }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Negara</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <select style="width: 100%;" id="negaraRom" class="form-control select2"
                                                name="negaraRom" required="required">
                                                <option value="" selected="selected"></option>
                                                @foreach ($negara as $jaw)
                                                    <option value="{{ $jaw->namaNegara }}"
                                                        {{ $jaw->namaNegara == $rmbgn->negaraRom ? 'selected' : '' }}>
                                                        {{ $jaw->namaNegara }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sumber Kewangan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            {!! Form::select('jenisKewanganRom', ['' => 'Sila pilih', 'Kerajaan' => 'Kerajaan', 'Federal' => 'Federal', 'Persendirian' => 'Persendirian', 'Jabatan' => 'Jabatan', 'Syarikat' => 'Syarikat', 'lain-lain' => 'lain-lain'], $rmbgn->jenisKewanganRom, ['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Anggaran Belanja(RM)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="anggaranBelanja"
                                                    id="anggaranBelanja" placeholder=""
                                                    value="{{ $rmbgn->anggaranBelanja }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Alamat Rombongan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-o"></i>
                                            </div>
                                            <textarea class="form-control" name="alamatRom" id="alamatRom"
                                                cols="170">{{ $rmbgn->alamatRom }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dokumen Rasmi</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="file" class="form-control" name="fileRasmiRom[]" multiple>
                                        </div>
                                        @if ($dokumen->isEmpty())
                                            Tiada Dokumen.
                                        @else
                                            @foreach ($dokumen as $doku)
                                                <a class="btn btn-sm btn-info"
                                                    href="{{ route('detailPermohonanDokumen.download', ['id' => $doku->dokumens_id]) }}">{{ $doku->namaFile }}</a><a
                                                    href="{{ route('detailPermohonan.deleteFileRasmi', ['id' => $doku->dokumens_id]) }}"
                                                    onclick="javascript: return confirm('Padam dokumen ini?');"><i
                                                        class="fa fa-remove"></i></a>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="form-group">
                                        <div class="btn-group pull-center">
                                            <a class="btn btn-warning"
                                                href="{{ url('senaraiPermohonanRombongan', [Auth::user()->usersID]) }}"
                                                role="button">Kembali</a>
                                            {!! Form::submit('kemaskini', ['class' => 'btn btn-primary']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    {{-- <script src="{{ asset('adminlte/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"> --}}
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
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

        });

        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd/mm/yy'
            });

            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd/mm/yy'
            });

            $("#datepicker2").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd/mm/yy'
            });
        });
    </script>

@endsection
