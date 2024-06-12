<?= $this->extend('admin/template_ujian') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Data Peserta</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript: void(0);">Ujian</a></li>
              <li class="breadcrumb-item active">Data Ujian</li>
            </ol>
          </div>

        </div>
      </div>
    </div>

    <div class="row pb-4 gy-3">
      <div class="col-sm-4">
        <a href="<?= site_url('pelaporan/ketidakhadiran/add')?>" class="btn btn-primary"><i class="las la-plus me-1"></i> Peserta Baru</a>
        <a href="#" class="btn btn-success"><i class="las la-plus me-1"></i> Import</a>
      </div>

      <div class="col-sm-auto ms-auto">
        <div class="d-flex gap-3">

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="row mb-5">
              <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Lokasi</option>
                </select>
              </div>
              <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Sesi</option>
                </select>
              </div>
              <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Ruang</option>
                </select>
              </div>
            </div>
            <table class="table table-bordered table-striped datatable smalltext">
              <thead>
                <tr>
                  <th>Peserta</th>
                  <th>Lokasi Formasi</th>
                  <th>Detail Ujian</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($peserta as $row) {?>
                  <tr>
                    <td>
                      <?= $row->nik?><br>
                      <?= $row->nomor_peserta?><br>
                      <?= $row->nama?><br>
                      <?= $row->jabatan?>
                    </td>
                    <td><?= $row->lokasi_formasi?></td>
                    <td>-</td>
                    <td><a href="<?= site_url('admin/ujian/lokasi/'.$row->id)?>" class="btn btn-sm btn-primary">Detail</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /content area -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script>
<?= $this->endSection() ?>
