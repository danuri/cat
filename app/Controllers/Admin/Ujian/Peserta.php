<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\CatModel;
use App\Models\UjianModel;
use App\Models\CatEssayModel;

class Peserta extends BaseController
{
    public function index($id)
    {
      $model = new PesertaModel;
      $ujianid = decrypt($id);
      $data['peserta'] = $model->where('ujian_id',$ujianid)->findAll();
      $data['ujianid'] = $ujianid;
      return view('admin/ujian/peserta', $data);
    }

    public function detail($id)
    {
      $model = new PesertaModel;
      $ujian = new UjianModel;
      
      $pesertaid = decrypt($id);

      $data['peserta'] = $model->find($pesertaid);
      $data['ujianid'] = $data['peserta']->ujian_id;
      $data['ujian'] = $ujian->where('id',$data['peserta']->ujian_id)->first();

      if ($data['ujian']->tipe_soal == "essay") {
        // tipe soal = essay
        $cat = new CatEssayModel;
        $data['soal'] = $cat->where('ujian_id',$data['peserta']->ujian_id)
                            ->where('peserta_id',$data['peserta']->nomor_peserta)
                            ->findAll();
        // print_r($data['soal']);
        // exit();
        return view('admin/ujian/peserta_detail_essay', $data);
      } else {
        // tipe soal = choice
        $cat = new CatModel;
        $data['soal'] = $cat->where('ujian_id',$data['peserta']->ujian_id)
                            ->where('peserta_id',$data['peserta']->nomor_peserta)
                            ->findAll();     
        return view('admin/ujian/peserta_detail', $data);
      }
    }

    public function submit() {
      $id_soal = $this->request->getPost('id_soal');
      $nilai = $this->request->getPost('nilai');
      //print_r($id_soal);
      //exit();
      //$model->update($pesertaid, ['status' => 'selesai']);
      //return redirect()->to('/admin/ujian/hasil/'.$ujianid);
    }
}
