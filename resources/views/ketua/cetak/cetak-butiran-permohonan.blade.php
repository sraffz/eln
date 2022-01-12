<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Butiran Permohonan</title>

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
        }
        .table th {
            font-size: 14px
        }

    </style>
</head>

<body>
    
        <p align="center"><img src="{{ asset('adminlte/dist/img/kelantan.png') }}" width="160" height="120"
                alt="User Image" align="center"><br></p>
        <p style="text-transform: uppercase; font-size:17px" align="center">
            <strong>
                PERMOHONAN PERJALANAN PEGAWAI AWAM KE LUAR NEGARA <br>
                atas URUSAN {{ $permohonan->JenisPermohonan }}
            </strong>
        </p>
      
        <div class="text-center">
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2" class="text-left">MAKLUMAT PEMOHON</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Nama Pegawai</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->user->nama }}</strong> </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>No. Kad Pengenalan</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->user->nokp }}</strong> </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Tarikh Terima Insurans</strong> </td>
                        <td class="text-left">
                            <strong>{{ \Carbon\Carbon::parse($permohonan->tarikhInsuran)->format('d/m/Y') }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Jawatan/Gred</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->user->userJawatan->namaJawatan }}
                                ({{ $permohonan->user->userGredKod->gred_kod_abjad }}{{ $permohonan->user->userGredAngka->gred_angka_nombor }})</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Jabatan</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->user->userJabatan->nama_jabatan }}
                                ({{ $permohonan->user->userJabatan->kod_jabatan }})</strong> </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2" class="text-left">MAKLUMAT PERJALANAN KE LUAR NEGARA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Tempoh Lawatan</strong> </td>
                        <td class="text-left">
                            <strong>{{ \Carbon\Carbon::parse($permohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}
                                sehingga
                                {{ \Carbon\Carbon::parse($permohonan->tarikhAkhirPerjalanan)->format('d/m/Y') }}
                                ({{ $jumlahDate }} Hari)</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Negara Yang Dilawati</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->negara }}</strong> </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Tujuan Lawatan</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->lainTujuan }}</strong> </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>Alamat Semasa Bercuti</strong> </td>
                        <td class="text-left"><strong>{{ $permohonan->alamat }} </strong> </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 30%"><strong>No. Telefon / Email</strong> </td>
                        <td class="text-left">
                            <strong>{{ $permohonan->telefonPemohon }} / {{ $permohonan->user->email }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            @foreach ($pasangan as $ppp)
                @if ($ppp->namaPasangan != null)
                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="2" class="text-left">MAKLUMAT PASANGAN/KELUARGA/SAUDARA PEGAWAI DI
                                    LUAR NEGARA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left" style="width: 30%"><strong>Nama</strong> </td>
                                <td class="text-left"><strong>{{ $ppp->namaPasangan }}</strong> </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 30%"><strong>Hubungan</strong> </td>
                                <td class="text-left"><strong>{{ $ppp->hubungan }}</strong> </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 30%"><strong>Alamat</strong> </td>
                                <td class="text-left"><strong>{{ $ppp->alamatPasangan }} </strong> </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="width: 30%"><strong>No. Telefon / Email</strong> </td>
                                <td class="text-left">
                                    <strong>{{ $ppp->phonePasangan }} / {{ $ppp->emailPasangan }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                @endif
            @endforeach

            @if ($jumlahDateCuti > 0)
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="4" class="text-left">MAKLUMAT KELULUSAN CUTI REHAT (SEKIRANYA MEMERLUKAN
                                KELULUSAN CUTI REHAT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left" style="width: 25%"><strong>Tarikh Mula Cuti</strong> </td>
                            <td class="text-left">
                                <strong>{{ \Carbon\Carbon::parse($permohonan->tarikhMulaCuti)->format('d/m/Y') }}</strong>
                            </td>
                            <td class="text-left" style="width: 25%"><strong>Tarikh Akhir Cuti</strong> </td>
                            <td class="text-left">
                                <strong>{{ \Carbon\Carbon::parse($permohonan->tarikhAkhirCuti)->format('d/m/Y') }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="width: 25%"><strong>Jumlah Cuti</strong> </td>
                            <td class="text-left"><strong>{{ $jumlahDateCuti }}</strong> </td>
                            <td class="text-left" style="width: 25%"><strong>Tarikh Kembali Bertugas</strong> </td>
                            <td class="text-left">
                                <strong>{{ \Carbon\Carbon::parse($permohonan->tarikhKembaliBertugas)->format('d/m/Y') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-left">PERAKUAN PEMOHON</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">
                            @if ($permohonan->tick == 'yes')
                                <strong>1) Saya dengan ini memenuhi segala peraturan yang ditetapkan di perenggan 6 (i),
                                    (ii) dan perenggan 10 Surat Pekeliling Am Bilangan 3 tahun 2021</strong>
                                <br><br>
                                <strong>2) Saya dengan ini mengisytiharkan segala maklumat yang diberikan adalah benar.
                                    Sekiranya didapati maklumat ini tidak benar, saya boleh diambil tindakan mengikut
                                    peraturan sedia ada.</strong>
                            @endif
                            <br><br>
                            <strong>Tarikh Permohonan :
                                {{ \Carbon\Carbon::parse($permohonan->created_at)->format('d/m/Y') }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="text-center">
                <p>
                   <i> *Borang ini janaan komputer dan tidak memerlukan tandatangan.*</i>
                </p>
            </div>

        
    </div>

    <script src="{{ asset('adminlte-3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte-3/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
