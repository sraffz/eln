<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ELN_Pindaan extends Model
{
    protected $table = 'eln_pindaan';

    protected $dates = ['tarikhMulaPinda', 'tarikhAkhirPinda', 'tarikh_pinda'];
}
