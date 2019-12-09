<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Billsummary extends Model
{
    protected $fillable = [
        'bill_no','parisishtha_a_id','parisishtha_b_id','division_id','depot_id','billing_period','gov_voucher_no','route_id','vehicle_id','vendor_id','vendorinvoice_id','vendor_invoice_amt','gov_approve_amt','vendor_deduction_amt','final_payable_amt','other_deduction','other_deduction_remark','per_deduction','per_deduction_remark','prev_deduction','prev_deduction_remark','vendor_deduction', 'vendor_reimbursement','tds','amount_after_tds','status','vendor_confirm','delete_status','created_by','updated_by', 'vendor_reimbursement_remark', 'vendor_previous_deduction_remarks'
     ];
     public function parisisthab()
     {
         return $this->belongsTo(ParisishthaB::class,'parisishtha_b_id','id');
     }
     public function route()
     {
         return $this->belongsTo(RouteMaster::class,'route_id');
     }
     public function vendorinvoice()
     {
         return $this->belongsTo(Vendorinvoice::class);
     }
     public function vendor()
     {
         return $this->belongsTo(Vendor::class);
     }
     public function depot()
     {
         return $this->belongsTo(Depot::class);
     }
     public function division()
     {
         return $this->belongsTo(Division::class);
     }

}
