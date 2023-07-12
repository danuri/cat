<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Edit Ujian</h4>

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
        <a href="<?= site_url('admin/ujian')?>" class="btn btn-primary"><i class="las la-plus me-1"></i> Kembali</a>
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
            <form class="" action="" method="post">
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="namaujian" class="form-label">Nama Ujian</label>
                  </div>
                  <div class="col-lg-9">
                      <input type="text" class="form-control" id="namaujian" name="namaujian" placeholder="Nama Ujian" value="<?= $ujian->nama?>">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                  </div>
                  <div class="col-lg-9">
                      <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?= $ujian->keterangan?></textarea>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="lamaujian" class="form-label">Lama Ujian</label>
                  </div>
                  <div class="col-lg-9">
                      <div class="input-group">
                          <input type="number" class="form-control" id="lamaujian" name="lamaujian" value="<?= $ujian->lama_ujian?>">
                          <div class="input-group-text">menit</div>
                      </div>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="waktuujian" class="form-label">Tanggal Ujian</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="date" class="form-control" id="waktuujian" name="waktuujian" value="<?= $ujian->waktu_ujian?>">
                    <p>Ujian tidak dapat berlangsung sebelum waktu yang ditentukan</p>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="pin" class="form-label">PIN Ujian</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="number" class="form-control" id="pin" name="pin" value="<?= $ujian->pin?>">
                  </div>
              </div>
              <div class="text-end">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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
<script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script>
<?= $this->endSection() ?>
