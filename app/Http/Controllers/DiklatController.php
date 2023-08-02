<?php

namespace App\Http\Controllers;

use App\Models\Diklatstruktural;
use App\Models\Jenisdiklat;
use Illuminate\Http\Request;

class DiklatController extends Controller
{
    public function index()
    {
        return view('owner.diklat');
    }

    public function datajenisdiklat()
    {
        $data = Jenisdiklat::all();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" title="Edit Data" class="edit-jenisdiklat btn btn-warning" ><i class="fas fa-edit"></i></button>';
                    $button.= ' <button id="'.$data->id_siasn.
                    '" name="hapus" title="Hapus data" class="hapus-jenisdiklat btn btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    public function datadiklatstruktural()
    {
        $data = Diklatstruktural::all();
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" title="Edit Data" class="edit-diklatstruktural btn btn-warning" ><i class="fas fa-edit"></i></button>';
                    $button.= ' <button id="'.$data->id_siasn.
                    '" name="hapus" title="Hapus data" class="hapus-diklatstruktural btn btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }
}
