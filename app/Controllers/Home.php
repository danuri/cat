<?php

namespace App\Controllers;
use App\Models\CrudModel;
use App\Models\CatModel;
use App\Models\LogModel;
use App\Models\MapModel;
use App\Models\UjianModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new LogModel;
        $crud = new CrudModel;
		$ujian = new UjianModel;

        $user_id = session('nomor_peserta');

        $log = $model->where(['peserta_id'=>$user_id, 'ujian_id'=>session('ujian_id')])->first();

        if($log && $log->status == 1){
          $data['status'] = 1;
          $data['nilai'] = $crud->getNilaiV2(session('nomor_peserta'), session('ujian_id'));
		  $data['ujian'] = $ujian->where(['id' => session('ujian_id')])->first();
        }else{
          $data['status'] = 0;
		  $data['ujian'] = $ujian->where(['id' => session('ujian_id')])->first();
        }

        return view('index', $data);
    }

    public function mulai()
  	{
      $model = new CrudModel;
	  $ujian = new UjianModel;

  		$user_id = session('nomor_peserta');
  		$peserta = $model->getRow('peserta', ['nomor_peserta' => $user_id, 'ujian_id' => session('ujian_id')]);

  		$soalpeserta = $model->getRow('soal_peserta', ['peserta_id' => $user_id, 'ujian_id' => session('ujian_id')]);
		$data_ujian = $ujian->where(['id' => session('ujian_id')])->first();

      if($soalpeserta){
        return redirect()->to('cat');
      }

  		if(!$model->getRow('peserta_log', ['ujian_id' => $peserta->ujian_id, 'peserta_id' => $peserta->nomor_peserta])){
  			$now     = strtotime(date('Y-m-d H:i:s'));
  			$minutes = $data_ujian->lama_ujian;
  			$seconds = ($minutes * 60);
  			$future  = ($now + $seconds);

  			$input = array(
  									'ujian_id' => $peserta->ujian_id,
  									'peserta_id' => $peserta->nomor_peserta,
  									'start_time' => date('Y-m-d H:i:s', $now),
  									'finish_time' => date('Y-m-d H:i:s', $future),
  									'status' => 0
  								 );

        $log = new LogModel;
  			$log->insert($input);
  		}

  		if($model->getRow('soal_peserta', ['ujian_id' => $peserta->ujian_id, 'peserta_id' => $peserta->nomor_peserta]) == 0){
  			$this->generate_soal_peserta();
  		}

  		return redirect()->to('cat');
  	}

  	public function generate_soal_peserta()
  	{
      $model = new CrudModel;
      $cat = new CatModel;
      $map = new MapModel;

      $ujian_id = session('ujian_id');
      // $peserta = $model->getRow('peserta', ['nomor_peserta' => $user_id]);

      $categories = $map->where('ujian_id',$ujian_id)->findAll();
      // $categories = $model->getResult('bank_soal_category');
      $soal = array();
      foreach ($categories as $row) {
        $getsoal = $model->getSoal($row->category_id,$row->jumlah_soal);

        foreach ($getsoal as $rs) {
          $soal[] = [
            'id' => $rs->id,
            'pertanyaan' => $rs->pertanyaan,
            'p1' => $rs->p1,
            'p2' => $rs->p2,
            'p3' => $rs->p3,
            'p4' => $rs->p4,
            'p5' => $rs->p5,
            'category_id' => $rs->category_id,
          ];
        }

      }
  		// $soal = array_merge($model->getSoal(2,10),$model->getSoal(3,10));
  		$soal = (object) $soal;

      // print_r($soal);

      foreach ($soal as $row) {
  			$pilihan = array();
  			$p = randomChoice();
  			for ($i=0; $i < 5; $i++) {
  				$choice =  'p'.$p[$i];
  				$pilihan[] = $row[$choice];
  				if($choice == 'p1'){
  					$jawaban = $i+1;
  				}
  			}

  			$input = array(
                  'ujian_id' => session('ujian_id'),
  								'category_id' => $row['category_id'],
  								'soal_id' => $row['id'],
  								'pertanyaan' => $row['pertanyaan'],
  								'p1' => $pilihan[0],
  								'p2' => $pilihan[1],
  								'p3' => $pilihan[2],
  								'p4' => $pilihan[3],
  								'p5' => $pilihan[4],
  								'jawaban_soal' => $jawaban,
  								'peserta_id' => session('nomor_peserta')
  							 );

  			$insert = $cat->insert($input);
      }
  	}
}
