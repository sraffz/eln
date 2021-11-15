<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laporan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/skins/_all-skins.min.css')}}">
</head>
<body>

<div class="container">

  <p align="center"><img src="{{ asset('public/adminlte/dist/img/kelantan.png')}}" width="200" height="150" alt="User Image" align="center"><br></p>            
  <p align="center"><strong>LAPORAN JUMLAH PERMOHONAN PERJALANAN PEGAWAI AWAM KE LUAR NEGARA <BR>BAGI TAHUN {{$year}}</strong></p>            
  <table class="table">
    <thead>
      <tr>
        <th colspan="2" class="text-center">PERMOHONAN BERJAYA</th>
      </tr>
      <tr>
        <th class="text-center">LELAKI</th>
        <th class="text-center">PEREMPUAN</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">{{$countLBerjaya}}</td>
        <td class="text-center">{{$countPBerjaya}}</td>
      </tr>
    </tbody>
<hr>
    <thead>
      <tr>
        <th colspan="2" class="text-center">PERMOHONAN GAGAL</th>
      </tr>
      <tr>
        <th class="text-center">LELAKI</th>
        <th class="text-center">PEREMPUAN</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">{{$countLGagal}}</td>
        <td class="text-center">{{$countPGagal}}</td>
      </tr>
    </tbody>
  </table>
</div>


<!-- jQuery 3 -->
<script src="{{ asset('public/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('public/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('public/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/adminlte/dist/js/demo.js')}}"></script>
</body>
</html>
