<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Tambah Soal</h4>

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
            <form action="" method="post">
              <div class="mb-3">
                  <label for="pertanyaan" class="form-label">Pertanyaan</label>
                  <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" placeholder="Masukan pertanyaan" required></textarea>
              </div>
              <div class="mb-3">
                  <label for="bobot" class="form-label">Bobot</label>
                  <input type="number" class="form-control" name="bobot" id="bobot" placeholder="Isi dengan bobot nilai" required>
              </div>
              <div class="text-end">
                  <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
          </form>
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
