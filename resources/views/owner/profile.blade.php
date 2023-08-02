<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile ASN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Profile ASN
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid"
                                    src="" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><span id="nama_profile"></span></h3>
                            <p class="text-muted text-center"><span id="jabatan"></span><br>
                            <span id="unitkerja"></span></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>NIP</b> <a class="float-right"><span id="nip_baru">{{ $data->nip_baru }}</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Lahir</b> <a class="float-right"><span id="tgl_lahir_profile"></span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Jenis Pegawai</b> <a class="float-right"><span id="jenispegawai"></span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status Menikah</b> <a class="float-right"><span id="statusnikah"></span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Masa Kerja PNS</b> <a class="float-right">??????</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Batas Usia Pensiun</b> <a class="float-right">???????</a>
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-md-5">
                                    <a href="#" class="edit-profile btn btn-warning btn-block" data-toggle="modal" data-target="#modalProfile"><i class="fas fa-edit"></i> <b>Edit Profile Utama</b></a>
                                </div>
                                <div class="col-md-5">
                                    <a href="#" class="cetak-profile btn btn-info btn-block"><i class="fas fa-print"></i> <b>Cetak Profile</b></a>
                                </div>
                                <div class="col-md-2">
                                    <a href="#" title="Refresh Profile" class="refresh-profile btn btn-success btn-block"><i class="fas fa-retweet"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card card-danger card-outline">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Informasi Umum</h3>
                        </div> --}}

                        <div class="card-body">
                            <strong><i class="fas fa-graduation-cap"></i> Pendidikan Terakhir</strong>
                            <p class="text-muted">
                                <span id="pendidikan"></span>
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marked-alt"></i> Alamat</strong>
                            <p class="text-muted"><span id="alamat_profile"></span></p>
                            <div class="d-flex justify-content-around">
                                <div><i class="fas fa-mobile-alt"></i> <span id="nomor_hp_profile"></span></div>
                                <div><i class="far fa-envelope"></i> <span id="email_profile"></span></div>
                            </div>
                            <hr>
                            <strong><i class="fas fa-square-root-alt"></i> Golongan Terakhir</strong>
                            <p class="text-muted">
                                <span id="golru"></span>
                            </p>
                        </div>

                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card card-info card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#rwgolongan" data-toggle="tab">Riwayat Golongan</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#rwjabatan" data-toggle="tab">Riwayat Jabatan</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#rwpendidikan" data-toggle="tab">Riwayat Pendidikan</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#rwdiklat" data-toggle="tab">Riwayat Diklat</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#rwhukdis" data-toggle="tab">Riwayat Hukuman Disiplin</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="rwgolongan">
                                    <div class="d-flex justify-content-between">
                                        <div><h4>Daftar Riwayat Golongan</h4></div>
                                        <div class="pb-2">
                                            <button type="button" name="tambah_golongan" id="tambah_golongan" class="btn btn-primary btn-md btn-block"  data-toggle="modal" data-target="#modalriwayatgolongan">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>

                                    <table style="width: 100%;" id="tabelRwgolongan" class="table table-hover table-sm table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Golongan</th>
                                                <th>Ruang</th>
                                                <th>Jenis KP</th>
                                                <th>TMT</th>
                                                <th>MKG Tahun</th>
                                                <th>MKG Bulan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="rwjabatan">
                                    <div class="d-flex justify-content-between">
                                        <div><h4>Daftar Riwayat Jabatan</h4></div>
                                        <div class="pb-2">
                                            <button type="button" name="tambah_jabatan" id="tambah_jabatan" class="btn btn-primary btn-md btn-block"  data-toggle="modal" data-target="#modalriwayatjabatan">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <table style="width: 100%;" id="tabelRwjabatan" class="table table-hover table-sm table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Jabatan</th>
                                                <th>Unit Kerja</th>
                                                <th>Eselon</th>
                                                <th>TMT</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="rwpendidikan">
                                    <div class="d-flex justify-content-between">
                                        <div><h4>Daftar Riwayat Pendidikan</h4></div>
                                        <div class="pb-2">
                                            <button type="button" name="tambah_pendidikan" id="tambah_pendidikan" class="btn btn-primary btn-md btn-block"  data-toggle="modal" data-target="#modalriwayatpendidikan">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <table style="width: 100%;" id="tabelRwpendidikan" class="table table-hover table-sm table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Jenjang / Jurusan</th>
                                                <th>Nama Tempat Pendidikan</th>
                                                <th>Lokasi</th>
                                                <th>Pendidikan Awal</th>
                                                <th>Tahun Lulus</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="rwdiklat">
                                    <div class="d-flex justify-content-between">
                                        <div><h4>Daftar Riwayat Pelatihan</h4></div>
                                        <div class="pb-2">
                                            <button type="button" name="tambah_diklat" id="tambah_diklat" class="btn btn-primary btn-md btn-block"  data-toggle="modal" data-target="#modalriwayatdiklat">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <table style="width: 100%;" id="tabelRwdiklat" class="table table-hover table-sm table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Jenis Diklat</th>
                                                <th>Nama Diklat</th>
                                                <th>Penyelenggara</th>
                                                <th>Jumlah Jam</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="rwhukdis">
                                    <div class="d-flex justify-content-between">
                                        <div><h4>Daftar Riwayat Hukuman Disiplin</h4></div>
                                        <div class="pb-2">
                                            <button type="button" name="tambah_hukdis" id="tambah_hukdis" class="btn btn-primary btn-md btn-block"  data-toggle="modal" data-target="#modalriwayathukdis">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                    <table style="width: 100%;" id="tabelRwhukdisiplin" class="table table-hover table-sm table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>Tingkat Hukuman</th>
                                                <th>Jenis Hukuman</th>
                                                <th>Tanggal SK</th>
                                                <th>PP Nomor</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience"
                                                    placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills"
                                                    placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and
                                                            conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            {{-- <div class="card-footer text-muted">
                                Footer
                            </div> --}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menampilkan Form profile ASN --}}
    <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title"><strong>Update Profile ASN</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="nip_baru" id="nip_baru" placeholder="">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukkan nama pegawai">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gelar_depan">Gelar Depan</label>
                                <input type="text" name="gelar_depan" id="gelar_depan" class="form-control"
                                    placeholder="Masukkan Gelar Depan">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gelar_blk">Gelar Belakang</label>
                                <input type="text" name="gelar_blk" id="gelar_blk" class="form-control"
                                    placeholder="Masukkan gelar belakang">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_nama">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_nama" id="tempat_lahir_nama" class="form-control"
                                    placeholder="Masukkan tempat lahir">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tgl_lahir"
                                    placeholder="Masukkan tanggal lahir">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="P">Pria</option>
                                    <option value="W">Wanita</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    placeholder="Masukkan nik pegawai">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_hp">Nomor Telepon</label>
                                <input type="text" name="nomor_hp" id="nomor_hp" class="form-control"
                                    placeholder="Masukkan nomor telepon pegawai">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Surel</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Masukkan surel pegawai">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="npwp_nomor">NPWP</label>
                                <input type="text" name="npwp_nomor" id="npwp_nomor" class="form-control"
                                    placeholder="Masukkan nomor NPWP">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bpjs">BPJS</label>
                                <input type="text" name="bpjs" id="bpjs" class="form-control"
                                    placeholder="Masukkan nomor BPJS">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kartu_pegawai">Kartu Pegawai</label>
                                <input type="text" name="kartu_pegawai" id="kartu_pegawai" class="form-control"
                                    placeholder="Masukkan kartu pegawai">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agama_id">Agama</label>
                                <select class="form-control" name="agama_id" id="agama_id">
                                    @foreach ($agama as $e)
                                    <option value="{{ $e->id }}">{{ $e->kode . ' - ' . $e->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status_nikah_id">Status Nikah</label>
                                <select class="form-control" name="status_nikah_id" id="status_nikah_id">
                                    @foreach ($statusnikah as $e)
                                    <option value="{{ $e->id }}">{{ $e->kode . ' - ' . $e->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_pegawai_id">Jenis Pegawai</label>
                                <select class="form-control" name="jenis_pegawai_id" id="jenis_pegawai_id">
                                    @foreach ($jenispegawai as $e)
                                    <option value="{{ $e->id }}">{{ $e->kode . ' - ' . $e->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_profile" name="simpan_profile" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menampilkan Form Tambah/Update Riwayat Golongan --}}
    <div class="modal fade" id="modalriwayatgolongan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <strong><h5 id="model_title_gol" class="modal-title">Tambah Riwayat Golongan</h5></strong>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id_rwgol" id="id_rwgol">
                                <input type="hidden" name="idOrang_rwgol" id="idOrang_rwgol">
                                <label for="nip_baru_rwgol">NIP Baru</label>
                                <input type="text" name="nip_baru_rwgol" id="nip_baru_rwgol" class="form-control" placeholder="Masukkan NIP Baru">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="namalengkap_rwgol">Nama Lengkap</label>
                                <input type="text" name="namalengkap_rwgol" id="namalengkap_rwgol" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idGolongan_rwgol">Golongan/Pangkat</label>
                                <select class="form-control" name="idGolongan_rwgol" id="idGolongan_rwgol">
                                    @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="idJeniskp_rwgol">Jenis Kenaikan Pangkat</label>
                                <select class="form-control" name="idJeniskp_rwgol" id="idJeniskp_rwgol">
                                    @foreach ($jeniskp as $kp)
                                    <option value="{{ $kp->id }}">{{ $kp->kode . ' ' . $kp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="row sk-pertek">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="skNomor_rwgol">Nomor SK</label>
                                <input type="text" name="skNomor_rwgol" id="skNomor_rwgol" class="form-control" placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="skTanggal_rwgol">Tanggal SK</label>
                                <input type="text" name="skTanggal_rwgol" id="skTanggal_rwgol" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#skTanggal_rwgol" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pertekNomor_rwgol">Nomor Pertek</label>
                                <input type="text" name="pertekNomor_rwgol" id="pertekNomor_rwgol" class="form-control" placeholder="Nomor Pertek">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pertekTanggal_rwgol">Tanggal Pertek</label>
                                <input type="text" name="pertekTanggal_rwgol" id="pertekTanggal_rwgol" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#pertekTanggal_rwgol" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col md-2">
                            <div class="form-group">
                                <label for="tmt_rwgol">TMT</label>
                                <input type="text" class="form-control datetimepicker-input" id="tmt_rwgol" data-toggle="datetimepicker"
                                    data-target="#tmt_rwgol" placeholder="yyyy-mm-dd"/>
                            </div>
                        </div>
                    </div>
                    <div class="row ak-mkg">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="akUtama_rwgol">AK Utama</label>
                                <input type="text" name="akUtama_rwgol" id="akUtama_rwgol" class="form-control"
                                    placeholder="AK Utama">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="akTambahan_rwgol">AK Tambahan</label>
                                <input type="text" name="akTambahan_rwgol" id="akTambahan_rwgol" class="form-control"
                                    placeholder="AK Tambahan">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mkGolTahun_rwgol">MKG (Tahun)</label>
                                <input type="text" name="mkGolTahun_rwgol" id="mkGolTahun_rwgol" class="form-control"
                                    placeholder="Tahun MKG">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mkGolBulan_rwgol">MKG (Bulan)</label>
                                <input type="text" name="mkGolBulan_rwgol" id="mkGolBulan_rwgol" class="form-control"
                                    placeholder="Bulan MKG">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup_rwgol" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_rwgol" name="simpan_rwgol" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menampilkan Form Tambah/Update Riwayat Jabatan  --}}
    <div class="modal fade" id="modalriwayatjabatan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title" id="model_title_jab"><strong>Tambah Riwayat Jabatan</strong></h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id_rwjab" id="id_rwjab">
                                <input type="hidden" name="idOrang_rwjab" id="idOrang_rwjab">
                                <label for="nip_baru_rwjab">NIP Baru</label>
                                <input type="text" name="nip_baru_rwjab" id="nip_baru_rwjab" class="form-control" placeholder="Masukkan NIP Baru">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="namalengkap_rwjab">Nama Lengkap</label>
                                <input type="text" name="namalengkap_rwjab" id="namalengkap_rwjab" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="idUnor">
                        <label for="unitKerjaText_rwjab">Unit Kerja</label>
                        <input type="text" name="unitKerjaText_rwjab" id="unitKerjaText_rwjab" class="form-control"
                            placeholder="Unit Kerja">
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="idJabatan_rwjab">
                        <label for="namaJabatan__rwjab">Jabatan</label>
                        <input type="text" name="namaJabatan_rwjab" id="namaJabatan_rwjab" class="form-control"
                            placeholder="Jabatan">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idKategoriJabatan_rwjab">Jenis Jabatan</label>
                                <select class="form-control" name="idKategoriJabatan_rwjab" id="idKategoriJabatan_rwjab">
                                    @foreach ($kategoriJabatan as $kj)
                                    <option value="{{ $kj->id }}">{{ $kj->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="idEselon_rwjab">Eselon</label>
                                <select class="form-control" name="idEselon_rwjab" id="idEselon_rwjab">
                                    @foreach ($eselon as $es)
                                    <option value="{{ $es->id }}">{{ $es->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skNomor_rwjab">Nomor SK</label>
                                <input type="text" name="skNomor_rwjab" id="skNomor_rwjab" class="form-control" placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="skTanggal_rwjab">Tanggal SK</label>
                                <input type="text" name="skTanggal_rwjab" id="skTanggal_rwjab" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#skTanggal_rwjab" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>

                  <div class="row sk-pertek">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tmtJabatan_rwjab">TMT Jabatan</label>
                                <input type="text" name="tmtJabatan_rwjab" id="tmtJabatan_rwjab" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tmtJabatan_rwjab" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tmtPelantikan_rwjab">Pelantikan</label>
                                <input type="text" class="form-control datetimepicker-input" id="tmtPelantikan_rwjab" name="tmtPelantikan_rwjab" data-toggle="datetimepicker"
                                    data-target="#tmtPelantikan_rwjab" placeholder="yyyy-mm-dd"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="hidden" name="idSatuanKerja_rwjab" id="idSatuanKerja_rwjab">
                                <label for="satuanKerja_rwjab">Satuan Kerja</label>
                                <input type="text" name="satuanKerja_rwjab" id="satuanKerja_rwjab" class="form-control" placeholder="Satuan Kerja">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup_rwjab" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_rwjab" name="simpan_rwjab" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menampilkan form tambah/update riwayat pendidikan --}}
    <div class="modal fade" id="modalriwayatpendidikan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title" id="model_title_pendidikan"><strong>Tambah Riwayat Pendidikan</strong></h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id_rwpendidikan" id="id_rwpendidikan">
                                <input type="hidden" name="idOrang_rwpendidikan" id="idOrang_rwpendidikan">
                                <label for="nip_baru_rwpendidikan">NIP Baru</label>
                                <input type="text" name="nip_baru_rwpendidikan" id="nip_baru_rwpendidikan" class="form-control" placeholder="Masukkan NIP Baru">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                {{-- <input type="hidden" name="id" id="id"> --}}
                                <label for="namalengkap_rwpendidikan">Nama Lengkap</label>
                                <input type="text" name="namalengkap_rwpendidikan" id="namalengkap_rwpendidikan" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idtktPendidikan_rwpendidikan">Tingkat Pendidikan</label>
                                <select class="form-control" name="idtktPendidikan_rwpendidikan" id="idtktPendidikan_rwpendidikan">
                                    @foreach ($tktPendidikan as $tkt)
                                    <option value="{{ $tkt->id }}" data="{{ $tkt->kode }}">{{ $tkt->kode . ' ' . $tkt->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="hidden" name="idPendidikan_rwpendidikan" id="idPendidikan_rwpendidikan">
                                <label for="cariPendidikan_rwpendidikan">Pendidikan</label>
                                <input type="text" name="cariPendidikan_rwpendidikan" id="cariPendidikan_rwpendidikan" class="form-control" placeholder="Pendidikan">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="namaSekolah_rwpendidikan">Nama Sekolah</label>
                                <input type="text" name="namaSekolah_rwpendidikan" id="namaSekolah_rwpendidikan" class="form-control" placeholder="Nama sekolah">
                            </div>
                        </div>
                    </div>
                  <div class="row sk-pertek">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="noIjazah_rwpendidikan">Nomor Ijazah</label>
                                <input type="text" name="noIjazah_rwpendidikan" id="noIjazah_rwpendidikan" class="form-control" placeholder="Nomor Ijazah">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglLulus_rwpendidikan">Tanggal Lulus</label>
                                <input type="text" name="tglLulus_rwpendidikan" id="tglLulus_rwpendidikan" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tglLulus_rwpendidikan" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="thnLulus_rwpendidikan">Tahun Lulus</label>
                                <input readonly type="text" name="thnLulus_rwpendidikan" id="thnLulus_rwpendidikan" class="form-control" placeholder="Tahun lulus">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lokasi_rwpendidikan">Lokasi</label>
                                <input type="text" name="lokasi_rwpendidikan" id="lokasi_rwpendidikan" class="form-control" placeholder="Lokasi Pendidikan">
                            </div>
                        </div>

                    </div>
                    <div class="row ak-mkg">
                        <div class="col md-2">
                            <div class="form-group">
                                <label for="pendAwal_rwpendidikan">Pendidikan Awal CPNS/PNS</label>
                                <select class="custom-select" name="pendAwal_rwpendidikan" id="pendAwal_rwpendidikan">
                                    <option selected value=0>Bukan</option>
                                    <option value=1>Ya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="glrDepan_rwpendidikan">Gelar Depan</label>
                                <input type="text" name="glrDepan_rwpendidikan" id="glrDepan_rwpendidikan" class="form-control"
                                    placeholder="Gelar depan">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="glrBelakang_rwpendidikan">Gelar Belakang</label>
                                <input type="text" name="glrBelakang_rwpendidikan" id="glrBelakang_rwpendidikan" class="form-control"
                                    placeholder="Gelar belakang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup_rwpendidikan" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_rwpendidikan" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menampilkan form tambah/update riwayat pendidikan pelatihan --}}
    <div class="modal fade" id="modalriwayatdiklat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title" id="model_title_diklat"><strong>Tambah Riwayat Pelatihan</strong></h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id_rwdiklat" id="id_rwdiklat">
                                <input type="hidden" name="idOrang_rwdiklat" id="idOrang_rwdiklat">
                                <label for="nip_baru_rwdiklat">NIP Baru</label>
                                <input type="text" name="nip_baru_rwdiklat" id="nip_baru_rwdiklat" class="form-control" placeholder="Masukkan NIP Baru">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="namalengkap_rwdiklat">Nama Lengkap</label>
                                <input type="text" name="namalengkap_rwdiklat" id="namalengkap_rwdiklat" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_diklat_id">Jenis Diklat</label>
                                <select class="form-control" name="jenis_diklat_id" id="jenis_diklat_id">
                                    @foreach ($jenisdiklat as $diklat)
                                    <option value="{{ $diklat->id }}">{{ $diklat->id_siasn . '. ' . $diklat->jenisdiklat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <div id="namadiklat2" class="form-group">
                                <label for="diklatstruktural">Kelompok Diklat Strukural</label>
                                <select class="form-control" name="diklatstruktural" id="diklatstruktural">
                                    @foreach ($diklatstruktural as $diklat)
                                    <option value="{{ $diklat->id }}">{{ $diklat->diklatstruktural }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="namadiklat1" class="form-group">
                                <label for="diklat_nama">Nama Diklat</label>
                                <input type="text" name="diklat_nama" id="diklat_nama" class="form-control" placeholder="Nama Pelatihan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_sertipikat">Nomor Sertifikat</label>
                                <input type="text" name="nomor_sertipikat" id="nomor_sertipikat" class="form-control" placeholder="Nomor Sertifikat">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_sertipikat">Tanggal</label>
                                <input type="text" name="tanggal_sertipikat" id="tanggal_sertipikat" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tanggal_sertipikat" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tanggal_mulai" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="text" class="form-control datetimepicker-input" id="tanggal_selesai" data-toggle="datetimepicker"
                                    data-target="#tanggal_selesai" placeholder="yyyy-mm-dd"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="text" name="tahun" id="tahun" class="form-control"
                                    placeholder="Tahun">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jumlah_jam">Jumlah JP</label>
                                <input type="text" name="jumlah_jam" id="jumlah_jam" class="form-control"
                                    placeholder="Jumlah JP">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="durasi_hari">Lama Hari</label>
                                <input type="text" name="durasi_hari" id="durasi_hari" class="form-control"
                                    placeholder="Lama Hari">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bobot_kompetensi">Bobot Kompetensi</label>
                                <input type="text" name="bobot_kompetensi" id="bobot_kompetensi" class="form-control" placeholder="Bobot">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="jenis_kompetensi">Jenis Kompetensi</label>
                                <input type="text" name="jenis_kompetensi" id="jenis_kompetensi" class="form-control"
                                    placeholder="Jenis Kompetensi">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="institusi_penyelenggara">Penyelenggara</label>
                                <input type="text" name="institusi_penyelenggara" id="institusi_penyelenggara" class="form-control" placeholder="Institusi penyelenggara">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="hidden" name="instansi_id" id="instansi_id">
                                <label for="satuanKerja_rwdiklat">Satuan Kerja</label>
                                <input type="text" name="satuanKerja_rwdiklat" id="satuanKerja_rwdiklat" class="form-control" placeholder="Satuan Kerja">
                            </div>
                        </div>
                    </div>

                    {{-- Field yang berasal dari API SIASN, belum ketahuan untuk apa --}}
                    <input type="hidden" name="jenis_kursus_id" id="jenis_kursus_id" placeholder="Jenis kursus" value="0">
                    <input type="hidden" name="path" id="path" value="0">
                    <input type="hidden" name="tipe" id="tipe" value="0">
                    <input type="hidden" name="id_riwayat_update" id="id_riwayat_update" value="0">
                    <input type="hidden" name="jenis_kursus_sertipikat" id="jenis_kursus_sertipikat" value="0">
                    {{-- Akhir API SIASN --}}

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup_rwdiklat" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_rwdiklat" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk menampilkan form tambah/update riwayat hukuman disiplin --}}
    <div class="modal fade" id="modalriwayathukdis" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-maroon">
                    <h5 class="modal-title" id="model_title_hukdis"><strong>Tambah Riwayat Hukuman Disiplin</strong></h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id_rwhukdis" id="id_rwhukdis">
                                <input type="hidden" name="idOrang_rwhukdis" id="idOrang_rwhukdis">
                                <label for="nip_baru_rwhukdis">NIP Baru</label>
                                <input type="text" name="nip_baru_rwhukdis" id="nip_baru_rwhukdis" class="form-control" placeholder="Masukkan NIP Baru">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="namalengkap_rwhukdis">Nama Lengkap</label>
                                <input type="text" name="namalengkap_rwhukdis" id="namalengkap_rwhukdis" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idGolongan_rwhukdis">Golongan</label>
                                <select class="form-control" name="idGolongan_rwhukdis" id="idGolongan_rwhukdis">
                                     @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="idHukdis_rwhukdis">Jenis Hukuman Disiplin</label>
                            <select class="form-control" name="idHukdis_rwhukdis" id="idHukdis_rwhukdis">
                                @foreach ($jenishukuman as $jns)
                                <option value="{{ $jns->id }}">{{ '('. $jns->tkthukdis . ') - ' . $jns->nama}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                   <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skNomor_rwhukdis">Nomor SK</label>
                                <input type="text" name="skNomor_rwhukdis" id="skNomor_rwhukdis" class="form-control" placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="skTanggal_rwhukdis">Tanggal SK</label>
                                <input type="text" name="skTanggal_rwhukdis" id="skTanggal_rwhukdis" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#skTanggal_rwhukdis" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skPembatalan_rwhukdis">SK Pembatalan</label>
                                <input type="text" name="skPembatalan_rwhukdis" id="skPembatalan_rwhukdis" class="form-control"
                                    placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglSkbatal_rwhukdis">Tanggal SK</label>
                                <input type="text" name="tglSkbatal_rwhukdis" id="tglSkbatal_rwhukdis" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#tglSkbatal_rwhukdis" placeholder="yyyy-mm-dd">
                            </div>
                        </div>

                    </div>
                  <div class="row sk-pertek">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ppNomor_rwhukdis">Aturan Hukum</label>
                                <input type="text" name="ppNomor_rwhukdis" id="ppNomor_rwhukdis" class="form-control" placeholder="Aturan yang mengatur">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglMulai_rwhukdis">Tanggal Mulai</label>
                                <input type="text" name="tglMulai_rwhukdis" id="tglMulai_rwhukdis" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tglMulai_rwhukdis" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglAkhir_rwhukdis">Tanggal Akhir</label>
                                <input type="text" name="tglAkhir_rwhukdis" id="tglAkhir_rwhukdis" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tglAkhir_rwhukdis" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="masaTahun_rwhukdis">Masa Tahun</label>
                                <input type="text" name="masaTahun_rwhukdis" id="masaTahun_rwhukdis" class="form-control" placeholder="Masa Tahun">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="masaBulan_rwhukdis">Masa Bulan</label>
                                <input type="text" name="masaBulan_rwhukdis" id="masaBulan_rwhukdis" class="form-control" placeholder="Masa Bulan">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup_rwhukdis" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan_rwhukdis" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
@stack('js')

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        loadprofile("{{ $pns_id }}");
        $('.datetimepicker-input').datetimepicker({
            locale: 'id',
            format: 'L',
            viewMode: 'months',
            format: 'YYYY-MM-DD'
        });
    });

    function loadrwgolongan(nipbaru) {
        $('#tabelRwgolongan').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<<t>p>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            url: "{{ route('dataRwgolongan') }}",
            data: {
                nip_baru: nipbaru,
                },
            },

            columns: [
                {
                data: 'golPNS',
                name: 'golPNS',
                width:'80px',
                },
                {
                data: 'pangkatPNS',
                name: 'pangkatPNS'
                },
                {
                data: 'jenisKP',
                name: 'jenisKP',

                },
                {
                data: 'tmt',
                name: 'tmt',
                width:'100px',
                },
                {
                data: 'mkGolTahun',
                name: 'mkGolTahun',
                width:'100px',
                },
                {
                data: 'mkGolBulan',
                name: 'mkGolBulan',
                width:'100px',
                },
                {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                width:'130px',
            },
            ]
            })
    }

    function loadrwjabatan(cari_nip_baru) {
        $('#tabelRwjabatan').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<<t>ip>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            // type: "post",
            url: "{{ route('dataRwjabatan') }}",
            data: {
                nip_baru: cari_nip_baru,
                // carinama:carinama,
                // jumlahView:jumlahView,
                },
            },

            columns: [
                {
                data: 'jenis',
                name: 'jenis'
                },
                {
                data: 'jabatan',
                name: 'jabatan'
                },
                {
                data: 'unitKerjaText',
                name: 'unitKerjaText',

                },
                {
                data: 'eselon',
                name: 'eselon'
                },
                {
                data: 'tmtJabatan',
                name: 'tmtJabatan'
                },
                {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                width:'130px',
            },
            ]
            })
    }

    function loadrwpendidikan(cari_nip_baru) {
        $('#tabelRwpendidikan').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<<t>p>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            // type: "post",
            url: "{{ route('dataRwpendidikan') }}",
            data: {
                nip_baru: cari_nip_baru,
                // nama:nama,
                // cari_idtktPendidikan:cari_idtktPendidikan,
                // cariJurusan:cariJurusan,
                // cariSekolah:cariSekolah,
                // cariLokasi:cariLokasi,
                // cari_tglAwal:cari_tglAwal,
                // cari_tglAkhir:cari_tglAkhir,
                // jumlahView:jumlahView,
                },
            },

            columns: [
                {
                data: 'namaPendidikan',
                name: 'namaPendidikan'
                },
                {
                data: 'namaSekolah',
                name: 'namaSekolah',

                },
                {
                data: 'lokasi',
                name: 'lokasi'
                },
                {
                data: 'pendAwal',
                name: 'pendAwal'
                },
                {
                data: 'thnLulus',
                name: 'thnLulus'
                },
                {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                width:'130px',
            },
            ]
            })
    }

    function loadrwdiklat(cari_nip_baru) {
        $('#tabelRwdiklat').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<lBf<t>ip>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            // type: "post",
            url: "{{ route('dataRwdiklat') }}",
            data: {
                nip_baru: cari_nip_baru,
                },
            },

            columns: [
                {
                data: 'jenisdiklat',
                name: 'jenisdiklat'
                },
                {
                data: 'diklat_nama',
                name: 'diklat_nama'
                },
                {
                data: 'institusi_penyelenggara',
                name: 'institusi_penyelenggara',

                },
                {
                data: 'jumlah_jam',
                name: 'jumlah_jam'
                },
                {
                data: 'tahun',
                name: 'tahun'
                },
                {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                width:'130px',
            },
            ]
            })
    }

    function loadrwhukdis(cari_nip_baru) {
        $('#tabelRwhukdisiplin').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<<t>ip>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            // type: "post",
            url: "{{ route('dataRwhukdisiplin') }}",
            data: {
                nip_baru: cari_nip_baru,
                },
            },

            columns: [
                {
                data: 'tingkatHukuman',
                name: 'tingkatHukuman'
                },
                {
                data: 'jenisHukuman',
                name: 'jenisHukuman'
                },
                {
                data: 'skTanggal',
                name: 'skTanggal',
                },
                {
                data: 'ppNomor',
                name: 'ppNomor'
                },
                {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                width:'130px',
            },
            ]
            })
    }


    function fileExists(url, callback) {
        $.ajax({
            type: 'HEAD',
            url: url,
            success: function () {
                callback(true);
            },
            error: function () {
                callback(false);
            }
        });
    }

    function loadprofile(pns_id) {
        $.ajax({
            type: "get",
            url: "{{ route('editPegawaipns') }}",
            data: {
                id:pns_id,
            },
            success: function (response) {
                var photo = '{{  asset('dist/img/foto')}}/'+ response.nip_baru +'.jpg';
                var jeniskelamin = response.jenis_kelamin;
                fileExists(photo, function (exists) {
                    if (!exists) {
                        if(jeniskelamin == 'W') {
                            $('.profile-user-img').attr('src', '{{  asset('dist/img/avatar3.png')}}');
                        } else {
                            $('.profile-user-img').attr('src', '{{  asset('dist/img/avatar5.png')}}');
                        }
                    } else {
                        $('.profile-user-img').attr('src', photo);
                    }
                });
                // Load data profile
                $('#nama_profile').text(response.namalengkap);
                $('#tgl_lahir_profile').text(response.tgl_lahir);
                $('#alamat_profile').text(response.alamat);
                $('#statusnikah').text(response.statusnikah);
                $('#jenispegawai').text(response.jenispegawai);
                $('#jabatan').text(response.jabatan);
                $('#unitkerja').text(response.unitkerja);
                $('#pendidikan').text(response.pendidikan);
                $('#golru').text(response.golru);
                $('#nomor_hp_profile').text(response.nomor_hp);
                $('#email_profile').text(response.email);

                //Load untuk modal profile utama
                $('#nip_baru').val(response.nip_baru);
                $('#nama').val(response.nama);
                $('#gelar_depan').val(response.gelar_depan);
                $('#gelar_blk').val(response.gelar_blk);
                $('#tempat_lahir_nama').val(response.tempat_lahir_nama);
                $('#tgl_lahir').val(response.tgl_lahir);
                $('#jenis_kelamin').val(response.jenis_kelamin);
                $('#nik').val(response.nik);
                $('#nomor_hp').val(response.nomor_hp);
                $('#email').val(response.email);
                $('#alamat').val(response.alamat);
                $('#npwp_nomor').val(response.npwp_nomor);
                $('#bpjs').val(response.bpjs);
                $('#kartu_pegawai').val(response.kartu_pegawai);
                $('#agama_id').val(response.agama_id);
                $('#status_nikah_id').val(response.status_nikah_id);
                $('#jenis_pegawai_id').val(response.jenis_pegawai_id);


                //Load data untuk modal riwayat golongan
                $('#nip_baru_rwgol').attr('readonly', true);
                $('#nip_baru_rwgol').val(response.nip_baru);
                $('#namalengkap_rwgol').val(response.namalengkap);
                $('#idOrang_rwgol').val(response.pns_id);
                $('#tutup_rwgol').click();

                // Load data untuk modal riwayat jabatan
                $('#nip_baru_rwjab').attr('readonly', true);
                $('#nip_baru_rwjab').val(response.nip_baru);
                $('#namalengkap_rwjab').val(response.namalengkap);
                $('#idOrang_rwjab').val(response.pns_id);

                // Load data untuk modal riwayat pendidikan
                $('#nip_baru_rwpendidikan').attr('readonly', true);
                $('#nip_baru_rwpendidikan').val(response.nip_baru);
                $('#namalengkap_rwpendidikan').val(response.namalengkap);
                $('#idOrang_rwpendidikan').val(response.pns_id);

                // Load data untuk modal riwayat diklat
                $('#nip_baru_rwdiklat').attr('readonly', true);
                $('#nip_baru_rwdiklat').val(response.nip_baru);
                $('#namalengkap_rwdiklat').val(response.namalengkap);
                $('#idOrang_rwdiklat').val(response.pns_id);

                // Load data untuk modal riwayat hukuman disiplin
                $('#nip_baru_rwhukdis').attr('readonly', true);
                $('#nip_baru_rwhukdis').val(response.nip_baru);
                $('#namalengkap_rwhukdis').val(response.namalengkap);
                $('#idOrang_rwhukdis').val(response.pns_id);

                //Load data riwayat
                loadrwgolongan(response.nip_baru);
                loadrwjabatan(response.nip_baru);
                loadrwpendidikan(response.nip_baru);
                loadrwdiklat(response.nip_baru);
                loadrwhukdis(response.nip_baru);
            }
        });
    }

    $('.refresh-profile').click(function (e) {
        e.preventDefault();
        loadprofile("{{ $pns_id }}");
    });

    $('#simpan_profile').click(function (e) {
        e.preventDefault();
        let nip_baru = $('#nip_baru').val();
        let mode = 'edit';
        let nama = $('#nama').val();
        let gelar_depan = $('#gelar_depan').val();
        let gelar_blk = $('#gelar_blk').val();
        let tempat_lahir_nama = $('#tempat_lahir_nama').val();
        let tgl_lahir = $('#tgl_lahir').val();
        let jenis_kelamin = $('#jenis_kelamin').val();
        let nik = $('#nik').val();
        let nomor_hp = $('#nomor_hp').val();
        let email = $('#email').val();
        let alamat = $('#alamat').val();
        let npwp_nomor = $('#npwp_nomor').val();
        let bpjs = $('#bpjs').val();
        let kartu_pegawai = $('#kartu_pegawai').val();
        let agama_id = $('#agama_id').val();
        let status_nikah_id = $('#status_nikah_id').val();
        let jenis_pegawai_id = $('#jenis_pegawai_id').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanPegawaipns') }}",
            data: {
                _token: "{{ csrf_token() }}",
                nip_baru:nip_baru,
                mode:mode,
                nama:nama,
                gelar_depan:gelar_depan,
                gelar_blk:gelar_blk,
                tempat_lahir_nama:tempat_lahir_nama,
                tgl_lahir:tgl_lahir,
                jenis_kelamin:jenis_kelamin,
                nik:nik,
                nomor_hp:nomor_hp,
                email:email,
                alamat:alamat,
                npwp_nomor:npwp_nomor,
                bpjs:bpjs,
                kartu_pegawai:kartu_pegawai,
                agama_id:agama_id,
                status_nikah_id:status_nikah_id,
                jenis_pegawai_id:jenis_pegawai_id,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tutup').click();
                loadprofile("{{ $pns_id }}");

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $('#simpan_rwgol').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan_rwgol').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id_rwgol').val();
        let skNomor = $('#skNomor_rwgol').val();
        let skTanggal = $('#skTanggal_rwgol').val();
        let pertekNomor = $('#pertekNomor_rwgol').val();
        let pertekTanggal = $('#pertekTanggal_rwgol').val();
        let tmt = $('#tmt_rwgol').val();
        let akUtama = $('#akUtama_rwgol').val();
        let akTambahan = $('#akTambahan_rwgol').val();
        let mkGolTahun = $('#mkGolTahun_rwgol').val();
        let mkGolBulan = $('#mkGolBulan_rwgol').val();
        let idOrang = $('#idOrang_rwgol').val();
        let idJeniskp = $('#idJeniskp_rwgol').val();
        let idGolongan = $('#idGolongan_rwgol').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwgolongan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                skNomor:skNomor,
                skTanggal:skTanggal,
                pertekNomor:pertekNomor,
                pertekTanggal:pertekTanggal,
                tmt:tmt,
                akUtama:akUtama,
                akTambahan:akTambahan,
                mkGolTahun:mkGolTahun,
                mkGolBulan:mkGolBulan,
                idOrang:idOrang,
                idJeniskp:idJeniskp,
                idGolongan:idGolongan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwgolongan').DataTable().ajax.reload(null, false);
                $('#simpan_rwgol').text('Save');
                $('#nip_baru_rwgol').attr('readonly', true);
                // $('#simpan_rwgol').attr('disabled', true);
                $('#tutup_rwgol').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click','.edit-gol', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwgolongan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru_rwgol').attr('readonly', true);
                $('#nip_baru_rwgol').val(response.nip_baru);
                $('#namalengkap_rwgol').val(response.namalengkap);
                $('#id_rwgol').val(response.id);
                $('#skNomor_rwgol').val(response.skNomor);
                $('#skTanggal_rwgol').val(response.skTanggal);
                $('#pertekNomor_rwgol').val(response.pertekNomor);
                $('#pertekTanggal_rwgol').val(response.pertekTanggal);
                $('#tmt_rwgol').val(response.tmt);
                $('#akUtama_rwgol').val(response.akUtama);
                $('#akTambahan_rwgol').val(response.akTambahan);
                $('#mkGolTahun_rwgol').val(response.mkGolTahun);
                $('#mkGolBulan_rwgol').val(response.mkGolBulan);
                $('#idOrang_rwgol').val(response.idOrang);
                $('#idJeniskp_rwgol').val(response.idJeniskp);
                $('#idGolongan_rwgol').val(response.idGolongan);
                $('#simpan_rwgol').text('Update');
                $('#model_title_gol').text("Edit Riwayat Golongan");
                $('#tambah_golongan').click();
            }
        });
    });

    $(document).on('click', '.hapus-gol', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwgolongan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwgolongan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $('#tutup_rwgol').click(function (e) {
        $('#simpan_rwgol').text('Save');
        $('#model_title_gol').text("Tambah Riwayat Golongan");
        $('#nip_baru_rwgol').attr('readonly', true);
        $('#skNomor_rwgol').val(null);
        $('#skTanggal_rwgol').val(null);
        $('#pertekNomor_rwgol').val(null);
        $('#pertekTanggal_rwgol').val(null);
        $('#tmt_rwgol').val(null);
        $('#akUtama_rwgol').val(null);
        $('#akTambahan_rwgol').val(null);
        $('#mkGolTahun_rwgol').val(null);
        $('#mkGolBulan_rwgol').val(null);
        $('#idJeniskp_rwgol').val(null);
        $('#idGolongan_rwgol').val(null);
    });

    $('#simpan_rwjab').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan_rwjab').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id_rwjab').val();
        let idOrang = $('#idOrang_rwjab').val();
        let idUnor = $('#idUnor_rwjab').val();
        let unitKerjaText = $('#unitKerjaText_rwjab').val();
        let idKategoriJabatan = $('#idKategoriJabatan_rwjab').val();
        let idJabatan = $('#idJabatan_rwjab').val();
        let idEselon = $('#idEselon_rwjab').val();
        let tmtJabatan = $('#tmtJabatan_rwjab').val();
        let skNomor = $('#skNomor_rwjab').val();
        let skTanggal = $('#skTanggal_rwjab').val();
        let idSatuanKerja = $('#idSatuanKerja_rwjab').val();
        let tmtPelantikan = $('#tmtPelantikan_rwjab').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwjabatan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                idOrang:idOrang,
                idUnor:idUnor,
                unitKerjaText:unitKerjaText,
                idKategoriJabatan:idKategoriJabatan,
                idJabatan:idJabatan,
                idEselon:idEselon,
                tmtJabatan:tmtJabatan,
                skNomor:skNomor,
                skTanggal:skTanggal,
                idSatuanKerja:idSatuanKerja,
                tmtPelantikan:tmtPelantikan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwjabatan').DataTable().ajax.reload(null, false);
                $('#simpan_rwjab').text('Save');
                $('#nip_baru_rwjab').attr('readonly', true);
                // $('#simpan_rwjab').attr('disabled', true);
                $('#tutup_rwjab').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus-jab', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwjabatan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwjabatan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-jab', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwjabatan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru_rwjab').attr('readonly', true);
                $('#nip_baru_rwjab').val(response.nip_baru);
                $('#namalengkap_rwjab').val(response.namalengkap);
                $('#id_rwjab').val(response.id);
                $('#idOrang_rwjab').val(response.idOrang);
                $('#idUnor_rwjab').val(response.idUnor);
                $('#unitKerjaText_rwjab').val(response.unitKerjaText);
                $('#idKategoriJabatan_rwjab').val(response.idKategoriJabatan);
                $('#idJabatan_rwjab').val(response.idJabatan);
                $('#namaJabatan_rwjab').val(response.namaJabatan);
                $('#idEselon_rwjab').val(response.idEselon);
                $('#tmtJabatan_rwjab').val(response.tmtJabatan);
                $('#skNomor_rwjab').val(response.skNomor);
                $('#skTanggal_rwjab').val(response.skTanggal);
                $('#idSatuanKerja_rwjab').val(response.idSatuanKerja);
                $('#satuanKerja_rwjab').val(response.namaSatuanKerja);
                $('#tmtPelantikan_rwjab').val(response.tmtPelantikan);
                $('#simpan_rwjab').text('Update');
                $('#model_title_jab').text("Edit Riwayat Jabatan");
                $('#tambah_jabatan').click();
            }
        });
    });

    $('#tutup_rwjab').click(function (e) {
        $('#simpan_rwjab').text('Save');
        $('#model_title_jab').text("Tambah Riwayat Jabatan");
        $('#nip_baru_rwjab').attr('readonly', true);
        // $('#id_rwjab').val(null);
        // $('#nip_baru_rwjab').val(null);
        // $('#namalengkap_rwjab').val(null);
        // $('#idOrang_rwjab').val(null);
        $('#idUnor_rwjab').val(null);
        $('#unitKerjaText_rwjab').val(null);
        $('#idKategoriJabatan_rwjab').val(null);
        $('#idJabatan_rwjab').val(null);
        $('#namaJabatan_rwjab').val(null);
        $('#idEselon_rwjab').val(null);
        $('#tmtJabatan_rwjab').val(null);
        $('#skNomor_rwjab').val(null);
        $('#skTanggal_rwjab').val(null);
        $('#idSatuanKerja_rwjab').val(null);
        $('#tmtPelantikan_rwjab').val(null);
    });

    $('#namaJabatan_rwjab').autocomplete({
        appendTo: "#modalriwayatjabatan",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariJabatan') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariJabatan: request.term,
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#namaJabatan_rwjab').val(ui.item.label);
            $('#idJabatan_rwjab').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#namaJabatan_rwjab" ).val( ui.item.label );
            return false;
         }
    });

    $('#satuanKerja_rwjab').autocomplete({
        appendTo: "#modalriwayatjabatan",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariSatuankerja') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariSatuankerja: request.term,
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#satuanKerja_rwjab').val(ui.item.label);
            $('#idSatuanKerja_rwjab').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#satuanKerja_rwjab" ).val( ui.item.label );
            return false;
         }
    });

    $('#simpan_rwdiklat').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan_rwdiklat').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id_rwdiklat').val();

        let jenis_diklat_id = $('#jenis_diklat_id').val();
        let diklat_nama = $('#diklat_nama').val();
        let diklatstruktural = $('#diklatstruktural').val();
        let latihan_struktural_id;
        if (jenis_diklat_id !== '1cdb79be-fdc0-45ce-bb13-cd1c1ad13c0c') {
            $('#diklatstruktural').val(null);
        } else {
            latihan_struktural_id = diklatstruktural;
        }

        let nomor_sertipikat = $('#nomor_sertipikat').val();
        let tanggal_sertipikat = $('#tanggal_sertipikat').val();
        let bobot_kompetensi = $('#bobot_kompetensi').val();
        let jenis_kompetensi = $('#jenis_kompetensi').val();
        let institusi_penyelenggara = $('#institusi_penyelenggara').val();
        let jumlah_jam = $('#jumlah_jam').val();
        let durasi_hari = $('#durasi_hari').val();
        let tanggal_mulai = $('#tanggal_mulai').val();
        let tanggal_selesai = $('#tanggal_selesai').val();
        let tahun = $('#tahun').val();
        let jenis_kursus_id = $('#jenis_kursus_id').val();
        let path = $('#path').val();
        let tipe = $('#tipe').val();
        let id_riwayat_update = $('#id_riwayat_update').val();
        let jenis_kursus_sertipikat = $('#jenis_kursus_sertipikat').val();
        let idOrang = $('#idOrang_rwdiklat').val();
        // let latihan_struktural_id = $('#latihan_struktural_id').val();
        let instansi_id = $('#instansi_id').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwdiklat') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                diklat_nama:diklat_nama,
                nomor_sertipikat:nomor_sertipikat,
                tanggal_sertipikat:tanggal_sertipikat,
                bobot_kompetensi:bobot_kompetensi,
                jenis_kompetensi:jenis_kompetensi,
                institusi_penyelenggara:institusi_penyelenggara,
                jumlah_jam:jumlah_jam,
                durasi_hari:durasi_hari,
                tanggal_mulai:tanggal_mulai,
                tanggal_selesai:tanggal_selesai,
                tahun:tahun,
                jenis_kursus_id:jenis_kursus_id,
                path:path,
                tipe:tipe,
                id_riwayat_update:id_riwayat_update,
                jenis_kursus_sertipikat:jenis_kursus_sertipikat,
                idOrang:idOrang,
                jenis_diklat_id:jenis_diklat_id,
                latihan_struktural_id:latihan_struktural_id,
                instansi_id:instansi_id,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwdiklat').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nip_baru_rwdiklat').attr('readonly', false);
                // $('#simpan_rwdiklat').attr('disabled', true);
                $('#tutup_rwdiklat').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus-diklat', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwdiklat') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwdiklat').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-diklat', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwdiklat') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru_rwdiklat').attr('readonly', true);
                $('#nip_baru_rwdiklat').val(response.nip_baru);
                $('#namalengkap_rwdiklat').val(response.namalengkap);
                $('#id_rwdiklat').val(response.id);
                $('#diklat_nama').val(response.diklat_nama);
                $('#nomor_sertipikat').val(response.nomor_sertipikat);
                $('#tanggal_sertipikat').val(response.tanggal_sertipikat);
                $('#bobot_kompetensi').val(response.bobot_kompetensi);
                $('#jenis_kompetensi').val(response.jenis_kompetensi);
                $('#institusi_penyelenggara').val(response.institusi_penyelenggara);
                $('#jumlah_jam').val(response.jumlah_jam);
                $('#durasi_hari').val(response.durasi_hari);
                $('#tanggal_mulai').val(response.tanggal_mulai);
                $('#tanggal_selesai').val(response.tanggal_selesai);
                $('#tahun').val(response.tahun);
                $('#jenis_kursus_id').val(response.jenis_kursus_id);
                $('#path').val(response.path);
                $('#tipe').val(response.tipe);
                $('#id_riwayat_update').val(response.id_riwayat_update);
                $('#jenis_kursus_sertipikat').val(response.jenis_kursus_sertipikat);
                $('#idOrang_rwdiklat').val(response.idOrang);
                $('#jenis_diklat_id').val(response.jenis_diklat_id);
                setDiklat(response.jenis_diklat_id);
                $('#diklatstruktural').val(response.latihan_struktural_id);
                $('#instansi_id').val(response.instansi_id);
                $('#satuanKerja_rwdiklat').val(response.namaSatuanKerja);
                $('#simpan_rwdiklat').text('Update');
                $('#model_title_diklat').text("Edit Riwayat Pelatihan");
                $('#tambah_diklat').click();
            }
        });
    });

    $('#tutup_rwdiklat').click(function (e) {
        $('#simpan_rwdiklat').text('Save');
        $('#model_title_diklat').text("Tambah Riwayat Pelatihan");
        // $('#simpan_rwdiklat').attr('disabled', true);
        $('#nip_baru_rwdiklat').attr('readonly', false);
        $('#nip_baru_rwdiklat').val(null);
        $('#namalengkap').val(null);
        $('#diklat_nama').val(null);
        $('#nomor_sertipikat').val(null);
        $('#tanggal_sertipikat').val(null);
        $('#bobot_kompetensi').val(null);
        $('#jenis_kompetensi').val(null);
        $('#institusi_penyelenggara').val(null);
        $('#jumlah_jam').val(null);
        $('#durasi_hari').val(null);
        $('#tanggal_mulai').val(null);
        $('#tanggal_selesai').val(null);
        $('#tahun').val(null);
        // $('#jenis_kursus_id').val(null);
        // $('#path').val(null);
        // $('#tipe').val(null);
        // $('#id_riwayat_update').val(null);
        // $('#jenis_kursus_sertipikat').val(null);
        $('#idOrang_rwdiklat').val(null);
        $('#jenis_diklat_id').val(null);
        $('#diklatstruktural').val(null);
        $('#instansi_id').val(null);
        $('#satuanKerja_rwdiklat').val(null);
    });

    $('#satuanKerja_rwdiklat').autocomplete({
        appendTo: "#modalriwayatdiklat",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariSatuankerja') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariSatuankerja: request.term,
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#satuanKerja_rwdiklat').val(ui.item.label);
            $('#instansi_id').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#satuanKerja_rwdiklat" ).val( ui.item.label );
            return false;
         }
    });

    $('#jenis_diklat_id').change(function (e) {
        e.preventDefault();
        // Jika jenis diklat struktural
        setDiklat($(this).val());
    });

    function setDiklat(jenis) {
        if (jenis == '1cdb79be-fdc0-45ce-bb13-cd1c1ad13c0c') {
            // $('#namadiklat1').hide();
            $('#namadiklat2').show();
        } else {
            // $('#namadiklat1').show();
            $('#namadiklat2').hide();
        }
    }

    $('#simpan_rwpendidikan').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan_rwpendidikan').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id_rwpendidikan').val();
        let tglLulus = $('#tglLulus_rwpendidikan').val();
        let thnLulus = $('#thnLulus_rwpendidikan').val();
        let noIjazah = $('#noIjazah_rwpendidikan').val();
        let namaSekolah = $('#namaSekolah_rwpendidikan').val();
        let lokasi = $('#lokasi_rwpendidikan').val();
        let glrDepan = $('#glrDepan_rwpendidikan').val();
        let glrBelakang = $('#glrBelakang_rwpendidikan').val();
        let pendAwal = $('#pendAwal_rwpendidikan').val();
        let idOrang = $('#idOrang_rwpendidikan').val();
        let idPendidikan = $('#idPendidikan_rwpendidikan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwpendidikan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                tglLulus:tglLulus,
                thnLulus:thnLulus,
                noIjazah:noIjazah,
                namaSekolah:namaSekolah,
                lokasi:lokasi,
                glrDepan:glrDepan,
                glrBelakang:glrBelakang,
                pendAwal:pendAwal,
                idOrang:idOrang,
                idPendidikan:idPendidikan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwpendidikan').DataTable().ajax.reload(null, false);
                $('#simpan_rwpendidikan').text('Save');
                $('#nip_baru_rwpendidikan').attr('readonly', false);
                // $('#simpan_rwpendidikan').attr('disabled', true);
                $('#tutup_rwpendidikan').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus-pendidikan', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwpendidikan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwpendidikan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-pendidikan', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwpendidikan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru_rwpendidikan').attr('readonly', true);
                $('#nip_baru_rwpendidikan').val(response.nip_baru);
                $('#namalengkap_rwpendidikan').val(response.namalengkap);
                $('#idOrang_rwpendidikan').val(response.idOrang);
                $('#id_rwpendidikan').val(response.id);
                $('#tglLulus_rwpendidikan').val(response.tglLulus);
                $('#thnLulus_rwpendidikan').val(response.thnLulus);
                $('#noIjazah_rwpendidikan').val(response.noIjazah);
                $('#namaSekolah_rwpendidikan').val(response.namaSekolah);
                $('#lokasi_rwpendidikan').val(response.lokasi);
                $('#glrDepan_rwpendidikan').val(response.glrDepan);
                $('#glrBelakang_rwpendidikan').val(response.glrBelakang);
                $('#pendAwal_rwpendidikan').val(response.pendAwal);
                $('#idPendidikan_rwpendidikan').val(response.idPendidikan);
                $('#idtktPendidikan_rwpendidikan').val(response.tktPendidikan);
                $('#cariPendidikan_rwpendidikan').val(response.namaPendidikan);
                $('#simpan_rwpendidikan').text('Update');
                $('#model_title_pendidikan').text("Edit Riwayat Pendidikan");
                $('#tambah_pendidikan').click();
            }
        });
    });

    $('#tutup_rwpendidikan').click(function (e) {
        $('#simpan_rwpendidikan').text('Save');
        $('#model_title_pendidikan').text("Tambah Riwayat Pendidikan");
        $('#nip_baru_rwpendidikan').attr('readonly', true);
        // $('#nip_baru_rwpendidikan').val(null);
        // $('#namalengkap_rwpendidikan').val(null);
        // $('#idOrang_rwpendidikan').val(null);
        $('#tglLulus_rwpendidikan').val(null);
        $('#thnLulus_rwpendidikan').val(null);
        $('#noIjazah_rwpendidikan').val(null);
        $('#namaSekolah_rwpendidikan').val(null);
        $('#lokasi_rwpendidikan').val(null);
        $('#glrDepan_rwpendidikan').val(null);
        $('#glrBelakang_rwpendidikan').val(null);
        $('#pendAwal_rwpendidikan').val(null);
        $('#idPendidikan_rwpendidikan').val(null);
        $('#idtktPendidikan_rwpendidikan').val(null);
        $('#cariPendidikan_rwpendidikan').val(null);
    });

    $('#tglLulus_rwpendidikan').blur(function (e) {
        e.preventDefault();
        let tglLulus = $(this).val();
        thnLulus = tglLulus.substr(0,4);
        $('#thnLulus_rwpendidikan').val(thnLulus);
    });

    $('#cariPendidikan_rwpendidikan').autocomplete({
        appendTo: "#modalriwayatpendidikan",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariPendidikan') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariPendidikan: request.term,
                    kodeTKT: $('#idtktPendidikan_rwpendidikan').val()
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#cariPendidikan_rwpendidikan').val(ui.item.label);
            $('#idPendidikan_rwpendidikan').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#cariPendidikan_rwpendidikan" ).val( ui.item.label );
            return false;
         }
    });

    $('#simpan_rwhukdis').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan_rwhukdis').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id_rwhukdis').val();
        let skNomor = $('#skNomor_rwhukdis').val();
        let skTanggal = $('#skTanggal_rwhukdis').val();
        let tglMulai = $('#tglMulai_rwhukdis').val();
        let tglAkhir = $('#tglAkhir_rwhukdis').val();
        let masaTahun = $('#masaTahun_rwhukdis').val();
        let masaBulan = $('#masaBulan_rwhukdis').val();
        let ppNomor = $('#ppNomor_rwhukdis').val();
        let skPembatalan = $('#skPembatalan_rwhukdis').val();
        let tglSkbatal = $('#tglSkbatal_rwhukdis').val();
        let idOrang = $('#idOrang_rwhukdis').val();
        let idHukdis = $('#idHukdis_rwhukdis').val();
        let idGolongan = $('#idGolongan_rwhukdis').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwhukdisiplin') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                skNomor:skNomor,
                skTanggal:skTanggal,
                tglMulai:tglMulai,
                tglAkhir:tglAkhir,
                masaTahun:masaTahun,
                masaBulan:masaBulan,
                ppNomor:ppNomor,
                skPembatalan:skPembatalan,
                tglSkbatal:tglSkbatal,
                idOrang:idOrang,
                idHukdis:idHukdis,
                idGolongan:idGolongan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwhukdisiplin').DataTable().ajax.reload(null, false);
                $('#simpan_rwhukdis').text('Save');
                $('#nip_baru_rwhukdis').attr('readonly', false);
                // $('#simpan_rwhukdis').attr('disabled', true);
                $('#tutup_rwhukdis').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus-hukdis', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwhukdisiplin') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwhukdisiplin').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-hukdis', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwhukdisiplin') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru_rwhukdis').attr('readonly', true);
                $('#nip_baru_rwhukdis').val(response.nip_baru);
                $('#namalengkap_rwhukdis').val(response.namalengkap);
                $('#idOrang_rwhukdis').val(response.idOrang);
                $('#id_rwhukdis').val(response.id);
                $('#skNomor_rwhukdis').val(response.skNomor);
                $('#skTanggal_rwhukdis').val(response.skTanggal);
                $('#tglMulai_rwhukdis').val(response.tglMulai);
                $('#tglAkhir_rwhukdis').val(response.tglAkhir);
                $('#masaTahun_rwhukdis').val(response.masaTahun);
                $('#masaBulan_rwhukdis').val(response.masaBulan);
                $('#ppNomor_rwhukdis').val(response.ppNomor);
                $('#skPembatalan_rwhukdis').val(response.skPembatalan);
                $('#tglSkbatal_rwhukdis').val(response.tglSkbatal);
                $('#idHukdis_rwhukdis').val(response.idHukdis);
                $('#idGolongan_rwhukdis').val(response.idGolongan);
                $('#simpan_rwhukdis').text('Update');
                $('#model_title_hukdis').text("Edit Riwayat Hukuman Disiplin");
                $('#tambah_hukdis').click();
            }
        });
    });

    $('#tutup_rwhukdis').click(function (e) {
        $('#simpan_rwhukdis').text('Save');
        $('#model_title_hukdis').text("Tambah Riwayat Hukuman Disiplin");
        $('#nip_baru_rwhukdis').attr('readonly', false);
        // $('#simpan_rwhukdis').attr('disabled', true);
        // $('#nip_baru_rwhukdis').val(null);
        // $('#idOrang_rwhukdis').val(null);
        // $('#namalengkap_rwhukdis').val(null);
        $('#skNomor_rwhukdis').val(null);
        $('#skTanggal_rwhukdis').val(null);
        $('#tglMulai_rwhukdis').val(null);
        $('#tglAkhir_rwhukdis').val(null);
        $('#masaTahun_rwhukdis').val(null);
        $('#masaBulan_rwhukdis').val(null);
        $('#ppNomor_rwhukdis').val(null);
        $('#skPembatalan_rwhukdis').val(null);
        $('#tglSkbatal_rwhukdis').val(null);
        $('#idHukdis_rwhukdis').val(null);
        $('#idGolongan_rwhukdis').val(null);
    });
</script>
