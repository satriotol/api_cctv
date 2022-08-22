<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'kelurahan';
    public $timestamps = false;
    protected $primaryKey = 'id_kelurahan';

    protected $fillable = ['id_kelurahan', 'id_kecamatan', 'nama_kelurahan'];
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }
}
