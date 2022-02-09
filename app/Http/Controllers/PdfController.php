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
use Carbon\Carbon;
use File;
use PDF;
use Auth;

class PdfController extends Controller
{
    public function suratLulusRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->where('permohonansID', '=', $id)
            ->first();

        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');
       
        // return view('pdf.suratLulusRasmi',compact('permohon','pp','cogan'));
        $pdf = PDF::loadView('pdf.suratLulusRasmi', compact('permohon', 'pp', 'cogan'))->setPaper('a4', 'portrait');
        return $pdf->download('Surat Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function suratLulusTidakRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->where('permohonansID', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.suratLulusTidakRasmi',compact('permohon','pp','cogan'));
        $pdf = PDF::loadView('pdf.suratLulusTidakRasmi', ['permohon' => $permohon, 'pp' => $pp, 'cogan' => $cogan])->setPaper('a4', 'portrait');
        return $pdf->download('Surat Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function memoLulusRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->where('permohonansID', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');
        // return view('pdf.memoLulusRasmi',compact('permohon','pp','cogan'));
        $pdf = PDF::loadView('pdf.memoLulusRasmi', ['permohon' => $permohon, 'pp' => $pp, 'cogan' => $cogan])->setPaper('a4', 'portrait');
        return $pdf->download('Memo Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function memoTidakRasmi($id)
    {
        $permohon = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->where('permohonansID', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();
        $nama = $permohon->user->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.memoLulusTidakRasmi',compact('permohon','pp','cogan'));
        $pdf = PDF::loadView('pdf.memoLulusTidakRasmi', ['permohon' => $permohon, 'pp' => $pp, 'cogan' => $cogan])->setPaper('a4', 'portrait');
        return $pdf->download('Memo Kelulusan untuk ' . $nama . ' ke ' . $negara . '.pdf');
    }

    public function suratrombongan($id)
    {
        $permohon = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('gred_angka', 'users.gredAngka', '=', 'gred_angka.gred_angka_ID')
            ->leftjoin('gred_kod', 'users.gredKod', '=', 'gred_kod.gred_kod_ID')
            ->where('rombongans.rombongans_id', '=', $id)
            ->first();
        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();

        $bilpeserta = Permohonan::where('rombongans_id', $id)
        ->where('statusPermohonan', 'Permohonan Berjaya')
        ->count();

        $allPermohonan = DB::table('senarai_data_permohonan')
            ->where('rombongans_id', $id)
            ->whereIn('status_kelulusan', ['Berjaya'])
            ->get();

        // return dd($bil);

        $nama = $permohon->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.surat-rombongan',compact('permohon','pp','cogan','bilpeserta', 'allPermohonan'));
        $pdf = PDF::loadView('pdf.surat-rombongan', compact('permohon','pp','cogan','bilpeserta', 'allPermohonan'))->setPaper('a4', 'portrait');
        return $pdf->download('Surat Kelulusan untuk Rombongan ke' . $negara . '.pdf');
    
    }

    public function memorombongan($id)
    {
        $permohon = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')
            ->leftjoin('gred_angka', 'users.gredAngka', '=', 'gred_angka.gred_angka_ID')
            ->leftjoin('gred_kod', 'users.gredKod', '=', 'gred_kod.gred_kod_ID')
            ->where('rombongans.rombongans_id', '=', $id)
            ->first();

        $pp = InfoSurat::where('perkara', '=', 'Penolong Pengarah')->first();

        $cogan = InfoSurat::where('perkara', '=', 'Cogan Kata')->first();

        $bilpeserta = Permohonan::where('rombongans_id', $id)
        ->where('statusPermohonan', 'Permohonan Berjaya')
        ->count();

        $allPermohonan = DB::table('senarai_data_permohonan')
            ->where('rombongans_id', $id)
            ->whereIn('status_kelulusan', ['Berjaya'])
            ->get();

        // return dd($bil);

        $nama = $permohon->nama;
        $negara = $permohon->negara;

        setlocale(LC_TIME, 'MS-my');

        // return view('pdf.memo-rombongan',compact('permohon','pp','cogan', 'bilpeserta','allPermohonan'));
        $pdf = PDF::loadView('pdf.memo-rombongan', compact('permohon','pp','cogan', 'bilpeserta', 'allPermohonan'))->setPaper('a4', 'portrait');
        return $pdf->download('MEMO Kelulusan untuk Rombongan ke ' . $negara . '.pdf');
    
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
        return $pdf->download('Laporan ELN Mengikut Jantina '.$tahun.'.pdf');
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
        return $pdf->download('Laporan Individu '.$user->nama.'.pdf');

    }

    public function laporanJabatan($tahun)
    {
        $list = DB::table('jumlah_jabatan_tahunan')
        ->where('tahun', $tahun)
        ->orderBy('jumlah', 'desc')
        ->get();
        
        // return view('pdf.laporanJabatan',compact('list', 'tahun'));
        $pdf = PDF::loadView('pdf.laporanJabatan', compact('list', 'tahun'))->setPaper('a4', 'portrait');
        return $pdf->download('Laporan ELN Mengikut Jabatan '.$tahun.'.pdf');
    }
    
    public function laporanNegara($tahun)
    {
        $list = DB::table('jumlah_mengikut_negara_tahunan')
        ->where('tahun', $tahun)
        ->orderBy('jumlah', 'desc')
        ->get();
        
        // return view('pdf.laporanNegara',compact('list', 'tahun'));
        $pdf = PDF::loadView('pdf.laporanNegara', compact('list', 'tahun'))->setPaper('a4', 'portrait');
        return $pdf->download('Laporan ELN Mengikut Negara '.$tahun.'.pdf');
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
        return $pdf->download('Laporan Bulanan ELN '.$tahun.'.pdf');
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
        return $pdf->download('Laporan ELN Mengikut Tahun.pdf');
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
        return $pdf->download('Laporan Individu.pdf');
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
        return $pdf->download('Laporan Status.pdf');
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
        return $pdf->download('Laporan Status.pdf');
    }
}
