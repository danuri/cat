<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Data Ujian</h4>

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
        <a href="<?= site_url('admin/ujian/add')?>" class="btn btn-primary"><i class="las la-plus me-1"></i> Buat Ujian</a>
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
            <div class="table-responsive">
              <table class="table table-bordered table-striped datatable smalltext">
                <thead>
                  <tr>
                    <th>CREATED AT</th>
                    <th>UJIAN</th>
                    <th>LAMA UJIAN</th>
                    <th>KOMPOSISI SOAL</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($ujian as $row) {?>
                    <tr>
                      <td><?= $row->created_at?></td>
                      <td><?= $row->nama?></td>
                      <td><?= $row->lama_ujian?></td>
                      <td><?= $row->soal?></td>
                      <td><a href="<?= site_url('admin/ujian/edit/'.$row->id)?>" class="btn btn-sm btn-primary">Edit</a> <a href="<?= site_url('admin/ujian/soal/'.$row->id)?>" class="btn btn-sm btn-warning">Soal</a> <a href="<?= site_url('admin/ujian/peserta/'.$row->id)?>" class="btn btn-sm btn-danger">Peserta</a> <a href="<?= site_url('admin/ujian/hasil/'.$row->id)?>" class="btn btn-sm btn-success">Hasil</a></td>
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
</div>

<!-- /content area -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script>
<?= $this->endSection() ?>
