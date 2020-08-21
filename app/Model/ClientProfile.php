<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    public function client(){
        return $this->belongsTo('\App\Model\User', 'client_id');
    }
}
