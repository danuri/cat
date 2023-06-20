<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WawancaraModel;
use App\Models\EssayModel;
use App\Models\PesertaModel;

class Wawancara extends BaseController
{
    public function index()
    {
        return view('admin/wawancara/index');
    }

    public function search()
    {
      // code...
    }

    public function test($nopes)
    {
      $this->createsoal($nopes);

      $model = new WawancaraModel;
      $data['soal'] = $model->where(['peserta_id'=>$nopes])->findAll();
      return view('admin/wawancara/test', $data);
    }

    public function createsoal($nopes)
    {
      $model = new WawancaraModel;

      $cek = $model->where(['peserta_id'=>$nopes])->find();

      if($cek){
        return true;
      }else{
        $pm = new PesertaModel;
        $peserta = $pm->where(['nomor_peserta'=>$nopes])->first();

        $esmodel = new EssayModel;
        if($peserta->jenis_peserta == '34'){
          $soal = $esmodel->getsoal('Pertama');
        }else if($peserta->jenis_peserta == '35'){
          $soal = $esmodel->getsoal('Muda');
        }else if($peserta->jenis_peserta == '36'){
          $soal = $esmodel->getsoal('Madya');
        }else if($peserta->jenis_peserta == '37'){
          $soal = $esmodel->getsoal('Utama');
        }

        foreach ($soal as $row) {
          $data = [
            'ujian_id' => '4',
            'soal_id' => '',
            'peserta_id' => $nopes,
            'kompetensi' => $row->kompetensi,
            'kompetensi_dasar' => $row->kompetensi_dasar,
            'kode' => $row->kode
          ];

          $insert = $model->insert($data);
        }

        return true;
      }
    }

    public function createsoalx($nopes)
    {
      $model = new WawancaraModel;

      $cek = $model->where(['peserta_id'=>$nopes])->find();

      if($cek){
        return true;
      }else{
        $pm = new PesertaModel;
        $peserta = $pm->where(['nomor_peserta'=>$nopes])->first();

        $esmodel = new EssayModel;
        if($peserta->jenis_peserta == '34'){
          $soal = $esmodel->where(['jenjang'=>'Pertama'])->findAll();
        }else if($peserta->jenis_peserta == '35'){
          $soal = $esmodel->where(['jenjang'=>'Muda'])->findAll(10,0);
        }else if($peserta->jenis_peserta == '36'){
          $soal = $esmodel->where(['jenjang'=>'Madya'])->findAll(10,0);
        }else if($peserta->jenis_peserta == '37'){
          $soal = $esmodel->where(['jenjang'=>'Utama'])->findAll(10,0);
        }

        foreach ($soal as $row) {
          $data = [
            'ujian_id' => '4',
            'soal_id' => $row->id,
            'peserta_id' => $nopes,
            'pertanyaan' => $row->kompetensi_dasar
          ];

          $insert = $model->insert($data);
        }

        return true;
      }
    }

    public function getsoal($id)
    {
      $esmodel = new EssayModel;
      $soal = $esmodel->getcontohsoal($id);

      echo '<ul>';
      foreach ($soal as $row) {
        echo '<li>'. $row->soal.'</li>';
      }
      echo '</ul>';

    }

    public function savenilai($nopes)
    {
      $model = new WawancaraModel;

      $id = $this->request->getVar('soal_id');
      $nilai = $this->request->getVar('nilai');
      $catatan = $this->request->getVar('catatan');
      $soal = $this->request->getVar('soal');

      $update = $model->set(['nilai'=>$nilai,'catatan'=>$catatan,'soal'=>$soal,'created_by'=>session('nip')])->where(['id'=>$id])->update();

      return redirect()->back()->with('message', 'Nilai telah disimpan');
    }
}
