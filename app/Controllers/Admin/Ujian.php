<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UjianModel;
use App\Models\PesertaModel;
use App\Models\SoalUjianModel;
use App\Models\CategoryModel;

class Ujian extends BaseController
{
    public function index()
    {
      $model = new UjianModel;
      $data['ujian'] = $model->findAll();
      return view('admin/ujian/index', $data);
    }

    public function add()
    {
      return view('admin/ujian/add');
    }

    public function save()
    {
      $model = new UjianModel;

      $data = [
          'nama' => $this->request->getVar('namaujian'),
          'keterangan' => $this->request->getVar('keterangan'),
          'waktu_ujian' => $this->request->getVar('waktuujian'),
          'lama_ujian' => $this->request->getVar('lamaujian'),
          'status' => 0,
          'pin' => $this->request->getVar('pin'),
          'updated_by' => session('nip')
      ];
      $update = $model->insert($data);

      return redirect()->back()->with('message', 'Ujian telah ditambahkan');
    }

    public function edit($id)
    {
      $model = new UjianModel;
      $data['ujian'] = $model->find($id);
      return view('admin/ujian/edit', $data);
    }

    public function saveedit($id)
    {
      $model = new UjianModel;

      $data = [
          'nama' => $this->request->getVar('namaujian'),
          'keterangan' => $this->request->getVar('keterangan'),
          'waktu_ujian' => $this->request->getVar('waktuujian'),
          'lama_ujian' => $this->request->getVar('lamaujian'),
          'status' => 0,
          'pin' => $this->request->getVar('pin'),
          'updated_by' => session('nip')
      ];
      $update = $model->update($id,$data);

      return redirect()->back()->with('message', 'Ujian telah diupdate');
    }

    public function soal($id)
    {
      $model = new SoalUjianModel;
      $data['soal'] = $model->where('ujian_id',$id)->findAll();

      $catm = new CategoryModel;
      $data['categories'] = $catm->findAll();

      return view('admin/ujian/soal', $data);
    }

    public function peserta($id)
    {
      $model = new PesertaModel;
      $data['peserta'] = $model->where('ujian_id',$id)->findAll();
      return view('admin/ujian/peserta', $data);
    }
}
