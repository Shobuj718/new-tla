<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    
    protected $fillable = [
        'first_name', 'last_name', 'lsm_number', 'cpc_number', 'username', 'email', 'country_code', 'gender', 'password', 'original_password', 'type', 'email_confirmation_code', 'approved'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function subscribed(){
        $latestSubscription = $this->subscriptions()->orderBy("id", "desc")->first();

        if($latestSubscription){
            $valid_till = Carbon::createFromFormat('Y-m-d H:i:s', $latestSubscription->valid_till);

            return $valid_till->isFuture() || $valid_till->isToday();
        }

        return false;
    }

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function projects() {
        if ($this->type == "lawyer"){
            //return $this->hasMany('App\Project', 'assigned_to', 'id');
            return $this->hasMany('App\Model\Project', 'created_by', 'id');
        }

        if($this->type == "client") {
            return $this->hasMany('App\Model\Project', 'created_by', 'id');
        }

        return [];
    }
    
    // SOWs = scopes of work.
    
    public function sows() {
        if ($this->type == "lawyer"){
            return $this->hasMany('App\Model\Sow', 'lawyer_id', 'id');
        }

        if($this->type == "client") {
            return $this->hasMany('App\Model\Sow', 'client_id', 'id');
        }

        return [];
    }
    
    public function activeProjects(){
        return $this->projects()->where('status', 'hired')->get();
    }
    
    public function approvedProjects(){
        return $this->projects()->where('status', 'approved')->get();
    }
    
    public function completeProjects(){
        return $this->projects()->where('status', 'complete')->get();
    }
    public function completeProjects2(){
        return $this->projects()->where('status', 'approved')->get();
    }
    public function getPendingCases(){
        return $this->projects()->where('status', 'pending')->get();
    }


    public function bids() {
        return $this->hasMany('App\Model\Bid', 'lawyer_id', 'id');
    }

    public function appliedProjects() {
        return $this->belongsToMany('App\Model\Project', 'project_bidder', 'user_id', 'project_id');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function accountTabComplete(){
        if($this->type == "client"){
            return $this->first_name && $this->last_name && $this->location && $this->email;
        }

        if($this->type == "lawyer"){
            return $this->avatar && $this->first_name && $this->last_name && $this->location && $this->email && $this->professional_title;
        }

        return false;
    }

    public function profileTabComplete(){
        if($this->type == "client"){
            // return (bool) $this->about;
            return true;
        }

        if($this->type == "lawyer"){
            //return $this->about && ($this->exp_years || $this->exp_months) && $this->lca && $this->documents->count() && $this->skills->count();
            return $this->about && ($this->exp_years || $this->exp_months)  && $this->skills->count();
        }

        return false;
    }
    
    public function bankTabComplete(){
        if($this->type == "client") return true;
        
        if($this->type == "lawyer"){
            return $this->account_name && $this->bank_name && $this->bsb_no && $this->account_no;
        }
        
        return false;
    }

    public function profileComplete(){
        // $othersComplete = false;

        // if($this->type=="lawyer"){
        //     $othersComplete = $this->subscribed() && $this->phone_verified;
        // }

        // if($this->type =="client"){
        //     $othersComplete = $this->phone_verified;
        // }
        
        // return $this->profileTabComplete() && $this->accountTabComplete() && $this->bankTabComplete() && $othersComplete;
        
        $othersComplete = false;

        if($this->type=="lawyer"){
            // $othersComplete = $this->subscribed() && $this->phone_verified;
            $othersComplete = true;
        }

        if($this->type =="client"){
            // $othersComplete = $this->phone_verified;
            $othersComplete = true;
        }
        
        return $this->profileTabComplete() && $this->accountTabComplete() && $this->bankTabComplete() && $othersComplete;
    }
    
    public function initialProfileComplete() {
        
        if($this->type=="lawyer") {
            return $this->profileTabComplete() && $this->accountTabComplete() && $this->bankTabComplete() && $this->phone_verified;
        } 
        
        else if($this->type=="client") {
            return $this->accountTabComplete() && $this->phone_verified;
        } else {
            return true;
        }
        
    }

    public function getNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function getPhoneAttribute(){
        return "{$this->country_code} {$this->phone_number}";
    }

    public function interviews(){
        if($this->type == "admin") return [];

        return $this->hasMany(Interview::class, $this->type.'_id');
    }
    
    public function getLocationsInRangeAttribute(){
        if($this->type == "lawyer"){
            $location_ids_within200km = DB::table('locations')
                ->selectRaw("id, ( 6371 * acos( cos( radians({$this->location->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$this->location->lng}) ) + sin( radians({$this->location->lat}) ) * sin(radians(lat)) ) ) AS distance")
                ->havingRaw("distance < 200")
                ->get()
                ->pluck('id')
                ->toArray();
                
            return $location_ids_within200km;
        }
        
        return [];
    }
    
    public function dashboardCasesQuery(){
        
        if($this->type == "client"){
            return $this->projects()->orderBy('created_at', 'desc');
        }
        
        /*if($this->type == "lawyer"){
            $query = Project::where('location_id', 3)->where('status', 'approved')->orderBy('id', 'desc');

            return $query;
        }*/

        if($this->type == "lawyer"){
            
            /*
            $location_ids_within200km = DB::table('locations')
                ->selectRaw("id, ( 6371 * acos( cos( radians({$this->location->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$this->location->lng}) ) + sin( radians({$this->location->lat}) ) * sin(radians(lat)) ) ) AS distance")
                ->havingRaw("distance < 200")
                ->get()
                ->pluck('id')
                ->toArray();
                
            */
 
            $projectsMatchingSkills = DB::table('project_skill')
                ->join('skill_user', 'project_skill.skill_id', '=', 'skill_user.skill_id')
                ->where('skill_user.user_id', $this->id)
                ->select('project_skill.project_id')
                ->groupBy('project_skill.project_id')
                ->get()
                ->pluck('project_id')
                ->toArray();
            
            //return $projectsMatchingSkills;
            
            
             $location_ids_within200km = DB::table('projects')
                ->selectRaw("*, ( 6371 * acos( cos( radians({$this->location->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$this->location->lng}) ) + sin( radians({$this->location->lat}) ) * sin(radians(lat)) ) ) AS distance")
                //->havingRaw("distance < 200")
                ->whereRaw(" ( 6371 * acos( cos( radians({$this->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$this->lng}) ) + sin( radians({$this->lat}) ) * sin(radians(lat)) ) ) <= 200 
            and projects.id IN (select project_id from project_skill where project_id = projects.id )
            and status in ('approved', 'interviewing')")
                ->whereIn('id', $projectsMatchingSkills)
                ->orderBy('id', 'desc');
               
               
            return $location_ids_within200km; 
            
            /* $results = DB::select("select id, title, lat, lng, 
            ( 6371 * acos( cos( radians({$this->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$this->lng}) ) + sin( radians({$this->lat}) ) * sin(radians(lat)) ) ) AS distance 
            
            from projects 

            where ( 6371 * acos( cos( radians({$this->lat}) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians({$this->lng}) ) + sin( radians({$this->lat}) ) * sin(radians(lat)) ) ) <= 200 
            and projects.id IN (select project_id from project_skill where project_id = projects.id )
            and status in ('approved', 'interviewing')

            
            ");
                
            //return $results;
            
            $biddableStatuses = [
                'approved',
                'interviewing',
            ];
            */
            //$query = Project::whereIn('location_id', $location_ids_within200km)->whereIn('id', $projectsMatchingSkills)->whereIn('status', $biddableStatuses)->orderBy('id', 'desc');
            //$query = Project::whereIn('location_id', $location_ids_within200km)->whereIn('id', $projectsMatchingSkills)->whereIn('status', $biddableStatuses)->orderBy('id', 'desc')->get();

            //return $query;
        }
        
       // return false;
    }

    public function getDashboardCasesAttribute(){
        
        $query = $this->dashboardCasesQuery();
        
        return $query ? $query->paginate(10) : [];
    }

    public function getAvatarAttribute($value){
        return $value ?? 'assets/img/user.png';
    }

    public function getTotalSpentAttribute(){
        //TODO:: Create project_payments table and get this data
        return 0;
    }

    public function getCasePostedAttribute(){
        return Project::where('created_by', $this->id)->where('status', '!=', 'pending')->count();
    }
    
    public function getCaseCompletedAttribute(){
        return Project::where('assigned_to', $this->id)->where('status', 'complete')->count();
    }
    
    public function getAvgRatingAttribute(){
        return Review::where('received_by', $this->id)->avg('star');
    }
    
    public function reviews(){
        return $this->hasMany(Review::class, 'received_by');
    }
    
    public function initialOfLastName() {                                                        
        $splitedLastName = str_split($this->last_name, 1);
        return $splitedLastName[0];
    }
}
