@extends('layouts.eln')

@section('title', 'Senarai Permohonan')

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
              <h3 class="box-title">Senarai Permohonan </h3>

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
                </tr>
                </thead>

                <tbody>
                  <?php $i=1; ?>
               @foreach($permohonan as $mohonan)
                <tr>
                  <td><?php echo $i; $i=$i+1; ?></td>
                  <td><a href="detailPermohonan/{{ $mohonan->permohonansID }}">{{ $mohonan->user->nama }}</a></td>
                  {{-- <td>{{ $mohonan->user->userJabatan->nama_jabatan }}</td> --}}
                  <td>{{\Carbon\Carbon::parse($mohonan->user->created_at)->format('d/m/Y')}}</td>
                  <td>{{ $mohonan->negara }}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  {{-- <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td> --}}
                  <td>{{ $mohonan->JenisPermohonan }}</td>
                  <td>
                      <?php
                          if ($mohonan->statusPermohonan == 'Lulus Semakkan ketua Jabatan') 
                          { ?>
                            <span class="label label-warning">Dalam Tindakkan BPSM</span>
                    <?php }
                          elseif ($mohonan->statusPermohonan == 'Ketua Jabatan')
                          { ?>
                            <span class="label label-warning">Dalam Tindakkan Ketua Jabatan</span>
                    <?php }
                          elseif ($mohonan->statusPermohonan == 'Lulus Semakan BPSM')
                          { ?>
                            <span class="label label-primary">Lulus Semakan BPSM</span> 
                    <?php }
                          elseif ($mohonan->statusPermohonan == 'Permohonan Berjaya')
                          { ?>
                            <span class="label label-success">Permohonan Berjaya</span>
                    <?php }
                          else
                          {
                            echo $mohonan->statusPermohonan;
                          }
                      ?>

                    </td>
                  
               @endforeach
            
                </tbody>
              </table>
           

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
