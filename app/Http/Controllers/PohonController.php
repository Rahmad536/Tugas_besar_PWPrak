<?php

namespace App\Http\Controllers;

use App\Models\Pohon;

class PohonController extends Controller
{
    public function index()
    {
        $pohons = Pohon::where('status', 1)->get();
        return view('donasi', compact('pohons'));
    }
}
