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
            <div class="row mb-5">
              <!-- <div class="col-3">
                <a href="<?= site_url('/admin/ujian/hasilexport/'.encrypt($ujianid));?>?lokasiid=<?= encrypt($lokasiid)?>&sesiid=<?= encrypt($sesiid)?>" target="_blank" class="btn btn-success"><i class="icon-arrow-left-circle"></i> Download Hasil Peserta</a></li>
              </div>               -->
              <div class="col-3">
              <form action="<?= site_url('/admin/ujian/hasilexport/'.encrypt($ujianid));?>" method="get" target="_blank">
                <input type="hidden" name="lokasiid" id="lokasiid" value="<?= $lokasiid?>">
                <input type="hidden" name="sesiid" id="sesiid" value="<?= $sesiid?>">
                <button type="submit" class="btn btn-success">
                  <i class="icon-arrow-left-circle"></i> Download Hasil Peserta
                </button>
              </form>
              </div>
            </div>
            <form method="get" action="<?= site_url('/admin/ujian/hasil/'.encrypt($ujian->id)) ?>">
            <div class="row mb-5">
              <div class="col-3">
                <select class="form-select" name="filter_lokasi" onchange="this.form.submit()">
                  <option value="">Filter Lokasi</option>
                  <?php foreach ($lokasi as $row) {?>
                    <option value="<?= $row->id?>"><?= $row->lokasi?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-3">
                <select class="form-select" name="filter_sesi" onchange="this.form.submit()">
                  <option value="">Filter Sesi</option>
                  <?php foreach ($sesi as $row) {?>
                    <option value="<?= $row->id?>">Tanggal: <?=$row->tanggal?> - Lokasi: <?=$row->lokasi?> - Ruang: <?=$row->ruang?> - Sesi: <?=$row->sesi?></option>
                  <?php } ?>
                </select>
              </div>
              <!-- <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Ruang</option>
                </select>
              </div> -->
            </div>
          </form>
            <table class="table table-bordered table-striped datatable smalltext">
              <thead>
                <tr>
                  <!-- <th>Nomor</th>
                  <th>Nama</th> -->
                  <th style="width: 25%;">Peserta</th>
                  <th style="width: 25%;">Lokasi Formasi</th>
                  <th style="width: 20%;">Info Ujian</th>
                  <th style="width: 10%;">Mulai</th>
                  <th style="width: 10%;">Selesai</th>
                  <th style="width: 5%;">Nilai</th>
                  <th style="width: 5%;">Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($hasil as $row) {?>
                  <tr>
                    <td>
                      <?= $row->nip_peserta?><br>
                      <b><?= $row->nama_peserta?></b><br>
                      <?= $row->jabatan_peserta?>
                    </td>
                    <td><?= $row->lokasi_formasi?></td>
                    <td>
                      <?= $row->nama_ujian?><br>
                      Lokasi: <?= $row->lokasi?><br>
                    </td>
                    <td><?= $row->start_time?></td>
                    <td><?= $row->finish_time?></td>
                    <td><?= $row->finish_nilai?></td>
                    <td><a href="<?= site_url('admin/ujian/hasildetail/'.encrypt($row->nip_peserta).'/'.encrypt($ujianid))?>" class="btn btn-sm btn-success">Lihat</a></td>
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
<!-- <script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script> -->
<!-- <script src="<?= base_url();?>assets/libs/datatables.net//js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.datapeserta').DataTable({
      dom: 'Bfrtip',
      lengthMenu: [
              [ 10, 25, 50, -1 ],
              [ '10 rows', '25 rows', '50 rows', 'Show all' ]
          ],
      buttons: [
        'pageLength','copy',
        {
              extend: 'excel',
              exportOptions: {
                  orthogonal: 'sort'
              },
              customizeData: function ( data ) {
                  for (var i=0; i<data.body.length; i++){
                      for (var j=0; j<data.body[i].length; j++ ){
                          data.body[i][j] = '\u200C' + data.body[i][j];
                      }
                  }
              }
              }
      ]
  	});
  });
</script> -->
<?= $this->endSection() ?>
