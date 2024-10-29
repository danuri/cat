<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CatModel;
use App\Models\LogModel;
use App\Models\CrudModel;
use App\Models\UjianModel;
use App\Models\CategoryModel;
use App\Models\MapModel;

class Cat extends BaseController
{
    public function index()
    {
      $cat = new CatModel;
      $log = new LogModel;
      $ujian = new UjianModel;
      $category = new CategoryModel;
      $map = new MapModel;

      $user_id = session('nomor_peserta');

      //$data['soals']    = $cat->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->findAll();
      $soal_list        = $cat->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->findAll();
      // $data['jumlah']   = 0;
      $data['jumlah']   = $cat->where(['peserta_id' => session('nomor_peserta'), 'ujian_id' => session('ujian_id'), 'jawaban_peserta !=' => null])->countAllResults();
      $data['log']      = $log->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->first();
      $data['ujian'] = $ujian->where(['id'=>session('ujian_id')])->first();
      $data_map = $map->where(['ujian_id' => session('ujian_id')])->findAll();
      //echo $data_map[0]->category_id;
      //exit();
      $category_list = array();
      for ($i=0; $i < count($data_map); $i++) {
        $category_data = $category->where(['id'=>$data_map[$i]->category_id])->first();
        $data['category'][$i] = $category_data;
        $category_list[$i] = $category_data;
      } 
      $soals = array();
      for ($i=0; $i < count($soal_list); $i++) {
        $category_id = $soal_list[$i]->category_id;
        $search_category = array_filter($category_list, function($obj) use ($category_id) {
          return $obj->id === $category_id;
        });
        $input = array(
          'id' => $soal_list[$i]->id,
          'pertanyaan' => $soal_list[$i]->pertanyaan,
          'p1' => $soal_list[$i]->p1,
          'p2' => $soal_list[$i]->p2,
          'p3' => $soal_list[$i]->p3,
          'p4' => $soal_list[$i]->p4,
          'p5' => $soal_list[$i]->p5,
          'jawaban_soal' => $soal_list[$i]->jawaban_soal,
          'bobot_p1' => $soal_list[$i]->bobot_p1,
          'bobot_p2' => $soal_list[$i]->bobot_p2,
          'bobot_p3' => $soal_list[$i]->bobot_p3,
          'bobot_p4' => $soal_list[$i]->bobot_p4,
          'bobot_p5' => $soal_list[$i]->bobot_p5,
          'value_type' => $soal_list[$i]->value_type,
          'bobot' => $soal_list[$i]->bobot,
          'category_id' => $soal_list[$i]->category_id,
          'category_name' => array_values($search_category)[0]->nama,
          'jawaban_peserta' => $soal_list[$i]->jawaban_peserta,
          'jawaban_nilai' => $soal_list[$i]->jawaban_nilai
        );
        $soals[$i] = $input;
      }
      usort($soals, function ($a, $b) {
        return $a['category_id'] <=> $b['category_id']; 
      });
      $data['soals'] = $soals;
      //echo $data;
      //exit();
      return view('cat', $data);
    }

    public function save()
    {
      $cat = new CatModel;
      $log = new LogModel;
      $category = new CategoryModel;

      $user_id = session('nomor_peserta');
      $ceklog		= $log->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->first();

			if(strtotime($ceklog->finish_time) <= time() || $ceklog->status == 1){
				echo '0';
			}else{
        $check = (array) $cat->find($this->request->getVar('soal_id'));

				$jp = $this->request->getVar('jawaban_peserta');
				if($check['category_id'] == 13){

					$jnilai = explode('##',$check['p'.$jp])[1];

					$data = array(
						'jawaban_peserta' => $jp,
						'jawaban_nilai' => $jnilai
					);
				} else {
          if ($check['value_type'] == 1) { 
            if ($check['jawaban_soal'] == $jp) {
              $jawaban_nilai = $check['bobot'];
            } else {
              $jawaban_nilai = '0';
            }
            $data = array(
              'jawaban_peserta' => $jp,
              'jawaban_nilai' => $jawaban_nilai
            );
          } elseif ($check['value_type'] == 2) {   
            if ($check['jawaban_soal'] == $jp) {
              $jawaban_nilai = $check['bobot'];
            } else {
              $jawaban_nilai = '0';
            }         
            $data = array(
              'jawaban_peserta' => $jp,
              'jawaban_nilai' => $jawaban_nilai
            );
          } elseif ($check['value_type'] == 3) {
            $jawaban_nilai = $check['bobot_p'.$jp];
            $data = array(
              'jawaban_peserta' => $jp,
              'jawaban_nilai' => $jawaban_nilai
            );
          }
				}
				$param = array(
					'id' => $this->request->getVar('soal_id'),
					'peserta_id' => session('nomor_peserta'),
					'ujian_id' => session('ujian_id')
				);
				$update = $cat->set($data)->where($param)->update();
				echo '1';
			}
    }

    public function selesai()
    {
      $log = new LogModel;
      $crud = new CrudModel;
         
      $nilai = $crud->getNilaiV4(session('nomor_peserta'), session('ujian_id'));

      $data = array(
        'status' => 1,
        'finish_nilai' => $nilai[0]->nilai
      );

      $log->set($data)->where(['peserta_id'=>session('nomor_peserta'), 'ujian_id'=>session('ujian_id')])->update();   
      return redirect()->to('');
    }
}
