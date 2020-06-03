
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->view('admin/_layouts/sidebar', $data); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        <?php $this->view('admin/_layouts/topbar'); ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row mb-4">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-lg-4 col-md col-12">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Buku</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_book']; ?> Buku</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-lg-4 col-md col-12">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Anggota</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_anggota']; ?> Anggota</div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-lg-4 col-md col-12">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Peminjaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['total_peminjaman']; ?> Peminjaman</div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Peminjaman Setiap Bulannya</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    </div>
                </div>
                </div>
            </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php $this->view('admin/_layouts/bottom'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

        



    <?php $this->view('admin/_layouts/footer/footer_start'); ?>

    <!-- Page level plugins -->
    <script src="<?= BASE_URL ?>/admin_public/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= BASE_URL ?>/admin_public/js/demo/chart-area-demo.js"></script>
    <script src="<?= BASE_URL ?>/admin_public/js/demo/chart-pie-demo.js"></script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>