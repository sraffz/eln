<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasangan extends Model
{
    protected $primaryKey='pasangansID';

    protected $fillable=['namaPasangan','hubungan','alamatPasangan','phonePasangan','emailPasangan','permohonansID'];

    protected $table = 'pasangans';

    public $timestamps = true;

    public function userPasangan()
    {
    	return $this->hasMany(\App\Permohonan::class,'permohonansID','permohonansID');
    }
}
