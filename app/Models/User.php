<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'account_image_id' => 1,
        'club_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function image()
    {
        return $this->belongsTo('App\Models\Accounts_image', 'account_image_id');
    }
    public function accounts_image()
    {
        return $this->belongsTo('App\Models\Accounts_image');
    }
    public function club()
    {
        return $this->belongsTo('App\Models\Club');
    }
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }

    public function setLoginAttribute($value)
    {
        $count = User::where('login', $value)->count();
        $nbr = 0;
        echo $count;
        if($count != 0){
            while($count != 0){
                $nbr++;
                $count = User::where('login', $value.$nbr)->count();
            }
            $this->attributes['login'] = strtolower($value).$nbr;
        }else{
            $this->attributes['login'] = strtolower($value);
        }


    }

}
