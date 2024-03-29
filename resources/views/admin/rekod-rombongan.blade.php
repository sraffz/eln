@extends('layouts.eln', ['activePage' => 'senaraipendingrombongan'])

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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Senarai Rombongan</h3>
                            <div class="float-right">
                                {{-- <a class="btn btn-dark btn-sm" href="{{ url('cetak-senarai-rombongan') }}"
                                    role="button">Cetak</a> --}}
                            </div>
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
                                                    <th style="vertical-align: middle">Negara & Kod Rombongan</th>
                                                    <th style="vertical-align: middle">Tarikh Permohonan</th>
                                                    <th style="vertical-align: middle">Tarikh Mula Perjalanan</th>
                                                    {{-- <th style="vertical-align: middle">Tarikh Akhir Perjalanan</th> --}}
                                                    <th style="vertical-align: middle">Tarikh Lulusan Permohonan</th>
                                                    <th style="vertical-align: middle">Tujuan Rombongan</th>
                                                    <th style="vertical-align: middle">Peserta</th>
                                                    <th style="vertical-align: middle">Status Permohonan</th>
                                                    <th style="vertical-align: middle">Dokumen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rombongan as $index => $rombo)
                                                    <tr class="text-center">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <a
                                                                href="{{ url('detailPermohonanRombongan', [$rombo->rombongans_id]) }}">
                                                                {{ $rombo->negaraRom }}@if ($rombo->negaraRom_lebih == 1)
                                                                    {{ ', ' . $rombo->negaraRom_tambahan }}
                                                                @endif </a> <br>
                                                            {{ $rombo->codeRom }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($rombo->tarikhMohon)->format('d/m/Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y') }}
                                                        </td>
                                                        {{-- <td>{{ \Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y') }}
                                                        </td> --}}
                                                        <td>
                                                            @if ($rombo->tarikhStatusPermohonan == null)
                                                            @else
                                                                {{ \Carbon\Carbon::parse($rombo->tarikhStatusPermohonan)->format('d/m/Y') }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $rombo->tujuanRom }}</td>
                                                        <td>
                                                            {{-- - {{ $rombo->nama }} <br> --}}
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach ($allPermohonan as $element)
                                                                @if ($element->rombongans_id == $rombo->rombongans_id)
                                                                    {{-- - {{ $element->user->nama }} <br> --}}
                                                                    @if ($rombo->status_kelulusan == 'Berjaya')
                                                                        @if ($element->status_kelulusan == 'Berjaya')
                                                                            <button type="button" data-toggle="modal"
                                                                                href='#detail-{{ $element->permohonansID }}'
                                                                                data-nama="{{ $element->nama }}"
                                                                                data-nokp="{{ $element->nokp }}"
                                                                                {{-- data-email="{{ $element->email }}" --}}
                                                                                data-jawatan="{{ $element->jawatan_pemohon }}"
                                                                                data-jabatan="{{ $element->jabatan_pemohon }}"
                                                                                class="btn btn-success btn-block btn-xs">
                                                                                {{ $element->nama }}
                                                                                @if ($element->ketua_rombongan == $element->id_pemohon)
                                                                                    <span
                                                                                        class="badge badge-pill badge-dark">Ketua</span>
                                                                                @endif
                                                                            </button>
                                                                            <div class="mt-2"></div>
                                                                        @elseif($element->status_kelulusan == 'Gagal')
                                                                            <button type="button" data-toggle="modal"
                                                                                href='#detail-{{ $element->permohonansID }}'
                                                                                data-nama="{{ $element->nama }}"
                                                                                data-nokp="{{ $element->nokp }}"
                                                                                {{-- data-email="{{ $element->email }}" --}}
                                                                                data-jawatan="{{ $element->jawatan_pemohon }}"
                                                                                data-jabatan="{{ $element->jabatan_pemohon }}"
                                                                                class="btn btn-danger btn-block btn-xs">
                                                                                {{ $element->nama }}
                                                                                @if ($element->ketua_rombongan == $element->id_pemohon)
                                                                                    <span
                                                                                        class="badge badge-pill badge-dark">Ketua</span>
                                                                                @endif
                                                                            </button>
                                                                            <div class="mt-2"></div>
                                                                        @endif
                                                                    @elseif($rombo->status_kelulusan == 'Gagal')
                                                                        @if ($element->status_kelulusan == 'Berjaya')
                                                                            <button type="button" data-toggle="modal"
                                                                                href='#detail-{{ $element->permohonansID }}'
                                                                                data-nama="{{ $element->nama }}"
                                                                                data-nokp="{{ $element->nokp }}"
                                                                                {{-- data-email="{{ $element->email }}" --}}
                                                                                data-jawatan="{{ $element->jawatan_pemohon }}"
                                                                                data-jabatan="{{ $element->jabatan_pemohon }}"
                                                                                class="btn btn-success btn-block btn-xs">
                                                                                {{ $element->nama }}
                                                                                @if ($element->ketua_rombongan == $element->id_pemohon)
                                                                                    <span
                                                                                        class="badge badge-pill badge-dark">Ketua</span>
                                                                                @endif
                                                                            </button>
                                                                            <div class="mt-2"></div>
                                                                        @elseif($element->status_kelulusan == 'Gagal')
                                                                            <button type="button" data-toggle="modal"
                                                                                href='#detail-{{ $element->permohonansID }}'
                                                                                data-nama="{{ $element->nama }}"
                                                                                data-nokp="{{ $element->nokp }}"
                                                                                {{-- data-email="{{ $element->email }}" --}}
                                                                                data-jawatan="{{ $element->jawatan_pemohon }}"
                                                                                data-jabatan="{{ $element->jabatan_pemohon }}"
                                                                                class="btn btn-danger btn-block btn-xs">
                                                                                {{ $element->nama }}
                                                                                @if ($element->ketua_rombongan == $element->id_pemohon)
                                                                                    <span
                                                                                        class="badge badge-pill badge-dark">Ketua</span>
                                                                                @endif
                                                                            </button>
                                                                            <div class="mt-2"></div>
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
                                                                                        <label
                                                                                            for="jabatan">Jabatan</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
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
                                                                                    <button type="button"
                                                                                        class="btn btn-info"
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
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @if ($rombo->status_kelulusan == 'Berjaya')
                                                                <span type="button"
                                                                    data-id="{{ $rombo->rombongans_id }}"
                                                                    data-toggle="modal" data-target="#ubahstatusrombongan"
                                                                    class="badge badge-success">
                                                                    {{ $rombo->status_kelulusan }}
                                                                </span>
                                                            @elseif ($rombo->status_kelulusan == 'Gagal')
                                                                <span type="button"
                                                                    data-id="{{ $rombo->rombongans_id }}"
                                                                    data-toggle="modal" data-target="#ubahstatusrombongan"
                                                                    class="badge badge-danger">
                                                                    {{ $rombo->status_kelulusan }}
                                                                </span>
                                                                <!-- Button trigger modal -->
                                                                <span type="button" class="badge badge-info" data-toggle="modal" data-target="#catatan-{{ $rombo->rombongans_id }}">
                                                                  Ulasan / Catatan
                                                                </span>
                                                                
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="catatan-{{ $rombo->rombongans_id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Catatan</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                            </div>
                                                                            <div class="modal-body text-left">
                                                                                <div class="form-group">
                                                                                    <label for="catatan">Ulasan / Catatan</label>
                                                                                    <textarea type="text"
                                                                                      class="form-control" name="catatan" id="catatan" aria-describedby="helpId" disabled placeholder="">{{ $rombo->ulasan_kelulusan }}</textarea>
                                                                                    <small id="helpId" class="form-text text-muted">Catatan atau sebab permohonan ditolak.</small>
                                                                                  </div>  
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary">Save</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            @else
                                                                <span
                                                                    class="badge badge-info">{{ $rombo->statusPermohonanRom }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($rombo->statusPermohonanRom == 'Lulus Semakan')
                                                                <span class="badge badge-warning">Lulus Semakan</span>
                                                            @elseif($rombo->statusPermohonanRom == 'Permohonan Berjaya' || $rombo->statusPermohonanRom == 'Permohonan Gagal')
                                                                @php
                                                                    if ($rombo->jld_surat_rombongan > 1) {
                                                                        $jld = 'Jld. ' . $rombo->jld_surat_rombongan;
                                                                    } else {
                                                                        $jld = '';
                                                                    }
                                                                @endphp
                                                                <small class="text-bold">SUK.D.200 (06) 455/16-4
                                                                    {{ $jld }}
                                                                    ({{ $rombo->no_surat_rombongan }})</small> <br>
                                                                @if ($rombo->surat == 'MEMO')
                                                                    <a href="{{ route('memo-rombongan', ['id' => $rombo->rombongans_id]) }}"
                                                                        class="btn btn-primary btn-xs" target="_blank">
                                                                        Memo
                                                                    </a>
                                                                @elseif ($rombo->surat == 'SURAT')
                                                                    <a href="{{ route('surat-rombongan', ['id' => $rombo->rombongans_id]) }}"
                                                                        class="btn btn-primary btn-xs" target="_blank">
                                                                        Surat
                                                                    </a>
                                                                @endif
                                                            @elseif($rombo->statusPermohonanRom == 'Pending')
                                                                <a href="{{ route('sokong-permohonan-rombongan', [$rombo->rombongans_id]) }}"
                                                                    class="btn btn-success btn-xs"
                                                                    onclick="javascript: return confirm('Adakah anda pasti untuk menghantar maklumat permohonan?');">
                                                                    <i class="fa fa-check-square"></i>
                                                                </a>

                                                                <a class="btn btn-danger btn-xs" data-toggle="modal"
                                                                    href='#mdl-tolak'
                                                                    data-id="{{ $rombo->rombongans_id }}">
                                                                    <i class="fa fa-times"></i>
                                                                </a>

                                                                <a href="{{ route('cetak-butiran-rombongan', [$rombo->rombongans_id]) }}"
                                                                    class="btn btn-dark btn-xs">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif($rombo->statusPermohonanRom == 'Diluluskan')
                                                                <span class="badge badge-success">Diluluskan</span>
                                                            @elseif(
                                                                $rombo->statusPermohonanRom == 'Permohonan Diluluskan' or
                                                                    $rombo->statusPermohonanRom == 'Permohonan Ditolak' or
                                                                    $rombo->statusPermohonanRom == 'Lulus Semakan')
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
            </div>
        </div>


        <!-- Modal Tukar Ketua permohonan-->
        <div class="modal fade" id="tukarkr" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tolak Permohonan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="GET" action="{{ url('tukar-ketua-rombongan') }}" id="ajax-contact-form"
                        name="ajax-contact-form">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="text-center">
                                    Lantik peserta ini sebagai ketua rombongan?
                                </div>
                                <input name="id" id="id" type="hidden" value="">
                                <input name="romboid" id="romboid" type="hidden" value="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" id="submit" class="btn btn-success tukar_button">Lantik Ketua
                                Rombongan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tukar Kelulusan-->
        <div class="modal fade" id="ubahstatuskelulusan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tukar Status Kelulusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('tukarstatuskelulusan') }}" method="GET" id="ajax_tukar_status"
                        name="ajax_tukar_status">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="container-fluid">
                                <input type="hidden" value="" name="id" id="id">
                                Adakah pasti untuk menukar status permohonan peserta ini?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kemaskini</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tukar Kelulusan Rombongan-->
        @if (Auth::user()->role == 'DatoSUK')
            <div class="modal fade" id="ubahstatusrombongan" tabindex="-1" role="dialog"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tukar Status Kelulusan Rombongan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('ubahstatusrombongan') }}" method="GET" id="ajax_tukar_status"
                            name="ajax_tukar_status">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <input type="hidden" name="id" id="id" value="">
                                    Adakah pasti untuk menukar status permohonan rombongan ini?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kemaskini</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
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

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).on('click', '.tukar_button', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#submit').html('Sila Tunggu...');
            $("#submit").attr("disabled", true);
            $.ajax({
                url: "{{ url('tukar-ketua-rombongan') }}",
                type: "PUT",
                data: $('#ajax-contact-form').serialize(),
                dataType: 'json',
                success: function(response) {
                    $('#submit').html('Berjaya Ditukar');
                    $("#submit").attr("disabled", false);
                    setTimeout(location.reload.bind(location), 1000);
                    // Swal.fire( 'Berjaya', 'Ketua Rombongan telah ditukar!', 'success');
                }
            });
        });

        $('#mdl-tolak').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            var id = button.data('id');

            $(".modal-body #id").val(id);

        });

        $('#ubahstatuskelulusan').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            // Use above variables to manipulate the DOM
            $(".modal-body #id").val(id);
        });

        $('#ubahstatusrombongan').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            // Use above variables to manipulate the DOM
            $(".modal-body #id").val(id);
        });

        $('#tukarkr').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            var id = button.data('id');
            var romboid = button.data('romboid');
            // Use above variables to manipulate the DOM
            $(".modal-body #id").val(id);
            $(".modal-body #romboid").val(romboid);
        });

        $('#detail-').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget);
            var nama = button.data('nama');
            var nokp = button.data('nokp');
            var email = button.data('email');
            var jawatan = button.data('jawatan');
            var jabatan = button.data('jabatan');

            $('#nama_edit').val(nama);
            $('#nokp_edit').val(nokp);
            $('#email_edit').val(email);
            $('#jawatan_edit').val(jawatan);
            $('#jabatan_edit').val(jabatan);
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
