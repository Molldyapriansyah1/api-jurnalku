<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explore extends Model
{
    protected $table = 'explore'; // Force singular name to match phpMyAdmin
    protected $fillable = ['judul', 'deskripsi']; // Adjust based on your columns
}