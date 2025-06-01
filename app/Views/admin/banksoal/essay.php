<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Bank Soal - Essay</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="<?= site_url('admin/banksoal/addessay')?>" class="btn btn-primary text-white"><i class="las la-plus me-1"></i> Tambah Soal Baru</a></li>
            </ol>
          </div>

        </div>
      </div>
    </div>

    <div class="row pb-4 gy-3">
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
                    <th>ID</th>
                    <th>Kompetensi</th>
                    <th>Pertanyaan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($soal as $row) {?>
                    <tr>
                      <td><?= $row->id?></td>
                      <td><?= $row->kompetensi?></td>
                      <td><?= $row->soal?></td>
                      <td><a href="<?= site_url('admin/banksoal/editessay/'.$row->id)?>" class="btn btn-primary">Edit</a> <a href="<?= site_url('admin/banksoal/deleteessay/'.$row->id)?>" class="btn btn-danger" onclick="return confirm('Soal akan dihapus?')">Delete</a></td>
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
