<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depot extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'name','division_id'
    ];

    protected $dates = ['deleted_at'];

    public function divisions(){
        return $this->belongsTo(Division::class,'division_id');
    }
}
