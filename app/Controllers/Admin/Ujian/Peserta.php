<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\CatModel;

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
      $cat = new CatModel;
      $pesertaid = decrypt($id);
      $data['peserta'] = $model->find($pesertaid);
      $data['soal'] = $cat->where('peserta_id',$data['peserta']->nomor_peserta)->findAll();
      $data['ujianid'] = $data['peserta']->ujian_id;

      return view('admin/ujian/peserta_detail', $data);
    }
}
