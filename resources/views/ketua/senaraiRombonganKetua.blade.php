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

                <tbody>
               @foreach($rombongan as $rombo)
                <tr>
                  <td><a href="detailPermohonanRombongan/{{ $rombo->rombongans_id }}">{{ $rombo->negaraRom }}</a></td>
                  <td>{{ $rombo->codeRom }}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhMulaRom)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($rombo->tarikhAkhirRom)->format('d/m/Y')}}</td>
                  <td>{{ $rombo->tujuanRom }}</td>
                  <td>@foreach ($allPermohonan as $element)
                    @if ($element->rombongans_id == $rombo->rombongans_id)
                      {{ $element->user->nama }} &nbsp;&nbsp;

                      @if ( $rombo->statusPermohonanRom == "Permohonan Berjaya")
                      {{-- <a class="btn-warning btn-xs disabled"><i class="fa fa-times-circle"></i></a><br> --}}
                      <br>
                      @elseif($rombo->statusPermohonanRom == "Lulus Semakan")
                      <a href="senaraiRombonganKetua/{{$element->permohonansID}}/tolakPermohonan-individu" class="btn-danger btn-xs" onclick="javascript: return confirm('Permohonan Gagal?');"><i class="fa  fa-remove"></i></a><br>
                      @endif
                    @endif
                  @endforeach</td>
                  <td>{{ $rombo->statusPermohonanRom }}</td>
                  {{-- <td>{{\Carbon\Carbon::parse($rombo->tarikhLulusan)->format('d/m/Y')}}</td> --}}
                  
                  <td>
                    @if ( $rombo->statusPermohonanRom == "Permohonan Berjaya")

                    <span class="label label-success">Berjaya</span>
                    
                    @elseif($rombo->statusPermohonanRom == "Lulus Semakan")

                      <a href="senaraiRombonganKetua/{{$rombo->rombongans_id}}/sent-Rombongan" class="btn btn-success btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk menluluskan permohonan ini?');"><i class="fa fa-thumbs-o-up"></i></a>

                      <a href="senaraiRombonganKetua/{{$rombo->rombongans_id}}/reject-Rombongan" class="btn btn-danger btn-xs" onclick="javascript: return confirm('Anda pasti untuk menolak permohonan ini?');"><i class="fa fa-thumbs-o-down"></i></a> 

                      <a href="{{ route('editPermohonan.edit', ['id' => $rombo->rombongans_id]) }}" 
                          class="btn btn-warning btn-xs" onclick="javascript: return confirm('Adakah anda pasti untuk cetak?');"><i class="fa fa-print"></i>
                      </a>
                    
                    @elseif($rombo->statusPermohonanRom == "Permohonan Diluluskan")

                        <span class="label label-success">Diluluskan</span>

                    @elseif($rombo->statusPermohonanRom == "Permohonan Diluluskan" or $rombo->statusPermohonanRom == "Permohonan Ditolak" or $rombo->statusPermohonanRom == "Lulus Semakan")

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
