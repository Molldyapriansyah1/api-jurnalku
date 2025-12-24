<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $appends = ['file_url'];

    protected $table = 'sertifikat';
    protected $primaryKey = 'id_sertifikat';

    protected $fillable = [
        'nama',
        'deskripsi',
        'file',
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
    public function getFileUrlAttribute()
    {
        return $this->file
            ? asset('storage/' . $this->file)
            : null;
    }
}