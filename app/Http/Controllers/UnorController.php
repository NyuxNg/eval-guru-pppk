<?php

namespace App\Http\Controllers;

use App\Models\Unor;
use App\Models\Eselon;
use App\Models\Jenisunor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnorController extends Controller
{
    public function index()
    {
        $jenisUnor = Jenisunor::all()->sortBy('nama');
        $eselon =  Eselon::orderBy('kode', 'asc')->get();
        // $unorAtasan = ;
        return view('owner.unor', compact('jenisUnor', 'eselon'));
    }

    public function dataUnor(Request $request)
    {
        $data = Unor::join();

        // dd($data);

        $data = ($request->cari_nama) ? $data->where('unor.namaUnor', 'like', '%'.$request->cari_nama. '%') : $data;
        $data = ($request->cari_jenisUnor != 'All') ? $data->where('jenisunors.id', '=', $request->cari_jenisUnor) : $data;
        $data = ($request->cari_eselon != 'All') ? $data->where('eselon.id', '=', $request->cari_eselon) : $data;
        $data = ($request->cari_status != 'All') ? $data->where('unor.is_aktif', '=', $request->cari_status) : $data;
        $data = ($request->cari_perangkat != 'All') ? $data->where('unor.is_unorInduk', '=', $request->cari_perangkat) : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        $data = $data->get();

        if (request()->ajax()) {
            return datatables()
                ->of($data)
                ->addColumn('status', function ($data) {

                    $status = '<div class="btn-group"><button type="button" id="'.$data->id.'  " ';

                    if($data->is_aktif == '1') {
                        $status .= 'class="edit-status btn btn-success" title="Status Unit Organisasi Aktif"><i class="fas fa-house-user"></i>';
                    } else {
                        $status .= 'class="edit-status btn btn-danger" title="Status Unit Organisasi Tidak Aktif"><i class="fas fa-house-damage"></i>';
                    }
                    $status .= '</button>';

                    $perangkatDaerah = '<button type="button" id="'.$data->id.'  " ';

                    if($data->is_unorInduk == '1') {
                        $perangkatDaerah .= 'class="edit-perangkat btn btn-primary" title="Perangkat Daerah Induk"><i class="fas fa-star"></i>';
                    } else {
                        $perangkatDaerah .= 'class="edit-perangkat btn btn-secondary" title="Unit Kerja non-induk"><i class="fas fa-school"></i>';
                    }
                    $perangkatDaerah .= '</button>';
                    $perangkatDaerah .= '<div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon text-right" data-toggle="dropdown">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a id="'.$data->id.'" class="dropdown-item dropdown-status" href="#">Ubah status menjadi '.($data->is_aktif == '1' ? "Nonaktif":"aktif"). '</a>
                        <a id="'.$data->id.'" class="dropdown-item dropdown-perangkat" href="#">Ubah Perangkat Daerah menjadi '.($data->is_unorInduk == '1' ? "non-induk":"induk"). '</a>
                    </div></div></div>';
                    return $status.$perangkatDaerah;
                })
                ->addColumn('namaJabatan', function ($data) {
                    $namaJabatan =  '<div class="d-flex justify-content-between align-items-start">'.$data->namaJabatan ;
                    $namaJabatan .= '<button title="Lihat riwayat pemangku jabatan" id="'.$data->id.'" type="button" class="showPemangku btn btn-outline-info btn-md" data-toggle="modal"
                                        data-target="#modalPejabat">
                                        <i class="fas fa-history"></i>
                                     </button></div>';
                    return $namaJabatan;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->id.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->id.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi', 'status', 'namaJabatan'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'namaUnor' => 'required',
            'namaJabatan' => 'required',
            'is_unorInduk' => 'required',
            'is_aktif' => 'required',
            'jenisUnor_id' => 'required',
            'eselon_id' => 'required',
        ];

        $text = [
            'namaUnor.required' => 'namaUnor harap dilengkapi.',
            'namaJabatan.required' => 'namaJabatan harap dilengkapi.',
            'is_unorInduk.required' => 'is_unorInduk harap dilengkapi.',
            'is_aktif.required' => 'is_aktif harap dilengkapi.',
            'jenisUnor_id.required' => 'jenisUnor_id harap dilengkapi.',
            'eselon_id.required' => 'eselon_id harap dilengkapi.',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataunor = [
            'namaUnor' => $request->namaUnor,
            'namaJabatan' => $request->namaJabatan,
            'unorAtasan_id' => $request->unorAtasan_id,
            'is_unorInduk' => $request->is_unorInduk,
            'unorInduk_id' => $request->unorInduk_id,
            'keterangan' => $request->keterangan,
            'is_aktif' => $request->is_aktif,
            'jenisUnor_id' => $request->jenisUnor_id,
            'eselon_id' => $request->eselon_id,
        ];

        if ($request->mode == 'save') {
            $unor = Unor::create($dataunor);
        } else {
            $data = Unor::all()->where('id', '=', $request->id)->first();
            $unor = $data->update($dataunor);
        }

        if ($unor) {
            return response()->json(['text' => 'Unit Organisasi ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = Unor::where('id', '=', $request->kode)->first();
        if ($data) {
            $delete = $data->delete($request->all());
            if ($delete) {
                return response()->json(['text' => 'Data berhasil dihapus'], 200);
            } else {
                return response()->json(['text' => 'Terjadi kesalahan'], 200);
            }
        } else {
            return response()->json(['text' => 'Data gagal dihapus'], 200);
        }
    }

    public function edit(Request $request)
    {
        $data = Unor::join()
            ->where('unor.id', '=', $request->id)
            ->first();
        return response()->json($data, 200);
    }

    public function cariUnor(Request $request)
    {
        $data = Unor::join();

        $data = ($request->cariUnor) ? $data->where('unor.namaUnor', 'like', '%' .$request->cariUnor. '%') : $data;
        $data = ($request->isInduk) ? $data->where('unor.is_unorInduk', '=', '1') : $data;

        $data = $data->take(20)->get();

        return $data->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->namaUnor,
                'unorInduk_id' =>  $item->unorInduk_Id,
                'unorInduk' => $item->namaUnorInduk
            ];
        });
    }

    public function editStatus(Request $request)
    {
        $data = Unor::all()->where('id', '=', $request->id)->first();
        $data->is_aktif = ($data->is_aktif == 1) ? 0 : 1;

        $gantiStatus = $data->update(array('data' => $data));

        if($gantiStatus) {
           return response()->json(['text' => 'Status berhasil diubah'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function editPerangkat(Request $request)
    {
        $data = Unor::all()->where('id', '=', $request->id)->first();
        $data->is_unorInduk = ($data->is_unorInduk == 1) ? 0 : 1;

        $gantiStatus = $data->update(array('data' => $data));

        if($gantiStatus) {
           return response()->json(['text' => 'Jenis Perangkat Daerah berhasil diubah'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }
}
