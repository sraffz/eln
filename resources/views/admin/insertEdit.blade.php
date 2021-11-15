@extends('layouts.starter')

@section('title', 'Senarai Pic Jabatan')

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
        <!-- left column -->
        {{-- <div class="col-md-2">
        </div> --}}
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-body">
					<h3>Tambah</h3>
					<br>
					{!! Form::open(['method' => 'POST', 'url' => 'daftarJabatan']) !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
			            <input type="hidden" name="_method" value="POST">


				<label>Nama</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
				<br>

                <label>No KP (Username)</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="nokp" name="nokp" required>
                </div>
				<br>

                <label>Jabatan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <select style="width: 100%;" id="jabatan" class="form-control" name="jabatan" required="required">
                    <option value="" selected="selected">Sila Pilih</option>
                    @foreach($jabatan as $jab)
                 
                    <option value="{{ $jab->jabatan_id }}">{{ $jab->nama_jabatan }}</option>
                           
                    @endforeach
                  </select>{{-- {{$k->anugerah}}  --}}
                </div>
				<br>

				<label>Peranan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <select style="width: 100%;" id="role" class="form-control" name="role" required="required">
                    <option value="" selected="selected">Sila Pilih</option>
                    <option value="jabatan" >Ketua Jabatan</option>
                    <option value="adminBPSM" >Admin PSM</option>
                    <option value="DatoSUK" >Admin Pejabat Dato</option>
                    <option value="pengguna" >Pengguna</option>
                  </select>{{-- {{$k->anugerah}}  --}}
                </div>
				<br>
				
                <label>Email</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
				<br>

                <label>Katalaluan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="password" class="form-control" id="katalaluan" name="katalaluan" required>
                </div>

			

		    <div class="btn-group pull-right">
		    {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
		   
		        {!! Form::submit("Daftar", ['class' => 'btn btn-success']) !!}
		    </div>
			
			{!! Form::close() !!}

               
           </div>
        </div>
    </div>
    {{-- <div class="col-md-2">
    </div> --}}
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

@endsection