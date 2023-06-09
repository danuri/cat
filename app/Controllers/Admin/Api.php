<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;

class Api extends BaseController
{
    public function index()
    {
        //
    }

    public function peserta($nopes)
    {
      $model = new PesertaModel;
      $peserta = $model->where(['nomor_peserta'=>$nopes])->first();

      if($peserta){
        $json = array('message'=>'success','peserta'=>$peserta);
      }else{
        $json = array('message'=>'error');
      }
      return $this->response->setJSON($json);
    }
}
