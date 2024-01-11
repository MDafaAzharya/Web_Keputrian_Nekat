<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputrian extends Model
{
    use HasFactory;

    protected $table = 'keputrian'; 
    protected $id = 'id'; 
     protected $fillable = [
        'judul',
        'text', 
        'gambar',
    ];
}
