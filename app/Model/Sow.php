<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sow extends Model {
    
    public function project() {
        return $this->belongsTo('App\Model\Project', 'project_id');
    }
    
    public function proposal() {
        return $this->belongsTo('App\Model\Bid', 'proposal_id');
    }
    
    public function client() {
        return $this->belongsTo('App\Model\User', 'client_id');
    }

    public function lawyer() {
        return $this->belongsTo('App\Model\User', 'lawyer_id');
    }
}
