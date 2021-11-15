@extends('layouts.starter')

@section('title', 'Senarai Keputusan')

@section('link')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- DataTables -->
<script src="{{ asset('public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

@endsection

@section('content')
@include('flash::message')
@php
  $url=url()->current();
  // echo $url;
@endphp
<div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @if ($url != "http://aplikasi1.kelantan.gov.my/eln/senaraiRekodIndividu")
              <h3 class="box-title">Senarai Permohonan <br><small>Tidak termasuk individu yg mengikut rombongan</small> </h3>
              @else
              <h3 class="box-title">Rekod Permohonan</h3>
              @endif
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
             
                  <table id="example1" class="table table-bordered table-striped">
                  
                <thead>
                <tr bgcolor="#7abcb9">
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Tarikh Permohonan</th>
                  <th>Negara</th>
                  <th>Tarikh Mula Perjalanan</th>
                  {{-- <th>Tarikh Akhir Perjalanan</th> --}}
                  <th>Jenis Permohonan</th>
                  <th>No Rujukan</th>
                  <th>Status Permohonan</th>
                  
                  @if ($url != "http://aplikasi1.kelantan.gov.my/eln/senaraiRekodIndividu")
                  <th>Tindakan</th>
                  @else
                  <th>Dokumen(Cetak)</th>
                  @endif
                </tr>
                </thead>
                
                <tbody>
                  <?php $i=1; ?>
               @foreach($permohonan as $mohonan)
                <tr>
                  <td><?php echo $i; $i=$i+1; ?></td>
                  <td><a href="detailPermohonan/{{ $mohonan->permohonansID }}">{{ $mohonan->user->nama }}</a></td>
                  <td>{{ $mohonan->user->userJabatan->kod_jabatan }}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->user->created_at)->format('d/m/Y')}}</td>
                  <td>{{ $mohonan->negara }}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  {{-- <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td> --}}
                  <td>{{ $mohonan->JenisPermohonan }}</td>
                  <td>SUK.D.200 (06) 455/16 ELN.JLD.{{ $mohonan->no_ruj_file }} ({{ $mohonan->no_ruj_bil }})</td>
                  <td>
                    @if ($mohonan->statusPermohonan == "Permohonan Berjaya")
                      <span class="label label-success">{{ $mohonan->statusPermohonan }}</span></td>

                        @if ($mohonan->JenisPermohonan == "Rasmi")
                          <td>
                            <a href="{{route('suratLulusRasmi',['id' => $mohonan->permohonansID]) }}" class="btn btn-primary btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mencetak surat ini?');">Surat Kelulusan</a>
                            <a href="{{route('memoLulusRasmi',['id' => $mohonan->permohonansID]) }}" class="btn btn-primary btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mencetak memo ini?');">Memo Kelulusan</a></td>

                        @elseif($mohonan->JenisPermohonan == "Tidak Rasmi")
                          <td>
                            <a href="{{route('suratLulusTidakRasmi',['id' => $mohonan->permohonansID]) }}" class="btn btn-primary btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mencetak surat ini?');">Surat Kelulusan</a>
                            <a href="{{route('memoTidakRasmi',['id' => $mohonan->permohonansID]) }}" class="btn btn-primary btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mencetak memo ini?');">Memo Kelulusan</a></td>
                        @endif
                      
                    

                    @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                      <span class="label label-danger">{{ $mohonan->statusPermohonan }}</span></td>
                    @else
                      <span class="label label-info">{{ $mohonan->statusPermohonan }}</span></td>
                    @endif

                    @if ($url != "http://aplikasi1.kelantan.gov.my/eln/senaraiRekodIndividu")
                    <td>
                      @if ( $mohonan->statusPermohonan == "Lulus Semakkan ketua Jabatan")

                      <a href="{{ route('senaraiPending.hantar', ['id' => $mohonan->permohonansID]) }}" 
                            class="btn btn-success btn-xs" onclick="javascript: return confirm('Anda pasti untuk meluluskan Semakan permohonan ini?');"><i class="fa fa-check-square-o"> Terima</i></a>

                        <a class="btn btn-danger btn-xs" data-toggle="modal" href='#mdl-tolak' data-id="{{ $mohonan->permohonansID }}" onclick="javascript: return confirm('Anda pasti untuk kembalikan semula permohonan ini?');"><i class="fa fa-times">Tolak</i></a>

                        {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                            class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mengemaskini maklumat ini?');"><i class="fa fa-print">Cetak</i></a> --}}
                                        
                      @elseif($mohonan->statusPermohonan == "Lulus Semakan BPSM")

                        {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                            class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mencetak maklumat ini?');"><i class="fa fa-print">Cetak</i></a> --}}
                  
                      @endif
                    </td>
                    @else
                    
                    @endif
                  
               @endforeach
            
                </tbody>
              </table>


              <div class="modal fade" id="mdl-tolak">
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
            </div>

                  <!-- /.chart-responsive -->
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
               
@endsection

@section('script')

      <script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })
        })
      </script>

      <script>
          $('#mdl-tolak').on('show.bs.modal',function (event){

              var button = $(event.relatedTarget);
              var id = button.data('id');

              $('#id_edit').val(id);
          });
      </script>

@endsection




