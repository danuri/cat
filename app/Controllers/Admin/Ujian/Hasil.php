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
use App\Models\SesiModel;
use App\Models\LokasiModel;

class Hasil extends BaseController
{
    public function index($id)
    {
        $lokasiFilter = $this->request->getGet('filter_lokasi');
        $sesiFilter   = $this->request->getGet('filter_sesi');
        $data['lokasiid'] = $lokasiFilter;
        $data['sesiid'] = $sesiFilter;

        $id = decrypt($id);
        $model = new CrudModel;
        $ujian = new UjianModel;
        $sesi = new SesiModel;
        $lokasi = new LokasiModel;
        $data['ujian'] = $ujian->find($id);
        $data['ujianid'] = $id;
        $data['sesi'] = $sesi->where('ujian_id',$id)->findAll();
        $data['lokasi'] = $lokasi->where('ujian_id',$id)->findAll();
        
        if ($data['ujian']->tipe_soal == "essay") {
            // tipe soal = essay
            if (!empty($lokasiFilter)) {
              $data['hasil'] = $model->hasilNilaiByLokasi($id, $lokasiFilter); 
              return view('admin/ujian/hasil', $data);
            } elseif (!empty($sesiFilter)) {
              $data['hasil'] = $model->hasilNilaiBySesi($id, $sesiFilter); 
              return view('admin/ujian/hasil', $data);
            } else {              
              $data['hasil'] = $model->hasilNilai($id); 
              return view('admin/ujian/hasil', $data);
            }
        } else {
            // tipe soal = choice         
            if (!empty($lokasiFilter)) {
              $data['hasil'] = $model->hasilNilaiByLokasi($id, $lokasiFilter); 
              return view('admin/ujian/hasil', $data);
            } elseif (!empty($sesiFilter)) {
              $data['hasil'] = $model->hasilNilaiBySesi($id, $sesiFilter); 
              return view('admin/ujian/hasil', $data);
            } else {              
              $data['hasil'] = $model->hasilNilai($id); 
              return view('admin/ujian/hasil', $data);
            }
        }
    }

    public function export($id)
    {
      $lokasiFilter = $this->request->getGet('lokasiid');
      $sesiFilter   = $this->request->getGet('sesiid');
      $ujianid = decrypt($id);
      $model = new CrudModel();
      $ujian = new UjianModel;
      $data_ujian = $ujian->find($ujianid);
      if ($data_ujian->tipe_soal == "essay") {
        // tipe soal = essay
        if (!empty($lokasiFilter)) {
          $data = $model->hasilNilaiByLokasi($ujianid, $lokasiFilter); 
        } elseif (!empty($sesiFilter)) {
          $data = $model->hasilNilaiBySesi($ujianid, $sesiFilter); 
        } else {              
          $data = $model->hasilNilai($ujianid); 
        }
      } else {
        // tipe soal = choice
        if (!empty($lokasiFilter)) {
          $data = $model->hasilNilaiByLokasi($ujianid, $lokasiFilter); 
        } elseif (!empty($sesiFilter)) {
          $data = $model->hasilNilaiBySesi($ujianid, $sesiFilter); 
        } else {              
          $data = $model->hasilNilai($ujianid); 
        }
      }
      
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'NO PESERTA');
      $sheet->setCellValue('B1', 'NAMA');
      $sheet->setCellValue('C1', 'JABATAN');
      $sheet->setCellValue('D1', 'LOKASI FORMASI');
      $sheet->setCellValue('E1', 'MULAI');
      $sheet->setCellValue('F1', 'SELESAI');
      $sheet->setCellValue('G1', 'NILAI');
      $sheet->setCellValue('H1', 'LOKASI UJIAN');
      $sheet->setCellValue('I1', 'NAMA UJIAN');
      // kasih style bold ke header (A1 sampai I1)
      $sheet->getStyle('A1:I1')->getFont()->setBold(true);

      $i = 2;
      foreach ($data as $row) {
        $sheet->getCell('A'.$i)->setValueExplicit($row->nip_peserta,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        $sheet->setCellValue('B'.$i, $row->nama_peserta);
        $sheet->setCellValue('C'.$i, $row->jabatan_peserta);
        $sheet->setCellValue('D'.$i, $row->lokasi_formasi);
        $sheet->setCellValue('E'.$i, $row->start_time);
        $sheet->setCellValue('F'.$i, $row->finish_time);
        $sheet->setCellValue('G'.$i, $row->finish_nilai);
        $sheet->setCellValue('H'.$i, $row->lokasi);
        $sheet->setCellValue('I'.$i, $row->nama_ujian);
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
