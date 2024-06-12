<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\UjianModel;
use App\Models\PesertaModel;
use App\Models\MapModel;
use App\Models\CategoryModel;

class Soal extends BaseController
{
    public function index($id)
    {
      $ujianid = decrypt($id);

      $db      = \Config\Database::connect();
      $builder = $db->table('map_soal');
      $builder->select('map_soal.*, bank_soal_category.standar, bank_soal_category.nama');
      $builder->join('bank_soal_category', 'bank_soal_category.id = map_soal.category_id');
      $builder->where('map_soal.ujian_id', $ujianid);
      $query = $builder->get();
      $data['soal'] = $query->getResult();


      $catm = new CategoryModel;
      $data['categories'] = $catm->findAll();

      $data['ujianid'] = $id;

      return view('admin/ujian/soal', $data);
    }

    public function add()
    {
      $model = new MapModel;

      $data = [
          'ujian_id' => $this->request->getVar('ujian_id'),
          'category_id' => $this->request->getVar('category_id'),
          'jumlah_soal' => $this->request->getVar('jumlah_soal')
      ];
      
      $insert = $model->insert($data);

      return redirect()->back()->with('message', 'Soal telah ditambahkan');
    }

    public function delete($id)
    {
      $model = new MapModel;
      $insert = $model->delete($id);

      return redirect()->back()->with('message', 'Soal telah dihapus');
    }
}
