<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Permohonan_Negeri;

use Illuminate\Http\Request;

class NegeriPermohonanController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'pengguna') {
            return view('pengguna.negeri.homepage');
        } elseif ($role == 'adminBPSM') {
            return view('pengguna.negeri.homepage');
        } elseif ($role == 'DatoSUK') {
            return view('ketua.negeri.homepage');
        } elseif ($role == 'jabatan') {
            return view('pengguna.negeri.homepage');
        }
    }

    public function borangPermohonan()
    {

        $negeri = DB::table('negeri')->whereNotIn('negeri', ['Kelantan'])->get();
        
        return view('pengguna.negeri.borang-permohonan', compact('negeri'));
    }
    
    public function butiranPermohonan($id)
    {
        $negeri = DB::table('negeri')->whereNotIn('negeri', ['Kelantan'])->get();
        $detail = Permohonan_Negeri::where('id', $id)->first();
 
        return view('pengguna.negeri.butiran-permohonan', compact('detail', 'negeri'));
    }
    
    public function downloadDokumen($id)
    {
        $permohonan = Permohonan_Negeri::find($id);
        $path = $permohonan->dokumen;
        dd($path);

        return Storage::download($id, 'Dokumen Rasmi.pdf');
    }

    public function senaraiPermohonan()
    {
        $list = Permohonan_Negeri::where('id_user', Auth::user()->usersID)
        ->where('status', 'Dihantar')->get();

        return view('pengguna.negeri.senarai-permohonan', compact('list'));
    }

    public function keputusanPermohonan()
    {
        $list = Permohonan_Negeri::where('id_user', Auth::user()->usersID)
        ->whereIn('status', ['Berjaya', 'Gagal'])->get();

        return view('pengguna.negeri.keputusan-permohonan', compact('list'));
    }

    public function hantarPermohonan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'program' => 'required',
            'tarikhMula' => 'required',
            'tarikhAkhir' => 'required',
            'tempat_program' => 'required',
            'jenisKenderaan' => 'required',
            'negeri' => 'required',
            'negeri_tambahan' => 'required_if:negeri_lebih,1',
            // 'gaji' => 'required_if:jenisKenderaan,Kenderaan Pejabat',
            'jenis_kenderaan' => 'required_if:jenisKenderaan,Kenderaan Pejabat',
            'no_kenderaan' => 'required_if:jenisKenderaan,Kenderaan Pejabat',
             'dokumen.*' => 'mimes:doc,pdf,docx|max:1024|required'
        ], [
            'dokumen.max' => 'fail yang dimuatnaik mesti tidak boleh melebihi 1MB',
            'dokumen.mimetypes' => 'Fail perlu dimuatnaik dalam format PDF',
        ]);

        if ($request->negeri_lebih == 1) {
            $negeri_lebih = 1;
            $negeri_tambahan = implode(', ', $request->input('negeri_tambahan'));
        } else {
            $negeri_lebih = 0;
            $negeri_tambahan = '';
        }

        $id_permohoanan = Permohonan_Negeri::insertGetId([
            'id_user' => Auth::user()->usersID,
            'program' => $request->program,
            'tarikh_mula' => $request->tarikhMula,
            'tarikh_akhir' => $request->tarikhAkhir,
            'tempat_program' => $request->tempat_program,
            'negeri' => $request->negeri,
            'negeri_lebih_dari_satu' => $negeri_lebih,
            'negeri_tambahan' => $negeri_tambahan,
            'dokumen_program' => 'test',
            'no_tel' => $request->phone,
            'catatan' => $request->catatan_permohonan,
            'jenis_perjalanan' => $request->jenisKenderaan,
            'status' => 'Dihantar',
            'created_at' => \Carbon\Carbon::now()
         ]);

         if ($request->hasFile('dokumen')) {

            $files = $request->file('dokumen');
            $locations = [];

            foreach ($files as $file) {
                $filename = $file->hashName();
                $extension = $file->extension();
                $currYear = Carbon::now()->format('Y');
                $storagePath = 'upload/negeri/dokumen/' . $currYear;
                $filePath = str_replace(base_path() . '/', '', $storagePath) . '/' . $filename;

                $upload_success = $file->storeAs($storagePath, $filename);

                if ($upload_success) {
                    // $data = [
                    //     'namaFile' => $filename,
                    //     'typeFile' => $extension,
                    //     'pathFile' => $filePath,
                    //     'permohonansID' => $idPermohonan,
                    //     'created_at' => \Carbon\Carbon::now(), # \Datetime()
                    //     'updated_at' => \Carbon\Carbon::now(), # \Datetime()
                    // ];
                    // Dokumen::create($data);
                   
                    $locations[] = $filePath;
                }
            }

            $allFiles = implode(", ",$locations);
            // dd( $allFiles);

            Permohonan_Negeri::where('id', $id_permohoanan)->update([
                'dokumen_program' => $allFiles
            ]);
        }

         if ($request->jenisKenderaan == 'Kenderaan Sendiri') {
            DB::table('negeri_kenderaan_sendiri')->insert([
                'id_permohonan' => $id_permohoanan,
                'jenis_kenderaan' => $request->jenis_kenderaan,
                'no_kenderaan' => $request->no_kenderaan,
                'kuasa_enjin_kenderaan' => $request->kuasa_enjin,
                // 'gaji' => $request->gaji,
                // 'kelas_perbatuan_kenderaan' => $request->kelas_perbatuan,
                'status' => 'baru',
                'created_at' => \Carbon\Carbon::now()
             ]);
         }elseif ($request->jenisKenderaan == 'Waran Udara') {
            
         }

        Alert::success('Berjaya', 'Permohonan Berjaya Dihantar');
        return redirect()->route('negeri.senarai-permohonan');
    }

    public function senaraiPermohonanPelulus() {
        $list = Permohonan_Negeri::where('status', 'Dihantar')->get();

        return view('ketua.negeri.senarai-permohonan', compact('list'));
    }
    
    public function lulusPermohonan($id) {
        Permohonan_Negeri::where('id', $id)->update([
            'status' => 'Berjaya'
        ]);

         toast('Permohonan Diluluskan', 'success')->position('top-end');        
        return back();
    }

    public function tolakPermohonan($id) {
        Permohonan_Negeri::where('id', $id)->update([
            'status' => 'Gagal'
        ]);

        toast('Permohonan Ditolak', 'error')->position('top-end');        
        return back();
    }

    public function rekodPermohonanPelulus() {
        $rekod = Permohonan_Negeri::whereIn('status', ['Berjaya', 'Gagal'])->get();

        return view('ketua.negeri.keputusan-permohonan', compact('rekod'));
    }
}