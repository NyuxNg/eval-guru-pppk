<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data PPPK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="cariWilayah">Kecamatan/Wilayah</label>
                          <select class="custom-select" name="cariWilayah" id="cariWilayah">
                                <option selected value="">Semua Wilayah</option>
                                @foreach ($wilayah as $kp)
                                <option value="{{ $kp->wilayah }}">{{ $kp->wilayah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="cariJabatan">Cari Jabatan</label>
                          <select class="custom-select" name="cariJabatan" id="cariJabatan">
                                <option selected value="">Semua Jabatan</option>
                                @foreach ($jabatan as $kp)
                                <option value="{{ $kp->jabatanASN }}">{{ $kp->jabatanASN }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                          <label for="cariPendidikan">Cari Pendidikan</label>
                          <select class="custom-select" name="cariPendidikan" id="cariPendidikan">
                                <option selected value="">Semua Jurusan</option>
                                @foreach ($pendidikan as $kp)
                                <option value="{{ $kp->pendidikan }}">{{ $kp->pendidikan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="carilinear">Linier Pendidikan</label>
                            <select class="form-control" name="carilinear " id="carilinear">
                                <option selected value="">Tampilkan Semua</option>
                                <option value="Linier Murni">LINIER MURNI</option>
                                <option value="Linier Pendidikan">LINIER PENDIDIKAN</option>
                                <option value="Tidak Linier">TIDAK LINIER</option>
                                <option value="Lainnya">LAINNYA</option>
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
        <div class="card card-info">
            <div class="card-header">
                Data PPPK
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelPPPK" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nama/NI PPPK</th>
                            {{-- <th>Nama</th> --}}
                            <th>Jabatan</th>
                            {{-- <th>Pendidikan</th> --}}
                            <th>Linearitas Jabatan & Pendidikan</th>
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
                    Tambah Data PPPK
                </button>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title"><strong>Tambah Data PPPK</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idOrang" id="idOrang">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nipBaru">NI PPPK</label>
                                <input type="text" name="nipBaru" id="nipBaru" class="form-control" placeholder="Masukkan NI PPPK">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama PPPK</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama PPPK">
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="golru">Golongan</label>
                                <select class="form-control" name="golru " id="golru">
                                    <option value="VII">VII</option>
                                    <option value="IX">IX</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tmtPPPK">TMT PPPK</label>
                                <input type="text" name="tmtPPPK" id="tmtPPPK" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#tmtPPPK" placeholder="Masukkan TMT PPPK">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="statusPerkawinan">Status Perkawinan</label>
                                <select class="form-control" name="statusPerkawinan" id="statusPerkawinan">
                                    <option value="Menikah">Menikah</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai">Cerai</option>
                                    <option value="Janda / Duda">Janda/Duda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan</label>
                        <input type="text" name="pendidikan" id="pendidikan" class="form-control" placeholder="Pendidikan">
                    </div>

                    <div class="form-group">
                        <label for="jabatanASN">Jabatan</label>
                        <input type="text" name="jabatanASN" id="jabatanASN" class="form-control" placeholder="Jabatan">
                    </div>
                    <div class="form-group">
                        <label for="unitKerja">Unit Kerja</label>
                        <input type="text" name="unitKerja" id="unitKerja" class="form-control" placeholder="Unit Kerja (Sekolah)">
                    </div>
                    <div class="form-group">
                        <label for="wilayah">Wilayah Kecamatan</label>
                        <select class="form-control" name="wilayah " id="wilayah">
                            @foreach ($wilayah as $kp)
                                <option value="{{ $kp->wilayah }}">{{ $kp->wilayah }}</option>
                            @endforeach
                            <option value="Belum diset">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="linear">Linier Pendidikan</label>
                        <select class="form-control" name="linear " id="linear">
                            <option value="Linier Murni">Linier Murni -> Pendidikan dan Jabatan Sesuai</option>
                            <option value="Linier Pendidikan">Linier Pendidikan -> Pendidikan Belum Linier Langsung Jabatan</option>
                            <option value="Tidak Linier">Tidak Linier</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
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
        loadData();
        $('.datetimepicker-input').datetimepicker({
            locale: 'id',
            format: 'L',
            viewMode: 'months',
            format: 'YYYY-MM-DD'
        });
    });

    function loadData(
        cariWilayah,
        cariJabatan,
        cariPendidikan,
        carilinear
    ) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelPPPK').DataTable({
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
        dom: '<"wrapper"Bfliptp>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            url: "{{ route('masterPPPK') }}",
            data: {
                cariWilayah:cariWilayah,
                cariJabatan:cariJabatan,
                cariPendidikan:cariPendidikan,
                carilinear:carilinear,
                jumlahView:jumlahView
            },
            },
            columns: [
            {
            data: 'namaNIP',
            name: 'namaNIP'
            },
            // {
            // data: 'nama',
            // name: 'nama'
            // },
            {
            data: 'jabatanASN',
            name: 'jabatanASN',
            },
            // {
            // data: 'pendidikan',
            // name: 'pendidikan',
            // },
            {
            data: 'linear',
            name: 'linear',
            },
            {
            data: 'unitKerja',
            name: 'unitKerja',
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
        let idOrang = $('#idOrang').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let nipBaru = $('#nipBaru').val();
        let nama = $('#nama').val();
        let statusPerkawinan = $('#statusPerkawinan').val();
        let golru = $('#golru').val();
        let tmtPPPK = $('#tmtPPPK').val();
        let pendidikan = $('#pendidikan').val();
        let jabatanASN = $('#jabatanASN').val();
        let unitKerja = $('#unitKerja').val();
        let wilayah = $('#wilayah').val();
        let linear = $('#linear').val();

        $.ajax({
            type: "post",
            url: "{{ route('simpanPPPK') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                idOrang:idOrang,
                nipBaru:nipBaru,
                nama:nama,
                statusPerkawinan:statusPerkawinan,
                golru:golru,
                tmtPPPK:tmtPPPK,
                pendidikan:pendidikan,
                jabatanASN:jabatanASN,
                unitKerja:unitKerja,
                wilayah:wilayah,
                linear:linear,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelPPPK').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nipBaru').attr('readonly', false);
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
            url: "{{ route('hapusPPPK') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelPPPK').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editPPPK') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#idOrang').val(response.idOrang);
                $('#nipBaru').attr('readonly', true);
                $('#nipBaru').val(response.nipBaru);
                $('#nama').val(response.nama);
                $('#statusPerkawinan').val(response.statusPerkawinan);
                $('#golru').val(response.golru);
                $('#tmtPPPK').val(response.tmtPPPK);
                $('#pendidikan').val(response.pendidikan);
                $('#jabatanASN').val(response.jabatanASN);
                $('#unitKerja').val(response.unitKerja);
                $('#wilayah').val(response.wilayah);
                $('#linear').val(response.linear);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#idOrang').val(null);
        $('#nipBaru').attr('readonly', false);
        $('#nipBaru').val(null);
        $('#nama').val(null);
        $('#statusPerkawinan').val(null);
        $('#golru').val(null);
        $('#tmtPPPK').val(null);
        $('#pendidikan').val(null);
        $('#jabatanASN').val(null);
        $('#unitKerja').val(null);
        $('#wilayah').val(null);
        $('#linear').val(null);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cariWilayah = $('#cariWilayah').val();
        let cariJabatan = $('#cariJabatan').val();
        let cariPendidikan = $('#cariPendidikan').val();
        let carilinear = $('#carilinear').val();
        loadData(
            cariWilayah,
            cariJabatan,
            cariPendidikan,
            carilinear
        );
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cariWilayah').val(null);
        $('#cariJabatan').val(null);
        $('#cariPendidikan').val(null);
        $('#carilinear').val(null);
    });

</script>
