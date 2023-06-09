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
              <li class="breadcrumb-item"><a href="<?= site_url('admin/banksoal/choice')?>" class="btn btn-primary text-white"><i class="las la-plus me-1"></i> Kembali</a></li>
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
                <label for="p1" class="form-label">Kategori</label>
                <select class="form-select" name="category_id">
                  <?php foreach ($cats as $row) {
                    echo '<option value="'.$row->id.'">'.$row->nama.'</option>';
                  } ?>
                </select>
              </div>
              <div class="mb-3">
                  <label for="pertanyaan" class="form-label">Pertanyaan</label>
                  <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" placeholder="Masukan pertanyaan" required></textarea>
              </div>
              <div class="mb-3">
                  <label for="p1" class="form-label">Pilihan 1 (Isi dengan jawaban benar)</label>
                  <input type="text" class="form-control" name="p1" id="p1" placeholder="Pilihan 1" required>
              </div>
              <div class="mb-3">
                  <label for="p2" class="form-label">Pilihan 2</label>
                  <input type="text" class="form-control" name="p2" id="p2" placeholder="Pilihan 2" required>
              </div>
              <div class="mb-3">
                  <label for="p3" class="form-label">Pilihan 3</label>
                  <input type="text" class="form-control" name="p3" id="p3" placeholder="Pilihan 3" required>
              </div>
              <div class="mb-3">
                  <label for="p4" class="form-label">Pilihan 4</label>
                  <input type="text" class="form-control" name="p4" id="p4" placeholder="Pilihan 4" required>
              </div>
              <div class="mb-3">
                  <label for="p5" class="form-label">Pilihan 5</label>
                  <input type="text" class="form-control" name="p5" id="p5" placeholder="Pilihan 5" required>
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
