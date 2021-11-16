<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>surat rasmi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">{{-- 
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}"> --}}

  <style>
            /** 
            * Set the margins of the PDF to 0
            * so the background image will cover the entire page.
            **/
            @page {
                margin: 0cm 0cm;
            }

            /**
            * Define the real margins of the content of your PDF
            * Here you will fix the margins of the header and footer
            * Of your background image.
            **/
            body {
                margin-top:    4cm;
                margin-bottom: 1cm;
                margin-left:   2cm;
                margin-right:  2cm;
            }

            /** 
            * Define the width, height, margins and position of the watermark.
            **/
            #watermark {
                position: fixed;
                bottom:   0px;
                left:     0px;
                /** The width and height may change 
                    according to the dimensions of your letterhead
                **/
                width:    21.8cm;
                height:   29cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
  </style>
</head>
<body>
  
    {{-- format surat --}}
     <div id="watermark">
            <img src="{{ asset('adminlte/dist/img/letterhead.jpeg')}}" height="100%" width="100%" />
    </div>
    <div class="page">
        <div class="container" >
            <div class="row" >
                <div class="col-xl-12">                  
                    <div class="row">
                        <div class="col-xl-12" >
                          <br>
                          <br>
                          <br>
                          <br>
                        	<table class="table">
                        		<tr>
                        			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        			<td>RUJUKAN: </strong>SUK.D.200 (06) 455/16 ELN.JLD.{{ $permohon->no_ruj_file }} ({{ $permohon->no_ruj_bil }})<br>TARIKH : </strong>{{ \Carbon\Carbon::parse($permohon->tarikhLulusan)->format('d  M  Y')}}
                                  <strong></td>
                        		</tr>
                        	</table>
                          
                         <div>Kemajlis,</div> <br>   
                         Ketua Jabatan <br>
                        {{-- {{ ucwords(strtolower($surat->nama_penuh)) }} --}}<br>
                        {{-- K/P : {!! formatKP($surat->no_kad_pengenalan) !!}<br>
                        alamat --}}
                        {{-- {!! ($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan1 != "") ? alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan1).",<br>" : "" !!}
                        {!! ($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan2 != "") ? alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan2).",<br>" : "" !!}
                        {!! ($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan3 != "") ? alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan3).",<br>" : "" !!}
                        {!! $surat->calon_perkhidmatans->perkhidmatan_AlamatJabatanPoskod !!} {!! alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatanBandar) !!},<br>
                        {!! negeri($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatanNegeri) !!} --}}<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12" >
                                {{-- <p> @if ($surat->gelaran == 10 || $surat->gelaran == 11) @else {{ getGelaran($surat->gelaran) }} @endif {{ getPangkat($surat->pangkat) }} </p> --}}
                        <p>YB. Dato’/ YM /  YBhg. Dato’ / Tuan/ Puan,</p><br>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12" >
                            
                      <strong>PERMOHONAN KEBENARAN  KE LUAR NEGARA BAGI URUSAN RASMI UNTUK MENGHADIRI {{ strtoupper($permohon->lainTujuan) }} PADA {{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d/m/Y')}} HINGGA {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d/m/Y')}} DI {{ strtoupper($permohon->negara) }}.</strong>
                            
                        
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-12" >
                                <div align="justify">
                                  <strong>
                                  NAMA    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ strtoupper($permohon->user->nama) }}<br>
                                  NO. K/P &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $permohon->user->nokp }}<br>
                                  JAWATAN / GRED &nbsp;: {{ strtoupper($permohon->user->userJawatan->namaJawatan) }} / {{ $permohon->user->userGredKod->gred_kod_abjad }}{{ $permohon->user->userGredAngka->gred_angka_nombor }}<br> <br>
                                  </strong>

                                  Adalah saya dengan segala hormatnya diarah merujuk kepada perkara di atas.<br><br>
                                  <div style="line-height: 1.2;">
                                  2.    Dimaklumkan bahawa permohonan  bagi  {{ strtoupper($permohon->user->nama) }} untuk ke luar negara iaitu ke {{ strtoupper($permohon->negara) }} bagi menghadiri urusan rasmi tersebut pada {{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d/m/Y')}} hingga {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d/m/Y')}} adalah <strong>telah diluluskan.</strong></div><br><br>

                                  Sekian, terima kasih.<br><br>
                                     
                                  <strong> " {{ $cogan->maklumat1 }} "</strong><br><br>

                                  Saya yang menjalankan amanah,<br><br><br>



                                  <strong>( {{ $pp->maklumat1 }} )</strong><br>
                                  {{ $pp->maklumat2 }}<br>
                                  <strong>{{ $pp->maklumat3 }}</strong><br>
                                  <strong>{{ $pp->maklumat4 }}</strong><br>

                                </div>
                        </div>
                    </div>
                    
                  
                    
                </div>
            </div>
        </div>
    </div>
    {{-- end format surat --}}

                               
    {{-- end format surat --}}


{{-- <!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script> --}}

</body>
</html>

                               


