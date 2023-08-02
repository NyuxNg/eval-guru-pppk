<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Hukuman Disiplin') }}
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cari_tktHukdisiplin">Tingkat Hukuman Disiplin</label>
                                    <select class="form-control" name="cari_tktHukdisiplin" id="cari_tktHukdisiplin">
                                        <option selected value="">Semua Tingkat</option>
                                        @foreach ($tingkatHukdis as $tkt)
                                        <option value="{{ $tkt->id }}">{{ $tkt->kode . ' ' . $tkt->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                            <label for="cari_jenisHukdisiplin">Jenis Hukuman Disiplin</label>
                            <select class="form-control" name="cari_jenisHukdisiplin" id="cari_jenisHukdisiplin">
                                <option selected value="">Semua Jenis Hukuman Disiplin</option>
                                @foreach ($jenishukuman as $jns)
                                <option value="{{ $jns->id }}">{{ $jns->kode . ' ' . $jns->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                            </div>
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
                            <label for="cari_tglAwal">Tgl. Awal SK</label>
                            <input type="text" name="cari_tglAwal" id="cari_tglAwal" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                            data-target="#cari_tglAwal" placeholder="yyyy-mm-dd" value="2023-01-01">
                        </div><div class="form-group">
                            <label for="cari_tglAkhir">Tgl. Akhir SK</label>
                            <input type="text" name="cari_tglAkhir" id="cari_tglAkhir" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                            data-target="#cari_tglAkhir" placeholder="yyyy-mm-dd" value="2023-12-31">
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
                                <option >Pilih</option>
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
                Daftar Riwayat Hukuman Disiplin
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelRwhukdisiplin" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Tingkat Hukuman</th>
                            <th>Jenis Hukuman</th>
                            <th>Tanggal SK</th>
                            <th>PP Nomor</th>
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
                    <h5 class="modal-title"><strong>Tambah Riwayat Hukuman Disiplin</strong></h5>
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
                                <input type="hidden" name="id" id="id">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input type="text" name="namalengkap" id="namalengkap" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idGolongan">Golongan</label>
                                <select class="form-control" name="idGolongan" id="idGolongan">
                                     @foreach ($golongan as $gol)
                                    <option value="{{ $gol->id }}">{{ $gol->golPNS . ' ' . $gol->pangkatPNS}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="idHukdis">Jenis Hukuman Disiplin</label>
                            <select class="form-control" name="idHukdis" id="idHukdis">
                                @foreach ($jenishukuman as $jns)
                                <option value="{{ $jns->id }}">{{ '('. $jns->tkthukdis . ') - ' . $jns->nama}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                   <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skNomor">Nomor SK</label>
                                <input type="text" name="skNomor" id="skNomor" class="form-control" placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="skTanggal">Tanggal SK</label>
                                <input type="text" name="skTanggal" id="skTanggal" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#skTanggal" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="skPembatalan">SK Pembatalan</label>
                                <input type="text" name="skPembatalan" id="skPembatalan" class="form-control"
                                    placeholder="Nomor SK">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglSkbatal">Tanggal SK</label>
                                <input type="text" name="tglSkbatal" id="tglSkbatal" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#tglSkbatal" placeholder="yyyy-mm-dd">
                            </div>
                        </div>

                    </div>
                  <div class="row sk-pertek">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="ppNomor">Aturan Hukum</label>
                                <input type="text" name="ppNomor" id="ppNomor" class="form-control" placeholder="Aturan yang mengatur">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglMulai">Tanggal Mulai</label>
                                <input type="text" name="tglMulai" id="tglMulai" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tglMulai" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglAkhir">Tanggal Akhir</label>
                                <input type="text" name="tglAkhir" id="tglAkhir" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tglAkhir" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="masaTahun">Masa Tahun</label>
                                <input type="text" name="masaTahun" id="masaTahun" class="form-control" placeholder="Masa Tahun">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="masaBulan">Masa Bulan</label>
                                <input type="text" name="masaBulan" id="masaBulan" class="form-control" placeholder="Masa Bulan">
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

    function loadData(cari_nip_baru, nama, cari_tktHukdisiplin, cari_jenisHukdisiplin, cari_golAwal, cari_golAkhir, cari_tglAwal, cari_tglAkhir) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelRwhukdisiplin').DataTable({
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
            url: "{{ route('dataRwhukdisiplin') }}",
            data: {
                nip_baru: cari_nip_baru,
                nama:nama,
                cari_tktHukdisiplin:cari_tktHukdisiplin,
                cari_jenisHukdisiplin:cari_jenisHukdisiplin,
                cari_golAwal:cari_golAwal,
                cari_golAkhir:cari_golAkhir,
                cari_tglAwal:cari_tglAwal,
                cari_tglAkhir:cari_tglAkhir,
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
                data: 'tingkatHukuman',
                name: 'tingkatHukuman'
                },
                {
                data: 'jenisHukuman',
                name: 'jenisHukuman'
                },
                {
                data: 'skTanggal',
                name: 'skTanggal',

                },
                {
                data: 'ppNomor',
                name: 'ppNomor'
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
        let tglMulai = $('#tglMulai').val();
        let tglAkhir = $('#tglAkhir').val();
        let masaTahun = $('#masaTahun').val();
        let masaBulan = $('#masaBulan').val();
        let ppNomor = $('#ppNomor').val();
        let skPembatalan = $('#skPembatalan').val();
        let tglSkbatal = $('#tglSkbatal').val();
        let idOrang = $('#idOrang').val();
        let idHukdis = $('#idHukdis').val();
        let idGolongan = $('#idGolongan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwhukdisiplin') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                skNomor:skNomor,
                skTanggal:skTanggal,
                tglMulai:tglMulai,
                tglAkhir:tglAkhir,
                masaTahun:masaTahun,
                masaBulan:masaBulan,
                ppNomor:ppNomor,
                skPembatalan:skPembatalan,
                tglSkbatal:tglSkbatal,
                idOrang:idOrang,
                idHukdis:idHukdis,
                idGolongan:idGolongan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwhukdisiplin').DataTable().ajax.reload(null, false);
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

    $(document).on('click', '.hapus-hukdis', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwhukdisiplin') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwhukdisiplin').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-hukdis', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwhukdisiplin') }}",
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
                $('#tglMulai').val(response.tglMulai);
                $('#tglAkhir').val(response.tglAkhir);
                $('#masaTahun').val(response.masaTahun);
                $('#masaBulan').val(response.masaBulan);
                $('#ppNomor').val(response.ppNomor);
                $('#skPembatalan').val(response.skPembatalan);
                $('#tglSkbatal').val(response.tglSkbatal);
                $('#idOrang').val(response.idOrang);
                $('#idHukdis').val(response.idHukdis);
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
        $('#tglMulai').val(null);
        $('#tglAkhir').val(null);
        $('#masaTahun').val(null);
        $('#masaBulan').val(null);
        $('#ppNomor').val(null);
        $('#skPembatalan').val(null);
        $('#tglSkbatal').val(null);
        $('#idOrang').val(null);
        $('#idHukdis').val(null);
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
        let cari_tktHukdisiplin = $('#cari_tktHukdisiplin').val();
        let cari_jenisHukdisiplin = $('#cari_jenisHukdisiplin').val();
        let cari_golAwal = $('#cari_golAwal').val();
        let cari_golAkhir = $('#cari_golAkhir').val();
        let cari_tglAwal = $('#cari_tglAwal').val();
        let cari_tglAkhir = $('#cari_tglAkhir').val();
        loadData(cari_nip_baru, carinama, cari_tktHukdisiplin, cari_jenisHukdisiplin, cari_golAwal, cari_golAkhir, cari_tglAwal, cari_tglAkhir);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nip_baru').val(null);
        $('#carinama').val(null);
        $('#cari_tktHukdisiplin').val(null);
        $('#cari_jenisHukdisiplin').val(null);
        $('#cari_golAwal').val(null);
        $('#cari_golAkhir').val(null);
        $('#cari_tglAwal').val(null);
        $('#cari_tglAkhir').val(null);
    });

</script>
