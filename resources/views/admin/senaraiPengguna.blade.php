@extends('layouts.eln')

@section('title', 'Senarai Pic Jabatan')

@section('link')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        .table tr td {
            vertical-align: middle;
            text-align: center;
        }

        .table tr th {
            vertical-align: middle;
            text-align: center;
        }
    </style>

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
                            <h3 class="card-title">Senarai Permohonan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm display">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama <br> (NO KP)</th>
                                                    <th>Jawatan</th>
                                                    <th>Jabatan</th>
                                                    <th>Email</th>
                                                    <th>Peranan</th>
                                                    <th>Jumlah
                                                        Permohonan<br>{{ now()->year }}</th>
                                                    <th>Keseluruhan<br> Permohonan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $index => $ss)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $ss->nama }} <br> ({{ $ss->nokp }})</td>
                                                        <td>{{ $ss->namaJawatan }}</td>
                                                        <td>{{ $ss->userJabatan->nama_jabatan }}
                                                            ({{ $ss->userJabatan->kod_jabatan }})
                                                        </td>
                                                        <td>{{ $ss->email }}</td>
                                                        <td>{{ $ss->role }}</td>
                                                        <td>{{ $ss->jumlah_permohonan_semasa }}</td>
                                                        <td>{{ $ss->jumlah_permohonan }}</td>
                                                        <td>
                                                            <a href="{{ url('kemaskini-pengguna', [$ss->usersID]) }}">
                                                                <button type="button"
                                                                    class="btn btn-primary btn-xs">Kemaskini</button>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-xs"
                                                                data-toggle="modal" data-target="#hantarPautanEmail-{{ $ss->usersID }}">Hantar
                                                                Pautan</button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="hantarPautanEmail-{{ $ss->usersID }}" tabindex="-1"
                                                                autanEmail role="dialog" aria-labelledby="modelTitleId"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content text-left">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Hantar Pautan Permohonan
                                                                                Kurang dari 14 Hari</h5>
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ url('hantar-pautan-permohonan') }}"
                                                                            method="post">
                                                                            {{ csrf_field() }}
                                                                            <div class="modal-body">
                                                                                <div class="container-fluid">
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" name="id"
                                                                                            id="id"
                                                                                            value="{{ $ss->usersID }}">
                                                                                        <input type="hidden" name="email"
                                                                                            id="email"
                                                                                            value="{{ $ss->email }}">
                                                                                        <label for="jenis_permohonan">Jenis
                                                                                            Permohonan</label>
                                                                                        <select class="form-control"
                                                                                            name="jenis_permohonan"
                                                                                            id="jenis_permohonan" required>
                                                                                            <option value="">Sila
                                                                                                Pilih
                                                                                            </option>
                                                                                            <option value="rasmi">Rasmi
                                                                                                (individu)</option>
                                                                                            <option value="tidakRasmi">Tidak
                                                                                                Rasmi (individu)</option>
                                                                                            <option value="rombongan">
                                                                                                Rombongan
                                                                                            </option>
                                                                                            <option value="sertairombongan">
                                                                                                Sertai Rombongan</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Hantar
                                                                                    Pautan</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <script>
                                                                $('#exampleModal').on('show.bs.modal', event => {
                                                                    var button = $(event.relatedTarget);
                                                                    var modal = $(this);
                                                                    // Use above variables to manipulate the DOM

                                                                });
                                                            </script>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
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
