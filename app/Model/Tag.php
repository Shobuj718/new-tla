<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function projects() {
        return $this->belongsToMany('App\Model\Project', 'project_tag');
    }
}
