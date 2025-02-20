<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\LokasiModel;
use App\Models\SesiModel;

class Sesi extends BaseController
{
    public function index($id)
    {
      $model = new SesiModel;
      $lmodel = new LokasiModel;
      $ujianid = decrypt($id);
      $data['sesi'] = $model->where('ujian_id',$ujianid)->findAll();
      $data['lokasi'] = $lmodel->where('ujian_id',$ujianid)->findAll();
      $data['ujianid'] = $ujianid;

      return view('admin/ujian/sesi', $data);
    }

    public function add($id)
    {
      $model = new SesiModel;
      $ujianid = decrypt($id);
      $data = [
          'ujian_id' => $ujianid,
          'kode_lokasi' => $this->request->getVar('kode_lokasi'),
          'lokasi' => $this->request->getVar('lokasi'),
          'ruang' => $this->request->getVar('ruang'),
          'sesi' => $this->request->getVar('sesi'),
          'tanggal' => $this->request->getVar('tanggal'),
          'pin' => $this->request->getVar('pin')
      ];
      $insert = $model->insert($data);

      return redirect()->back()->with('message', 'Sesi telah ditambahkan');
    }

    public function delete($id)
    {
      $model = new SesiModel;
      $insert = $model->delete($id);

      return redirect()->back()->with('message', 'Sesi telah dihapus');
    }
}
