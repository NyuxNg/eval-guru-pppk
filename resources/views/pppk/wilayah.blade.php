<link href="{{ asset('css/cardDatatabel.css') }}" rel="stylesheet">

<x-app-layout>
    {{-- @push('styles') --}}
    {{-- @endpush --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data PPPK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Wilayah/Kecamatan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="display: block;">
                                <ul class="nav nav-pills flex-column">
                                    @foreach ($wilayah as $kec)
                                        <li class="nav-item">
                                            <a href="#" class="nav-link wilayah" data="{{ $kec->wilayah }}">
                                                <i class="fas fa-thumbtack"></i> &nbsp;&nbsp; {{ $kec->wilayah }}
                                                <span class="badge bg-warning float-right">{{ $kec->total }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Linearitas Jabatan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0" style="display: block;">
                                <div class="chart">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand">
                                            <div class=""></div>
                                        </div>
                                        <div class="chartjs-size-monitor-shrink">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 250px;" class="chartjs-render-monitor" width="250" height="250"></canvas>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-10">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">PPPK Lingkup Wilayah Kecamatan <b><span  id="namaWilayah"></span></b></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-2">

                                <div class="table-responsive mailbox-messages">
                                    <table id="tabelPPPK" class="table table-xs cards table-striped table-bordered" cellspacing="0" width="100%" style="margin: 0 auto;">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>dataPPPK</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>



    <!-- Modal Form Penilaian-->
    <div class="modal fade" id="penilaianModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header bg-teal">
              <h5 class="modal-title" id="modalTitle"></h5>
              {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> --}}
            </div>
            <div class="modal-body">

                    <div class="card">
                        <div class="card-header bg-dark">
                            <i class="fas fa-tasks"></i>
                            <strong>Penilaian Disiplin</strong>
                            <div class="card-tools mt-2">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="kejujuran">Kejujuran</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="idOrang" id="idOrang">
                                            <input type="text" class="form-control slider-green slider" name="kejujuran" id="kejujuran" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="tanggungJawab">Tanggung Jawab</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="tanggungJawab" id="tanggungJawab" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="kehadiran">Kehadiran</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="kehadiran" id="kehadiran" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="kesetiaan">Kesetiaan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="kesetiaan" id="kesetiaan" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="etikaPerilaku">Etika/Perilaku</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" name="etikaPerilaku" id="etikaPerilaku" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="float: right;" for="catatanDisiplin">Catatan Evaluasi Disiplin</label>
                                        <textarea class="form-control" name="catatanDisiplin" id="catatanDisiplin" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark">
                            <i class="fas fa-diagnoses"></i>
                            <strong>Penilaian Kinerja</strong>
                            <div class="card-tools mt-2">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label" for="admPerencanaan">Administrasi Perencanaan Pembelajaran</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="admPerencanaan" id="admPerencanaan" aria-describedby="helpId"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label" for="pelaksanaan">Pelaksanaan Pembelajaran (PBM)</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" name="pelaksanaan" id="pelaksanaan"
                                                aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label" for="admPenilaian">Administrasi Penilaian Pembelajaran</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" name="admPenilaian" id="admPenilaian"
                                                aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label" for="rekapitulasiPKG">Rekapitulasi Hasil PKG</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" name="rekapitulasiPKG" id="rekapitulasiPKG"
                                                aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label mb-0" for="skp">Sasaran Kinerja Pegawai</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-sm" name="skp" id="skp" aria-describedby="helpId"
                                                placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label style="float: right;" for="catatanKinerja">Catatan Evaluasi Kinerja</label>
                                        <textarea class="form-control" name="catatanKinerja" id="catatanKinerja" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label bg-amber-300">
                            <input style="transform: scale(2);" type="checkbox" name="rekomendasi" id="rekomendasi">&nbsp;&nbsp; Memenuhi Kriteria Perpanjangan Kontrak
                        </label>
                    </div>
                </div>
                <div>
                    <button id="tutup" type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="simpan" type="button" class="btn btn-primary"><i class="fas fa-highlighter"></i> &nbsp; Simpan Penilaian</button>
                </div>

            </div>
          </div>
        </div>
      </div>

</x-app-layout>
@stack('js')


<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

<script>
    $(document).ready(function () {
        let sliderJujur = $("#kejujuran").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                            }).data("ionRangeSlider");

        let sliderTanggungJwb = $("#tanggungJawab").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                            }).data("ionRangeSlider");

        let sliderKehadiran = $("#kehadiran").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                            }).data("ionRangeSlider");

        let sliderKesetiaan = $("#kesetiaan").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                            }).data("ionRangeSlider");

        let sliderEtika = $("#etikaPerilaku").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                            }).data("ionRangeSlider");


        let admPerencanaan = $("#admPerencanaan").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                                skin: "modern",
                            }).data("ionRangeSlider");

        let pelaksanaan = $("#pelaksanaan").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                                skin: "modern",
                            }).data("ionRangeSlider");
        let admPenilaian = $("#admPenilaian").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                                skin: "modern",
                            }).data("ionRangeSlider");
        let rekapitulasiPKG = $("#rekapitulasiPKG").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                                skin: "modern",
                            }).data("ionRangeSlider");
        let skp = $("#skp").ionRangeSlider({
                                min: 0,     // Minimum value
                                max: 100,   // Maximum value
                                step: 0.10,    // Step size
                                onFinish: function(data) {
                                    console.log(data.from, data.to); // Callback function when the slider values change
                                },
                                skin: "modern",
                            }).data("ionRangeSlider");

    });

    const navItems = document.querySelectorAll('.wilayah');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            navItems.forEach(navItem => {
            navItem.classList.remove('active');
            });
            this.classList.add('active');
            let namaWilayah = $(this).attr('data')
            $('#namaWilayah').text(namaWilayah);
            loadData(namaWilayah);
            loadChartLinear(namaWilayah);
        });
    });

    function loadChartLinear(wilayah) {
        const ctx = document.getElementById('myChart');
        $.ajax({
            url: "{{ route('linear') }}",
            data: {
                wilayah:wilayah,
            },
            success: function (response) {
                // data  = JSON.parse(response)
                console.log(response);
                new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [response[0].linear, response[1].linear],
                    datasets: [{
                        label: '',
                        backgroundColor: ['green', 'red', 'yellow'],
                        data: [response[0].total, response[1].total],
                        borderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: ''
                        }
                    }
                }
                });
            }
        });
    }

    function loadData(cariWilayah) {
        let jumlahView = $('#jumlahView').val();
        $('#tabelPPPK').DataTable({
            serverside: true,
            lengthMenu: [
                [4, 10, 100, -1],
                ['4 Baris', '10 Baris', '100 Baris', 'Semua'],
            ],
            pageLength: 4,
            processing: true,
            orderClasses: false,
            deferRender: true,
            select: true,
            stateSave: true,
            bDestroy: true,
            autoWidth: true,
            dom: '<"wrapper"Blfiptp>',
            ajax: {
                url: "{{ route('masterPPPK') }}",
                data: {
                    cariWilayah:cariWilayah,
                },
                },
                columns: [
                    {
                        data: 'dataPPPK',
                        name: 'dataPPPK'
                    },
                ]
        })
    }

    $(document).on('click','.evaluasi-btn', function () {
        let id = $(this).attr('id');

        $.ajax({
            type: "get",
            url: "{{ route('editPPPK') }}",
            data: {
                id:id,
            },
            success: function (response) {
                let titel = response.nama + ' / ' + response.jabatanASN + ' - ' + response.unitKerja;
                $('#idOrang').val(response.idOrang);
                $('#modalTitle').text(titel);

                $("#kejujuran").ionRangeSlider().data("ionRangeSlider").update({ from: response.kejujuran });
                $('#tanggungJawab').ionRangeSlider().data("ionRangeSlider").update({ from: response.tanggungJawab });
                $('#kehadiran').ionRangeSlider().data("ionRangeSlider").update({ from: response.kehadiran });
                $('#kesetiaan').ionRangeSlider().data("ionRangeSlider").update({ from: response.kesetiaan });
                $('#etikaPerilaku').ionRangeSlider().data("ionRangeSlider").update({ from: response.etikaPerilaku });
                $('#admPerencanaan').ionRangeSlider().data("ionRangeSlider").update({ from: response.admPerencanaan });
                $('#pelaksanaan').ionRangeSlider().data("ionRangeSlider").update({ from: response.pelaksanaan });
                $('#admPenilaian').ionRangeSlider().data("ionRangeSlider").update({ from: response.admPenilaian });
                $('#rekapitulasiPKG').ionRangeSlider().data("ionRangeSlider").update({ from: response.rekapitulasiPKG });
                $('#skp').ionRangeSlider().data("ionRangeSlider").update({ from: response.skp });

                $('#catatanDisiplin').val(response.catatanDisiplin);
                $('#catatanKinerja').val(response.catatanKinerja);

                var checkbox = document.getElementById("rekomendasi");
                (response.rekomendasi == '1') ? checkbox.checked = true : checkbox.checked = false;
            }
        });
    });

    $('#simpan').click(function (e) {
        e.preventDefault();
        let idOrang = $('#idOrang').val();
        let mode = 'edit';
        let kejujuran = $('#kejujuran').val();
        let tanggungJawab = $('#tanggungJawab').val();
        let kehadiran = $('#kehadiran').val();
        let kesetiaan = $('#kesetiaan').val();
        let etikaPerilaku = $('#etikaPerilaku').val();
        let admPerencanaan = $('#admPerencanaan').val();
        let pelaksanaan = $('#pelaksanaan').val();
        let admPenilaian = $('#admPenilaian').val();
        let rekapitulasiPKG = $('#rekapitulasiPKG').val();
        let skp = $('#skp').val();
        let catatanDisiplin = $('#catatanDisiplin').val();
        let catatanKinerja = $('#catatanKinerja').val();
        var checkbox = document.getElementById("rekomendasi");
        let rekomendasi = (checkbox.checked == true) ? "1" : null;
        $.ajax({
            type: "post",
            url: "{{ route('beriNilai') }}",
            data: {
                _token: "{{ csrf_token() }}",
                mode:mode,
                idOrang:idOrang,
                kejujuran:kejujuran,
                tanggungJawab:tanggungJawab,
                kehadiran:kehadiran,
                kesetiaan:kesetiaan,
                etikaPerilaku:etikaPerilaku,
                admPerencanaan:admPerencanaan,
                pelaksanaan:pelaksanaan,
                admPenilaian:admPenilaian,
                rekapitulasiPKG:rekapitulasiPKG,
                skp:skp,
                catatanDisiplin:catatanDisiplin,
                catatanKinerja:catatanKinerja,
                rekomendasi:rekomendasi,
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.text, 'Simpan')
                $('#tabelPPPK').DataTable().ajax.reload(null, false);
                $('#tutup').click();

            },
            error: function(xhr) {
                console.log(xhr);
                toastr.error(xhr.responseJSON.text, 'Gagal')
            },
        });
    });

    // Chart



</script>
