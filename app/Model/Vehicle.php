<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'division_id','vendor_id' ,'depot_id','bus_type','vehicle_no', 'created_by', 'updated_by'
    ];

    protected $dates = ['deleted_at'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
