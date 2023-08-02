<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Jenis Unit Organisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Jenis Unit Organisasi
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabeljenisunor" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Jenis Unor</th>
                            <th>Batas Usia Pensiun</th>
                            <th>Jenis Jabatan Pimpinan Unor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Jenis Unit Organisasi
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
                    <h5 class="modal-title"><strong> Tambah Jenis Unit Organisasi</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="nama">Jenis Unit Organisasi</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Jenis unit organisasi">
                    </div>
                    <div class="form-group">
                        <label for="bup">Batas Usia Pensiun</label>
                        <select class="form-control" name="bup" id="bup">
                            <option value="58">58 Tahun</option>
                            <option value="60">60 Tahun</option>
                            <option value="65">65 Tahun</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idKategoriJabatan">Jenis Jabatan</label>
                        <select class="form-control" name="idKategoriJabatan" id="idKategoriJabatan">
                            @foreach ($jenisJab as $tkt)
                                <option value="{{ $tkt->id }}">{{ $tkt->jenis }}</option>
                            @endforeach
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
        $('#tabeljenisunor').DataTable({
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
            url: "{{ route('masterJenisunor') }}"
            },
            columns: [
            {
            data: 'nama',
            name: 'nama'
            },
            {
            data: 'bup',
            name: 'bup'
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
        let id = $('#id').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let nama = $('#nama').val();
        let bup = $('#bup').val();
        let idKategoriJabatan = $('#idKategoriJabatan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanJenisunor') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                nama:nama,
                bup:bup,
                idKategoriJabatan:idKategoriJabatan,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabeljenisunor').DataTable().ajax.reload(null, false);
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
            url: "{{ route('hapusJenisunor') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabeljenisunor').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editJenisunor') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#id').val(response.id);
                // $('#kode').attr('readonly', true);
                $('#nama').val(response.nama);
                $('#bup').val(response.bup);
                $('#idKategoriJabatan').val(response.idKategoriJabatan);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#id').val(null);
        // $('#kode').attr('readonly', false);
        $('#nama').val(null);
        $('#bup').val(null);
        $('#idKategoriJabatan').val(null);
    });

</script>
