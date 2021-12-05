@extends('layouts.eln')

@section('title', 'E-Luar Negara')

@section('link')

@endsection

@section('content')

{{-- start detail permohonan --}}
        <div class="col-md-6">
  <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat Pendaftar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Negara</strong>

              <p class="text-muted">
                {{ $permohonan->negara }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>alamat</strong>

              <p class="text-muted">
                {{ $permohonan->alamat }}
              </p>

              <hr>
              <strong><i class="fa fa-book margin-r-5"></i>Jenis Permohonan</strong>

              <p class="text-muted">
                {{ $permohonan->JenisPermohonan }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Tujuan</strong>

              <p class="text-muted">
                {{ $permohonan->lainTujuan }}
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
                      <th>{{\Carbon\Carbon::parse($permohonan->tarikhMulaPerjalanan)->format('d/m/Y')}} </th>
                      <th>{{\Carbon\Carbon::parse($permohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</th>
                      <th>{{$jumlahDate}} Hari</th>
                  </tr>
                </table>
              

             
              <?php
                $type=$permohonan->JenisPermohonan;
                if($type=='Tidak Rasmi')
                {
                ?>
                 <hr>
                  <strong><i class="fa fa-map-marker margin-r-5"></i>Tarikh Cuti </strong>
                <table border="0" class="table table-responsive">
                  <tr bgcolor="#94ccc7">
                      <th>Mula</th>
                      <th>Akhir</th>
                      <th>Kembali bertugas</th>
                      <th>Jumlah Cuti</th>
                  </tr>
                  <tr>
                      <th>{{\Carbon\Carbon::parse($permohonan->tarikhMulaCuti)->format('d/m/Y')}} </th>
                      <th>{{\Carbon\Carbon::parse($permohonan->tarikhAkhirCuti)->format('d/m/Y')}}</th>
                      <th>{{\Carbon\Carbon::parse($permohonan->tarikhKembaliBertugas)->format('d/m/Y')}}</th>
                      <th>{{$jumlahDateCuti}} Hari</th>
                  </tr>
                </table>
            <?php } ?>
               
              

              <?php
                $type=$permohonan->JenisPermohonan;
                

                if ($type=='Rasmi')
                { ?>
                  <hr>
                  <strong><i class="fa fa-book margin-r-5"></i>Dokumen Rasmi</strong>

                  <p class="text-muted">
                    <?php
                    if($dokumen->isEmpty())
                        {
                            echo "Tiada Dokumen";
                        }
                        else
                        { 
                          ?>
                          @foreach($dokumen as $doku)
                              <a class="btn btn-sm btn-info" href="{{ route('detailPermohonanDokumen.download', ['id' => $doku->dokumens_id]) }}">{{ $doku->namaFile }}</a>
                          @endforeach
                           
                <?php } ?>
                
                 </p>
        <?php  } 
              elseif ($type=='Tidak Rasmi')
              {
                  ?>
             
              
               <hr>
              <strong><i class="fa fa-book margin-r-5"></i>Dokumen Cuti</strong>

              <p class="text-muted">
                <?php
                if ( $permohonan->namaFileCuti == "")
                    {
                        echo "Tiada Dokumen";
                    }
                    else
                    { ?>
                        <a class="btn btn-sm btn-info" href="{{ route('detailPermohonan.download', ['id' => $permohonan->permohonansID]) }}">{{ $permohonan->namaFileCuti }}</a>
            <?php } ?>
                
              </p>
          <?php } ?>
              <hr>

                <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary">Kembali</a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>


{{-- start detail permohonan --}}
<div class="col-md-6">
  <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat Permohonan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Nama</strong>

              <p class="text-muted">
                {{ $permohonan->user->nama }}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Kad Pengenalan</strong>

              <p class="text-muted">
                {{ $permohonan->user->nokp }}
              </p>

              <hr>

             <strong><i class="fa fa-book margin-r-5"></i>Email</strong>

              <p class="text-muted">
                {{ $permohonan->user->email  }}
              </p>
              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Jawatan</strong>

              <p class="text-muted">
                {{ $permohonan->user->userJawatan->namaJawatan }}
              </p>

              <hr>
              
                
              <strong><i class="fa fa-book margin-r-5"></i>Jabatan</strong>

              <p class="text-muted">
                {{ $permohonan->user->userJabatan->nama_jabatan }}
              </p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

 
@endsection
