<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Tingkat Pendidikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Daftar Tingkat Pendidikan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelPendidikan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Kode</th>
                            <th>Tingkat Pendidikan</th>
                            <th>Golongan Awal PNS</th>
                            <th>Golongan Akhir PNS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Tingkat Pendidikan
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
                    <h5 class="modal-title"><strong> Tambah Tingkat Pendidikan</strong></h5>
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
                        <label for="nama">Nama Tingkat Pendidikan</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama tingkat pendidikan">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golAwal">Golongan Awal PNS</label>
                                <select class="form-control" name="golAwal" id="golAwal">
                                    @foreach ($golongan as $gol)
                                        <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="golAkhir">Golongan Akhir PNS</label>
                                <select class="form-control" name="golAkhir" id="golAkhir">
                                    @foreach ($golongan as $gol)
                                        <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
        $('#tabelPendidikan').DataTable({
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
            url: "{{ route('masterTKTPendidikan') }}"
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
            data: 'gol-awal',
            name: 'gol-awal',

            },
            {
            data: 'gol-akhir',
            name: 'gol-akhir'
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
        let golAwal = $('#golAwal').val();
        let golAkhir = $('#golAkhir').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanTKTPendidikan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                kode:kode,
                nama:nama,
                golAwal:golAwal,
                golAkhir:golAkhir,

            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelPendidikan').DataTable().ajax.reload(null, false);
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
            url: "{{ route('hapusTKTPendidikan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelPendidikan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editTKTPendidikan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#kode').val(response.kode);
                $('#kode').attr('readonly', true);
                $('#nama').val(response.nama);
                $('#golAwal').val(response.golAwal);
                $('#golAkhir').val(response.golAkhir);
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
        $('#golAwal').val(null);
        $('#golAkhir').val(null);
    });

</script>
