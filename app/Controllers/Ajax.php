<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Ajax extends BaseController
{
    public function index()
    {
        //
    }

    function soal($id)
    {
        $model = new \App\Models\ChoiceModel;
        $soal = $model->find($id);
        if ($soal) {
            return $this->response->setJSON($soal);
        } else {
            return $this->response->setJSON(['error' => 'Soal tidak ditemukan']);
        }        
    }
}
