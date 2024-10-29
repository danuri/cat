<?php

namespace App\Controllers;

use App\Models\CategoryModel;
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
          $data['nilai'] = $crud->getNilaiV3(session('nomor_peserta'), session('ujian_id'));
		  $data['ujian'] = $ujian->where(['id' => session('ujian_id')])->first();		  
        } else {
		  if ($log && strtotime($log->finish_time) <= time()) {
			$nilai = $crud->getNilaiV4(session('nomor_peserta'), session('ujian_id'));
			$data = array(
				'status' => 1,
				'finish_nilai' => $nilai[0]->nilai
			);
			$model->set($data)->where(['peserta_id'=>session('nomor_peserta'), 'ujian_id'=>session('ujian_id')])->update();
			$data['status'] = 1;
			$data['nilai'] = $crud->getNilaiV3(session('nomor_peserta'), session('ujian_id'));
			$data['ujian'] = $ujian->where(['id' => session('ujian_id')])->first();
		  } else {
			$data['status'] = 0;
			$data['ujian'] = $ujian->where(['id' => session('ujian_id')])->first();
		  }
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
	  $category_model = new CategoryModel;

      $ujian_id = session('ujian_id');
      $categories = $map->where('ujian_id',$ujian_id)->findAll();
      $soal = array();
	  $j = 0;
      foreach ($categories as $row) {
        $getsoal = $model->getSoal($row->category_id,$row->jumlah_soal);
		$category = $category_model->where('id', $row->category_id)->first();
		
        foreach ($getsoal as $rs) {
          $soal[$j][] = [
            'id' => $rs->id,
            'pertanyaan' => $rs->pertanyaan,
            'p1' => $rs->p1,
            'p2' => $rs->p2,
            'p3' => $rs->p3,
            'p4' => $rs->p4,
            'p5' => $rs->p5,
            'category_id' => $rs->category_id,
			'value_type' => $rs->value_type,
			'bobot_p1' => $rs->bobot_p1,
			'bobot_p2' => $rs->bobot_p2,
			'bobot_p3' => $rs->bobot_p3,
			'bobot_p4' => $rs->bobot_p4,
			'bobot_p5' => $rs->bobot_p5,
			'bobot' => $category->nilai
          ];
        }
		$j = $j+1;
      }
	  
	for ($a=0; $a < count($soal); $a++) {
		foreach ($soal[$a] as $row) {
			$pilihan = array();
			$bobot_pilihan = array();
		  	if ($row['value_type'] == '1') {
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
				  'peserta_id' => session('nomor_peserta'),
				  'value_type' => $row['value_type'],
				  'bobot' => $row['bobot']
						  );
			} elseif ($row['value_type'] == '2') {
			  $input = array(
				  'ujian_id' => session('ujian_id'),
				  'category_id' => $row['category_id'],
				  'soal_id' => $row['id'],
				  'pertanyaan' => $row['pertanyaan'],
				  'p1' => $row['p1'],
				  'p2' => $row['p2'],
				  'p3' => $row['p3'],
				  'p4' => $row['p4'],
				  'p5' => $row['p5'],
				  'jawaban_soal' => $row['jawaban'],
				  'peserta_id' => session('nomor_peserta'),
				  'value_type' => $row['value_type'],
				  'bobot' => $row['bobot']
			  );
			} elseif ($row['value_type'] == '3') {
			  $p = randomChoice();
			  for ($i=0; $i < 5; $i++) {
				  $choice =  'p'.$p[$i];
				  $pilihan[] = $row[$choice];
				  $bobot = 'bobot_p'.$p[$i];
				  $bobot_pilihan[] = $row[$bobot];
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
				  'peserta_id' => session('nomor_peserta'),
				  'value_type' => $row['value_type'],
				  'bobot_p1' => $bobot_pilihan[0],
				  'bobot_p2' => $bobot_pilihan[1],
				  'bobot_p3' => $bobot_pilihan[2],
				  'bobot_p4' => $bobot_pilihan[3],
				  'bobot_p5' => $bobot_pilihan[4]
			  );
		  	} 			
			$insert = $cat->insert($input);
	  	}
	  }
  	}
}
