@component('mail::message')
Tuan/Puan, <br>

#<u>PEMAKLUMAN KELULUSAN PERMOHONAN KELUAR NEGARA</u> 

Berikut adalah status kelulusan permohonan keluar negara ELN.
<br><br>
Nama: <strong>{{ $nama }}</strong> <br>
No Kad Pengenalan: <strong>{{ $nokp }}</strong> <br>
Negara: <strong>{{ $negara }} </strong> <br>
Tarikh Perjalan: <strong>{{ $tarikhMulaPerjalanan }}</strong>  <br>
Tarikh Kembali: <strong>{{ $tarikhAkhirPerjalanan }}</strong> <br>
Status Kelulusan: <strong>Diluluskan</strong>
<br>
<br>
Sekian, terima kasih. 
<br>
<br>
{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Yang menjalankan amanah,<br>
Sistem e-Luar Negara 
(SUK Negeri Kelantan)
@endcomponent
