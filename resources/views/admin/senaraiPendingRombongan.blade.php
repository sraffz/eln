@extends('layouts.starter')

@section('title', 'Senarai Rombongan')

@section('link')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- DataTables -->
<script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

@endsection

@section('content')
@include('flash::message')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Senarai Rombongan</h3>
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
                  <table id="tableBaru" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Negara</th>
                  <th>Code</th>
                  <th>Tarikh Mula Perjalanan</th>
                  <th>Tarikh Akhir Perjalanan</th>
                  <th>Tujuan Rombongan</th>
                  <th>Peserta</th>
                  <th>Status Permohonan</th>
                  {{-- <th>Tarikh Lulusan Permohonan</th> --}}
                  <th>Dokumen</th>
                </tr>
                </thead>

                <tbody>
                  <?php $i=1; ?>
               @foreach($rombongan as $rombo)
                <tr>
                  <td><?php echo $i; $i=$i+1; ?></td>
                  <td><a href="detailPermohonanRombongan/{{ $rombo->rombongans_id }}">{{ $rombo->negaraRom }}</a></td>
                  <td>{{ $rombo->codeRom }}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y')}}</td>
                  <td>{{ $rombo->tujuanRom }}</td>
                  <td>@foreach ($allPermohonan as $element)
                    @if ($element->rombongans_id == $rombo->rombongans_id)
                      {{ $element->user->nama }} &nbsp;&nbsp;

                      @if ( $rombo->statusPermohonanRom == "Lulus Semakan")
                      {{-- <a class="btn-warning btn-xs disabled"><i class="fa fa-times-circle"></i></a><br> --}}
                      <br>
                      @elseif($rombo->statusPermohonanRom == "Pending")
                      <a href="senaraiPermohonan/{{$element->permohonansID}}/tamat-individu" class="btn-danger btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa  fa-remove"></i></a><br>
                      @endif
                    @endif
                  @endforeach</td>
                  <td><span class="label label-info">{{ $rombo->statusPermohonanRom }}</span></td>
                  {{-- <td>{{\Carbon\Carbon::parse($rombo->tarikhLulusan)->format('d/m/Y')}}</td> --}}
                  
                  <td>
                    @if ( $rombo->statusPermohonanRom == "Lulus Semakan")

                    <span class="label label-warning">Lulus Semakan</span>
                    
                    @elseif($rombo->statusPermohonanRom == "Pending")

                    <a href="senaraiPendingRombongan/{{$rombo->rombongans_id}}/sent-Permohonan" class="btn btn-success btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk menghantar maklumat permohonan?');"><i class="fa fa-check-square-o"></i></a>

                    <a class="btn btn-danger btn-xs" data-toggle="modal" href='#mdl-tolak' data-id="{{ $rombo->rombongans_id }}" onclick="javascript: return confirm('Anda pasti untuk kembalikan semula permohonan ini?');"><i class="fa fa-times"></i></a>

                    {{-- <a href="/senaraiPendingRombongan/{{$rombo->rombongans_id}}/Tolak" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa fa-user-times"></i></a> --}}
                    
                    @elseif($rombo->statusPermohonanRom == "Diluluskan")

                        <span class="label label-success">Diluluskan</span>

                    @elseif($rombo->statusPermohonanRom == "Permohonan Diluluskan" or $rombo->statusPermohonanRom == "Permohonan Ditolak" or $rombo->statusPermohonanRom == "Lulus Semakan")

                        <span class="label label-primary">Tiada</span>

                    @endif
                  </td>
                  
                  
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
                        {!! Form::open(['method' => 'POST', 'url' => '/sebabRombongan']) !!}
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
          $('#tableBaru').DataTable()
          $('#tableBaru2 ').DataTable({
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




