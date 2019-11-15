<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillSummaryView extends Model
{
    protected $table = 'billsummary_view';
    protected $fillable = [
        'billsummary_id','usertype_id','parisishthaa_id','parisishthab_id','vendorinvoiceid'
     ];
}
