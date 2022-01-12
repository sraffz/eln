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
            secara Rombongan
        </strong>
    </p>

    <div class="text-center">
        {{-- <table class="table table-bordered table-sm">
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
        </table> --}}

        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2" class="text-left">MAKLUMAT PERJALANAN KE LUAR NEGARA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left" style="width: 30%"><strong>Kod Rombongan</strong> </td>
                    <td class="text-left"><strong>{{ $permohonan->codeRom }}</strong> </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 30%"><strong>Tempoh Lawatan</strong> </td>
                    <td class="text-left">
                        <strong>{{ \Carbon\Carbon::parse($permohonan->tarikhMulaRom)->format('d/m/Y') }}
                            sehingga
                            {{ \Carbon\Carbon::parse($permohonan->tarikhAkhirRom)->format('d/m/Y') }}
                            ({{ $jumlahDate }} Hari)</strong>
                    </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 30%"><strong>Negara Yang Dilawati</strong> </td>
                    <td class="text-left"><strong>{{ $permohonan->negaraRom }}</strong> </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 30%"><strong>Tujuan Lawatan</strong> </td>
                    <td class="text-left"><strong>{{ $permohonan->tujuanRom }}</strong> </td>
                </tr>
                <tr>
                    <td class="text-left" style="width: 30%"><strong>Alamat Semasa Bercuti</strong> </td>
                    <td class="text-left"><strong>{{ $permohonan->alamatRom }} </strong> </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th colspan="4" class="text-left">SENARAI PESERTA ROMBONGAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>BIL</strong> </td>
                    <td><strong>NAMA</strong> </td>
                    <td><strong>NO. KP</strong> </td>
                    <td><strong>JAWATAN & GRED</strong> </td>
                </tr>
                <tr>
                    <td><strong>1</strong></td>
                    <td class="text-left"><strong>{{ $permohonan->nama }} (Ketua Rombongan)</strong></td>
                    <td><strong>{{ $permohonan->nokp }}</strong></td>
                    <td><strong>{{ $permohonan->namaJawatan }} ({{ $permohonan->gred_kod_abjad }}{{ $permohonan->gred_angka_nombor }})</strong></td>
                </tr>
                @php
                    $i = 2;
                @endphp
                @foreach ($allPermohonan as $index => $element)
                    @if ($element->rombongans_id == $permohonan->rombongans_id)
                        <tr>
                            <td class="text-center"><strong> {{ $i++ }}</strong></td>
                            <td class="text-left"><strong> {{ $element->nama }}</strong> </td>
                            <td><strong> {{ $element->nokp }}</strong></td>
                            <td><strong>  {{ $element->namaJawatan }} ({{ $element->gred_kod_abjad }}{{ $element->gred_angka_nombor }})</strong></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table> <br>
        <strong>Tarikh Permohonan : {{ \Carbon\Carbon::parse($tarikhmohon)->format('d F Y') }}</strong>
        {{-- <table class="table table-bordered table-sm">
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
                    </td>
                </tr>
            </tbody>
        </table> --}}
        <br>
        <div class="text-center">
            <p>
                <i> *Borang ini janaan komputer dan tidak memerlukan tandatangan*</i>
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
