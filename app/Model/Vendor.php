<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'vendor_name', 'user_id','address','pan_no','gst_no','bank_name','account_no','ifsc_code', 'created_by', 'updated_by', 'active_status'
    ];

    protected $dates = ['deleted_at'];

    public function vendormanager()
    {
        return $this->belongsTo(VendorManager::class);
    }
}
