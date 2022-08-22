<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CctvLokasi extends Model
{
    use HasFactory;

    protected $table = 'cctv_lokasi';
    public $timestamps = false;
    protected $fillable = ['cameraUrl', 'id_kelurahan', 'id_kecamatan'];
    protected $primaryKey = 'id_lokasi';
    public function cctv()
    {
        return $this->hasOne(Cctv::class, 'relation_id', 'camera_id');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
