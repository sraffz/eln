<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Senarai Permohonan Keluar Negara</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>       
        .table tr td {
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
        }
        
        .table tr th {
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 style="text-transform: uppercase">Senarai Permohonan Perjalanan Pegawai Awam Ke Luar Negara Secara
                    Individu</h3>
                <br>
                <br>
                <table class="table table-bordered table-sm">
                    <thead class="thead-dark">
                        <tr style="text-transform: uppercase" class="text-center">
                            <th rowspan="2">Bil</th>
                            <th rowspan="2">Nama</th>
                            <th rowspan="2">Jabatan</th>
                            <th rowspan="2">Tarikh Permohonan</th>
                            <th rowspan="2">Negara</th>
                            <th rowspan="2">Tarikh Mula Perjalanan</th>
                            <th rowspan="2">Jenis Permohonan</th>
                            <th colspan="2">Tindakan</th>
                        </tr>
                        <tr class="text-center">
                            <th style="vertical-align: middle; width: 8%">Diluluskan</th>
                            <th style="vertical-align: middle; width: 8%">Tidak Diluluskan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonan as $index => $mohonan)
                            <tr class="text-center">
                                <td> {{ $index + 1 }}</td>
                                <td class="text-left" style="text-transform: uppercase">
                                    {{ $mohonan->user->nama }}
                                </td>
                                <td>{{ $mohonan->user->userJabatan->kod_jabatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($mohonan->user->created_at)->format('d/m/Y') }}
                                </td>
                                <td>{{ $mohonan->negara }}</td>
                                <td>{{ \Carbon\Carbon::parse($mohonan->tarikhMulaPerjalanan)->format('d/m/Y') }}
                                </td>
                                <td>{{ $mohonan->JenisPermohonan }}</td>
                                <td>
                                    <span style="font-size:30px; padding-left:30px;border:1px solid #000;">&nbsp;</span>
                                </td>
                                <td>
                                    <span style="font-size:30px; padding-left:30px;border:1px solid #000;">&nbsp;</span>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
</body>

</html>
