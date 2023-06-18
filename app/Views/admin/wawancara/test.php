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
              <li class="breadcrumb-item"><a href="<?= site_url('admin/wawancara')?>" class="btn btn-success text-white"><i class="las la-plus me-1"></i> Kembali</a></li>
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
            <table class="table table-striped">
              <thead>
                <tr>
                  <td width="5%">Nomor</td>
                  <td width="40%">Kompetensi</td>
                  <td>Penilaian</td>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($soal as $row) {?>
                  <form class="" action="" method="post">
                    <input type="hidden" name="soal_id" value="<?= $row->id;?>">
                    <tr>
                      <td><?= $no;?></td>
                      <td>
                        <b>Kompetensi: <?= $row->kompetensi;?></b><br><br>
                        <b>Kompetensi Teknis:</b><br><?= $row->kompetensi_dasar;?>
                        <br>
                        <br>
                        <a href="javascript:;" onclick="getsoal(<?= $row->kode;?>)">Lihat Contoh Soal</a>
                      </td>
                      <td>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Soal yang disampaikan</label>
                            <textarea class="form-control" name="soal"><?= $row->soal;?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Nilai</label>
                            <input type="number" name="nilai" class="form-control" min="1" max="10" value="<?= $row->nilai;?>">
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan"><?= $row->catatan;?></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                      </td>
                    </tr>
                  </form>
                <?php $no++;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="soalmodal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static"
  aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header p-3 bg-soft-info">
        <h5 class="modal-title" id="myModalLabel">Contoh Soal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="contohsoal">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">

function getsoal(soal) {
  $('#contohsoal').html('Loading...');
  $('#contohsoal').load('<?= site_url('admin/wawancara/getsoal')?>/'+soal);

  $('#soalmodal').modal('show');

}

</script>
<?= $this->endSection() ?>
