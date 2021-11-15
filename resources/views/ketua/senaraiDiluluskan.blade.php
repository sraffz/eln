@extends('layouts.starter')

@section('title','Senarai Permohonan')

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
              <h3 class="box-title">Senarai Permohonan individu</h3>

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
                <tr>
                  <th>No</th>
                  <th>Negara</th>
                  <th>Jenis/Tujuan</th>
                  <th>Tarikh Mula Perjalanan</th>
                  <th>Tarikh Akhir Perjalanan</th>
                  <th>Status Permohonan</th>
                  <th>Tarikh Keputusan</th>
                  <th>Tindakan</th>
                </tr>
                </thead>
                @php
                  $no=1;
                @endphp
                <tbody>
               @foreach($allPermohonan as $mohonan)
                <tr>
                  <td>@php
                    echo $no;
                    $no=$no+1;
                  @endphp</td>
                  <td><a href="/detailPermohonan/{{ $mohonan->permohonansID }}">{{ $mohonan->negara }}</a></td>
                  <td>{{ $mohonan->JenisPermohonan }}({{ $mohonan->lainTujuan }})</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td>
                  <td>@if ($mohonan->statusPermohonan == "Permohonan Berjaya")
                        <span class="label label-success">Berjaya</span>
                     @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                        <span class="label label-danger">Gagal</span>
                    @else
                        <span class="label label-primary">Tiada</span>
                    @endif</td>
                  <td>
                    <h4><span class="label label-primary">{{\Carbon\Carbon::parse($mohonan->tarikhLulusan)->format('d/m/Y')}}</span>
                    </td>
                  <td>

                    <a href="#{{-- /senaraiPermohonan/{{$rombo->rombongans_id}}/tamat --}}" class="btn btn-warning btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa fa-print"></i></a>
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

{{-- ------------------------------------------------------------------------------------------------- --}}
  

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
                  <th>Tujuan Rombongan</th>
                  <th>Tarikh Mula Perjalanan</th>
                  <th>Tarikh Akhir Perjalanan</th>
                  <th>Peserta</th>
                  <th>Status Permohonan</th>
                  {{-- <th>Tarikh Lulusan Permohonan</th> --}}
                  <th>Tindakan</th>
                </tr>
                </thead>

                @php
                  $no=1;
                @endphp
                
                <tbody>
               @foreach($rombongan as $rombo)
                <tr>
                  <td>
                    @php
                    echo $no;
                    $no=$no+1;
                  @endphp
                  </td>
                  <td><a href="/detailPermohonanRombongan/{{ $rombo->rombongans_id }}">{{ $rombo->negaraRom }}</a></td>
                  <td>{{ $rombo->codeRom }}</td>
                  <td>{{ $rombo->tujuanRom }}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y')}}</td>
                  <td>@foreach ($allPermohonan as $element)
                    @if ($element->rombongans_id == $rombo->rombongans_id)
                        @if ($element->statusPermohonan == "Permohonan Berjaya")
                        <span class="label label-success">{{ $element->user->nama }}</span><br>
                         @elseif($element->statusPermohonan == "Permohonan Gagal")
                            <span class="label label-danger">{{ $element->user->nama }}</span><br>
                        @else
                            <span class="label label-primary">Tiada</span>
                        @endif
                      
                    @endif
                  @endforeach</td>
                  <td>@if ($rombo->statusPermohonanRom == "Permohonan Berjaya")
                        <span class="label label-success">Berjaya</span>
                     @elseif($rombo->statusPermohonanRom == "Permohonan Gagal")
                        <span class="label label-danger">Gagal</span>
                    @else
                        <span class="label label-primary">Tiada</span>
                    @endif</td>
                  {{-- <td>{{\Carbon\Carbon::parse($rombo->tarikhLulusan)->format('d/m/Y')}}</td> --}}
                  
                  <td>
                   <a href="#{{-- /senaraiPermohonan/{{$rombo->rombongans_id}}/tamat --}}" class="btn btn-warning btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa fa-print"></i></a>
                  </td>
                  
                  
               @endforeach
            
                </tbody>
                
              </table>
                 
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




