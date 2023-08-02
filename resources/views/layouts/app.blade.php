<!DOCTYPE html>
<html>

<head>
    {{-- header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Headers: *'); --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Evaluasi PPPK | Dashboard</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href={{ asset('plugins/datatable-download/datatables.min.css') }}>
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Ionicons -->
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href={{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}>
    <!-- iCheck -->
    {{-- // --}}
    <link rel="stylesheet" href={{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/toastr/toastr.min.css') }}>
    <!-- JQVMap -->
    {{-- // --}}
    <link rel="stylesheet" href={{ asset('plugins/jqvmap/jqvmap.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    {{-- // --}}
    <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
    <!-- summernote -->
    {{-- // --}}
    <link rel="stylesheet" href={{ asset('plugins/summernote/summernote-bs4.css') }}>

    <link rel="stylesheet" href={{ asset('plugins/jquery-ui/jquery-ui.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/chart.js/Chart.min.css') }}>
    {{--
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css"> --}}

    <link rel="stylesheet" href={{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/datatable-download/Buttons-2.3.3/css/buttons.dataTables.min.css') }}>
    <link rel="stylesheet" href={{ asset('plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}>




    <!-- Google Font: Source Sans Pro -->
    {{--
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
    {{--
    <link href="{{ asset('css/cardDatatabel.css') }}" rel="stylesheet"> --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- SEARCH FORM -->
            {{-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Cari Pegawai"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('welcome')" onclick="event.preventDefault();
                            this.closest('form').submit();" class="btn btn-sm btn-info">
                            {{ __('Keluar') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="dist/img/pangkepLogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light"> <strong>Evaluasi</strong>PPPK</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @role('owner')
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <p>
                                    Data Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('masterPPPK') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Data PPPK</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterSekolah') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Data Sekolah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('wilayah.index') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Data PPPK per-Wilayah</p>
                                    </a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Data Evaluator</p>
                                    </a>
                                </li> --}}
                            </ul>

                            {{-- <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('masterEkin') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; E-Kinerja (Nyux)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterPribadi') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Pribadi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterDiklat') }}" class="nav-link ">
                                        <i class="fas fa-vihara"></i>
                                        <p>&nbsp; Diklat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterGolongan') }}" class="nav-link ">
                                        <i class="fas fa-sitemap fa-md fa-fw"></i>
                                        <p>&nbsp; Golongan</p>
                                    </a>
                                </li>
                                <li class="nav-item menu-is-opening menu-close">
                                    <a href="#" class="nav-link ">
                                        <i class="fa fa-suitcase"></i>
                                        <p>
                                            &nbsp; Pendidikan
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('masterTKTPendidikan') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Tingkat Pendidikan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('masterPendidikan') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Pendidikan</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="nav-item menu-is-opening menu-open">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-user-tie"></i>
                                        <p>
                                            &nbsp; Jabatan
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('masterKategorijabatan') }}" class="nav-link ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>&nbsp; Kategori Jabatan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('masterEselon') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>&nbsp; Eselonisasi</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('masterJabatan') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>&nbsp; Jabatan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('masterJabpelaksana') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>&nbsp; Jabatan Pelaksana</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="nav-item menu-is-opening menu-open">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-user-tie"></i>
                                        <p>
                                            &nbsp; Unit Organisasi
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('masterJenisunor') }}" class="nav-link ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>&nbsp; Jenis Unor</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('masterUnor') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>&nbsp; Unit Organisasi</p>
                                            </a>
                                        </li>


                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('masterSatuanKerja') }}" class="nav-link ">
                                        <i class="fas fa-university"></i>
                                        <p>&nbsp; Satuan Kerja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterStatuskedudukan') }}" class="nav-link ">
                                        <i class="fas fa-university"></i>
                                        <p>&nbsp; Status Kedudukan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterJenispegawai') }}" class="nav-link ">
                                        <i class="fas fa-address-book fa-sm fa-fw"></i>
                                        <p>&nbsp; Jenis Kepegawaian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterJeniskp') }}" class="nav-link ">
                                        <i class="fas fa-chess"></i>
                                        <p>&nbsp; Jenis Kenaikan Pangkat</p>
                                    </a>
                                </li>

                                <li class="nav-item menu-is-opening menu-close">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-user-slash"></i>
                                        <p>
                                            &nbsp; Hukuman Disiplin
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('masterTingkathukdis') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Tingkat Hukuman</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('masterJenishukuman') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Jenis Hukuman</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul> --}}

                        </li>
                        <li class="nav-item has-treeview menu-close">
                            <a href="#" class="nav-link active">
                                <p>
                                    Evaluasi PPPK Guru
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Penilaian Disiplin</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-hospital-user"></i>
                                        <p>&nbsp; Penilaian Kinerja</p>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        <li class="nav-item has-treeview menu-close">
                            <a href="" class="nav-link active">
                                <p>
                                    Rekapitulasi Penilaian
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="fas fa-poll"></i>
                                        <p>&nbsp; Hasil Penilaian</p>
                                    </a>
                                </li>


                            </ul>
                            {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterRwjabatan') }}" class="nav-link ">
                                        <i class="fas fa-poll"></i>
                                        <p>&nbsp; Riwayat Jabatan</p>
                                    </a>
                                </li>


                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterRwpendidikan') }}" class="nav-link ">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p>&nbsp;Riwayat Pendidikan</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterRwhukdisiplin') }}" class="nav-link ">
                                        <i class="fas fa-graduation-cap"></i>
                                        <p>&nbsp;Riwayat Hukuman Disiplin</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterRwdiklat') }}" class="nav-link ">
                                        <i class="fas fa-wave-square"></i>
                                        <p>&nbsp;Riwayat Diklat</p>
                                    </a>
                                </li>
                            </ul> --}}
                        </li>
                        {{-- <li class="nav-header">Setting</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Tambah User</p>
                            </a>
                        </li> --}}
                        @endrole
                        @role('gudang')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Katalog Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Stok Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Opname Obat</p>
                            </a>
                        </li>
                        @endrole

                        @role('user')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Stok Obat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Transaksi Penjualan</p>
                            </a>
                        </li>
                        @endrole

                        @role('ktu')
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <p>
                                    Master Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterPerangkatdaerah') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; Perangkat Daerah</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterPresensi') }}" class="nav-link">
                                        <i class="far fa-calendar-check"></i>
                                        <p>&nbsp; Data Presensi 2022</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterThl2022') }}" class="nav-link">
                                        <i class="far fa-calendar-check"></i>
                                        <p>&nbsp; Data THL 2022</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <p>
                                    Data THL 2023
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('masterThl2023') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; T <strong>H</strong> <sub>e</sub>L </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('masterThl2023dinkescamat') }}" class="nav-link ">
                                        <i class="fas fa-universal-access"></i>
                                        <p>&nbsp; T <strong>H</strong> <sub>e</sub>L Dinkes</p>
                                    </a>
                                </li>

                            </ul>

                        </li>
                        @endrole
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">si-P<sub>E</sub>g</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                                <li class="breadcrumb-item active">Selamat Datang
                                    <strong>{{Auth::user()->name}}</strong>
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row hidden" id="kotakStatus">
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3 id="status_null">??</h3>

                                    <p>Belum Ada Status</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">Selengkapnya <i
                                        class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="status_aktif">??</h3>

                                    <p>Aktif</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">Selengkapnya <i
                                        class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="status_pindah">??</h3>

                                    <p>Pindahan/Limpahan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">Selengkapnya <i
                                        class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="status_tidakaktif">??</h3>

                                    <p>Tidak Aktif</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">Selengkapnya <i
                                        class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="status_baru">??</h3>

                                    <p>Sukarela Berdisposisi (Aktif)</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">Selengkapnya <i
                                        class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->
                            <div>
                                {{ $slot }}
                            </div>




                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">





                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.4
            </div>
        </footer>

        <title>{{ config('app.name', 'Laravel') }}</title>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{ asset('plugins/jquery-ui/jquery-ui.min.js') }}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- ChartJS -->
    {{-- <script src={{ asset('plugins/chart.js/Chart.min.js') }}></script> --}}
    <!-- Sparkline -->
    {{-- <script src={{ asset('plugins/sparklines/sparkline.js') }}></script> --}}
    <!-- JQVMap -->
    {{-- <script src={{ asset('plugins/jqvmap/jquery.vmap.min.js') }}></script> --}}
    {{-- <script src={{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}></script> --}}
    <!-- jQuery Knob Chart -->
    {{-- <script src={{ asset('plugins/jquery-knob/jquery.knob.min.js') }}></script> --}}
    <!-- daterangepicker -->
    <script src={{ asset('plugins/moment/moment.min.js') }}></script>
    <script src={{ asset('plugins/daterangepicker/daterangepicker.js') }}></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src={{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}></script>
    <!-- Summernote -->
    {{-- <script src={{ asset('plugins/summernote/summernote-bs4.min.js') }}></script> --}}
    <!-- overlayScrollbars -->
    {{-- <script src={{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script> --}}

    {{-- Datatable Button --}}
    {{-- <script src={{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script> --}}
    {{-- <script src={{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script> --}}
    <script src={{ asset('plugins/datatable-download/datatables.min.js') }}></script>
    <script src={{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
    <script src={{ asset('plugins/ion-rangeslider/js/ion.rangeSlider.js') }}></script>
    {{-- <script src={{ asset('plugins/chart.js/Chart.bundle.min.js') }}></script> --}}
    <script src={{ asset('plugins/chart.js/Chart.min.js') }}></script>
    {{-- <script src={{ asset('plugins/datatable-download/Buttons-2.3.3/js/dataTables.buttons.min.js') }}></script> --}}
    <!-- AdminLTE App -->
    <script src={{ asset('dist/js/adminlte.js') }}></script>
    <script>
        $('#kotakStatus').hide();
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src={{ asset('dist/js/pages/dashboard.js') }}></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src={{ asset('dist/js/demo.js') }}></script> --}}
    @stack('js')
</body>

</html>

{{--
<!-- Page Heading -->
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
    </div>
</header>

<!-- Page Content -->
<main>
    {{ $slot }}
</main> --}}
