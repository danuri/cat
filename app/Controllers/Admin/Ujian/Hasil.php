<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\CrudModel;

class Hasil extends BaseController
{
    public function index($id)
    {
        //
        $id = decrypt($id);
        $model = new CrudModel;
        $data['ujianid'] = $id;
        $data['hasil'] = $model->hasilNilai($id);
        return view('admin/ujian/hasil', $data);
    }
}
