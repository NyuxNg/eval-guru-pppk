<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Diklat') }}
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
                            <label for="cari_jenisdiklat">Jenis Diklat</label>
                            <select class="form-control" name="cari_jenisdiklat" id="cari_jenisdiklat">
                                <option selected value="">Semua jenis diklat</option>
                                @foreach ($jenisdiklat as $diklat)
                                <option value="{{ $diklat->id }}">{{ $diklat->id_siasn . '. ' . $diklat->jenisdiklat}}</option>
                                @endforeach
                            </select>
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
                Daftar Riwayat Diklat
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelRwdiklat" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Diklat</th>
                            <th>Nama Diklat</th>
                            <th>Penyelenggara</th>
                            <th>Jumlah Jam</th>
                            <th>Tahun</th>
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
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title"><strong>Tambah Riwayat Diklat</strong></h5>
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
                                <label for="jenis_diklat_id">Jenis Diklat</label>
                                <select class="form-control" name="jenis_diklat_id" id="jenis_diklat_id">
                                    @foreach ($jenisdiklat as $diklat)
                                    <option value="{{ $diklat->id }}">{{ $diklat->id_siasn . '. ' . $diklat->jenisdiklat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">

                            <div id="namadiklat2" class="form-group">
                                <label for="diklatstruktural">Kelompok Diklat Strukural</label>
                                <select class="form-control" name="diklatstruktural" id="diklatstruktural">
                                    @foreach ($diklatstruktural as $diklat)
                                    <option value="{{ $diklat->id }}">{{ $diklat->diklatstruktural }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="namadiklat1" class="form-group">
                                <label for="diklat_nama">Nama Diklat</label>
                                <input type="text" name="diklat_nama" id="diklat_nama" class="form-control" placeholder="Nama Pelatihan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_sertipikat">Nomor Sertifikat</label>
                                <input type="text" name="nomor_sertipikat" id="nomor_sertipikat" class="form-control" placeholder="Nomor Sertifikat">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_sertipikat">Tanggal</label>
                                <input type="text" name="tanggal_sertipikat" id="tanggal_sertipikat" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tanggal_sertipikat" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tanggal_mulai" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="text" class="form-control datetimepicker-input" id="tanggal_selesai" data-toggle="datetimepicker"
                                    data-target="#tanggal_selesai" placeholder="yyyy-mm-dd"/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="text" name="tahun" id="tahun" class="form-control"
                                    placeholder="Tahun">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jumlah_jam">Jumlah JP</label>
                                <input type="text" name="jumlah_jam" id="jumlah_jam" class="form-control"
                                    placeholder="Jumlah JP">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="durasi_hari">Lama Hari</label>
                                <input type="text" name="durasi_hari" id="durasi_hari" class="form-control"
                                    placeholder="Lama Hari">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bobot_kompetensi">Bobot Kompetensi</label>
                                <input type="text" name="bobot_kompetensi" id="bobot_kompetensi" class="form-control" placeholder="Bobot">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="jenis_kompetensi">Jenis Kompetensi</label>
                                <input type="text" name="jenis_kompetensi" id="jenis_kompetensi" class="form-control"
                                    placeholder="Jenis Kompetensi">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="institusi_penyelenggara">Penyelenggara</label>
                                <input type="text" name="institusi_penyelenggara" id="institusi_penyelenggara" class="form-control" placeholder="Institusi penyelenggara">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="hidden" name="instansi_id" id="instansi_id">
                                <label for="satuanKerja">Satuan Kerja</label>
                                <input type="text" name="satuanKerja" id="satuanKerja" class="form-control" placeholder="Satuan Kerja">
                            </div>
                        </div>
                    </div>

                    {{-- Field yang berasal dari API SIASN, belum ketahuan untuk apa --}}
                    <input type="hidden" name="jenis_kursus_id" id="jenis_kursus_id" placeholder="Jenis kursus" value="0">
                    <input type="hidden" name="path" id="path" value="0">
                    <input type="hidden" name="tipe" id="tipe" value="0">
                    <input type="hidden" name="id_riwayat_update" id="id_riwayat_update" value="0">
                    <input type="hidden" name="jenis_kursus_sertipikat" id="jenis_kursus_sertipikat" value="0">
                    {{-- Akhir API SIASN --}}

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
        $('#jenis_diklat_id').val(null);
        $('#diklatstruktural').val(null);
    });

    function loadData(cari_nip_baru, carinama, cari_jenisdiklat) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelRwdiklat').DataTable({
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
            url: "{{ route('dataRwdiklat') }}",
            data: {
                nip_baru: cari_nip_baru,
                nama:carinama,
                cari_jenisdiklat:cari_jenisdiklat,
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
                data: 'jenisdiklat',
                name: 'jenisdiklat'
                },
                {
                data: 'diklat_nama',
                name: 'diklat_nama'
                },
                {
                data: 'institusi_penyelenggara',
                name: 'institusi_penyelenggara',

                },
                {
                data: 'jumlah_jam',
                name: 'jumlah_jam'
                },
                {
                data: 'tahun',
                name: 'tahun'
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

        let jenis_diklat_id = $('#jenis_diklat_id').val();
        let diklat_nama = $('#diklat_nama').val();
        let diklatstruktural = $('#diklatstruktural').val();
        let latihan_struktural_id;
        if (jenis_diklat_id !== '1cdb79be-fdc0-45ce-bb13-cd1c1ad13c0c') {
            $('#diklatstruktural').val(null);
        } else {
            latihan_struktural_id = diklatstruktural;
        }

        let nomor_sertipikat = $('#nomor_sertipikat').val();
        let tanggal_sertipikat = $('#tanggal_sertipikat').val();
        let bobot_kompetensi = $('#bobot_kompetensi').val();
        let jenis_kompetensi = $('#jenis_kompetensi').val();
        let institusi_penyelenggara = $('#institusi_penyelenggara').val();
        let jumlah_jam = $('#jumlah_jam').val();
        let durasi_hari = $('#durasi_hari').val();
        let tanggal_mulai = $('#tanggal_mulai').val();
        let tanggal_selesai = $('#tanggal_selesai').val();
        let tahun = $('#tahun').val();
        let jenis_kursus_id = $('#jenis_kursus_id').val();
        let path = $('#path').val();
        let tipe = $('#tipe').val();
        let id_riwayat_update = $('#id_riwayat_update').val();
        let jenis_kursus_sertipikat = $('#jenis_kursus_sertipikat').val();
        let idOrang = $('#idOrang').val();
        // let latihan_struktural_id = $('#latihan_struktural_id').val();
        let instansi_id = $('#instansi_id').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwdiklat') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                diklat_nama:diklat_nama,
                nomor_sertipikat:nomor_sertipikat,
                tanggal_sertipikat:tanggal_sertipikat,
                bobot_kompetensi:bobot_kompetensi,
                jenis_kompetensi:jenis_kompetensi,
                institusi_penyelenggara:institusi_penyelenggara,
                jumlah_jam:jumlah_jam,
                durasi_hari:durasi_hari,
                tanggal_mulai:tanggal_mulai,
                tanggal_selesai:tanggal_selesai,
                tahun:tahun,
                jenis_kursus_id:jenis_kursus_id,
                path:path,
                tipe:tipe,
                id_riwayat_update:id_riwayat_update,
                jenis_kursus_sertipikat:jenis_kursus_sertipikat,
                idOrang:idOrang,
                jenis_diklat_id:jenis_diklat_id,
                latihan_struktural_id:latihan_struktural_id,
                instansi_id:instansi_id,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwdiklat').DataTable().ajax.reload(null, false);
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

    $(document).on('click', '.hapus-diklat', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwdiklat') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwdiklat').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-diklat', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwdiklat') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru').attr('readonly', true);
                $('#nip_baru').val(response.nip_baru);
                $('#namalengkap').val(response.namalengkap);
                $('#id').val(response.id);
                $('#diklat_nama').val(response.diklat_nama);
                $('#nomor_sertipikat').val(response.nomor_sertipikat);
                $('#tanggal_sertipikat').val(response.tanggal_sertipikat);
                $('#bobot_kompetensi').val(response.bobot_kompetensi);
                $('#jenis_kompetensi').val(response.jenis_kompetensi);
                $('#institusi_penyelenggara').val(response.institusi_penyelenggara);
                $('#jumlah_jam').val(response.jumlah_jam);
                $('#durasi_hari').val(response.durasi_hari);
                $('#tanggal_mulai').val(response.tanggal_mulai);
                $('#tanggal_selesai').val(response.tanggal_selesai);
                $('#tahun').val(response.tahun);
                $('#jenis_kursus_id').val(response.jenis_kursus_id);
                $('#path').val(response.path);
                $('#tipe').val(response.tipe);
                $('#id_riwayat_update').val(response.id_riwayat_update);
                $('#jenis_kursus_sertipikat').val(response.jenis_kursus_sertipikat);
                $('#idOrang').val(response.idOrang);
                $('#jenis_diklat_id').val(response.jenis_diklat_id);
                setDiklat(response.jenis_diklat_id);
                $('#diklatstruktural').val(response.latihan_struktural_id);
                $('#instansi_id').val(response.instansi_id);
                $('#satuanKerja').val(response.namaSatuanKerja);
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
        $('#diklat_nama').val(null);
        $('#nomor_sertipikat').val(null);
        $('#tanggal_sertipikat').val(null);
        $('#bobot_kompetensi').val(null);
        $('#jenis_kompetensi').val(null);
        $('#institusi_penyelenggara').val(null);
        $('#jumlah_jam').val(null);
        $('#durasi_hari').val(null);
        $('#tanggal_mulai').val(null);
        $('#tanggal_selesai').val(null);
        $('#tahun').val(null);
        // $('#jenis_kursus_id').val(null);
        // $('#path').val(null);
        // $('#tipe').val(null);
        // $('#id_riwayat_update').val(null);
        // $('#jenis_kursus_sertipikat').val(null);
        $('#idOrang').val(null);
        $('#jenis_diklat_id').val(null);
        $('#diklatstruktural').val(null);
        $('#instansi_id').val(null);
        $('#satuanKerja').val(null);
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
        let carijenisdiklat = $('#cari_jenisdiklat').val();
        loadData(cari_nip_baru, carinama, carijenisdiklat);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nip_baru').val(null);
        $('#carinama').val(null);
        $('#cari_jenisdiklat').val(null);
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
            $('#instansi_id').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#satuanKerja" ).val( ui.item.label );
            return false;
         }
    });

    $('#jenis_diklat_id').change(function (e) {
        e.preventDefault();
        // Jika jenis diklat struktural
        setDiklat($(this).val());
    });

    function setDiklat(jenis) {
        if (jenis == '1cdb79be-fdc0-45ce-bb13-cd1c1ad13c0c') {
            // $('#namadiklat1').hide();
            $('#namadiklat2').show();
        } else {
            // $('#namadiklat1').show();
            $('#namadiklat2').hide();
        }
    }

</script>
