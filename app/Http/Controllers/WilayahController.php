<?php

namespace App\Http\Controllers;

use App\Models\PPPK;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wilayah = PPPK::showWilayah()->get();
        // $linear = PPPK::showLinear()->get();
        // dd($wilayah);
        return view('pppk.wilayah', compact('wilayah'));
    }


}
