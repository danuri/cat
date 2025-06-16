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
              <li class="breadcrumb-item active">Hasil CAT</li>
              <li class="breadcrumb-item active">Detail Peserta</li>
            </ol>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            No Peserta : <b><?= $peserta->nomor_peserta?></b>
            <br>
            Nama Peserta : <b><?= $peserta->nama?></b>
            <br>
            Jabatan Peserta : <b><?= $peserta->jabatan?></b>
            <br>
            Lokasi Peserta : <b><?= $peserta->lokasi_formasi?></b>
            <br>
            Ujian : <b><?= $ujian->nama?></b>
            <br>
            Nilai : <b><?= $log->finish_nilai?></b>
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
        <div class="card">
          <div class="card-body">
            <form class="" action="<?= site_url('admin/ujian/hasil/submit')?>" method="post">
              <input type="hidden" name="nomor_peserta" value="<?= $peserta->nomor_peserta?>">
              <input type="hidden" name="ujian_id" value="<?= $ujianid?>">
              <div class="row mb-3">
                <div class="col-lg-5">                    
                    <button type="submit" class="btn btn-primary" name="submit" onclick="return confirm('Yakin nilai akan disubmit?')">Submit</button>
                </div>
                <div class="col-lg-7">
                </div>
              </div>
            <table class="table table-bordered table-striped smalltext responsive">
              <colgroup>
                <col style="width: 5%;"> <!-- No -->
                <col style="width: 40%;"> <!-- Soal -->
                <col style="width: 40%;"> <!-- Jawaban -->
                <col style="width: 5%;"> <!-- Bobot -->
                <col style="width: 10%;"> <!-- Nilai -->
              </colgroup>  
              <thead>
                <th hidden>Id</th>
                <th>No</th>
                <th>Soal</th>
                <th>Jawaban</th>
                <th>Bobot</th>
                <th>Nilai</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($soal as $row) {
                ?>
                  <tr>
                    <td hidden><input type="text" name="id_soal[]" value="<?= $row['id']?>"></td>
                    <td hidden><input type="text" name="bobot[]" value="<?= $row['bobot']?>"></td>
                    <td><?= $no?></td>
                    <!-- <td><textarea readonly class="form-control auto-resize" oninput="autoResize(this)"><?= $row['pertanyaan']?></textarea></td> -->
                    <!-- <td><textarea readonly class="form-control auto-resize" oninput="autoResize(this)"><?= $row['jawaban_peserta']?></textarea></td> -->
                    <td><?= nl2br($row['pertanyaan'])?></td>
                    <td><?= nl2br($row['jawaban_peserta'])?></td>
                    <td><?= $row['bobot']?></td>
                    <td><input type="number" class="form-control" name="nilai[]" value="<?= $row['jawaban_nilai']?>" data-bobot="<?= $row['bobot'] ?>"></td>
                  </tr>
                <?php $no++; } ?>
              </tbody>
            </table>            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /content area -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
    function autoResize(textarea) {
        textarea.style.height = 'auto'; // Reset height
        textarea.style.height = textarea.scrollHeight + 'px'; // Set to full content height
    }

    // Jalankan autoResize untuk semua textarea dengan class "auto-resize" saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.auto-resize').forEach(autoResize);
    });

    document.querySelectorAll('.nilai-input').forEach(function(input) {
      input.addEventListener('input', function() {
        const bobot = parseFloat(this.dataset.bobot) || 0;
        const nilai = parseFloat(this.value) || 0;

        if (nilai > bobot) {
          alert('Nilai tidak boleh lebih dari bobot!');
          this.value = bobot;
        }
      });
    });
</script>
<?= $this->endSection() ?>
