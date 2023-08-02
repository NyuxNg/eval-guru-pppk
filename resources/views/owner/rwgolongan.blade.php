<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Golongan/Kenaikan Pangkat') }}
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
                        <div class="form-group">
                          <label for="carinama">Nama</label>
                          <input type="text"
                            class="form-control" name="carinama" id="carinama" placeholder="Masukkan nama yang dicari">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cari_idJeniskp">Jenis Kenaikan Pangkat</label>
                            <select class="form-control" name="cari_idJeniskp" id="cari_idJeniskp">
                                <option selected value="">Semua jenis Kenaikan Pangkat</option>
                                @foreach ($jeniskp as $kp)
                                <option value="{{ $kp->id }}">{{ $kp->kode . ' ' . $kp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cari_golAwal">Golongan Awal</label>
                                    <select class="form-control" name="cari_golAwal" id="cari_golAwal">
                                        <option selected value=""></option>
                                        @foreach ($golongan as $gol)
                                        <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cari_golAkhir">Golongan Akhir</label>
                                    <select class="form-control" name="cari_golAkhir" id="cari_golAkhir">
                                        <option selected value=""></option>
                                        @foreach ($golongan as $gol)
                                        <option value="{{ $gol->kode }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_skAwal">TMT Awal SK</label>
                            <input type="text" name="cari_skAwal" id="cari_skAwal" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                            data-target="#cari_skAwal" placeholder="yyyy-mm-dd" value="2023-01-01">
                        </div><div class="form-group">
                            <label for="cari_skAkhir">TMT Akhir SK</label>
                            <input type="text" name="cari_skAkhir" id="cari_skAkhir" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                            data-target="#cari_skAkhir" placeholder="yyyy-mm-dd" value="2023-12-31">
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
                Daftar Riwayat Golongan/KP
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelRwgolongan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Golongan</th>
                            <th>Jenis KP</th>
                            <th>TMT</th>
                            <th>MKG Tahun</th>
                            <th>MKG Bulan</th>
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
                    <h5 class="modal-title"><strong>Tambah Riwayat Golongan</strong></h5>
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

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idGolongan">Golongan/Pangkat</label>
                                <select class="form-control" name="idGolongan" id="idGolongan">
                                    @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="idJeniskp">Jenis Kenaikan Pangkat</label>
                                <select class="form-control" name="idJeniskp" id="idJeniskp">
                                    @foreach ($jeniskp as $kp)
                                    <option value="{{ $kp->id }}">{{ $kp->kode . ' ' . $kp->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                  <div class="row sk-pertek">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pertekNomor">Nomor Pertek</label>
                                <input type="text" name="pertekNomor" id="pertekNomor" class="form-control" placeholder="Nomor Pertek">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="pertekTanggal">Tanggal Pertek</label>
                                <input type="text" name="pertekTanggal" id="pertekTanggal" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#pertekTanggal" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col md-2">
                            <div class="form-group">
                                <label for="tmt">TMT</label>
                                <input type="text" class="form-control datetimepicker-input" id="tmt" data-toggle="datetimepicker"
                                    data-target="#tmt" placeholder="yyyy-mm-dd"/>
                            </div>
                        </div>
                    </div>




                    <div class="row ak-mkg">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="akUtama">AK Utama</label>
                                <input type="text" name="akUtama" id="akUtama" class="form-control"
                                    placeholder="AK Utama">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="akTambahan">AK Tambahan</label>
                                <input type="text" name="akTambahan" id="akTambahan" class="form-control"
                                    placeholder="AK Tambahan">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mkGolTahun">MKG (Tahun)</label>
                                <input type="text" name="mkGolTahun" id="mkGolTahun" class="form-control"
                                    placeholder="Tahun MKG">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mkGolBulan">MKG (Bulan)</label>
                                <input type="text" name="mkGolBulan" id="mkGolBulan" class="form-control"
                                    placeholder="Bulan MKG">
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
        $('#simpan').attr('disabled', true);
        $('.datetimepicker-input').datetimepicker({
            locale: 'id',
            format: 'L',
            viewMode: 'months',
            format: 'YYYY-MM-DD'
        });

    });

    function loadData(cari_nip_baru, nama, jeniskp, cari_golAwal, cari_golAkhir, cari_skAwal, cari_skAkhir) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelRwgolongan').DataTable({
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
            url: "{{ route('dataRwgolongan') }}",
            data: {
                nip_baru: cari_nip_baru,
                nama:nama,
                jeniskp:jeniskp,
                cari_golAwal:cari_golAwal,
                cari_golAkhir:cari_golAkhir,
                cari_skAwal:cari_skAwal,
                cari_skAkhir:cari_skAkhir,
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
                data: 'golPNS',
                name: 'golPNS'
                },
                {
                data: 'jenisKP',
                name: 'jenisKP',

                },
                {
                data: 'tmt',
                name: 'tmt'
                },
                {
                data: 'mkGolTahun',
                name: 'mkGolTahun'
                },
                {
                data: 'mkGolBulan',
                name: 'mkGolBulan'
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
        let skNomor = $('#skNomor').val();
        let skTanggal = $('#skTanggal').val();
        let pertekNomor = $('#pertekNomor').val();
        let pertekTanggal = $('#pertekTanggal').val();
        let tmt = $('#tmt').val();
        let akUtama = $('#akUtama').val();
        let akTambahan = $('#akTambahan').val();
        let mkGolTahun = $('#mkGolTahun').val();
        let mkGolBulan = $('#mkGolBulan').val();
        let idOrang = $('#idOrang').val();
        let idJeniskp = $('#idJeniskp').val();
        let idGolongan = $('#idGolongan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwgolongan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                skNomor:skNomor,
                skTanggal:skTanggal,
                pertekNomor:pertekNomor,
                pertekTanggal:pertekTanggal,
                tmt:tmt,
                akUtama:akUtama,
                akTambahan:akTambahan,
                mkGolTahun:mkGolTahun,
                mkGolBulan:mkGolBulan,
                idOrang:idOrang,
                idJeniskp:idJeniskp,
                idGolongan:idGolongan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwgolongan').DataTable().ajax.reload(null, false);
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

    $(document).on('click', '.hapus-gol', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwgolongan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwgolongan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-gol', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwgolongan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru').attr('readonly', true);
                $('#nip_baru').val(response.nip_baru);
                $('#namalengkap').val(response.namalengkap);
                $('#id').val(response.id);
                $('#skNomor').val(response.skNomor);
                $('#skTanggal').val(response.skTanggal);
                $('#pertekNomor').val(response.pertekNomor);
                $('#pertekTanggal').val(response.pertekTanggal);
                $('#tmt').val(response.tmt);
                $('#akUtama').val(response.akUtama);
                $('#akTambahan').val(response.akTambahan);
                $('#mkGolTahun').val(response.mkGolTahun);
                $('#mkGolBulan').val(response.mkGolBulan);
                $('#idOrang').val(response.idOrang);
                $('#idJeniskp').val(response.idJeniskp);
                $('#idGolongan').val(response.idGolongan);
                $('#simpan').text('Update');$('#simpan').attr('disabled', false);
                $('#tambah').click();
            }
        });
    });

    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#simpan').attr('disabled', true);
        $('#nip_baru').attr('readonly', false);
        $('#nip_baru').val(null);
        $('#namalengkap').val(null);
        $('#skNomor').val(null);
        $('#skTanggal').val(null);
        $('#pertekNomor').val(null);
        $('#pertekTanggal').val(null);
        $('#tmt').val(null);
        $('#akUtama').val(null);
        $('#akTambahan').val(null);
        $('#mkGolTahun').val(null);
        $('#mkGolBulan').val(null);
        $('#idOrang').val(null);
        $('#idJeniskp').val(null);
        $('#idGolongan').val(null);
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
        let jeniskp = $('#cari_idJeniskp').val();
        let cari_golAwal = $('#cari_golAwal').val();
        let cari_golAkhir = $('#cari_golAkhir').val();
        let cari_skAwal = $('#cari_skAwal').val();
        let cari_skAkhir = $('#cari_skAkhir').val();
        loadData(cari_nip_baru, carinama, jeniskp, cari_golAwal, cari_golAkhir, cari_skAwal, cari_skAkhir);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nip_baru').val(null);
        $('#carinama').val(null);
        $('#cari_idJeniskp').val(null);
        $('#cari_golAwal').val(null);
        $('#cari_golAkhir').val(null);
        $('#cari_skAwal').val(null);
        $('#cari_skAkhir').val(null);
    });

</script>
