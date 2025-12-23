<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // CRITICAL: Tell Sanctum to use id_user instead of id
    public function getAuthIdentifier()
    {
        return $this->id_user;
    }

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    // Override the token retrieval
    public function tokens()
    {
        return $this->morphMany(
            \Laravel\Sanctum\PersonalAccessToken::class,
            'tokenable',
            'tokenable_type',
            'tokenable_id',
            'id_user'  // Use id_user instead of id
        );
    }

    // Relationships
    public function dataSiswa()
    {
        return $this->hasOne(DataSiswa::class, 'id_user', 'id_user');
    }
}