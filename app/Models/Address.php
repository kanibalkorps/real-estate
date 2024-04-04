<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ["street", "number", "city_id", "country_id"];

    public function city(){
        return $this->hasOne(City::class);
    }

    public function country(){
        return $this->hasOne(Country::class);
    }
}
