<?php

namespace App\Http\Controllers;

use App\Models\CctvLokasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'cctv_total' => CctvLokasi::all()->count(),
        ];
        return view('dashboard', compact('data'));
    }
}
