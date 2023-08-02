<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Pegawai Negeri Sipil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_nip_baru">NIP Baru</label>
                            <input type="text" class="form-control form-control-xs" name="cari_nip_baru"
                                id="cari_nip_baru" placeholder="Masukkan NIP yang dicari">
                        </div>
                        <div class="form-group">
                            <label for="carinama">Nama</label>
                            <input type="text" class="form-control" name="carinama" id="carinama"
                                placeholder="Masukkan nama yang dicari">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cari_idJeniskp">Jenis Kepegawaian</label>
                            <select class="form-control" name="cari_idJeniskp" id="cari_idJeniskp">
                                <option selected value="">Semua jenis Kepegawaian</option>
                                @foreach ($jenispegawai as $jp)
                                <option value="{{ $jp->id }}">{{ $jp->kode . ' - ' . $jp->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cari_unorInduk">Unit Organisasi</label>
                            <select class="form-control" name="cari_unorInduk" id="cari_unorInduk">
                                <option selected value="">Semua jenis Kepegawaian</option>
                                @foreach ($jenispegawai as $jp)
                                <option value="{{ $jp->id }}">{{ $jp->kode . ' - ' . $jp->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_golAwal">Golongan Awal</label>
                            <select class="form-control" name="cari_golAwal" id="cari_golAwal">
                                <option selected value=""></option>
                                @foreach ($golongan as $gol)
                                <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cari_golAkhir">Golongan Akhir</label>
                            <select class="form-control" name="cari_golAkhir" id="cari_golAkhir">
                                <option selected value=""></option>
                                @foreach ($golongan as $gol)
                                <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
        <div class="card-footer text-muted">

            <div class="row">
                <div class="col-md-1">
                    {{-- <div class="form-group"> --}}
                        <select class="custom-select" name="jumlahView" id="jumlahView">
                            <option>Pilih</option>
                            <option selected value="10">10</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="All">All</option>
                        </select>
                        {{--
                    </div> --}}
                </div>
                <div class="col-md-1"><button id="cari" type="button" class="btn btn-primary btn-md"
                        style="display: block; width: 100%;">
                        <i class="fa fa-search" aria-hidden="true"></i> Cari
                    </button>
                </div>
                <div class="col-md-1"><button id="reset" type="button" class="btn btn-secondary btn-md"
                        style="display: block; width: 100%;">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-success">
        <div class="card-header">
            Daftar Pegawai Negeri Sipil
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="tabelPegawaipns" class="table table-bordered table-inverse table-xs">
                <thead class="thead-inverse">
                    <tr>
                        <th>NIP Baru</th>
                        <th>Nama</th>
                        <th>Jenis Pegawai</th>
                        <th>Golongan</th>
                        <th>Jenjang Studi</th>
                        <th>Jurusan</th>
                        <th>TMT Jabatan</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                Tambah PNS
            </button>
        </div>
    </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title"><strong>Tambah/Update PNS</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip_baru">NIP Baru</label>
                                <input type="text" name="nip_baru" id="nip_baru" class="form-control"
                                    placeholder="Masukkan Nip Baru">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="nip_lama">NIP Lama</label>
                                <input type="text" name="nip_lama" id="nip_lama" value="-" class="form-control"
                                    placeholder="Masukkan Nip Lama">
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
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
                    <button type="button" id="simpan" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stack('js')

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        // loadData();
        $('.datetimepicker-input').datetimepicker({
            locale: 'id',
            format: 'L',
            viewMode: 'months',
            format: 'YYYY-MM-DD'
        });
    });

    function loadData(cari_nip_baru, carinama, cari_idJeniskp, cari_golAwal, cari_golAkhir) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelPegawaipns').DataTable({
        serverside: true,
        processing: true,
        bDestroy: true,
        dom: '<lf<t>ip>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            url: "{{ route('datapegawai') }}",
            data: {
                    nip_baru: cari_nip_baru,
                    carinama:carinama,
                    cari_idJeniskp:cari_idJeniskp,
                    cari_golAwal:cari_golAwal,
                    cari_golAkhir:cari_golAkhir,
                    jumlahView:jumlahView,
                },
            },
            columns: [{
            data: 'nip_baru',
            name: 'nip_baru'
            },
            {
            data: 'nama',
            name: 'nama'
            },

            {
            data: 'jenis_pegawai_id',
            name: 'jenis_pegawai_id'
            },
            {
            data: 'kodeakhir',
            name: 'kodeakhir'
            },
            {
            data: 'tktAkhir',
            name: 'tktAkhir'
            },
            {
            data: 'jurusan',
            name: 'jurusan'
            },
            {
            data: 'max_tmtJabatan',
            name: 'max_tmtJabatan'
            },
            {
            data: 'jabatan',
            name: 'jabatan'
            },
            {
            data: 'unitKerja',
            name: 'unitKerja'
            },
            {
            data: 'aksi',
            name: 'aksi',
            orderable: false,
            width: '130px',
            },
            ]
            })
    }


    $('#simpan').click(function (e) {
        e.preventDefault();
        let nip_baru = $('#nip_baru').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let nip_lama = $('#nip_lama').val();
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
                nip_lama:nip_lama,
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
                $('#tabelPegawaipns').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nip_baru').attr('readonly', false);
                $('#tutup').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus', function(event) {
        let nip_baru = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusPegawaipns') }}",
            data: {
                nip_baru: nip_baru,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelPegawaipns').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editPegawaipns') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru').val(response.nip_baru);
                $('#nip_baru').attr('readonly', true);
                $('#nip_lama').val(response.nip_lama);
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
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#nip_baru').val(null);
        $('#nip_baru').attr('readonly', false);
        $('#nip_lama').val(null);
        $('#nama').val(null);
        $('#gelar_depan').val(null);
        $('#gelar_blk').val(null);
        $('#tempat_lahir_nama').val(null);
        $('#tgl_lahir').val(null);
        $('#jenis_kelamin').val(null);
        $('#nik').val(null);
        $('#nomor_hp').val(null);
        $('#email').val(null);
        $('#alamat').val(null);
        $('#npwp_nomor').val(null);
        $('#bpjs').val(null);
        $('#kartu_pegawai').val(null);
        $('#agama_id').val(null);
        $('#status_nikah_id').val(null);
        $('#jenis_pegawai_id').val(null);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_nip_baru = $('#cari_nip_baru').val();
        let carinama = $('#carinama').val();
        let cari_idJeniskp = $('#cari_idJeniskp').val();
        let cari_golAwal = $('#cari_golAwal').val();
        let cari_golAkhir = $('#cari_golAkhir').val();
        loadData(cari_nip_baru, carinama, cari_idJeniskp, cari_golAwal, cari_golAkhir);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nip_baru').val(null);
        $('#carinama').val(null);
        $('#cari_idJeniskp').val(null);
        $('#cari_golAwal').val(null);
        $('#cari_golAkhir').val(null);
    });

</script>
