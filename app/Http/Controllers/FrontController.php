<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $jenis = Jenis::paginate(6);
        return view('frontend.home', compact('jenis'));
    }
}
