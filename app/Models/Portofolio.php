<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $hidden = []; // Make sure id_siswa isn't hidden
    protected $table = 'portofolio';
    protected $primaryKey = 'id_portofolio';

    protected $fillable = [
        'nama',
        'deskripsi',
        'durasiPengerjaan',
        'linkPortofolio',
        'gambar',
        'timestamp',
        'id_siswa' // Add this
    ];
      public function dataSiswa()
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa');
    }
}

