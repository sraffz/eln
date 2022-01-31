<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permohonan;
use App\Pasangan;
use App\Rombongan;
use App\User;
use App\Notifications\PermohonanBerjaya;
use DB;
use PDF;
use Auth;
use Notification;
use Carbon\Carbon;

class KetuaController extends Controller
{
    public function index()
    {
        $sejarah = Permohonan::whereIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])->get();

        $permohonan = Permohonan::where('statusPermohonan', 'Lulus Semakan BPSM')
            ->whereNotIn('JenisPermohonan', ['rombongan'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('ketua.senaraiPermohonan', compact('permohonan', 'sejarah'));
    }

    public function senaraiLulus()
    {
        $rombongan = Rombongan::whereIn('statusPermohonanRom', ['Permohonan Berjaya', 'Permohonan Gagal'])->get();

        $allPermohonan = Permohonan::with('user')
            ->where('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
            ->get();

        return view('ketua.senaraiDiLuluskan', compact('allPermohonan', 'rombongan'));
    }

    public function senaraiRombonganKetua()
    {
        // $rombongan = Rombongan::all();
        $allPermohonan = Permohonan::with('user')
            ->where('statusPermohonan', '!=', 'Permohonan Gagal')
            
            ->get();

        //$post = Permohonan::with('pasangans')->where('statusPermohonan','=','Pending')->get();   //sama gak nga many to many
        $rombongan = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->where('statusPermohonanRom', 'Lulus Semakan')
            ->orderBy('rombongans.created_at', 'asc')
            ->get();

        return view('ketua.senaraiRombonganKetua', compact('rombongan', 'allPermohonan'));
    }

    public function editPermohonan(Request $request)
    {
        $sebab = $request->input('sebab');
        $permohonansID = $request->input('permohonansID');
        $status = 'Permohonan Ditolak';

        Permohonan::where('permohonansID', '=', $permohonansID)->update([
            'sebabDitolak' => $sebab,
            'statusPermohonan' => $status,
            'tarikhLulusan' => \Carbon\Carbon::now(),
        ]);

        return redirect()->back();
    }

    public function hantar($id)
    {
        $ubah = 'Permohonan Berjaya';

        $ruj = Permohonan::where('permohonansID', $id)
            ->with('user')
            ->first();

        $emailnakHantar = $ruj->user;
        $negara = $ruj->negara;
        $tarikhMulaPerjalanan = Carbon::parse($ruj->tarikhMulaPerjalanan)->format('d-m-Y');
        $tarikhAkhirPerjalanan = Carbon::parse($ruj->tarikhAkhirPerjalanan)->format('d-m-Y');
        $nokp = $ruj->user->nokp;
        $nama = $ruj->user->nama;

        // dd($tarikhMulaPerjalanan);
        Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah, 'tarikhLulusan' => \Carbon\Carbon::now()]);

        flash('Permohonan Diluluskan.')->success();
        return redirect()->back();
    }

    public function ketuaSentRombongan($id)
    {
        $ubah = 'Permohonan Berjaya';

        Rombongan::where('rombongans_id', '=', $id)->update([
            'statusPermohonanRom' => $ubah,
            'tarikhStatusPermohonan' => \Carbon\Carbon::now(),
        ]);

        $senarai = DB::table('permohonans')
            ->where('rombongans_id', '=', $id)
            ->where('statusPermohonan', 'Lulus Semakan BPSM')
            ->get();

        // dd($senarai);

        foreach ($senarai as $sena) {
            $idPermohonan = $sena->permohonansID;

            Permohonan::where('permohonansID', '=', $idPermohonan)->update([
                'statusPermohonan' => $ubah,
                'tarikhLulusan' => \Carbon\Carbon::now(),
            ]);
        }

        flash('Permohonan Diluluskan.')->success();
        return redirect()->back();
    }

    public function ketuaRejectRombongan($id)
    {
        $ubah = 'Permohonan Gagal';

        Rombongan::where('rombongans_id', '=', $id)->update([
            'statusPermohonanRom' => $ubah,
            'tarikhStatusPermohonan' => \Carbon\Carbon::now(),
        ]);

        $senarai = DB::table('permohonans')
            ->where('rombongans_id', '=', $id)
            ->where('statusPermohonan', 'Lulus Semakan BPSM')
            ->get();

        foreach ($senarai as $sena) {
            $idPermohonan = $sena->permohonansID;
            // echo $idPermohonan;
            Permohonan::where('permohonansID', '=', $idPermohonan)->update([
                'statusPermohonan' => $ubah,
                'tarikhLulusan' => \Carbon\Carbon::now(),
            ]);
        }

        flash('Permohonan Telah Ditolak.')->success();
        return redirect()->back();
    }

    public function tolakPermohonan($id)
    {
        $ubah = 'Permohonan Gagal';

        Permohonan::where('permohonansID', '=', $id)->update([
            'statusPermohonan' => $ubah,
            'tarikhLulusan' => \Carbon\Carbon::now(),
        ]);

        flash('Permohonan Ditolak.')->success();
        return redirect()->back();
    }

    public function permohonanGagalKetua($id)
    {
        $ubah = 'Permohonan Gagal';

        Permohonan::where('permohonansID', '=', $id)->update([
            'statusPermohonan' => $ubah,
            'tarikhLulusan' => \Carbon\Carbon::now(),
        ]);

        flash('Permohonan Gagal.')->success();
        return redirect()->back();
    }

    public function jumlahKeluarnegara()
    {
        $senaraiPermohonan = Permohonan::where('statusPermohonan', 'Permohonan Berjaya')->get();

        $senaraiPengguna = Permohonan::where('statusPermohonan', 'Permohonan Berjaya')
            ->distinct()
            ->with('user')
            ->get(['usersID']);

        // dd($senaraiPengguna);
        return view('ketua.jumlahKeLuarnegara', compact('senaraiPermohonan', 'senaraiPengguna'));
    }

    public function cetakRombongan($id)
    {
        $permohonan = Rombongan::select('users.*', 'rombongans.*', 'rombongans.created_at as tarikhmohon', 'gred_angka.*', 'gred_kod.*', 'jawatan.*')
            ->join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->leftjoin('gred_angka', 'users.gredAngka', '=', 'gred_angka.gred_angka_ID')
            ->leftjoin('gred_kod', 'users.gredKod', '=', 'gred_kod.gred_kod_ID')
            ->leftjoin('jawatan', 'users.jawatan', '=', 'jawatan.idJawatan')
            ->where('rombongans.rombongans_id', $id)
            ->first();

        $dokumen = DB::table('dokumens')
            ->where('permohonansID', '=', $id)
            ->get();

        $tarikhmohon = $permohonan->tarikhmohon;
        $mula = Carbon::parse($permohonan->tarikhMulaRom);
        $akhir = Carbon::parse($permohonan->tarikhAkhirRom);
        $jumlahDate = $mula->diffInDays($akhir);

        \Carbon\Carbon::setLocale('ms-MY');

        $allPermohonan = DB::table('senarai_data_permohonan')
            ->where('rombongans_id', $id)
            ->whereIn('statusPermohonan', ['Lulus Semakan BPSM'])
            ->get();

        // return view('ketua.cetak.cetak-butiran-rombongan', compact('permohonan', 'tarikhmohon', 'jumlahDate', 'allPermohonan', 'dokumen'));
        $pdf = PDF::loadView('ketua.cetak.cetak-butiran-rombongan', compact('permohonan', 'tarikhmohon', 'jumlahDate', 'allPermohonan', 'dokumen'))->setpaper('a4', 'potrait');
        return $pdf->download('Borang Permohonan Rombongan Ke Luar Negara.pdf');
    }

    public function cetakPermohonan($id)
    {

        $sej = Permohonan::where('permohonansID',$id)->first();

        $sejarah = Permohonan::whereIn('statusPermohonan', ['Permohonan Berjaya'])
        ->where('usersID', $sej->usersID)
        ->get();

        // return dd($sejarah);

        $permohonan = Permohonan::find($id);
        $pasangan = Pasangan::where('permohonansID', $id)->get();
        $dokumen = DB::table('dokumens')
            ->where('permohonansID', '=', $id)
            ->get();

        $mula = Carbon::parse($permohonan->tarikhMulaPerjalanan);
        $akhir = Carbon::parse($permohonan->tarikhAkhirPerjalanan);
        $jumlahDate = $mula->diffInDays($akhir);

        $mulaCuti = Carbon::parse($permohonan->tarikhMulaCuti);
        $akhirCuti = Carbon::parse($permohonan->tarikhAkhirCuti);
        $jumlahDateCuti = $mulaCuti->diffInDays($akhirCuti);

        return view('ketua.cetak.cetak-butiran-permohonan', compact('sejarah','permohonan', 'pasangan', 'jumlahDate', 'jumlahDateCuti', 'dokumen'));
        $pdf = PDF::loadView('ketua.cetak.cetak-butiran-permohonan', compact('sejarah', 'permohonan', 'pasangan', 'jumlahDate', 'jumlahDateCuti', 'dokumen'))->setpaper('a4', 'potrait');
        return $pdf->download('Borang Permohonan Ke Luar Negara.pdf');
    }

    public function cetakSenarairombongan()
    {
        $allPermohonan = Permohonan::with('user')
            ->where('statusPermohonan', '!=', 'Permohonan Gagal')
            ->get();

            if (Auth::user()->role == 'DatoSUK') {
                $rombongan = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
                    ->where('statusPermohonanRom', 'Lulus Semakan')
                    ->get();
                }elseif (Auth::user()->role == 'jabatan') {
                $rombongan = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
                    ->where('statusPermohonanRom', 'Pending')
                    ->get();
            }

        // return view('ketua.cetak.cetak-senarai-rombongan', compact('rombongan', 'allPermohonan'));

        $pdf = PDF::loadView('ketua.cetak.cetak-senarai-rombongan', compact('rombongan', 'allPermohonan'))->setpaper('a4', 'landscape');
        return $pdf->download('Senarai Permohonan Rombongan Ke Luar Negara.pdf');
    }

    public function cetakSenaraiPermohonan()
    {
        $sejarah = Permohonan::whereIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])->get();

        if (Auth::user()->role == 'DatoSUK') {
            $permohonan = Permohonan::where('statusPermohonan', 'Lulus Semakan BPSM')
            ->whereNotIn('JenisPermohonan', ['rombongan'])
            ->get();
            }elseif (Auth::user()->role == 'jabatan') {
                $permohonan = Permohonan::where('statusPermohonan', 'Pending')
                ->whereNotIn('JenisPermohonan', ['rombongan'])
                ->get();
        }
        

        // return view('ketua.cetak.cetak-senarai-permohonan', compact('permohonan'));

        $pdf = PDF::loadview('ketua.cetak.cetak-senarai-permohonan', compact('permohonan'))->setpaper('a4', 'landscape');
        return $pdf->download('Senarai Permohonan Individu Ke Luar Negara.pdf');
    }
}
