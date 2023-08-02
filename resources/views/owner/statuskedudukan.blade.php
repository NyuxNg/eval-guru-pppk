<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Status Kedudukan ASN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Status Kedudukan ASN
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelStatuskedudukan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Kode</th>
                            <th>Status Kedudukan</th>
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
                    Tambah Status Kedudukan ASN
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
                    <h5 class="modal-title"><strong> Tambah Status Kedudukan</strong></h5>
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
                        <label for="nama">Nama Status Kedudukan</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama status kedudukan ASN">
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
        $('#tabelStatuskedudukan').DataTable({
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
            url: "{{ route('masterStatuskedudukan') }}"
            },
            columns: [{
            data: 'kode',
            name: 'kode'
            },
            {
            data: 'nama',
            name: 'nama'
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
        let kode = $('#kode').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let nama = $('#nama').val();
        let keterangan = $('#keterangan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanStatuskedudukan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                kode:kode,
                nama:nama,
                keterangan:keterangan,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelStatuskedudukan').DataTable().ajax.reload(null, false);
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
            url: "{{ route('hapusStatuskedudukan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelStatuskedudukan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editStatuskedudukan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kode').val(response.kode);
                $('#kode').attr('readonly', true);
                $('#nama').val(response.nama);
                $('#keterangan').text(response.keterangan);
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
        $('#keterangan').val(null);
    });

</script>
