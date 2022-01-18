@extends('layouts.eln', ['activePage' => 'senaraipendingrombongan'])

@section('title', 'Senarai Rombongan')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Senarai Rombongan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive ">
                                        <table class="table table-bordered table-sm display">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle">No</th>
                                                    <th style="vertical-align: middle">Negara</th>
                                                    <th style="vertical-align: middle">Code</th>
                                                    <th style="vertical-align: middle">Tarikh Mula Perjalanan</th>
                                                    <th style="vertical-align: middle">Tarikh Akhir Perjalanan</th>
                                                    <th style="vertical-align: middle">Tujuan Rombongan</th>
                                                    <th style="vertical-align: middle">Peserta</th>
                                                    <th style="vertical-align: middle">Status Permohonan</th>
                                                    {{-- <th style="vertical-align: middle">Tarikh Lulusan Permohonan</th> --}}
                                                    <th style="vertical-align: middle">Dokumen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rombongan as $index => $rombo)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <a
                                                                href="{{ url('detailPermohonanRombongan', [$rombo->rombongans_id]) }}">{{ $rombo->negaraRom }}</a>
                                                        </td>
                                                        <td>{{ $rombo->codeRom }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ $rombo->tujuanRom }}</td>
                                                        <td>
                                                            - {{ $rombo->nama }} <br>
                                                            @foreach ($allPermohonan as $element)
                                                                @if ($element->rombongans_id == $rombo->rombongans_id)
                                                                    - {{ $element->user->nama }} <br>

                                                                    @if ($rombo->statusPermohonanRom == 'Lulus Semakan')
                                                                        {{-- <a class="btn-warning btn-xs disabled"><i class="fa fa-times-circle"></i></a><br> --}}
                                                                        <br>
                                                                    @elseif($rombo->statusPermohonanRom == 'Pending')
                                                                        <a href="{{ url('tolak-permohonan', [$element->permohonansID]) }}"
                                                                            class="btn-danger btn-xs">
                                                                            <i class="fa  fa-times"></i>
                                                                        </a><br>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td><span
                                                                class="badge badge-info">{{ $rombo->statusPermohonanRom }}</span>
                                                        </td>
                                                        {{-- <td>{{\Carbon\Carbon::parse($rombo->tarikhLulusan)->format('d/m/Y')}}</td> --}}

                                                        <td>
                                                            @if ($rombo->statusPermohonanRom == 'Lulus Semakan')

                                                                <span class="badge badge-warning">Lulus Semakan</span>

                                                            @elseif($rombo->statusPermohonanRom == 'Pending')

                                                                <a href="senaraiPendingRombongan/{{ $rombo->rombongans_id }}/sent-Permohonan"
                                                                    class="btn btn-success btn-xs"
                                                                    onclick="javascript: return confirm('Adakah anda pasti untuk menghantar maklumat permohonan?');">
                                                                    <i class="fa fa-check-square"></i>
                                                                </a>

                                                                <a class="btn btn-danger btn-xs" data-toggle="modal"
                                                                    href='#mdl-tolak'
                                                                    data-id="{{ $rombo->rombongans_id }}">
                                                                    <i class="fa fa-times"></i>
                                                                </a>


                                                            @elseif($rombo->statusPermohonanRom == 'Diluluskan')

                                                                <span class="badge badge-success">Diluluskan</span>

                                                            @elseif($rombo->statusPermohonanRom ==
    "Permohonan
                                                                Diluluskan" or
    $rombo->statusPermohonanRom == 'Permohonan Ditolak' or
    $rombo->statusPermohonanRom == 'Lulus Semakan')

                                                                <span class="badge badge-primary">Tiada</span>

                                                            @endif
                                                        </td>


                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="modal fade" id="mdl-tolak">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Menolak Permohonan</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                </div>
                                                {!! Form::open(['method' => 'POST', 'url' => url('sebabRombongan')]) !!}
                                                <div class="modal-body">
                                                    <div
                                                        class="form-group{{ $errors->has('sebb') ? ' has-error' : '' }}">
                                                        {!! Form::label('sebb', 'Adakah anda pasti untuk menolak permohonan ini?') !!}
                                                        {{-- {!! Form::text('sebb', null, ['class' => 'form-control', 'required' => 'required']) !!} --}}
                                                        <small
                                                            class="text-danger">{{ $errors->first('sebb') }}</small>
                                                    </div>
                                                    <div
                                                        class="form-group{{ $errors->has('sebb') ? ' has-error' : '' }}">
                                                        {!! Form::label('sebb', 'Catatan') !!}
                                                        {!! Form::text('sebb', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                        <small
                                                            class="text-danger">{{ $errors->first('sebb') }}</small>
                                                    </div>

                                                    {!! Form::hidden('id_edit', 'value', ['id' => 'id']) !!}
                                                </div>
                                                <div class="modal-footer">
                                                    {{-- {{ Form::submit('Click Me!', ['class' => 'btn btn-danger']) }} --}}
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Tolak Permohonan</button>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        $('#mdl-tolak').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            var id = button.data('id');

            $(".modal-body #id").val(id);

        });

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
    </script>
@endsection
