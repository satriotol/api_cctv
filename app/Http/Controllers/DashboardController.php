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
        ];
        return view('dashboard', compact('data'));
    }
}
