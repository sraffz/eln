@extends('layouts.eln')

@section('title', 'Senarai Permohonan')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        table th {
            font-size: 15px;
            font-weight: bold;
        }

        table td {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    @include('flash::message')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="box-title">Senarai Permohonan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Halaman Utama</a></li>
                        <li class="breadcrumb-item active">Senarai Permohonan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Rombongan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped display">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align: middle">No</th>
                                            <th style="vertical-align: middle">Negara & Kod Rombongan</th>
                                            {{-- <th style="vertical-align: middle">Code</th> --}}
                                            <th style="vertical-align: middle">Tarikh Mula Perjalanan</th>
                                            <th style="vertical-align: middle">Tarikh Akhir Perjalanan</th>
                                            <th style="vertical-align: middle">Tujuan Rombongan</th>
                                            <th style="vertical-align: middle">Peserta</th>
                                            <th style="vertical-align: middle">Status Permohonan</th>
                                            <th style="vertical-align: middle">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rombongan as $index => $rombo)
                                            <tr>
                                                <td>
                                                    {{ $index + 1 }}
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ url('detailPermohonanRombongan', [$rombo->rombongans_id]) }}">{{ $rombo->negaraRom }}</a>
                                                    <br>
                                                    ({{ $rombo->codeRom }})
                                                </td>
                                                {{-- <td>{{ $rombo->codeRom }}</td> --}}
                                                <td>{{ \Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $rombo->tujuanRom }}</td>
                                                <td>
                                                    @foreach ($allPermohonan as $element)
                                                        @if ($element->rombongans_id == $rombo->rombongans_id)
                                                            {{-- {{ $element->user->nama }} --}}
                                                            @if ($element->statusPermohonan == 'Permohonan Berjaya')

                                                                <span
                                                                    class="badge badge-success">{{ $element->user->nama }}</span><br>

                                                            @elseif($element->statusPermohonan == "Permohonan Gagal")

                                                                <span
                                                                    class="badge badge-danger">{{ $element->user->nama }}</span><br>

                                                            @elseif($element->statusPermohonan == "Pending")

                                                                {{ $element->user->nama }}<br>

                                                            @elseif($element->statusPermohonan == "Tindakan BPSM" &&
                                                                $rombo->statusPermohonanRom == "simpanan")

                                                                {{ $element->user->nama }}<a
                                                                    href="{{ url('padam-permohonan', [$element->permohonansID]) }}"
                                                                    class="btn-danger btn-xs"
                                                                    onclick="javascript: return confirm('Padam maklumat ini?');"><i
                                                                        class="fa  fa-remove"></i></a><br>

                                                            @elseif($element->statusPermohonan == "Tindakan BPSM" &&
                                                                $rombo->statusPermohonanRom == "Pending")

                                                                {{ $element->user->nama }}<br>

                                                            @elseif($element->statusPermohonan == "Tindakan BPSM" &&
                                                                $rombo->statusPermohonanRom == "Lulus Semakan")

                                                                {{ $element->user->nama }}<br>

                                                            @else
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="width: 10%">{{ $rombo->statusPermohonanRom }}</td>
                                                <td>
                                                    @if ($rombo->statusPermohonanRom == 'Pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($rombo->statusPermohonanRom == "simpanan")
                                                        <a href='{{ url("senaraiPermohonan/{$rombo->rombongans_id}/hantarRombongan") }}'
                                                            class="btn btn-success btn-xs"
                                                            onclick="javascript: return confirm('Adakah anda pasti untuk menghantar maklumat permohonan?');"><i
                                                                class="fas fa-paper-plane"></i></a>
                                                        <a href="{{ url('kemaskini-rombongan', [$rombo->rombongans_id]) }}"
                                                            class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                        <a href='{{ url('padam-rombongan', [$rombo->rombongans_id]) }}'
                                                            class="btn btn-danger btn-xs"
                                                            onclick="javascript: return confirm('Padam maklumat ini?');"><i
                                                                class="fa fa-user-times"></i></a>
                                                    @elseif($rombo->statusPermohonanRom == "Permohonan Berjaya")
                                                        <span class="badge badge-success">Berjaya</span>
                                                    @elseif($rombo->statusPermohonanRom == "Permohonan Gagal")
                                                        <span class="badge badge-danger">Gagal</span>
                                                    @elseif($rombo->statusPermohonanRom == "Permohonan Berjaya" or
                                                        $rombo->statusPermohonanRom == "Permohonan Gagal" or
                                                        $rombo->statusPermohonanRom == "Lulus Semakan")
                                                        <span class="badge badge-primary">Tiada</span>
                                                    @endif
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>
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
