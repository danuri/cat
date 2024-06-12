<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Manajemen Ujian</h4>

                <div class="page-title-right">
                    <a href="<?= site_url('admin/ujian/add')?>" class="btn btn-sm btn-primary"><i class="las la-plus me-1"></i> Buat Ujian</a>
                </div>

            </div>
        </div>
    </div>

    <div class="row pb-4 gy-3">
      <div class="col-sm-4">

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
            <table class="table table-bordered table-striped datatable smalltext">
              <thead>
                <tr>
                  <th>CREATED AT</th>
                  <th>UJIAN</th>
                  <th>LAMA UJIAN</th>
                  <!-- <th>KOMPOSISI SOAL</th> -->
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ujian as $row) {?>
                  <tr>
                    <td><?= $row->waktu_ujian?></td>
                    <td><?= $row->nama?></td>
                    <td><?= $row->lama_ujian?></td>
                    <!-- <td><?= $row->soal?></td> -->
                    <td><a href="<?= site_url('admin/ujian/detail/'.encrypt($row->id))?>" class="btn btn-sm btn-primary">Detail</a> <a href="<?= site_url('admin/ujian/delete/'.encrypt($row->id))?>" class="btn btn-sm btn-danger">Delete</a></td>
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
<?= $this->endSection() ?>
