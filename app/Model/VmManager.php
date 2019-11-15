<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VmManager extends Model
{
    protected $table = 'vmapprove';
    protected $fillable = [
        'approve'
     ];
}
