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
use App\GredKod;
use App\InfoSurat;
use DB;
use Carbon\Carbon;
use File;
use PDF;
use Session;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $permohonan = Permohonan::all();
        //$post = Permohonan::with('pasangans')->where('statusPermohonan','=','Pending')->get();   //sama gak nga many to many
        if (Auth::user()->role == 'adminBPSM') {
            $permohonan = Permohonan::with('user')
                ->whereNull('rombongans_id')
                ->whereIn('statusPermohonan', ['Lulus Semakan BPSM', 'Lulus Semakkan ketua Jabatan'])
                ->get();
        } elseif (Auth::user()->role == 'jabatan') {
            $permohonan = Permohonan::join('users', 'users.usersID', '=', 'permohonans.usersID')
                ->whereNull('rombongans_id')
                ->where('users.jabatan', Auth::user()->jabatan)
                ->whereIn('statusPermohonan', ['Lulus Semakan BPSM', 'Lulus Semakkan ketua Jabatan'])
                ->get();
        }

        //dd($permohonan);
        return view('admin.senaraiPending', compact('permohonan'));
    }

    public function profil()
    {
        $jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        $gredAngka = GredAngka::all();
        $gredKod = GredKod::all();
        $jawatan = Jawatan::orderBy('namaJawatan', 'asc')->get();

        $user = User::with('userJabatan')
            // ->with('userJawatan')
            ->where('usersID', '=', Auth::user()->usersID)
            ->first();

        $nega = Permohonan::where('usersID', Auth::user()->usersID)->get();

        $senaraiNegara = $nega->where('statusPermohonan', 'Permohonan Berjaya')->pluck('negara');
        // dd($senaraiNegara);
        return view('profil', compact('user', 'senaraiNegara', 'jabatan', 'gredAngka', 'gredKod', 'jawatan'));
    }

    public function kemaskiniprofil(Request $req)
    {
        User::where('usersID', Auth::user()->usersID)->update([
            'nama' => $req->input('nama'),
            'nokp' => $req->input('kp'),
            'email' => $req->input('email'),
            'jawatan' => $req->input('jawatan'),
            'jabatan' => $req->input('jabatan'),
            'gredKod' => $req->input('gredKod'),
            'gredAngka' => $req->input('gredangka'),
        ]);

        Session::flash('message', 'Berjaya dikemaskini.');

        return back();
    }

    public function kemaskinikatalaluan(Request $req)
    {
        $req->validate([
            'password' => ['required', new MatchOldPassword()],
            'newpassword' => ['required'],
            'confirmpassword' => ['same:newpassword'],
        ]);

        User::where('usersID', Auth::user()->usersID)->update([
            'password' => Hash::make($req->newpassword),
        ]);

        Session::flash('message', 'Kata laluan berjaya ditukar.');

        return back();
    }

    public function senaraiRekodIndividu()
    {
        // $permohonan = Permohonan::all();
        //$post = Permohonan::with('pasangans')->where('statusPermohonan','=','Pending')->get();   //sama gak nga many to many
        $permohonan = Permohonan::with('user')
            ->whereNull('rombongans_id')
            ->whereIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($permohonan);
        return view('admin.senaraiPending', compact('permohonan'));
    }

    public function indexRombongan()
    {
        if (Auth::user()->role == 'adminBPSM') {
            $rombongan = Rombongan::leftjoin('users', 'users.usersID', '=', 'rombongans.usersID')
                ->whereIn('statusPermohonanRom', ['Pending'])
                ->orderBy('rombongans.created_at','asc')
                ->get();
        } elseif (Auth::user()->role == 'jabatan') {
            $rombongan = Rombongan::leftjoin('users', 'users.usersID', '=', 'rombongans.usersID')
                ->whereIn('statusPermohonanRom', ['Pending'])
                ->where('users.jabatan', Auth::user()->jabatan)
                ->orderBy('rombongans.created_at','asc')
                ->get();
        }

        // dd($rombongan);
        $allPermohonan = Permohonan::with('user')
            ->whereNotIn('statusPermohonan', ['Permohonan Gagal'])
            ->get();

        return view('admin.senaraiPendingRombongan', compact('rombongan', 'allPermohonan'));
    }

    public function senaraiRekodRombongan()
    {
        $rombongan = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->whereIn('statusPermohonanRom', ['Permohonan Berjaya', 'Permohonan Gagal'])
            ->get();

            if (Auth::user()->role == "DatoSUK") {
                $allPermohonan = Permohonan::with('user')
                ->where('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
                ->get();
            }
            elseif(Auth::user()->role == "adminBPSM"){
                $allPermohonan = Permohonan::with('user')
                ->get();
            } else {
                return view('');
            }
            

        return view('admin.senaraiPendingRombongan', compact('rombongan', 'allPermohonan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function carian()
    {
        $negara = Negara::all();
        return view('admin/carian', compact('negara'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function procarian(Request $request)
    {
        $tarikhPermo = $request->input('tarikhPermohonan');
        // $tarikhSurat= $request -> input('tarikhSurat');
        $jabatan = $request->input('jabatan');
        $nama = $request->input('nama');
        $tempat = $request->input('tempat');
        $status = $request->input('status');
        // $tempoh= $request -> input('tempoh');
        $jenisKewanganRom = $request->input('jenisKewanganRom');
        $D = '%d';
        $M = '%m';
        $Y = '%Y';
        $and = 'AND';
        //echo $tarikhPermo;

        if ($tarikhPermo == '') {
            $tarikhPermo1 = '';
        } else {
            $tarikhPermo1 = "DATE_FORMAT(permohonans.created_at,'$M/$D/$Y')='$tarikhPermo' $and";
        }

        if ($jenisKewanganRom == '') {
            $jenisKewanganRom1 = '';
        } else {
            $jenisKewanganRom1 = "permohonans.jenisKewangan = '$jenisKewanganRom' $and";
        }

        if ($jabatan == '') {
            $jabatan1 = '';
        } else {
            $jabatan1 = "users.jabatan = '$jabatan' $and";
        }

        if ($tempat == '') {
            $tempat1 = '';
        } else {
            $tempat1 = "permohonans.negara = '$tempat' $and";
        }

        if ($status == '') {
            $status1 = '';
        } else {
            $status1 = "permohonans.statusPermohonan = '$status' $and";
        }

        if ($nama == '') {
            $nama1 = '';
        } else {
            $nama1 = "users.nama LIKE '%$nama%' AND";
        }

        // $a="select * from permohonans where ".$tempat1.$status1;
        $a = "select * from permohonans,users where $tarikhPermo1 $jabatan1 $tempat1 $status1 $jenisKewanganRom1 $nama1 permohonans.usersID=users.usersID";
        //echo $a;
        $permohon = DB::select($a);
        // dd($permohon);
        return view('admin.senaraiCarian', compact('permohon'));
    }

    public function store(Request $request)
    {
        //
    }

    public function editPaparanRombongan($id)
    {
        $negara = Negara::all();

        $rombongan = Rombongan::where('rombongans_id', $id)->get();

        $dokumen = DB::table('dokumens')
            ->where('rombongans_id', $id)
            ->get();

        $peserta = Permohonan::with('user')
            ->where('rombongans_id', $id)
            ->get();

        return view('pengguna.kemaskini-permohonan', compact('negara', 'rombongan', 'dokumen', 'peserta'));
    }

    public function kemaskinirombongan(Request $req)
    {
        $id = $req->input('id');

        Rombongan::where('rombongans_id', $id)->update([
            'tarikhInsuranRom' => $req->input('tarikhInsuranRom'),
            'tarikhMulaRom' => $req->input('tarikhmula'),
            'tarikhAkhirRom' => $req->input('tarikhakhir'),
            'negaraRom' => $req->input('negaraRom'),
            'tujuanRom' => $req->input('tujuanRom'),
            'jenisKewanganRom' => $req->input('jenisKewanganRom'),
            'anggaranBelanja' => $req->input('anggaranBelanja'),
            'alamatRom' => $req->input('alamatRom'),
            'alamatRom' => $req->input('alamatRom'),
        ]);

        flash('Maklumat dikemaskini.')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

        return view('admin.detailPermohonan', compact('permohonan', 'pasangan', 'jumlahDate', 'jumlahDateCuti', 'dokumen'));
    }

    public function showRombongan($id)
    {
        $rombongan = Rombongan::join('users', 'users.usersID', '=', 'rombongans.usersID')
            ->where('rombongans_id', $id)
            ->get();

        foreach ($rombongan as $rombo) {
            $mula = Carbon::parse($rombo->tarikhMulaRom);
            $akhir = Carbon::parse($rombo->tarikhAkhirRom);
            $jumlahDate = $mula->diffInDays($akhir);
        }

        // $rombongan = Permohonan::leftjoin('users', 'users.usersID', '=', 'rombongans.usersID')
        // ->whereIn('statusPermohonanRom', ['Pending'])->get();
        // $code=$rombongan->codeRom;

        $peserta = Permohonan::with('user')
            ->where('rombongans_id', $id)
            // ->whereIn('statusPermohonan',['Lulus Semakan BPSM'])
            ->get();

        $dokumen = DB::table('dokumens')
            ->where('rombongans_id', '=', $id)
            ->first();
        // dd($dokumen);

        return view('admin.detailPermohonanRombongan', compact('rombongan', 'id', 'jumlahDate', 'peserta', 'dokumen'));
    }

    public function download($id)
    {
        $permohonan = Permohonan::find($id);
        $path = $permohonan->pathFileCuti;

        return Storage::download($path);
    }
    public function downloadDokumen($id)
    {
        $dokumen = Dokumen::find($id);
        // $path = $dokumen->namaFile;
        $path = $dokumen->pathFile;

        // return dd($path);
        return Storage::download($path);
    }

    public function gambar($name)
    {
        $extension = File::extension($name);
        $path = public_path('storage/' . $name);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    public function hantar($id)
    {
        $ubah = 'Lulus Semakan BPSM';

        Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah]);

        flash('lulus semakkan.')->success();
        return redirect()->back();
    }

    public function hantarRombo($id)
    {
        $ubah = 'Lulus Semakan';

        Rombongan::where('rombongans_id', '=', $id)->update(['statusPermohonanRom' => $ubah]);

        flash('lulus semakkan.')->success();
        return redirect()->back();
    }

    public function sebab(Request $request)
    {
        // dd($request);
        $id = $request->input('id_edit');
        $sebab = $request->input('sebb');
        $ubah = 'simpanan';

        Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah]);

        $data = [
            'alasan' => $sebab,
            'permohonansID' => $id,

            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        Sebab::create($data);
        flash('Berjaya dihantar semula.')->success();
        return redirect()->back();
    }

    public function sebabRombongan(Request $request)
    {
        // dd($request);
        $id = $request->input('id_edit');
        $sebab = $request->input('sebb');
        $ubah = 'simpanan';

        Rombongan::where('rombongans_id', '=', $id)->update(['statusPermohonanRom' => $ubah]);

        $data = [
            'alasan' => $sebab,
            'rombongans_id' => $id,

            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        Sebab::create($data);
        flash('Berjaya dihantar semula.')->success();
        return redirect('senaraiPendingRombongan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function laporanDato()
    {
        $list = DB::table('laporan_senarai_permohonan')
            ->whereIn('statusPermohonan', ['Permohonan Gagal', 'Permohonan Berjaya'])
            // ->where('statusPermohonan','Lulus Semakan BPSM')
            ->get();

        $bilkluarneagara = DB::table('jumlah_permohonan_individu')->get();

        $permohon = Permohonan::with('user')
            ->where('statusPermohonan', '=', 'Lulus Semakan BPSM')
            ->get();

        $PermohonanRombongan = Permohonan::with('rombonganPermohonan')
            ->with('user')
            ->where('JenisPermohonan', '=', 'rombongan')
            ->orderBy('rombongans_id')
            ->get();

        if (is_null($permohon)) {
            echo 'kosong';
        } else {
            // dd($permohon);
            // $pdf = PDF::loadView('admin.laporanIndividu',['permohon'=>$permohon,'PermohonanRombongan'=>$PermohonanRombongan])->setPaper('a4', 'landscape');
            // return $pdf->download('laporan.pdf');
        }
        // return view('admin.laporanIndividu', compact('permohon', 'PermohonanRombongan', 'list', 'bilkluarneagara'));
        $pdf = PDF::loadView('admin.laporanIndividu', compact('permohon', 'PermohonanRombongan', 'list', 'bilkluarneagara'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan Secara Bundle.pdf');
    }

    public function senaraiJabatan()
    {
        $jabatan = Jabatan::all();
        return view('konfigurasi.senaraiJabatan', compact('jabatan'));
    }

    public function tambahJabatan()
    {
        return view('konfigurasi.tambahJabatan');
    }

    public function prosesTambahJab(Request $request)
    {
        // dd($request);
        $namajabatan = $request->input('namajabatan');
        $kodjabatan = $request->input('kodjabatan');

        $data = [
            'nama_jabatan' => $namajabatan,
            'kod_jabatan' => $kodjabatan,
            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        Jabatan::create($data);
        flash('Jabatan berjaya ditambah')->success();
        return redirect('senaraiJabatan');
    }

    public function senaraiJawatan()
    {
        $jawatan = Jawatan::all();
        return view('konfigurasi.senaraiJawatan', compact('jawatan'));
    }

    public function tambahJawatan()
    {
        return view('konfigurasi.tambahJawatan');
    }

    public function prosesTambahJaw(Request $request)
    {
        // dd($request);
        $namajawatan = $request->input('namajawatan');

        $data = [
            'namaJawatan' => $namajawatan,
            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        Jawatan::create($data);
        flash('Jawatan berjaya ditambah.')->success();
        return redirect('senaraiJawatan');
    }

    public function senaraiGredAngka()
    {
        $angka = GredAngka::all();
        return view('konfigurasi.senaraiGredAngka', compact('angka'));
    }

    public function tambahGredAngka()
    {
        return view('konfigurasi.tambahGredAngka');
    }

    public function prosesTambahGredAngka(Request $request)
    {
        // dd($request);
        $angka = $request->input('angka');

        $data = [
            'gred_angka_nombor' => $angka,
            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        GredAngka::create($data);
        flash('Maklumat telah ditambah')->success();
        return redirect('senaraiGredAngka');
    }

    public function laporanjantina(Request $req)
    {
        $tahun = $req->tahun;

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

        return view('laporan.jantina', compact('countLBerjaya', 'countPBerjaya', 'countLGagal', 'countPGagal', 'tahun'));
    }

    public function laporanjabatan(Request $req)
    {
        $tahun = $req->tahun;

        $list = DB::table('jumlah_jabatan_tahunan')
            ->where('tahun', $tahun)
            ->orderBy('jumlah', 'desc')
            ->get();

        return view('laporan.jabatan', compact('list', 'tahun'));
    }

    public function laporannegara(Request $req)
    {
        $tahun = $req->tahun;

        $list = DB::table('jumlah_mengikut_negara_tahunan')
            ->where('tahun', $tahun)
            ->orderBy('jumlah', 'desc')
            ->get();

        return view('laporan.negara', compact('list', 'tahun'));
    }

    public function laporanbulanan(Request $req)
    {
        $tahun = $req->tahun;

        $bil = DB::table('jumlah_permohonan_bulanan_tahunan')
            ->where('tahun', $tahun)
            ->get();

        $jumlah = DB::table('jumlah_permohonan_bulanan_tahunan')
            ->where('tahun', $tahun)
            ->sum('bil');

        return view('laporan.bulanan', compact('tahun', 'bil', 'jumlah'));
    }

    public function laporantahunan()
    {
        $data = DB::table('jumlah_permohonan_tahunan')
            ->orderBy('tahun', 'desc')
            ->get();

        return view('laporan.tahun', compact('data'));
    }

    public function laporanindividu(Request $req)
    {
        $tahun = $req->tahun;

        return view('laporan.individu', compact('tahun'));
    }

    public function terusDato()
    {
        $jawatan = Jawatan::where('statusDato', '=', 'Aktif')->get();

        $jawatan2 = Jawatan::get()->sortBy('namaJawatan');

        return view('konfigurasi.terusDato', compact('jawatan', 'jawatan2'));
    }

    public function tambahterusDato()
    {
        // $jawatan = Jawatan::all();
        $jawatan = Jawatan::get()->sortBy('namaJawatan');
        return view('konfigurasi.tambahterusDato', compact('jawatan'));
    }

    public function prosesTambahterusDato(Request $request)
    {
        // dd($request);
        $angka = $request->input('jawatan');
        $ulasan = 'Aktif';

        Jawatan::where('idJawatan', $angka)->update(['statusDato' => $ulasan]);

        flash('Maklumat telah ditambah')->success();
        return redirect('terusDato');
    }
    public function padamTerusDato($id)
    {
        $ulasan = 'Tidak Aktif';
        Jawatan::where('idJawatan', $id)->update(['statusDato' => $ulasan]);

        flash('Jawatan terus ke Dato dihapuskan.')->error();
        return redirect('terusDato');
    }

    public function senaraiGredKod()
    {
        $kod = GredKod::all();
        return view('konfigurasi.senaraiGredKod', compact('kod'));
    }

    public function tambahGredKod()
    {
        return view('konfigurasi.tambahGredKod');
    }

    public function prosesTambahGredKod(Request $request)
    {
        // dd($request);
        $kod = $request->input('kod');
        $klasifikasi = $request->input('klasifikasi');

        $data = [
            'gred_kod_abjad' => $kod,
            'gred_kod_klasifikasi' => $klasifikasi,
            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        GredKod::create($data);
        flash('Maklumat telah ditambah')->success();
        return redirect('senaraiGredKod');
    }

    public function daftarPic()
    {
        $jabatan = Jabatan::all();
        $jawatan = Jawatan::all();
        $angka = GredAngka::all();
        $kod = GredKod::all();
        // dd($jabatan);
        return view('admin.tambah-pic', compact('jabatan', 'jawatan', 'angka', 'kod'));
    }

    public function daftarJabatan(Request $request)
    {
        // dd($request);
        $nama = $request->input('nama');
        $nokp = $request->input('nokp');
        $jabatan = $request->input('jabatan');
        $jawatan = $request->input('jawatan');
        $kod = $request->input('kod');
        $gred = $request->input('gred');
        $email = $request->input('email');
        $role = $request->input('role');
        $katalaluan = bcrypt($nokp);

        $data = [
            'nama' => $nama,
            'nokp' => $nokp,
            'email' => $email,
            'jabatan' => $jabatan,
            'jawatan' => $jawatan,
            'gredKod' => $kod,
            'gredAngka' => $gred,
            'password' => $katalaluan,
            'role' => $role,
            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        User::create($data);
        flash('Pentadbir telah berjaya ditambah')->success();
        return redirect()->back();
    }

    public function senaraiPic()
    {
        $user = User::with('userJabatan')
            ->where('role', '=', 'jabatan')
            ->get();
        // dd($user);
        return view('admin.senaraiPicJabatan', compact('user'));
    }

    public function senaraiPengguna()
    {
        $user = User::leftjoin('jawatan', 'jawatan.idJawatan', '=', 'users.jawatan')->get();
        // $user = User::where('jabatan', Auth::user()->jabatan)->get();

        // $user = User::with('userJabatan')->get();

        // dd($user);
        return view('admin.senaraiPengguna', compact('user'));
    }

    public function editPIC($id)
    {
        //dd($id);
        $users = User::with('userJabatan')
            ->where('role', '=', 'picJabatan')
            ->where('usersID', '=', $id)
            ->first();
        return view('admin.insertEdit', compact('users'));
    }

    public function updateDataPIC(Request $request, $id)
    {
        //dd($request);
        $users = User::find($id);
        $users->update($request->all());
        flash('Maklumat telah dikemaskini.')->success();
        return redirect('senaraiPic');
    }

    // --------------------------jabatan-----------------------
    // --------------------------------------------------------

    public function senaraiPermohonanJabatan()
    {
        $jab = Auth::user()->jabatan;
        // echo $jab;
        $permohonan = Permohonan::join('users', 'permohonans.usersID', '=', 'users.usersID')
            ->where('users.jabatan', $jab)
            ->whereIn('statusPermohonan', ['Ketua Jabatan'])
            ->orderBy('permohonans.created_at','asc')
            ->get();

        return view('jabatan.senaraiPermohonanJabatan', compact('permohonan'));
    }

    public function senaraiPermohonanLepas()
    {
        $jab = Auth::user()->jabatan;
        // echo $jab;
        $permohonan = Permohonan::select('users.*', 'permohonans.*', 'permohonans.created_at as tarikhmohon')
            ->join('users', 'permohonans.usersID', '=', 'users.usersID')
            ->where('users.jabatan', $jab)
            ->whereNotIn('statusPermohonan', ['simpanan'])
            ->orderBy('permohonans.created_at', 'desc')
            ->get();

        $rombo = Rombongan::select('users.*', 'rombongans.*', 'rombongans.created_at as tarikmohon')
            ->join('users', 'rombongans.usersID', '=', 'users.usersID')
            ->where('users.jabatan', $jab)
            ->whereNotIn('rombongans.statusPermohonanRom', ['simpanan'])
            ->orderBy('rombongans.created_at', 'desc')
            ->get();

        return view('jabatan.senaraiPermohonanLepas', compact('permohonan', 'rombo'));
    }

    public function daftarPenggunaJabatan()
    {
    }
    public function senaraiPenggunaJabatan()
    {
    }

    public function hantarJabatan(Request $request)
    {
        $id = $request->kopeID;
        $ulasan = $request->ulasan;
        $upda = 'Lulus Semakan BPSM';

        $permohonan = Permohonan::where('permohonansID', '=', $id)->first();

        $tarikhmulajalan = $permohonan->tarikhMulaPerjalanan;

        $end = Carbon::parse($tarikhmulajalan);
        $nowsaa = Carbon::today();

        $length = $end->diffInDays($nowsaa);

        Permohonan::where('permohonansID', $id)->update(['ulasan' => $ulasan, 'statusPermohonan' => $upda, 'jumlahHariPermohonanBerlepas' => $length]);
        flash('Permohonan telah disokong.', 'success');
        return redirect()->back();
    }

    public function kemaskiniPengguna($id)
    {
        $jabatan = Jabatan::all();
        $jawatan = Jawatan::all();
        $angka = GredAngka::all();
        $kod = GredKod::all();

        $users = User::with('userJabatan')
            ->where('usersID', '=', $id)
            ->first();
        //dd($user);
        return view('admin.kemaskiniPengguna', compact('jabatan', 'users', 'jawatan', 'angka', 'kod'));
    }

    public function resetKatalaluan($id)
    {
        
        $user = User::where('usersID', $id)
        ->first();

        User::where('usersID', $id)
        ->update([
            'password' => Hash::make($user->nokp)
        ]);

        flash('Kata Laluan Pengguna Telah Diset Semula', 'success');
        return back();
    }

    public function kemaskiniDataPengguna(Request $request)
    {
        $nama = $request->nama;
        $nokp = $request->nokp;
        $email = $request->email;

        $jawatan = $request->jawatan;
        $jabatan = $request->jabatan;
        $gred = $request->gred;
        $kod = $request->kod;

        
        User::with('userJabatan')
            ->with('userJawatan')
            ->where('nokp', $nokp)
            ->update([
                'nama' => $nama, 
                'email' => $email,
                'jawatan' => $jawatan,
                'jabatan' => $jabatan,
                'gredAngka' => $gred,
                'gredKod' => $kod
            ]);

        flash('Maklumat telah dikemaskini', 'success');
        return redirect()->back();
    }

    public function infoSurat()
    {
        $cogan = 'Cogan Kata';
        $ppengarah = 'Penolong Pengarah';

        $cogankata = InfoSurat::where('perkara', '=', $cogan)->first();

        $penolongPengarah = InfoSurat::where('perkara', '=', $ppengarah)->first();

        // dd($penolongPengarah);
        return view('konfigurasi.infoSurat', compact('cogankata', 'penolongPengarah'));
    }

    public function prosesTambahCoganKata(Request $request)
    {
        $id = $request->input('id');

        infoSurat::where('info_surat_ID', $id)->update([
            'maklumat1' => $request->input('kata'),
            'maklumat2' => $request->input('kata2'),
            'maklumat3' => $request->input('kata3'),
        ]);
        flash('Maklumat telah dikemaskini', 'success');

        return redirect()->back();

        // $cogan=$request->cogan;
        // $kata=$request->kata;
        // $bilanganCogan = InfoSurat::where('perkara','=',$cogan)
        //             ->count();
        // if ($bilanganCogan == 0)
        // {
        //    $data = [
        //         'perkara'=>$cogan,
        //         'maklumat1'=>$kata,
        //         'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
        //         'updated_at' => \Carbon\Carbon::now()  # \Datetime()
        //     ];
        //     infoSurat::create($data);
        //     flash('Berjaya mendaftar cogan kata. ')->success();
        //     return redirect()->back();
        // }
        // else
        // {
        //     infoSurat::where('info_surat_ID', $cogan)
        //     ->update([
        //         'maklumat1' => $cogan,
        //         'maklumat2' => $cogan2,
        //         'maklumat3' => $cogan3,
        //     ]);
        //     flash('kemaskini dah berjaya!!', 'success');

        //     return redirect()->back();
        // }
    }

    public function prosesTambahNamaPenolongPengarah(Request $request)
    {
        $maklumat1 = $request->maklumat1;
        $maklumat2 = $request->maklumat2;
        $maklumat3 = $request->maklumat3;
        $maklumat4 = $request->maklumat4;
        $pp = $request->pp;
        $bilanganCogan = InfoSurat::where('perkara', '=', $pp)->count();
        if ($bilanganCogan == 0) {
            $data = [
                'perkara' => $pp,
                'maklumat1' => $maklumat1,
                'maklumat2' => $maklumat2,
                'maklumat3' => $maklumat3,
                'maklumat4' => $maklumat4,
                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
            ];
            infoSurat::create($data);
            flash('Berjaya mendaftar Penolong Pengarah. ')->success();
            return redirect()->back();
        } else {
            infoSurat::where('perkara', $pp)->update(['maklumat1' => $maklumat1, 'maklumat2' => $maklumat2, 'maklumat3' => $maklumat3, 'maklumat4' => $maklumat4]);
            flash('Maklumat telah dikemaskini', 'success');
            return redirect()->back();
        }
    }
}
