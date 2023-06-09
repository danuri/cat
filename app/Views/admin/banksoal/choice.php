<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Bank Soal</h4>

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
        <a href="<?= site_url('admin/banksoal/addchoice')?>" class="btn btn-primary"><i class="las la-plus me-1"></i> Tambah Soal Baru</a>
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
                    <th>ID</th>
                    <th>Pertanyaan</th>
                    <th>Pilihan Jawaban</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($soal as $row) {?>
                    <tr>
                      <td><?= $row->id?></td>
                      <td><?= $row->pertanyaan?></td>
                      <td>
                        a. <?= $row->p1?><br>
                        b. <?= $row->p2?><br>
                        c. <?= $row->p3?><br>
                        d. <?= $row->p4?><br>
                        e. <?= $row->p5?>
                      </td>
                      <td><a href="<?= site_url('admin/ujian/lokasi/'.$row->id)?>" class="btn btn-primary">Edit</a> <a href="<?= site_url('admin/banksoal/deletechoice/'.$row->id)?>" class="btn btn-danger" onclick="return confirm('Soal akan dihapus?')">Delete</a></td>
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
