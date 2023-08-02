<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cari_perangkatdaerah">Perangkat Daerah</label>
                            <select class="form-control" name="cari_perangkatdaerah" id="cari_perangkatdaerah">
                                <option selected value="all">Semua Perangkat Daerah</option>
                                        @foreach ($perangkatDaerah as $pd)
                                        <option value="{{ $pd->id }}">{{ $pd->nama}}</option>
                                        @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="cari_thl">Nama Tenaga Harian Lepas</label>
                            <input type="text" class="form-control form-control-xs" name="cari_thl" id="cari_thl"
                                placeholder="masukkan nama yang dicari?">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cari_Juli">Juli 2022</label>
                          <select class="form-control" name="cari_Juli" id="cari_Juli">
                            <option value="0">Aman</option>
                            <option value="1">Tidak Aman</option>
                            <option value="all" selected>Semua</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cari_Agustus">Agustus 2022</label>
                          <select class="form-control" name="cari_Agustus" id="cari_Agustus">
                            <option value="0">Aman</option>
                            <option value="1">Tidak Aman</option>
                            <option value="all" selected>Semua</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cari_September">September 2022</label>
                          <select class="form-control" name="cari_September" id="cari_September">
                            <option value="0">Aman</option>
                            <option value="1">Tidak Aman</option>
                            <option value="all" selected>Semua</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cari_Oktober">Oktober 2022</label>
                          <select class="form-control" name="cari_Oktober" id="cari_Oktober">
                            <option value="0">Aman</option>
                            <option value="1">Tidak Aman</option>
                            <option value="all" selected>Semua</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cari_November">November 2022</label>
                          <select class="form-control" name="cari_November" id="cari_November">
                            <option value="0">Aman</option>
                            <option value="1">Tidak Aman</option>
                            <option value="all" selected>Semua</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                          <label for="cari_Desember">Desember 2022</label>
                          <select class="form-control" name="cari_Desember" id="cari_Desember">
                            <option value="0">Aman</option>
                            <option value="1">Tidak Aman</option>
                            <option value="all" selected>Semua</option>
                          </select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-muted">

                <div class="row">
                    <div class="col-md-1">
                        {{-- <div class="form-group"> --}}
                            <select class="custom-select" name="jumlahView" id="jumlahView">
                                <option value="10">10</option>
                                <option selected value="100">100</option>
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
                Daftar Presensi
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelPresensi" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>ID THL</th>
                            <th>Status</th>
                            <th>Nama</th>
                            <th>Unit Kerja</th>
                            <th>Juli</th>
                            <th>Agustus</th>
                            <th>September</th>
                            <th>Oktober</th>
                            <th>November</th>
                            <th>Desember</th>
                            <th>GrandTotal</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Data Presensi
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
                    <h5 class="modal-title"><strong>Tambah Presensi</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label for="idTHL">ID THL</label>
                                <input type="text" name="idTHL" id="idTHL" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" value="-" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cari_perangkatdaerah">Perangkat Daerah</label>
                        <select class="form-control" name="cari_perangkatdaerah" id="cari_perangkatdaerah">
                            <option selected value="">Semua Perangkat Daerah</option>
                                    @foreach ($perangkatDaerah as $pd)
                                    <option value="{{ $pd->id }}">{{ $pd->nama}}</option>
                                    @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiJuli">Juli 2022</label>
                              <select class="form-control" name="presensiJuli" id="presensiJuli">
                                <option value="0">Aman</option>
                                <option value="TK">Tidak Aman</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiAgustus">Agustus 2022</label>
                              <select class="form-control" name="presensiAgustus" id="presensiAgustus">
                                <option value="0">Aman</option>
                                <option value="TK">Tidak Aman</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiSeptember">September 2022</label>
                              <select class="form-control" name="presensiSeptember" id="presensiSeptember">
                                <option value="0">Aman</option>
                                <option value="TK">Tidak Aman</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiOktober">Oktober 2022</label>
                              <select class="form-control" name="presensiOktober" id="presensiOktober">
                                <option value="0">Aman</option>
                                <option value="TK">Tidak Aman</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiNovember">November 2022</label>
                              <select class="form-control" name="presensiNovember" id="presensiNovember">
                                <option value="0">Aman</option>
                                <option value="TK">Tidak Aman</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiDesember">Desember 2022</label>
                              <select class="form-control" name="presensiDesember" id="presensiDesember">
                                <option value="0">Aman</option>
                                <option value="TK">Tidak Aman</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="presensiGrandTotal">Grand Total</label>
                              <input type="text"
                                class="form-control" name="presensiGrandTotal" id="presensiGrandTotal">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                              <label for="status">Status</label>
                              <select class="form-control" name="status" id="status">
                                <option value="AMAN">Aman</option>
                                <option value="DIEVALUASI">Dievaluasi</option>
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
        $('#kotakStatus').hide();
    });

    function loadData(cari_perangkatdaerah, cari_thl, cari_Juli, cari_Agustus, cari_September, cari_Oktober, cari_November, cari_Desember) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelPresensi').DataTable({
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
            // dom: '<lfp<t>fp>',
            dom: '<"wrapper"flipt>',
            buttons: [ 'copy', 'excel', 'pdf' ],
            ajax: {
                // type: "post",
                url: "{{ route('dataPresensi') }}",
                data: {
                    cari_perangkatdaerah: cari_perangkatdaerah,
                    cari_thl:cari_thl,
                    cari_Juli:cari_Juli,
                    cari_Agustus:cari_Agustus,
                    cari_September:cari_September,
                    cari_Oktober:cari_Oktober,
                    cari_November:cari_November,
                    cari_Desember:cari_Desember,
                    jumlahView:jumlahView,
                    },
                },

            columns: [
                {
                data: 'idTHL',
                name: 'idTHL'
                },
                {
                data: 'status',
                name: 'status'
                },
                {
                data: 'nama',
                name: 'nama'
                },
                {
                data: 'perangkatDaerah',
                name: 'perangkatDaerah'
                },
                {
                data: 'presensiJuli',
                name: 'presensiJuli',
                },
                {
                data: 'presensiAgustus',
                name: 'presensiAgustus',
                },
                {
                data: 'presensiSeptember',
                name: 'presensiSeptember',
                },
                {
                data: 'presensiOktober',
                name: 'presensiOktober',
                },
                {
                data: 'presensiNovember',
                name: 'presensiNovember',
                },
                {
                data: 'presensiDesember',
                name: 'presensiDesember',
                },
                {
                data: 'presensiGrandTotal',
                name: 'presensiGrandTotal',
                },
                // {
                // data: 'aksi',
                // name: 'aksi',
                // orderable: false,
                // width:'130px',
                // },
            ],
            rowCallback: function (row, data) {
                if ( data.status != "AMAN" ) {
                    $(row).addClass('bg-danger  ');
                }

            }
        });
    }

    $('#simpan').click(function (e) {
        e.preventDefault();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let id = $('#id').val();
        let idTHL = $('#idTHL').val();
        let nama = $('#nama').val();
        let perangkatDaerah = $('#perangkatDaerah').val();
        let presensiJuli = $('#presensiJuli').val();
        let presensiAgustus = $('#presensiAgustus').val();
        let presensiSeptember = $('#presensiSeptember').val();
        let presensiOktober = $('#presensiOktober').val();
        let presensiNovember = $('#presensiNovember').val();
        let presensiDesember = $('#presensiDesember').val();
        let presensiGrandTotal = $('#presensiGrandTotal').val();
        let status = $('#status').val();

        $.ajax({
            type: "post",
            url: "{{ route('simpanPresensi') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                idTHL:idTHL,
                nama:nama,
                perangkatDaerah:perangkatDaerah,
                presensiJuli:presensiJuli,
                presensiAgustus:presensiAgustus,
                presensiSeptember:presensiSeptember,
                presensiOktober:presensiOktober,
                presensiNovember:presensiNovember,
                presensiDesember:presensiDesember,
                presensiGrandTotal:presensiGrandTotal,
                status:status,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelPresensi').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                $('#idTHL').attr('readonly', false);
                // $('#simpan').attr('disabled', true);
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
            url: "{{ route('hapusPresensi') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelPresensi').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editPresensi') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#idTHL').attr('readonly', true);
                $('#idTHL').val(response.idTHL);
                $('#id').val(response.id);
                $('#idTHL').val(response.idTHL);
                $('#nama').val(response.nama);
                $('#perangkatDaerah').val(response.perangkatDaerah);
                $('#presensiJuli').val(response.presensiJuli);
                $('#presensiAgustus').val(response.presensiAgustus);
                $('#presensiSeptember').val(response.presensiSeptember);
                $('#presensiOktober').val(response.presensiOktober);
                $('#presensiNovember').val(response.presensiNovember);
                $('#presensiDesember').val(response.presensiDesember);
                $('#presensiGrandTotal').val(response.presensiGrandTotal);
                $('#status').val(response.status);
                $('#simpan').text('Update');
                // $('#simpan').attr('disabled', false);
                $('#tambah').click();
            }
        });
    });
    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        // $('#simpan').attr('disabled', true);
        $('#idTHL').attr('readonly', false);
        $('#idTHL').val(null);
        $('#nama').val(null);
        $('#perangkatDaerah').val(null);
        $('#presensiJuli').val(null);
        $('#presensiAgustus').val(null);
        $('#presensiSeptember').val(null);
        $('#presensiOktober').val(null);
        $('#presensiNovember').val(null);
        $('#presensiDesember').val(null);
        $('#presensiGrandTotal').val(null);
        $('#status').val(null);
    });

    $('#cari').click(function (e) {
        e.preventDefault();
        let cari_perangkatdaerah = $('#cari_perangkatdaerah').val();
        let cari_thl = $('#cari_thl').val();

        let cari_Juli = $('#cari_Juli').val();
        let cari_Agustus = $('#cari_Agustus').val();
        let cari_September = $('#cari_September').val();
        let cari_Oktober = $('#cari_Oktober').val();
        let cari_November = $('#cari_November').val();
        let cari_Desember = $('#cari_Desember').val();
        loadData(cari_perangkatdaerah,cari_thl,cari_Juli,cari_Agustus,cari_September,cari_Oktober,cari_November,cari_Desember);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_perangkatdaerah').val("all");
        $('#cari_thl').val(null);
        $('#cari_Juli').val("all");
        $('#cari_Agustus').val("all");
        $('#cari_September').val("all");
        $('#cari_Oktober').val("all");
        $('#cari_November').val("all");
        $('#cari_Desember').val("all");
    });

</script>
