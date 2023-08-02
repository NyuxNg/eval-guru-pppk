<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Eselon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Eselon
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabeleselon" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Kode Eselon</th>
                            <th>Eselon</th>
                            <th>Jenis Jabatan</th>
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
                    Tambah Jenis Eselon
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
                    <h5 class="modal-title"><strong> Tambah Jenis Eselon</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kode">Kode Eselon</label>
                                <input type="text" name="kode" id="kode" class="form-control" placeholder="Kode Eselon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Eselon</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Eselon">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="idKategoriJabatan">Jenis Jabatan</label>
                        <select class="form-control" name="idKategoriJabatan" id="idKategoriJabatan">
                            @foreach ($jenisJab as $tkt)
                                <option value="{{ $tkt->id }}">{{ $tkt->jenis }}</option>
                            @endforeach
                            {{-- <option value="Non Eselon">Non Eselon</option> --}}
                        </select>
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
        $('#tabeleselon').DataTable({
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
            url: "{{ route('masterEselon') }}"
            },
            columns: [
            {
            data: 'kode',
            name: 'kode'
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
        let id = $('#id').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let kode = $('#kode').val();
        let nama = $('#nama').val();
        let keterangan = $('#keterangan').val();
        let idKategoriJabatan = $('#idKategoriJabatan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanEselon') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                kode:kode,
                nama:nama,
                keterangan:keterangan,
                idKategoriJabatan:idKategoriJabatan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabeleselon').DataTable().ajax.reload(null, false);
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
            url: "{{ route('hapusEselon') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabeleselon').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editEselon') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#id').val(response.id);
                $('#kode').attr('readonly', true);
                $('#kode').val(response.kode);
                $('#nama').val(response.nama);
                $('#keterangan').val(response.keterangan);
                $('#idKategoriJabatan').val(response.idKategoriJabatan);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#id').val(null);
        $('#kode').attr('readonly', false);
        $('#kode').val(null);
        $('#nama').val(null);
        $('#keterangan').val(null);
        $('#idKategoriJabatan').val(null);
    });

</script>
