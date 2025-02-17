<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ChoiceModel;
use App\Models\CategoryModel;
use App\Models\EssayModel;
use App\Models\CrudModel;

class Banksoal extends BaseController
{
    public function index()
    {
      $model = new CategoryModel;
      $crud = new CrudModel;

      $data['cats'] = $model->findAll();
      $data['choice_type'] = $crud->getResult('bank_soal_choice_type');
      return view('admin/banksoal/category', $data);
    }

    public function categoryEdit($id)
    {
      // code...
    }

    public function choice()
    {
      $model = new ChoiceModel;

      $data['soal'] = $model->findAll();

      return view('admin/banksoal/choice', $data);
    }

    public function addchoice()
    {
      $model = new CategoryModel;

      $data['cats'] = $model->findAll();

      return view('admin/banksoal/addchoice', $data);
    }

    public function editchoice()
    {
      $model = new CategoryModel;

      $data['cats'] = $model->findAll();

      return view('admin/banksoal/editchoice', $data);
    }

    public function savechoice()
    {
      $model = new ChoiceModel;

      $data = [
          'pertanyaan' => $this->request->getVar('pertanyaan'),
          'category_id' => $this->request->getVar('category_id'),
          'p1' => $this->request->getVar('p1'),
          'p2' => $this->request->getVar('p2'),
          'p3' => $this->request->getVar('p3'),
          'p4' => $this->request->getVar('p4'),
          'p5' => $this->request->getVar('p5')
      ];

      $insert = $model->insert($data);

      return redirect()->back()->with('message', 'Soal telah ditambahkan');
    }

    public function deletechoice($id)
    {
      $model = new ChoiceModel;
      $delete = $model->delete($id);

      return redirect()->back()->with('message', 'Soal telah dihapus');
    }

    public function essay()
    {
      $model = new EssayModel;

      $data['soal'] = $model->findAll();

      return view('admin/banksoal/essay', $data);
    }

    public function addessay()
    {
      return view('admin/banksoal/addessay');
    }

    public function saveessay()
    {
      $model = new EssayModel;

      $data = [
          'pertanyaan' => $this->request->getVar('pertanyaan'),
          'bobot' => $this->request->getVar('bobot')
      ];

      $insert = $model->insert($data);

      return redirect()->back()->with('message', 'Soal telah ditambahkan');
    }
}
