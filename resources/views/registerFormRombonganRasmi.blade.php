@extends('layouts.starter')

@section('title', 'Permohonan Bagi Rombongan: Rasmi')

@section('link')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
  

@endsection

@section('content')


<div class="row">
        <!-- left column -->
       
        <div class="col-md-12">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Maklumat permohonan perjalanan Keluar Negara</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               {!! Form::model($userDetail,['method' => 'POST', 
                                       'url' => array('daftarPermohonanRombongan',$userDetail->usersID),
                                       'class' => 'form-horizontal','enctype' =>'multipart/form-data']) !!}

                {!! Form::hidden('id', $userDetail->usersID) !!}

              <table class="table table-responsive">
                <tr>
                  <td>
                    <label>Tarikh Terima Insuran<span style="color:red;">**</span></label>
                    <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tarikhInsuranRom" required="required">
                    </div>
                  </td>
                  <td>
                    <label>Tarikh Mula Rombongan dan sehingga<span style="color:red;">**</span></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservation" name="tarikhmulaAkhir" required="required">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                     <label>Tujuan Permohonan<span style="color:red;">*</span></label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-edit"></i>
                                  </div>
                                 <input type="text" name="tujuanRom" class="form-control" required="required">
                                </div>

                  </td>
                  <td>
                    <label>Negara<span style="color:red;">**</span></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-globe"></i>
                            </div>
                            <select style="width: 100%;" id="negaraRom" class="form-control select2" name="negaraRom" required="required">
                                <option value="" selected="selected"></option>
                              @foreach($negara as $jaw)
                                  <option value="{{ $jaw->namaNegara }}">{{ $jaw->namaNegara }}</option>
                              @endforeach
                            </select>{{-- {{$k->anugerah}}  --}}
                    </div>
                  </td>
                </tr>
                 <tr>
                  <td>
                    <label>Sumber Kewangan<span style="color:red;">**</span></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                      </div>
                      <select class="form-control" id="jenisKewanganRom" name="jenisKewanganRom" required="required">
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
					 <label>Anggaran Belanja(RM)<span style="color:red;">*</span></label>
	                    <div class="input-group">
	                      <div class="input-group-addon">
	                        <i class="fa fa-money"></i> 
	                      </div>   
	                      <input class="form-control" type="number" placeholder="0.00" required name="anggaranBelanja" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'
">
	                    </div> 
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                              <label>Alamat Rombongan</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-map-o"></i>
                                  </div>
                                 <textarea class="form-control" name="alamatRom" id="alamatRom" cols="170"></textarea>
                                </div>
                  </td>
                  
                </tr>
                <tr>
                  <td colspan="2">
                   <label>Dokumen Rasmi<span style="color:red;">**</span></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="file" class="form-control" name="fileRasmiRom[]" multiple required="required"/>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                  <div class="btn-group pull-left">
                      {{-- {!! Form::reset("Semula", ['class' => 'btn btn-warning']) !!} --}}
                      {!! Form::submit("Hantar", ['class' => 'btn btn-primary']) !!}
                  </div>

                  {!! Form::close() !!}
                  </td>
                </tr>
              
              </table>
            </div>
            <!-- /.box-body -->
            {{-- <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div> --}}
          </div>
          <!-- general form elements -->
         

               
           </div>
        </div>
    </div>
    
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
  })
</script>

@endsection
