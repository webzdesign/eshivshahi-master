<?php



namespace App\Model;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;



class ParisishthaB extends Model

{

    use SoftDeletes;

    protected $fillable = [

        'relevant_agreement','route_id','depot_id','division_id', 'billing_period','vendor_id','voucher_no','voucher_date','vehicle_id','date','kms','diesel_ltr','diese_per_ltr_price','adblue','adblue_price','breaddown_charge','breaddown_charge_value','vor_exp','parking_exp','hault_tax','wash_exp','other_exp','total_km','diesel_as_per_gov','extra_filled_diesel','extra_diesel_charged','remarks','status','from_date','to_date','delete_status','vendorinvoice_id','created_by','updated_by','idling_minutes','is_parisishtha_a_created','schedule_complete'

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

     public function vehicle()

     {

         return $this->belongsTo(Vehicle::class,'vehicle_id_reff');

     }



     public function invoice_no()

     {

         return $this->belongsTo(Vendorinvoice::class,'vendorinvoice_id');

     }

    public function route()

    {

        return $this->belongsTo(RouteMaster::class, 'route_id');

    }

}

