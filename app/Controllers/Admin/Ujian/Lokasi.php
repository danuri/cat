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
        $data['ujianid'] = $id;

        return view('admin/ujian/lokasi', $data);
    }

    public function add($id)
    {
      $model = new LokasiModel;

      $data = [
          'ujian_id' => $id,
          'lokasi' => $this->request->getVar('category_id'),
          'titik_lokasi' => $this->request->getVar('jumlah_soal'),
          'alamat' => $this->request->getVar('jumlah_soal'),
          'username' => $this->request->getVar('username'),
          'password' => md5($this->request->getVar('password'))
      ];
      $insert = $model->insert($data);

      return redirect()->back()->with('message', 'Lokasi telah ditambahkan');
    }

    public function delete($id)
    {
      $model = new LokasiModel;
      $insert = $model->delete($id);

      return redirect()->back()->with('message', 'Lokasi telah dihapus');
    }
}
