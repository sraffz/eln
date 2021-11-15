<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laporan Dato</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  
  <p align="center"><strong>PERMOHONAN PERJALANAN PEGAWAI AWAM KE LUAR NEGARA ATAS URUSAN RASMI/PERSENDIRIAN <BR>BAGI TAHUN {{ now()->year }}</strong></p>            
  <table class="table table-bordered">
    <thead>
      <tr border="1">
        <th rowspan="2">BIL</th>
        <th rowspan="2">NAMA</th>
        <th rowspan="2">JAWATAN/GRED</th>
        <th rowspan="2">JABATAN</th>
        <th rowspan="2">TUJUAN PERMOHONAN</th>
        <th rowspan="2">NEGARA</th>
        <th colspan="2">TARIKH</th>
        <th rowspan="2">SUMBER KEWANGAN/JENIS PERMOHONAN</th>
        <th colspan="2">KELULUSAN</th>
        <th rowspan="2">ULASAN</th>
      </tr>  
      <tr>
        <th>PERGI</th>
        <th>BALIK</th> 
        <th>Lulus</th> 
        <th>Gagal</th>
      </tr>
    </thead>
    @php
                  $no=1;
                @endphp

                <tbody>
               @foreach($permohon as $mohonan)
                <tr>
                  <td>@php
                    echo $no;
                    $no=$no+1;
                  @endphp</td>
                  <td>{{ $mohonan->user->nama }}</td>
                  <td>{{ $mohonan->user->userJawatan->namaJawatan }}/{{ $mohonan->user->userGredKod->gred_kod_abjad }}{{ $mohonan->user->userGredAngka->gred_angka_nombor }}</td>
                  <td>{{ $mohonan->user->userJabatan->kod_jabatan }}</td>
                  <td>{{ $mohonan->lainTujuan }}</td>
                  <td>{{ $mohonan->negara }}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($mohonan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{ $mohonan->jenisKewangan }}/{{ $mohonan->JenisPermohonan }}</td>  
                  <td>
                    {{-- @if ( $mohonan->statusPermohonan == "Permohonan Berjaya")
                        <span>Lulus</span>
                    @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                        <span>Tolak</span>
                    @endif --}}
                  </td><td>
                    {{-- @if ( $mohonan->statusPermohonan == "Permohonan Berjaya")
                        <span>Lulus</span>
                    @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                        <span>Tolak</span>
                    @endif --}}
                  </td>
                  <td>
                    <small>Bil. Keluar Negara:
                    {{$mohonan->jumlahKeluarNegara($mohonan->usersID)}}</small>
                    <br>      
                    <br>    
                    <small>Bil. Hari Permohonan:</small>

                    @if( $mohonan->jumlahHariPermohonanBerlepas <= 14)
                    <small class="label label-danger">{{ $mohonan->jumlahHariPermohonanBerlepas }}</small>
                    @else
                    <small class="label label-success">{{ $mohonan->jumlahHariPermohonanBerlepas }}</small>
                    @endif   

                  </td>       
                     
                  
               @endforeach
                
                <?php
                  $a=array();
                  ?>

               @foreach($PermohonanRombongan as $PermohonanRombongan)
                <tr>
                  <td>@php
                    echo $no;
                    $no=$no+1;
                  @endphp</td>
                  <td>@php
                    if (in_array($PermohonanRombongan->jenisKewangan, $a)) 
                    {
                        
                    }
                    else
                    {
                      array_push($a,$PermohonanRombongan->jenisKewangan);
                    @endphp
                    {{ $PermohonanRombongan->lainTujuan }}
                    @php
                    }
                  @endphp</td>
                  <td>{{ $mohonan->negara }}</td>
                  <td>{{ $PermohonanRombongan->user->nama }}</td>
                  <td>{{ $mohonan->user->userJawatan->namaJawatan }}/{{ $mohonan->user->userGredKod->gred_kod_abjad }}{{ $mohonan->user->userGredAngka->gred_angka_nombor }}</td>
                  <td>{{ $mohonan->user->userJabatan->kod_jabatan }}</td>
                  <td>{{\Carbon\Carbon::parse($PermohonanRombongan->tarikhMulaPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{\Carbon\Carbon::parse($PermohonanRombongan->tarikhAkhirPerjalanan)->format('d/m/Y')}}</td>
                  <td>{{ $PermohonanRombongan->jenisKewangan }}</td>
                  <td>
                    {{-- @if ( $mohonan->statusPermohonan == "Permohonan Berjaya")
                        <span>Lulus</span>
                    @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                        <span>Tolak</span>
                    @endif --}}
                  </td><td>
                    {{-- @if ( $mohonan->statusPermohonan == "Permohonan Berjaya")
                        <span>Lulus</span>
                    @elseif($mohonan->statusPermohonan == "Permohonan Gagal")
                        <span>Tolak</span>
                    @endif --}}
                  </td>
                  {{-- <td>Ya</td> --}}
                  
                  
               @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
