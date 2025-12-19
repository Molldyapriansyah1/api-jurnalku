<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Portofolio;
use App\Models\Sertifikat;

class DataSiswa extends Model
{
    protected $table = 'data_siswa';

    protected $fillable = [
        'nama_siswa',
        'NIS',
        'rombel',
        'Rayon',
        'id_user',
        'PFP'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function portofolio()
    {
        return $this->hasMany(Portofolio::class, 'id_siswa'); // ✅ Fixed - use id_siswa
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'id_siswa'); // ✅ Fixed - use id_siswa
    }
}