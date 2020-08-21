<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    public function case(){
        return $this->belongsTo('\App\Model\Case', 'case_id');
    }
}
