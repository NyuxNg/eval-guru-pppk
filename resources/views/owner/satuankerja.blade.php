<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Satuan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Satuan Kerja
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelSatuanKerja" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Instansi</th>
                            <th>Nama Satuan Kerja</th>
                            <th>Jenis Satuan Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Satuan Kerja
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
                    <h5 class="modal-title"><strong> Tambah Satuan Kerja</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="instansi">Instansi</label>
                      <input type="text" name="instansi" id="instansi" class="form-control" placeholder="Masukkan nama instansi">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Satuan Kerja</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan satuan kerja">
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis Jabatan</label>
                        <select class="form-control" name="jenis" id="jenis">
                            <option value="P">Instansi Pusat</option>
                            <option value="D">Instansi Daerah</option>
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
    });

    function loadData() {
        $('#tabelSatuanKerja').DataTable({
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
            url: "{{ route('masterSatuanKerja') }}"
            },
            columns: [
            {
            data: 'instansi',
            name: 'instansi',
            },
            {
            data: 'nama',
            name: 'nama'
            },
            {
            data: 'jenis',
            name: 'jenis',
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
        let nama = $('#nama').val();
        let instansi = $('#instansi').val();
        let jenis = $('#jenis').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanSatuanKerja') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                nama:nama,
                instansi:instansi,
                jenis:jenis,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelSatuanKerja').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
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
            url: "{{ route('hapusSatuanKerja') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelSatuanKerja').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editSatuanKerja') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nama').val(response.nama);
                $('#instansi').val(response.instansi);
                $('#jenis').val(response.jenis);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#nama').val(null);
        $('#instansi').val(null);
    });

</script>
