<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombongan extends Model
{
    protected $primaryKey='rombongans_id';

    protected $fillable=['tarikhMulaRom','tarikhAkhirRom','tarikhInsuranRom','tarikhStatusPermohonan','codeRom','negaraRom','alamatRom','statusPermohonanRom','tujuanRom','jenisKewanganRom','anggaranBelanja'];

    protected $table = 'rombongans';

    public $timestamps = true;

    public function permohonanRombongan()
    {
    	return $this->hasMany(\App\Permohonan::class,'rombongans_id','rombongans_id');
    }
    // public function dokumenFile(){
    //     return $this->hasMany('App\Dokumen');
    // }
}
