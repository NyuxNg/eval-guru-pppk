<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perangkat Daerah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cari_jenis">Jenis Perangkat Daerah</label>
                            <select class="form-control" name="cari_jenis" id="cari_jenis">
                                <option selected value="all">Pilih</option>
                                <option  value="Inspektorat">Inspektorat</option>
                                <option value="Sekretariat">Sekretariat</option>
                                <option value="Badan">Badan</option>
                                <option value="Dinas">Dinas</option>
                                <option value="Kecamatan">Kecamatan</option>
                            </select>
                        </div>


                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="cari_perangkatdaerah">Perangkat Daerah</label>
                            <input type="text" class="form-control form-control-xs" name="cari_perangkatdaerah" id="cari_perangkatdaerah"
                                placeholder="perangkat daerah yang dicari?">
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
                                <option value="10">10</option>
                                <option selected value="100">100</option>
                                <option value="Badan">500</option>
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
                Daftar Perangkat Daerah
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelPerangkatdaerah" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Nama Perangkat Daerah</th>
                            <th>Jumlah THL 2022</th>
                            <th>Data File 2023</th>
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
                    Tambah Perangkat Daerah
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
                    <h5 class="modal-title"><strong>Tambah Perangkat Daerah</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="nama">Nama Perangkat Daerah</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama perangkat daerah">
                    </div>
                    <div class="form-group">
                        <label for="jabatanPimpinan">Sebutan Pimpinan</label>
                        <input type="text" name="jabatanPimpinan" id="jabatanPimpinan" class="form-control" placeholder="sebutan pimpinan perangkat daerah">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="thl2022">Jumlah THL Tahun 2022</label>
                                <input type="text" name="thl2022" id="thl2022" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usulthl2023">Data THL Tahun 2023 (File)</label>
                                <input type="text" name="usulthl2023" id="usulthl2023" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
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
        $('#kotakStatus').hide();
    });

    function loadData(cari_perangkatdaerah, cari_jenis) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelPerangkatdaerah').DataTable({
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
            url: "{{ route('dataPerangkatdaerah') }}",
            data: {
                cari_perangkatdaerah: cari_perangkatdaerah,
                cari_jenis:cari_jenis,
                jumlahView:jumlahView,
                },
            },

            columns: [{
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'thl2022',
                name: 'thl2022'
                },
                {
                data: 'usulthl2023',
                name: 'usulthl2023'
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
            ]
            })
    }

    $('#simpan').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id').val();
        let nama = $('#nama').val();
        let jabatanPimpinan = $('#jabatanPimpinan').val();
        let thl2022 = $('#thl2022').val();
        let usulthl2023 = $('#usulthl2023').val();
        let keterangan = $('#keterangan').val();

        $.ajax({
            type: "post",
            url: "{{ route('simpanPerangkatdaerah') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                nama:nama,
                jabatanPimpinan:jabatanPimpinan,
                thl2022:thl2022,
                usulthl2023:usulthl2023,
                keterangan:keterangan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelPerangkatdaerah').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nama').attr('readonly', false);
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
            url: "{{ route('hapusPerangkatdaerah') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelPerangkatdaerah').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editPerangkatdaerah') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nama').attr('readonly', true);
                $('#nama').val(response.nip_baru);
                $('#id').val(response.id);
                $('#nama').val(response.nama);
                $('#jabatanPimpinan').val(response.jabatanPimpinan);
                $('#thl2022').val(response.thl2022);
                $('#usulthl2023').val(response.usulthl2023);
                $('#keterangan').val(response.keterangan);
                $('#simpan').text('Update');
                // $('#simpan').attr('disabled', false);
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        // $('#simpan').attr('disabled', true);
        $('#nama').attr('readonly', false);
        $('#nama').val(null);
        $('#nama').val(null);
        $('#jabatanPimpinan').val(null);
        $('#thl2022').val(null);
        $('#usulthl2023').val(null);
        $('#keterangan').val(null);
    });

    $('#nama').blur(function (e) {
        let nama = $(this).val();
        $('#jabatanPimpinan').val("Kepala ".nama);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_perangkatdaerah = $('#cari_perangkatdaerah').val();
        let cari_jenis = $('#cari_jenis').val();
        loadData(cari_perangkatdaerah,cari_jenis);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_perangkatdaerah').val(null);
        $('#cari_jenis').val(null);
    });

</script>
