<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Sekolah') }}
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
                                <option selected="" value="">Semua Wilayah</option>
                                @foreach ($wilayah as $kec)
                                <option value="{{ $kec->wilayah }}">{{ $kec->wilayah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cariJenjang">Jenjang Sekolah</label>
                            <select class="custom-select" name="cariJenjang" id="cariJenjang">
                                <option selected="" value="">Semua Jenjang</option>
                                <option value="SD">Sekolah Dasar</option>
                                <option value="SMP">Sekolah Menengah Pertama</option>
                            </select>
                        </div>
                    </div>
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
        <div class="card card-info">
            <div class="card-header">
                Data Sekolah
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelsekolah" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>NPSN</th>
                            <th>Wilayah</th>
                            <th>Nama Sekolah (Dapodik)</th>
                            <th>Nama Sekolah</th>
                            <th>Jumlah Siswa</th>
                            <th>Informasi Sekolah</th>
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
                    Tambah Data Sekolah
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
                    <h5 class="modal-title"><strong>Tambah Data Sekolah</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class=" form-group">
                                <label for="npsn">NPSN</label>
                                <input type="text" name="npsn" id="npsn" class="form-control" placeholder="NPSN">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="jenjang">Jenjang</label>
                                <select class="custom-select" name="jenjang" id="jenjang">
                                    <option value="TK ">Taman Kanak-Kanak</option>
                                    <option value="SD ">Sekolah Dasar</option>
                                    <option value="SMP ">Sekolah Menengah Pertama</option>
                                </select>
                            </div>
                        </div>


                    </div>
                    <hr class="mt-0">
                    <div class="form-group">
                        <label for="wilayah">Kecamatan/Wilayah</label>
                        <select class="custom-select" name="wilayah" id="wilayah">
                            @foreach ($wilayah as $kec)
                            <option value="{{ $kec->wilayah }}">{{ $kec->wilayah }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namadapodik">Nama Sekolah (Dapodik)</label>
                        <input type="text" name="namadapodik" id="namadapodik" class="form-control"
                            placeholder="Nama Sekolah sesuai data dapodik">
                    </div>
                    <div class="form-group">
                        <label for="namasekolah">Nama Sekolah</label>
                        <input type="text" name="namasekolah" id="namasekolah" class="form-control"
                            placeholder="Nama Sekolah sesuai Peraturan Bupati">
                    </div>
                    <hr class="mt-0">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="siswa">Jumlah Siswa</label>
                                <input type="text" name="siswa" id="siswa" class="form-control"
                                    placeholder="Jumlah Siswa">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rombel">Jumlah Rombel</label>
                                <input type="text" name="rombel" id="rombel" class="form-control"
                                    placeholder="Jumlah Rombel">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="abk">Jumlah ABK</label>
                                <input type="text" name="abk" id="abk" class="form-control" placeholder="Jumlah ABK">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="asn">Jumlah ASN</label>
                                <input type="text" name="asn" id="asn" class="form-control" placeholder="Jumlah ASN">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nonASN">Jumlah Non-ASN</label>
                                <input type="text" name="nonASN" id="nonASN" class="form-control"
                                    placeholder="Jumlah Non-ASN">
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="form-group">
                        <label for="catatan">Informasi Tambahan</label>
                        <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
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

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        loadData();

    });

    function loadData(
        cariWilayah,
        cariJenjang,
    ) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelsekolah').DataTable({
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
            url: "{{ route('masterSekolah') }}",
            data: {
                cariWilayah:cariWilayah,
                cariJenjang:cariJenjang,
                jumlahView:jumlahView
            },
            },
            columns: [
            {
            data: 'npsn',
            name: 'npsn'
            },
            {
            data: 'wilayah',
            name: 'wilayah',
            },
            {
            data: 'namadapodik',
            name: 'namadapodik',
            },
            {
            data: 'namasekolah',
            name: 'namasekolah',
            },
            {
            data: 'siswa',
            name: 'siswa',
            },
            {
            data: 'informasi',
            name: 'informasi',
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
        let npsn = $('#npsn').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let namadapodik = $('#namadapodik').val();
        let namasekolah = $('#namasekolah').val();
        let jenjang = $('#jenjang').val();
        let wilayah = $('#wilayah').val();
        let abk = $('#abk').val();
        let rombel = $('#rombel').val();
        let asn = $('#asn').val();
        let pppk = $('#pppk').val();
        let nonASN = $('#nonASN').val();
        let siswa = $('#siswa').val();
        let catatan = $('#catatan').val();

        $.ajax({
            type: "post",
            url: "{{ route('simpanSekolah') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                npsn:npsn,
                namadapodik:namadapodik,
                namasekolah:namasekolah,
                jenjang:jenjang,
                wilayah:wilayah,
                abk:abk,
                rombel:rombel,
                asn:asn,
                nonASN:nonASN,
                siswa:siswa,
                catatan:catatan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelsekolah').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#npsn').attr('readonly', false);
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
            url: "{{ route('hapusSekolah') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelsekolah').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editSekolah') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#npsn').attr('readonly', true);
                $('#npsn').val(response.npsn);
                $('#namadapodik').val(response.namadapodik);
                $('#namasekolah').val(response.namasekolah);
                $('#jenjang').val(response.jenjang);
                $('#wilayah').val(response.wilayah);
                $('#abk').val(response.abk);
                $('#rombel').val(response.rombel);
                $('#asn').val(response.asn);
                $('#nonASN').val(response.nonASN);
                $('#siswa').val(response.siswa);
                $('#catatan').val(response.catatan);

                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#nspn').attr('readonly', false);
        $('#npsn').val(null);
        $('#namadapodik').val(null);
        $('#namasekolah').val(null);
        $('#jenjang').val(null);
        $('#wilayah').val(null);
        $('#abk').val(null);
        $('#rombel').val(null);
        $('#asn').val(null);
        $('#nonASN').val(null);
        $('#siswa').val(null);
        $('#catatan').val(null);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cariWilayah = $('#cariWilayah').val();
        let cariJenjang = $('#cariJenjang').val();
        loadData(
            cariWilayah,
            cariJenjang,
        );
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cariWilayah').val(null);
        $('#cariJenjang').val(null);
    });

</script>