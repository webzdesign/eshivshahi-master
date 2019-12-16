<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendorinvoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'route_id','depot_id','division_id', 'billing_period','vendor_id', 'vehicle_id','date','schedule_complete', 'kms','diesel_ltr','diese_per_ltr_price','adblue','adblue_price','breaddown_charge','vor_exp','parking_exp','hault_tax','wash_exp','other_exp','total_km','diesel_as_per_gov','extra_filled_diesel','extra_diesel_charged','total_amount','total_charge','grand_amount','idling_minutes','remarks','publish_flag','is_approved', 'update_status','update_status_division','invoice_no','created_by','updated_by'
    ];
    protected $dates = ['deleted_at'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }
    public function vendorinvoice()
    {
        return $this->belongsTo(Vendorinvoice::class);
    }
    // public function vehicle()
    // {
    //     return $this->belongsTo(Vehicle::class,'vehicle_id_reff');
    // }
}