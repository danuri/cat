<!doctype html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <title>Dashboard | CAT - Kemenag RI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Computer Assisted Test" name="description" />
  <meta content="Danunih" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url()?>assets/images/biro-sdm-ico.ico">

  <!-- DataTables -->
  <link href="<?= base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url()?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="<?= base_url()?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Bootstrap Css -->
  <link href="<?= base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="<?= base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="<?= base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
  <!-- Begin page -->
  <div id="layout-wrapper">

    <header id="page-topbar">
      <div class="navbar-header">
        <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box">
            <a href="/" class="logo logo-dark">
              <span class="logo-sm">
                <img src="<?= base_url()?>assets/images/logo-sm-biro-sdm.png" alt="" height="22">
              </span>
              <span class="logo-lg">
                <img src="<?= base_url()?>assets/images/biro-sdm.png" alt="" height="20">
              </span>
            </a>

            <a href="/" class="logo logo-light">
              <span class="logo-sm">
                <img src="<?= base_url()?>assets/images/logo-sm-biro-sdm.png" alt="" height="22">
              </span>
              <span class="logo-lg">
                <img src="<?= base_url()?>assets/images/biro-sdm.png" alt="" height="20">
              </span>
            </a>
          </div>

          <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
            <i class="fa fa-fw fa-bars"></i>
          </button>

          <!-- App Search-->
          <form class="app-search d-none d-lg-block">
            <div class="position-relative">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="uil-search"></span>
            </div>
          </form>
        </div>

        <div class="d-flex">

          <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="uil-search"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
          aria-labelledby="page-header-search-dropdown">

          <form class="p-3">
            <div class="form-group m-0">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Recipient's username">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    <div class="dropdown d-none d-lg-inline-block ms-1">
      <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
        <i class="uil-minus-path"></i>
      </button>
    </div>

  <div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img class="rounded-circle header-profile-user" src="<?= base_url()?>assets/images/users/avatar-4.jpg"
    alt="Header Avatar">
    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?= session('nama')?></span>
    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-end">
    <!-- item-->
    <a class="dropdown-item" href="/contacts-profile"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">View Profile</span></a>
    <a class="dropdown-item" href="#"><i class="uil uil-wallet font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">My Wallet</span></a>
    <a class="dropdown-item d-block" href="#"><i class="uil uil-cog font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Settings</span> <span class="badge bg-soft-success rounded-pill mt-1 ms-2">03</span></a>
    <a class="dropdown-item" href="/auth-lock-screen"><i class="uil uil-lock-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Lock screen</span></a>
    <a class="dropdown-item" href="/auth-login"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
  </div>
</div>

<div class="dropdown d-inline-block">
  <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
    <i class="uil-cog"></i>
  </button>
</div>

</div>
</div>
</header>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

  <!-- LOGO -->
  <div class="navbar-brand-box">
    <a href="/" class="logo logo-dark">
      <span class="logo-sm">
        <img src="<?= base_url()?>assets/images/logo-sm-biro-sdm.png" alt="" height="35">
      </span>
      <span class="logo-lg">
        <img src="<?= base_url()?>assets/images/biro-sdm.png" alt="" height="40">
      </span>
    </a>

    <a href="/" class="logo logo-light">
      <span class="logo-sm">
        <img src="<?= base_url()?>assets/images/logo-sm-biro-sdm.png" alt="" height="35">
      </span>
      <span class="logo-lg">
        <img src="<?= base_url()?>assets/images/biro-sdm.png" alt="" height="40">
      </span>
    </a>
  </div>

  <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
  </button>

  <div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li>
          <a href="<?= site_url('admin/ujian')?>">
            <i class="uil-angle-left"></i>
            <span>Kembali</span>
          </a>
        </li>

        <li class="menu-title">Menu</li>

        <li>
          <a href="<?= site_url('admin/ujian/soal/'.encrypt($ujianid))?>" class="waves-effect">
            <i class="uil-folder-question"></i>
            <span>Soal</span>
          </a>
        </li>

        <li>
          <a href="<?= site_url('admin/ujian/lokasi/'.encrypt($ujianid))?>" class=" waves-effect">
            <i class="uil-location-point"></i>
            <span>Lokasi</span>
          </a>
        </li>

        <li>
          <a href="<?= site_url('admin/ujian/sesi/'.encrypt($ujianid))?>" class=" waves-effect">
            <i class="uil-list-ui-alt"></i>
            <span>Sesi</span>
          </a>
        </li>

        <li>
          <a href="<?= site_url('admin/ujian/peserta/'.encrypt($ujianid))?>" class=" waves-effect">
            <i class="uil-users-alt"></i>
            <span>Peserta</span>
          </a>
        </li>

        <li>
          <a href="<?= site_url('admin/ujian/hasil/'.encrypt($ujianid))?>" class=" waves-effect">
            <i class="uil-users-alt"></i>
            <span>Hasil CAT</span>
          </a>
        </li>

      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End -->
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

  <?= $this->renderSection('content') ?>

    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <script>document.write(new Date().getFullYear())</script> © CAT Kemenag.
          </div>
          <div class="col-sm-6">
            <div class="text-sm-end d-none d-sm-block">
              Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://ropeg.kemenag.go.id" target="_blank" class="text-reset">Biro Sumber Daya Manusia</a>
            </div>
          </div>
        </div>
      </div>
    </footer>            </div>
    <!-- end main content-->

  </div>

  <div class="rightbar-overlay"></div>
  <!-- JAVASCRIPT -->
  <script src="<?= base_url()?>assets/libs/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url()?>assets/libs/metismenu/metisMenu.min.js"></script>
  <script src="<?= base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= base_url()?>assets/libs/node-waves/waves.min.js"></script>
  <script src="<?= base_url()?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="<?= base_url()?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

  <script src="<?= base_url()?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url()?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

  <script src="<?= base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

  <!-- apexcharts -->
  <script src="<?= base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>

  <script src="<?= base_url()?>assets/js/pages/dashboard.init.js"></script>

  <script src="<?= base_url()?>assets/js/app.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".datatable").DataTable();
    });

  </script>

  <?= $this->renderSection('script') ?>

</body>

</html>
