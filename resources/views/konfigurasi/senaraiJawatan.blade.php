@extends('layouts.starter')

@section('title', 'Senarai Jawatan')

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
              <h3 class="box-title">Senarai Jawatan </h3>

              <div class="box-tools pull-right">
                <div class="btn-group">
                  <a href="{{route('tambahJawatan')}}" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Tambah Jawatan</span></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
              <br>
                  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr bgcolor="#7abcb9">
                  <th>No</th>
                  <th>Nama Jabatan</th>
                  {{-- <th>Tindakan</th> --}}
                </tr>
                </thead>

                <tbody>
                  <?php $i=1; ?>
               @foreach($jawatan as $jawatans)
                <tr>
                  <td><?php echo $i; $i=$i+1; ?></td>
                  <td>{{ $jawatans->namaJawatan }}</td>
                  {{-- <td>
                    
                  </td> --}}
                  
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

@endsection



