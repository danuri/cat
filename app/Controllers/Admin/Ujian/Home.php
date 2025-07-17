<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\UjianModel;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/ujian/index');
    }

    public function detail($id)
    {
      $model = new UjianModel;
      $ujianid = decrypt($id);
      $data['ujian'] = $model->find($ujianid);
      $data['ujianid'] = $ujianid;
      return view('admin/ujian/detail', $data);
    }

    public function edit($id)
    {
      $id = decrypt($id);
      $model = new UjianModel;

      $data = [
          'nama' => $this->request->getVar('namaujian'),
          'kode' => $this->request->getVar('kodeujian'),
          'ket' => $this->request->getVar('keterangan'),
          'waktu_ujian' => $this->request->getVar('waktuujian'),
          'lama_ujian' => $this->request->getVar('lamaujian'),
          'show_hasil' => $this->request->getVar('showhasil'),
          'tipe_soal' => $this->request->getVar('tipesoal'),
          //'status' => 0,

          'updated_by' => session('nip')
      ];
      $update = $model->update($id,$data);

      return redirect()->back()->with('message', 'Ujian telah diupdate');
    }
}
