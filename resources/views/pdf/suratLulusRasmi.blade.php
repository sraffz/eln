<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Surat Rasmi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/dist/css/adminlte.min.css') }}">

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
            margin-top: 4cm;
            margin-bottom: 1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            font-family: Arial, Helvetica, sans-serif;
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

        .table tr td {

        }

    </style>
</head>

<body>

    {{-- format surat --}}
    <div id="watermark">
        <img src="{{ asset('adminlte/dist/img/letterhead.jpeg') }}" height="100%" width="100%" />
    </div>
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <br>
                            <br>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    {{-- <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td> --}}
                                    <td class="text-right" style="width: 55%">Ruj Kami</td>
                                    <td style="width: 1%">:</td>
                                    <td>
                                        <strong>SUK.D.200 (06) 455/16 ELN.JLD.{{ $permohon->no_ruj_file }}
                                            ({{ $permohon->no_ruj_bil }})</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">Tarikh</td>
                                    <td>:</td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($permohon->tarikhLulusan)->format('d  M  Y') }}
                                        </strong>
                                    </td>
                                </tr>
                            </table>

                            <div>Kemajlis,</div> <br>
                            Ketua Jabatan <br>
                            {{-- {{ ucwords(strtolower($surat->nama_penuh)) }} --}} 
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
                        <div class="col-md-12">
                            {{-- <p> @if ($surat->gelaran == 10 || $surat->gelaran == 11) @else {{ getGelaran($surat->gelaran) }} @endif {{ getPangkat($surat->pangkat) }} </p> --}}
                            <p>YB. Dato’/ YM / YBhg. Dato’ / Tuan/ Puan,</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <strong>PERMOHONAN KEBENARAN KE LUAR NEGARA BAGI URUSAN RASMI UNTUK MENGHADIRI
                                {{ strtoupper($permohon->lainTujuan) }} PADA
                                {{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d/m/Y') }} HINGGA
                                {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d/m/Y') }} DI
                                {{ strtoupper($permohon->negara) }}</strong>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <table class="table table-borderless table-sm">
                                <tbody style="font-weight: bold">
                                    <tr>
                                        <td scope="row">NAMA</td>
                                        <td>:</td>
                                        <td>{{ strtoupper($permohon->user->nama) }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">NO. K/P</td>
                                        <td>:</td>
                                        <td>{{ $permohon->user->nokp }}</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">JAWATAN / GRED</td>
                                        <td>:</td>
                                        <td>{{ strtoupper($permohon->namaJawatan) }}
                                            ({{ $permohon->user->userGredKod->gred_kod_abjad }}{{ $permohon->user->userGredAngka->gred_angka_nombor }})</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div align="justify">
                                {{-- <strong>
                                    NAMA
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    {{ strtoupper($permohon->user->nama) }}<br>
                                    NO. K/P
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                    {{ $permohon->user->nokp }}<br>
                                    JAWATAN / GRED &nbsp;: {{ strtoupper($permohon->namaJawatan) }}
                                    ({{ $permohon->user->userGredKod->gred_kod_abjad }}{{ $permohon->user->userGredAngka->gred_angka_nombor }})<br>
                                    <br>
                                </strong> --}}

                                Adalah saya dengan segala hormatnya diarah merujuk kepada perkara di atas.<br><br>
                                <div style="line-height: 1.2;">
                                    2. Sukacita dimaklumkan bahawa permohonan bagi
                                    <strong>{{ strtoupper($permohon->user->nama) }}</strong> untuk ke luar negara
                                    iaitu ke <strong>{{ strtoupper($permohon->negara) }}</strong> bagi menghadiri
                                    urusan rasmi tersebut pada
                                    <strong>{{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d F Y') }}
                                        hingga
                                        {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d F Y') }}</strong>
                                    telah <strong>diluluskan.</strong>
                                </div> <br>

                                Sekian, terima kasih.<br> 

                                <strong> "{{ $cogan->maklumat1 }}"</strong><br>
                                @if ($cogan->maklumat2 != null)
                                    <strong> "{{ $cogan->maklumat2 }}"</strong><br>
                                @endif
                                @if ($cogan->maklumat3 != null)
                                    <strong> "{{ $cogan->maklumat3 }}"</strong><br>
                                @endif
                                <br>
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

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
