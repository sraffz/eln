<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Surat Kelulusan Rombongan </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ asset('adminlte-3/dist/css/adminlte.min.css') }}"> --}}
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
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }

        /**
            * Define the width, height, margins and position of the watermark.
            **/
        #watermark {
            position: fixed;
            bottom: 0px;
            left: 0px;
            /** The width and height may change
                    according to the dimensions of your letterhead
                **/
            width: 21.8cm;
            height: 29cm;

            /** Your watermark should be behind every content**/
            z-index: -1000;
        }

        .break {
            page-break-before: always;
        }

        #table td,
        #table th {
            border: 1px solid rgb(54, 54, 54);
            padding: 5px;
            font-size: 12px;
        }

        #thead-dark {
            background: rgb(41, 41, 41);
            color: rgb(255, 255, 255);
        }

        table {
            border-collapse: collapse;
        }

    </style>
</head>

<body>
    {{-- format surat --}}
    <div class="row">
        <div id="watermark">
            <img src="{{ asset('adminlte-3/img/letterhead.jpg') }}" height="100%" width="96%" />
        </div>
        <div class="page">
            <div class="container">
                <div class="col-md-12">
                    <div class="row">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <table class="">
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td class="text-right" style="width: 53%">Ruj
                                    Kami&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td style="width: 1%">:</td>
                                <td>
                                    SUK.D.200 (06) 455/16-4.Jld {{ $kelulusan->jld_surat_rombongan }}
                                    ({{ $kelulusan->no_surat_rombongan }})
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Tarikh</td>
                                <td>:</td>
                                <td>
                                    @php
                                        const monthNames = ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'];
                                        
                                        
                                        use Carbon\Carbon;
                                        
                                        $bulan = monthNames[Carbon::parse($kelulusan->tarikh_kelulusan)->month - 1];
                                        $tahun = Carbon::parse($kelulusan->tarikh_kelulusan)->year;
                                        $hari = Carbon::parse($kelulusan->tarikh_kelulusan)->day;
                                        
                                        // $tarikh = Carbon::parse($kelulusan->tarikh_kelulusan)->formatLocalized('%d %B %Y');
                                        
                                    @endphp
                                    {{ $hari }} {{ $bulan }} {{ $tahun }}
                                </td>
                            </tr>
                        </table>
                    </div><br>
                    Ke majlis, <br><br>
                    {{ $kelulusan->jawatan_ketua }} <br>
                    {{ $kelulusan->nama_jabatan }} <br>
                    {{ $kelulusan->alamat }},<br>
                    {{ $kelulusan->poskod }} {{ $kelulusan->daerah }}, <br>
                    {{ $kelulusan->negeri }}.
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <p> @if ($surat->gelaran == 10 || $surat->gelaran == 11) @else {{ getGelaran($surat->gelaran) }} @endif {{ getPangkat($surat->pangkat) }} </p> --}}
                            <p>YB.Dato'/ YBhg. Dato'/ YM Tengku/ Tuan / Puan,</p>
                        </div>
                    </div>
                    @php
                        $bulanMula = monthNames[Carbon::parse($permohon->tarikhMulaRom)->month - 1];
                        $tahunMula = Carbon::parse($permohon->tarikhMulaRom)->year;
                        $hariMula = Carbon::parse($permohon->tarikhMulaRom)->day;

                        $bulanAkhir = monthNames[Carbon::parse($permohon->tarikhAkhirRom)->month - 1];
                        $tahunAkhir = Carbon::parse($permohon->tarikhAkhirRom)->year;
                        $hariAkhir = Carbon::parse($permohon->tarikhAkhirRom)->day;
                    @endphp
                    <div class="row">
                        <div class="col-md-12" style="text-transform: uppercase; text-align: justify;">
                            <strong>PERMOHONAN KEBENARAN KE LUAR NEGARA Secara rombongan bagi tujuan
                                {{ $permohon->tujuanRom }}
                                {{ strtoupper($permohon->lainTujuan) }} PADA
                                {{ $hariMula }} {{ $bulanMula }} {{ $tahunMula }}
                                HINGGA
                                {{ $hariAkhir }} {{ $bulanAkhir }} {{ $tahunAkhir }}
                                DI
                                {{ strtoupper($permohon->negaraRom) }}
                            </strong>
                        </div>
                    </div><br>
                    <div class="row">
                        <div align="justify">
                            Dengan segala hormatnya saya diarah merujuk kepada perkara di atas.<br><br>
                            <div style="line-height: 1.0;">
                                2.

                                @if ($permohon->statusPermohonanRom == 'Permohonan Berjaya')
                                    Sukacita
                                @elseif ($permohon->statusPermohonanRom == 'Permohonan Gagal')
                                    Dukacita
                                @endif

                                dimaklumkan bahawa permohonan tuan bagi <strong>{{ $bilpeserta }}
                                    orang</strong> pegawai sebagaimana senarai di lampiran untuk ke luar
                                negara
                                iaitu ke <strong>{{ strtoupper($permohon->negaraRom) }}</strong> bagi
                                tujuan {{ $permohon->tujuanRom }}
                                <strong>pada
                                    {{ $hariMula }} {{ $bulanMula }} {{ $tahunMula }}
                                    hingga
                                    {{ $hariAkhir }} {{ $bulanAkhir }} {{ $tahunAkhir }}

                                @if ($permohon->statusPermohonanRom == 'Permohonan Berjaya')
                                    telah <strong>diluluskan.</strong>
                                @elseif ($permohon->statusPermohonanRom == 'Permohonan Gagal')
                                    adalah <strong>tidak dapat dipertimbangkan.</strong>
                                @endif
                            </div><br>

                            Sekian, terima kasih.<br><br>

                            <strong> "{{ $cogan->maklumat1 }}"</strong><br>
                            @if ($cogan->maklumat2 != null)
                                <strong> "{{ $cogan->maklumat2 }}"</strong><br>
                            @endif
                            @if ($cogan->maklumat3 != null)
                                <strong> "{{ $cogan->maklumat3 }}"</strong><br>
                            @endif
                            <br>
                            Saya yang menjalankan amanah,<br>
                            <br>
                            <br>
                            <strong>({{ $pp->maklumat1 }})</strong><br>
                            {{ $pp->maklumat2 }}<br>
                            <strong>{{ $pp->maklumat3 }}</strong><br>
                            <strong>{{ $pp->maklumat4 }}</strong><br>
                        </div>
                        <br>
                        <br>
                        <div>
                            <p style="font-size: 11pt" align="center">
                                Surat ini adalah cetakan komputer dan tidak memerlukan tandatangan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="break">
            <div style="text-align: center; text-transform:uppercase;">
                <h3>SENARAI PEGAWAI DAN KAKITANGAN MENYERTAI ROMBONGAN KE {{ $permohon->negaraRom }} pada
                    {{ $hariMula }} {{ $bulanMula }} {{ $tahunMula }}
                    hingga
                    {{ $hariAkhir }} {{ $bulanAkhir }} {{ $tahunAkhir }}</strong></h3>
            </div>
            <table id="table" class="table" style="width: 100%" bordercolor="#ff0000">
                <thead style="text-align: center" id="thead-dark">
                    <tr>
                        <th><strong>BIL</strong> </th>
                        <th><strong>NAMA</strong> </th>
                        <th><strong>NO. KP</strong> </th>
                        <th><strong>JAWATAN & GRED</strong> </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td style="text-align: center"><strong>1</strong></td>
                        <td class="text-left"><strong>{{ $permohon->nama }} <br> (Ketua Rombongan)</strong></td>
                        <td style="text-align: center"><strong>{{ $permohon->nokp }}</strong></td>
                        <td><strong>{{ $permohon->namaJawatan }}
                                ({{ $permohon->gred_kod_abjad }}{{ $permohon->gred_angka_nombor }})</strong>
                        </td>
                    </tr> --}}
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($allPermohonan as $index => $element)
                        @if ($element->rombongans_id == $permohon->rombongans_id)
                            <tr>
                                <td style="text-align: center"><strong> {{ $i++ }}</strong></td>
                                <td class="text-left">
                                    <strong>
                                        {{ $element->nama }} <br>
                                        @if ($permohon->ketua_rombongan == $element->usersID)
                                            (Ketua Rombongan)
                                        @endif
                                    </strong>
                                </td>
                                <td style="text-align: center"><strong> {{ $element->nokp }}</strong></td>
                                <td><strong> {{ $element->namaJawatan }}
                                        ({{ $element->gred }})</strong>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
