<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\CrudModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\UjianModel;
use App\Models\PesertaModel;
use App\Models\CatEssayModel;
use App\Models\CatModel;
use App\Models\LogModel;

class Hasil extends BaseController
{
    public function index($id)
    {
        //
        $id = decrypt($id);
        $model = new CrudModel;
        $ujian = new UjianModel;
        $data['ujian'] = $ujian->find($id);
        $data['ujianid'] = $id;
        if ($data['ujian']->tipe_soal == "essay") {
            // tipe soal = essay
            $data['hasil'] = $model->hasilNilaiEssay($id);
            return view('admin/ujian/hasil', $data);
        } else {
            // tipe soal = choice            
            $data['hasil'] = $model->hasilNilai($id);
            return view('admin/ujian/hasil', $data);
        }
    }

    public function export($id)
    {
      $ujianid = decrypt($id);
      $model = new CrudModel();
      $ujian = new UjianModel;
      $data_ujian = $ujian->find($ujianid);
      if ($data_ujian->tipe_soal == "essay") {
        // tipe soal = essay
        $data = $model->hasilNilaiEssay($ujianid);
      } else {
        // tipe soal = choice
        $data = $model->hasilNilai($ujianid);
      }
      
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'NO PESERTA');
      $sheet->setCellValue('B1', 'NAMA');
      $sheet->setCellValue('C1', 'JABATAN');
      $sheet->setCellValue('D1', 'LOKASI');
      $sheet->setCellValue('E1', 'MULAI');
      $sheet->setCellValue('F1', 'SELESAI');
      $sheet->setCellValue('G1', 'NILAI');

      $i = 2;
      foreach ($data as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->peserta_id,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('B'.$i, $row->nama);
        $sheet->setCellValue('C'.$i, $row->jabatan);
        $sheet->setCellValue('D'.$i, $row->lokasi_formasi);
        $sheet->setCellValue('E'.$i, $row->start_time);
        $sheet->setCellValue('F'.$i, $row->finish_time);
        $sheet->setCellValue('G'.$i, $row->finish_nilai);
        $i++;
      }

      $tanggal = date('YmdHis');
      $writer = new Xlsx($spreadsheet);
      ob_clean();
      ob_start();
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data_Hasil_Peserta_'.$tanggal.'.xlsx"');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
      ob_end_flush();
      exit;
    }

    public function detail($peserta_id, $ujian_id)
    {
      $model = new PesertaModel;
      $ujian = new UjianModel;
      
      $pesertaid = decrypt($peserta_id);
      $ujianid = decrypt($ujian_id);

      $data['peserta'] = $model->where('nik',$pesertaid)->where('ujian_id',$ujianid)->first();
      $data['ujianid'] = $ujianid;
      $data['ujian'] = $ujian->where('id',$ujianid)->first();

      $log = new LogModel;
      $data['log'] = $log->where('peserta_id',$pesertaid)->where('ujian_id',$ujianid)->first();

      if ($data['ujian']->tipe_soal == "essay") {
        // tipe soal = essay
        $cat = new CatEssayModel;
        $data['soal'] = $cat->where('ujian_id',$data['peserta']->ujian_id)
                            ->where('peserta_id',$data['peserta']->nomor_peserta)
                            ->findAll();
        // print_r($data['soal']);
        // exit();
        return view('admin/ujian/hasil_detail_essay', $data);
      } else {
        // tipe soal = choice
        $cat = new CatModel;
        $data['soal'] = $cat->where('ujian_id',$data['peserta']->ujian_id)
                            ->where('peserta_id',$data['peserta']->nomor_peserta)
                            ->findAll();     
        return view('admin/ujian/hasil_detail', $data);
      }
    }

    public function submit() {
      $id_soal = $this->request->getPost('id_soal');
      $nilai = $this->request->getPost('nilai');
      $nomor_peserta = $this->request->getPost('nomor_peserta');
      $ujian_id = $this->request->getPost('ujian_id');
      $bobot = $this->request->getPost('bobot');
      $log = new LogModel;
      $cat = new CatEssayModel;
      $total_nilai = 0;
      for ($i = 0; $i < count($id_soal); $i++) {
        if ($nilai[$i] > $bobot[$i]) {
          return redirect()->back()->with('error', 'Nilai tidak boleh besar dari Bobot!');
        } else {          
          $cat->set(['jawaban_nilai'=>$nilai[$i]])->where(['id'=>$id_soal[$i]])->update();
          $total_nilai += $nilai[$i];
        }        
      }
      $finish_nilai = $total_nilai / count($id_soal);
      $log->set(['finish_nilai'=>$finish_nilai])->where(['peserta_id'=>$nomor_peserta, 'ujian_id'=>$ujian_id])->update();
      return redirect()->back()->with('message', 'Nilai Peserta telah disimpan!');
    }
}
