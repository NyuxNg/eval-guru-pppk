<?php

namespace App\Http\Controllers;

use App\Models\PPPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PPPKController extends Controller
{
    public function index(Request $request)
    {
        $wilayah = PPPK::showData()->select('pppk.wilayah')->distinct()->get();
        // $wilayah = PPPK::showWilayah()->get();
        $pendidikan = PPPK::showData()->select('pendidikan')->distinct()->get();
        $jabatan = PPPK::showData()->select('jabatanASN')->distinct()->get();
        $data = PPPK::showData()->orderBy('unitKerja');
        $data = ($request->cariWilayah != '') ? $data->where('pppk.wilayah','=',$request->cariWilayah) : $data;
        $data = ($request->cariJabatan != '') ? $data->where('jabatanASN','=',$request->cariJabatan) : $data;
        $data = ($request->cariPendidikan != '') ? $data->where('pendidikan','=',$request->cariPendidikan) : $data;
        $data = ($request->carilinear != '') ? $data->where('linear','=',$request->carilinear) : $data;

        $data = ($request->jumlahView != 'All') ? $data->take($request->jumlahView) : $data;
        if (request()->ajax()) {
            return datatables()
             ->of($data)
                ->addColumn('dataPPPK', function($data){
                    $url = "dist/img/foto".'/'. $data->nipBaru. '.jpg';
                    $photourl = file_exists($url) ? $url : url("dist/img/avatar2.png");
                    $ribbon = ($data->rekomendasi != "1") ? '<div class="ribbon bg-maroon text-lg"><i class="fas fa-handshake-alt-slash fa-lg"></i></div>' : '<div class="ribbon bg-success text-lg"><i class="fas fa-handshake fa-lg"></i></div>';
                    $nilai = (($data->kejujuran + $data->tanggungJawab + $data->kehadiran + $data->kesetiaan + $data->etikaPerilaku)/5*0.4) + (($data->admPerencanaan + $data->pelaksanaan + $data->admPenilaian + $data->rekapitulasiPKG + $data->skp)/5*0.6);
                    $linear = ($data->linear <> 'Linier Murni') ? 'text-danger' : '';
                    switch (true) {
                        case ($nilai >= 91 && $nilai <= 100):
                            $bintang = '<i class="fas fa-star" style="color:#ffc107"></i><i class="fas fa-star" style="color:#ffc107"></i><i class="fas fa-star" style="color:#ffc107"></i><i class="fas fa-star" style="color:#ffc107"></i>';
                            break;
                        case ($nilai >= 81 && $nilai < 91):
                            $bintang = '<i class="fas fa-star" style="color:#ffc107"></i><i class="fas fa-star" style="color:#ffc107"></i><i class="fas fa-star" style="color:#ffc107"></i><i class="far fa-star"></i>';
                            break;
                        case ($nilai >= 71 && $nilai < 81):
                            $bintang = '<i class="fas fa-star" style="color:#ffc107"></i><i class="fas fa-star" style="color:#ffc107"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
                            break;
                        case ($nilai >= 0 && $nilai < 71):
                            $bintang = '<i class="fas fa-star" style="color:#ffc107"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
                            break;
                        default:
                            $bintang = '<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
                      }

                    // $bintang = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
                    $catatan = ($data->catatanDisiplin != null || $data->catatanKinerja != null) ? '&nbsp;&nbsp;<i title="Ada catatan..." class="fas fa-comment-dots fa-lg" style="color:#ffc107"></i>' : '';
                    $cardPPPK = '<div class="card bg-light d-flex flex-fill">
                                    <div class="ribbon-wrapper ribbon-lg">'.$ribbon .'
                                    </div>
                                    <div class="card-header text-muted border-bottom-0">'.$data->jabatanASN.'<br><span class="small '.$linear .'">'.$data->pendidikan.'</span> <hr></div>

                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-8">
                                                    <p class="text-muted"><b>'.$data->nama.'</b> <br> '.$data->nipBaru.' </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small mb-2"><span class="fa-li"><i class="fas fa-md fa-building"></i></span>'.$data->namasekolah.'</li>
                                                        <ul class="ml-0 mb-0 fa-ul text-muted">
                                                            <div class="d-flex flex-row small">
                                                                <div class="col-6"><i class="fa fa-arrow-right"></i> #Siswa</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-5">'.$data->siswa.' Orang</div>
                                                            </div>
                                                            <div class="d-flex flex-row small">
                                                                <div class="col-6"><i class="fa fa-arrow-right"></i>  #Rombel</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-5">'.$data->rombel.' Kelas</div>
                                                            </div>
                                                            <div class="d-flex flex-row small">
                                                                <div class="col-6"><i class="fa fa-arrow-right"></i>  #ABK</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-5">'.$data->abk.' Orang</div>
                                                            </div>
                                                            <div class="d-flex flex-row small">
                                                                <div class="col-6"><i class="fa fa-arrow-right"></i>  #ASN</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-5">'.$data->asn.' Orang</div>
                                                            </div>
                                                            <div class="d-flex flex-row small">
                                                                <div class="col-6"><i class="fa fa-arrow-right"></i>  #Non-ASN</div>
                                                                <div class="col-1">:</div>
                                                                <div class="col-5">'.$data->nonASN.' Orang</div>
                                                            </div>

                                                        </ul>
                                                    </ul>
                                            </div>
                                            <div class="col-4 text-right">
                                                <img src="'. $photourl. '" alt="user-avatar" class="img-circle img-fluid" style="height:150px;width: 150px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer row">
                                        <div class="col-4 mt-2" title="Nilai Total: '.$nilai.'">'.$bintang.'</div>
                                        <div class="text-right col-8">
                                            <button title="Klik untuk berikan penilaian dan rekomendasi" id="'.$data->idOrang.'" class="evaluasi-btn btn btn-sm btn-info" data-toggle="modal" data-target="#penilaianModal">
                                                <i class="fas fa-sort-numeric-up-alt"></i> Beri Penilaian dan Rekomendasi '.$catatan.'
                                            </button>
                                        </div>
                                    </div>
                                </div>';

                    return $cardPPPK;
                })
                ->addColumn('namaNIP', function($data){
                    $namaNIP = $data->nama.'<small id="helpId" class="form-text text-muted">NI PPPK: '.$data->nipBaru.'</small>';

                    return $namaNIP;
                })
                ->addColumn('linear', function ($data) {
                    $pendidikan = $data->pendidikan;
                    $linear = '<button type="button" id="'.$data->idOrang.'  " ';

                    if($data->linear == 'Linier Murni') {
                        $linear .= 'class="btn btn-sm btn-outline-success" title="Pendidikan dan Jabatan Murni Linier"><i class="fas fa-check-double"></i>';
                    } else if($data->linear == 'Linier Pendidikan') {
                        $linear .= 'class="btn btn-sm btn-outline-warning" title="Pendidikan dan Jabatan Linier dengan catatan"><i class="fas fa-check"></i>';
                    } else if($data->linear == 'Tidak Linier') {
                        $linear .= 'class="btn btn-sm btn-outline-danger" title="Pendidikan dan Jabatan Tidak Linier"><i class="fas fa-not-equal"></i>';
                    } else {
                        $linear .= 'class="btn btn-sm btn-outline-secondary" title="Linearitas belum dipilih"><i class="fas fa-question"></i>';
                    }
                    $linear .= '</button>';


                    // return $pendidikan.$linear;
                    return $linear.'&nbsp;&nbsp;&nbsp;'.$pendidikan;
                    // return $linear.$perangkatDaerah;
                })
                ->addColumn('unitKerja', function ($data){
                    $unitkerja = $data->unitKerja. '<small id="helpId" class="form-text text-muted">KECAMATAN: '.$data->wilayah.'</small>';
                    return $unitkerja;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<button id="'.$data->idOrang.
                    '" name= "edit" class="edit btn btn-warning" >Edit</button>';
                    $button.= ' <button id="'.$data->idOrang.
                    '" name="hapus" class="hapus btn btn-danger">Hapus</button>';
                    return $button;
                })
                ->rawColumns(['aksi', 'linear', 'unitKerja', 'namaNIP', 'dataPPPK'])
                ->make(true);
        }
        return view('pppk.pppk', compact('wilayah', 'pendidikan', 'jabatan'));
        // view('view.name', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'nipBaru' => 'required',
            'nama' => 'required',
            'statusPerkawinan' => 'required',
            'golru' => 'required',
            'tmtPPPK' => 'required',
            'pendidikan' => 'required',
            'jabatanASN' => 'required',
            'unitKerja' => 'required',
        ];

        $text = [
            'nipBaru.required' => 'NI PPPK harus diisi!',
            'nama.required' => 'Nama harus diisi!',
            'statusPerkawinan.required' => 'Status Perkawinan harus diisi!',
            'golru.required' => 'Golongan Ruang harus diisi!',
            'tmtPPPK.required' => 'TMT PPPK harus diisi!',
            'pendidikan.required' => 'Pendidikan harus diisi!',
            'jabatanASN.required' => 'Jabatan ASN harus diisi!',
            'unitKerja.required' => 'UnitKerja harus diisi!',
        ];
        $validasi = Validator::make($request->all(), $rules, $text);
        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $dataPPPK = [
            'idOrang' => $request->idOrang,
            'nipBaru' => $request->nipBaru,
            'nama' => $request->nama,
            'statusPerkawinan' => $request->statusPerkawinan,
            'golru' => $request->golru,
            'tmtPPPK' => $request->tmtPPPK,
            'pendidikan' => $request->pendidikan,
            'jabatanASN' => $request->jabatanASN,
            'unitKerja' => $request->unitKerja,
            'wilayah' => $request->wilayah,
            'linear' => $request->linear,
        ];
        // dd($dataPPPK);
        if ($request->mode == 'save') {
            $pppk = PPPK::create($dataPPPK);
        } else {
            $data = PPPK::all()->where('idOrang', '=', $request->idOrang)->first();
            $pppk = $data->update($dataPPPK);
        }


        if ($pppk) {
            return response()->json(['text' => 'Data PPPK berhasil ditambahkan/diperbaharui'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function beriNilai(Request $request)
    {
        // dd($request);

        $dataPPPK = [
            'idOrang' => $request->idOrang,
            'kejujuran' =>$request->kejujuran,
            'tanggungJawab' =>$request->tanggungJawab,
            'kehadiran' =>$request->kehadiran,
            'kesetiaan' =>$request->kesetiaan,
            'etikaPerilaku' =>$request->etikaPerilaku,
            'admPerencanaan' =>$request->admPerencanaan,
            'pelaksanaan' =>$request->pelaksanaan,
            'admPenilaian' =>$request->admPenilaian,
            'rekapitulasiPKG' =>$request->rekapitulasiPKG,
            'skp' =>$request->skp,
            'catatanDisiplin' =>$request->catatanDisiplin,
            'catatanKinerja' =>$request->catatanKinerja,
            'rekomendasi' =>$request->rekomendasi,
        ];
        // dd($dataPPPK);
        if ($request->mode == 'edit') {
            $data = PPPK::all()->where('idOrang', '=', $request->idOrang)->first();
            $pppk = $data->update($dataPPPK);
        }


        if ($pppk) {
            return response()->json(['text' => 'Nilai Evaluasi berhasil disimpan'], 200);
        } else {
            return response()->json(['text' => 'Operasi gagal'], 422);
        }
    }

    public function hapus(Request $request)
    {
        $data = PPPK::where('idOrang', '=', $request->kode)->first();
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
        $data = PPPK::find($request->id);
        return response()->json($data, 200);
    }

    public function showlinier(Request $request) {
        $data = PPPK::showLinear($request->wilayah)->get();

        return response()->json($data, 200);
    }
}
