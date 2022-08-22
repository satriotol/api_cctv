<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $fillable = ['id_kecamatan', 'nama_kecamatan'];
    public function keluarahans()
    {
        return $this->hasMany(Kelurahan::class, 'id_kecamatan', 'id_kecamatan');
    }
}
