<?= $this->extend('admin/template_ujian') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Sesi dan Ruang Ujian</h4>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body">
            <form class="" action="<?= site_url('admin/ujian/sesi/add/'.encrypt($ujianid))?>" method="post" id="addsoal">

              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="lokasi" class="form-label">Lokasi</label>
                  </div>
                  <div class="col-lg-7">
                    <select class="form-select" name="kode_lokasi" id="kodelokasi">
                      <?php foreach ($lokasi as $row) {?>
                        <option value="<?= $row->id?>"><?= $row->lokasi?></option>
                      <?php }?>
                    </select>
                    <input type="hidden" name="lokasi" id="lokasi" value="">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="ruang" class="form-label">Ruang</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="number" class="form-control" id="ruang" name="ruang">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="sesi" class="form-label">Sesi</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="number" class="form-control" id="sesi" name="sesi">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="tanggal" class="form-label">Tanggal</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-5">
                      <label for="pin" class="form-label">PIN</label>
                  </div>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" id="pin" name="pin">
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
                    <th>Sesi Id</th>
                    <th>Lokasi</th>
                    <th>Ruang</th>
                    <th>Sesi</th>
                    <th>Waktu</th>
                    <th>PIN</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($sesi as $row) {?>
                    <tr>
                      <td><?= $row->id?></td>
                      <td><?= $row->kode_lokasi?></td>
                      <td><?= $row->ruang?></td>
                      <td><?= $row->sesi?></td>
                      <td><?= $row->tanggal?></td>
                      <td><?= $row->pin?></td>
                      <td><a href="<?= site_url('admin/ujian/sesi/delete/'.$ujianid.'/'.$row->id)?>" class="btn btn-sm btn-danger" onclick="return confirm('Lokasi akan dihapus?')">Delete</a></td>
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
    $('#lokasi').val($("#kodelokasi option:selected" ).text());

    $('#kodelokasi').on('change', function() {
      $('#lokasi').val($("#kodelokasi option:selected" ).text());
    });
  });

</script>
<?= $this->endSection() ?>
