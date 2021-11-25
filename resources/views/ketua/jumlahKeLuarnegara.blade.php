@extends('layouts.eln')

@section('title','Jumlah Keluar Negera')

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
              <h3 class="box-title">Senarai laporan Jumlah Keluar Negara</h3>

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
              <table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr bgcolor="#ddd">
                  <th>No</th>       
                  <th>Nama</th> 
                  <th>Jumlah Keluar Negera</th>
                </tr>
                </thead>
                @php
                  $no=1;
                @endphp
                <tbody>
               @foreach($senaraiPengguna as $pengguna)
                <tr>
                  <td>@php
                    echo $no;
                    $no=$no+1;
                  @endphp</td>
                  <td>{{ $pengguna->user->nama}}</td>
                  <td>
                      @php
                        $jumlah=0;
                      @endphp
                      @foreach ($senaraiPermohonan as $senaraiPermohonans)
                        @if ($pengguna->user->usersID == $senaraiPermohonans->usersID)
                        {{ $senaraiPermohonans->negara }} ({{ date('d-m-Y', strtotime($senaraiPermohonans->tarikhMulaPerjalanan)) }} - {{ date('d-m-Y', strtotime($senaraiPermohonans->tarikhAkhirPerjalanan)) }})<br>
                          @php
                            $jumlah++;
                          @endphp
                        @endif
                      @endforeach
                      <strong>Jumlah:{{ $jumlah }}</strong>
                  </td>
                </tr>
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

@endsection




