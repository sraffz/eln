@component('mail::message')
# e-Luar Negara: Permohonan Keluar Negara

Dukacita dimaklumkan bahawa permohonan ke luar negara tuan/puan tidak dapat dipertimbangkan.
Berikut merupakan butiran perjalanan ke luar negara tuan/puan: 

Negara: <strong>{{ $negara }} </strong> <br>
Tarikh Perjalan: <strong>{{ $tarikhMulaPerjalanan }}</strong>  <br>
Tarikh Kembali: <strong>{{ $tarikhAkhirPerjalanan }}</strong> <br>
Nama: <strong>{{ $nama }}</strong> <br>
No Kad Pengenalan: <strong>{{ $nokp }}</strong> <br>
Status Permohonan: <strong>Tidak Berjaya</strong>

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Yang menjalankan amanah,<br>
Sistem e-Luar Negara 
(SUK Negeri Kelantan)
@endcomponent
