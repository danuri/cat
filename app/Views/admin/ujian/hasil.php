<?= $this->extend('admin/template_ujian') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Hasil CAT</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript: void(0);">Ujian</a></li>
              <li class="breadcrumb-item active">Hasil CAT</li>
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
            <table class="table table-bordered table-striped datatable smalltext">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Nama</th>
                  <th>Lokasi</th>
                  <th>Mulai</th>
                  <th>Selesai</th>
                  <th>Nilai</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($hasil as $row) {?>
                  <tr>
                    <td><?= $row->peserta_id?></td>
                    <td><?= $row->nama?></td>
                    <td><?= $row->lokasi_formasi?></td>
                    <td><?= $row->start_time?></td>
                    <td><?= $row->finish_time?></td>
                    <td><?= $row->finish_nilai?></td>
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
