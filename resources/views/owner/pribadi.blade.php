<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Pribadi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card-deck">
            <div class="card card-success">
                <div class="card-header">
                    Daftar Agama
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabelAgama" class="table table-bordered table-inverse table-xs">
                        <thead class="thead-inverse bg-color-red">
                            <tr>
                                <th>Kode</th>
                                <th>Nama Agama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <button id="tambahAgama" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelAgama">
                        Tambah Agama
                    </button>
                </div>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    Daftar Status Nikah
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabelStatus" class="table table-bordered table-inverse table-xs">
                        <thead class="thead-inverse bg-color-red">
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Status Nikah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <button id="tambahStatus" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelStatus">
                        Tambah Status Nikah
                    </button>
                </div>
            </div>
        </div>


    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modelAgama" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong> Tambah Agama</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kodeagama">Kode</label>
                        <input type="text" name="kodeagama" id="kodeagama" class="form-control" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" name="agama" id="agama" class="form-control"
                            placeholder="Masukkan nama agama">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutupAgama" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpanAgama" name="simpanAgama" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modelStatus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong> Tambah Jenis Status Nikah</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kodestatus">Kode</label>
                        <input type="text" name="kodestatus" id="kodestatus" class="form-control" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="status">Jenis Status</label>
                        <input type="text" name="status" id="status" class="form-control"
                            placeholder="Masukkan jenis status nikah">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutupStatus" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpanStatus" name="simpanStatus" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stack('js')

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        loadDataAgama();
        loadDataStatus();
    });

    function loadDataAgama() {
        $('#tabelAgama').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<B<t>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            url: "{{ route('dataAgama') }}"
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
            data: 'aksi',
            name: 'aksi',
            orderable: false,
            width: '130px',
            },
            ]
            })
    }
    function loadDataStatus() {
        $('#tabelStatus').DataTable({
        serverside: true,
        processing: true,
        orderClasses: false,
        deferRender: true,
        paging: true,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<B<t>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            url: "{{ route('datastatusnikah') }}"
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
            data: 'aksi',
            name: 'aksi',
            orderable: false,
            width: '130px',
            },
            ]
            })
    }


    $('#simpanAgama').click(function (e) {
        e.preventDefault();
        let kodeagama = $('#kodeagama').val();
        let mode = ($('#simpanAgama').text() == 'Save') ? 'save' : 'edit';
        let agama = $('#agama').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanAgama') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                kodeagama:kodeagama,
                agama:agama,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelAgama').DataTable().ajax.reload(null, false);
                $('#simpanAgama').text('Save');
                $('#kodeagama').attr('readonly', false);
                $('#tutupAgama').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });
    $('#simpanStatus').click(function (e) {
        e.preventDefault();
        let kodestatus = $('#kodestatus').val();
        let mode = ($('#simpanStatus').text() == 'Save') ? 'save' : 'edit';
        let status = $('#status').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanStatus') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                kodestatus:kodestatus,
                status:status,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelStatus').DataTable().ajax.reload(null, false);
                $('#simpanStatus').text('Save');
                $('#kodestatus').attr('readonly', false);
                $('#tutupStatus').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapusagama', function(event) {
        let kodeagama = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusAgama') }}",
            data: {
                kodeagama: kodeagama,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelAgama').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click', '.hapusstatus', function(event) {
        let kodestatus = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusStatus') }}",
            data: {
                kodestatus: kodestatus,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelStatus').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.editagama', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editAgama') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kodeagama').val(response.kode);
                $('#kodeagama').attr('readonly', true);
                $('#agama').val(response.nama   );
                $('#simpanAgama').text('Update');
                $('#tambahAgama').click();
            }
        });
    });

    $(document).on('click','.editstatus', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editStatus') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kodestatus').val(response.kode);
                $('#kodestatus').attr('readonly', true);
                $('#status').val(response.nama);
                $('#simpanStatus').text('Update');
                $('#tambahStatus').click();
            }
        });
    });

    $('#tutupAgama').click(function (e) {
        $('#simpanAgama').text('Save');
        $('#kodeagama').val(null);
        $('#kodeagama').attr('readonly', false);
        $('#agama').val(null);
    });

    $('#tutupStatus').click(function (e) {
        $('#simpanStatus').text('Save');
        $('#kodestatus').val(null);
        $('#kodestatus').attr('readonly', false);
        $('#status').val(null);
    });
</script>
