<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Kelulusan</title>
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

    </style>
</head>

<body>
    <div id="watermark">
        <img src="{{ asset('adminlte/dist/img/letterhead.jpeg') }}" height="100%" width="100%" />
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="row"><br>
                <table class="table table-borderless table-sm">
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class="text-right" style="width: 53%">Ruj Kami</td>
                        <td style="width: 1%">:</td>
                        <td>
                            <strong>SUK.D.200 (06) 455/16 ELN.JLD.{{ $permohon->no_ruj_file }}
                                ( {{ $permohon->no_ruj_bil }} )</strong>
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
                                use Carbon\Carbon;
                                $tarikh = Carbon::parse($permohon->tarikhLulusan)->formatLocalized('%d %B %Y');
                            @endphp
                            <strong>{{ $tarikh }}
                            </strong>
                        </td>
                    </tr>
                </table><br><br>
                <div>Kemajlis,</div> <br>
                Ketua Jabatan <br>
                {{-- {{ ucwords(strtolower($surat->nama_penuh)) }} --}}<br>
                K/P : {{-- {!! formatKP($surat->no_kad_pengenalan) !!} --}}<br>
                alamat
                {{-- {!! ($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan1 != "") ? alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan1).",<br>" : "" !!}
                            {!! ($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan2 != "") ? alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan2).",<br>" : "" !!}
                            {!! ($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan3 != "") ? alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatan3).",<br>" : "" !!}
                            {!! $surat->calon_perkhidmatans->perkhidmatan_AlamatJabatanPoskod !!} {!! alamat($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatanBandar) !!},<br>
                            {!! negeri($surat->calon_perkhidmatans->perkhidmatan_AlamatJabatanNegeri) !!} --}}.<br>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                {{-- <p> @if ($surat->gelaran == 10 || $surat->gelaran == 11) @else {{ getGelaran($surat->gelaran) }} @endif {{ getPangkat($surat->pangkat) }} </p> --}}
                <p>YB. Dato’/ YM / YBhg. Dato’ / Tuan/ Puan,</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <strong>PERMOHONAN KEBENARAN KE LUAR NEGARA BAGI URUSAN PERSENDIRIAN PADA
                    {{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d/m/Y') }} HINGGA
                    {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d/m/Y') }} DI
                    {{ strtoupper($permohon->negara) }}.</strong>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xl-12">
                <div align="justify">
                    <strong>
                        NAMA
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ strtoupper($permohon->user->nama) }}<br>
                        NO. K/P
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                        {{ $permohon->user->nokp }}<br>
                        JAWATAN / GRED &nbsp;: {{ strtoupper($permohon->namaJawatan) }}
                        ({{ $permohon->user->userGredKod->gred_kod_abjad }}{{ $permohon->user->userGredAngka->gred_angka_nombor }})<br>
                        <br>
                    </strong>

                    Adalah saya dengan segala hormatnya diarah merujuk kepada perkara di atas.<br><br>
                    <div style="line-height: 1.6;">
                        2. Sukacita dimaklumkan bahawa permohonan bagi
                        <strong>{{ strtoupper($permohon->user->nama) }}</strong> untuk ke luar negara iaitu
                        ke <strong>{{ strtoupper($permohon->negara) }}</strong> bagi menghadiri urusan rasmi
                        tersebut pada
                        <strong>{{ \Carbon\Carbon::parse($permohon->tarikhMulaPerjalanan)->format('d F Y') }}
                            hingga
                            {{ \Carbon\Carbon::parse($permohon->tarikhAkhirPerjalanan)->format('d F Y') }}</strong>
                        adalah telah <strong>diluluskan.</strong>
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

                    Saya yang menjalankan amanah,<br><br><br><br>

                    <strong>( {{ $pp->maklumat1 }} )</strong><br>
                    {{ $pp->maklumat2 }}<br>
                    <strong>{{ $pp->maklumat3 }}</strong><br>
                    <strong>{{ $pp->maklumat4 }}</strong><br>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
