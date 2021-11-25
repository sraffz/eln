@extends('layouts.eln')

@section('title', 'Senarai Permohonan baru')

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
              <h3 class="box-title">Senarai Permohonan Baru {{-- <br><small>Tidak termasuk individu yg mengikut rombongan</small> --}} </h3>

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
                  <?php $i=1; ?>
               @foreach($permohonan as $mohonan)
                <tr>
                  <td><?php echo $i; $i=$i+1; ?></td>
                  <td><a href="detailPermohonan/{{ $mohonan->permohonansID }}">{{ $mohonan->user->nama }}</a></td>
                  {{-- <td>{{ $mohonan->user->jabatan }}</td> --}}
                  <td>{{\Carbon\Carbon::parse($mohonan->user->created_at)->format('d/m/Y')}}</td>
                  <td>{{ $mohonan->negara }}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  {{-- <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td> --}}
                  <td>{{ $mohonan->JenisPermohonan }}</td>
                  <td>{{ $mohonan->statusPermohonan }}</td>
                  <td>
                    @if ( $mohonan->statusPermohonan == "Ketua Jabatan")

                    {{-- <a href="{{ route('senaraiPermohonan.hantar', ['id' => $mohonan->permohonansID]) }}" 
                          class="btn btn-success btn-xs" onclick="javascript: return confirm('Anda pasti untuk meluluskan Semakan permohonan ini?');"><i class="fa fa-thumbs-o-up"></i>
                      </a> --}}

                      <a onClick="setUserData({{$mohonan->permohonansID}});" data-toggle="modal" data-target="#favoritesModal" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i></a>

                       <a href="{{ route('senaraiPermohonan.tolakPermohonan', ['id' => $mohonan->permohonansID]) }}" 
                          class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda pasti untuk menolak permohonan ini?');"><i class="fa fa-thumbs-o-down"></i>
                      </a> 

                      {{-- <a href="{{ route('editPermohonan.edit', ['id' => $mohonan->permohonansID]) }}" 
                          class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk cetak?');"><i class="fa fa-print"></i>
                      </a> --}}
                                      
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
                  
               @endforeach
            
                </tbody>
              </table>


             {{--  <div class="modal fade" id="mdl-kemaskini">
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


 <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="favoritesModalLabel">Ulasan</h4>
            </div>

          <div class="modal-body">
            <form action="senaraiPermohonanJabatan/hantar"><div class="modal-body">Sila masukkan ulasan.<br>
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
      
  <script language="javascript">
    function setUserData(id){
        var userHidden = document.getElementById('kopeID');
        userHidden.value=id;
    }
    </script>
     {{--  <script>
          $('#mdl-kemaskini').on('show.bs.modal',function (event){

              var button = $(event.relatedTarget);
              var id = button.data('id');

              $('#id_edit').val(id);
          });
      </script> --}}

@endsection
