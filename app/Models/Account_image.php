<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account_image extends Model
{
    protected $table = 'accounts_images';

    protected $fillable = [
        'avatar_url',
    ];
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
