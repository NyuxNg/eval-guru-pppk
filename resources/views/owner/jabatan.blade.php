<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Jabatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                            <label for="cari_jenistenaga">Jenis Tenaga</label>
                            <select class="form-control" name="cari_jenistenaga" id="cari_jenistenaga">
                                <option selected value="">Semua Jenis Tenaga</option>
                                <option value="Guru">Tenaga Guru/Kependidikan</option>
                                <option value="Kesehatan">Tenaga Kesehatan</option>
                                <option value="Teknis">Tenaga Teknis Lainnya</option>
                            </select>

                    </div>

                    <div class="col-md-2">
                        <label for="cari_kategorijab">Kategori Jabatan</label>
                            <select class="form-control" name="cari_kategorijab" id="cari_kategorijab">
                                <option selected value="">Semua Kategori</option>
                                @foreach ($kategoriJab as $tkt)
                                    <option value="{{ $tkt->kategori }}">{{ $tkt->kategori }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-3">
                        <label for="cari_jenisjab">Jenis Jabatan</label>
                            <select class="form-control" name="cari_jenisjab" id="cari_jenisjab">
                                <option selected value="">Semua Jenis</option>
                                @foreach ($jenisJab as $tkt)
                                    <option value="{{ $tkt->id }}">{{ $tkt->jenis }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-5">
                            <label for="cari_nama">Nama</label>
                            <input type="text" class="form-control" name="cari_nama" id="cari_nama" placeholder="Masukkan nama jabatan yang dicari">
                          </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="row">
                    <div class="col-md-1">
                        {{-- <div class="form-group"> --}}
                            <select class="custom-select" name="jumlahView" id="jumlahView">
                                <option selected>Pilih</option>
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
                Daftar Jabatan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelJabatan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nama Jabatan</th>
                            <th>Kategori</th>
                            <th>Jenis Jabatan</th>
                            <th>Tenaga</th>
                            <th>Aturan</th>
                            <th>BUP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Jabatan
                </button>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong> Tambah Jabatan</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="nama">Nama Jabatan</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama jabatan atan">
                    </div>
                    <div class="form-group">
                        <label for="idKategorijabatan">Jenis Jabatan</label>
                        <select class="form-control" name="idKategorijabatan" id="idKategorijabatan">
                            @foreach ($jenisJab as $tkt)
                            <option value="{{ $tkt->id }}">{{ $tkt->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenisTenaga">Jenis Tenaga</label>
                        <select class="form-control" name="jenisTenaga" id="jenisTenaga">
                            <option value="Guru">Tenaga Guru/Kependidikan</option>
                            <option value="Kesehatan">Tenaga Kesehatan</option>
                            <option selected value="Teknis">Tenaga Teknis Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="aturan">Aturan Hukum</label>
                        <input type="text" name="aturan" id="aturan" class="form-control" placeholder="Masukkan aturan terkait">
                    </div>

                    <div class="form-group">
                        <label for="bup">Batas Usia Pensiun</label>
                        <select class="form-control" name="bup" id="bup">
                                <option selected value=58>58 Tahun</option>
                                <option value=60>60 Tahun</option>
                                <option value=65>65 Tahun</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="aktif">Status`</label>
                        <select class="custom-select" name="aktif" id="aktif">
                            <option selected value=1>Aktif</option>
                            <option value=0>Non Aktif</option>
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
        // loadData();
    });

    function loadData(cari_jenistenaga, cari_kategorijab, cari_jenisjab, cari_nama) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelJabatan').DataTable({
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
            url: "{{ route('dataJabatan') }}",
            data: {
                cari_jenistenaga: cari_jenistenaga,
                cari_kategorijab: cari_kategorijab,
                cari_jenisjab: cari_jenisjab,
                cari_nama: cari_nama,
                jumlahView:jumlahView,
            }
            },
            columns: [
                {
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'kategori',
                name: 'kategori',
                },
                {
                data: 'jenis',
                name: 'jenis',
                },
                {
                data: 'jenisTenaga',
                name: 'jenisTenaga',
                },
                {
                data: 'aturan',
                name: 'aturan',
                },
                {
                data: 'bup',
                name: 'bup',
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
        let kode = $('#kode').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id').val();
        let nama = $('#nama').val();
        let idKategorijabatan = $('#idKategorijabatan').val();
        let jenisTenaga = $('#jenisTenaga').val();
        let aturan = $('#aturan').val();
        let bup = $('#bup').val();
        let aktif = $('#aktif').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanJabatan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                nama:nama,
                aturan:aturan,
                jenisTenaga:jenisTenaga,
                bup:bup,
                idKategorijabatan:idKategorijabatan,
                aktif:aktif,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelJabatan').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                // $('#kode').attr('readonly', false);
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
            url: "{{ route('hapusJabatan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelJabatan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "{{ route('editJabatan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#id').val(response.id);
                $('#nama').val(response.nama);
                $('#aturan').val(response.aturan);
                $('#jenisTenaga').val(response.jenisTenaga);
                $('#bup').val(response.bup);
                $('#idKategorijabatan').val(response.idKategorijabatan);
                $('#aktif').val(response.aktif);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });

    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#kode').val(null);
        $('#kode').attr('readonly', false);
        $('#nama').val(null);
        $('#aturan').val(null);
        $('#jenisTenaga').val(null);
        $('#idKategorijabatan').val(null);
        $('#aktif').val(null);
        $('#bup').val(null);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_jenistenaga = $('#cari_jenistenaga').val();
        let cari_kategorijab = $('#cari_kategorijab').val();
        let cari_jenisjab = $('#cari_jenisjab').val();
        let cari_nama = $('#cari_nama').val();

        loadData(cari_jenistenaga, cari_kategorijab, cari_jenisjab, cari_nama);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_jenistenaga').val(null);
        $('#cari_kategorijab').val(null);
        $('#cari_jenisjab').val(null);
        $('#cari_nama').val(null);
    });

</script>
