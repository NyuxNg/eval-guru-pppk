<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pendidikan') }}
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
                                    <label for="cari_idtktPendidikan">Tingkat Pendidikan</label>
                                    <select class="form-control" name="cari_idtktPendidikan" id="cari_idtktPendidikan">
                                        <option selected value="">Semua tingkat pendidikan</option>
                                        @foreach ($tktPendidikan as $tkt)
                                        <option value="{{ $tkt->kode }}">{{ $tkt->kode . ' ' . $tkt->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="cariJurusan">Jurusan/Program Studi</label>
                                    <input type="text" class="form-control" name="cariJurusan" id="cariJurusan"
                                        placeholder="Masukkan nama pendidikan yang dicari">
                                </div>
                            </div>
                        </div>

                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cariSekolah">Nama Sekolah/Kampus/Universitas</label>
                                    <input type="text" class="form-control" name="cariSekolah" id="cariSekolah"
                                        placeholder="Masukkan nama pendidikan yang dicari">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cariLokasi">Lokasi Pendidikan</label>
                                        <input type="text" class="form-control" name="cariLokasi" id="cariLokasi"
                                            placeholder="Masukkan tempat pendidikan yang dicari">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cari_tglAwal">Tgl. Awal Pendidikan</label>
                            <input type="text" name="cari_tglAwal" id="cari_tglAwal" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                            data-target="#cari_tglAwal" placeholder="yyyy-mm-dd" value="2023-01-01">
                        </div><div class="form-group">
                            <label for="cari_tglAkhir">Tgl. Akhir Pendidikan</label>
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
                Daftar Riwayat Pendidikan
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelRwpendidikan" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse">
                        <tr>
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Jenjang / Jurusan</th>
                            <th>Nama Sekolah</th>
                            <th>Lokasi</th>
                            <th>Pendidikan Awal</th>
                            <th>Tahun Lulus</th>
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
                    <h5 class="modal-title"><strong>Tambah Riwayat Pendidikan</strong></h5>
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
                                <label for="idtktPendidikan">Tingkat Pendidikan</label>
                                <select class="form-control" name="idtktPendidikan" id="idtktPendidikan">
                                    @foreach ($tktPendidikan as $tkt)
                                    <option value="{{ $tkt->id }}" data="{{ $tkt->kode }}">{{ $tkt->kode . ' ' . $tkt->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="hidden" name="idPendidikan" id="idPendidikan">
                                <label for="cariPendidikan">Pendidikan</label>
                                <input type="text" name="cariPendidikan" id="cariPendidikan" class="form-control" placeholder="Pendidikan">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="namaSekolah">Nama Sekolah</label>
                                <input type="text" name="namaSekolah" id="namaSekolah" class="form-control" placeholder="Nama sekolah">
                            </div>
                        </div>
                    </div>
                  <div class="row sk-pertek">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="noIjazah">Nomor Ijazah</label>
                                <input type="text" name="noIjazah" id="noIjazah" class="form-control" placeholder="Nomor Ijazah">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tglLulus">Tanggal Lulus</label>
                                <input type="text" name="tglLulus" id="tglLulus" class="form-control datetimepicker-input" data-toggle="datetimepicker"
                                data-target="#tglLulus" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="thnLulus">Tahun Lulus</label>
                                <input readonly type="text" name="thnLulus" id="thnLulus" class="form-control" placeholder="Tahun lulus">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi Pendidikan">
                            </div>
                        </div>

                    </div>
                    <div class="row ak-mkg">
                        <div class="col md-2">
                            <div class="form-group">
                                <label for="pendAwal">Pendidikan Awal CPNS/PNS</label>
                                <select class="custom-select" name="pendAwal" id="pendAwal">
                                    <option selected value=0>Bukan</option>
                                    <option value=1>Ya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="glrDepan">Gelar Depan</label>
                                <input type="text" name="glrDepan" id="glrDepan" class="form-control"
                                    placeholder="Gelar depan">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="glrBelakang">Gelar Belakang</label>
                                <input type="text" name="glrBelakang" id="glrBelakang" class="form-control"
                                    placeholder="Gelar belakang">
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

    function loadData(cari_nip_baru, nama, cari_idtktPendidikan, cariJurusan, cariSekolah, cariLokasi, cari_tglAwal, cari_tglAkhir) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelRwpendidikan').DataTable({
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
            url: "{{ route('dataRwpendidikan') }}",
            data: {
                nip_baru: cari_nip_baru,
                nama:nama,
                cari_idtktPendidikan:cari_idtktPendidikan,
                cariJurusan:cariJurusan,
                cariSekolah:cariSekolah,
                cariLokasi:cariLokasi,
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
                data: 'namaPendidikan',
                name: 'namaPendidikan'
                },
                {
                data: 'namaSekolah',
                name: 'namaSekolah',

                },
                {
                data: 'lokasi',
                name: 'lokasi'
                },
                {
                data: 'pendAwal',
                name: 'pendAwal'
                },
                {
                data: 'thnLulus',
                name: 'thnLulus'
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
        let tglLulus = $('#tglLulus').val();
        let thnLulus = $('#thnLulus').val();
        let noIjazah = $('#noIjazah').val();
        let namaSekolah = $('#namaSekolah').val();
        let lokasi = $('#lokasi').val();
        let glrDepan = $('#glrDepan').val();
        let glrBelakang = $('#glrBelakang').val();
        let pendAwal = $('#pendAwal').val();
        let idOrang = $('#idOrang').val();
        let idPendidikan = $('#idPendidikan').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanRwpendidikan') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                tglLulus:tglLulus,
                thnLulus:thnLulus,
                noIjazah:noIjazah,
                namaSekolah:namaSekolah,
                lokasi:lokasi,
                glrDepan:glrDepan,
                glrBelakang:glrBelakang,
                pendAwal:pendAwal,
                idOrang:idOrang,
                idPendidikan:idPendidikan,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelRwpendidikan').DataTable().ajax.reload(null, false);
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

    $(document).on('click', '.hapus-pendidikan', function(event) {
        let kode = $(this).attr('id');
        $.ajax({
            type: "post",
            url: "{{ route('hapusRwpendidikan') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelRwpendidikan').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click','.edit-pendidikan', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editRwpendidikan') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#nip_baru').attr('readonly', true);
                $('#nip_baru').val(response.nip_baru);
                $('#namalengkap').val(response.namalengkap);
                $('#idOrang').val(response.idOrang);
                $('#id').val(response.id);
                $('#tglLulus').val(response.tglLulus);
                $('#thnLulus').val(response.thnLulus);
                $('#noIjazah').val(response.noIjazah);
                $('#namaSekolah').val(response.namaSekolah);
                $('#lokasi').val(response.lokasi);
                $('#glrDepan').val(response.glrDepan);
                $('#glrBelakang').val(response.glrBelakang);
                $('#pendAwal').val(response.pendAwal);
                $('#idPendidikan').val(response.idPendidikan);
                $('#idtktPendidikan').val(response.tktPendidikan);
                $('#cariPendidikan').val(response.namaPendidikan);
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
        $('#tglLulus').val(null);
        $('#thnLulus').val(null);
        $('#noIjazah').val(null);
        $('#namaSekolah').val(null);
        $('#lokasi').val(null);
        $('#glrDepan').val(null);
        $('#glrBelakang').val(null);
        $('#pendAwal').val(null);
        $('#idOrang').val(null);
        $('#idPendidikan').val(null);
        $('#idtktPendidikan').val(null);
        $('#cariPendidikan').val(null);
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
        let cari_idtktPendidikan = $('#cari_idtktPendidikan').val();
        let cariJurusan = $('#cariJurusan').val();
        let cariSekolah = $('#cariSekolah').val();
        let cariLokasi = $('#cariLokasi').val();
        let cari_tglAwal = $('#cari_tglAwal').val();
        let cari_tglAkhir = $('#cari_tglAkhir').val();
        loadData(cari_nip_baru, carinama, cari_idtktPendidikan, cariJurusan, cariSekolah, cariLokasi, cari_tglAwal, cari_tglAkhir);
    });

    $('#reset').click(function (e) {
        e.preventDefault();
        $('#cari_nip_baru').val(null);
        $('#carinama').val(null);
        $('#cari_idtktPendidikan').val(null);
        $('#cariJurusan').val(null);
        $('#cariSekolah').val(null);
        $('#cariLokasi').val(null);
        $('#cari_tglAwal').val(null);
        $('#cari_tglAkhir').val(null);
    });

    $('#tglLulus').blur(function (e) {
        e.preventDefault();
        let tglLulus = $(this).val();
        thnLulus = tglLulus.substr(0,4);
        $('#thnLulus').val(thnLulus);
    });

    $('#cariPendidikan').autocomplete({
        appendTo: "#modelId",
        source:function(request, response) {
            // let kodeTKT =
            $.ajax({
                // type: "post",
                url: "{{ route('cariPendidikan') }}",
                data: {
                    // _token: "{{ csrf_token() }}",
                    cariPendidikan: request.term,
                    kodeTKT: $('#idtktPendidikan').val()
                },
                success: function (data) {
                    response(data)
                }
            });
        },
        select:function (event, ui) {
            $('#cariPendidikan').val(ui.item.label);
            $('#idPendidikan').val(ui.item.value);
            return false;
         },
         focus: function(event, ui){
            $( "#cariPendidikan" ).val( ui.item.label );
            return false;
         }
    });
</script>
