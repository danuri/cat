<?= $this->extend('admin/template_ujian') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Lokasi Ujian</h4>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body">
            <form class="" action="<?= site_url('admin/ujian/lokasi/add/'.$ujianid)?>" method="post" id="addsoal">

              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="pin" class="form-label">Lokasi</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="pin" class="form-label">Titik Lokasi</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="titik_lokasi" name="titik_lokasi" required>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="pin" class="form-label">Alamat</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="pin" class="form-label">Username</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="pin" class="form-label">Password</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="password" name="password">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                  </div>
                  <div class="col-lg-7">
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped datatable smalltext">
                <thead>
                  <tr>
                    <th>Lokasi</th>
                    <th>Titik Lokasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lokasi as $row) {?>
                    <tr>
                      <td><?= $row->lokasi?></td>
                      <td><?= $row->titik_lokasi?></td>
                      <td><a href="<?= site_url('admin/ujian/lokasi/delete/'.$ujianid.'/'.$row->id)?>" class="btn btn-sm btn-danger" onclick="return confirm('Lokasi akan dihapus?')">Delete</a></td>
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

<div class="modal fade" id="addSoal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Tambah Kategori Soal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" onclick="$('#addsoal').submit()">Simpan</button>
          </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
  });

</script>
<?= $this->endSection() ?>
