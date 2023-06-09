<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EssayModel;

class Wawancara extends BaseController
{
    public function index()
    {
        return view('admin/wawancara/index');
    }

    public function test($nopes)
    {
      $model = new EssayModel;
      $data['soal'] = $model->findAll();
      return view('admin/wawancara/test', $data);
    }
}
