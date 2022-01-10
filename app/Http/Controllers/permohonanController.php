<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Negara;
use App\User;
use App\Permohonan;
use App\Dokumen;
use App\Rombongan;
use App\Pasangan;
use App\Jawatan;
use App\Jabatan;
use App\GredKod;
use App\GredAngka;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class permohonanController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $negara = Negara::all();
        $options = Negara::pluck('namaNegara'); //depan tuu display/kemudian valuenya
        //dd($negara);
        return view('registerForm', compact('options'));
    }

    public function registerBaru()
    {
        $jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->get();
        $gredAngka = GredAngka::all();
        $gredKod = GredKod::all();
        $jawatan = Jawatan::orderBy('namaJawatan', 'asc')->get();

        //dd($negara);
        return view('auth.register', compact('jabatan', 'gredAngka', 'gredKod', 'jawatan'));
    }

    public function index2()
    {
        //check auth wujud ke idok
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role;
            $id = $user->usersID;
            $create = $user->created_at;
            $year = today()->format('Y');
            // --------------------Pengguna---------------------------------------------------------------------------------
            $DateNew3 = strtotime($create);
            $mula = date('d-m-Y', $DateNew3);
            $TotalPerm = DB::table('permohonans')
                ->where('usersID', '=', $id)
                // ->where('statusPermohonan','!=', 'simpanan')
                ->whereYear('tarikhLulusan', $year)
                ->count();
            $TotalBerjaya = DB::table('permohonans')
                ->where('usersID', '=', $id)
                ->where('statusPermohonan', '=', 'Permohonan Berjaya')
                ->whereYear('tarikhLulusan', $year)
                ->count();
            $TotalGagal = DB::table('permohonans')
                ->where('usersID', '=', $id)
                ->where('statusPermohonan', '=', 'Permohonan Gagal')
                ->whereYear('tarikhLulusan', $year)
                ->count();
            $TotalProces = DB::table('permohonans')
                ->where('usersID', '=', $id)
                ->where('statusPermohonan', ['Pending', 'Lulus Semakan'])
                ->whereYear('tarikhLulusan', $year)
                ->count();

            $senarai = DB::table('permohonans')
                ->where('usersID', Auth::user()->usersID)
                ->whereIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
                ->whereYear('tarikhLulusan', $year)
                ->orderBy('tarikhLulusan', 'DESC')
                ->get();
            // --------------------Pengguna---------------------------------------------------------------------------------
            // --------------------ADMIN PSM---------------------------------------------------------------------------------

            $TotalPerm1 = DB::table('permohonans')
                ->where('statusPermohonan', '!=', 'simpanan')
                ->whereYear('tarikhMulaPerjalanan', $year)
                ->count();

            $TotalBerjaya1 = DB::table('permohonans')
                ->where('statusPermohonan', '=', 'Permohonan Berjaya')
                ->whereYear('tarikhLulusan', $year)
                ->count();
            $TotalGagal1 = DB::table('permohonans')
                ->where('statusPermohonan', '=', 'Permohonan Gagal')
                ->whereYear('tarikhLulusan', $year)
                ->count();
            $TotalProces1 = DB::table('permohonans')
                ->wherein('statusPermohonan', ['Lulus Semakkan ketua Jabatan', 'Lulus Semakan BPSM'])
                ->whereYear('tarikhMulaPerjalanan', $year)
                ->count();

            $senarai1 = DB::table('permohonans')
                ->wherein('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
                ->whereYear('tarikhLulusan', $year)
                ->orderBy('tarikhLulusan', 'DESC')
                ->get();

            $jumlahPermohonan = DB::table('permohonans')
                ->where('statusPermohonan', '=', 'Lulus Semakkan ketua Jabatan')
                ->whereYear('tarikhLulusan', $year)
                ->count();

            $jumlahPendingKelulusanDato = DB::table('permohonans')
                ->where('statusPermohonan', '=', 'Lulus Semakan BPSM')
                // ->whereYear('tarikhMulaPerjalanan', $year)
                ->count();

            $senaraiNegara = Permohonan::where('statusPermohonan', 'Permohonan Berjaya')
                ->distinct()
                ->get(['negara']);

            // foreach ($senaraiNegara as $key => $value)
            $listnegara = [];
            $listcount = [];

            foreach ($senaraiNegara as $negaras) {
                $namanegara = $negaras->negara;
                $countNegara = Permohonan::where('negara', $namanegara)->count();

                array_push($listnegara, $namanegara);
                array_push($listcount, $countNegara);
            }

            // --------------------Pengguna---------------------------------------------------------------------------------
            if ($role == 'pengguna') {
                return view('pengguna.homepage', compact('user', 'mula', 'TotalPerm', 'TotalBerjaya', 'TotalGagal', 'TotalProces', 'senarai'));
            } elseif ($role == 'adminBPSM') {
                return view('admin.homepage', compact('user', 'mula', 'TotalPerm1', 'TotalBerjaya1', 'TotalGagal1', 'TotalProces1', 'senarai1'));
            } elseif ($role == 'DatoSUK') {
                return view('ketua.homepage', compact('user', 'mula', 'TotalBerjaya1', 'TotalGagal1', 'senarai1', 'jumlahPendingKelulusanDato', 'listnegara', 'listcount'));
            } elseif ($role == 'jabatan') {
                return view('jabatan.homepage', compact('user', 'mula', 'TotalPerm1', 'TotalBerjaya1', 'TotalGagal1', 'TotalProces1', 'senarai1'));
            }
        } else {
            return view('halamanUtama');
        }
    }

    public function individu($typeForm)
    {
        $userDetail = User::find(Auth::user()->usersID);
        $negara = Negara::all();
        //$options = Negara::pluck('namaNegara');

        return view('registerFormIndividuRasmi', compact('userDetail', 'negara', 'typeForm'));
    }

    public function rombongan($id)
    {
        $userDetail = User::find($id);
        $negara = Negara::all();
        // $options = Negara::pluck('namaNegara');
        // $userDetail = User::where('nokp', '=', $id)->firstOrFail();
        // echo $userDetail;
        return view('registerFormRombonganRasmi', compact('userDetail', 'negara'));
    }

    public function individuRombongan($id)
    {
        $userDetail = User::find($id);
        $negara = Negara::all();
        $options = Negara::pluck('namaNegara');
        // $userDetail = User::where('nokp', '=', $id)->firstOrFail();
        // echo $userDetail;
        return view('registerFormIndividuRombongan', compact('userDetail', 'options'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $tujuan = $request->input('tujuan');
        $nama = $request->input('nama');
        $nokp = $request->input('nokp');
        $jawatan = $request->input('jawatan');
        $jabatan = $request->input('jabatan');
        $negara = $request->input('negara');
        $alamat = $request->input('alamat');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $namaPasangan = $request->input('namaPasangan');
        $hubungan = $request->input('hubungan');
        $alamatPasangan = $request->input('alamatPasangan');
        $phonePasangan = $request->input('phonePasangan');
        $emailPasangan = $request->input('emailPasangan');
        $tarikhBertugas = $request->input('tarikhKembaliBertugas');
        $tarikh = $request->input('tarikh');
        $jenisPermohonan = $request->input('jenisPermohonan');
        $jenisKew = $request->input('jenisKewangan');

        // echo $jenisKew;
        $tick = $request->input('tick');

        $tempohPerjalanan = $request->input('tempohPerjalanan');

        $datePer = explode('-', $tempohPerjalanan); // dateRange is you string
        $dateFrom = $datePer[0];
        $dateTo = $datePer[1];

        $DateNew1 = strtotime($dateFrom);
        $DateNew2 = strtotime($dateTo);
        $DateNew3 = strtotime($tarikhBertugas);
        $DateNew4 = strtotime($tarikh);
        $tarikhMulaPerjalanan = date('Y-m-d', $DateNew1);
        $tarikhAkhirPerjalanan = date('Y-m-d', $DateNew2);
        $tarikhKembaliBertugas = date('Y-m-d', $DateNew3);
        $insuran = date('Y-m-d', $DateNew4);

        $end = Carbon::parse($tarikhMulaPerjalanan);
        $nowsaa = Carbon::now();

        $statusPermohonan = 'simpanan';

        if ($jenisPermohonan == 'Rasmi') {
            //echo "string";
            $data = [
                'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan,
                'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan,
                'tarikhInsuran' => $insuran,
                'negara' => $negara,
                'alamat' => $alamat,
                'statusPermohonan' => $statusPermohonan,
                'JenisPermohonan' => $jenisPermohonan,
                'jenisKewangan' => $jenisKew,
                'lainTujuan' => $tujuan,
                'tick' => $tick,
                'usersID' => $id,
                'telefonPemohon' => $phone,
                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
            ];

            Permohonan::create($data);

            $permohon = DB::table('permohonans')
                ->where('tarikhMulaPerjalanan', '=', $tarikhMulaPerjalanan)
                ->where('tarikhAkhirPerjalanan', '=', $tarikhAkhirPerjalanan)
                ->where('negara', '=', $negara)
                ->where('alamat', '=', $alamat)
                ->where('JenisPermohonan', '=', $jenisPermohonan)
                ->where('lainTujuan', '=', $tujuan)
                ->where('statusPermohonan', '=', $statusPermohonan)
                ->where('usersID', '=', $id)
                ->first();

            $idPermohonan = $permohon->permohonansID;

            $dataPasangan = [
                'namaPasangan' => $namaPasangan,
                'hubungan' => $hubungan,
                'alamatPasangan' => $alamatPasangan,
                'phonePasangan' => $phonePasangan,
                'emailPasangan' => $emailPasangan,
                'permohonansID' => $idPermohonan,
                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
            ];
            DB::table('pasangans')->insert($dataPasangan);

            if ($request->hasFile('fileRasmi')) {
                // $allowedfileExtension=['pdf','jpg','png','docx'];
                $files = $request->file('fileRasmi');

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->extension();

                    // dd($filename, $filename2,$extension);
                    if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'docx' || $extension == 'JPG' || $extension == 'DOC' || $extension == 'doc') {
                        // check folder for 'current year', if not exist, create one
                        $currYear = Carbon::now()->format('Y');
                        // $storagePath = public_path() . 'upload/dokumen/' . $currYear;
                        $storagePath = 'upload/dokumen/' . $currYear;
                        $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                        // dd ($filePath);
                        // if (!file_exists($storagePath)) {
                        //     mkdir($storagePath, 0777, true);
                        // }
                        $upload_success = $file->storeAs($storagePath, $filename);

                        if ($upload_success) {
                            $data = [
                                'namaFile' => $filename,
                                'typeFile' => $extension,
                                'pathFile' => $filePath,
                                'permohonansID' => $idPermohonan,
                                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                            ];
                            Dokumen::create($data);

                            flash('Permohonan berjaya didaftar.')->success();
                            return redirect('');
                        } else {
                            flash::error('Muat naik tidak berjaya' . $doc_type);
                            return redirect('');
                        }
                    } else {
                        echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                        return redirect('');
                    }
                }
            } else {
                flash('Berjaya didaftar tanpa dokumen rasmi!')->warning();
                return redirect('');
            }
        } elseif ($jenisPermohonan == 'Tidak Rasmi') {
            $tempohCuti = $request->input('tempohCuti');
            $dateCuti = explode('-', $tempohCuti); // dateRange is you string
            $dateFromCuti = $dateCuti[0];
            $dateToCuti = $dateCuti[1];
            $DateNew1Cuti = strtotime($dateFromCuti);
            $DateNew2Cuti = strtotime($dateToCuti);
            $tarikhMulaCuti = date('Y-m-d', $DateNew1Cuti);
            $tarikhAkhirCuti = date('Y-m-d', $DateNew2Cuti);

            if ($request->hasFile('fileCuti')) {
                // $allowedfileExtension=['pdf','jpg','png','docx'];
                $files = $request->file('fileCuti');

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    //dd($extension);
                    if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'docx' || $extension == 'JPG') {
                        // check folder for 'current year', if not exist, create one
                        $currYear = Carbon::now()->format('Y');
                        // $storagePath = public_path() . 'upload/dokumen/' . $currYear;
                        $storagePath = 'upload/dokumen/' . $currYear;
                        $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                        // if (!file_exists($storagePath)) {
                        //     mkdir($storagePath, 0777, true);
                        // }
                        $upload_success = $file->storeAs($storagePath, $filename);

                        if ($upload_success) {
                            $data = [
                                'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan,
                                'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan,
                                'tarikhInsuran' => $insuran,
                                'negara' => $negara,
                                'alamat' => $alamat,
                                'statusPermohonan' => $statusPermohonan,
                                'tarikhMulaCuti' => $tarikhMulaCuti,
                                'tarikhAkhirCuti' => $tarikhAkhirCuti,
                                'tarikhKembaliBertugas' => $tarikhKembaliBertugas,
                                'namaFileCuti' => $filename,
                                'jenisFileCuti' => $extension,
                                'pathFileCuti' => $filePath,
                                'JenisPermohonan' => $jenisPermohonan,
                                'jenisKewangan' => $jenisKew,
                                'lainTujuan' => $tujuan,
                                'tick' => $tick,
                                'usersID' => $id,
                                'telefonPemohon' => $phone,
                                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                            ];
                            Permohonan::create($data);

                            $permohon = DB::table('permohonans')
                                ->where('tarikhMulaPerjalanan', '=', $tarikhMulaPerjalanan)
                                ->where('tarikhAkhirPerjalanan', '=', $tarikhAkhirPerjalanan)
                                ->where('negara', '=', $negara)
                                ->where('alamat', '=', $alamat)
                                ->where('namaFileCuti', '=', $filename)
                                ->where('pathFileCuti', '=', $filePath)
                                ->where('JenisPermohonan', '=', $jenisPermohonan)
                                ->where('lainTujuan', '=', $tujuan)
                                ->where('statusPermohonan', '=', $statusPermohonan)
                                ->where('tarikhMulaCuti', '=', $tarikhMulaCuti)
                                ->where('tarikhAkhirCuti', '=', $tarikhAkhirCuti)
                                ->where('tarikhKembaliBertugas', '=', $tarikhKembaliBertugas)
                                ->where('usersID', '=', $id)
                                ->first();

                            $idPermohonan = $permohon->permohonansID;

                            $dataPasangan = [
                                'namaPasangan' => $namaPasangan,
                                'hubungan' => $hubungan,
                                'alamatPasangan' => $alamatPasangan,
                                'phonePasangan' => $phonePasangan,
                                'emailPasangan' => $emailPasangan,
                                'permohonansID' => $idPermohonan,
                                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                            ];

                            DB::table('pasangans')->insert($dataPasangan);
                            return redirect('');
                        } else {
                            Flash::error('Muat naik tidak berjaya.' . $doc_type);
                            return redirect('');
                        }
                    } else {
                        echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                        return redirect('');
                    }
                }
            } else {
                $data = [
                    'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan,
                    'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan,
                    'tarikhInsuran' => $insuran,
                    'negara' => $negara,
                    'alamat' => $alamat,
                    'statusPermohonan' => $statusPermohonan,
                    'tarikhMulaCuti' => $tarikhMulaCuti,
                    'tarikhAkhirCuti' => $tarikhAkhirCuti,
                    'tarikhKembaliBertugas' => $tarikhKembaliBertugas,
                    'JenisPermohonan' => $jenisPermohonan,
                    'jenisKewangan' => $jenisKew,
                    'lainTujuan' => $tujuan,
                    'tick' => $tick,
                    'usersID' => $id,
                    'telefonPemohon' => $phone,
                    'created_at' => \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                ];
                Permohonan::create($data);

                $permohon = DB::table('permohonans')
                    ->where('tarikhMulaPerjalanan', '=', $tarikhMulaPerjalanan)
                    ->where('tarikhAkhirPerjalanan', '=', $tarikhAkhirPerjalanan)
                    ->where('negara', '=', $negara)
                    ->where('alamat', '=', $alamat)
                    ->where('lainTujuan', '=', $tujuan)
                    ->where('statusPermohonan', '=', $statusPermohonan)
                    ->where('tarikhMulaCuti', '=', $tarikhMulaCuti)
                    ->where('tarikhAkhirCuti', '=', $tarikhAkhirCuti)
                    ->where('tarikhKembaliBertugas', '=', $tarikhKembaliBertugas)
                    ->where('usersID', '=', $id)
                    ->first();

                $idPermohonan = $permohon->permohonansID;

                $dataPasangan = [
                    'namaPasangan' => $namaPasangan,
                    'hubungan' => $hubungan,
                    'alamatPasangan' => $alamatPasangan,
                    'phonePasangan' => $phonePasangan,
                    'emailPasangan' => $emailPasangan,
                    'permohonansID' => $idPermohonan,
                    'created_at' => \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                ];
                DB::table('pasangans')->insert($dataPasangan);
                return redirect('');
            }
        }

        // return redirect('');
    }

    public function storeRombongan(Request $request)
    {
        // dd($request);
        $id = $request->input('id');
        $dateInsuran = $request->input('tarikhInsuranRom');
        $tarikhmulaAkhir = $request->input('tarikhmulaAkhir');
        $tujuanRom = $request->input('tujuanRom');
        $negaraRom = $request->input('negaraRom');
        $alamatRom = $request->input('alamatRom');
        $jenisKewanganRom = $request->input('jenisKewanganRom');
        $anggaranBelanja = $request->input('anggaranBelanja');

        $statusPermohonan = 'simpanan';

        $reference_num_secs = time();
        $ref_no_date = date('ymdHis', $reference_num_secs);
        $code = 'ELN' . $ref_no_date;

        $date = explode('-', $tarikhmulaAkhir); // dateRange is you string
        $dateFrom = $date[0];
        $dateTo = $date[1];

        $DateNew1 = strtotime($dateFrom);
        $DateNew2 = strtotime($dateTo);
        $DateNew3 = strtotime($dateInsuran);
        $tarikhMulaRom = date('Y-m-d', $DateNew1);
        $tarikhAkhirRom = date('Y-m-d', $DateNew2);
        $tarikhInsuranRom = date('Y-m-d', $DateNew3);

        $data = [
            'tarikhMulaRom' => $tarikhMulaRom,
            'tarikhAkhirRom' => $tarikhAkhirRom,
            'tarikhInsuranRom' => $tarikhInsuranRom,
            'codeRom' => $code,
            'negaraRom' => $negaraRom,
            'alamatRom' => $alamatRom,
            'statusPermohonanRom' => $statusPermohonan,
            'tujuanRom' => $tujuanRom,
            'jenisKewanganRom' => $jenisKewanganRom,
            'anggaranBelanja' => $anggaranBelanja,
            'usersID' => $id,
            'created_at' => \Carbon\Carbon::now(), # \Datetime()
            'updated_at' => \Carbon\Carbon::now(), # \Datetime()
        ];
        DB::table('rombongans')->insert($data);

        $rombo = DB::table('rombongans')
            ->where('codeRom', '=', $code)
            ->first();

        $co = $rombo->rombongans_id;

        if ($request->hasFile('fileRasmiRom')) {
            // $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('fileRasmiRom');

            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                //dd($extension);
                if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'docx' || $extension == 'JPG' || $extension == 'doc') {
                    // check folder for 'current year', if not exist, create one
                    $currYear = Carbon::now()->format('Y');
                    $storagePath = 'upload/dokumen/' . $currYear;
                    $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                    if (!file_exists($storagePath)) {
                        mkdir($storagePath, 0777, true);
                    }
                    $upload_success = $file->storeAs($storagePath, $filename);

                    if ($upload_success) {
                        $data = [
                            'namaFile' => $filename,
                            'typeFile' => $extension,
                            'pathFile' => $filePath,
                            'rombongans_id' => $co,
                        ];
                        Dokumen::create($data);
                        return redirect('');
                    } else {
                        Flash::error('Muat naik tidak berjaya' . $doc_type);
                        return redirect('');
                    }
                } else {
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                    return redirect('');
                }
            }
        }

        return redirect('');
    }

    public function storeIndividuRombongan(Request $request)
    {
        $id = $request->input('id');
        $kodRombo = $request->input('kodRombo');
        $tarikhmulaAkhirCuti = $request->input('tarikhmulaAkhirCuti');
        $kembaliTugas = $request->input('tarikhKembaliBertugas');
        $tick = $request->input('tick');

        $date = explode('-', $tarikhmulaAkhirCuti); // dateRange is you string
        $dateFrom = $date[0];
        $dateTo = $date[1];

        $DateNew1 = strtotime($dateFrom);
        $DateNew2 = strtotime($dateTo);
        $DateNew3 = strtotime($kembaliTugas);
        $tarikhMulaCuti = date('Y-m-d', $DateNew1);
        $tarikhAkhirCuti = date('Y-m-d', $DateNew2);
        $tarikhKembaliBertugas = date('Y-m-d', $DateNew3);

        $statusPermohonan = 'Ketua Jabatan';

        $rombo = DB::table('rombongans')
            ->where('codeRom', '=', $kodRombo)
            ->where('statusPermohonanRom', '=', 'simpanan')
            ->first();

        if ($rombo == null) {
            // user doesn't exist
            flash('Kod Rombongan tidak wujud atau permohonan telah dihantar kepada pihak BPSM')->error();
            return redirect()
                ->back()
                ->withInput();
        } else {
            $tarikhMulaRom = $rombo->tarikhMulaRom;
            $tarikhAkhirRom = $rombo->tarikhAkhirRom;
            $tarikhInsuranRom = $rombo->tarikhInsuranRom;
            $negaraRom = $rombo->negaraRom;
            $alamatRom = $rombo->alamatRom;
            $tujuanRom = $rombo->tujuanRom;
            $idRom = $rombo->rombongans_id;

            $jenisPermohonanrombongan = 'rombongan';
            if ($request->hasFile('fileCuti')) {
                // $allowedfileExtension=['pdf','jpg','png','docx'];
                // $file = $request->file('fileCuti');
                foreach ($request->file('fileCuti') as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    // dd($filename, $extension);
                    if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'docx' || $extension == 'JPG' || $extension == 'doc') {
                        // check folder for 'current year', if not exist, create one
                        $currYear = Carbon::now()->format('Y');
                        $storagePath = 'upload/dokumen/' . $currYear;
                        $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                        echo $currYear;
                        // if (!file_exists($storagePath)) {
                        //     mkdir($storagePath, 0777, true);
                        // }
                        $upload_success = $file->storeAs($storagePath, $filename);

                        if ($upload_success) {
                            $data = [
                                'tarikhMulaPerjalanan' => $tarikhMulaRom,
                                'tarikhAkhirPerjalanan' => $tarikhAkhirRom,
                                'negara' => $negaraRom,
                                'alamat' => $alamatRom,
                                'statusPermohonan' => $statusPermohonan,
                                'tarikhMulaCuti' => $tarikhMulaCuti,
                                'tarikhAkhirCuti' => $tarikhAkhirCuti,
                                'tarikhKembaliBertugas' => $tarikhKembaliBertugas,
                                'JenisPermohonan' => $jenisPermohonanrombongan,
                                'namaFileCuti' => $filename,
                                'jenisFileCuti' => $extension,
                                'pathFileCuti' => $filePath,
                                'lainTujuan' => $tujuanRom,
                                'tick' => $tick,
                                'usersID' => $id,
                                'rombongans_id' => $idRom,
                                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                            ];
                            Permohonan::create($data);
                            flash('Berjaya')->warning();
                            return redirect()->back();
                        } else {
                            Flash::error('Error uploading ' . $doc_type);
                            return redirect('');
                        }
                    } else {
                        echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                        return redirect('');
                    }
                }
            }
        } //tutup kod rombongan betul
        // flash('Message')->warning();
        // return redirect()->back()->withInput();
    } //tutup public

    public function show($id)
    {
        $userDetail = User::find($id);
        $negara = Negara::all();
        $options = Negara::pluck('namaNegara');

        return view('registerForm', compact('userDetail', 'options'));
    }

    public function hantarIndividu($id)
    {
        $permohonan = Permohonan::with('user')
            ->where('permohonansID', '=', $id)
            ->first();

        $statusJawatan = $permohonan->user->userJawatan->statusDato;

        $tarikhmulajalan = $permohonan->tarikhMulaPerjalanan;

        $end = Carbon::parse($tarikhmulajalan);
        $nowsaa = Carbon::today();

        $length = $end->diffInDays($nowsaa); //pangjang hari sebelum berlepas
        // dd($length);

        $d = DB::table('permohonans')
            ->where('permohonansID', '=', $id)
            ->whereNotNull('namaFileCuti')
            ->count();
        $dokumenRasmi = DB::table('dokumens')
            ->where('permohonansID', '=', $id)
            ->count();
        $per = DB::table('permohonans')
            ->where('permohonansID', '=', $id)
            ->first();

        $status = $per->JenisPermohonan;

        if ($status == 'Rasmi') {
            if ($dokumenRasmi == 0) {
                flash('Permohonan Rasmi memerlukan dokumen rasmi.')->error();
                return redirect()->back();
            } else {
                if ($statusJawatan == 'Tidak Aktif') {
                    $ubah = 'Ketua Jabatan';
                    Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah]);
                } elseif ($statusJawatan == 'Aktif') {
                    $ubah = 'Lulus Semakan BPSM';
                    Permohonan::where('permohonansID', '=', $id)->update(['jumlahHariPermohonanBerlepas' => $length, 'statusPermohonan' => $ubah]);
                }

                flash('Berjaya dihantar.')->success();
                return redirect()->back();
            }
        } elseif ($status == 'Tidak Rasmi') {
            if ($statusJawatan == 'Tidak Aktif') {
                $ubah = 'Ketua Jabatan';
                Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah]);
            } elseif ($statusJawatan == 'Aktif') {
                $ubah = 'Lulus Semakan BPSM';
                Permohonan::where('permohonansID', '=', $id)->update(['jumlahHariPermohonanBerlepas' => $length, 'statusPermohonan' => $ubah]);
            }

            flash('Berjaya dihantar.')->success();
            return redirect()->back();
            // }
        }
    }

    public function hantarRombongan($id)
    {

        $errorcheck = Permohonan::where('rombongans_id', $id)
            ->whereNotIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal', 'Lulus Semakan BPSM'])
            ->count();

        // return dd($errorcheck);

        // if ($errorcheck > 0) {

        //     flash('Terdapat ahli rombongan yang belum mendapat kelulusan ketua jabatan.')->error();
        //     return back();

        // } else{

            $d = DB::table('dokumens')
                ->where('rombongans_id', '=', $id)
                ->count();
    
            $peserta = DB::table('permohonans')
                ->where('rombongans_id', '=', $id)
                ->count();
    
            //echo $peserta;
            if ($d >= 1 && $peserta >= 1) {
                Rombongan::where('rombongans_id', $id)->update([
                    'statusPermohonanRom' => 'Pending',
                ]);
    
                Permohonan::where('rombongans_id', $id)
                ->whereNotIn('statusPermohonan', ['Permohonan Berjaya', 'Lulus Semakan BPSM'])
                ->update([
                    'statusPermohonan' => 'Permohonan Gagal'
                ]);
    
                flash('Permohonan Berjaya Dihantar.')->success();
    
                // return dd($d);
                return redirect()->back();
            } elseif ($d == 0 && $peserta == 0) {
                flash('Permohonan rombongan memerlukan dokumen rasmi dan peserta.')->error();
                return redirect()->back();
            } elseif ($d == 0) {
                flash('Permohonan rombongan memerlukan dokumen rasmi.')->error();
                return redirect()->back();
            } elseif ($peserta == 0) {
                flash('Permohonan rombongan memerlukan peserta.')->error();
                return redirect()->back();
            }
        // }
  
    }

    public function editIndividu($id)
    {
        // $userDetail = Permohonan::find($id);
        // return view('registerFormIndividuRasmi',compact('userDetail'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function hapus($id)
    {
        $permohonan = DB::table('permohonans')
            ->where('permohonansID', '=', $id)
            ->first();

        if ($permohonan != null) {
            $pathC = $permohonan->pathFileCuti;
            $dokumen = DB::table('dokumens')
                ->where('permohonansID', '=', $id)
                ->first();

            if ($dokumen > 0) {
                $path = $dokumen->pathFile;
                $pas = Pasangan::where('permohonansID', $id)->delete();
                $per = Permohonan::where('permohonansID', $id)->delete();
                $doku = Dokumen::where('permohonansID', $id)->delete();
                unlink($path);
                unlink($pathC);
                flash('Dokumen berjaya dipadamkan.')->success();
                return redirect()->back();
            } elseif ($dokumen == null) {
                $pas = Pasangan::where('permohonansID', $id)->delete();
                $per = Permohonan::where('permohonansID', $id)->delete();
                flash('Dokumen berjaya dipadamkan.')->success();
                return redirect()->back();
            } else {
                $pas = Pasangan::where('permohonansID', $id)->delete();
                $per = Permohonan::where('permohonansID', $id)->delete();
                unlink($pathC);
                flash('Dokumen berjaya dipadamkan.')->success();
                return redirect()->back();
            }
        } else {
            flash('Dokumen tidak berjaya dipadamkan.')->success();
            return redirect()->back();
        }
    }

    public function padamrombongan($id)
    {
        $permohonan = DB::table('permohonans')
            ->where('rombongans_id', '=', $id)
            ->get();

        foreach ($permohonan as $p) {
            $pathCuti = $p->pathFileCuti;
            Storage::delete($pathCuti);
            $per = Permohonan::where('rombongans_id', $id)->delete();
        }

        $dokumen = DB::table('dokumens')
            ->where('rombongans_id', '=', $id)
            ->first();

        if (!$dokumen) {
            $rombong = Rombongan::where('rombongans_id', $id)->delete();
            flash('Dokumen berjaya dipadamkan.')->success();
            return redirect()->back();
        } else {
            $path = $dokumen->pathFile;
            Storage::delete($path);
            Dokumen::where('rombongans_id', $id)->delete();
            Rombongan::where('rombongans_id', $id)->delete();

            flash('Permohonan Rombongan berjaya dipadamkan.')->success();
            return redirect()->back();
        }
    }

    public function tamatIndividu($id)
    {
        // return dd($id);
        $delfilecuti = Permohonan::where('permohonansID', $id)->first();

        Storage::delete($delfilecuti->pathFileCuti); // Padam file cuti

        Permohonan::where('permohonansID', $id)->delete(); // Padam data permohonan

        Pasangan::where('permohonansID', $id)->delete(); // Padam data pasangan

        $doc = Dokumen::where('permohonansID', $id)->get();

        foreach ($doc as $file) {
            $url = $doc->pathFile;

            Storage::delete($url); //Padam Setiap Fail Dokumen Rasmi
        }

        Dokumen::where('permohonansID', $id)->delete(); //Padam data Dokumen Rasmi

        flash('Rekod berjaya dipadamkan.')->success();
        return redirect()->back();
    }

    public function deleteFileCuti($id)
    {
        echo $id;

        $perm = Permohonan::findOrFail($id);
        if (is_null($perm->pathFileCuti)) {
            $nul = '';
            Permohonan::where('permohonansID', '=', $id)->update([
                'namaFileCuti' => $nul,
                'jenisFileCuti' => $nul,
                'pathFileCuti' => $nul,
            ]);
        } else {
            unlink($perm->pathFileCuti);

            Permohonan::where('permohonansID', '=', $id)->update([
                'namaFileCuti' => null,
                'jenisFileCuti' => null,
                'pathFileCuti' => null,
            ]);
        }

        flash('Rekod file berjaya dipadamkan.')->success();
        return redirect()->back();
    }

    public function deleteFileRasmi($id)
    {
        //echo $id;
        $dokumen = Dokumen::findOrFail($id);
        // dd($dokumen);
        $pathFile = $dokumen->pathFile;
        // echo $pathFile;
        unlink($pathFile);
        $per = Dokumen::where('dokumens_id', $id)->delete();

        flash('Rekod file berjaya dipadamkan.')->success();
        return redirect()->back();
    }

    public function kemaskiniPermohonan($id)
    {
        $permohonan = Permohonan::with('pasanganPermohonan')
            // ->with('user')
            ->where('permohonansID', '=', $id)
            ->first();
        // dd($permohonan);
        $negara = Negara::all();
        $dokumen = Dokumen::where('permohonansID', $id)->get();
        $jenis = $permohonan->JenisPermohonan;

        // dd($jenis);
        // $a=$permohonan->pasanganPermohonan->pasangansID;
        // echo $a;
        if ($jenis == 'Rasmi') {
            $typeForm = 'rasmi';
            return view('editFormIndividuRasmi', compact('permohonan', 'negara', 'typeForm', 'dokumen'));
        } elseif ($jenis == 'Tidak Rasmi') {
            $typeForm = 'tidakRasmi';
            return view('editFormIndividuRasmi', compact('permohonan', 'negara', 'typeForm', 'dokumen'));
        }
    }

    public function updatePermohonan(Request $request, $id)
    {
        // dd($request);
        $id = $request->input('id');
        $tarikhinsu = $request->input('tarikh');
        $tarikhMulaPerjalanan1 = $request->input('tarikhMulaPerjalanan');
        $tarikhAkhirPerjalanan1 = $request->input('tarikhAkhirPerjalanan');
        $negara = $request->input('negara');
        $tujuan = $request->input('tujuan');
        $alamat = $request->input('alamat');
        $phone = $request->input('phone');
        $jenisKewangan = $request->input('jenisKewangan');
        $namaPasangan = $request->input('namaPasangan');
        $emailPasangan = $request->input('emailPasangan');
        $hubungan = $request->input('hubungan');
        $alamatPasangan = $request->input('alamatPasangan');
        $phonePasangan = $request->input('phonePasangan');
        $jenisPermohonan = $request->input('jenisPermohonan');
        $pasanganID = $request->input('pasanganID');

        $DateNew11 = strtotime($tarikhinsu);
        $DateNew22 = strtotime($tarikhMulaPerjalanan1);
        $DateNew33 = strtotime($tarikhAkhirPerjalanan1);
        $tarikh = date('Y-m-d', $DateNew11);
        $tarikhMulaPerjalanan = date('Y-m-d', $DateNew22);
        $tarikhAkhirPerjalanan = date('Y-m-d', $DateNew33);

        if ($jenisPermohonan == 'Rasmi') {
            Permohonan::where('permohonansID', '=', $id)->update(['tarikhInsuran' => $tarikh, 'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan, 'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan, 'negara' => $negara, 'lainTujuan' => $tujuan, 'alamat' => $alamat, 'telefonPemohon' => $phone, 'jenisKewangan' => $jenisKewangan]);

            Pasangan::where('pasangansID', '=', $pasanganID)->update(['namaPasangan' => $namaPasangan, 'hubungan' => $hubungan, 'alamatPasangan' => $alamatPasangan, 'phonePasangan' => $phonePasangan, 'emailPasangan' => $emailPasangan]);

            if ($request->hasFile('fileRasmi')) {
                // $allowedfileExtension=['pdf','jpg','png','docx'];
                $files = $request->file('fileRasmi');

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    //dd($extension);
                    if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'docx' || $extension == 'JPG') {
                        // check folder for 'current year', if not exist, create one
                        $currYear = Carbon::now()->format('Y');
                        // $storagePath = public_path() . 'upload/dokumen/' . $currYear;
                        $storagePath = 'upload/dokumen/' . $currYear;
                        $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                        // if (!file_exists($storagePath)) {
                        //     mkdir($storagePath, 0777, true);
                        // }
                        $upload_success = $file->storeAs($storagePath, $filename);

                        if ($upload_success) {
                            $data = [
                                'namaFile' => $filename,
                                'typeFile' => $extension,
                                'pathFile' => $filePath,
                                'permohonansID' => $id,
                                'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                            ];
                            Dokumen::create($data);

                            flash('Permohonan berjaya dikemaskini.')->success();
                            return back();
                        } else {
                            Flash::error('Error uploading ' . $doc_type);
                            return redirect('');
                        }
                    } else {
                        echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                        return redirect('');
                    }
                }
            }

            flash('Berjaya dikemaskini.')->success();
            return back();
        } elseif ($jenisPermohonan == 'Tidak Rasmi') {
            $tarikhMulaCuti = $request->input('tarikhMulaCuti');
            $tarikhAkhirCuti = $request->input('tarikhAkhirCuti');
            $tarikhKembaliBertugas = $request->input('tarikhKembaliBertugas');

            $DateNew111 = strtotime($tarikhMulaCuti);
            $DateNew222 = strtotime($tarikhAkhirCuti);
            $DateNew333 = strtotime($tarikhKembaliBertugas);
            $mulacuti = date('Y-m-d', $DateNew111);
            $habiscuti = date('Y-m-d', $DateNew222);
            $mulakijo = date('Y-m-d', $DateNew333);

            Permohonan::where('permohonansID', '=', $id)->update(['tarikhInsuran' => $tarikh, 'tarikhMulaPerjalanan' => $tarikhMulaPerjalanan, 'tarikhAkhirPerjalanan' => $tarikhAkhirPerjalanan, 'negara' => $negara, 'lainTujuan' => $tujuan, 'alamat' => $alamat, 'telefonPemohon' => $phone, 'jenisKewangan' => $jenisKewangan, 'tarikhMulaCuti' => $mulacuti, 'tarikhAkhirCuti' => $habiscuti, 'tarikhKembaliBertugas' => $mulakijo]);

            Pasangan::where('pasangansID', '=', $pasanganID)->update(['namaPasangan' => $namaPasangan, 'hubungan' => $hubungan, 'alamatPasangan' => $alamatPasangan, 'phonePasangan' => $phonePasangan, 'emailPasangan' => $emailPasangan]);

            if ($request->hasFile('fileCuti')) {
                // $allowedfileExtension=['pdf','jpg','png','docx'];
                $files = $request->file('fileCuti');

                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    //dd($extension);
                    if ($extension == 'pdf' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'docx' || $extension == 'JPG') {
                        // check folder for 'current year', if not exist, create one
                        $currYear = Carbon::now()->format('Y');
                        // $storagePath = public_path() . 'upload/dokumen/' . $currYear;
                        $storagePath = 'upload/dokumen/' . $currYear;
                        $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                        // if (!file_exists($storagePath)) {
                        //     mkdir($storagePath, 0777, true);
                        // }
                        $upload_success = $file->storeAs($storagePath, $filename);

                        if ($upload_success) {
                            $perm = Permohonan::findOrFail($id);
                            if (is_null($perm->pathFileCuti)) {
                                Permohonan::where('permohonansID', '=', $id)->update([
                                    'namaFileCuti' => $filename,
                                    'jenisFileCuti' => $extension,
                                    'pathFileCuti' => $filePath,
                                    'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                    'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                                ]);
                            } else {
                                unlink($perm->pathFileCuti);

                                Permohonan::where('permohonansID', '=', $id)->update([
                                    'namaFileCuti' => $filename,
                                    'jenisFileCuti' => $extension,
                                    'pathFileCuti' => $filePath,
                                    'created_at' => \Carbon\Carbon::now(), # \Datetime()
                                    'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                                ]);
                            }
                        } else {
                            Flash::error('Error uploading ' . $doc_type);
                            return redirect('');
                        }
                    } else {
                        echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                        return redirect('');
                    }
                }
            }

            flash('Berjaya dikemaskini.')->success();
            return back();
        }
    }

    public function senaraiPermohonanProses($id)
    {
        $userDetail = User::find($id);

        $permohonan = Permohonan::where('usersID', $id)
            ->whereNotIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal' ])
            ->orderBy('created_at', 'desc')
            ->get();

        $rombongan = Rombongan::where('usersID', $id)
        ->whereNotIn('statusPermohonanRom', ['Permohonan Berjaya', 'Permohonan Gagal' ])
        ->get();

        $allPermohonan = Permohonan::with('user')->get();

        //dd($ss);
        return view('pengguna.senaraiPermohonan', compact('permohonan', 'rombongan', 'userDetail', 'allPermohonan'));
    }

    public function senaraiPermohonanIndividu($id)
    {
        $userDetail = User::find($id);

        $permohonan = Permohonan::where('usersID', $id)
            ->whereIn('statusPermohonan', ['Permohonan Berjaya', 'Permohonan Gagal'])
            ->orderBy('created_at', 'desc')
            ->get();

        $rombongan = Rombongan::where('usersID', $id)->get();
        //$allPermohonan= Permohonan::all();
        $allPermohonan = Permohonan::with('user')->get();

        //dd($ss);
        return view('pengguna.senaraiPermohonanIndividu', compact('permohonan', 'rombongan', 'userDetail', 'allPermohonan'));
    }

    public function senaraiPermohonanRombongan($id)
    {
        $rombongan = Rombongan::where('usersID', $id)
        ->whereIn('statusPermohonanRom', ['Permohonan Berjaya', 'Permohonan Gagal'])
        ->get();

        $allPermohonan = Permohonan::with('user')->get();

        $peserta = Permohonan::with('user')
            ->where('rombongans_id', $id)
            ->get();

        // return dd()
        return view('pengguna.senaraiPermohonanRombongan', compact('rombongan', 'allPermohonan'));
    }
}
