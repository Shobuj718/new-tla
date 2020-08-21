<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SquareupPayment extends Model
{
    public function getAmountAttribute($value){
        return $value/100;
    }
}
