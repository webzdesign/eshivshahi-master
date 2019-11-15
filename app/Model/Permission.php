<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public $timestamps = false;
    protected $fillable = [
       'usertype_id','module_id','create','view','edit'
    ];
}
