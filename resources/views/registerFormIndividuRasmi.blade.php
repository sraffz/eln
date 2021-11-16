@extends('layouts.starter')

@section('title', 'Permohonan Individu')

@section('link')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">

@endsection

@section('content')
@include('flash::message')

<div class="row">
        <div class="col-md-12">
          <div class="box box-info box-solid">
            <div class="box-header with-border"> 
              @if ($typeForm =="rasmi")  
                <h3 class="box-title">Borang Pemohonan Rasmi Keluar Negara </h3>
              @elseif($typeForm =="tidakRasmi")
                <h3 class="box-title">Borang Pemohonan Tidak Rasmi Keluar Negara </h3>
              @endif 
                 
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 

              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                {!! Form::model($userDetail,['method' => 'POST', 
                             'url' => array('daftarPermohonan',$userDetail->usersID),
                             'class' => 'form-horizontal','enctype' =>'multipart/form-data',
                             'autocomplete' => 'off']) !!}

                {!! Form::hidden('id', $userDetail->usersID) !!}

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                       .::Maklumat permohonan perjalanan Keluar Negara::.
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse in">
                    <div class="box-body">
                      <table class="table table-responsive">
                        <tr> 
                          <td><label>Tarikh Terima Insuran</label>
                              <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" name="tarikh">
                              </div>
                          </td>
                          <td><label>Tempoh lawatan<span style="color:red;">*</span><br>{{-- <small>(Tarikh permohonan tidak boleh kurang daripada 14 hari dari tarikh berlepas.)</small> --}}</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="reservation" name="tempohPerjalanan">
                              </div>
                            </td>
                          <td>
                              <label>Negara<span style="color:red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-globe"></i>
                                </div>
                                <select style="width: 100%;" id="negara" class="form-control select2" name="negara" required="required">
                                    <option value="" selected="selected"></option>
                                  @foreach($negara as $jaw)
                                      <option value="{{ $jaw->namaNegara }}">{{ $jaw->namaNegara }}</option>
                                  @endforeach
                                </select>{{-- {{$k->anugerah}}  --}}
                              </div>
                          </td>
                        </tr>
                        <tr> 
                          <td>@if ($typeForm =="rasmi")

                               <label>Tujuan Permohonan<span style="color:red;">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-edit"></i>
                                  </div>
                                 <input type="text" name="tujuan" class="form-control" required="required">
                                </div>

                              @elseif($typeForm =="tidakRasmi")

                              <label>Tujuan Permohonan<span style="color:red;">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-edit"></i>
                                  </div>
                                 <input type="text" name="tujuan" class="form-control" required="required">
                                </div>

                              @endif
                          </td>
                          <td> <label>Alamat semasa bertugas / bercuti<span style="color:red;">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-edit"></i>
                                  </div>
                                 <input type="text" name="alamat" class="form-control" required="required">
                                </div>
                          </td>
                          <td> <label>No. Telefon<span style="color:red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-phone"></i>
                                </div>
                               <input type="text" name="phone" class="form-control" required="required">
                              </div>
                          </td>
                        </tr>
                        
                          @if ($typeForm =="rasmi")
                          <tr>
                            <td>
                              <label>Jenis Kewangan<span style="color:red;">*</span></label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-money"></i>
                                </div>
                                <select class="form-control" id="jenisKewangan" name="jenisKewangan" required="required">
                                      <option value="Kerajaan">Kerajaan</option>
                                      <option value="Federal">Federal</option>
                                      <option value="Persendirian">Persendirian</option>
                                      <option value="Jabatan">Jabatan</option>
                                      <option value="Syarikat">Syarikat</option>
                                      <option value="lain-lain">lain-lain</option>
                                </select>
                              </div>
                            </td>
                            <td>
                                <label>Dokumen Rasmi<span style="color:red;">*</span> <br><small class="text-danger">(Format: pdf,jpg,jpeg,png,docx,doc)</small></label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-file"></i>
                                  </div>
                                    <input type="file" class="form-control" name="fileRasmi[]" multiple />
                                </div>
                            </td>
                          <td></td>
                          </tr>
                       
                              @elseif($typeForm =="tidakRasmi")
                       
                                <input type="hidden" name="jenisKewangan" value="Persendirian">
               
                              @endif
                       </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        .:::Maklumat Pasangan / Keluarga / Saudara Pegawai Keluar negara:::.
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse in">
                    <div class="box-body">
                      <table class="table table-responsive">
                        <tr>
                          <td>
                            <label>Nama Pasangan</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-user"></i>
                                </div>
                               <input type="text" name="namaPasangan" class="form-control">
                              </div>
                          </td>
                          <td> 
                            <label>Hubungan</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-male"></i>
                                </div>
                               <input type="text" name="hubungan" class="form-control">
                              </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                             <label>No. Telefon Pasangan</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-phone"></i>
                                </div>
                               <input type="text" name="phonePasangan" class="form-control">
                              </div>
                           </td>
                           <td>
                            <label>E-mel Pasangan</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-envelope-o"></i>
                                </div>
                               <input type="email" name="emailPasangan" class="form-control">
                              </div> 
                            </td>
                        </tr>
                        <tr>
                           <td colspan="2">
                              <label>Alamat Pasangan</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-map-o"></i>
                                  </div>
                                 <textarea class="form-control" name="alamatPasangan" id="alamatPasangan" cols="170"></textarea>
                                </div>
                              </td>
                          <td></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>


                @if ($typeForm =="tidakRasmi")
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                        .:::Maklumat kelulusan cuti rehat(Sekiranya memerlukan kelulusan cuti rehat):::.
                      </a>
                    </h4>
                  </div>
                  
                  <div id="collapseFour" class="panel-collapse collapse in">
                    <div class="box-body">

                    <table class="table table-responsive">
                      <tr>
                        <td>
                          <label>Tempoh Cuti</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation2" name="tempohCuti">
                          </div>
                        </td>
                        <td>
                          <label>Tarikh Kembali Bertugas</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker2" name="tarikhKembaliBertugas">
                          </div>
                        </td>
                        <td>
                            <label>Dokumen Cuti</label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-file"></i>
                                </div>
                                <input type="file" class="form-control" name="fileCuti[]" multiple />
                              </div>
                        </td>
                      </tr>
                    </table>
                    </div>
                  </div>
                   
                </div>
                @endif
                

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                        .::Perakuan Pemohonan::.
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFive" class="panel-collapse collapse in">
                    <div class="box-body">
                      <input type="checkbox" name="tick" id="tick" value="yes" required="required">Segala keterangan adalah benar dan mematuhi peraturan. 

                  </div>
                </div>

              </div>
            </div>
            
                  @if ($typeForm =="rasmi")
                  <input type="hidden" name="jenisPermohonan" value="Rasmi">
                  @elseif($typeForm =="tidakRasmi")
                  <input type="hidden" name="jenisPermohonan" value="Tidak Rasmi">
                  @endif
            
                 <div class="btn-group">
                    {!! Form::reset("Semula", ['class' => 'btn btn-warning']) !!}
                    {!! Form::submit("Hantar", ['class' => 'btn btn-success']) !!}
                </div>

            {!! Form::close() !!}
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Date range picker
    $('#reservation').daterangepicker()
    $('#reservation2').daterangepicker()
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
  })
</script>

@endsection

