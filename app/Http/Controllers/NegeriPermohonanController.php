<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
use Validator;
use Carbon\Carbon;

use App\Permohonan_Negeri;

use Illuminate\Http\Request;

class NegeriPermohonanController extends Controller
{
    public function index()
    {
        return view('pengguna.negeri.homepage');
    }

    public function borangPermohonan()
    {

        $negeri = DB::table('negeri')->whereNotIn('negeri', ['Kelantan'])->get();

        return view('pengguna.negeri.borang-permohonan', compact('negeri'));
    }

    public function senaraiPermohonan()
    {
        return view('pengguna.negeri.senarai-permohonan');
    }

    public function keputusanPermohonan()
    {
        return view('pengguna.negeri.keputusan-permohonan');
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
            'dokumen.*' => 'mimes:doc,pdf,docx|max:1024',
            // 'fileCuti.*' => 'mimes:doc,pdf,docx|max:1024',
        ], [
            'dokumen.max' => 'fail yang dimuatnaik mesti tidak boleh melebihi 1MB',
            'dokumen.mimetypes' => 'Fail perlu dimuatnaik dalam format PDF',
        ]);

        $id_permohoanan = Permohonan_Negeri::insertGetId([
            'program' => $request->program,
            'tarikh_mula' => $request->tarikhMula,
            'tarikh_akhir' => $request->tarikhAkhir,
            'tempat_program' => $request->tempat_program,
            'negeri' => $request->negeri,
            'negeri_lebih_dari_satu' => $request->negeri_lebih,
            'negeri_tambahan' => $request->negeri_tambahan,
            'dokumen_program' => $request->dokumen,
            'no_tel' => $request->phone,
            'jenis_perjalanan' => $request->jenisKenderaan,
            'status' => $request->status,
            'created_at' => \Carbon\Carbon::now()
         ]);

         

        Alert::success('Berjaya', 'Permohonan Berjaya Dihantar');
        return back();
    }
}
