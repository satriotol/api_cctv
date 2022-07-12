<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseFormatter;
use App\Models\Cctv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CctvController extends Controller
{
    public function store()
    {
        $responses = Http::accept('application/json')->get('https://api.cctvsemarang.katalisindonesia.com/v2/cameras/');
        $records = array();
        foreach ($responses['data'] as $response) {
            $records[] = [
                'id' => $response['id'],
                'name' => $response['name'],
                'location' => $response['location'],
                'liveViewUrl' => $response['liveViewUrl'],
                'isPing' => $response['isPing'],
                'isLogin' => $response['isLogin'],
                'isLiveView' => $response['isLiveView'],
                'isOpenvpn' => $response['isOpenvpn'],
                'rt' => $response['rt'],
                'rw' => $response['rw'],
                'kelurahan' => $response['kelurahan'],
                'kecamatan' => $response['kecamatan'],
            ];
        }
        foreach ($records as $record) {
            Cctv::updateOrCreate(['id' => $record['id'], 'liveViewUrl' => $record['liveViewUrl'], ], $record);
        }
        return ResponseFormatter::success(Cctv::all()->count(), 'Sukses Menambah Data');
    }
}
