@extends('layouts.eln')

@section('title', 'eluarNegara')

@section('link')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Butiran Permohonan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ url('senaraiPermohonanProses', [Auth::user()->usersID]) }}">Senarai
                                Permohonan</a></li>
                        <li class="breadcrumb-item active">Butiran Permohonan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Rombongan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><i class="fab fa-codepen"></i> Kod Rombongan</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $rombongan->codeRom }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><i class="fas fa-question-circle"></i> Status</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $rombongan->statusPermohonanRom }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for=""><i class="fas fa-globe"></i> Negara</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $rombongan->negaraRom }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for=""><i class="fas fa-map-marker-alt"></i> Alamat</label>
                                        <textarea class="form-control" disabled
                                            rows="3">{{ $rombongan->alamatRom }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tujuanRom"><i class="fas fa-keyboard"></i> Tujuan Rombongan</label>
                                        <input type="text" class="form-control" name="tujuanRom" id="tujuanRom" disabled
                                            value="{{ $rombongan->tujuanRom }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tujuanRom"><i class="fas fa-money-bill"></i> Jenis Kewangan Rombongan</label>
                                        <input type="text" class="form-control" name="tujuanRom" id="tujuanRom" disabled
                                            value="{{ $rombongan->jenisKewanganRom }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tujuanRom"><i class="fas fa-money-bill"></i> Anggaran Perbelanjaan</label>
                                        <input type="text" class="form-control" name="tujuanRom" id="tujuanRom" disabled
                                            value="{{ $rombongan->anggaranBelanja }}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mula"><i class="fa fa-calendar"></i> Mula Rombongan</label>
                                        <input id="mula" type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($rombongan->tarikhMulaRom)->format('d/m/Y') }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="akhir"><i class="fa fa-calendar"></i> Tamat Rombongan</label>
                                        <input id="akhir" type="text" class="form-control"
                                            value="{{ \Carbon\Carbon::parse($rombongan->tarikhAkhirRom)->format('d/m/Y') }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah"><i class="fa fa-calendar"></i> Tempoh Rombongan</label>
                                        <input id="jumlah" type="text" class="form-control"
                                            value="{{ $jumlahDate }} Hari" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <strong><i class="fa fa-user-friends"></i> Senarai Peserta</strong>
                            <p class="text-muted">
                                @foreach ($peserta as $peser)
                                    <a data-toggle="modal" href='#mdl-kemaskini' data-nama="{{ $peser->user->nama }}"
                                        data-nokp="{{ $peser->user->nokp }}" data-email="{{ $peser->user->email }}"
                                        data-jawatan="{{ $peser->user->jawatan }}"
                                        data-jabatan="{{ $peser->user->jabatan }}">{{ $peser->user->nama }}</a>
                                    <br>
                                @endforeach
                            </p>
                            <hr>
                            <strong><i class="fa fa-file"></i> Dokumen Rasmi</strong>
                            <p class="text-muted">
                                @if (is_null($dokumen))
                                    Tiada Dokumen
                                @else
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('detailPermohonanDokumen.download', ['id' => $dokumen->dokumens_id]) }}">{{ $dokumen->namaFile }}</a>
                                @endif
                            </p>
                            <hr>
                            <p class="text-center">
                                <a class="btn btn-primary"
                                    href="{{ URL::previous() }}"
                                    role="button">Kembali</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="mdl-kemaskini">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Maklumat Pemohon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                 {!! Form::open(['method' => 'POST', 'url' => '#']) !!}
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('nama_edit') ? ' has-error' : '' }}">
                        {!! Form::label('nama_edit', 'Nama') !!}
                        {!! Form::text('nama_edit', null, ['class' => 'form-control', 'disabled' => 'disabled','id'=>'nama_edit']) !!}
                        <small class="text-danger">{{ $errors->first('nama_edit') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('nokp_edit') ? ' has-error' : '' }}">
                        {!! Form::label('nokp_edit', 'Kad Pengenalan') !!}
                        {!! Form::text('nokp_edit', null, ['class' => 'form-control', 'disabled' => 'disabled','id'=>'nokp_edit']) !!}
                        <small class="text-danger">{{ $errors->first('nokp_edit') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('email_edit') ? ' has-error' : '' }}">
                        {!! Form::label('email_edit', 'Email') !!}
                        {!! Form::email('email_edit', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        <small class="text-danger">{{ $errors->first('email_edit') }}</small>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    {{-- <button type="submit" class="btn btn-primary">Kemaskini</button> --}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')

      <script>
          $('#mdl-kemaskini').on('show.bs.modal',function (event){

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
      </script>

@endsection