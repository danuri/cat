<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\PesertaModel;

class Peserta extends BaseController
{
    public function index($id)
    {
      $model = new PesertaModel;
      $ujianid = decrypt($id);
      $data['peserta'] = $model->where('ujian_id',$ujianid)->findAll();
      $data['ujianid'] = $id;
      return view('admin/ujian/peserta', $data);
    }
}
