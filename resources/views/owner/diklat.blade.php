<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Diklat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card-deck">
            <div class="card card-success">
                <div class="card-header">
                    Daftar Jenis Diklat
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabeljenisdiklat" class="table table-bordered table-inverse table-xs">
                        <thead class="thead-inverse bg-color-red">
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Diklat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <button id="tambahjenisdiklat" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modaljenisdiklat">
                        Tambah Jenis Diklat
                    </button>
                </div>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    Daftar Diklat Struktural
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabeldiklatstruktural" class="table table-bordered table-inverse table-xs">
                        <thead class="thead-inverse bg-color-red">
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Diklat Struktural</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <button id="tambahdiklatstruktural" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modaldiklatstruktural">
                        Tambah Jenis Diklat Struktural
                    </button>
                </div>
            </div>
        </div>


    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modaljenisdiklat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title"><strong> Tambah Jenis Diklat</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kodejenisdiklat">Kode</label>
                        <input type="text" name="kodejenisdiklat" id="kodejenisdiklat" class="form-control" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="jenisdiklat">jenisdiklat</label>
                        <input type="text" name="jenisdiklat" id="jenisdiklat" class="form-control"
                            placeholder="Masukkan nama jenisdiklat">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutupjenisdiklat" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpanjenisdiklat" name="simpanjenisdiklat" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaldiklatstruktural" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title"><strong> Tambah Jenis Diklat Struktural</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kodediklatstruktural">Kode</label>
                        <input type="text" name="kodediklatstruktural" id="kodediklatstruktural" class="form-control" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="diklatstruktural">Nama Diklat Struktural</label>
                        <input type="text" name="diklatstruktural" id="diklatstruktural" class="form-control"
                            placeholder="Masukkan jenis diklat struktural">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutupdiklatstruktural" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpandiklatstruktural" name="simpandiklatstruktural" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@stack('js')

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        loadDatajenisdiklat();
        loadDatadiklatstruktural();
    });

    function loadDatajenisdiklat() {
        $('#tabeljenisdiklat').DataTable({
        serverside: true,
        processing: true,
        orderClasses: true,
        deferRender: true,
        paging: false,
        select: true,
        stateSave: true,
        bDestroy: true,
        dom: '<B<t>',
        buttons: [ 'copy', 'excel', 'pdf' ],
        ajax: {
            url: "{{ route('datajenisdiklat') }}"
            },
            columns: [{
            data: 'id_siasn',
            name: 'id_siasn'
            },
            {
            data: 'jenisdiklat',
            name: 'jenisdiklat'
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
    function loadDatadiklatstruktural() {
        $('#tabeldiklatstruktural').DataTable({
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
            url: "{{ route('datadiklatstruktural') }}"
            },
            columns: [{
            data: 'id_siasn',
            name: 'id_siasn'
            },
            {
            data: 'diklatstruktural',
            name: 'diklatstruktural'
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


    $('#simpanjenisdiklat').click(function (e) {
        e.preventDefault();
        let kodejenisdiklat = $('#kodejenisdiklat').val();
        let mode = ($('#simpanjenisdiklat').text() == 'Save') ? 'save' : 'edit';
        let jenisdiklat = $('#jenisdiklat').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanjenisdiklat') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id_siasn:kodejenisdiklat,
                jenisdiklat:jenisdiklat,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabeljenisdiklat').DataTable().ajax.reload(null, false);
                $('#simpanjenisdiklat').text('Save');
                $('#kodejenisdiklat').attr('readonly', false);
                $('#tutupjenisdiklat').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });
    $('#simpandiklatstruktural').click(function (e) {
        e.preventDefault();
        let kodediklatstruktural = $('#kodediklatstruktural').val();
        let mode = ($('#simpandiklatstruktural').text() == 'Save') ? 'save' : 'edit';
        let diklatstruktural = $('#diklatstruktural').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpandiklatstruktural') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id_siasn:kodediklatstruktural,
                diklatstruktural:diklatstruktural,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabeldiklatstruktural').DataTable().ajax.reload(null, false);
                $('#simpandiklatstruktural').text('Save');
                $('#kodediklatstruktural').attr('readonly', false);
                $('#tutupdiklatstruktural').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus-jenisdiklat', function(event) {
        let kodejenisdiklat = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusjenisdiklat') }}",
            data: {
                id_siasn: kodejenisdiklat,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabeljenisdiklat').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click', '.hapus-diklatstruktural', function(event) {
        let kodediklatstruktural = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusdiklatstruktural') }}",
            data: {
                id_siasn: kodediklatstruktural,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabeldiklatstruktural').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-jenisdiklat', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editjenisdiklat') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kodejenisdiklat').val(response.id_siasn);
                $('#kodejenisdiklat').attr('readonly', true);
                $('#jenisdiklat').val(response.jenisdiklat);
                $('#simpanjenisdiklat').text('Update');
                $('#tambahjenisdiklat').click();
            }
        });
    });

    $(document).on('click','.edit-diklatstruktural', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editdiklatstruktural') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kodediklatstruktural').val(response.id_siasn);
                $('#kodediklatstruktural').attr('readonly', true);
                $('#diklatstruktural').val(response.diklatstruktural);
                $('#simpandiklatstruktural').text('Update');
                $('#tambahdiklatstruktural').click();
            }
        });
    });

    $('#tutupjenisdiklat').click(function (e) {
        $('#simpanjenisdiklat').text('Save');
        $('#kodejenisdiklat').val(null);
        $('#kodejenisdiklat').attr('readonly', false);
        $('#jenisdiklat').val(null);
    });

    $('#tutupdiklatstruktural').click(function (e) {
        $('#simpandiklatstruktural').text('Save');
        $('#kodediklatstruktural').val(null);
        $('#kodediklatstruktural').attr('readonly', false);
        $('#diklatstruktural').val(null);
    });
</script>
