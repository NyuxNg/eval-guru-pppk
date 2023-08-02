<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Jabatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_nip_baru">NIP Baru</label>
                            <input type="text" class="form-control form-control-xs" name="cari_nip_baru" id="cari_nip_baru"
                                placeholder="Masukkan NIP yang dicari">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="carinama">Nama Pegawai Negeri Sipil</label>
                            <input type="text" class="form-control" name="carinama" id="carinama" placeholder="Masukkan nama yang dicari">
                        </div>
                    </div>

                </div>
                <div>
                </div>
            </div>
            <div class="card-footer text-muted">

                <div class="row">
                    <div class="col-md-1">
                        {{-- <div class="form-group"> --}}
                            <select class="custom-select" name="jumlahView" id="jumlahView">
                                <option>Pilih</option>
                                <option selected value="10">10</option>
                                <option value="100">100</option>
                                <option value="500">500</option>
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
                Daftar Riwayat Jabatan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelRwjabatan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis</th>
                            <th>Jabatan</th>
                            <th>Unit Kerja</th>
                            <th>Eselon</th>
                            <th>TMT</th>
                            <th>Satuan Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Riwayat
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
                    <h5 class="modal-title"><strong>Tambah Riwayat Jabatan</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="idOrang" id="idOrang">
                                <label for="nip_baru">NIP Baru</label>
                                <input type="text" name="nip_baru" id="nip_baru" class="form-control" placeholder="Masukkan NIP Baru">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input type="text" name="namalengkap" id="namalengkap" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="idUnor">
                        <label for="unitKerjaText">Unit Kerja</label>
                        <input type="text" name="unitKerjaText" id="unitKerjaText" class="form-control"
                            placeholder="Unit Kerja">
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="idJabatan">
                        <label for="namaJabatan">Jabatan</label>
                        <input type="text" name="namaJabatan" id="namaJabatan" class="form-control"
                            placeholder="Jabatan">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idKategoriJabatan">Jenis Jabatan</label>
                                <select class="form-control" name="idKategoriJabatan" id="idKategoriJabatan">
                                    @foreach ($kategoriJabatan as $kj)
                                    <option value="{{ $kj->id }}">{{ $kj->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="idEselon">Eselon</label>
                                <select class="form-control" name="idEselon" id="idEselon">
                                    @foreach ($eselon as $es)
                                    <option value="{{ $es->id }}">{{ $es->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skNomor">Nomor SK</label>
                                <input type="text" name="skNomor" id="skNomor" class="form-control" placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="skTanggal">Tanggal SK</label>
                                <input type="text" name="skTanggal" id="skTanggal" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#skTanggal" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                    </div>

                  <div class="row sk-pertek">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tmtJabatan">TMT Jabatan</label>
                                <input type="text" name="tmtJabatan" id="tmtJabatan" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tmtJabatan" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tmtPelantikan">Pelantikan</label>
                                <input type="text" class="form-control datetimepicker-input" id="tmtPelantikan" data-toggle="datetimepicker"
                                    data-target="#tmtPelantikan" placeholder="yyyy-mm-dd"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="hidden" name="idSatuanKerja" id="idSatuanKerja">
                                <label for="satuanKerja">Satuan Kerja</label>
                                <input type="text" name="satuanKerja" id="satuanKerja" class="form-control" placeholder="Satuan Kerja">
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

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#simpan').attr('disabled', true);
        $('.datetimepicker-input').datetimepicker({
            locale: 'id',
            format: 'L',
            viewMode: 'months',
            format: 'YYYY-MM-DD'
        });

    });

    function loadData(cari_nip_baru, carinama) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelRwjabatan').DataTable({
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
            url: "{{ route('dataRwjabatan') }}",
            data: {
                nip_baru: cari_nip_baru,
                carinama:carinama,
                jumlahView:jumlahView,
                },
            },

            columns: [{
                data: 'nip_baru',
                name: 'nip_baru'
                },
                {
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'jenis',
                name: 'jenis'
                },
                {
                data: 'jabatan',
                name: 'jabatan'
                },
                {
                data: 'unitKerjaText',
                name: 'unitKerjaText',

                },
                {
                data: 'eselon',
                name: 'eselon'
                },
                {
                data: 'tmtJabatan',
                name: 'tmtJabatan'
                },
                {
                data: 'namaSatker',
                name: 'namaSatker'
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
        let idOrang = $('#idOrang').val();
        let idUnor = $('#idUnor').val();
        let unitKerjaText = $('#unitKerjaText').val();
        let idKategoriJabatan = $('#idKategoriJabatan').val();
        let idJabatan = $('#idJabatan').val();
        let idEselon = $('#idEselon').val();
        let tmtJabatan = $('#tmtJabatan').val();
        let skNomor = $('#skNomor').val();
        let skTanggal = $('#skTanggal').val();
        let idSatuanKerja = $('#idSatuanKerja').val();
        let tmtPelantikan = $('#tmtPelantikan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwjabatan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                idOrang:idOrang,
                idUnor:idUnor,
                unitKerjaText:unitKerjaText,
                idKategoriJabatan:idKategoriJabatan,
                idJabatan:idJabatan,
                idEselon:idEselon,
                tmtJabatan:tmtJabatan,
                skNomor:skNomor,
                skTanggal:skTanggal,
                idSatuanKerja:idSatuanKerja,
                tmtPelantikan:tmtPelantikan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwjabatan').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#nip_baru').attr('readonly', false);
                $('#simpan').attr('disabled', true);
                $('#tutup').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    $(document).on('click', '.hapus-jab', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwjabatan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwjabatan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-jab', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwjabatan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru').attr('readonly', true);
                $('#nip_baru').val(response.nip_baru);
                $('#namalengkap').val(response.namalengkap);
                $('#id').val(response.id);
                $('#idOrang').val(response.idOrang);
                $('#idUnor').val(response.idUnor);
                $('#unitKerjaText').val(response.unitKerjaText);
                $('#idKategoriJabatan').val(response.idKategoriJabatan);
                $('#idJabatan').val(response.idJabatan);
                $('#namaJabatan').val(response.namaJabatan);
                $('#idEselon').val(response.idEselon);
                $('#tmtJabatan').val(response.tmtJabatan);
                $('#skNomor').val(response.skNomor);
                $('#skTanggal').val(response.skTanggal);
                $('#idSatuanKerja').val(response.idSatuanKerja);
                $('#satuanKerja').val(response.namaSatuanKerja);
                $('#tmtPelantikan').val(response.tmtPelantikan);
                $('#simpan').text('Update');$('#simpan').attr('disabled', false);
                $('#tambah').click();
            }
        });
    });

    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#simpan').attr('disabled', true);
        $('#nip_baru').attr('readonly', false);
        $('#id').val(null);
        $('#nip_baru').val(null);
        $('#namalengkap').val(null);
        $('#idOrang').val(null);
        $('#idUnor').val(null);
        $('#unitKerjaText').val(null);
        $('#idKategoriJabatan').val(null);
        $('#idJabatan').val(null);
        $('#namaJabatan').val(null);
        $('#idEselon').val(null);
        $('#tmtJabatan').val(null);
        $('#skNomor').val(null);
        $('#skTanggal').val(null);
        $('#idSatuanKerja').val(null);
        $('#tmtPelantikan').val(null);
    });

    $('#nip_baru').blur(function (e) {
        let nip_baru = $(this).val();
        // e.preventDefault();
        $.ajax({
            type: "get",
            url: "{{ route('pegawai.cariNIPBaru') }}",
            data: {
                nip_baru: nip_baru
            },
            success: function (response) {
                console.log(response);
                $('#idOrang').val(response.pns_id);
                $('#namalengkap').val(response.namalengkap);
                $('#simpan').attr('disabled', false);
            }
        });
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_nip_baru = $('#cari_nip_baru').val();
        let carinama = $('#carinama').val();
        loadData(cari_nip_baru, carinama);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nip_baru').val(null);
        $('#carinama').val(null);
    });

    $('#namaJabatan').autocomplete({
        appendTo: "#modelId",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariJabatan') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariJabatan: request.term,
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#namaJabatan').val(ui.item.label);
            $('#idJabatan').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#namaJabatan" ).val( ui.item.label );
            return false;
         }
    });
    $('#satuanKerja').autocomplete({
        appendTo: "#modelId",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariSatuankerja') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariSatuankerja: request.term,
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#satuanKerja').val(ui.item.label);
            $('#idSatuanKerja').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#satuanKerja" ).val( ui.item.label );
            return false;
         }
    });

</script>
