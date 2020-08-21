<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function getDiscountInCentsAttribute(){
        return (int) $this->discount * 100;
    }

    public function getDiscountAttribute($value){
        return ((int) $value) / 100;
    }

    public function setDiscountAttribute($value){
        return $this->attributes["discount"] = (int) ( ( (float) $value ) * 100 );
    }
}
