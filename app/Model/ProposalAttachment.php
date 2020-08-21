<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProposalAttachment extends Model
{
    public function proposal(){
        return $this->belongsTo(Bid::class, 'proposal_id');
    }
}
