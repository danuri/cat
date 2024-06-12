<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UjianModel;
use App\Models\MapModel;
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
          'ket' => $this->request->getVar('keterangan'),
          'waktu_ujian' => $this->request->getVar('waktuujian'),
          'lama_ujian' => $this->request->getVar('lamaujian'),
          'status' => 0,
          'updated_by' => session('nip')
      ];
      $update = $model->insert($data);

      return redirect()->back()->with('message', 'Ujian telah ditambahkan');
    }

    public function detail($id)
    {
      $model = new UjianModel;
      $ujianid = decrypt($id);
      $data['ujian'] = $model->find($ujianid);
      $data['ujianid'] = $id;
      return view('admin/ujian/detail', $data);
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
          'ket' => $this->request->getVar('keterangan'),
          'waktu_ujian' => $this->request->getVar('waktuujian'),
          'lama_ujian' => $this->request->getVar('lamaujian'),
          'status' => 0,
          'updated_by' => session('nip')
      ];
      $update = $model->update($id,$data);

      return redirect()->back()->with('message', 'Ujian telah diupdate');
    }



    public function sesi($id)
    {
      $model = new MapModel;
      $data['sesi'] = $model->where('ujian_id',$id)->findAll();


      $catm = new CategoryModel;
      $data['categories'] = $catm->findAll();

      $data['ujian_id'] = $id;

      return view('admin/ujian/soal', $data);
    }
}
