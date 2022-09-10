<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseFormatter;
use App\Models\Cctv;
use App\Models\CctvLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $isLiveView = $request->input('isLiveView');
        $isPing = $request->input('isPing');
        $isLogin = $request->input('isLogin');
        $isOpenvpn = $request->input('isOpenvpn');

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
        if ($isLiveView) {
            $data->where('isLiveView', $isLiveView);
        }
        if ($isPing) {
            $data->where('isPing', $isPing);
        }
        if ($isLogin) {
            $data->where('isLogin', $isLogin);
        }
        if ($isOpenvpn) {
            $data->where('isOpenvpn', $isOpenvpn);
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
    public function updateCctvLokasi()
    {
        set_time_limit(0);
        $cctv_lokasis = CctvLokasi::all();
        foreach ($cctv_lokasis as $cctv_lokasi) {
            if ($cctv_lokasi->camera_id != '') {
                $cctv = Cctv::where('relation_id', $cctv_lokasi->camera_id)->first();
            } else {
                $cctv = Cctv::where('kelurahan', $cctv_lokasi->kelurahan->nama_kelurahan)->where('rt', $cctv_lokasi->rt)
                    ->where('rw', $cctv_lokasi->rw)->first();
            }
            $cctv_lokasi->update(
                [
                    'cameraUrl' => $cctv->liveViewUrl ?? '',
                ]
            );
        }
        return ResponseFormatter::success($cctv_lokasis, 'Sukses Menambah Data');
    }
}
