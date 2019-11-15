<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'diesel_rate','vor_charges','washing_charges','parking_charges'
    ];
    protected $dates = ['deleted_at'];
}
