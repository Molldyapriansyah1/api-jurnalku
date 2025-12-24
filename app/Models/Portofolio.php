<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;


    protected $table = 'portofolio';
    protected $primaryKey = 'id_portofolio';

    protected $fillable = [
        'nama',
        'deskripsi',
        'durasiPengerjaan',
        'timestamp',
        'linkPortofolio',
        'gambar',
        'id_siswa',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function dataSiswa()
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa', 'id');
    }

}