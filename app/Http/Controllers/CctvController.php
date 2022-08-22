<?php

namespace App\Http\Controllers;

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
        $cctvs = CctvLokasi::orderBy('id_kecamatan', 'desc')->orderBy('id_kelurahan')->orderBy('rw', 'asc')->orderBy('rt', 'asc')
            ->when($kelurahan_search, function ($q) use ($kelurahan_search) {
                $q->where('id_kelurahan', $kelurahan_search);
            })->when($kecamatan_search, function ($q) use ($kecamatan_search) {
                $q->where('id_kecamatan', $kecamatan_search);
            })->paginate(10);
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get(['id_kecamatan', 'nama_kecamatan']);
        $kelurahans = Kelurahan::orderBy('nama_kelurahan')->get(['id_kelurahan', 'nama_kelurahan']);
        $request->flash();
        $cctvs->appends(['kelurahan_search' => $kelurahan_search]);
        return view('pages.cctv.index', compact('cctvs', 'kelurahans', 'kecamatans'));
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
    public function update(Request $request, $id)
    {
        //
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
