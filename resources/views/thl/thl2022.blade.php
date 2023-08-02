<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('THL 2022') }}
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
                                <option value="pindah">Pindah</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="cari_perangkatdaerah">Perangkat Daerah</label>
                            <select class="form-control" name="cari_perangkatdaerah" id="cari_perangkatdaerah">
                                <option selected value="all">Semua Perangkat Daerah</option>
                                        @foreach ($perangkatDaerah as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->nama}}</option>
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
        <div class="card card-success">
            <div class="card-header">
                Daftar THL 2022
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="Thl2022" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>Pendidikan</th>
                            <th>Unit Kerja</th>
                            <th>Jabatan</th>
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
                    Tambah Data Thl2022
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
                    <h5 class="modal-title"><strong>Tambah Thl2022</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label for="nomor_urut">Nomor Urut SK</label>
                                <input type="text" name="nomor_urut" id="nomor_urut" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" value="-" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="idPerangkatDaerah" id="idPerangkatDaerah">
                        <label for="cariPerangkatDaerah">Perangkat Daerah</label>
                        <input type="text" name="cariPerangkatDaerah" id="cariPerangkatDaerah" class="form-control" placeholder="Perangkat Daerah">
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="pendidikan">Pendidikan</label>
                              <input type="text"
                                class="form-control" name="pendidikan" id="pendidikan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text"
                                  class="form-control" name="jabatan" id="jabatan">
                              </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option selected value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                    <option value="pindah">Pindah</option>
                                </select>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="set_idabsensi">ID Absensi</label>
                              <input type="text"
                                class="form-control" name="set_idabsensi" id="set_idabsensi">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="set_nik">NIK</label>
                                <input type="text"
                                  class="form-control" name="set_nik" id="set_nik">
                              </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sumberHonor">Sumber Honor</label>
                                <select class="form-control" name="sumberHonor" id="sumberHonor">
                                    <option selected value="APBD">APBD</option>
                                    <option value="APBN">APBN</option>
                                    <option value="Sumber Lain">Sumber Lain</option>
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
                                    <label for="presensi_nama">Nama THL Tahun 2022</label>
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
</x-app-layout>
@stack('js')
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#kotakStatus').hide();
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
                    cari_perangkatdaerah: 'all',
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

    function loadDataTHL2022(id) {
        $.ajax({
            type: "get",
            url: "{{ route('editThl2022') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#presensi_nama').val(response.nama)
                $('#presensi_pendidikan').val(response.pendidikan)
                $('#presensi_unitkerja').val(response.cariPerangkatDaerah)
                $('#presensi_jabatan').val(response.jabatan);
                loadDataPresensi(response.nama);
            }
        });
    }

    $(document).on('click', '.presensi', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        loadDataTHL2022(id);
    });

    function loadData(cari_perangkatdaerah, cari_thl,cari_status) {
        let jumlahView = $('#jumlahView').val();
        $('#Thl2022').DataTable({
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
        dom: '<"wrapper"Bflipt>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            // type: "post",
            url: "{{ route('dataThl2022') }}",
            data: {
                cari_perangkatdaerah: cari_perangkatdaerah,
                cari_thl:cari_thl,
                cari_status:cari_status,

                jumlahView:jumlahView,
                },
            },

        columns: [
            {
            data: 'status',
            name: 'status'
            },
            {
            data: 'nama',
            name: 'nama'
            },
            {
            data: 'pendidikan',
            name: 'pendidikan'
            },
            {
            data: 'namaUnitkerja',
            name: 'namaUnitkerja',
            },
            {
            data: 'jabatan',
            name: 'jabatan',
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
        let nomor_urut = $('#nomor_urut').val();
        let nama = $('#nama').val();
        let pendidikan = $('#pendidikan').val();
        let jabatan = $('#jabatan').val();
        let sumberHonor = $('#sumberHonor').val();
        let status = $('#status').val();
        let set_idabsensi = $('#set_idabsensi').val();
        let set_nik = $('#set_nik').val();
        let keterangan = $('#keterangan').val();
        let idPerangkatDaerah = $('#idPerangkatDaerah').val();

        $.ajax({
            type: "post",
            url: "{{ route('simpanThl2022') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                nomor_urut:nomor_urut,
                nama:nama,
                pendidikan:pendidikan,
                jabatan:jabatan,
                sumberHonor:sumberHonor,
                status:status,
                set_idabsensi:set_idabsensi,
                set_nik:set_nik,
                keterangan:keterangan,
                idPerangkatDaerah:idPerangkatDaerah,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#Thl2022').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nomor_urut').attr('readonly', false);
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
            url: "{{ route('hapusThl2022') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#Thl2022').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editThl2022') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nomor_urut').attr('readonly', true);
                $('#nomor_urut').val(response.nomor_urut);
                $('#id').val(response.id);
                $('#nama').val(response.nama);
                $('#pendidikan').val(response.pendidikan);
                $('#jabatan').val(response.jabatan);
                $('#sumberHonor').val(response.sumberHonor);
                $('#status').val(response.status);
                $('#set_idabsensi').val(response.set_idabsensi);
                $('#set_nik').val(response.set_nik);
                $('#keterangan').val(response.keterangan);
                $('#idPerangkatDaerah').val(response.idPerangkatDaerah);
                $('#cariPerangkatDaerah').val(response.cariPerangkatDaerah);

                $('#simpan').text('Update');
                // $('#simpan').attr('disabled', false);
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        // $('#simpan').attr('disabled', true);
        $('#nomor_urut').attr('readonly', false);
        $('#nomor_urut').val(null);
        $('#nama').val(null);
        $('#pendidikan').val(null);
        $('#jabatan').val(null);
        $('#sumberHonor').val(null);
        $('#status').val(null);
        $('#set_idabsensi').val(null);
        $('#set_nik').val(null);
        $('#keterangan').val(null);
        $('#idPerangkatDaerah').val(null);
        $('#cariPerangkatDaerah').val(null);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_perangkatdaerah = $('#cari_perangkatdaerah').val();
        let cari_thl = $('#cari_thl').val();
        let cari_status = $('#cari_status').val();

        loadData(cari_perangkatdaerah,cari_thl, cari_status);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_perangkatdaerah').val("all");
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
        $.ajax({
            type: "get",
            url: "{{ route('editStatusThl2022') }}",
            data: {
                id:id,
            },
            success: function (response) {
                toastr.success(response.text, 'Sukses');
                console.log(response);
                $('#Thl2022').DataTable().ajax.reload(null, false);
            }
        });
    });

</script>
