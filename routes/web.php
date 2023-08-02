<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EkinController;
use App\Http\Controllers\PPPKController;
use App\Http\Controllers\UnorController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\EselonController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JeniskpController;
use App\Http\Controllers\PribadiController;
use App\Http\Controllers\Thl2022Controller;
use App\Http\Controllers\Thl2023Controller;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RwdiklatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisunorController;
use App\Http\Controllers\RwjabatanController;
use App\Http\Controllers\PegawaipnsController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\RwgolonganController;
use App\Http\Controllers\JenisdiklatController;
use App\Http\Controllers\SatuankerjaController;
use App\Http\Controllers\StatusnikahController;
use App\Http\Controllers\JabpelaksanaController;
use App\Http\Controllers\JenishukumanController;
use App\Http\Controllers\JenispegawaiController;
use App\Http\Controllers\RwpendidikanController;
use App\Http\Controllers\RwhukdisiplinController;
use App\Http\Controllers\TingkathukdisController;
use App\Http\Controllers\TktPendidikanController;
use App\Http\Controllers\KategorijabatanController;
use App\Http\Controllers\PerangkatdaerahController;
use App\Http\Controllers\StatuskedudukanController;
use App\Http\Controllers\DiklatstrukturalController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\Thl2023dinkescamatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('masterGolongan', [GolonganController::class, 'index'])->name('masterGolongan');
Route::post('simpan.golongan', [GolonganController::class, 'store'])->name('simpanGolongan');
Route::post('hapus.golongan', [GolonganController::class, 'hapus'])->name('hapusGolongan');
Route::get('edit.golongan', [GolonganController::class,'edit'])->name('editGolongan');
Route::get('get.golongan', [GolonganController::class,'getGolru'])->name('getGolru');

Route::get('masterTKTPendidikan', [TktPendidikanController::class, 'index'])->name('masterTKTPendidikan');
Route::post('simpan.tktPendidikan', [TktPendidikanController::class, 'store'])->name('simpanTKTPendidikan');
Route::post('hapus.tktPendidikan', [TktPendidikanController::class, 'hapus'])->name('hapusTKTPendidikan');
Route::get('edit.tktPendidikan', [TktPendidikanController::class,'edit'])->name('editTKTPendidikan');

Route::get('masterPendidikan', [PendidikanController::class, 'index'])->name('masterPendidikan');
Route::post('simpan.Pendidikan', [PendidikanController::class, 'store'])->name('simpanPendidikan');
Route::post('hapus.Pendidikan', [PendidikanController::class, 'hapus'])->name('hapusPendidikan');
Route::get('edit.Pendidikan', [PendidikanController::class,'edit'])->name('editPendidikan');
Route::get('dataPendidikan', [PendidikanController::class, 'datariwayat'])->name('dataPendidikan');
Route::get('cariPendidikan', [PendidikanController::class, 'cariPendidikan'])->name('cariPendidikan');

Route::get('masterStatuskedudukan', [StatuskedudukanController::class, 'index'])->name('masterStatuskedudukan');
Route::post('simpan.Statuskedudukan', [StatuskedudukanController::class, 'store'])->name('simpanStatuskedudukan');
Route::post('hapus.Statuskedudukan', [StatuskedudukanController::class, 'hapus'])->name('hapusStatuskedudukan');
Route::get('edit.Statuskedudukan', [StatuskedudukanController::class,'edit'])->name('editStatuskedudukan');

Route::get('masterSatuanKerja', [SatuankerjaController::class, 'index'])->name('masterSatuanKerja');
Route::post('simpan.SatuanKerja', [SatuankerjaController::class, 'store'])->name('simpanSatuanKerja');
Route::post('hapus.SatuanKerja', [SatuankerjaController::class, 'hapus'])->name('hapusSatuanKerja');
Route::get('edit.SatuanKerja', [SatuankerjaController::class,'edit'])->name('editSatuanKerja');
Route::get('cariSatuankerja', [SatuankerjaController::class, 'cariSatuankerja'])->name('cariSatuankerja');

Route::get('masterTingkathukdis', [TingkathukdisController::class, 'index'])->name('masterTingkathukdis');
Route::post('simpan.Tingkathukdis', [TingkathukdisController::class, 'store'])->name('simpanTingkathukdis');
Route::post('hapus.Tingkathukdis', [TingkathukdisController::class, 'hapus'])->name('hapusTingkathukdis');
Route::get('edit.Tingkathukdis', [TingkathukdisController::class,'edit'])->name('editTingkathukdis');

Route::get('masterJenishukuman', [JenishukumanController::class, 'index'])->name('masterJenishukuman');
Route::post('simpan.Jenishukuman', [JenishukumanController::class, 'store'])->name('simpanJenishukuman');
Route::post('hapus.Jenishukuman', [JenishukumanController::class, 'hapus'])->name('hapusJenishukuman');
Route::get('edit.Jenishukuman', [JenishukumanController::class,'edit'])->name('editJenishukuman');

Route::get('masterKategorijabatan', [KategorijabatanController::class, 'index'])->name('masterKategorijabatan');
Route::post('simpan.Kategorijabatan', [KategorijabatanController::class, 'store'])->name('simpanKategorijabatan');
Route::post('hapus.Kategorijabatan', [KategorijabatanController::class, 'hapus'])->name('hapusKategorijabatan');
Route::get('edit.Kategorijabatan', [KategorijabatanController::class,'edit'])->name('editKategorijabatan');

Route::get('masterJenisunor', [JenisunorController::class, 'index'])->name('masterJenisunor');
Route::post('simpan.Jenisunor', [JenisunorController::class, 'store'])->name('simpanJenisunor');
Route::post('hapus.Jenisunor', [JenisunorController::class, 'hapus'])->name('hapusJenisunor');
Route::get('edit.Jenisunor', [JenisunorController::class,'edit'])->name('editJenisunor');

Route::get('masterJenispegawai', [JenispegawaiController::class, 'index'])->name('masterJenispegawai');
Route::post('simpan.Jenispegawai', [JenispegawaiController::class, 'store'])->name('simpanJenispegawai');
Route::post('hapus.Jenispegawai', [JenispegawaiController::class, 'hapus'])->name('hapusJenispegawai');
Route::get('edit.Jenispegawai', [JenispegawaiController::class,'edit'])->name('editJenispegawai');

Route::get('masterJeniskp', [JeniskpController::class, 'index'])->name('masterJeniskp');
Route::post('simpan.Jeniskp', [JeniskpController::class, 'store'])->name('simpanJeniskp');
Route::post('hapus.Jeniskp', [JeniskpController::class, 'hapus'])->name('hapusJeniskp');
Route::get('edit.Jeniskp', [JeniskpController::class,'edit'])->name('editJeniskp');

Route::get('masterJenisdiklat', [JenisdiklatController::class, 'index'])->name('masterJenisdiklat');
Route::post('simpan.Jenisdiklat', [JenisdiklatController::class, 'store'])->name('simpanJenisdiklat');
Route::post('hapus.Jenisdiklat', [JenisdiklatController::class, 'hapus'])->name('hapusJenisdiklat');
Route::get('edit.Jenisdiklat', [JenisdiklatController::class,'edit'])->name('editJenisdiklat');

Route::get('masterEkin', [EkinController::class, 'index'])->name('masterEkin');
Route::post('simpan.Ekin', [EkinController::class, 'store'])->name('simpanEkin');
Route::post('hapus.Ekin', [EkinController::class, 'hapus'])->name('hapusEkin');
Route::get('edit.Ekin', [EkinController::class,'edit'])->name('editEkin');

Route::get('masterPribadi', [PribadiController::class, 'index'])->name('masterPribadi');
Route::get('masteragama', [PribadiController::class, 'dataagama'])->name('dataAgama');
Route::get('masterstatusnikah', [PribadiController::class, 'datastatusnikah'])->name('datastatusnikah');


Route::post('simpan.Agama', [AgamaController::class, 'store'])->name('simpanAgama');
Route::post('hapus.Agama', [AgamaController::class, 'hapus'])->name('hapusAgama');
Route::get('edit.Agama', [AgamaController::class,'edit'])->name('editAgama');

Route::post('simpan.Statusnikah', [StatusnikahController::class, 'store'])->name('simpanStatus');
Route::post('hapus.Statusnikah', [StatusnikahController::class, 'hapus'])->name('hapusStatus');
Route::get('edit.Statusnikah', [StatusnikahController::class,'edit'])->name('editStatus');

Route::get('masterDiklat', [DiklatController::class, 'index'])->name('masterDiklat');
Route::get('masterjenisdiklat', [DiklatController::class, 'datajenisdiklat'])->name('datajenisdiklat');
Route::get('masterdiklatstruktural', [DiklatController::class, 'datadiklatstruktural'])->name('datadiklatstruktural');

Route::post('simpan.jenisdiklat', [JenisdiklatController::class, 'store'])->name('simpanjenisdiklat');
Route::post('hapus.jenisdiklat', [JenisdiklatController::class, 'hapus'])->name('hapusjenisdiklat');
Route::get('edit.jenisdiklat', [JenisdiklatController::class,'edit'])->name('editjenisdiklat');

Route::post('simpan.diklatstruktural', [DiklatstrukturalController::class, 'store'])->name('simpandiklatstruktural');
Route::post('hapus.diklatstruktural', [DiklatstrukturalController::class, 'hapus'])->name('hapusdiklatstruktural');
Route::get('edit.diklatstruktural', [DiklatstrukturalController::class,'edit'])->name('editdiklatstruktural');

Route::get('masterPegawaipns', [PegawaipnsController::class, 'index'])->name('masterPegawaipns');
Route::post('simpan.Pegawaipns', [PegawaipnsController::class, 'store'])->name('simpanPegawaipns');
Route::post('hapus.Pegawaipns', [PegawaipnsController::class, 'hapus'])->name('hapusPegawaipns');
Route::get('edit.Pegawaipns', [PegawaipnsController::class,'edit'])->name('editPegawaipns');
Route::get('cari.Pegawaipns', [PegawaipnsController::class,'cariNIPbaru'])->name('pegawai.cariNIPBaru');
Route::get('datapegawai', [PegawaipnsController::class, 'datariwayat'])->name('datapegawai');
Route::get('profilePegawai', [PegawaipnsController::class, 'profilePegawai'])->name('profilePegawai');

Route::get('masterRwgolongan', [RwgolonganController::class, 'index'])->name('masterRwgolongan');
Route::post('simpan.Rwgolongan', [RwgolonganController::class, 'store'])->name('simpanRwgolongan');
Route::post('hapus.Rwgolongan', [RwgolonganController::class, 'hapus'])->name('hapusRwgolongan');
Route::get('edit.Rwgolongan', [RwgolonganController::class,'edit'])->name('editRwgolongan');
Route::get('dataRwgolongan', [RwgolonganController::class, 'datariwayat'])->name('dataRwgolongan');

Route::get('masterRwjabatan', [RwjabatanController::class, 'index'])->name('masterRwjabatan');
Route::post('simpan.Rwjabatan', [RwjabatanController::class, 'store'])->name('simpanRwjabatan');
Route::post('hapus.Rwjabatan', [RwjabatanController::class, 'hapus'])->name('hapusRwjabatan');
Route::get('edit.Rwjabatan', [RwjabatanController::class,'edit'])->name('editRwjabatan');
Route::get('dataRwjabatan', [RwjabatanController::class, 'datariwayat'])->name('dataRwjabatan');

Route::get('masterRwdiklat', [RwdiklatController::class, 'index'])->name('masterRwdiklat');
Route::post('simpan.Rwdiklat', [RwdiklatController::class, 'store'])->name('simpanRwdiklat');
Route::post('hapus.Rwdiklat', [RwdiklatController::class, 'hapus'])->name('hapusRwdiklat');
Route::get('edit.Rwdiklat', [RwdiklatController::class,'edit'])->name('editRwdiklat');
Route::get('dataRwdiklat', [RwdiklatController::class, 'datariwayat'])->name('dataRwdiklat');

Route::get('masterRwpendidikan', [RwpendidikanController::class, 'index'])->name('masterRwpendidikan');
Route::post('simpan.Rwpendidikan', [RwpendidikanController::class, 'store'])->name('simpanRwpendidikan');
Route::post('hapus.Rwpendidikan', [RwpendidikanController::class, 'hapus'])->name('hapusRwpendidikan');
Route::get('edit.Rwpendidikan', [RwpendidikanController::class,'edit'])->name('editRwpendidikan');
Route::get('dataRwpendidikan', [RwpendidikanController::class, 'datariwayat'])->name('dataRwpendidikan');

Route::get('masterRwhukdisiplin', [RwhukdisiplinController::class, 'index'])->name('masterRwhukdisiplin');
Route::post('simpan.Rwhukdisiplin', [RwhukdisiplinController::class, 'store'])->name('simpanRwhukdisiplin');
Route::post('hapus.Rwhukdisiplin', [RwhukdisiplinController::class, 'hapus'])->name('hapusRwhukdisiplin');
Route::get('edit.Rwhukdisiplin', [RwhukdisiplinController::class,'edit'])->name('editRwhukdisiplin');
Route::get('dataRwhukdisiplin', [RwhukdisiplinController::class, 'datariwayat'])->name('dataRwhukdisiplin');


Route::get('masterJabpelaksana', [JabpelaksanaController::class, 'index'])->name('masterJabpelaksana');
Route::post('simpan.Jabpelaksana', [JabpelaksanaController::class, 'store'])->name('simpanJabpelaksana');
Route::post('hapus.Jabpelaksana', [JabpelaksanaController::class, 'hapus'])->name('hapusJabpelaksana');
Route::get('edit.Jabpelaksana', [JabpelaksanaController::class,'edit'])->name('editJabpelaksana');
Route::get('dataJabpelaksana', [JabpelaksanaController::class, 'dataJabatan'])->name('dataJabpelaksana');
Route::get('cariJabpelaksana', [JabpelaksanaController::class, 'cariJabatan'])->name('cariJabpelaksana');

Route::get('masterJabatan', [JabatanController::class, 'index'])->name('masterJabatan');
Route::post('simpan.Jabatan', [JabatanController::class, 'store'])->name('simpanJabatan');
Route::post('hapus.Jabatan', [JabatanController::class, 'hapus'])->name('hapusJabatan');
Route::get('edit.Jabatan', [JabatanController::class,'edit'])->name('editJabatan');
Route::get('dataJabatan', [JabatanController::class, 'dataJabatan'])->name('dataJabatan');
Route::get('cariJabatan', [JabatanController::class, 'cariJabatan'])->name('cariJabatan');

Route::get('masterUnor', [UnorController::class, 'index'])->name('masterUnor');
Route::post('simpan.Unor', [UnorController::class, 'store'])->name('simpanUnor');
Route::post('hapus.Unor', [UnorController::class, 'hapus'])->name('hapusUnor');
Route::get('edit.Unor', [UnorController::class,'edit'])->name('editUnor');
Route::get('dataUnor', [UnorController::class, 'dataUnor'])->name('dataUnor');
Route::get('cariUnor', [UnorController::class, 'cariUnor'])->name('cariUnor');
Route::get('editStatusUnor', [UnorController::class, 'editStatus'])->name('editStatusUnor');
Route::get('editPerangkatUnor', [UnorController::class, 'editPerangkat'])->name('editPerangkatUnor');

Route::get('masterEselon', [EselonController::class, 'index'])->name('masterEselon');
Route::post('simpan.Eselon', [EselonController::class, 'store'])->name('simpanEselon');
Route::post('hapus.Eselon', [EselonController::class, 'hapus'])->name('hapusEselon');
Route::get('edit.Eselon', [EselonController::class,'edit'])->name('editEselon');

Route::get('masterPerangkatdaerah', [PerangkatdaerahController::class, 'index'])->name('masterPerangkatdaerah');
Route::post('simpan.Perangkatdaerah', [PerangkatdaerahController::class, 'store'])->name('simpanPerangkatdaerah');
Route::post('hapus.Perangkatdaerah', [PerangkatdaerahController::class, 'hapus'])->name('hapusPerangkatdaerah');
Route::get('edit.Perangkatdaerah', [PerangkatdaerahController::class,'edit'])->name('editPerangkatdaerah');
Route::get('dataPerangkatdaerah', [PerangkatdaerahController::class, 'dataPerangkatdaerah'])->name('dataPerangkatdaerah');
Route::get('cariPerangkatdaerah', [PerangkatdaerahController::class, 'cariPerangkatdaerah'])->name('cariPerangkatdaerah');

Route::get('masterPresensi', [PresensiController::class, 'index'])->name('masterPresensi');
Route::post('simpan.Presensi', [PresensiController::class, 'store'])->name('simpanPresensi');
Route::post('hapus.Presensi', [PresensiController::class, 'hapus'])->name('hapusPresensi');
Route::get('edit.Presensi', [PresensiController::class,'edit'])->name('editPresensi');
Route::get('dataPresensi', [PresensiController::class, 'dataPresensi'])->name('dataPresensi');
Route::get('cariPresensi', [PresensiController::class, 'cariPresensi'])->name('cariPresensi');

Route::get('masterThl2022', [Thl2022Controller::class, 'index'])->name('masterThl2022');
Route::post('simpan.Thl2022', [Thl2022Controller::class, 'store'])->name('simpanThl2022');
Route::post('hapus.Thl2022', [Thl2022Controller::class, 'hapus'])->name('hapusThl2022');
Route::get('edit.Thl2022', [Thl2022Controller::class,'edit'])->name('editThl2022');
Route::get('dataThl2022', [Thl2022Controller::class, 'dataThl2022'])->name('dataThl2022');
Route::get('editStatusThl2022', [Thl2022Controller::class, 'editStatus'])->name('editStatusThl2022');

Route::get('gayanaji2023', [Thl2023Controller::class, 'index'])->name('masterThl2023');
Route::post('simpan.Thl2023', [Thl2023Controller::class, 'store'])->name('simpanThl2023');
Route::post('hapus.Thl2023', [Thl2023Controller::class, 'hapus'])->name('hapusThl2023');
Route::get('edit.Thl2023', [Thl2023Controller::class,'edit'])->name('editThl2023');
Route::get('dataThl2023', [Thl2023Controller::class, 'dataThl2023'])->name('dataThl2023');
Route::get('editStatusThl2023', [Thl2023Controller::class, 'editStatus'])->name('editStatusThl2023');
Route::get('statusThl2023', [Thl2023Controller::class, 'statusTHL'])->name('statusThl2023');

Route::get('masterDinkes', [Thl2023dinkescamatController::class, 'index'])->name('masterThl2023dinkescamat');
Route::get('dataThl2023dinkes', [Thl2023dinkescamatController::class, 'dataThl2023'])->name('dataThl2023dinkescamat');


Route::get('masterPPPK', [PPPKController::class, 'index'])->name('masterPPPK');
Route::post('simpan.PPPK', [PPPKController::class, 'store'])->name('simpanPPPK');
Route::post('hapus.PPPK', [PPPKController::class, 'hapus'])->name('hapusPPPK');
Route::get('edit.PPPK', [PPPKController::class,'edit'])->name('editPPPK');

Route::get('showLinear', [PPPKController::class, 'showlinier'])->name('linear');
Route::post('beri.nilai', [PPPKController::class, 'beriNilai'])->name('beriNilai');
Route::get('wilayah', [WilayahController::class,'index'])->name('wilayah.index');

Route::get('masterSekolah', [SekolahController::class, 'index'])->name('masterSekolah');
Route::post('simpan.Sekolah', [SekolahController::class, 'store'])->name('simpanSekolah');
Route::post('hapus.Sekolah', [SekolahController::class, 'hapus'])->name('hapusSekolah');
Route::get('edit.Sekolah', [SekolahController::class,'edit'])->name('editSekolah');




require __DIR__.'/auth.php';
