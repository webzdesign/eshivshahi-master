<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParisishthaA extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'parisishtha_b_id','division_id','depot_id', 'billing_period','vendor_id','vendorinvoice_id','voucher_no','voucher_date','route_id','vehicle_id','total_kms','avg_kms','per_km_rate','amount','total_amount','avg_km_as_per_contract','avg_km_total_as_per_contract','rate_for_avg_km','amount_for_avg_km','total_amount_for_avg','diesel_amt','diesel_rate','diesel_amount','diesel_final_amount','adblue_charge','amountWoDeduct','extra_diesel_amt','vehical_exp','vor_exp','parking_charge','hault_tax','wash_exp','other_exp','total_tax','amount_payable','status','delete_status','pay_status','created_by','updated_by'
     ];

     public function route()
     {
         return $this->belongsTo(RouteMaster::class,'route_id');
     }
     public function vendorinvoice()
     {
         return $this->belongsTo(Vendorinvoice::class,'vendorinvoice_id');
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
