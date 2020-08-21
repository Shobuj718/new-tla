<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function lawyers(){
        return $this->hasMany('\App\Model\User')->where('type', '=', 'lawyer');
    }

    public function cases(){
        return $this->hasMany('\App\Model\Case');
    }

    public function projects() {
        return $this->belongsToMany('App\Model\Project', 'project_skill');
    }
}
