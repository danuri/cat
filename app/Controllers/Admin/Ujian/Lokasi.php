<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    public function index($id)
    {
        $model = new LokasiModel;
        $ujianid = decrypt($id);
        $data['lokasi'] = $model->where('ujian_id',$ujianid)->findAll();
        $data['ujianid'] = $ujianid;

        return view('admin/ujian/lokasi', $data);
    }

    public function add($id)
    {
      $model = new LokasiModel;

      $data = [
          'ujian_id' => $id,
          'lokasi' => $this->request->getVar('lokasi'),
          'titik_lokasi' => $this->request->getVar('titik_lokasi'),
          'alamat' => $this->request->getVar('alamat'),
          'username' => $this->request->getVar('username'),
          'password' => md5($this->request->getVar('password'))
      ];
      $insert = $model->insert($data);

      return redirect()->back()->with('message', 'Lokasi telah ditambahkan');
    }

    public function delete($id)
    {
      $id = decrypt($id);
      $model = new LokasiModel;
      $insert = $model->delete($id);

      return redirect()->back()->with('message', 'Lokasi telah dihapus');
    }
}
