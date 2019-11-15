<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsermasterLog extends Model
{
    protected $table = 'user_master_logs';
    protected $fillable = [
        'user_id', 'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
