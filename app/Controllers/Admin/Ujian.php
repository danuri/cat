<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UjianModel;
use App\Models\PesertaModel;

class Ujian extends BaseController
{
    public function index()
    {
      $model = new UjianModel;
      $data['ujian'] = $model->findAll();
      return view('admin/ujian/index', $data);
    }

    public function peserta($id)
    {
      $model = new PesertaModel;
      $data['peserta'] = $model->where('ujian_id',$id)->findAll();
      return view('admin/ujian/peserta', $data);
    }
}
