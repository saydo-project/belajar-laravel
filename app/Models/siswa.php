<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'image', 'nama_siswa', 'tanggal_lahir'
    ];
}
