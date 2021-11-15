@extends('layouts.starter')

@section('title', 'Permohonan Bagi Rombongan')

@section('link')
<!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
  

@endsection

@section('content')
@include('flash::message')

<div class="row">
        <div class="col-md-12">
          <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Borang Pemohonan Ke luar Negara Individu (Rombongan)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->

                {!! Form::model($userDetail,['method' => 'POST', 
                             'url' => array('daftarPermohonanIndividuRombongan',$userDetail->usersID),
                             'class' => 'form-horizontal','enctype' =>'multipart/form-data']) !!}

                {!! Form::hidden('id', $userDetail->usersID) !!}

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        .::Maklumat Rombongan::.
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                        <div class="{{ $errors->has('kodRombo') ? ' has-error' : '' }}">
                            {!! Form::label('kodRombo', 'Kod Rombongan**') !!}
                            {!! Form::text('kodRombo', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('kodRombo') }}</small>
                        </div>
                    </div>
                  </div>
                </div>

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

                     <label>Tarikh Mula Cuti dan sehingga</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="reservation" name="tarikhmulaAkhirCuti">
                      </div>

                    <br>
                     <label>Tarikh Kembali Bertugas</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="tarikhKembaliBertugas">
                      </div>

                     <br>
                     <label>Dokumen Cuti</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-file"></i>
                        </div>
                        <input type="file" class="form-control" name="fileCuti" required="required" />
                      </div>
                         
                    </div>
                  </div>
                </div>

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
                      <input type="checkbox" name="tick" id="tick" value="yes" required="required">Saya dengan ini mematuhi segala peraturan yang telah ditetapkan di perenggan 6(i),(ii) dan perenggan 10 Surat Pekeliling Bilangan 3 Tahun 2012.
                    </div>
                  </div>
                </div>

              </div>
              <div class="btn-group pull-right">
                    {!! Form::reset("Semula", ['class' => 'btn btn-warning']) !!}
                    {!! Form::submit("Hantar", ['class' => 'btn btn-success']) !!}
                </div>
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
<script src="{{ asset('public/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('public/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('public/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('public/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

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
