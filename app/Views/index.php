<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-style="detached" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed">
<head>

    <meta charset="utf-8" />
    <title>Computer Assisted Test | Kementerian Agama</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/images/favicon.ico">

    <!-- Sweet Alert css-->
    <link href="<?= base_url()?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="<?= base_url()?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url()?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="<?= site_url()?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url()?>assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://www.freepnglogos.com/uploads/logo-depag-png/file-kementerian-agama-logo-wikimedia-commons-1.png" alt="" height="21">
                        </span>
                    </a>

                    <a href="<?= site_url()?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url()?>assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url()?>assets/images/logo-light.png" alt="" height="21">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->


            </div>

            <div class="d-flex align-items-center">

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle" data-toggle="fullscreen">
                        <i class='las la-expand fs-24'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle light-dark-mode">
                        <i class='las la-moon fs-24'></i>
                    </button>
                </div>



                <div class="dropdown header-item">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?= base_url()?>assets/images/users/avatar-4.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block fw-medium user-name-text fs-16"><?= session('nama')?> <i class="las la-angle-down fs-12 ms-1"></i></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="bx bx-user fs-15 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                        <a class="dropdown-item" href="#"><i class="bx bx-wallet fs-15 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                        <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench fs-15 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                        <a class="dropdown-item" href="auth-lockscreen.html"><i class="bx bx-lock-open fs-15 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="<?= site_url('logout')?>"><i class="bx bx-power-off fs-15 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="<?= site_url()?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url()?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url()?>assets/images/logo-dark.png" alt="" height="21">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="<?= site_url()?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url()?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url()?>assets/images/logo-light.png" alt="" height="21">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="<?= site_url()?>">
                                <i class="las la-house-damage"></i> <span data-key="t-dashboard">Informasi Peserta</span>
                            </a>
                        </li>


                        <div class="help-box text-center">
                            <img src="<?= base_url()?>assets/images/create-invoice.png" class="img-fluid" alt="">
                            <p class="mb-3 mt-2 text-muted">Upgrade To Pro For More Features</p>
                            <div class="mt-3">
                                <a href="invoice-add.html" class="btn btn-primary"> Create Invoice</a>
                            </div>
                        </div>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                  <div class="table-responsive table-card">
                                    <table class="table table-bordered table-centered align-middle table-nowrap mb-0">
                                        <tbody>
                                          <tr>
                                            <td>Nomor Peserta</td>
                                            <td>: <?= session('nomor_peserta')?></td>
                                          </tr>
                                          <tr>
                                            <td>Nama</td>
                                            <td>: <?= session('nama')?></td>
                                          </tr>
                                          <tr>
                                            <td>Jabatan</td>
                                            <td>: <?= session('jabatan')?></td>
                                          </tr>
                                          <tr>
                                            <td>Satuan Kerja</td>
                                            <td>: <?= session('lokasi_formasi')?></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- end table responsive -->
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-lg-6">
                          <?php if($status == 1){ ?>
                            <div class="card">
                              <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Hasil CAT</h4>
                              </div>
                              <div class="card-body">
                                <div class="table-responsive table-card">
                                  <table class="table table-bordered table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                      <th>Indikator</th>
                                      <!-- <th>Bobot</th> -->
                                      <th>Skor</th>
                                      <!-- <th>Nilai Akhir</th> -->
                                    </thead>
                                    <tbody>
                                      <?php
                                      $total = 0;
                                      foreach ($nilai as $row) {
                                        ?>
                                        <tr>
                                          <td><?= $row->nama?></td>
                                          <!-- <th></th> -->
                                          <td><?= ($row->jumlah)?></td>
                                          <!-- <th></th> -->
                                        </tr>
                                        <?php
                                        $total = $total+($row->jumlah);
                                      }
                                      ?>
                                      <tr>
                                        <th>Total</th>
                                        <th><?= $total?></th>
                                        <!-- <th></th> -->
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div><!-- end card -->
                          <?php }else{ ?>
                            <div class="card">
                              <div class="card-body">
                                <div class="table-responsive">
                                  Anda belum melaksakan uji kompetensi. Klik Mulai untuk memulai ujian.
                                </div>
                                <!-- end table responsive -->
                              </div><!-- end card-body -->
                            </div><!-- end card -->
                          <?php } ?>
                        </div>
                        <!-- end col -->
                    </div>
                    <div class="d-flex align-items-start gap-3 mt-4">
                      <?php if($status == 0){ ?>
                        <a href="<?= site_url('mulai')?>" class="btn btn-success btn-label right ms-auto" onclick=""><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Mulai</a>
                      <?php } ?>
                    </div>


                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © CAT Uji Kompetensi.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Direktorat Penerangan Agama Islam
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url()?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url()?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url()?>assets/js/plugins.js"></script>

    <!-- Sweet Alerts js -->
    <script src="<?= base_url()?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="<?= base_url()?>assets/js/pages/sweetalerts.init.js"></script>

    <!-- App js -->
    <script src="<?= base_url()?>assets/js/app.js"></script>
</body>


<!-- Mirrored from themesbrand.com/invoika/layouts/advance-ui-sweetalerts.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Mar 2023 07:07:53 GMT -->
</html>
