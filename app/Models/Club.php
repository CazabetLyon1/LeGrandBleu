<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $table = 'club';

    protected $fillable = [
        'id_club',
        'nom_club',
        'url_club',
        'nom_ville',
        'pays',
        'acronyme',
        'nom_image',
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
