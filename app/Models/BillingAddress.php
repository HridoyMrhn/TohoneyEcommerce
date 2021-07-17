<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function billingCity(){
    //     return $this->hasOne(City::class, 'id', 'billing_city_id');
    // }

    // public function billingCountry(){
    //     return $this->hasOne(Country::class, 'id', 'billing_country_id');
    // }

    public function billingCity(){
        return $this->belongsTo(City::class, 'billing_city_id');
    }

    public function billingCountry(){
        return $this->belongsTo(Country::class, 'billing_country_id');
    }
}
