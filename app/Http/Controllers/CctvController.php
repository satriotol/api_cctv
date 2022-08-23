<?php

namespace App\Http\Controllers;

use App\Models\Cctv;
use App\Models\CctvLokasi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class CctvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kecamatan_search = $request->kecamatan_search;
        $kelurahan_search = $request->kelurahan_search;
        $status_search = $request->status_search;
        $data_cctvs = Cctv::orderBy('kecamatan', 'desc')->orderBy('kelurahan')->orderBy('rw', 'asc')->orderBy('rt', 'asc')
            ->when($kelurahan_search, function ($q) use ($kelurahan_search) {
                $q->where('kelurahan', $kelurahan_search);
            })->when($kecamatan_search, function ($q) use ($kecamatan_search) {
                $q->where('kecamatan', $kecamatan_search);
            })->when($status_search, function ($q) use ($status_search) {
                if ($status_search == 0) {
                    $q->where('status', '=', 0);
                }
                if ($status_search == 1) {
                    $q->where('status', '=', 1);
                }
            });
        $datas = [
            'total_cctv' => $data_cctvs->count(),
            // 'total_cctv_hidup' => $data_cctvs->where('status', 1)->count(),
            // 'total_cctv_mati' => $data_cctvs->where('status', 0)->get()->count(),
        ];
        $cctvs = $data_cctvs->paginate(10);
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get(['id_kecamatan', 'nama_kecamatan']);
        $kelurahans = Kelurahan::orderBy('nama_kelurahan')->get(['id_kelurahan', 'nama_kelurahan']);
        $request->flash();
        $cctvs->appends([
            'kelurahan_search' => $kelurahan_search,
            'kecamatan_search' => $kecamatan_search,
            'status_search' => $status_search,
        ]);
        return view('pages.cctv.index', compact('cctvs', 'kelurahans', 'kecamatans', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cctv $cctv)
    {
        $data = $request->validate([
            'status' => 'required',
        ]);

        $cctv->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
