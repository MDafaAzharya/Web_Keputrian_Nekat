<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agenda'; 
    protected $id = 'id'; 
     protected $fillable = [
        'judul',
        'warna',
        'start_date',
        'end_date', 
    ];
}
