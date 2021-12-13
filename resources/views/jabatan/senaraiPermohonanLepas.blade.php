@extends('layouts.eln')

@section('title', 'Senarai Permohonan')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    @include('flash::message')
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Senarai Permohonan </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped display2">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">No</th>
                                                    <th style="vertical-align: middle;">Nama</th>
                                                    <th style="vertical-align: middle;">Tarikh Permohonan</th>
                                                    <th style="vertical-align: middle;">Negara</th>
                                                    <th style="vertical-align: middle;">Tarikh Mula Perjalanan</th>
                                                    <th style="vertical-align: middle;">Jenis Permohonan</th>
                                                    <th style="vertical-align: middle;">Status Permohonan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($permohonan as $index => $mohonan)
                                                    <tr class="text-center">
                                                        <td> {{ $index + 1 }} </td>
                                                        <td>
                                                            <a href="detailPermohonan/{{ $mohonan->permohonansID }}">{{ $mohonan->user->nama }}</a>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($mohonan->user->created_at)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ $mohonan->negara }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}
                                                        </td>
                                                        {{-- <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td> --}}
                                                        <td>{{ $mohonan->JenisPermohonan }}</td>
                                                        <td>
                                                            @if ($mohonan->statusPermohonan == 'Lulus Semakkan ketua Jabatan')
                                                                <span class="label label-warning">Dalam Tindakkan
                                                                    BPSM</span>
                                                            @elseif($mohonan->statusPermohonan == 'Ketua Jabatan')
                                                                <span class="label label-warning">Dalam Tindakkan Ketua
                                                                    Jabatan</span>
                                                            @elseif($mohonan->statusPermohonan == 'Lulus Semakan BPSM')
                                                                <span class="label label-primary">Lulus Semakan BPSM</span>
                                                            @elseif($mohonan->statusPermohonan == 'Permohonan Berjaya')
                                                                <span class="label label-success">Permohonan Berjaya</span>
                                                            @else
                                                                {{ $mohonan->statusPermohonan }}
                                                            @endif
                                                        </td>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
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


    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="favoritesModalLabel">Ulasan</h4>
                </div>

                <div class="modal-body">
                    <form action="senaraiPermohonanJabatan/hantar">
                        <div class="modal-body">Sila masukkan ulasan.<br>
                            <textarea name="ulasan" required="required" class="form-control"></textarea>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="get">
                            <input name="kopeID" id="kopeID" type="hidden" value="">
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Hantar" />
                            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            $('table.display2').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 30, 50, 100],
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
