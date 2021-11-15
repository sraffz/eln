@extends('layouts.starter')

@section('title', 'Senarai Permohonan')

@section('link')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- DataTables -->
<script src="{{ asset('public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

@endsection

@section('content')
@include('flash::message')
 <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Senarai Permohonan individu</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Negara</th>
                  <th>Tarikh Mula Perjalanan</th>
                  <th>Tarikh Akhir Perjalanan</th>
                  <th>Jenis/Tujuan</th>
                  <th>Status Permohonan</th>
                  <th>Tarikh Lulusan</th>
                  <th>Tindakan</th>
                </tr>
                </thead>

                @php
                  $no=1;
                @endphp

                <tbody>
               @foreach($permohonan as $mohonan)
                <tr>
                  <td>@php
                    echo $no;
                    $no=$no+1;
                  @endphp</td>
                  <td><a href="/eln/detailPermohonan/{{ $mohonan->permohonansID }}">{{ $mohonan->negara }}</a></td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{ $mohonan->JenisPermohonan }}({{ $mohonan->lainTujuan }})</td>
                  <td>@if ( $mohonan->statusPermohonan == "simpanan")
                        <span class="label label-info">Draf</span>
                      @elseif( $mohonan->statusPermohonan == "Lulus Semakkan ketua Jabatan")
                        <span class="label label-info">Tindakan BPSM</span>
                      @else
                        <span class="label label-info">{{$mohonan->statusPermohonan}}</span>
                      @endif
                  </td>
                  <td>
                    @if (is_null($mohonan->tarikhLulusan))

                    <span class="label label-info">Tiada tarikh</span>
                    
                    @else
                    <span class="label label-primary">{{\Carbon\Carbon::parse($mohonan->tarikhLulusan)->format('d/m/Y')}}</span>
                    
                    @endif
                    </td>
                  <td>
                    @if ( $mohonan->statusPermohonan == "Pending")

                    <span class="label label-warning">Pending</span>
                    
                    @elseif($mohonan->statusPermohonan == "simpanan")
                     
                      <a href="/eln/senaraiPermohonan/{{$mohonan->permohonansID}}/hantarIndividu" class="btn btn-success btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk menghantar maklumat permohonan?');"><i class="fa fa-check-square-o"></i></a>
                      
                      <a href="/eln/senaraiPermohonan/{{$mohonan->permohonansID}}/kemaskini" class="btn btn-info btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mengemaskini maklumat permohonan?');"><i class="fa fa-pencil-square-o"></i></a>

                      <a href="/eln/senaraiPermohonan/{{$mohonan->permohonansID}}/hapus" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa fa-user-times"></i></a>
                    
                    @elseif($mohonan->statusPermohonan == "Permohonan Berjaya")

                        <span class="label label-success">Berjaya</span>

                     @elseif($mohonan->statusPermohonan == "Permohonan Gagal")

                        <span class="label label-danger">Gagal</span>

                    @else

                        <span class="label label-primary">Tiada</span>

                    @endif
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




