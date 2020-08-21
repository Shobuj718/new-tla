<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    // protected $table='projects';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'valid_till'
    ];

    public function client() {
        return $this->belongsTo('App\Model\User', 'created_by');
    }

    public function lawyer() {
        return $this->belongsTo('App\Model\User', 'assigned_to');
    }

    public function skills() {
        return $this->belongsToMany('App\Model\Skill', 'project_skill');
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    public function tags() {
        return $this->belongsToMany('App\Model\Tag', 'project_tag');
    }

    public function bids() {
        return $this->hasMany('App\Model\Bid', 'case_id', 'id');
    }
    
    public function sows() {
        return $this->hasMany('App\Model\Sow', 'project_id', 'id');
    }

    public function location() {
        return $this->belongsTo('App\Model\Location');
    }

    public function findBidByUserId($user_id){
        return  $this->bids()->where('lawyer_id', $user_id)->select('slug')->first();
    }

    public function setBudgetAttribute($value){
        return $this->attributes["budget"] = (int) ( ( (float) $value ) * 100);
    }

    public function getBudgetAttribute($value){
        return ( (int) $value ) / 100;
    }

    public function getBudgetInCentsAttribute(){
        return (int) $this->budget * 100;
    }

    public function getShortDescriptionAttribute(){
        return mb_substr(strip_tags($this->description), 0 , 255);
    }

    public function getAvgBidAttribute(){
        return $this->bids()->avg('budget') / 100;
    }

    // public function getStatusAttribute($value){
    //     return "<span class='".$value."'>".str_replace("_", " ", title_case($value))."</span>";
    // }
    
    public function received_review($user_id){
        return Review::where('project_id', $this->id)->where('received_by', $user_id)->first();
        
    }
    
    
    public function payment(){
        return $this->hasOne(ProjectPayment::class);
    }
    
    
}
