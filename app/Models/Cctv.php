<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cctv extends Model
{
    use HasFactory;

    protected $fillable = [
        'relation_id', 'name', 'location', 'liveViewUrl', 'isPing', 'isLogin', 'isLiveView', 'isOpenVpn', 'rt', 'rw', 'kelurahan', 'kecamatan', 'status'
    ];
    const STATUSES = [
        'HIDUP', 'MATI'
    ];
    public function cctv_relation()
    {
        return $this->belongsTo(CctvLokasi::class, 'camera_id', 'relation_id');
    }
}
