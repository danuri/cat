<?= $this->extend('admin/template_ujian') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Data Peserta</h4>

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
        <a href="<?= site_url('admin/ujian/peserta/add/'.encrypt($ujianid))?>" class="btn btn-primary"><i class="las la-plus me-1"></i> Peserta Baru</a>
        <a href="#" class="btn btn-success"><i class="las la-plus me-1"></i> Import</a>
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
            <div class="row mb-5">
              <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Lokasi</option>
                </select>
              </div>
              <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Sesi</option>
                </select>
              </div>
              <div class="col-3">
                <select class="form-select" name="">
                  <option value="">Filter Ruang</option>
                </select>
              </div>
            </div>
            <table class="table table-bordered table-striped datatable smalltext">
            <!-- <table class="table table-bordered table-striped table-hover datapeserta dt-responsive"> -->
              <thead>
                <tr>
                  <th>Peserta</th>
                  <th>Lokasi Formasi</th>
                  <!-- <th>Status</th> -->
                  <!-- <th>Detail Ujian</th> -->
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($peserta as $row) {?>
                  <tr>
                    <td>
                      <?= $row->nik?><br>
                      <!-- <?= $row->nomor_peserta?><br> -->
                      <b><?= $row->nama?></b><br>
                      <?= $row->jabatan?>
                    </td>
                    <td><?= $row->lokasi_formasi?></td>
                    <!-- <td></td> -->
                    <!-- <td><a href="<?= site_url('admin/ujian/peserta/detail/'.encrypt($row->id))?>" class="btn btn-sm btn-success">Lihat</a></td> -->
                    <td><a href="#" onclick="alert('Data tidak bisa dihapus karna memiliki riwayat ujian')" class="btn btn-sm btn-primary">Delete</a></td>
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
<!-- <script src="<?= base_url()?>/assets/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script> -->
<!-- <script src="<?= base_url();?>assets/libs/datatables.net//js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script> -->
<!-- <script type="text/javascript">
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
