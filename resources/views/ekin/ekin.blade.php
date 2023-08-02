<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data E-Kinerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-success">
            <div class="card-header">
                Data E-Kinerja
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tabelEkin" class="table table-bordered table-inverse table-xs">
                    <thead class="thead-inverse bg-color-red">
                        <tr>
                            <th>Kirim</th>
                            <th>Tanggal</th>
                            <th>Kegiatan Tahunan</th>
                            <th>Uraian Kegiatan</th>
                            <th>Kualitas</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                <button id="tambah" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modelId">
                    Tambah Ekin
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
                    <h5 class="modal-title"><strong> Tambah E-Kinerja</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <label for="xtglRealisasi">Tanggal Realisasi</label>
                                <input type="text" name="xtglRealisasi" id="xtglRealisasi" class="form-control datetimepicker-input"
                                    data-toggle="datetimepicker" data-target="#xtglRealisasi" placeholder="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="xkualitas">xKualitas</label>
                                <input type="text" class="form-control" name="xkualitas" id="xkualitas" aria-describedby="helpId"
                                    value="99.6">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="xwaktu">xWaktu</label>
                                <input type="text" class="form-control" name="xwaktu" id="xwaktu" aria-describedby="helpId" value="7.5">

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="xfkKegiatanTahunan">Kegiatan Tahunan</label>
                        <select class="form-control" multiple name="xfkKegiatanTahunan" id="xfkKegiatanTahunan" size="12">
                            <option value="801061">DPA - Penyusunan Rencana Kebutuhan, Jenis, dan Jumlah Jabatan untuk Pengadaan ASN</option>
                            <option value="801062">DPA - Koordinasi dan Fasilitasi Pengadaan ASN</option>
                            <option value="801063">DPA - Koordinasi Pelaksanaan Administrasi Pemberhentian</option>
                            <option value="801064">DPA - Fasilitasi Lembaga Profesi ASN</option>
                            <option value="801065">DPA - Pengelolaan Sistem Informasi Kepegawaian</option>
                            <option value="801066">DPA - Pengelolaan Data Kepegawaian</option>
                            <option value="801067">Tupoksi - Penyusunan dan Penetapan Kebutuhan ASN</option>
                            <option value="801068">Tupoksi - Pengadaan ASN</option>
                            <option value="801069">Tupoksi - Pemberhentian ASN</option>
                            <option value="801070">Tupoksi - Jaminan Pensiun dan Jaminan Hari Tua</option>
                            <option value="801071">Tupoksi - Sistem Informasi ASN</option>
                            <option value="808642">Tugas Tambahan - Melaksanakan tugas kedinasan lain yang diperintahkan pimpinan baik secara lisan maupun tertulis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="xuraianKegiatan">Uraian Kegiatan</label>
                        <textarea class="form-control" name="xuraianKegiatan" id="xuraianKegiatan" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="tutup" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" id="ekinModal" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelEkin">
      Launch
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modelEkin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="https://e-kinerja.pangkepkab.go.id/_pengajuanRealisasi/update.php"
                method="post" enctype="multipart/form-data" id="form_data" target="blank">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kirim Ekin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                          <input type="hidden" class="form-control" name="act" id="act" >
                        <div class="form-group">
                          <label for="tglRealisasi">Tanggal</label>
                          <input type="text" class="form-control" name="tglRealisasi" id="tglRealisasi" >
                        </div>
                          <input type="hidden" class="form-control" name="fkKegiatanTahunan" id="fkKegiatanTahunan" >
                        <div class="form-group">
                          <label for="uraianKegiatan">Kegiatan</label>
                          <textarea class="form-control" name="uraianKegiatan" id="uraianKegiatan" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><div class="form-group">
                          <label for="kualitas">Kualitas</label>
                          <input type="text" class="form-control" name="kualitas" id="kualitas" value="99,45">
                        </div></div>
                            <div class="col-md-3"><div class="form-group">
                          <label for="waktu">Waktu</label>
                          <input type="text" class="form-control" name="waktu" id="waktu" value="7,5">
                        </div></div>
                            <div class="col-md-3"><div class="form-group">
                          <label for="tahun">Tahun</label>
                          <input readonly type="text" class="form-control" name="tahun" id="tahun" >
                        </div></div>
                            <div class="col-md-3"><div class="form-group">
                          <label for="bulan">Bulan</label>
                          <input readonly type="text" class="form-control" name="bulan" id="bulan" >
                        </div></div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
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
        $('#ekinModal').hide();
        $('.datetimepicker-input').datetimepicker({
            locale: 'id',
            format: 'L',
            // viewMode: 'months',
            format: 'YYYY-MM-DD'
        });
    });

    function loadData() {
        $('#tabelEkin').DataTable({
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
            url: "{{ route('masterEkin') }}"
            },
            columns: [
            {
            data: 'kirim',
            name: 'kirim'
            },
            {
            data: 'tglRealisasi',
            name: 'tglRealisasi'
            },
            {
            data: 'kegiatanTahunan',
            name: 'kegiatanTahunan'
            },
            {
            data: 'uraianKegiatan',
            name: 'uraianKegiatan'
            },
            {
            data: 'kualitas',
            name: 'kualitas'
            },
            {
            data: 'waktu',
            name: 'waktu'
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
        let id = $('#id').val();
        let mode = ($('#simpan').text() == 'Save') ? 'save' : 'edit';
        let tglRealisasi = $('#xtglRealisasi').val();
        let fkKegiatanTahunan = $('#xfkKegiatanTahunan').val();
            fkKegiatanTahunan = fkKegiatanTahunan.toString();
        let uraianKegiatan = $('#xuraianKegiatan').val();
        let kualitas = $('#xkualitas').val();
        let waktu = $('#xwaktu').val();
        $.ajax({
            type: "post",
            url: "{{ route('simpanEkin') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                id:id,
                tglRealisasi:tglRealisasi,
                fkKegiatanTahunan:fkKegiatanTahunan,
                uraianKegiatan:uraianKegiatan,
                kualitas:kualitas,
                waktu:waktu,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelEkin').DataTable().ajax.reload(null, false);
                $('#simpan').text('Save');
                // $('#kode').attr('readonly', false);
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
            url: "{{ route('hapusEkin') }}",
            data: {
                kode: kode,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                toastr.success(res.text, 'Sukses');
                $('#tabelEkin').DataTable().ajax.reload();
            }
        });
    });

    $(document).on('click','.edit', function () {
        let id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "{{ route('editEkin') }}",
            data: {
                id:id,
            },
            success: function (response) {
                $('#id').val(response.id);
                $('#xtglRealisasi').val(response.tglRealisasi);
                $('#xfkKegiatanTahunan').val(response.fkKegiatanTahunan);
                $('#xuraianKegiatan').val(response.uraianKegiatan);
                $('#xkualitas').val(response.kualitas);
                $('#xwaktu').val(response.waktu);
                $('#simpan').text('Update');
                $('#tambah').click();
            }
        });
    });

    function setDesimal(nilai) {
        num1 = parseFloat(nilai).toFixed(2);

        // Replace dot with a comma
        var num2 = num1.replace(/\./g, ',');
        num3 = nilai.replace(".", ",");
        return num3;

    }

    $(document).on('click','.kirim', function () {
        let id = $(this).attr('id');
        // $.ajax({
        //     type: "post",
        //     url: "{{ route('hapusEkin') }}",
        //     data: {
        //         kode: id,
        //         _token: "{{ csrf_token() }}"
        //     },
        //     success: function(res) {
        //         toastr.success(res.text, 'Sukses');
        //         $('#tabelEkin').DataTable().ajax.reload();
        //     }
        // });
        $.ajax({
            type: "get",
            url: "{{ route('editEkin') }}",
            data: {
                id:id,
            },
            success: function (response) {
                let act = 'add';
                let id = null;
                let tglRealisasi = response.tglRealisasi;
                let fkKegiatanTahunan = response.fkKegiatanTahunan;
                let uraianKegiatan = response.uraianKegiatan;
                let kualitas = setDesimal(response.kualitas) ;
                let waktu = setDesimal(response.waktu);
                let tahun = parseInt(tglRealisasi.substr(0, 4)) ;
                let bulan = parseInt(tglRealisasi.substr(5, 2)) ;

                $('#act').val(act);
                $('#tglRealisasi').val(tglRealisasi);
                $('#fkKegiatanTahunan').val(fkKegiatanTahunan);
                $('#uraianKegiatan').val(uraianKegiatan);
                $('#kualitas').val(kualitas);
                $('#waktu').val(waktu);
                $('#tahun').val(tahun);
                $('#bulan').val(bulan);

                $('#ekinModal').click();
            }
        });
    });

    $('#tutup').click(function (e) {
        $('#simpan').text('Save');
        $('#id').val(null);
        $('#xtglRealisasi').val(null);
        $('#xfkKegiatanTahunan').val(null);
        $('#xuraianKegiatan').val(null);
        // $('#xkualitas').val(null);
        // $('#xwaktu').val(null);
    });
</script>
