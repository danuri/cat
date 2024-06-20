<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CatModel;
use App\Models\LogModel;
use App\Models\CrudModel;
use App\Models\UjianModel;

class Cat extends BaseController
{
    public function index()
    {
      $cat = new CatModel;
      $log = new LogModel;
      $ujian = new UjianModel;

      $user_id = session('nomor_peserta');

      $data['soals']    = $cat->where(['peserta_id'=>$user_id])->findAll();
      // $data['jumlah']   = 0;
      $data['jumlah']   = $cat->where(['peserta_id' => session('nomor_peserta'), 'ujian_id' => session('ujian_id'), 'jawaban_peserta !=' => null])->countAllResults();
      $data['log']      = $log->where(['peserta_id'=>$user_id])->first();
      $data['ujian'] = $ujian->where(['id'=>session('ujian_id')])->first();
      return view('cat', $data);
    }

    public function save()
    {
      $cat = new CatModel;
      $log = new LogModel;

      $user_id = session('nomor_peserta');
      $ceklog		= $log->where(['peserta_id'=>$user_id])->first();

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
				}else{
					$data = array(
						'jawaban_peserta' => $jp
					);
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

      $log->set(['status'=>1])->where(['peserta_id'=>session('nomor_peserta')])->update();

      return redirect()->to('');
    }
}
