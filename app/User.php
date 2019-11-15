<?php



namespace App;



use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable

{

    use Notifiable;

     use SoftDeletes;

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $guarded = ['status'];

    /* For Password Encryption */

    /*public function setPasswordAttribute($password)

    {

        $this->attributes['password'] = bcrypt($password);

    }*/

    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];



    protected $dates = ['deleted_at'];



    public function usertype()

    {

        return $this->belongsTo('App\Model\Usertype'::class);

    }

    public function depot()

    {

        return $this->belongsTo('App\Model\Depot'::class);

    }

    public function division()

    {

        return $this->belongsTo('App\Model\Division'::class);

    }

}

