<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Bank Soal</h4>

          <div class="page-title-right">
            <a href="" class="btn btn-primary"><i class="las la-plus me-1"></i> Tambah Kategori Baru</a>
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
                      <td><a href="<?= site_url('admin/banksoal/category/edit/'.$row->id)?>" class="btn btn-primary btn-sm">Edit</a> <a href="<?= site_url('admin/banksoal/category/delete/'.encrypt($row->id))?>" class="btn btn-danger btn-sm" onclick="return confirm('Kategori akan dihapus?')">Delete</a></td>
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
<?= $this->endSection() ?>
