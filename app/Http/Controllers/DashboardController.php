<?php

namespace App\Http\Controllers;

use App\Models\Cctv;
use App\Models\CctvLokasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'cctv_total' => Cctv::all()->count(),
            'cctv_total_hidup' => Cctv::where('status', 1)->count(),
            'cctv_total_mati' => Cctv::where('status', 0)->count(),
        ];
        return view('dashboard', compact('data'));
    }
}
