<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function lawyer(){
        return $this->belongsTo('App\Model\User', 'user_id')->where('type', '=', 'lawyer');
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
