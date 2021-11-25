@extends('layouts.eln')

@section('title', 'Maklumat Surat')

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
              <h3 class="box-title">Maklumat Surat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
              <br>
             <!-- START CUSTOM TABS -->
            
            <div class="row">
              <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Tema dan Cogan Kata</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Penolong Pegarah(Perkhidmatan)</a></li>
                    {{-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> --}}
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        {!! Form::open(['method' => 'POST', 'url' => 'prosesTambahCoganKata']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">

                              <div class="input-group">
                              <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                              </div>
                                  <input type="text" class="form-control" id="kata" name="kata" required placeholder="RAJA BERDAULAT, RAKYAT MUAFAKAT, NEGERI BERKAT">
                                  <input type="hidden"id="cogan" name="cogan" value="Cogan Kata">
                              </div>
                              <br>
                      
                              <div class="btn-group pull-left">
                              {!! Form::submit("Kemaskini", ['class' => 'btn btn-success']) !!}
                              </div>
                        {!! Form::close() !!}
                        <br>
                        <br>
                        <br>

                        <table class="table table-bordered table-striped">
                  
                        <thead>
                          <tr bgcolor="#7abcb9">
                            <th>Tema dan Cogan Kata</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          <tr>
                            <td>{{ $cogankata->maklumat1 }}</td>
                          </tr> 
                        </tbody>
                      </table>
                        
                        
                    </div> {{-- penutup tab 1 --}}
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                      {!! Form::open(['method' => 'POST', 'url' => 'prosesTambahNamaPenolongPengarah']) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="POST">

                              <div class="input-group">
                              <div class="input-group-addon">
                                    <i class="fa fa-book"></i>
                              </div>
                                  <input type="text" class="form-control" id="maklumat1" name="maklumat1" value="{{ $penolongPengarah->maklumat1 }}" required placeholder="Nama Penolong Pengarah">
                                  <input type="text" class="form-control" id="maklumat2" name="maklumat2" value="{{ $penolongPengarah->maklumat2 }}" required placeholder="Penolong Pengarah (Perkhimatan)">
                                  <input type="text" class="form-control" id="maklumat3" name="maklumat3" value="{{ $penolongPengarah->maklumat3 }}"  placeholder="b.p:SETIAUSAHA KERAJAAN">
                                  <input type="text" class="form-control" id="maklumat4" name="maklumat4" value="{{ $penolongPengarah->maklumat4 }}"  placeholder="NEGERI KELANTAN">
                                  <input type="hidden"id="pp" name="pp" value="Penolong Pengarah">
                              </div>
                              <br>
                      
                              <div class="btn-group pull-left">
                              {!! Form::submit("Kemaskini", ['class' => 'btn btn-success']) !!}
                              </div>
                        {!! Form::close() !!}
                        <br>
                        <br>
                        <br>

                        <table class="table table-bordered table-striped">
                  
                        <thead>
                          <tr bgcolor="#7abcb9">
                            <th>Penolong Pengarah</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          @if(is_null($penolongPengarah))
                            <tr>
                                <td>
                                  tiada
                                </td>
                            </tr>
                          @else 
                            <tr>
                              <td>{{ $penolongPengarah->maklumat1 }}</td>
                            </tr>
                            <tr>
                              <td>{{ $penolongPengarah->maklumat2 }}</td>
                            </tr> 
                            <tr>
                              <td>{{ $penolongPengarah->maklumat3 }}</td>
                            </tr> 
                            <tr>
                              <td>{{ $penolongPengarah->maklumat4 }}</td>
                            </tr>
                          @endif
                            
                           
                        </tbody>
                      </table>
                    </div>
                    
                    <!-- /.tab-pane -->
                        
                  </div>

                  <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
              </div>
              <!-- /.col -->

        
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->  


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



