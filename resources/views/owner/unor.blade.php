<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit Organisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_nama">Nama</label>
                            <input type="text" class="form-control" name="cari_nama" id="cari_nama"
                                placeholder="Masukkan nama yang dicari">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_jenisUnor">Jenis Unit Organisasi</label>
                            <select class="form-control" name="cari_jenisUnor" id="cari_jenisUnor">
                                <option selected value="All">Semua jenis Unit Organisasi</option>
                                @foreach ($jenisUnor as $unor)
                                <option value="{{ $unor->id }}">{{$unor->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cari_eselon">Eselon</label>
                            <select class="form-control" name="cari_eselon" id="cari_eselon">
                                <option selected value="All">Semua Eselon</option>
                                @foreach ($eselon as $es)
                                <option value="{{ $es->id }}">{{$es->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cari_perangkat">Perangkat Daerah</label>
                            <select class="form-control" name="cari_perangkat" id="cari_perangkat">
                                <option selected value="All">Semua Perangkat Daerah</option>
                                <option value="1">Perangkat Daerah Induk</option>
                                <option value="0">Perangkat Daerah Non-induk</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cari_status">Status</label>
                            <select class="form-control" name="cari_status" id="cari_status">
                                <option selected value="All">Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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
                Daftar Unit Organisasi
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelunor" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nama Unor</th>
                            <th>Jabatan</th>
                            <th>Unor Atasan Langsung</th>
                            <th>Unor Induk</th>
                            <th>Jenis Jabatan</th>
                            <th>Eselon</th>
                            <th>Status dan Jenis PD</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal"
                    data-target="#modelId">
                    Tambah Unit Organisasi
                </button>
            </div>
        </div>

        {{-- Card yang digunakan untuk menjelaskan maksud dari masing-masing kode --}}
        <div class="card card-warning">
            <div class="card-header">
                Penjelasan Kode
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-house-user"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Unit Organisasi Aktif</span>
                                    <span class="info-box-number">1,410</span>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-house-damage"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Unit Organisasi Tidak aktif</span>
                                    <span class="info-box-number">410</span>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-star fa-lg"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Perangkat Daerah/Unit Induk Organisasi</span>
                                    <span class="info-box-number">13,648</span>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-chess-king fa-lg"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jabatan Eselon</span>
                                    <span class="info-box-number">93,139</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Tambah Unit Organisasi</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label for="namaUnor">Nama Unit Organisasi</label>
                                <input type="text" name="namaUnor" id="namaUnor" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namaJabatan">Nama Jabatan</label>
                                <input type="text" name="namaJabatan" id="namaJabatan" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="unorAtasan_id" id="unorAtasan_id"
                                    value="8ae482873fe6c742013fea5f1d8016dc">
                                <label for="unorAtasan">Unor Atasan</label>
                                <input type="text" name="unorAtasan" id="unorAtasan" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" name="unorInduk_id" id="unorInduk_id"
                                    value="A8ACA7417A893912E040640A040269BB">
                                <label for="unorInduk">Unor Induk</label>
                                <input readonly type="text" name="unorInduk" id="unorInduk" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="is_unorInduk">PD</label>
                                <select class="form-control" name="is_unorInduk" id="is_unorInduk">
                                    <option value="1">Ya</option>
                                    <option selected value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="is_aktif">Unor Aktif</label>
                                <select class="form-control" name="is_aktif" id="is_aktif">
                                    <option selected value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="jenisUnor_id">Jenis Unit Organisasi</label>
                                <select class="form-control" name="jenisUnor_id" id="jenisUnor_id">
                                    @foreach ($jenisUnor as $unor)
                                    <option value="{{ $unor->id }}">{{$unor->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="eselon_id">Eselon</label>
                                <select class="form-control" name="eselon_id" id="eselon_id">
                                    <option selected value="Non Eselon">Non Eselon</option>
                                    @foreach ($eselon as $es)
                                    <option value="{{ $es->id }}">{{ $es->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal untuk menampilkan riwayat pejabat yang pernah menduduki jabatan dimaksud --}}
    <div class="modal fade" id="modalPejabat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                    <div class="modal-header modal-warning">
                            <h5 class="modal-title">Data Riwayat Pemangku Jabatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="jabatan_nama">Nama Jabatan</label>
                                    <input readonly type="text" class="form-control" name="jabatan_nama" id="jabatan_nama">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jabatan_jenis">Jenis Jabatan</label>
                                    <input readonly type="text" class="form-control" name="jabatan_jenis" id="jabatan_jenis">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="jabatan_unorInduk">Perangkat Daerah</label>
                                    <input readonly type="text" class="form-control" name="jabatan_unorInduk" id="jabatan_unorInduk">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jabatan_eselon">Eselon</label>
                                    <input readonly type="text" class="form-control" name="jabatan_eselon" id="jabatan_eselon">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table id="tabelJabatan" class="table table-bordered table-inverse table-xs">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama Pegawai</th>
                                    <th>Nomor SK</th>
                                    <th>Tanggal SK</th>
                                    <th>TMT Jabatan</th>
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

</x-app-layout>
@stack('js')

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        // $('#simpan').attr('disabled', true);
    });

    function loadData(cari_nama, cari_jenisUnor, cari_eselon, cari_status,cari_perangkat) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelunor').DataTable({
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
            url: "{{ route('dataUnor') }}",
            data: {
                cari_nama: cari_nama,
                cari_jenisUnor:cari_jenisUnor,
                cari_eselon:cari_eselon,
                cari_status:cari_status,
                cari_perangkat:cari_perangkat,
                jumlahView:jumlahView,
                },
            },

            columns: [{
                data: 'namaUnor',
                name: 'namaUnor'
                },
                {
                data: 'namaJabatan',
                name: 'namaJabatan'
                },
                {
                data: 'namaUnorAtasan',
                name: 'namaUnorAtasan'
                },
                {
                data: 'namaUnorInduk',
                name: 'namaUnorInduk',

                },
                {
                data: 'jenisJabatan',
                name: 'jenisJabatan'
                },
                {
                data: 'eselon',
                name: 'eselon'
                },
                {
                data: 'status',
                name: 'status',
                orderable: false,
                width:'150px',
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

    $('#simpan').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id').val();
        let namaUnor = $('#namaUnor').val();
        let namaJabatan = $('#namaJabatan').val();
        let unorAtasan_id = $('#unorAtasan_id').val();
        let unorInduk_id = $('#unorInduk_id').val();
        let is_unorInduk = $('#is_unorInduk').val();
        let is_aktif = $('#is_aktif').val();
        let jenisUnor_id = $('#jenisUnor_id').val();
        let eselon_id = $('#eselon_id').val();
        let keterangan = $('#keterangan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanUnor') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                namaUnor:namaUnor,
                namaJabatan:namaJabatan,
                unorAtasan_id:unorAtasan_id,
                unorInduk_id:unorInduk_id,
                is_unorInduk:is_unorInduk,
                is_aktif:is_aktif,
                jenisUnor_id:jenisUnor_id,
                eselon_id:eselon_id,
                keterangan:keterangan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelunor').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                // $('#simpan').attr('disabled', true);
                $('#tutup').click();

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
            url: "{{ route('hapusUnor') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelunor').DataTable().ajax.reload(null, false);
            }
        });
    });

    function loadDataUnor(id) {
        $.ajax({
            type: "get",
            url: "{{ route('editUnor') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#id').val(response.id);
                $('#namaUnor').val(response.namaUnor);
                $('#namaJabatan').val(response.namaJabatan);
                $('#unorAtasan_id').val(response.unorAtasan_id);
                $('#unorAtasan').val(response.namaUnorAtasan);
                $('#unorInduk_id').val(response.unorInduk_id);
                $('#unorInduk').val(response.namaUnorInduk);
                $('#is_unorInduk').val(response.is_unorInduk);
                $('#is_aktif').val(response.is_aktif);
                $('#jenisUnor_id').val(response.jenisUnor_id);
                $('#eselon_id').val(response.eselon_id);
                $('#keterangan').val(response.keterangan);

                $('#jabatan_nama').val(response.namaJabatan);
                $('#jabatan_unorInduk').val(response.namaUnorInduk);
                $('#jabatan_jenis').val(response.jenisJabatan);
                $('#jabatan_eselon').val(response.eselon);
            }
        });
    }

    function loadDataPemangku(id) {
        $('#tabelJabatan').DataTable({
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
            dom: 'Bfrtip',
            buttons: [ 'copy', 'excel', 'pdf' ],
            ajax: {
                url: "{{ route('dataRwjabatan') }}",
                data: {
                    id:id,
                    },
                },

            columns: [
                {
                data: 'nip_baru',
                name: 'nip_baru'
                },
                {
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'skNomor',
                name: 'skNomor'
                },
                {
                data: 'skTanggal',
                name: 'skTanggal'
                },
                {
                data: 'tmtJabatan',
                name: 'tmtJabatan',
                }
            ],

            order:[
                [ 3 , "asc"],
            ],

        });
    }

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');
        loadDataUnor(id);
        $('#simpan').text('Update');
        $('#tambah').click();
    });

    $(document).on('click','.showPemangku', function () {
        let id = $(this).attr('id');
        loadDataUnor(id);
        loadDataPemangku(id);
    });

    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        // $('#simpan').attr('disabled', true);
        $('#namaUnor').val(null);
        $('#namaJabatan').val(null);
        $('#unorAtasan_id').val(null);
        $('#unorAtasan').val(null);
        $('#unorInduk_id').val(null);
        $('#is_unorInduk').val(null);
        $('#is_aktif').val(null);
        $('#jenisUnor_id').val(null);
        $('#eselon_id').val(null);
        $('#keterangan').val(null);
    });


    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_nama = $('#cari_nama').val();
        let cari_jenisUnor = $('#cari_jenisUnor').val();
        let cari_eselon = $('#cari_eselon').val();
        let cari_status = $('#cari_status').val();
        let cari_perangkat = $('#cari_perangkat').val();
        loadData(cari_nama, cari_jenisUnor, cari_eselon, cari_status, cari_perangkat);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nama').val(null);
        $('#cari_jenisUnor').val("All");
        $('#cari_eselon').val("All");
        $('#cari_status').val("All");
        $('#cari_perangkat').val("All");
    });

    $('#unorAtasan').autocomplete({
        appendTo: "#modelId",
        source:function(request, response) {
            $.ajax({
                url: "{{ route('cariUnor') }}",
                data: {
                    cariUnor: request.term,
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            // $('#unorAtasan').val(ui.item.label);
            $( "#unorAtasan" ).val(ui.item.label);
            $('#unorAtasan_id').val(ui.item.value);
            $('#unorInduk').val(ui.item.unorInduk);
            $('#unorInduk_id').val(ui.item.unorInduk_Id);
            return false;
         },
         focus: function(event, ui){
            $( "#unorAtasan" ).val(ui.item.label);
            $('#unorInduk').val(ui.item.unorInduk);
            return false;
         }
    });

    // Fungsi ini tidak digunakan, element dibuat readonly
    // $('#unorInduk').autocomplete({
    //     appendTo: "#modelId",
    //     source:function(request, response) {
    //         $.ajax({
    //             url: "{{ route('cariUnor') }}",
    //             data: {
    //                 cariUnor: request.term,
    //                 isInduk:true,
    //             },
    //             success: function (data) {
    //                 response(data)
    //             }
    //         });
    //     },
    //     select:function (event, ui) {
    //         $('#unorInduk').val(ui.item.label);
    //         $('#unorInduk_id').val(ui.item.value);
    //         return false;
    //      },
    //      focus: function(event, ui){
    //         $( "#unorInduk" ).val( ui.item.label );
    //         return false;
    //      }
    // });


    $(document).on('click','.edit-status, .dropdown-status', function () {
        let id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "{{ route('editStatusUnor') }}",
            data: {
                id:id,
            },
            success: function (response) {
                toastr.success(response.text, 'Sukses');
                console.log(response);
                $('#tabelunor').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-perangkat, .dropdown-perangkat', function () {
        let id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "{{ route('editPerangkatUnor') }}",
            data: {
                id:id,
            },
            success: function (response) {
                toastr.success(response.text, 'Sukses');
                console.log(response);
                $('#tabelunor').DataTable().ajax.reload(null, false);
            }
        });
    });

</script>
