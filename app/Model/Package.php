<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = "packages";

    public function getFirstMonthSubscriptionInCentsAttribute(){
        return (int) $this->first_month_subscription * 100;
    }

    public function setFirstMonthSubscriptionAttribute($value){
        return $this->attributes["first_month_subscription"] = (int) ( ( (float) $value ) * 100 );
    }

    public function getFirstMonthSubscriptionAttribute($value){
        return ((int) $value) / 100;
    }


    public function getSubscriptionFeeInCentsAttribute(){
        return (int) $this->subscription_fee * 100;
    }

    public function setSubscriptionFeeAttribute($value){
        return $this->attributes["subscription_fee"] = (int) ( ( (float) $value ) * 100 );
    }

    public function getSubscriptionFeeAttribute($value){
        return ((int) $value) / 100;
    }
}
