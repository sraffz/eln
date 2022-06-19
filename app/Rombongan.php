<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombongan extends Model
{
    protected $primaryKey='rombongans_id';

    protected $fillable=['tarikhMulaRom','tarikhAkhirRom', 'catatan_permohonan', 'tarikhInsuranRom','tarikhStatusPermohonan','codeRom','negaraRom','alamatRom','statusPermohonanRom','tujuanRom','jenisKewanganRom','anggaranBelanja'];

    protected $table = 'rombongans';

    protected $dates = ['tarikhInsuranRom', 'tarikhMulaRom', 'tarikhAkhirRom'];

    public $timestamps = true;

    public function permohonanRombongan()
    {
    	return $this->hasMany(\App\Permohonan::class,'rombongans_id','rombongans_id');
    }

    public function user()
    {
        // return $this->belongsTo('App\User');
    	return $this->belongsTo(\App\User::class,'usersID','usersID');
    }

    // public function dokumenFile(){
    //     return $this->hasMany('App\Dokumen');
    // }
}
