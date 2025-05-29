<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Bank Soal</h4>

          <div class="page-title-right">
            <a href="javascript:;" class="btn btn-primary" onclick="addcategory()"><i class="fas fa-plus"></i> Tambah Kategori Baru</a>
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
                    <th>ID</th>
                    <th>Standar</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Nilai</th>
                    <th width="20%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cats as $row) {?>
                    <tr>
                      <td><?= $row->id?></td>
                      <td><?= $row->standar?></td>
                      <td><?= $row->nama?></td>
                      <td><?= $row->jenis?></td>
                      <td><?= $row->nilai?></td>
                      <td>
                        <a href="<?= site_url('admin/banksoal/category/soal/'.$row->id)?>" class="btn btn-success btn-sm">Soal</a> 
                        <a href="<?= site_url('admin/banksoal/category/edit/'.$row->id)?>" class="btn btn-primary btn-sm">Edit</a> 
                        <a href="<?= site_url('admin/banksoal/category/delete/'.encrypt($row->id))?>" class="btn btn-danger btn-sm" onclick="return confirm('Kategori akan dihapus?')">Delete</a>
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
</div>

<div class="modal fade" id="addcategory" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="defaultModalLabel">Tambah Kategori Ujian</h4>
        </div>
        <div class="modal-body" id="">
          <form class="" action="<?php echo site_url('admin/banksoal/category/add');?>" method="post" id="tambahcategory" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Standar</label>
              <input type="text" class="form-control" name="standar" id="standar">
            </div>
			      <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama">
            </div>
			      <div class="form-group">
              <label for="">Jenis</label>
              <select class="form-control" name="jenis" id="jenis">
                <option value="choice">Pilihan Ganda</option>
                <option value="interview">Wawancara</option>
              </select>
            </div>
            <div class="form-group" id="tipePilihanGroup" style="display: none;">
              <label for="">Tipe Pilihan</label>
              <input type="text" class="form-control" name="tipe_pilihan" id="tipe_pilihan">
            </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect" onclick="$('#tambahkategori').submit()">SIMPAN</button>
        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">BATAL</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#jenis').change(function() {
      if ($(this).val() === 'choice') {
        $('#tipePilihanGroup').show();
      } else {
        $('#tipePilihanGroup').hide();
      }
    });
  });

    function addpenguji() {
      $('#tambahpenguji').trigger('reset');
      $('#addpenguji').modal('show');
    }
</script>
<?= $this->endSection() ?>
