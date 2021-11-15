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
              <h3 class="box-title">Senarai Rombongan</h3>
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
                  <th>Tindakan</th>
                </tr>
                </thead>

                @php
                  $no1=1;
                @endphp

                <tbody>
               @foreach($rombongan as $rombo)
                <tr>
                  <td>@php
                    echo $no1;
                    $no1=$no1+1;
                  @endphp</td>
                  <td><a href="/eln/detailPermohonanRombongan/{{ $rombo->rombongans_id }}">{{ $rombo->negaraRom }}</a></td>
                  <td>{{ $rombo->codeRom }}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y')}}</td>
                  <td>{{ $rombo->tujuanRom }}</td>
                  <td>@foreach ($allPermohonan as $element)
                    @if ($element->rombongans_id == $rombo->rombongans_id)
                      @if ($element->statusPermohonan == "Permohonan Berjaya")
                        <span class="label label-success">{{ $element->user->nama }}</span><br>
                      @elseif($element->statusPermohonan == "Permohonan Gagal")
                            <span class="label label-danger">{{ $element->user->nama }}</span><br>
                      @elseif($element->statusPermohonan == "Pending")
                      {{ $element->user->nama }}<br> 
                      @elseif($element->statusPermohonan == "Tindakan BPSM" && $rombo->statusPermohonanRom == "simpanan")
                      {{ $element->user->nama }}<a href="/eln/senaraiPermohonan/{{$element->permohonansID}}/tamat-individu" class="btn-danger btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa  fa-remove"></i></a><br>
                      @elseif($element->statusPermohonan == "Tindakan BPSM" && $rombo->statusPermohonanRom == "Pending")
                      {{ $element->user->nama }}<br>
                      @elseif($element->statusPermohonan == "Tindakan BPSM" && $rombo->statusPermohonanRom == "Lulus Semakan")
                      {{ $element->user->nama }}<br>
                            
                      @else
                            {{-- @if ( $rombo->statusPermohonanRom == "Pendissng") --}}
                            {{-- <a class="btn-warning btn-xs disabled"><i class="fa fa-times-circle"></i></a><br> --}}
                           {{-- <br>
                            @elseif($rombo->statusPermohonanRom == "Pending")
                            {{ $element->user->nama }}
                            &nbsp;&nbsp; --}}{{-- <a href="/senaraiPermohonan/{{$element->permohonansID}}/tamat-individu" class="btn-danger btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa  fa-remove"></i></a><br>
                            @elseif($rombo->statusPermohonanRom == "Lulus Semakan") --}}
                            {{-- <br>
                            @endif --}}
                      @endif
                      
                      
                    @endif
                  @endforeach</td>
                  <td>{{ $rombo->statusPermohonanRom }}</td>
                  {{-- <td>{{\Carbon\Carbon::parse($rombo->tarikhLulusan)->format('d/m/Y')}}</td> --}}
                  
                  <td>
                    @if ( $rombo->statusPermohonanRom == "Pending")

                    <span class="label label-warning">Pending</span>
                    
                    @elseif($rombo->statusPermohonanRom == "simpanan")

                    <a href="/eln/senaraiPermohonan/{{$rombo->rombongans_id}}/hantarRombongan" class="btn btn-success btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk menghantar maklumat permohonan?');"><i class="fa fa-check-square-o"></i></a>

                    <a href="/eln/editPermohonan/{{$rombo->rombongans_id}}/edit" class="btn btn-info btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk mengemaskini maklumat permohonan??');"><i class="fa fa-pencil-square-o"></i></a>

                    <a href="/eln/senaraiPermohonan/{{$rombo->rombongans_id}}/tamat" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Padam maklumat ini?');"><i class="fa fa-user-times"></i></a>
                    
                    @elseif($rombo->statusPermohonanRom == "Permohonan Berjaya")

                        <span class="label label-success">Berjaya</span>

                    @elseif($rombo->statusPermohonanRom == "Permohonan Gagal")

                        <span class="label label-danger">Gagal</span>

                    @elseif($rombo->statusPermohonanRom == "Permohonan Berjaya" or $rombo->statusPermohonanRom == "Permohonan Gagal" or $rombo->statusPermohonanRom == "Lulus Semakan")

                        <span class="label label-primary">Tiada</span>

                    @endif
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




