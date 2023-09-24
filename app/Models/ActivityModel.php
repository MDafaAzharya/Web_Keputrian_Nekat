<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    protected $table = 'activity_report'; 
    protected $id = 'id'; 
     protected $fillable = [
        'id',
        'date', // Tambahkan 'date' ke dalam $fillable
        'jenis_kegiatan',
        'lokasi',
        'keterangan',
        'image',
    ];
}
