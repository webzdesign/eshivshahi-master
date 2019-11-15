<?php
 /*
    Hardik Ponkiya
    Date:09-07-18
  */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VendorManager extends Model
{
    public $timestamps = false;
	protected $fillable = [
       'id','vendor_id', 'user_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
