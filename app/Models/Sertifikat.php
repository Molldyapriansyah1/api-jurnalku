<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikat';
    protected $primaryKey = 'id_sertifikat';

    protected $fillable = [
        'nama',
        'deskripsi',
        'file',
        'id_siswa' // Add this
    ];

    public function dataSiswa()
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa');
    }
}
