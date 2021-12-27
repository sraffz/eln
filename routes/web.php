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
	Route::get('senaraiPermohonan/{id}/kemaskini', 'permohonanController@kemaskiniPermohonan');
	// Route::POST('/proLogin','LoginController@proLogin');
	// Route::get('/home','HomeController@index');//untuk login../home
	Route::get('profil', 'AdminController@profil')->name('profil');
	Route::POST('kemaskini-profil', 'AdminController@kemaskiniprofil')->name('kemaskiniprofil');
	Route::POST('kemaskini-katalaluan', 'AdminController@kemaskinikatalaluan')->name('kemaskinikatalaluan');
	//untuk individu
	Route::get('registerFormIndividu/{typeForm}', 'permohonanController@individu')->name('registerFormIndividu');
	Route::get('registerFormIndividuRombongan/{id}', 'permohonanController@individuRombongan')->name('registerFormIndividuRombongan');
	
	//untuk rombongan
	Route::get('registerFormRombangan/{id}', 'permohonanController@rombongan')->name('registerFormRombangan');
	//Route::get('senaraiPermohonan/{id}','permohonanController@senarai')->name('senaraiPermohonan');
	Route::POST('daftarPermohonan/{id}', 'permohonanController@store');
	
	Route::POST('daftarPermohonanIndividuRombongan/{id}', 'permohonanController@storeIndividuRombongan');
	Route::POST('daftarPermohonanRombongan/{id}', 'permohonanController@storeRombongan');
	Route::POST('updatePermohonan/{id}', 'permohonanController@updatePermohonan');
	
	
	Route::get('senaraiPermohonanRombongan/{id}', 'permohonanController@senaraiPermohonanRombongan')->name('senaraiPermohonanRombongan');
	Route::get('senaraiPermohonanIndividu/{id}', 'permohonanController@senaraiPermohonanIndividu')->name('senaraiPermohonanIndividu');
	Route::get('senaraiPermohonanProses/{id}', 'permohonanController@senaraiPermohonanProses')->name('senaraiPermohonanProses');
	
	// Route::get('/senaraiPermohonan/{id}',[
	// 	// 'middleware' =>'admin',
	// 	'uses'=>'permohonanController@senarai']);
	
	Route::get('/senaraiPermohonan/{id}/hantarIndividu', [
		// 'middleware' =>'admin',
		'uses' => 'permohonanController@hantarIndividu',
	]);
	
	Route::get('/hantarRombongan/{id}', 'permohonanController@hantarRombongan');
	
	Route::get('/padam/{id}', 'permohonanController@hapus');
	
	Route::get('/senaraiPermohonan/{id}/edit', [
		//'middleware' =>'admin',
		'uses' => 'permohonanController@editIndividu',
		'as' => 'editPermohonan.edit',
	]);
	
	Route::get('/senaraiPermohonan/{id}/tamat', [
		//'middleware' =>'admin',
		'uses' => 'permohonanController@tamat',
	]);
	
	Route::get('/senaraiPermohonan/{id}/tamat-individu', [
		//'middleware' =>'admin',
		'uses' => 'permohonanController@tamatIndividu',
	]);
	
	Route::get('detailPermohonan/{id}/deleteFileCuti', [
		//'middleware' =>'admin',
		'uses' => 'permohonanController@deleteFileCuti',
		'as' => 'detailPermohonan.deleteFileCuti',
	]);
	Route::get('detailPermohonan/{id}/deleteFileRasmi', [
		//'middleware' =>'admin',
		'uses' => 'permohonanController@deleteFileRasmi',
		'as' => 'detailPermohonan.deleteFileRasmi',
	]);
	// ------------------------admin----------------------
	Route::get('senaraiPending', 'AdminController@index')->name('senaraiPending');
	Route::get('senaraiRekodIndividu', 'AdminController@senaraiRekodIndividu')->name('senaraiRekodIndividu');
	Route::get('senaraiPendingRombongan', 'AdminController@indexRombongan')->name('senaraiPendingRombongan');
	Route::get('senaraiRekodRombongan', 'AdminController@senaraiRekodRombongan')->name('senaraiRekodRombongan');
	Route::post('/sebab', 'AdminController@sebab');
	
	Route::post('/sebabRombongan', 'AdminController@sebabRombongan');
	
	Route::get('/senaraiPending/{id}/hantar', [
		//'middleware' =>'admin',
		'uses' => 'AdminController@hantar',
		'as' => 'senaraiPending.hantar',
	]);
	
	Route::get('/senaraiPendingRombongan/{id}/sent-Permohonan', [
		//'middleware' =>'admin',
		'uses' => 'AdminController@hantarRombo',
	]);
	
	Route::get('detailPermohonan/{id}/download', [
		//'middleware' =>'admin',
		'uses' => 'AdminController@download',
		'as' => 'detailPermohonan.download',
	]);
	Route::get('detailPermohonanDokumen/{id}/download', [
		//'middleware' =>'admin',
		'uses' => 'AdminController@downloadDokumen',
		'as' => 'detailPermohonanDokumen.download',
	]);
	
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
	Route::get('laporanLP', 'PdfController@laporanLP')->name('laporanLP');
	Route::get('laporanJabatan', 'PdfController@laporanJabatan')->name('laporanJabatan');
	Route::get('laporanNegara', 'PdfController@laporanNegara')->name('laporanNegara');
	Route::get('laporanViewIndividu', 'PdfController@laporanViewIndividu')->name('laporanViewIndividu');
	Route::get('laporanBulanan', 'PdfController@laporanBulanan')->name('laporanBulanan');
	Route::POST('proViewIndividu', 'PdfController@proViewIndividu')->name('proViewIndividu');
	
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
	
	Route::get('semakkanDato', 'KetuaController@index')->name('semakkanDato');
	Route::get('senaraiRombonganKetua', 'KetuaController@senaraiRombonganKetua')->name('senaraiRombonganKetua');
	
	Route::get('/senaraiPermohonan/{id}/hantar', [
		//'middleware' =>'admin',
		'uses' => 'KetuaController@hantar',
		'as' => 'senaraiPermohonan.hantar',
	]);
	
	Route::get('/senaraiPermohonan/{id}/tolak-Permohonan', [
		//'middleware' =>'admin',
		'uses' => 'KetuaController@tolakPermohonan',
		'as' => 'senaraiPermohonan.tolakPermohonan',
	]);
	
	Route::get('senaraiPermohonanDiluluskan', 'KetuaController@senaraiLulus')->name('senaraiPermohonanDiluluskan');
	
	Route::get('kelulusan/proses', 'KetuaController@editPermohonan');
	
	Route::get('senaraiRombonganKetua/{id}/sent-Rombongan', [
		//'middleware' =>'admin',
		'uses' => 'KetuaController@ketuaSentRombongan',
	]);
	
	Route::get('senaraiRombonganKetua/{id}/reject-Rombongan', [
		//'middleware' =>'admin',
		'uses' => 'KetuaController@ketuaRejectRombongan',
	]);
	
	Route::get('senaraiRombonganKetua/{id}/tolakPermohonan-individu', [
		//'middleware' =>'admin',
		'uses' => 'KetuaController@permohonanGagalKetua',
	]);
	
	Route::get('jumlahKeluarnegara', 'KetuaController@jumlahKeluarnegara')->name('jumlahKeluarnegara');
	
	// ----------------------------Admin Jabatan-------------------------------------------------------------
	
	Route::get('senaraiPermohonanJabatan', 'AdminController@senaraiPermohonanJabatan')->name('senaraiPermohonanJabatan');
	Route::get('senaraiPermohonanLepas', 'AdminController@senaraiPermohonanLepas')->name('senaraiPermohonanLepas');
	Route::get('daftarPenggunaJabatan', 'AdminController@daftarPenggunaJabatan')->name('daftarPenggunaJabatan');
	Route::get('senaraiPenggunaJabatan', 'AdminController@senaraiPenggunaJabatan')->name('senaraiPenggunaJabatan');
	Route::get('senaraiPermohonanJabatan/hantar', 'AdminController@hantarJabatan');
});
