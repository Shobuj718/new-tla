<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    public function lawyer(){
        return $this->belongsTo(User::class, 'lawyer_id');
    }


    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }
    
    public function proposal() {
        return $this->hasOne(Bid::class, 'id', 'proposal_id');
    }
    

    public function details(){
        return $this->belongsTo(SquareupPayment::class, 'payment_id');
    }
}
