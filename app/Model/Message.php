<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    public function sender(){
        return $this->belongsTo(User::class);
    }

    public function recipient(){
        return $this->belongsTo(User::class);
    }

    public function interview(){
        return $this->belongsTo(Interview::class);
    }

    public function getInterviewFormatAttribute(){

        $message = DB::table('messages')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->join('interviews', 'messages.interview_id', '=', 'interviews.id')
            ->where('messages.id', '=', $this->id)
            ->selectRaw('interviews.slug, messages.sender_id, messages.recipient_id, messages.body, messages.attachment, DATE_FORMAT(messages.created_at, "%M %d, %Y") AS create_date, TIME_FORMAT(messages.created_at, "%h:%i %p") AS create_time, users.avatar')
            ->first();

        return $message;
    }
}
