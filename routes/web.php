<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/','HomeController@index')->name('home');
Route::get('registerBaru', 'permohonanController@registerBaru')->name('registerBaru');
Route::get('registerForm/{id}', 'permohonanController@show')->name('registerForm');

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/', 'permohonanController@index2')->name('halamanUtama');
	Route::get('kemaskini-permohonan-individu/{id}', 'permohonanController@kemaskiniPermohonan');
	// Route::POST('/proLogin','LoginController@proLogin');
	// Route::get('/home','HomeController@index');//untuk login../home
	Route::get('profil', 'AdminController@profil')->name('profil');
	Route::POST('kemaskini-profil', 'AdminController@kemaskiniprofil')->name('kemaskiniprofil');
	Route::POST('kemaskini-katalaluan', 'AdminController@kemaskinikatalaluan')->name('kemaskinikatalaluan');
	Route::POST('tukar-password', 'PermohonanController@tukarkatalaluan')->name('kemaskinikatalaluan');
	//untuk individu
	Route::get('registerFormIndividu/{typeForm}', 'permohonanController@individu')->name('registerFormIndividu');
	Route::get('sertai-rombongan', 'permohonanController@individuRombongan')->name('sertai-rombongan');
	
	//untuk rombongan
	Route::get('permohonan-rombongan', 'permohonanController@rombongan')->name('permohonan-rombongan');
	//Route::get('senaraiPermohonan/{id}','permohonanController@senarai')->name('senaraiPermohonan');
	Route::POST('daftarPermohonan/{id}', 'permohonanController@store');
	
	Route::POST('daftarPermohonanIndividuRombongan/{id}', 'permohonanController@storeIndividuRombongan');
	Route::POST('daftarPermohonanRombongan/{id}', 'permohonanController@storeRombongan');
	Route::POST('updatePermohonan/{id}', 'permohonanController@updatePermohonan');
	
	
	Route::get('keputusan-rombongan', 'permohonanController@senaraiPermohonanRombongan')->name('keputusan-rombongan');
	Route::get('keputusan-permohonan', 'permohonanController@senaraiPermohonanIndividu')->name('keputusan-permohonan');
	Route::get('senaraiPermohonanProses', 'permohonanController@senaraiPermohonanProses')->name('senaraiPermohonanProses');
	
	// Route::get('/senaraiPermohonan/{id}',[
	// 	// 'middleware' =>'admin',
	// 	'uses'=>'permohonanController@senarai']);
	
	Route::get('hantar-permohonan-individu/{id}', 'permohonanController@hantarIndividu');
	
	Route::get('/hantarRombongan/{id}', 'permohonanController@hantarRombongan');
	
	Route::get('/padam/{id}', 'permohonanController@hapus');
	
	Route::get('/tolak-permohonan/{id}', 'permohonanController@tolakrombongan');
	
	Route::get('/senaraiPermohonan/{id}/edit', 'permohonanController@editIndividu')->name('editPermohonan.edit');
	
	Route::get('/padam-rombongan/{id}', 'permohonanController@padamrombongan');
	
	Route::get('/padam-permohonan/{id}', 'permohonanController@tamatIndividu');
	
	// Route::get('/tolak-permohonan/{id}', 'permohonanController@tolakIndividu');

	Route::get('padam-dokumen-cuti/{id}','permohonanController@deleteFileCuti')->name('detailPermohonan.deleteFileCuti');
	Route::get('padam-dokumen-rasmi/{id}', 'permohonanController@deleteFileRasmi')->name('detailPermohonan.deleteFileRasmi');

	// ------------------------admin----------------------
	Route::get('senaraiPending', 'AdminController@index')->name('senaraiPending');
	Route::get('senaraiRekodIndividu', 'AdminController@senaraiRekodIndividu')->name('senaraiRekodIndividu');
	Route::get('senaraiPendingRombongan', 'AdminController@indexRombongan')->name('senaraiPendingRombongan');
	Route::get('senaraiRekodRombongan', 'AdminController@senaraiRekodRombongan')->name('senaraiRekodRombongan');
	Route::post('/sebab', 'AdminController@sebab');
	
	Route::post('/sebabRombongan', 'AdminController@sebabRombongan');
	
	Route::get('/senaraiPending/{id}/hantar', 'AdminController@hantar')->name('senaraiPending.hantar');
	
	Route::get('/senaraiPendingRombongan/{id}/sent-Permohonan', 'AdminController@hantarRombo');
	
	Route::get('detailPermohonan/{id}/download', 'AdminController@download')->name('detailPermohonan.download');
	Route::get('detailPermohonanDokumen/{id}/download', 'AdminController@downloadDokumen')->name('detailPermohonanDokumen.download');
	
	Route::get('detailPermohonan/{id}', 'AdminController@show');
	Route::get('detailPermohonanRombongan/{id}', 'AdminController@showRombongan');
	
	Route::get('/images/{name}', 'AdminController@gambar');
	
	Route::get('kemaskini-rombongan/{id}', 'AdminController@editPaparanRombongan');
	Route::post('kemaskini-rombongan', 'AdminController@kemaskinirombongan');
	
	Route::get('daftarPic', 'AdminController@daftarPic')->name('daftarPic');
	
	Route::POST('daftarJabatan', 'AdminController@daftarJabatan')->name('daftarJabatan');
	Route::POST('kemaskiniDataPengguna', 'AdminController@kemaskiniDataPengguna')->name('kemaskiniDataPengguna');
	Route::get('senaraiPic', 'AdminController@senaraiPic')->name('senaraiPic');
	Route::get('senaraiPengguna', 'AdminController@senaraiPengguna')->name('senaraiPengguna');
	Route::get('senaraiPIC/{id}/edit', 'AdminController@editPIC');
	Route::get('kemaskini-pengguna/{id}', 'AdminController@kemaskiniPengguna');
	Route::get('reset-kata-laluan/{id}', 'AdminController@resetKatalaluan');
	
	
	Route::PUT('senaraiPIC/{id}', 'AdminController@updateDataPIC');
	
	//Konfigurasi------------------------------------------------------------------------------
	Route::get('senaraiJabatan', 'AdminController@senaraiJabatan')->name('senaraiJabatan');
	Route::get('tambahJabatan', 'AdminController@tambahJabatan')->name('tambahJabatan');
	Route::POST('prosesTambahJab', 'AdminController@prosesTambahJab')->name('prosesTambahJab');
	Route::get('senaraiJawatan', 'AdminController@senaraiJawatan')->name('senaraiJawatan');
	Route::get('tambahJawatan', 'AdminController@tambahJawatan')->name('tambahJawatan');
	Route::POST('prosesTambahJaw', 'AdminController@prosesTambahJaw')->name('prosesTambahJaw');
	Route::get('senaraiGredAngka', 'AdminController@senaraiGredAngka')->name('senaraiGredAngka');
	Route::get('tambahGredAngka', 'AdminController@tambahGredAngka')->name('tambahGredAngka');
	Route::POST('prosesTambahGredAngka', 'AdminController@prosesTambahGredAngka')->name('prosesTambahGredAngka');
	Route::get('senaraiGredKod', 'AdminController@senaraiGredKod')->name('senaraiGredKod');
	Route::get('tambahGredKod', 'AdminController@tambahGredKod')->name('tambahGredKod');
	Route::POST('prosesTambahGredKod', 'AdminController@prosesTambahGredKod')->name('prosesTambahGredKod');
	
	Route::get('terusDato', 'AdminController@terusDato')->name('terusDato');
	Route::get('tambahterusDato', 'AdminController@tambahterusDato')->name('tambahterusDato');
	Route::POST('prosesTambahterusDato', 'AdminController@prosesTambahterusDato')->name('prosesTambahterusDato');
	Route::get('padamTerusDato/{id}', 'AdminController@padamTerusDato')->name('padamTerusDato');
	Route::get('infoSurat', 'AdminController@infoSurat')->name('infoSurat');
	
	Route::POST('prosesTambahCoganKata', 'AdminController@prosesTambahCoganKata')->name('prosesTambahCoganKata');
	Route::POST('prosesTambahNamaPenolongPengarah', 'AdminController@prosesTambahNamaPenolongPengarah')->name('prosesTambahNamaPenolongPengarah');
	
	//laporan
	Route::get('laporanDato', 'AdminController@laporanDato')->name('laporanDato');
	Route::get('laporanLP/{tahun}', 'PdfController@laporanLP')->name('laporanLP');
	Route::get('laporan-jantina', 'AdminController@laporanjantina')->name('laporan-jantina');
	Route::get('laporanJabatan/{tahun}', 'PdfController@laporanJabatan')->name('laporanJabatan');
	Route::get('laporan-jabatan', 'AdminController@laporanjabatan')->name('laporan-jabatan');
	Route::get('laporan-negara', 'AdminController@laporannegara')->name('laporan-negara');
	Route::get('laporanNegara/{tahun}', 'PdfController@laporanNegara')->name('laporanNegara');
	Route::get('laporanViewIndividu', 'PdfController@laporanViewIndividu')->name('laporanViewIndividu');
	Route::get('laporanBulanan/{tahun}', 'PdfController@laporanBulanan')->name('laporanBulanan');
	Route::get('laporan-bulanan', 'AdminController@laporanbulanan')->name('laporan-bulanan');
	Route::get('laporan-tahunan', 'AdminController@laporantahunan')->name('laporan-tahunan');
	Route::get('laporanTahunan', 'PdfController@laporanTahunan')->name('laporanTahunan');
	Route::get('laporan-individu', 'AdminController@laporanindividu')->name('laporan-individu');
	Route::get('butiran-individu/{id}', 'AdminController@butiranindividu')->name('butiran-individu');
	Route::get('laporanIndividu', 'PdfController@laporanIndividu')->name('laporanIndividu');
	
	Route::get('laporanViewBG', 'PdfController@laporanViewBG')->name('laporanViewBG');
	Route::POST('proViewBG', 'PdfController@proViewBG')->name('proViewBG');
	
	Route::get('laporanViewTahun', 'PdfController@laporanViewTahun')->name('laporanViewTahun');
	Route::POST('proViewTahun', 'PdfController@proViewTahun')->name('proViewTahun');
	
	//surat kelulusan
	Route::get('suratLulusRasmi/{id}', 'PdfController@suratLulusRasmi')->name('suratLulusRasmi');
	Route::get('suratLulusTidakRasmi/{id}', 'PdfController@suratLulusTidakRasmi')->name('suratLulusTidakRasmi');
	//memo
	Route::get('memoLulusRasmi/{id}', 'PdfController@memoLulusRasmi')->name('memoLulusRasmi');
	Route::get('memoTidakRasmi/{id}', 'PdfController@memoTidakRasmi')->name('memoTidakRasmi');
	
	// ------------------------dato----------------------
	
	Route::get('senarai-semak', 'KetuaController@index')->name('senarai-semak');
	Route::get('senaraiRombonganKetua', 'KetuaController@senaraiRombonganKetua')->name('senaraiRombonganKetua');
	
	Route::get('/senaraiPermohonan/{id}/hantar', 'KetuaController@hantar')->name('senaraiPermohonan.hantar');
	
	Route::get('/senaraiPermohonan/{id}/tolak-Permohonan', 'KetuaController@tolakPermohonan')->name('senaraiPermohonan.tolakPermohonan');
	
	Route::get('senaraiPermohonanDiluluskan', 'KetuaController@senaraiLulus')->name('senaraiPermohonanDiluluskan');
	
	Route::get('kelulusan/proses', 'KetuaController@editPermohonan');
	
	Route::get('luluskan-rombongan/{id}', 'KetuaController@ketuaSentRombongan');
	Route::get('tolak-rombongan/{id}', 'KetuaController@ketuaRejectRombongan');
	Route::get('cetak-butiran-rombongan/{id}', 'KetuaController@cetakRombongan')->name('cetak-butiran-rombongan');
	Route::get('cetak-butiran-permohonan/{id}', 'KetuaController@cetakPermohonan')->name('cetak-butiran-permohonan');
	
	Route::get('cetak-senarai-permohonan', 'KetuaController@cetakSenaraiPermohonan')->name('cetak-senarai-permohonan');
	Route::get('cetak-senarai-rombongan', 'KetuaController@cetakSenarairombongan')->name('cetak-senarai-rombongan');
	
	
	Route::get('ketua-tolak-permohonan/{id}', 'KetuaController@permohonanGagalKetua');
	
	Route::get('jumlahKeluarnegara', 'KetuaController@jumlahKeluarnegara')->name('jumlahKeluarnegara');
	
	// ----------------------------Admin Jabatan-------------------------------------------------------------
	
	Route::get('senaraiPermohonanJabatan', 'AdminController@senaraiPermohonanJabatan')->name('senaraiPermohonanJabatan');
	Route::get('senaraiPermohonanLepas', 'AdminController@senaraiPermohonanLepas')->name('senaraiPermohonanLepas');
	Route::get('daftarPenggunaJabatan', 'AdminController@daftarPenggunaJabatan')->name('daftarPenggunaJabatan');
	Route::get('senaraiPenggunaJabatan', 'AdminController@senaraiPenggunaJabatan')->name('senaraiPenggunaJabatan');
	Route::get('senaraiPermohonanJabatan/hantar', 'AdminController@hantarJabatan');
});
