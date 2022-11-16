<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CctvLokasi extends Model
{
    use HasFactory;

    protected $table = 'cctv_lokasi';
    public $timestamps = false;
    protected $fillable = ['cameraUrl', 'id_kelurahan', 'id_kecamatan', 'camera_id', 'status_cctv'];
    protected $primaryKey = 'id_lokasi';
    public function cctv()
    {
        return $this->belongsTo(Cctv::class, 'camera_id', 'relation_id');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }
}
