<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RouteMaster extends Model
{
    protected $fillable = [
       'division_id', 'from_depot', 'to_depot', 'to_division', 'scheduled_km', 'trip_hrs', 'trip_min','scheduled_time', 'scheduled_number', 'bus_type', 'maximum_ideling_minutes', 'status', 'created_at', 'updated_at'
    ];

    public function fromdepot()
    {
        return $this->belongsTo(Depot::class, 'from_depot');
    }


    public function todepot()
    {
        return $this->belongsTo(Depot::class, 'to_depot');
    }
}
