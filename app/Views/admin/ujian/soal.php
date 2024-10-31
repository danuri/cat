<?= $this->extend('admin/template_ujian') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Soal Ujian</h4>

          <div class="page-title-right">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSoal">
            Tambah Kategori Soal
            </button>
          </div>

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
                    <th>KATEGORI SOAL</th>
                    <th>JUMLAH</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($soal as $row) {?>
                    <tr>
                      <td><?= $row->standar.' - '.$row->nama?></td>
                      <td><?= $row->jumlah_soal?></td>
                      <td><a href="<?= site_url('admin/ujian/soal/delete/'.encrypt($row->id))?>" onclick="return confirm('Soal akan dihapus?')" class="btn btn-sm btn-danger">Hapus</a></td>
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
            <form class="" action="<?= site_url('admin/ujian/soal/add/'.encrypt($ujianid))?>" method="post" id="addsoal">
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="pin" class="form-label">Kategori Soal</label>
                  </div>
                  <div class="col-lg-9">
                    <select class="form-select" name="category_id">
                      <?php foreach ($categories as $row) {
                        echo '<option value="'.$row->id.'">'.$row->standar.' - '.$row->nama.'</option>';
                      } ?>
                    </select>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="pin" class="form-label">Jumlah Soal</label>
                  </div>
                  <div class="col-lg-9">
                    <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal">
                    <input type="hidden" name="ujian_id" value="<?= $ujianid?>">
                  </div>
              </div>
            </form>
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
