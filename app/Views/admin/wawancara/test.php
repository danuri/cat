<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Mulai Wawancara</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="<?= site_url('admin/banksoal/choice')?>" class="btn btn-success text-white"><i class="las la-plus me-1"></i> Kembali</a></li>
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
            <table class="table">
              <thead>
                <tr>
                  <td>Nomor</td>
                  <td>Soal</td>
                  <td>Nilai</td>
                  <td>Keterangan</td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($soal as $row) {?>
                  <tr>
                    <td><?= $no;?></td>
                    <td><?= $row->pertanyaan;?> (Bobot <?= $row->bobot;?>)</td>
                    <td><input type="number" class="form-control"></td>
                    <td><textarea class="form-control"></textarea></td>
                  </tr>
                <?php $no++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
