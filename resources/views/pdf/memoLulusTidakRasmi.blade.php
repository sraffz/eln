<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Individu</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminlte-3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/dist/css/adminlte.min.css') }}">

    <style>
        .table td {
            font-size: 13px;
            vertical-align: middle;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table th {
            font-size: 14px
        }
        .body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>


    {{-- format surat --}}
    <div class="page">
        <div class="" >
            <div class="row" >
            	<div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                        	<br>
                        	<br>
                        	<br>
                        	 &nbsp; &nbsp; &nbsp; &nbsp;<img src="{{ asset('adminlte/dist/img/kelantan.png')}}" width="200" height="150" alt="User Image"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        	<img src="{{ asset('img/logoeksa1.png')}}" width="130" height="130" alt="User Image"><br>
                        	
                        </div>                       
                    </div>
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12" align="center" style="font-family: Arial;font-size: 12pt;">
                        	<strong>PEJABAT SETIAUSAHA KERAJAAN NEGERI KELANTAN<br>
                                  (BAHAGIAN PENGURUSAN SUMBER MANUSIA)<br>
                                  KOTA BHARU<br><br>

                                  MEMO<br>
                                  </strong>
                          
                        </div>                       
                    </div>
					
                    <div class="row">
                        <div class="col-xl-12" >
                                <div align="justify">
									
								  _________________________________________________________________________________ 
								  <br><strong>
                                  KEPADA    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  </strong>Ketua Jabatan<br>
                                  
                                  _________________________________________________________________________________
                                  <br><strong>
                                  DARIPADA  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>Penolong Pengarah (Perkhidmatan)<br>
                                  
                                  _________________________________________________________________________________
                                  <br><strong>
                                  TARIKH    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>{{ \Carbon\Carbon::parse($permohon->tarikhLulusan)->format('d/m/Y')}}<br>
                                  
                                  _________________________________________________________________________________
								  <br><strong>
                                  RUJUKAN  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>SUK.D.200 (06) 455/16 ELN.JLD.{{ $permohon->no_ruj_file }} ({{ $permohon->no_ruj_bil }})<br>
                                  <strong>
                                  _________________________________________________________________________________</strong>
                                  <br>
                                  <br>

                                 <strong>
								  PERMOHONAN KEBENARAN KE LUAR NEGARA BAGI URUSAN PERSENDIRIAN PADA {{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d/m/Y')}} HINGGA {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d/m/Y')}} DI {{ strtoupper($permohon->negara) }}.</strong>
								  <br>	
								  <br>	
                                  <strong>
                                  NAMA    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ strtoupper($permohon->user->nama) }}<br>
                                  NO. K/P &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $permohon->user->nokp }}<br>
                                  JAWATAN / GRED &nbsp;: {{ strtoupper($permohon->namaJawatan) }} / {{ $permohon->user->userGredKod->gred_kod_abjad }}{{ $permohon->user->userGredAngka->gred_angka_nombor }}<br> <br>
                                  </strong>

                                  Adalah saya dengan segala hormatnya diarah merujuk kepada perkara di atas.<br><br>
                                  <div style="line-height: 1.0;">
                                  2.    Dimaklumkan bahawa permohonan  bagi  {{ strtoupper($permohon->user->nama) }} untuk ke luar negara iaitu ke {{ strtoupper($permohon->negara) }} bagi menghadiri urusan persendirian pada {{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d/m/Y')}} hingga {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d/m/Y')}} adalah <strong>telah diluluskan.</strong></div><br>

                                  Sekian dimaklumkan, terima kasih.<br><br><br>
                                     
                                  {{-- <strong> " {{ $cogan->maklumat1 }} "</strong><br><br> --}}

                                  {{-- Saya yang menjalankan amanah,<br><br><br><br> --}}



                                  <strong>( {{ $pp->maklumat1 }} )</strong>

                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12" align="center" style="font-family: Arial;font-size: 11pt;"><br><br>
                        	<strong>"SURAT INI JANAAN KOMPUTER DAN TIDAK MEMERLUKAN TANDATANGAN"</strong><br>
                          
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end format surat --}}


    <script src="{{ asset('adminlte-3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte-3/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

                               