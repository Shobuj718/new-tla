<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function lawyers(){
        return $this->hasMany('\App\Model\User')->where('type', '=', 'lawyer');
    }

    public function clients(){
        return $this->hasMany('\App\Model\User')->where('type', '=', 'client');
    }

    public function projects() {
        return $this->hasMany('App\Model\Project');
    }
}
