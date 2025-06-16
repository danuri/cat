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
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <th>No</th>
                <th>Soal</th>
                <th>Jawaban</th>
                <th>Status</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($soal as $row) {
                ?>
                  <tr>
                    <td><?= $no?></td>
                    <td><?= $row->pertanyaan?></td>
                    <td>
                      <ol type="a">
                        <li><?= ($row->jawaban_peserta == 1)?'<b>'.$row->p1.'</b>':$row->p1;?></li>
                        <li><?= ($row->jawaban_peserta == 2)?'<b>'.$row->p2.'</b>':$row->p2;?></li>
                        <li><?= ($row->jawaban_peserta == 3)?'<b>'.$row->p3.'</b>':$row->p3;?></li>
                        <li><?= ($row->jawaban_peserta == 4)?'<b>'.$row->p4.'</b>':$row->p4;?></li>
                        <li><?= ($row->jawaban_peserta == 5)?'<b>'.$row->p5.'</b>':$row->p5;?></li>
                      </ol>
                    </td>
                    <td><?= ($row->jawaban_soal == $row->jawaban_peserta)?'<span class="text-success">Benar</span>':'<span class="text-danger">Salah</span>';?></td>
                  </tr>
                <?php $no++; } ?>
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
<?= $this->endSection() ?>
