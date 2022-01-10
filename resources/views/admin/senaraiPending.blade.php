@extends('layouts.eln', ['activePage' => 'senaraipending'])

@section('title', 'Senarai Keputusan')

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
    @include('flash::message')
    <section class="content">
        <div class="container-fluid">
            @php
                $url = url()->current();
                // echo $url;
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header with-border">
                            @if ($url != url('senaraiRekodIndividu'))
                                <h3 class="card-title">Senarai Permohonan Individu<br><small>Tidak termasuk individu yg
                                        mengikut
                                        rombongan</small> </h3>
                            @else
                                <h3 class="card-title">Rekod Permohonan</h3>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <table class="table table-responsive table-bordered table-sm display">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle">No</th>
                                                    <th style="vertical-align: middle">Nama</th>
                                                    <th style="vertical-align: middle">Jabatan</th>
                                                    <th style="vertical-align: middle">Tarikh Permohonan</th>
                                                    <th style="vertical-align: middle">Negara</th>
                                                    <th style="vertical-align: middle">Tarikh Mula Perjalanan</th>
                                                    <th style="vertical-align: middle">Jenis Permohonan</th>
                                                    <th style="vertical-align: middle">No Rujukan</th>
                                                    <th style="vertical-align: middle">Status Permohonan</th>
                                                    @if ($url != url('senaraiRekodIndividu'))
                                                        <th style="vertical-align: middle">Tindakan</th>
                                                    @else
                                                        <th style="vertical-align: middle">Dokumen(Cetak)</th>
                                                    @endif
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($permohonan as $index => $mohonan)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            {{-- <a class="btn btn-primary btn-xs" href="#" role="button" id="luluspermohonan">SweetAlert</a> --}}
                                                            <a
                                                                href="{{ url('detailPermohonan', [$mohonan->permohonansID]) }}">{{ $mohonan->user->nama }}</a>
                                                        </td>
                                                        <td>{{ $mohonan->user->userJabatan->kod_jabatan }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($mohonan->user->created_at)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ $mohonan->negara }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}
                                                        </td>
                                                        {{-- <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td> --}}
                                                        <td>{{ $mohonan->JenisPermohonan }}</td>
                                                        <td>SUK.D.200 (06) 455/16
                                                            ELN.JLD.{{ $mohonan->no_ruj_file }}({{ $mohonan->no_ruj_bil }})
                                                        </td>
                                                        <td>
                                                            @if ($mohonan->statusPermohonan == 'Permohonan Berjaya')
                                                                <span
                                                                    class="badge badge-success">{{ $mohonan->statusPermohonan }}</span>
                                                        </td>

                                                        @if ($mohonan->JenisPermohonan == 'Rasmi')
                                                            <td>
                                                                <a href="{{ route('suratLulusRasmi', ['id' => $mohonan->permohonansID]) }}"
                                                                    class="btn btn-primary btn-xs"
                                                                    onclick="javascript: return confirm('Adakah anda pasti untuk mencetak surat ini?');">Surat
                                                                    Kelulusan</a>
                                                                <a href="{{ route('memoLulusRasmi', ['id' => $mohonan->permohonansID]) }}"
                                                                    class="btn btn-primary btn-xs"
                                                                    onclick="javascript: return confirm('Adakah anda pasti untuk mencetak memo ini?');">Memo
                                                                    Kelulusan</a>
                                                            </td>

                                                        @elseif($mohonan->JenisPermohonan == 'Tidak Rasmi')
                                                            <td>
                                                                <a href="{{ route('suratLulusTidakRasmi', ['id' => $mohonan->permohonansID]) }}"
                                                                    class="btn btn-primary btn-xs"
                                                                    onclick="javascript: return confirm('Adakah anda pasti untuk mencetak surat ini?');">Surat
                                                                    Kelulusan</a>
                                                                <a href="{{ route('memoTidakRasmi', ['id' => $mohonan->permohonansID]) }}"
                                                                    class="btn btn-primary btn-xs"
                                                                    onclick="javascript: return confirm('Adakah anda pasti untuk mencetak memo ini?');">Memo
                                                                    Kelulusan</a>
                                                            </td>
                                                        @endif
                                                    @elseif($mohonan->statusPermohonan == 'Permohonan Gagal')
                                                        <span
                                                            class="badge badge-danger">{{ $mohonan->statusPermohonan }}</span>
                                                        </td>
                                                        <td>

                                                        </td>
                                                    @elseif ($mohonan->statusPermohonan == 'Lulus Semakan BPSM')
                                                        <span class="badge badge-info">Disokong</span></td>
                                                @endif

                                                @if ($url != url('senaraiRekodIndividu'))
                                                    <td>
                                                        @if ($mohonan->statusPermohonan == 'Lulus Semakkan ketua Jabatan')

                                                            <a href="{{ route('senaraiPending.hantar', ['id' => $mohonan->permohonansID]) }}"
                                                                class="btn btn-success btn-xs"
                                                                onclick="javascript: return confirm('Anda pasti untuk meluluskan Semakan permohonan ini?');"><i
                                                                    class="fa fa-check-square-o"> Terima</i></a>

                                                            <a class="btn btn-danger btn-xs" data-toggle="modal"
                                                                href='#mdl-tolak' data-id="{{ $mohonan->permohonansID }}"
                                                                onclick="javascript: return confirm('Anda pasti untuk kembalikan semula permohonan ini?');"><i
                                                                    class="fa fa-times">Tolak</i></a>

                                                            {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                                        class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mengemaskini maklumat ini?');"><i class="fa fa-print">Cetak</i></a> --}}

                                                        @elseif($mohonan->statusPermohonan == 'Lulus Semakan BPSM')

                                                            {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                                        class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mencetak maklumat ini?');"><i class="fa fa-print">Cetak</i></a> --}}

                                                        @endif
                                                    </td>
                                                @else

                                                @endif

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
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

        <div class="modal fade" id="mdl-tolak">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Sebab Ditolak</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'url' => '/sebab']) !!}
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('sebb') ? ' has-error' : '' }}">
                            {!! Form::label('sebb', 'Sebab') !!}
                            {!! Form::text('sebb', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('sebb') }}</small>
                        </div>
                        {!! Form::hidden('id_edit', 'value', ['id' => 'id_edit']) !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Hantar</button>
                    </div>
                    {!! Form::close() !!}
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
