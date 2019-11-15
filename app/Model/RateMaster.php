<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RateMaster extends Model
{

    protected $fillable = [
       'bus_type','from_km','to_km','rate','created_at','updated_at'
    ];

}
