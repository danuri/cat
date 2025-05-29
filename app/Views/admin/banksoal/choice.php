<?= $this->extend('admin/template') ?>

<?= $this->section('content') ?>

<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Bank Soal <?= ($category)?$category->nama:''?></h4>

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
        <a href="javascript:;" class="btn btn-primary" onclick="add(<?= $category->id?>)"><i class="las la-plus me-1"></i> Tambah Soal Baru</a>
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
            <div class="table-responsive">
              <table class="table table-bordered table-striped datatable smalltext">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Pertanyaan</th>
                    <th>Pilihan Jawaban</th>
                    <th width="20%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($soal as $row) {?>
                    <tr>
                      <td><?= $row->id?></td>
                      <td><?= $row->pertanyaan?></td>
                      <td>
                        a. <?= $row->p1?><br>
                        b. <?= $row->p2?><br>
                        c. <?= $row->p3?><br>
                        d. <?= $row->p4?><br>
                        e. <?= $row->p5?>
                      </td>
                      <td><a href="javascript:;" onclick="edit(<?= $row->id?>)" class="btn btn-primary btn-sm">Edit</a> <a href="<?= site_url('admin/banksoal/deletechoice/'.$row->id)?>" class="btn btn-danger btn-sm" onclick="return confirm('Soal akan dihapus?')">Delete</a></td>
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

<div id="addmodal" class="modal fade" data-bs-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Tambah Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="<?= site_url('admin/banksoal/addchoice')?>" method="post" id="addform">
              <div class="mb-3">
                <label for="p1" class="form-label">Kategori</label>
                <select class="form-select" name="category_id">
                  <option value="<?= $category->id?>"><?= $category->nama?></option>
                </select>
              </div>
              <div class="mb-3">
                  <label for="pertanyaan" class="form-label">Pertanyaan</label>
                  <textarea class="form-control" id="pertanyaan" name="pertanyaan" rows="3" placeholder="Masukan pertanyaan" required></textarea>
              </div>
              <div class="mb-3">
                  <label for="p1" class="form-label">Pilihan 1 (Isi dengan jawaban benar)</label>
                  <input type="text" class="form-control" name="p1" id="p1" placeholder="Pilihan 1" required>
              </div>
              <div class="mb-3">
                  <label for="p2" class="form-label">Pilihan 2</label>
                  <input type="text" class="form-control" name="p2" id="p2" placeholder="Pilihan 2" required>
              </div>
              <div class="mb-3">
                  <label for="p3" class="form-label">Pilihan 3</label>
                  <input type="text" class="form-control" name="p3" id="p3" placeholder="Pilihan 3" required>
              </div>
              <div class="mb-3">
                  <label for="p4" class="form-label">Pilihan 4</label>
                  <input type="text" class="form-control" name="p4" id="p4" placeholder="Pilihan 4" required>
              </div>
              <div class="mb-3">
                  <label for="p5" class="form-label">Pilihan 5</label>
                  <input type="text" class="form-control" name="p5" id="p5" placeholder="Pilihan 5" required>
              </div>
          </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="$('#addform').submit()">Kirim</button>
            </div>
        </div>
    </div>
</div>

<div id="editmodal" class="modal fade" data-bs-backdrop="static" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="<?= site_url('admin/banksoal/editchoice')?>" method="post" id="editform">
              <input type="hidden" name="id" id="idsoal">
              <div class="mb-3">
                <label for="p1" class="form-label">Kategori</label>
                <select class="form-select" name="category_id" id="category_id">
                  <option value="<?= $category->id?>"><?= $category->nama?></option>
                </select>
              </div>
              <div class="mb-3">
                  <label for="pertanyaan" class="form-label">Pertanyaan</label>
                  <textarea class="form-control" id="epertanyaan" name="pertanyaan" rows="3" placeholder="Masukan pertanyaan" required></textarea>
              </div>
              <div class="mb-3">
                  <label for="p1" class="form-label">Pilihan 1 (Isi dengan jawaban benar)</label>
                  <input type="text" class="form-control" name="p1" id="ep1" placeholder="Pilihan 1" required>
              </div>
              <div class="mb-3">
                  <label for="p2" class="form-label">Pilihan 2</label>
                  <input type="text" class="form-control" name="p2" id="ep2" placeholder="Pilihan 2" required>
              </div>
              <div class="mb-3">
                  <label for="p3" class="form-label">Pilihan 3</label>
                  <input type="text" class="form-control" name="p3" id="ep3" placeholder="Pilihan 3" required>
              </div>
              <div class="mb-3">
                  <label for="p4" class="form-label">Pilihan 4</label>
                  <input type="text" class="form-control" name="p4" id="ep4" placeholder="Pilihan 4" required>
              </div>
              <div class="mb-3">
                  <label for="p5" class="form-label">Pilihan 5</label>
                  <input type="text" class="form-control" name="p5" id="ep5" placeholder="Pilihan 5" required>
              </div>
          </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="$('#editform').submit()">Kirim</button>
            </div>
        </div>
    </div>
</div>

<!-- /content area -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>/assets/js/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>/assets/js/vendor/tables/datatables/datatables.min.js"></script>
<script src="<?= base_url()?>/assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function add(id) {
  $('#addmodal').modal('show');
}

function edit(id) {
  axios.get('<?= site_url() ?>ajax/soal/'+id)
  .then(function (response) {
    console.log(response.data);
    $('#idsoal').val(response.data.id);
    $('#epertanyaan').val(response.data.pertanyaan);
    $('#ep1').val(response.data.p1);
    $('#ep2').val(response.data.p2);
    $('#ep3').val(response.data.p3);
    $('#ep4').val(response.data.p4);
    $('#ep5').val(response.data.p5);
  })
  .catch(function (error) {
    alert('Data tidak ditemukan');
  })
  .finally(function () {
    // always executed
  });
  $('#editmodal').modal('show');
}
</script>
<?= $this->endSection() ?>
