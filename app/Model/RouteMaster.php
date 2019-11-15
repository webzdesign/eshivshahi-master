<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RouteMaster extends Model
{

    protected $fillable = [
       'division_id','from_depot','to_depot','to_division','scheduled_km','trip_hrs','trip_min','scheduled_time','maximum_ideling_minutes','created_at','updated_at'
    ];


}
