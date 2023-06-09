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
              <li class="breadcrumb-item"><a href="<?= site_url('admin/banksoal/choice')?>" class="btn btn-success text-white"><i class="las la-plus me-1"></i> Kembali</a></li>
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
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body">
            <form action="" method="post">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Nomor Peserta" id="nopes">
                  <button class="btn btn-outline-success" type="button" onclick="ready()">Mulai</button>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-center ready" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mt-4">
                  <h4 class="mb-3">Mulai wawancara?</h4>
                  <table class="table table-bordered table-striped">
                    <tbody>
                      <tr>
                        <th>Nomor Peserta</th>
                        <th id="nomor_peserta"></th>
                      </tr>
                      <tr>
                        <th>Nama</th>
                        <th id="nama"></th>
                      </tr>
                      <tr>
                        <th>Jenis Jenjang</th>
                        <th id="jenjang"></th>
                      </tr>
                    </tbody>
                  </table>
                    <div class="hstack gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                        <a href="" id="link" class="btn btn-danger">Lanjutkan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script type="text/javascript">
  function ready() {
    axios.get('<?= site_url('admin/api/peserta')?>/'+$('#nopes').val())
    .then(function (response) {
      console.log(response.data);
      $('#nomor_peserta').html(response.data.peserta.nomor_peserta);
      $('#nama').html(response.data.peserta.nama);
      $('#jenjang').html(response.data.peserta.jabatan);
      $('#link').attr('href','<?= site_url('admin/wawancara/test')?>/'+response.data.peserta.nomor_peserta);
      $('.ready').modal('show');
    });
  }
</script>
<?= $this->endSection() ?>
