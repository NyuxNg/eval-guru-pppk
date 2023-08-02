<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Golongan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Golongan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelGolongan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse bg-color-red">
                        <tr>
                            <th>Kode</th>
                            <th>Golongan</th>
                            <th>Ruang</th>
                            <th>Gol. PNS</th>
                            <th>Gol. PPPK</th>
                            <th>Pangkat PNS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Golongan
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
                    <h5 class="modal-title"><strong> Tambah Golongan</strong></h5>
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
                        <label for="golongan">Golongan</label>
                        <select class="form-control" name="golongan" id="golongan">
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ruang">Ruang</label>
                        <select class="form-control" name="ruang" id="ruang">
                            <option value="a">a</option>
                            <option value="b">b</option>
                            <option value="c">c</option>
                            <option value="d">d</option>
                            <option value="e">e</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golPNS">Golongan PNS</label>
                                <input readonly type="text" class="form-control" name="golPNS" id="golPNS"
                                    aria-describedby="helpId" placeholder="Golongan PNS">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golPPPK">Golongan PPPK</label>
                                <input readonly type="text" class="form-control" name="golPPPK" id="golPPPK"
                                    aria-describedby="helpId" placeholder="Golongan PPPK">

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pangkatPNS">Pangkat</label>
                        <input type="text" name="pangkatPNS" id="pangkatPNS" class="form-control"
                            placeholder="Masukkan Pangkat">
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
        $('#tabelGolongan').DataTable({
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
            url: "{{ route('masterGolongan') }}"
            },
            columns: [{
            data: 'kode',
            name: 'kode'
            },
            {
            data: 'golongan',
            name: 'golongan'
            },
            {
            data: 'ruang',
            name: 'ruang'
            },
            {
            data: 'golPNS',
            name: 'golPNS'
            },
            {
            data: 'golPPPK',
            name: 'golPPPK'
            },
            {
            data: 'pangkatPNS',
            name: 'pangkat'
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

    $(document).on('blur','#golongan, #ruang', function () {
        let golPNS = $('#golongan').val() + '/' + $('#ruang').val() ;
        $('#golPNS').val(golPNS);
    });

    $('#simpan').click(function (e) {
        e.preventDefault();
        let kode = $('#kode').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        $('#golPPPK').attr('readonly', true);
        let golongan = $('#golongan').val();
        let ruang = $('#ruang').val();
        let golPNS = $('#golPNS').val();
        let golPPPK = $('#golPPPK').val();
        let pangkatPNS = $('#pangkatPNS').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanGolongan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                kode:kode,
                golongan:golongan,
                ruang:ruang,
                golPNS:golPNS,
                golPPPK:golPPPK,
                pangkatPNS:pangkatPNS,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelGolongan').DataTable().ajax.reload(null, false);
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
            url: "{{ route('hapusGolongan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelGolongan').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editGolongan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kode').val(response.kode);
                $('#kode').attr('readonly', true);
                $('#golongan').val(response.golongan);
                $('#ruang').val(response.ruang);
                $('#golPNS').val(response.golPNS);
                $('#golPPPK').val(response.golPPPK);
                $('#golPPPK').attr('readonly', false);
                $('#pangkatPNS').val(response.pangkatPNS);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });

    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#kode').val(null);
        $('#kode').attr('readonly', false);
        $('#golPPPK').attr('readonly', true);
        $('#golongan').val(null);
        $('#ruang').val(null);
        $('#pangkatPNS').val(null);
        $('#golPNS').val(null);
        $('#golPPPK').val(null);
    });
</script>
