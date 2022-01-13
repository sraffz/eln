@extends('layouts.eln')

@section('title', 'Senarai Permohonan baru')

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
                            <h3 class="card-title">Senarai Permohonan Baru (Individu){{-- <br><small>Tidak termasuk individu yg mengikut rombongan</small> --}} </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped display2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            {{-- <th>Jabatan</th> --}}
                                            <th>Tarikh Permohonan</th>
                                            <th>Negara</th>
                                            <th>Tarikh Mula Perjalanan</th>
                                            {{-- <th>Tarikh Akhir Perjalanan</th> --}}
                                            <th>Jenis Permohonan</th>
                                            <th>Status Permohonan</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permohonan as $index => $mohonan)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td style="text-transform: capitalize">
                                                    @if ($mohonan->JenisPermohonan == "rombongan")
                                                    <a href="{{ url('detailPermohonanRombongan', [$mohonan->rombongans_id]) }}">{{ $mohonan->user->nama }}</a>
                                                        
                                                    @else
                                                    <a href="{{ url('detailPermohonan', [$mohonan->permohonansID]) }}">{{ $mohonan->user->nama }}</a>
                                                        
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $mohonan->user->jabatan }}</td> --}}
                                                <td>{{ \Carbon\Carbon::parse($mohonan->user->tpermohonan)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $mohonan->negara }}</td>
                                                <td>{{ \Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}
                                                </td>
                                                {{-- <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td> --}}
                                                <td style="text-transform: capitalize">{{ $mohonan->JenisPermohonan }}</td>
                                                <td>{{ $mohonan->statusPermohonan }}</td>
                                                <td>
                                                    @if ($mohonan->statusPermohonan == 'Ketua Jabatan')
                                                        <a onClick="setUserData({{ $mohonan->permohonansID }});"
                                                            data-toggle="modal" data-target="#favoritesModal"
                                                            class="btn btn-success btn-xs"><i
                                                                class="fa fa-thumbs-up"></i></a>

                                                        <a href="{{ route('senaraiPermohonan.tolakPermohonan', ['id' => $mohonan->permohonansID]) }}"
                                                            class="btn btn-danger btn-xs"
                                                            onclick="javascript: return confirm('Anda pasti untuk menolak permohonan ini?');"><i
                                                                class="fa fa-thumbs-down"></i>
                                                        </a>
                                                    @elseif($mohonan->statusPermohonan == "Permohonan Berjaya")
                                                        {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                                                                        class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk cetak?');"><i class="fa fa-print"></i>
                                                                    </a> --}}
                                                    @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                                                        {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                                                            class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk cetak?');"><i class="fa fa-print"></i>
                                                        </a> --}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="modal fade" id="mdl-kemaskini">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Sebab Ditolak</h4>
                                            </div>
                                            {!! Form::open(['method' => 'POST', 'url' => '/sebab']) !!}
                                            <div class="modal-body">
                                                <div class="form-group{{ $errors->has('sebb') ? ' has-error' : '' }}">
                                                    {!! Form::label('sebb', 'Sebab') !!}
                                                    {!! Form::text('sebb', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                    <small class="text-danger">{{ $errors->first('sebb') }}</small>
                                                </div>
                                                
                                                {!! Form::hidden('id_edit', 'value',['id'=>'id_edit']) !!}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Hantar</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div> --}}
                            <!-- /.chart-responsive -->
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- ./card-body -->
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>

            
            <!-- /.col -->
        </div>
    </section>
    <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="favoritesModalLabel">Catatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form method="GET" action="{{ url('senaraiPermohonanJabatan/hantar') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="ulasan">Catatan (Jika perlu).</label>
                            <textarea name="ulasan" required="required" class="form-control"></textarea>
                            <input name="kopeID" id="kopeID" type="hidden" value="">
                        </div>
                        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> --}}
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Hantar" />
                    </div>
                </form>
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
                "pageLength": 5,
                "lengthMenu": [5, 10, 30, 50],
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

    <script language="javascript">
        function setUserData(id) {
            var userHidden = document.getElementById('kopeID');
            userHidden.value = id;
        }
    </script>
@endsection
