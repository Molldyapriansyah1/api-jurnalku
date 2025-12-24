<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $appends = ['pfp_url'];

    protected $table = 'data_siswa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_siswa',
        'NIS',
        'rombel',
        'Rayon',
        'new_column',
        'id_user',
        'PFP',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function portofolio()
    {
        return $this->hasMany(Portofolio::class, 'id_siswa', 'id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'id_siswa', 'id');
    }
    public function getPfpUrlAttribute()
{
    return $this->PFP
        ? asset('storage/' . $this->PFP)
        : null;
}
}