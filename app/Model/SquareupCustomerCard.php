<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SquareupCustomerCard extends Model
{
    public function notExpired(){
        if($this->expiration_year <= date('Y') && $this->expiration_month <= date('M')){
            return true;
        }
        return false;
    }
}
