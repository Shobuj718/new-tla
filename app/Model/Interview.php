<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Interview extends Model
{
    public function proposal(){
        return $this->belongsTo(Bid::class, 'proposal_id');
    }

    public function lawyer(){
        return $this->belongsTo(User::class, 'lawyer_id');
    }

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function messagesForInterviewPage(){
        $messages = DB::table('messages')
            ->join('interviews', 'messages.interview_id', '=', 'interviews.id')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->where('interviews.id', '=', $this->id)
            ->selectRaw('interviews.slug, messages.sender_id, messages.recipient_id, messages.body, messages.attachment, DATE_FORMAT(messages.created_at, "%M %d, %Y") AS create_date, TIME_FORMAT(messages.created_at, "%h:%i %p") AS create_time, users.avatar')
            ->orderBy('messages.created_at', 'asc')
            ->get();

        return $messages;
    }

    public function messagesForInterviewPageNew(){
        
        $messages = array();
        
            $interview = Interview::where('id', $this->id)->first();
            
            $sender_id ='';
            $recipient_id ='';
            
            $sendertype = "";
            
            if($interview->lawyer_id == Auth::user()->id){
                $sender_id = $interview->lawyer_id;
                $recipient_id = $interview->client_id;
                $sendertype = "Lawyer";
            }
    
            if($interview->client_id == Auth::user()->id){
                $sender_id = $interview->client_id;
                $recipient_id = $interview->lawyer_id;
                $sendertype = "Client";
            }
            
            $sql = "";
        
        if($sendertype = 'Lawyer')  {  
        
          /*  $messages = DB::table('messages')
                ->join('interviews', 'messages.interview_id', '=', 'interviews.id')
                ->join('users', 'messages.sender_id', '=', 'users.id')
                ->where('interviews.id', '=', $this->id)
                
                ->where('lawyer_status', 0)
                
                ->where('sender_id', Auth::user()->id)
                ->orwhere('recipient_id', Auth::user()->id)
                
                ->selectRaw('messages.id, interviews.slug, messages.sender_id, messages.recipient_id, messages.body, messages.attachment, DATE_FORMAT(messages.created_at, "%M %d, %Y") AS create_date, TIME_FORMAT(messages.created_at, "%h:%i %p") AS create_time, users.avatar')
                ->orderBy('messages.created_at', 'asc')
                ->get();*/
               
                $sql = 'SELECT
                    messages.id, interviews.slug, messages.sender_id, messages.recipient_id, messages.body, messages.attachment, DATE_FORMAT(messages.created_at, "%M %d, %Y") AS create_date, TIME_FORMAT(messages.created_at, "%h:%i %p") AS create_time
                    FROM messages
                    LEFT JOIN interviews ON interviews.id = messages.interview_id
                    
                    WHERE interviews.id = '.$this->id.' 
                    and messages.lawyer_status = 0 
                    and (messages.sender_id = '.Auth::user()->id.' or messages.recipient_id = '.Auth::user()->id.' ) 
                    ORDER BY  messages.created_at ASC';
                
              $messages = DB::select($sql);  
                
            
        }
        
        if($sendertype = 'Client')  {  
        
           /* $messages = DB::table('messages')
                ->join('interviews', 'messages.interview_id', '=', 'interviews.id')
                ->join('users', 'messages.sender_id', '=', 'users.id')
                ->where('interviews.id', '=', $this->id)
                
                ->where('client_status', 0)
                
                 ->where('sender_id', Auth::user()->id)
                ->orwhere('recipient_id', Auth::user()->id)
                
                ->selectRaw('messages.id, interviews.slug, messages.sender_id, messages.recipient_id, messages.body, messages.attachment, DATE_FORMAT(messages.created_at, "%M %d, %Y") AS create_date, TIME_FORMAT(messages.created_at, "%h:%i %p") AS create_time, users.avatar')
                ->orderBy('messages.created_at', 'asc')
                ->get();*/
                
                $sql = 'SELECT
                    messages.id, interviews.slug, messages.sender_id, messages.recipient_id, messages.body, messages.attachment, DATE_FORMAT(messages.created_at, "%M %d, %Y") AS create_date, TIME_FORMAT(messages.created_at, "%h:%i %p") AS create_time
                    FROM messages
                    LEFT JOIN interviews ON interviews.id = messages.interview_id
                    
                    WHERE interviews.id = '.$this->id.' 
                    and messages.client_status = 0 
                    and (messages.sender_id = '.Auth::user()->id.' or messages.recipient_id = '.Auth::user()->id.' ) 
                    ORDER BY  messages.created_at ASC';
                
                
                $messages = DB::select($sql);
                
            
        }
        
        
        return $sql;

            
        /*DB::table('messages')
            ->join('interviews', 'messages.interview_id', '=', 'interviews.id')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->where('interviews.id', '=', $this->id)
            ->where('sender_id', '=', Auth::user()->id)
            ->update(['sender_status' => 1]);*/
            
           
            
            /*DB::table('messages')
            ->join('interviews', 'messages.interview_id', '=', 'interviews.id')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->where('interviews.id', '=', $this->id)
            ->where('sender_id', $sender_id)
            ->where('recipient_id', $recipient_id)
            ->update(['sender_status' => 1]);*/
            
            //$array_of_ids = $messages->id;
            //DB::table('messages')->whereIn('id', $array_of_ids)->update(array('sender_status' => 1));
            //DB::table('countries')->whereIn('id', [1, 2])->update(['sender_status' => 1]);
           
           if(count($messages) >0) {
               
               if($sendertype = 'Lawyer')  {   
                    foreach ($messages as $key => $value) {
                        //return $value->id;
                       /* DB::table('messages')
                        ->where('id', $value->id)
                        ->update(['lawyer_status' => 1]);*/
                    }
               }
               
               if($sendertype = 'Client')  {   
                    foreach ($messages as $key => $value) {
                        //return $value->id;
                        /*DB::table('messages')
                        ->where('id', $value->id)
                        ->update(['client_status' => 1]);*/
                    }
               }
           
           }
           
           

        return $messages;
    }
    
    public function reviewByLoggedInUser(){
        return $this->hasOne(Review::class)->where('given_by', \Auth::user()->id);
    }
}
