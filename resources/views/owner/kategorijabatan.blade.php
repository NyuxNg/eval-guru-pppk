<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Kategori/Jenis Jabatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Kategori/Jenis Jabatan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelKategorijabatan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Kode</th>
                            <th>Kategori Jabatan</th>
                            <th>Jenis Jabatan</th>
                            <th>Pangkat Dasar</th>
                            <th>Pangkat Puncak</th>
                            <th>Tingkat Pendidikan Minimal</th>
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
                    Tambah Kategori/Jenis Jabatan
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
                    <h5 class="modal-title"><strong>Tambah Kategori/Jenis Jabatan</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori Jabatan</label>
                        <select class="form-control" name="kategori" id="kategori">
                           <option value="JPT">JPT - Jabatan Pimpinan Tinggi</option>
                           <option value="JA">JA - Jabatan Administrasi</option>
                           <option value="JF">JF - Jabatan Fungsional</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Nama Jenis Jabatan</label>
                        <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Masukkan nama jenis jabatan">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pangkatDasar">Pangkat Dasar</label>
                                <select class="form-control" name="pangkatDasar" id="pangkatDasar">
                                    <option selected value="">Tidak diatur</option>
                                    @foreach ($golongan as $gol)
                                        <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pangkatPuncak">Pangkat Puncak</label>
                                <select class="form-control" name="pangkatPuncak" id="pangkatPuncak">
                                    <option selected value="">Tidak diatur</option>
                                    @foreach ($golongan as $gol)
                                        <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tktPendidikan">Jenjang Pendidikan Minimal</label>
                        <select class="form-control" name="tktPendidikan" id="tktPendidikan">
                            <option selected value="">Tidak diatur</option>
                            @foreach ($tktPendidikan as $tkt)
                            <option value="{{ $tkt->kode }}">{{ $tkt->kode . ' - ' . $tkt->nama}}</option>
                            @endforeach
                        </select>
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
</x-app-layout>
@stack('js')

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.17/dist/sweetalert2.all.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        loadData();
    });

    function loadData() {
        $('#tabelKategorijabatan').DataTable({
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
            url: "{{ route('masterKategorijabatan') }}"
            },
            columns: [{
            data: 'kode',
            name: 'kode'
            },
            {
            data: 'kategori',
            name: 'kategori'
            },
            {
            data: 'jenis',
            name: 'jenis'
            },
            {
            data: 'pangkatDasar',
            name: 'pangkatDasar',

            },
            {
            data: 'pangkatPuncak',
            name: 'pangkatPuncak'
            },
            {
            data: 'tktPendidikan',
            name: 'tktPendidikan'
            },
            {
            data: 'keterangan',
            name: 'keterangan'
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
        let kode = $('#kode').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let kategori = $('#kategori').val();
        let jenis = $('#jenis').val();
        let pangkatDasar = $('#pangkatDasar').val();
        let pangkatPuncak = $('#pangkatPuncak').val();
        let tktPendidikan = $('#tktPendidikan').val();
        let keterangan = $('#keterangan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanKategorijabatan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                kode:kode,
                kategori:kategori,
                jenis:jenis,
                pangkatDasar:pangkatDasar,
                pangkatPuncak:pangkatPuncak,
                tktPendidikan:tktPendidikan,
                keterangan:keterangan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelKategorijabatan').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#kode').attr('readonly', false);
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
            url: "{{ route('hapusKategorijabatan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelKategorijabatan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editKategorijabatan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kode').val(response.kode);
                $('#kode').attr('readonly', true);
                $('#kategori').val(response.kategori);
                $('#jenis').val(response.jenis);
                $('#pangkatDasar').val(response.pangkatDasar);
                $('#pangkatPuncak').val(response.pangkatPuncak);
                $('#tktPendidikan').val(response.tktPendidikan);
                $('#keterangan').val(response.keterangan);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#kode').val(null);
        $('#kode').attr('readonly', false);
        $('#kategori').val(null);
        $('#jenis').val(null);
        $('#pangkatDasar').val(null);
        $('#pangkatPuncak').val(null);
        $('#tktPendidikan').val(null);
        $('#keterangan').val(null);
    });

</script>
