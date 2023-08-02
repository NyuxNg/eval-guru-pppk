<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('THL 2023') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cari_status">Status</label>
                            <select class="form-control" name="cari_status" id="cari_status">
                                <option selected value="all">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                                <option value="pindahan">Pindahan</option>
                                <option value="baru">Baru</option>
                                <option value="no-status">Tanpa Status</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="cari_upt">Penempatan</label>
                            <select class="form-control" name="cari_upt" id="cari_upt">
                                <option selected value="all">Semua Unit</option>
                                        @foreach ($upt as $pd)
                                        <option value="{{ $pd->uptkelurahan }}">{{ $pd->uptkelurahan}}</option>
                                        @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="cari_thl">Nama Tenaga Harian Lepas</label>
                            <input type="text" class="form-control form-control-xs" name="cari_thl" id="cari_thl"
                                placeholder="masukkan nama yang dicari?">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">

                <div class="row">
                    <div class="col-md-1">
                        {{-- <div class="form-group"> --}}
                            <select class="custom-select" name="jumlahView" id="jumlahView">
                                <option value="10">10</option>
                                <option selected value="100">100</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option value="All">All</option>
                            </select>
                        {{-- </div> --}}
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
        <div class="card card-danger">
            <div class="card-header">
                Data Usul THL 2023 Dinas Kesehatan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="Thl2023" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Status</th>
                            <th>Id Presensi</th>
                            <th>Nama</th>
                            <th>Pendidikan</th>
                            <th>Penempatan</th>
                            <th>Jabatan</th>
                            <th>Honor APBD</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Data THL 2023
                </button>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah Usul THL 2023</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label for="nomorUrut">Nomor Urut</label>
                                <input type="text" name="nomorUrut" id="nomorUrut" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="namaLengkap">Nama Lengkap</label>
                                <input type="text" name="namaLengkap" id="namaLengkap" value="-" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idPresensi">ID Presensi</label>
                                <input type="text" name="idPresensi" id="idPresensi" value="-" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lahirTempat">Tempat Lahir</label>
                                <input type="text" name="lahirTempat" id="lahirTempat" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lahirTanggal">Tanggal Lahir</label>
                                <input type="text" name="lahirTanggal" id="lahirTanggal" value="-" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenisKelamin">Jenis Kelamin</label>
                                <select class="form-control" name="jenisKelamin" id="jenisKelamin">
                                    <option selected value="L">Pria</option>
                                    <option value="P">Wanita</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="idPerangkatDaerah" id="idPerangkatDaerah">
                                <label for="cariPerangkatDaerah">Perangkat Daerah</label>
                                <input type="text" name="cariPerangkatDaerah" id="cariPerangkatDaerah" class="form-control"
                                    placeholder="Perangkat Daerah">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="uptkelurahan">Penempatan</label>
                                <input type="text" name="uptkelurahan" id="uptkelurahan" class="form-control"
                                    placeholder="Unit Penempatan">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="pendidikanJurusan">Jurusan Pendidikan</label>
                              <input type="text"
                                class="form-control" name="pendidikanJurusan" id="pendidikanJurusan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendidikanLulus">Lulus Pendidikan</label>
                                <input type="text"
                                  class="form-control" name="pendidikanLulus" id="pendidikanLulus">
                              </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="jabatan">Jabatan</label>
                              <input type="text"
                                class="form-control" name="jabatan" id="jabatan">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="honor">Honor</label>
                                <input type="text"
                                  class="form-control" name="honor" id="honor">
                              </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option selected value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                    <option value="pindahan">Pindahan</option>
                                    <option value="baru">Baru</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="masukTahun">Tahun Masuk</label>
                              <input type="text"
                                class="form-control" name="masukTahun" id="masukTahun">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="masakerjaTahun">Masa Kerja (Tahun)</label>
                                <input type="text"
                                  class="form-control" name="masakerjaTahun" id="masakerjaTahun">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="masakerjaBulan">Masa Kerja (Bulan)</label>
                                <input type="text"
                                  class="form-control" name="masakerjaBulan" id="masakerjaBulan">
                              </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="uraianTugas">Uraian Tugas</label>
                      <textarea class="form-control" name="uraianTugas" id="uraianTugas" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="keterangan" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<!-- Button trigger modal -->

    <div class="modal fade" id="modalPresensi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Data Presensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="presensi_nama">Nama THL</label>
                                    <input readonly type="text" class="form-control" name="presensi_nama" id="presensi_nama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="presensi_pendidikan">Pendidikan</label>
                                    <input readonly type="text" class="form-control" name="presensi_pendidikan" id="presensi_pendidikan">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="presensi_unitkerja">Unit Kerja</label>
                                    <input readonly type="text" class="form-control" name="presensi_unitkerja" id="presensi_unitkerja">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="presensi_jabatan">Jabatan</label>
                                    <input readonly type="text" class="form-control" name="presensi_jabatan" id="presensi_jabatan">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table id="tabelPresensi" class="table table-bordered table-inverse table-xs">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>ID THL</th>
                                    <th>Status</th>
                                    <th>Nama</th>
                                    <th>Unit Kerja</th>
                                    <th>GrandTotal</th>
                                    {{-- <th>Set ID</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modelDetailPresensi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Lihat Presensi</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="detail_idTHL">ID THL</label>
                                <input readonly type="text" name="detail_idTHL" id="detail_idTHL" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="detail_nama">Nama</label>
                                <input readonly type="text" name="detail_nama" id="detail_nama" value="-" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail_perangkatDaerah">Perangkat Daerah</label>
                        <input readonly type="text" name="detail_perangkatDaerah" id="detail_perangkatDaerah" value="-" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_Juli">Juli 2022</label>
                              <input readonly type="text" name="detail_Juli" id="detail_Juli" value="-" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_Agustus">Agustus 2022</label>
                              <input readonly type="text" name="detail_Agustus" id="detail_Agustus" value="-" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_September">September 2022</label>
                              <input readonly type="text" name="detail_September" id="detail_September" value="-" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_Oktober">Oktober 2022</label>
                              <input readonly type="text" name="detail_Oktober" id="detail_Oktober" value="-" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_November">November 2022</label>
                              <input readonly type="text" name="detail_November" id="detail_November" value="-" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_Desember">Desember 2022</label>
                              <input readonly type="text" name="detail_Desember" id="detail_Desember" value="-" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_GrandTotal">Grand Total</label>
                              <input readonly type="text"
                                class="form-control" name="detail_GrandTotal" id="detail_GrandTotal">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="detail_status">Status</label>
                              <input readonly type="text" name="detail_status" id="detail_status" value="-" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="detail_tutup" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
@stack('js')
{{-- <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script> --}}

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#kotakStatus').show();
    });

    function loadDataPresensi(cari_thl) {
        $('#tabelPresensi').DataTable({
            serverside: true,
            lengthMenu: [
                [10, 50, 100, -1],
                ['10 Baris', '50 Baris', '100 Baris', 'Semua'],
            ],
            processing: true,
            orderClasses: false,
            deferRender: true,
            paging: true,
            select: true,
            stateSave: true,
            bDestroy: true,
            // dom: '<lfp<t>fp>',
            dom: 'Bfrtip',
            // dom: '<"wrapper"Bpt>',
            buttons: [ 'copy', 'excel', 'pdf' ],
            ajax: {
                // type: "post",
                url: "{{ route('dataPresensi') }}",
                data: {
                    cari_thl:cari_thl,
                    cari_upt: 'all',
                    cari_Juli: 'all',
                    cari_Agustus: 'all',
                    cari_September: 'all',
                    cari_Oktober: 'all',
                    cari_November: 'all',
                    cari_Desember: 'all',
                    jumlahView:'All',
                    },
                },

            columns: [
                {
                data: 'idTHL',
                name: 'idTHL'
                },
                {
                data: 'status',
                name: 'status'
                },
                {
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'perangkatDaerah',
                name: 'perangkatDaerah'
                },
                {
                data: 'presensiGrandTotal',
                name: 'presensiGrandTotal',
                },
                // {
                // data: 'aksi',
                // name: 'aksi',
                // orderable: false,
                // width:'130px',
                // },
            ],
            rowCallback: function (row, data) {
                if ( data.status == "AMAN" ) {
                    $(row).addClass('bg-success');
                } else {
                    $(row).addClass('bg-danger');
                }

            }
        });
    }

    function loadDataTHL2023(id) {
        $.ajax({
            type: "get",
            url: "{{ route('editThl2023') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#presensi_nama').val(response.namaLengkap)
                $('#presensi_pendidikan').val(response.pendidikanJurusan)
                $('#presensi_unitkerja').val(response.cariPerangkatDaerah)
                $('#presensi_jabatan').val(response.jabatan);
                loadDataPresensi(response.namaLengkap);
            }
        });
    }

    function loadDataStatus(idPerangkatDaerah, cari_upt) {
        $.ajax({
            type: "get",
            url: "{{ route('statusThl2023') }}",
            data: {
                idPerangkatDaerah:'4867ae3d',
                cari_upt:cari_upt,
            },
            success: function (response) {
                console.log(response)
                $('#status_aktif').text(response.status_aktif);
                $('#status_tidakaktif').text(response.status_tidakaktif);
                $('#status_pindah').text(response.status_pindah);
                $('#status_baru').text(response.status_baru);
                $('#status_null').text(response.status_null);
            }
        });
    }

    $(document).on('click', '.presensi', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        loadDataTHL2023(id);
    });

    function loadData(cari_upt, cari_thl,cari_status) {
        let jumlahView = $('#jumlahView').val();
        $('#Thl2023').DataTable({
        serverside: true,
        processing: true,
        searching: true,
        order: [
            [2, 'asc'],
        ],
        lengthMenu: [
            [5, 10, 50, 100, -1],
            ['5 Baris', '10 Baris', '50 Baris', '100 Baris', 'Semua'],
        ],
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        // dom: '<lfp<t>fp>',
        dom: '<"wrapper"Bfliptp>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            // type: "post",
            url: "{{ route('dataThl2023dinkescamat') }}",
            data: {
                cari_upt: cari_upt,
                cari_thl:cari_thl,
                cari_status:cari_status,
                jumlahView:jumlahView,
                },
            },

        columns: [
            {
            data: 'status',
            name: 'status',
            width:'170px',
            orderable: false,
            searchable: false,
            },
            {
            data: 'idPresensi',
            name: 'idPresensi',
            orderable: false,
            },
            {
            data: 'namaLengkap',
            name: 'namaLengkap'
            },
            {
            data: 'pendidikanJurusan',
            name: 'pendidikanJurusan',
            orderable: false,
            searchable: false,
            },
            {
            data: 'uptkelurahan',
            name: 'uptkelurahan',
            },
            {
            data: 'jabatan',
            name: 'jabatan',
            },
            {
            data: 'honor',
            name: 'honor',
            orderable: false,
            },
            {
            data: 'keterangan',
            name: 'keterangan',
            },

            {
            data: 'aksi',
            name: 'aksi',
            orderable: false,
            width:'130px',
            },
        ],
        rowCallback: function (row, data) {
            // if ( data.status != "aktif" ) {
            //     $(row).addClass('bg-secondary');
            // }

        }
    });
    }

    $('#simpan').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id').val();
        let nomorUrut = $('#nomorUrut').val();
        let nik = $('#nik').val();
        let idPresensi = $('#idPresensi').val();
        let namaLengkap = $('#namaLengkap').val();
        let lahirTempat = $('#lahirTempat').val();
        let lahirTanggal = $('#lahirTanggal').val();
        let jenisKelamin = $('#jenisKelamin').val();
        let pendidikanJurusan = $('#pendidikanJurusan').val();
        let pendidikanLulus = $('#pendidikanLulus').val();
        let jabatan = $('#jabatan').val();
        let uraianTugas = $('#uraianTugas').val();
        let honor = $('#honor').val();
        let masukTahun = $('#masukTahun').val();
        let masakerjaTahun = $('#masakerjaTahun').val();
        let masakerjaBulan = $('#masakerjaBulan').val();
        let keterangan = $('#keterangan').val();
        let status = $('#status').val();
        let idPerangkatDaerah = $('#idPerangkatDaerah').val();
        let uptkelurahan = $('#uptkelurahan').val();

        $.ajax({
            type: "post",
            url: "{{ route('simpanThl2023') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                nomorUrut:nomorUrut,
                nik:nik,
                idPresensi:idPresensi,
                namaLengkap:namaLengkap,
                lahirTempat:lahirTempat,
                lahirTanggal:lahirTanggal,
                jenisKelamin:jenisKelamin,
                pendidikanJurusan:pendidikanJurusan,
                pendidikanLulus:pendidikanLulus,
                jabatan:jabatan,
                uraianTugas:uraianTugas,
                honor:honor,
                masukTahun:masukTahun,
                masakerjaTahun:masakerjaTahun,
                masakerjaBulan:masakerjaBulan,
                keterangan:keterangan,
                status:status,
                idPerangkatDaerah:idPerangkatDaerah,
                uptkelurahan:uptkelurahan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan');
                $('#Thl2023').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nomorUrut').attr('readonly', false);
                // $('#simpan').attr('disabled', true);
                $('#tutup').click();
                loadDataStatus(idPerangkatDaerah, uptkelurahan);

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusThl2023') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#Thl2023').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editThl2023') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nomorUrut').attr('readonly', true);
                $('#id').val(response.id);

                $('#nomorUrut').val(response.nomorUrut);
                $('#nik').val(response.nik);
                $('#idPresensi').val(response.idPresensi);
                $('#namaLengkap').val(response.namaLengkap);
                $('#lahirTempat').val(response.lahirTempat);
                $('#lahirTanggal').val(response.lahirTanggal);
                $('#jenisKelamin').val(response.jenisKelamin);
                $('#pendidikanJurusan').val(response.pendidikanJurusan);
                $('#pendidikanLulus').val(response.pendidikanLulus);
                $('#jabatan').val(response.jabatan);
                $('#uraianTugas').val(response.uraianTugas);
                $('#honor').val(response.honor);
                $('#masukTahun').val(response.masukTahun);
                $('#masakerjaTahun').val(response.masakerjaTahun);
                $('#masakerjaBulan').val(response.masakerjaBulan);
                $('#keterangan').val(response.keterangan);
                $('#status').val(response.status);
                $('#idPerangkatDaerah').val(response.idPerangkatDaerah);
                $('#cariPerangkatDaerah').val(response.cariPerangkatDaerah);
                $('#uptkelurahan').val(response.uptkelurahan);

                $('#simpan').text('Update');
                // $('#simpan').attr('disabled', false);
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        // $('#simpan').attr('disabled', true);
        $('#nomorUrut').attr('readonly', false);
        $('#nomorUrut').val(null);
        $('#nik').val(null);
        $('#idPresensi').val(null);
        $('#namaLengkap').val(null);
        $('#lahirTempat').val(null);
        $('#lahirTanggal').val(null);
        $('#jenisKelamin').val(null);
        $('#pendidikanJurusan').val(null);
        $('#pendidikanLulus').val(null);
        $('#jabatan').val(null);
        $('#uraianTugas').val(null);
        $('#honor').val(null);
        $('#masukTahun').val(null);
        $('#masakerjaTahun').val(null);
        $('#masakerjaBulan').val(null);
        $('#keterangan').val(null);
        $('#status').val(null);
        $('#idPerangkatDaerah').val(null);
        $('#cariPerangkatDaerah').val(null);
        $('#uptkelurahan').val(null);
    });


    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_upt = $('#cari_upt').val();
        let cari_thl = $('#cari_thl').val();
        let cari_status = $('#cari_status').val();

        loadDataStatus(null, cari_upt);
        loadData(cari_upt,cari_thl, cari_status);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_upt').val("all");
        $('#cari_thl').val(null);
        $('#cari_status').val("all");
    });

    $('#cariPerangkatDaerah').autocomplete({
        appendTo: "#modelId",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariPerangkatdaerah') }}",
                data: {
                    cariPerangkatDaerah: request.term,
                    // kodeTKT: $('#idtktPendidikan').val()
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#cariPerangkatDaerah').val(ui.item.label);
            $('#idPerangkatDaerah').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#cariPerangkatDaerah" ).val( ui.item.label );
            return false;
         }
    });

    $(document).on('click','.edit-status', function () {
        let id = $(this).attr('id');
        let cari_upt = $('#cari_upt').val();
        $.ajax({
            type: "get",
            url: "{{ route('editStatusThl2023') }}",
            data: {
                id:id,
            },
            success: function (response) {
                toastr.success(response.text, 'Sukses');
                loadDataStatus(null, cari_upt);
                console.log(response);
                $('#Thl2023').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.lihat-presensi', function () {
        let idTHL = $(this).text();
        $.ajax({
            type: "get",
            url: "{{ route('editPresensi') }}",
            data: {
                idTHL:idTHL,
            },
            success: function (response) {
                $('#detail_idTHL').val(response.idTHL);
                $('#detail_nama').val(response.nama);
                $('#detail_perangkatDaerah').val(response.perangkatDaerah);
                $('#detail_Juli').val(response.presensiJuli);
                $('#detail_Agustus').val(response.presensiAgustus);
                $('#detail_September').val(response.presensiSeptember);
                $('#detail_Oktober').val(response.presensiOktober);
                $('#detail_November').val(response.presensiNovember);
                $('#detail_Desember').val(response.presensiDesember);
                $('#detail_GrandTotal').val(response.presensiGrandTotal);
                $('#detail_status').val(response.status);
            }
        });
    });

</script>
