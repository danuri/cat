<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CatEssayModel;
use App\Models\LogModel;
use App\Models\CrudModel;
use App\Models\UjianModel;
use App\Models\CategoryModel;
use App\Models\MapModel;

class CatEssay extends BaseController
{
    public function index()
    {
      // check user agent
      $check = $this->checkUserAgent();
      if (!$check) {
        return view('errors/error');
      }

      $cat = new CatEssayModel;
      $log = new LogModel;
      $ujian = new UjianModel;
      $category = new CategoryModel;
      $map = new MapModel;

      $user_id = session('nomor_peserta');

      $soal_list        = $cat->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->findAll();
      
      $data['jumlah']   = $cat->where(['peserta_id' => session('nomor_peserta'), 'ujian_id' => session('ujian_id'), 'jawaban_peserta !=' => null])->countAllResults();
      $data['log']      = $log->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->first();
      $data['ujian'] = $ujian->where(['id'=>session('ujian_id')])->first();
      $data_map = $map->where(['ujian_id' => session('ujian_id')])->findAll();
      
      if ($data['log']->status == 1) {
        return redirect()->to('/');
      } else {
        $category_list = array();
        for ($i=0; $i < count($data_map); $i++) {
          $category_data = $category->where(['id'=>$data_map[$i]->category_id])->first();
          $data['category'][$i] = $category_data;
          $category_list[$i] = $category_data;
        } 
        $soals = array();
        for ($i=0; $i < count($soal_list); $i++) {        
          $category_id = $soal_list[$i]['category_id'];
          $search_category = array_filter($category_list, function($obj) use ($category_id) {
            return $obj->id === $category_id;
          });
          $input = array(
            'id' => $soal_list[$i]['id'],
            'pertanyaan' => $soal_list[$i]['pertanyaan'],
            'kompetensi' => $soal_list[$i]['kompetensi'],
            'kompetensi_dasar' => $soal_list[$i]['kompetensi_dasar'],
            'bobot' => $soal_list[$i]['bobot'],
            'category_id' => $soal_list[$i]['category_id'],
            'category_name' => array_values($search_category)[0]->nama,
            'jawaban_peserta' => $soal_list[$i]['jawaban_peserta']
          );
          $soals[$i] = $input;
        }
        // usort($soals, function ($a, $b) {
        //   return $a['category_id'] <=> $b['category_id']; 
        // });
        $data['soals'] = $soals;
        return view('catessay', $data);
        }      
    }

    public function save()
    {
      // check user agent
      $check = $this->checkUserAgent();
      if (!$check) {
        return view('errors/error');
      }

      $cat = new CatEssayModel;
      $log = new LogModel;
      $category = new CategoryModel;

      $user_id = session('nomor_peserta');
      $ceklog		= $log->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->first();

			if(strtotime($ceklog->finish_time) <= time() || $ceklog->status == 1){
				echo '0';
			}else{
        $check = (array) $cat->find($this->request->getVar('soal_id'));

				$jp = $this->request->getVar('jawaban_peserta');
        // remove ' in $jp
        $jp = str_replace("'", "", $jp);
				
        $data = array(
              'jawaban_peserta' => $jp,
        );
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
      // check user agent
      $check = $this->checkUserAgent();
      if (!$check) {
        return view('errors/error');
      }
      
      $log = new LogModel;
      $crud = new CrudModel;
         
      //$nilai = $crud->getNilaiV4(session('nomor_peserta'), session('ujian_id'));

      $data = array(
        'status' => 1,
        //'finish_nilai' => $nilai[0]->nilai
      );

      $log->set($data)->where(['peserta_id'=>session('nomor_peserta'), 'ujian_id'=>session('ujian_id')])->update();   
      return redirect()->to('');
    }

    public function checkUserAgent() {
      $userAgent = $this->request->getHeaderLine('User-Agent'); // Perhatikan: tanpa spasi
      $allowedSuffix = env('SEB_SUFFIX'); // Nilai default opsional
      $sebToolsEnabled = env('SEB_TOOLS', false); // Default false jika tidak ada di .env
        
      // Jika SEB_TOOLS aktif, periksa suffix
      if ($sebToolsEnabled) {
        if (substr($userAgent, -strlen($allowedSuffix)) === $allowedSuffix) {
          return true;
        }
      } else {
        return true;
      }
        
      return false;
    }
}
