<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allowuser extends Model
{
    use SoftDeletes;

    protected $fillable = [
       'usertype_id', 'accesstype_id', 'no_of_users', 'created_by', 'updated_by'
    ];

    protected $dates = ['deleted_at'];
}
