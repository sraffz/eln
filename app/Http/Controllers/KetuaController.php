<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permohonan;
use App\Pasangan;
use App\Rombongan;
use App\User;
use App\Notifications\PermohonanBerjaya;
use DB;
use Notification;
use Carbon\Carbon;

class KetuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permohonan = Permohonan::where('statusPermohonan', 'Lulus Semakan BPSM')
                    ->get();
                    
        return view('ketua.senaraiPermohonan',compact('permohonan'));
    }

    public function senaraiLulus()
    {
        $rombongan = Rombongan::whereIn('statusPermohonanRom', ['Permohonan Berjaya', 'Permohonan Gagal'])
                    ->get();

        $allPermohonan = Permohonan::with('user')
                        ->where('statusPermohonan', ['Permohonan Berjaya','Permohonan Gagal'])
                        ->get();

        return view('ketua/senaraiDiLuluskan',compact('allPermohonan','rombongan'));
    }

    public function senaraiRombonganKetua()
    {
        // $rombongan = Rombongan::all();
        $allPermohonan = Permohonan::with('user')
                        ->where('statusPermohonan','!=','Permohonan Gagal')
                        ->get();
        //$post = Permohonan::with('pasangans')->where('statusPermohonan','=','Pending')->get();   //sama gak nga many to many
        $rombongan = Rombongan::where('statusPermohonanRom', 'Lulus Semakan')
                    ->get();
        return view('ketua/senaraiRombonganKetua',compact('rombongan','allPermohonan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        //
    }

    public function editPermohonan(Request $request)
    {
        
        //$kope = Koperasi::all();
       
        $sebab= $request -> input('sebab');
        $permohonansID= $request -> input('permohonansID');
        $status="Permohonan Ditolak";

         Permohonan::where('permohonansID', '=', $permohonansID)
                        ->update(['sebabDitolak' => $sebab]);

        Permohonan::where('permohonansID', '=', $permohonansID)
                        ->update(['statusPermohonan' => $status]);

        Permohonan::where('permohonansID', '=', $permohonansID)
                        ->update(['tarikhLulusan' => \Carbon\Carbon::now() ]);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function hantar($id)
    {
        $ubah = "Permohonan Berjaya";

        $ruj = Permohonan::where('permohonansID', $id)
                ->with('user')
                ->first();

        
        // if (is_null($ruj)) 
        // {
            // $ruj_id = 1;
            // $jib = 1;
            // $bil = 1;
        // Permohonan::where('permohonansID', '=', $id)
        //         ->update(['statusPermohonan' => $ubah,'tarikhLulusan' => \Carbon\Carbon::now(),'no_ruj_file' => $jib , 'no_ruj_bil' =>$bil,'no_ruj_latest'=>1]);

        $emailnakHantar=$ruj->user;
        $negara=$ruj->negara;
        $tarikhMulaPerjalanan = Carbon::parse($ruj->tarikhMulaPerjalanan)->format('d-m-Y');
        $tarikhAkhirPerjalanan = Carbon::parse($ruj->tarikhAkhirPerjalanan)->format('d-m-Y');
        $nokp=$ruj->user->nokp;
        $nama=$ruj->user->nama;

        // dd($tarikhMulaPerjalanan);
        Permohonan::where('permohonansID', '=', $id)
                 ->update(['statusPermohonan' => $ubah,'tarikhLulusan' => \Carbon\Carbon::now()]);

                 
                 // xjadi email
        // Notification::send($emailnakHantar,new PermohonanBerjaya($negara,$tarikhMulaPerjalanan,$tarikhAkhirPerjalanan,$nokp,$nama));




        // }
        // else
        // {
            // $ruj_id = $ruj->permohonansID;
            // $jib = $ruj->no_ruj_file;
            // $bil = $ruj->no_ruj_bil;

            // if ($bil <= 199) 
            // {
            //    $bil=$bil+1;

            //    Permohonan::where('permohonansID', '=', $ruj_id)
            //                  ->update(['no_ruj_latest'=>0]);

            //    Permohonan::where('permohonansID', '=', $id)
            //                  ->update(['statusPermohonan' => $ubah,'tarikhLulusan' => \Carbon\Carbon::now(),'no_ruj_file' => $jib , 'no_ruj_bil' =>$bil,'no_ruj_latest'=>1]);

                
            // }
            // else
            // {
            //     $jib=$jib+1;

            //     Permohonan::where('permohonansID', '=', $ruj_id)
            //                  ->update(['no_ruj_latest'=>0]);

            //     Permohonan::where('permohonansID', '=', $id)
            //                  ->update(['statusPermohonan' => $ubah,'tarikhLulusan' => \Carbon\Carbon::now(),'no_ruj_file' => $jib , 'no_ruj_bil' =>0,'no_ruj_latest'=>1]);
            // }
        // }
       
        flash('Permohonan Berjaya.')->success();
        return redirect()->back();
    }

    public function ketuaSentRombongan($id)
    {
        $ubah = "Permohonan Berjaya";
        
        Rombongan::where('rombongans_id', '=', $id)
                    ->update(['statusPermohonanRom' => $ubah,'tarikhStatusPermohonan' => \Carbon\Carbon::now()]);


        $senarai = DB::table('permohonans')
                    ->where('rombongans_id','=', $id)
                    ->where('statusPermohonan','!=','Permohonan Gagal')
                    ->get();

        // dd($senarai);
        foreach ($senarai as $sena)
        {
            $idPermohonan=$sena->permohonansID;
            // echo $idPermohonan;
            Permohonan::where('permohonansID', '=', $idPermohonan)->update(['statusPermohonan' => $ubah]);
            Permohonan::where('permohonansID', '=', $idPermohonan)->update(['tarikhLulusan' => \Carbon\Carbon::now()]);
        }

        flash('Permohonan Berjaya.')->success();
        return redirect()->back();
    }

    public function ketuaRejectRombongan($id)
    {
        $ubah = "Permohonan Gagal";
        
        Rombongan::where('rombongans_id', '=', $id)
                    ->update(['statusPermohonanRom' => $ubah,'tarikhStatusPermohonan' => \Carbon\Carbon::now()]);


        $senarai = DB::table('permohonans')
                    ->where('rombongans_id','=', $id)
                    ->get();

        // dd($senarai);
        foreach ($senarai as $sena)
        {
            $idPermohonan=$sena->permohonansID;
            // echo $idPermohonan;
            Permohonan::where('permohonansID', '=', $idPermohonan)->update(['statusPermohonan' => $ubah]);
            Permohonan::where('permohonansID', '=', $idPermohonan)->update(['tarikhLulusan' => \Carbon\Carbon::now()]);
        }

        flash('Permohonan Gagal.')->success();
        return redirect()->back();
    }

    public function tolakPermohonan($id)
    {
        $ubah = "Permohonan Gagal";
        
        Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah]);
        Permohonan::where('permohonansID', '=', $id)->update(['tarikhLulusan' => \Carbon\Carbon::now()]);

        flash('Permohonan Gagal.')->success();
        return redirect()->back();
    } 

    public function permohonanGagalKetua($id)
    {
        $ubah = "Permohonan Gagal";
        
        Permohonan::where('permohonansID', '=', $id)->update(['statusPermohonan' => $ubah]);
        Permohonan::where('permohonansID', '=', $id)->update(['tarikhLulusan' => \Carbon\Carbon::now()]);

        flash('Permohonan Gagal.')->success();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jumlahKeluarnegara()
    {
        $senaraiPermohonan = Permohonan::where('statusPermohonan','Permohonan Berjaya')
                            ->get();

        $senaraiPengguna=Permohonan::where('statusPermohonan', 'Permohonan Berjaya')
                            ->distinct()
                            ->with('user')
                            ->get(['usersID']);

        // dd($senaraiPengguna);
        return view('ketua/jumlahKeLuarnegara',compact('senaraiPermohonan','senaraiPengguna'));
        
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
}
