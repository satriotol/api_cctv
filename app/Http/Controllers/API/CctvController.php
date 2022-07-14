<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseFormatter;
use App\Models\Cctv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CctvController extends Controller
{
    public function index(Request $request)
    {
        $relation_id = $request->input('relation_id');
        $name = $request->input('name');
        $location = $request->input('location');
        $kelurahan = $request->input('kelurahan');
        $kecamatan = $request->input('kecamatan');
        $rt = $request->input('rt');
        $rw = $request->input('rw');
        $limit = $request->input('limit');

        $data = Cctv::query();

        if ($name) {
            $data->where('name', 'like', '%' . $name . '%');
        }

        if ($location) {
            $data->where('location', 'like', '%' . $location . '%');
        }

        if ($kelurahan) {
            $data->where('kelurahan', 'like', '%' . $kelurahan . '%');
        }

        if ($kecamatan) {
            $data->where('kecamatan', 'like', '%' . $kecamatan . '%');
        }
        if ($rt) {
            $data->where('rt', 'like', '%' . $rt . '%');
        }
        if ($rw) {
            $data->where('rw', 'like', '%' . $rw . '%');
        }

        if ($limit) {
            return ResponseFormatter::success($data->paginate($limit), 'success');
        } else {
            return ResponseFormatter::success($data->get(), 'success');
        }
    }
    public function store()
    {
        $responses = Http::accept('application/json')->get('https://api.cctvsemarang.katalisindonesia.com/v2/cameras/');
        $records = array();
        foreach ($responses['data'] as $response) {
            $records[] = [
                'relation_id' => $response['id'],
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
            Cctv::updateOrCreate(['relation_id' => $record['relation_id'], 'liveViewUrl' => $record['liveViewUrl'],], $record);
        }
        return ResponseFormatter::success(Cctv::all()->count(), 'Sukses Menambah Data');
    }
}
