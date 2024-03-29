<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permohonan;
use App\Pasangan;
use App\Rombongan;
use App\Sebab;
use App\Dokumen;
use App\Negara;
use App\User;
use App\Jabatan;
use App\Jawatan;
use App\GredAngka;
use App\InfoSurat;
use App\GredKod;
use DB;
use App\ELN_Pindaan;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;
use PDF;
use Auth;

class PdfController extends Controller
{
    public function suratLulusRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('jabatan', 'jabatan.jabatan_id', '=', 'users.jabatan')
            ->where('permohonansID', '=', $id)
            ->first();

        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $ketua = DB::table('senarai_pengesahan_kelulusan_permohonan')
        ->where('permohonansID', $id)
        ->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');
       
        // return view('pdf.suratLulusRasmi',compact('permohon', 'pp', 'cogan', 'ketua'));
        $pdf = PDF::loadView('pdf.suratLulusRasmi', compact('permohon', 'pp', 'cogan', 'ketua'))->setPaper('a4', 'portrait');
        return $pdf->stream('Surat Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
        // return $pdf->stream('Surat Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function suratLulusTidakRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('jabatan', 'jabatan.jabatan_id', '=', 'users.jabatan')
            ->where('permohonansID', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $ketua = DB::table('senarai_pengesahan_kelulusan_permohonan')
        ->where('permohonansID', $id)
        ->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.suratLulusTidakRasmi',compact('permohon', 'pp', 'cogan', 'ketua'));
        $pdf = PDF::loadView('pdf.suratLulusTidakRasmi', compact('permohon', 'pp', 'cogan', 'ketua'))->setPaper('a4', 'portrait');
        return $pdf->stream('Surat Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function memoLulusRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('jabatan', 'jabatan.jabatan_id', '=', 'users.jabatan')
            ->where('permohonansID', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $ketua = DB::table('senarai_pengesahan_kelulusan_permohonan')
        ->where('permohonansID', $id)
        ->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');
        // return view('pdf.memoLulusRasmi',compact('permohon','pp','cogan','ketua'));
        $pdf = PDF::loadView('pdf.memoLulusRasmi', compact('permohon','pp','cogan', 'ketua'))->setPaper('a4', 'portrait');
        return $pdf->stream('Memo Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
        // return $pdf->setPaper('a4', 'potrait')->stream('Borang Permohonan ' . $permohonan->nama_jawatan . ' ' . $permohonan->no_siri . '.pdf');

    }

    public function memoTidakRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('jabatan', 'jabatan.jabatan_id', '=', 'users.jabatan')
            ->where('permohonansID', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $ketua = DB::table('senarai_pengesahan_kelulusan_permohonan')
        ->where('permohonansID', $id)
        ->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.memoLulusTidakRasmi',compact('permohon','pp','cogan', 'ketua'));
        $pdf = PDF::loadView('pdf.memoLulusTidakRasmi', compact('permohon','pp','cogan', 'ketua'))->setPaper('a4', 'portrait');
        return $pdf->stream('Memo Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function suratrombongan($id)
    {
        $permohon = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('gred_angka', 'users.gredAngka', '=', 'gred_angka.gred_angka_ID')
            ->leftjoin('gred_kod', 'users.gredKod', '=', 'gred_kod.gred_kod_ID')
            ->leftjoin('jabatan', 'jabatan.jabatan_id', '=', 'users.jabatan')
            ->where('rombongans.rombongans_id', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        
        if ($permohon->statusPermohonanRom == 'Permohonan Berjaya') {
            $bilpeserta = DB::table('senarai_nama_rombongan')
            ->where('rombongans_id', $id)
            ->where('status_kelulusan', 'Berjaya')
            ->count();

            $allPermohonan = DB::table('senarai_data_permohonan')->select('*', \DB::raw('SUBSTRING(gred, -2) as gred_pendek'))
            ->where('rombongans_id', $id)
            ->whereIn('status_kelulusan', ['Berjaya'])
            ->orderBy('gred_pendek', 'DESC')
            ->get();

        } elseif ($permohon->statusPermohonanRom == 'Permohonan Gagal'){
            $bilpeserta = DB::table('senarai_nama_rombongan')
            ->where('rombongans_id', $id)
            ->whereIn('status_kelulusan', ['Berjaya', 'Gagal'])
            ->count();

            $allPermohonan = DB::table('senarai_data_permohonan')->select('*', \DB::raw('SUBSTRING(gred, -2) as gred_pendek'))
            ->where('rombongans_id', $id)
            ->whereIn('status_kelulusan', ['Berjaya', 'Gagal'])
            ->orderBy('gred_pendek', 'DESC')
            ->get();
        }
        

        // return dd($bilpeserta);

            $allPermohonan = DB::table('senarai_data_permohonan')->select('*', \DB::raw('SUBSTRING(gred, -2) as gred_pendek'))
            ->where('rombongans_id', $id)
            ->whereIn('status_kelulusan', ['Berjaya', 'Gagal'])
            ->orderBy('gred_pendek', 'DESC')
            ->get();


        $kelulusan = DB::table('senarai_data_permohonan_rombongan')->where('rombongans_id', $id)
        ->first();

        // return dd($bil);

        $nama = $permohon->nama;
        $negara = $permohon->negara;

        // return view('pdf.surat-rombongan',compact('kelulusan','hari','tarikh', 'permohon','pp','cogan','bilpeserta', 'allPermohonan'));
        $pdf = PDF::loadView('pdf.surat-rombongan', compact('kelulusan', 'permohon','pp','cogan','bilpeserta', 'allPermohonan'))->setPaper('a4', 'portrait');
        return $pdf->stream('Surat Kelulusan untuk Rombongan ke' . $negara . '.pdf');
    
    }

    public function memorombongan($id)
    {
        $permohon = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('gred_angka', 'users.gredAngka', '=', 'gred_angka.gred_angka_ID')
            ->leftjoin('gred_kod', 'users.gredKod', '=', 'gred_kod.gred_kod_ID')
            ->leftjoin('jabatan', 'jabatan.jabatan_id', '=', 'users.jabatan')
            ->where('rombongans.rombongans_id', '=', $id)
            ->first();

        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();

        if ($permohon->statusPermohonanRom == 'Permohonan Berjaya') {
            $bilpeserta = DB::table('senarai_nama_rombongan')
            ->where('rombongans_id', $id)
            ->where('status_kelulusan', 'Berjaya')
            ->count();

            $allPermohonan = DB::table('senarai_data_permohonan')->select('*',\DB::raw('SUBSTRING(gred, -2) as gred_pendek'))
                ->where('rombongans_id', $id)
                ->whereIn('status_kelulusan', ['Berjaya'])
                ->orderBy('gred_pendek', 'DESC')
                ->get();

        } elseif ($permohon->statusPermohonanRom == 'Permohonan Gagal'){
            $bilpeserta = DB::table('senarai_nama_rombongan')
            ->where('rombongans_id', $id)
            ->count();

            $allPermohonan = DB::table('senarai_data_permohonan')->select('*',\DB::raw('SUBSTRING(gred, -2) as gred_pendek'))
                ->where('rombongans_id', $id)
                ->whereIn('status_kelulusan', ['Berjaya', 'Gagal'])
                ->orderBy('gred_pendek', 'DESC')
                ->get();
        }


        // dd($allPermohonan->all());
        // return dd($bil);

        $nama = $permohon->nama;
        $negara = $permohon->negara;

        $kelulusan = DB::table('senarai_data_permohonan_rombongan')->where('rombongans_id', $id)
        ->first();

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.memo-rombongan',compact('kelulusan','permohon','pp','cogan', 'bilpeserta','allPermohonan'));
        $pdf = PDF::loadView('pdf.memo-rombongan', compact('kelulusan','permohon','pp','cogan', 'bilpeserta', 'allPermohonan'))->setPaper('a4', 'portrait');
        return $pdf->stream('MEMO Kelulusan untuk Rombongan ke ' . $negara . '.pdf');
    
    }

    public function laporanLP($tahun)
    {
        // $year = '2021';

        $countLBerjaya = Permohonan::with('user')
            ->where('statusPermohonan', 'Permohonan Berjaya')
            ->whereYear('tarikhMulaPerjalanan', $tahun)
            ->whereHas('user', function ($q) {
                $q->where('jantina', 'Lelaki');
            })
            ->count();

        $countPBerjaya = Permohonan::with('user')
            ->where('statusPermohonan', 'Permohonan Berjaya')
            ->whereYear('tarikhMulaPerjalanan', $tahun)
            ->whereHas('user', function ($q) {
                $q->where('jantina', 'Perempuan');
            })
            ->count();

        $countLGagal = Permohonan::with('user')
            ->where('statusPermohonan', 'Permohonan Gagal')
            ->whereYear('tarikhMulaPerjalanan', $tahun)
            ->whereHas('user', function ($q) {
                $q->where('jantina', 'Lelaki');
            })
            ->count();

        $countPGagal = Permohonan::with('user')
            ->where('statusPermohonan', 'Permohonan Gagal')
            ->whereYear('tarikhMulaPerjalanan', $tahun)
            ->whereHas('user', function ($q) {
                $q->where('jantina', 'Perempuan');
            })
            ->count();

        // return view('pdf.laporanLP',compact('countLBerjaya','countPBerjaya','countLGagal','countPGagal','year'));
        $pdf = PDF::loadView('pdf.laporanLP', ['countLBerjaya' => $countLBerjaya, 'countPBerjaya' => $countPBerjaya, 'countLGagal' => $countLGagal, 'countPGagal' => $countPGagal, 'tahun' => $tahun])->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan ELN Mengikut Jantina '.$tahun.'.pdf');
    }

    public function laporanindi($id)
    {
        $user = DB::table('butiran_keluar_negara_individu')
        ->where('usersID', $id)
        ->first();

        $negara = DB::table('butiran_keluar_negara_individu')
        ->where('usersID', $id)
        ->whereIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
        ->orderBy('tarikhMulaPerjalanan', 'desc')
        ->get();

        // return view('pdf.cetak-butiran-individu', compact('user','negara'));

        $pdf = PDF::loadView('pdf.cetak-butiran-individu', compact('user','negara'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Individu '.$user->nama.'.pdf');

    }

    public function laporanJabatan($tahun)
    {
        $list = DB::table('jumlah_jabatan_tahunan')
        ->where('tahun', $tahun)
        ->orderBy('jumlah', 'desc')
        ->get();
        
        // return view('pdf.laporanJabatan',compact('list', 'tahun'));
        $pdf = PDF::loadView('pdf.laporanJabatan', compact('list', 'tahun'))->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan ELN Mengikut Jabatan '.$tahun.'.pdf');
    }
    
    public function laporanNegara($tahun)
    {
        $list = DB::table('jumlah_mengikut_negara_tahunan')
        ->where('tahun', $tahun)
        ->orderBy('jumlah', 'desc')
        ->get();
        
        // return view('pdf.laporanNegara',compact('list', 'tahun'));
        $pdf = PDF::loadView('pdf.laporanNegara', compact('list', 'tahun'))->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan ELN Mengikut Negara '.$tahun.'.pdf');
    }
    

    public function laporanBulanan($tahun)
    {
        $year = $tahun;

        $bil = DB::table('jumlah_permohonan_bulanan_tahunan')
        ->where('tahun', $year)
        ->get();

        $jumlah = DB::table('jumlah_permohonan_bulanan_tahunan')
        ->where('tahun', $year)
        ->sum('bil');

        // return dd($year);

        // return view('pdf.laporanBulanan', compact('bil','year', 'jumlah'));
        $pdf = PDF::loadView('pdf.laporanBulanan', compact('bil','year', 'jumlah'))->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan Bulanan ELN '.$tahun.'.pdf');
    }

    public function laporanIndividu()
    {

        return view('pdf.laporanIndividu', compact('tahun'));
    }

    public function laporanViewBG()
    {
        return view('pdf.viewBG');
    }

    public function laporanTahunan()
    {
        $data = DB::table('jumlah_permohonan_tahunan')
        ->orderBy('tahun', 'desc')
        ->get();

        // return view('pdf.laporanTahunan', compact('data'));
        $pdf = PDF::loadView('pdf.laporanTahunan', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan ELN Mengikut Tahun.pdf');
    }

    public function proViewIndividu(request $request)
    {
        $ic = $request->input('ic');

        $infoUser = User::with('permohonan', 'userJawatan', 'userJabatan')
            ->where('nokp', $ic)
            ->first();
        // dd($infoUser);
        // return view('pdf.laporanIndividu',compact('infoUser'));
        $pdf = PDF::loadView('pdf.laporanIndividu', ['infoUser' => $infoUser])->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan Individu.pdf');
    }

    public function proViewBG(request $request)
    {
        $status = $request->input('status');

        $year = Carbon::now()->format('Y');

        $info = Permohonan::with('user')
            ->where('statusPermohonan', $status)
            ->whereYear('tarikhMulaPerjalanan', $year)
            ->get();
        // dd($info);
        // return view('pdf.laporanUmum',compact('info'));
        $pdf = PDF::loadView('pdf.laporanUmum', ['info' => $info])->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan Status.pdf');
    }

    public function proViewTahun(request $request)
    {
        $tahun = $request->input('tahun');

        $year = Carbon::now()->format('Y');

        $info = Permohonan::with('user')
            ->where('statusPermohonan', 'Permohonan Berjaya')
            ->whereYear('tarikhMulaPerjalanan', $tahun)
            ->get();
        // dd($info);
        // return view('pdf.laporanUmum',compact('info'));
        $pdf = PDF::loadView('pdf.laporanUmum', ['info' => $info])->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan Status.pdf');
    }

    public function manualpengguna()
    {
        $path = 'public/manual/panduan_pengguna_eln.pdf';

        return Storage::download($path);
    }
    
    public function manualpenggunaKetua()
    {
        $path = 'public/manual/panduan_pengguna_eln_ketua_jabatan.pdf';

        return Storage::download($path);
    }

    public function perananKetuaJabatan()
    {
        $path = 'public/manual/borang_akuan_ketua_jabatan.pdf';

        return Storage::download($path);
    }
}
