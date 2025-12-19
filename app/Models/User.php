<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


   class User extends Model
{
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = ['password'];
}

