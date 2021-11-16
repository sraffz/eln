<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laporan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
</head>
<body>

<div class="container">

  <p align="center"><img src="{{ asset('adminlte/dist/img/kelantan.png')}}" width="200" height="150" alt="User Image" align="center"><br></p>            
  <p align="center"><strong>LAPORAN JUMLAH MENGIKUT NEGARA PERJALANAN PEGAWAI AWAM KE LUAR NEGARA <BR>BAGI TAHUN {{$year}}</strong></p>            
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">JABATAN</th>
      
        <th class="text-center">JUMLAH PEGAWAI</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center">SOUTH AFRICA</td>
        <td class="text-center">5</td>
      </tr>
      <tr>
        <td class="text-center">INDIA</td>
        <td class="text-center">6</td>
      </tr>
      <tr>
        <td class="text-center">AFGHANISTAN</td>
        <td class="text-center">2</td>
      </tr>
      <tr>
        <td class="text-center">BANGLADESH</td>
        <td class="text-center">20</td>
      </tr>
      <tr>
        <td class="text-center">USA</td>
        <td class="text-center">7</td>
      </tr>
    </tbody>
  </table>
</div>


<!-- jQuery 3 -->
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
<script src="{{ asset('adminlte/dist/js/demo.js')}}"></script>
</body>
</html>
