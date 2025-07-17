<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Manajemen Ujian</h4>

                <div class="page-title-right">
                    <!-- <a href="<?= site_url('admin/ujian/add')?>" class="btn btn-sm btn-primary"><i class="las la-plus me-1"></i> Buat Ujian</a> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addujian"><i class="las la-plus me-1"></i>Buat Ujian</button>
                </div>

            </div>
        </div>
    </div>

    <div class="row pb-4 gy-3">
      <div class="col-sm-4">

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
            <table class="table table-bordered table-striped datatable smalltext">
              <thead>
                <tr>
                  <th>CREATED AT</th>
                  <th>UJIAN</th>
                  <th>LAMA UJIAN</th>
                  <th>TIPE UJIAN</th>
                  <th>HASIL UJIAN</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ujian as $row) {?>
                  <tr>
                    <td><?= $row->waktu_ujian?></td>
                    <td><?= $row->nama?></td>
                    <td><?= $row->lama_ujian?></td>
                    <td><?php if ($row->tipe_soal == 'choice') {
                              echo 'Pilihan Ganda';
                            } elseif ($row->tipe_soal == 'essay') {
                              echo 'Essay';
                            } elseif ($row->tipe_soal == 'wawancara') {
                              echo 'Wawancara';
                            }
                    ?></td>
                    <td><?php if ($row->show_hasil == 'Y') {
                                echo 'Tampilkan Hasil';
                              } else {
                                echo 'Tidak Tampilkan Hasil';
                              }                            
                    ?></td>
                    <td><a href="<?= site_url('admin/ujian/detail/'.encrypt($row->id))?>" class="btn btn-sm btn-primary">Detail</a> <a href="<?= site_url('admin/ujian/delete/'.encrypt($row->id))?>" class="btn btn-sm btn-danger">Delete</a></td>
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

<div class="modal fade" id="addujian" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="defaultModalLabel">Tambah Ujian</h4>
        </div>
        <div class="modal-body" id="">
          <form class="" action="<?php echo site_url('admin/ujian/add');?>" method="post" id="tambahujian" enctype="multipart/form-data">
            <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="namaujian" class="form-label">Nama Ujian</label>
                  </div>
                  <div class="col-lg-9">
                      <input type="text" class="form-control" id="namaujian" name="namaujian" placeholder="Nama Ujian">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="kodeujian" class="form-label">Kode Ujian</label>
                  </div>
                  <div class="col-lg-9">
                      <input type="text" class="form-control" id="kodeujian" name="kodeujian" placeholder="Kode Ujian">
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                  </div>
                  <div class="col-lg-9">
                      <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="tipesoal" class="form-label">Tipe Ujian</label>
                  </div>
                  <div class="col-lg-9">
                      <select name="tipesoal" id="tipesoal" class="form-control">
                          <option value="choice">Pilihan Ganda</option>
                          <option value="essay">Essay</option>
                          <option value="wawancara">Wawancara</option>
                      </select>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="showhasil" class="form-label">Tampilkan Hasil Ujian?</label>
                  </div>
                  <div class="col-lg-9">
                      <select name="showhasil" id="showhasil" class="form-control">
                          <option value="Y">Ya</option>
                          <option value="N">Tidak</option>
                      </select>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-3">
                      <label for="lamaujian" class="form-label">Lama Ujian</label>
                  </div>
                  <div class="col-lg-9">
                      <div class="input-group">
                          <input type="number" class="form-control" id="lamaujian" name="lamaujian">
                          <div class="input-group-text">menit</div>
                      </div>
                  </div>
              </div>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect" onclick="$('#tambahujian').submit()">SIMPAN</button>
        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">BATAL</button>
      </div>
    </div>
  </div>
</div>

<!-- /content area -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
  $(function() {
  $('.datatable').DataTable().destroy(); // hentikan inisialisasi lama
  $('.datatable').DataTable({
    "order": [[0, "desc"]]
  });
});
</script>
<?= $this->endSection() ?>
