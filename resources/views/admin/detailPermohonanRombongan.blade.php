@extends('layouts.starter')

@section('title', 'eluarNegara')

@section('link')

@endsection

@section('content')


<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat Rombongan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Negara</strong>

              <p class="text-muted">
                {{ $rombongan->negaraRom }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Kod Rombongan</strong>

              <p class="text-muted">
                {{ $rombongan->codeRom }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Alamat</strong>

              <p class="text-muted">
                {{ $rombongan->alamatRom }}
              </p>

              <hr>

             
              <strong><i class="fa fa-map-marker margin-r-5"></i>Tarikh Perjalanan </strong>
                <table border="0" class="table table-responsive">
                  <tr bgcolor="#94ccc7">
                      <th>Mula</th>
                      <th>Akhir</th>
                      <th>Jumlah</th>
                  </tr>
                  <tr>
                      <th>{{\Carbon\Carbon::parse($rombongan->tarikhMulaRom)->format('d/m/Y')}} </th>
                      <th>{{\Carbon\Carbon::parse($rombongan->tarikhAkhirRom)->format('d/m/Y')}}</th>
                      <th>{{$jumlahDate}} Hari</th>
                  </tr>
                </table>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Tujuan</strong>

              <p class="text-muted">
                {{ $rombongan->tujuanRom }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Jenis Kewangan Rombongan</strong>

              <p class="text-muted">
                {{ $rombongan->jenisKewanganRom }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Anggaran Perbelanjaan</strong>

              <p class="text-muted">
                RM{{ $rombongan->anggaranBelanja }}
              </p>

              <hr>
              
              <strong><i class="fa fa-book margin-r-5"></i>Status</strong>

              <p class="text-muted">
                {{ $rombongan->statusPermohonanRom }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Senarai Peserta</strong>

              <p class="text-muted">
                @foreach ($peserta as $peser)
                    <a data-toggle="modal" href='#mdl-kemaskini' data-nama="{{ $peser->user->nama }}" data-nokp="{{ $peser->user->nokp }}" data-email="{{ $peser->user->email }}" data-jawatan="{{ $peser->user->jawatan }}" data-jabatan="{{ $peser->user->jabatan }}">{{ $peser->user->nama }}</a>
                      <br>
                    
                  @endforeach
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Dokumen Rasmi</strong>

              <p class="text-muted">
                <?php
                if ( is_null($dokumen))
                    {
                        echo "Tiada Dokumen";
                    }
                    else
                    { ?>
                        <a class="btn btn-sm btn-info" href="{{ route('detailPermohonanDokumen.download', ['id' => $dokumen->dokumens_id]) }}">{{ $dokumen->namaFile }}</a>
            <?php } ?>
                
              </p>

              <hr>

                <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>
            <!-- /.box-body -->
          </div>

          {{-- mula modal --}}
          <div class="modal fade" id="mdl-kemaskini">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Maklumat Pemohon</h4>
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

            {{-- tamat modal --}}
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