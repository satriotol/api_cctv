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
    public function cctv_relation()
    {
        return $this->hasOne(Cctv::class, 'camera_id', 'relation_id');
    }
}
