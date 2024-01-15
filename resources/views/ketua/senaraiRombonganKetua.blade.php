@extends('layouts.eln')

@section('title', 'Senarai Rombongan')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Senarai Permohonan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Senarai Permohonan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Senarai Rombongan</h3>
                            <div class="float-right">
                                <a class="btn btn-dark btn-sm" href="{{ url('cetak-senarai-rombongan') }}"
                                    role="button">Cetak</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-bordered table-striped display">
                                        <thead>
                                            <tr>
                                                <th>Bil</th>
                                                <th>Negara</th>
                                                <th>Code</th>
                                                <th>Tarikh Mula Perjalanan</th>
                                                <th>Tarikh Akhir Perjalanan</th>
                                                <th>Tujuan Rombongan</th>
                                                <th>Peserta</th>
                                                {{-- <th>Status Permohonan</th> --}}
                                                {{-- <th>Tarikh Lulusan Permohonan</th> --}}
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php

                                                $i = 1;
                                            @endphp
                                            @foreach ($rombongan as $index => $rombo)
                                                @php
                                                    $first_datetime = new DateTime($rombo->tarikhMulaRom);
                                                    $last_datetime = new DateTime(now());
                                                    $interval = $first_datetime->diff($last_datetime);
                                                    $final_days = $interval->format('%a'); //and then print do whatever you like with $final_days
                                                    $id = $rombo->rombongans_id;
                                                    // $id = Hashids::encode($id);

                                                    if ($first_datetime >= $last_datetime) {
                                                        if ($final_days < 3) {
                                                            $theme = 'danger';
                                                        } elseif ($final_days < 7) {
                                                            $theme = 'warning';
                                                        } else {
                                                            $theme = 'dark';
                                                        }
                                                    } else {
                                                        $theme = 'danger';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{-- <a href="{{ url('detailPermohonan', [$mohonan->permohonansID]) }}"><span class="badge badge-{{ $theme }}">{{ $mohonan->nama }}</span></a> --}}
                                                        <a href="{{ url('detailPermohonanRombongan', [$id]) }}">
                                                            <span
                                                                class="badge badge-{{ $theme }}">{{ $rombo->negaraRom }}
                                                                @if ($rombo->negaraRom_lebih == 1)
                                                                    {{ ', ' . $rombo->negaraRom_tambahan }}
                                                                @endif
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td>{{ $rombo->codeRom }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ $rombo->tujuanRom }}</td>
                                                    <td>
                                                        {{-- {{ $rombo->nama }} <br> --}}
                                                        @foreach ($allPermohonan as $element)
                                                            @if ($element->rombongans_id == $rombo->rombongans_id)
                                                                <button data-toggle="modal"
                                                                    href='#detail-{{ $element->permohonansID }}'
                                                                    data-nama="{{ $element->user->nama }}"
                                                                    data-nokp="{{ $element->nokp }}"
                                                                    data-jawatan="{{ $element->jawatan_pemohon }}"
                                                                    data-jabatan="{{ $element->jabatan_pemohon }}"
                                                                    class="btn btn-success btn-block btn-xs">
                                                                    {{ $element->user->nama }}
                                                                </button>

                                                                @if ($rombo->statusPermohonanRom == 'Permohonan Berjaya')
                                                                    {{-- <a class="btn-warning btn-xs disabled"><i class="fa fa-times-circle"></i></a><br> --}}
                                                                    <br>
                                                                @elseif($rombo->statusPermohonanRom == 'Lulus Semakan')
                                                                    <a href="{{ url('tolak-permohonan', [$element->permohonansID]) }}"
                                                                        class="btn-danger btn-xs"
                                                                        onclick="javascript: return confirm('Tolak Permohonan?');"><i
                                                                            class="fa  fa-times"></i></a><br>
                                                                @endif
                                                            @endif
                                                            <!--- Modal Detail -->
                                                            <div class="modal fade"
                                                                id="detail-{{ $element->permohonansID }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"> Maklumat
                                                                                Peserta</h4>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        {!! Form::open(['method' => 'POST', 'url' => '#']) !!}
                                                                        <div class="modal-body">
                                                                            <div
                                                                                class="form-group{{ $errors->has('nama_edit') ? ' has-error' : '' }}">
                                                                                {!! Form::label('nama_edit', 'Nama') !!}
                                                                                {!! Form::text('nama_edit', $element->nama, [
                                                                                    'class' => 'form-control',
                                                                                    'disabled' => 'disabled',
                                                                                    'id' => 'nama_edit',
                                                                                ]) !!}
                                                                                <small
                                                                                    class="text-danger">{{ $errors->first('nama_edit') }}</small>
                                                                            </div>
                                                                            <div
                                                                                class="form-group{{ $errors->has('nokp_edit') ? ' has-error' : '' }}">
                                                                                {!! Form::label('nokp_edit', 'Kad Pengenalan') !!}
                                                                                {!! Form::text('nokp_edit', $element->nokp, [
                                                                                    'class' => 'form-control',
                                                                                    'disabled' => 'disabled',
                                                                                    'id' => 'nokp_edit',
                                                                                ]) !!}
                                                                                <small
                                                                                    class="text-danger">{{ $errors->first('nokp_edit') }}</small>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="jabatan">Jabatan</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="jabatan" disabled
                                                                                    id="jabatan_edit"
                                                                                    value="{{ $element->jabatan_pemohon }}"
                                                                                    placeholder="">
                                                                            </div>
                                                                            <div
                                                                                class="form-group{{ $errors->has('jawatan_edit') ? ' has-error' : '' }}">
                                                                                {!! Form::label('jawatan_edit', 'Jawatan') !!}
                                                                                {!! Form::email('jawatan_edit', $element->jawatan_pemohon, [
                                                                                    'class' => 'form-control',
                                                                                    'disabled' => 'disabled',
                                                                                ]) !!}
                                                                                <small
                                                                                    class="text-danger">{{ $errors->first('jawatan_edit') }}</small>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-info"
                                                                                data-dismiss="modal">Batal</button>
                                                                            @if (Auth::user()->role == 'DatoSUK')
                                                                                @if ($element->status_kelulusan == 'Gagal')
                                                                                @elseif($element->ketua_rombongan == $element->id_pemohon)
                                                                                @else
                                                                                    <button type="button"
                                                                                        class="btn btn-primary"
                                                                                        data-toggle="modal"
                                                                                        data-romboid="{{ $element->rombongans_id }}"
                                                                                        data-id="{{ $element->id_pemohon }}"
                                                                                        data-target="#tukarkr"
                                                                                        data-dismiss="modal">
                                                                                        Jadikan Ketua Rombongan
                                                                                    </button>
                                                                                @endif

                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-id="{{ $element->id_kelulusan }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#ubahstatuskelulusan"
                                                                                    data-dismiss="modal">
                                                                                    Tukar Status Kelulusan
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    {{-- <td>{{ $rombo->statusPermohonanRom }}</td> --}}
                                                    {{-- <td>{{\Carbon\Carbon::parse($rombo->tarikhLulusan)->format('d/m/Y')}}</td> --}}
                                                    <td>
                                                        @if ($rombo->statusPermohonanRom == 'Permohonan Berjaya')
                                                            <span class="label label-success">Berjaya</span>
                                                        @elseif($rombo->statusPermohonanRom == 'Lulus Semakan')
                                                            <a href="{{ url('luluskan-rombongan', [$rombo->rombongans_id]) }}"
                                                                class="btn btn-success btn-xs"
                                                                onclick="javascript: return confirm('Adakah anda pasti untuk menluluskan permohonan ini?');"><i
                                                                    class="fa fa-thumbs-up"></i></a>

                                                            {{-- <a href="{{ url('tolak-rombongan', [$rombo->rombongans_id]) }}"
                                                                class="btn btn-danger btn-xs"
                                                                onclick="javascript: return confirm('Anda pasti untuk menolak permohonan ini?');"><i
                                                                    class="fa fa-thumbs-down"></i></a> --}}

                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                data-toggle="modal"
                                                                data-target="#tolakRombongan-{{ $rombo->rombongans_id }}">
                                                                <i class="fa fa-thumbs-down"></i>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"
                                                                id="tolakRombongan-{{ $rombo->rombongans_id }}"
                                                                tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Tolak Permohonan ini?
                                                                            </h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ url('tolak-rombongan', [$rombo->rombongans_id]) }}"
                                                                            method="post">
                                                                            {{ csrf_field() }}
                                                                            <div class="modal-body">
                                                                                <div class="container-fluid">
                                                                                    <div class="form-group">
                                                                                        <label for="catatan">Ulasan /
                                                                                            Catatan</label>
                                                                                        <textarea type="text" class="form-control" name="catatan" id="catatan" aria-describedby="helpId"
                                                                                            placeholder=""></textarea>
                                                                                        <small id="helpId"
                                                                                            class="form-text text-muted">Catatan
                                                                                            atau sebab permohonan
                                                                                            ditolak.</small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Tolak
                                                                                    Permohonan</button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                            <a href="{{ route('cetak-butiran-rombongan', [$rombo->rombongans_id]) }}"
                                                                class="btn btn-dark btn-xs">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                        @elseif($rombo->statusPermohonanRom == 'Permohonan Diluluskan')
                                                            <span class="label label-success">Diluluskan</span>
                                                        @elseif(
                                                            $rombo->statusPermohonanRom == 'Permohonan Diluluskan' or
                                                                $rombo->statusPermohonanRom == 'Permohonan Ditolak' or
                                                                $rombo->statusPermohonanRom == 'Lulus Semakan')
                                                            <span class="label label-primary">Tiada</span>
                                                        @endif
                                                    </td>
                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./box-body -->

                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte-3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte-3/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 15, 20],
                "language": {
                    "emptyTable": "Tiada data",
                    "lengthMenu": "_MENU_ Rekod setiap halaman",
                    "zeroRecords": "Tiada padanan rekod yang dijumpai.",
                    "info": "Paparan dari _START_ hingga _END_ dari _TOTAL_ rekod",
                    "infoEmpty": "Paparan 0 hingga 0 dari 0 rekod",
                    "infoFiltered": "(Ditapis dari jumlah _MAX_ rekod)",
                    "search": "Carian:",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "Sebelum",
                        "sNext": "Seterusnya",
                        "sLast": "Akhir"
                    }
                },
            });
        });

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
