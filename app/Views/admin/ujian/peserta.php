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
        <!-- <a href="<?= site_url('admin/ujian/peserta/add/'.encrypt($ujianid))?>" class="btn btn-primary"><i class="las la-plus me-1"></i> Peserta Baru</a> -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpeserta"><i class="las la-plus me-1"></i>Peserta Baru</button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importpeserta"><i class="las la-plus me-1"></i>Import</button>
        <a href="<?php echo base_url();?>downloads/Template_Import_Peserta.xlsx" class="btn btn-info"><i class="las la-download me-1"></i>Template Excel</a>
      </div>

      <div class="col-sm-auto ms-auto">
        <div class="d-flex gap-3">

        </div>
      </div>
    </div>
    <?php if (session()->getFlashdata('message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
          <form method="get" action="<?= site_url('admin/ujian/peserta/'.encrypt($ujian->id)) ?>">
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
            <!-- <table class="table table-bordered table-striped table-hover datapeserta dt-responsive"> -->
              <thead>
                <tr>
                  <th style="width: 30%;">Peserta</th>
                  <th style="width: 30%;">Lokasi Formasi</th>
                  <th style="width: 28%;">Info Ujian</th>
                  <th style="width: 12%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($peserta as $row) {?>
                  <tr>
                    <td>
                      <?= $row->nik?><br>
                      <b><?= $row->nama?></b><br>
                      <?= $row->jabatan?>
                    </td>
                    <td><?= $row->lokasi_formasi?></td>
                    <td>
                      <?= $ujian->nama?><br>
                      Lokasi: <?= $row->lokasi?><br>
                    </td>
                    <!-- <td><a href="<?= site_url('admin/ujian/peserta/detail/'.encrypt($row->id))?>" class="btn btn-sm btn-success">Lihat</a></td> -->
                    <td>
                      <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" onclick="editpeserta('<?= $row->id?>','<?= $row->nik?>','<?= $row->nama?>','<?= $row->jabatan?>','<?= $row->lokasi_formasi?>','<?= $row->sesi_id?>','<?= $row->ujian_id?>')">Edit</button>
                      <a href="<?= site_url('admin/ujian/peserta-delete/'.encrypt($row->id))?>" onclick="alert('Apakah Anda yakin hapus peserta ini (<?= $row->nik?> - <?= $row->nama?>)?')" class="btn btn-sm btn-primary">Delete</a>
                    </td>
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

  <div class="modal fade" id="importpeserta" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="title" id="defaultModalLabel">Import Peserta</h4>
          </div>
          <div class="modal-body" id="">
            <form class="" action="<?php echo site_url('admin/ujian/peserta/import');?>" method="post" id="import_peserta" enctype="multipart/form-data">
              <div class="form-group">
                <label for="">Upload Excel</label><br>
                <input type="file" name="fileexcel" accept=".xlsx" id="fileexcel" required>
                <input type="hidden" class="form-control" name="ujianid" id="ujianid" value="<?= $ujian->id?>">
              </div>			      
            </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary waves-effect" onclick="$('#import_peserta').submit()">IMPORT</button>
          <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">BATAL</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="addpeserta" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="defaultModalLabel">Tambah Peserta</h4>
        </div>
        <div class="modal-body" id="">
          <form class="" action="<?php echo site_url('admin/ujian/peserta/add');?>" method="post" id="tambahpeserta" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Ujian</label>
              <input type="text" class="form-control" value="<?= $ujian->nama?>" readonly>
              <input type="hidden" class="form-control" name="ujianid" id="ujianid" value="<?= $ujian->id?>">
            </div>
			      <div class="form-group">
              <label for="">Sesi</label>
              <select class="form-control" name="sesiid" id="sesiid" required>
                <?php foreach ($sesi as $row) {?>
                  <option value="<?= $row->id?>"><?="Tanggal: ".$row->tanggal." - "."Lokasi: ".$row->lokasi." - Ruang: ".$row->ruang." - Sesi: ".$row->sesi?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">NIP Peserta / Nomor Peserta</label>
              <input type="text" class="form-control" name="nik" id="nik" required>
            </div>
            <div class="form-group">
              <label for="">Nama Peserta</label>
              <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="form-group">
              <label for="">Jabatan</label>
              <input type="text" class="form-control" name="jabatan" id="jabatan" required>
            </div>
            <div class="form-group">
              <label for="">Lokasi Formasi</label>
              <input type="text" class="form-control" name="lokasi_formasi" id="lokasi_formasi" required>
            </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect" onclick="$('#tambahpeserta').submit()">SIMPAN</button>
        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">BATAL</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editpeserta" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="defaultModalLabel">Edit Peserta</h4>
        </div>
        <div class="modal-body" id="">
          <form class="" action="<?php echo site_url('admin/ujian/peserta/edit');?>" method="post" id="updatepeserta" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="edit_id" id="edit_id">
            <div class="form-group">
              <label for="">Ujian</label>
              <input type="text" class="form-control" value="<?= $ujian->nama?>" readonly>
              <input type="hidden" class="form-control" name="edit_ujianid" id="edit_ujianid" value="<?= $ujian->id?>">
            </div>
			      <div class="form-group">
              <label for="">Sesi</label>
              <select class="form-control" name="edit_sesiid" id="edit_sesiid">
                <?php foreach ($sesi as $row) {?>
                  <option value="<?= $row->id?>"><?="Tanggal: ".$row->tanggal." - "."Lokasi: ".$row->lokasi." - Ruang: ".$row->ruang." - Sesi: ".$row->sesi?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">NIP Peserta / Nomor Peserta</label>
              <input type="text" class="form-control" name="edit_nik" id="edit_nik">
              <input type="hidden" class="form-control" name="edit_nik_asli" id="edit_nik_asli">
            </div>
            <div class="form-group">
              <label for="">Nama Peserta</label>
              <input type="text" class="form-control" name="edit_nama" id="edit_nama">
            </div>
            <div class="form-group">
              <label for="">Jabatan</label>
              <input type="text" class="form-control" name="edit_jabatan" id="edit_jabatan">
            </div>
            <div class="form-group">
              <label for="">Lokasi Formasi</label>
              <input type="text" class="form-control" name="edit_lokasi_formasi" id="edit_lokasi_formasi">
            </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect" onclick="$('#updatepeserta').submit()">SIMPAN</button>
        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">BATAL</button>
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
<script type="text/javascript">
  function editpeserta(id, nik, nama, jabatan, lokasi_formasi, sesi_id, ujian_id) {
    $('#edit_id').val(id);
    $('#edit_nik').val(nik);
    $('#edit_nik_asli').val(nik);
    $('#edit_nama').val(nama);
    $('#edit_jabatan').val(jabatan);
    $('#edit_lokasi_formasi').val(lokasi_formasi);
    $('#edit_sesiid').val(sesi_id);
    $('#editpeserta').modal('show');
  }
</script>
<?= $this->endSection() ?>
