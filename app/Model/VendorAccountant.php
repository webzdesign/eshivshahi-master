<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class VendorAccountant extends Model
{
    public $timestamps = false;

    protected $fillable = [
       'vendor_id', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User'::class,'user_id');
    }
    public function vendor()
    {
        return $this->belongsTo('App\Model\Vendor'::class,'vendor_id');
    }
}
