<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Statusnikah;
use Illuminate\Http\Request;

class PribadiController extends Controller
{
    public function index()
    {
        return view('owner.pribadi');
    }

    public function dataagama()
    {
        $data = Agama::all();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="editagama btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->kode.
                    '" name="hapus" class="hapusagama btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function datastatusnikah()
    {
        $data = Statusnikah::all();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="editstatus btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->kode.
                    '" name="hapus" class="hapusstatus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
}
