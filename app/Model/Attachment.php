<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
