<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $primaryKey='permohonansID';

    protected $fillable=['tarikhMulaPerjalanan','tarikhAkhirPerjalanan','tarikhInsuran','negara','alamat','statusPermohonan','tarikhMulaCuti','tarikhAkhirCuti','tarikhKembaliBertugas','namaFileCuti','jenisFileCuti','pathFileCuti','JenisPermohonan','jenisKewangan','lainTujuan','telefonPemohon','tarikhLulusan','tick','ulasan','no_ruj_file','no_ruj_bil','no_ruj_latest','jumlahHariPermohonanBerlepas','usersID','rombongans_id', 'catatan_permohonan'];

    protected $table = 'permohonans';

    // protected $dates = ['tarikhMulaPerjalanan', 'tarikhAkhirPerjalanan'];

    public $timestamps = true;

    public function user()
    {
        // return $this->belongsTo('App\User');
    	return $this->belongsTo(\App\User::class,'usersID','usersID');
    }
    public function dokumenFile(){
        return $this->hasMany(\App\Dokumen::class,'permohonansID','permohonansID');
        // return $this->hasMany('App\Dokumen');
    }
    public function rombonganPermohonan()
    {
        return $this->hasOne(\App\Rombongan::class,'rombongans_id','rombongans_id');
    }
    public function pasanganPermohonan()
    {
        return $this->hasOne(\App\Pasangan::class,'permohonansID','permohonansID');
    }

    public function jabatan()
    {
        return $this->hasManyThrough('App\Jabatan', 'App\User', 'jabatan', 'jabatan_id', 'permohonansID', 'usersID');
    }

    public function jumlahKeluarNegara($id) 
    {
        // $jumlah=1;
        $tahun=date('Y');
        // $today = Carbon::now();
        $jumlah = Permohonan::where('usersID', $id)
                    ->where('statusPermohonan', 'Permohonan Berjaya')
                    ->whereYear('tarikhMulaPerjalanan', '=', $tahun)
                    ->count();
                    
        return $jumlah;
    }
    
    public function tpermohonan()
    {
       return $tpermohonan =  $this->create_at;
    }
}
