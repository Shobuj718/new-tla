<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public function project() {
        return $this->belongsTo('\App\Model\Project', 'case_id');
    }

    public function lawyer() {
        return $this->belongsTo('App\Model\User', 'lawyer_id')->where('type','=','lawyer');
    }
    
    public function sows(){
        return $this->hasMany('App\Model\Sow', 'proposal_id');
    }

    public function attachments(){
        return $this->hasMany(ProposalAttachment::class, 'proposal_id');
    }

    public function setBudgetAttribute($value){
        return $this->attributes["budget"] = (int) ( ( (float) $value) * 100 );
    }

    public function getBudgetInCentsAttribute(){
        return (int) $this->budget * 100;
    }

    public function getBudgetAttribute($value){
        return ((int) $value) / 100;
    }

    public function getShortDescriptionAttribute(){
        return mb_substr(strip_tags($this->description), 0 , 255);
    }
    
    public function payment(){
        return $this->hasOne(ProjectPayment::class, 'proposal_id');
    }
}
