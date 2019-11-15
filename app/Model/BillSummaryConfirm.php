<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillSummaryConfirm extends Model
{
    protected $table = 'billsummary_confirm';
    protected $fillable = [
        'depot_id','division_id','billsummary_id','usertype_id','sequence','confirm_by','query','user_id','queryraised_at'
     ];
     public function parisisthab()
     {
         return $this->belongsTo(ParisishthaB::class,'parisishthab_id','id');
     }
     public function depot()
     {
         return $this->belongsTo(Depot::class);
     }
     public function user()
     {
        return $this->belongsTo('App\User');
     }
     public function billsummary()
     {
        return $this->belongsTo(Billsummary::class,'billsummary_id', 'bill_no');
     }

}
