<?php

namespace App\Controllers\Admin\Ujian;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\CatModel;
use App\Models\UjianModel;
use App\Models\CatEssayModel;
use App\Models\SesiModel;
use App\Models\LogModel;

class Peserta extends BaseController
{
    public function index($id)
    {
      $model = new PesertaModel;      
      $ujian = new UjianModel;
      $sesi = new SesiModel;
      $ujianid = decrypt($id);
      $data['peserta'] = $model->where('ujian_id',$ujianid)->findAll();
      $data['ujianid'] = $ujianid;
      $data['ujian'] = $ujian->where('id',$ujianid)->first();
      $data['sesi'] = $sesi->where('ujian_id',$ujianid)->findAll();
      return view('admin/ujian/peserta', $data);
    }

    public function detail($id)
    {
      $model = new PesertaModel;
      $ujian = new UjianModel;
      
      $pesertaid = decrypt($id);

      $data['peserta'] = $model->find($pesertaid);
      $data['ujianid'] = $data['peserta']->ujian_id;
      $data['ujian'] = $ujian->where('id',$data['peserta']->ujian_id)->first();

      if ($data['ujian']->tipe_soal == "essay") {
        // tipe soal = essay
        $cat = new CatEssayModel;
        $data['soal'] = $cat->where('ujian_id',$data['peserta']->ujian_id)
                            ->where('peserta_id',$data['peserta']->nomor_peserta)
                            ->findAll();
        // print_r($data['soal']);
        // exit();
        return view('admin/ujian/peserta_detail_essay', $data);
      } else {
        // tipe soal = choice
        $cat = new CatModel;
        $data['soal'] = $cat->where('ujian_id',$data['peserta']->ujian_id)
                            ->where('peserta_id',$data['peserta']->nomor_peserta)
                            ->findAll();     
        return view('admin/ujian/peserta_detail', $data);
      }
    }

    public function add() {
      $nama = $this->request->getPost('nama');
      $ujianid = $this->request->getPost('ujianid');
      $sesiid = $this->request->getPost('sesiid');
      $nik = $this->request->getPost('nik');
      $nama = $this->request->getPost('nama');
      $jabatan = $this->request->getPost('jabatan');
      $lokasi_formasi = $this->request->getPost('lokasi_formasi');      
      $model = new PesertaModel;
      $check = $model->where('nik', $nik)
                     ->where('ujian_id', $ujianid)
                     ->first();
      if ($check) {
        return redirect()->back()->with('error', 'NIP / Nomor Peserta '.$nik.' sudah terdaftar!');
      }
      $model->insert(['nik'=>$nik, 
                      'nomor_peserta'=>$nik,
                      'nama'=>$nama, 
                      'jabatan'=>$jabatan, 
                      'lokasi_formasi'=>$lokasi_formasi, 
                      'ujian_id'=>$ujianid, 
                      'sesi_id'=>$sesiid]);
      return redirect()->back()->with('message', 'Peserta telah ditambahkan');
    }

    public function edit() {
      $pesertaid = $this->request->getPost('edit_id');
      $nama = $this->request->getPost('edit_nama');
      $ujianid = $this->request->getPost('edit_ujianid');
      $sesiid = $this->request->getPost('edit_sesiid');
      $nik = $this->request->getPost('edit_nik');
      $nik_asli = $this->request->getPost('edit_nik_asli');
      $nama = $this->request->getPost('edit_nama');
      $jabatan = $this->request->getPost('edit_jabatan');
      $lokasi_formasi = $this->request->getPost('edit_lokasi_formasi'); 
   
      $model = new PesertaModel;      
      $log = new LogModel;
      if ($nik != $nik_asli) {
        $checklog = $log->where('peserta_id', $nik_asli)
                      ->where('ujian_id', $ujianid)
                      ->first();
        if ($checklog) {
          return redirect()->back()->with('error', 'NIP / Nomor Peserta '.$nik_asli.' sudah melakukan ujian! NIP / Nomor Peserta tidak dapat diubah!');
        }
        $check = $model->where('nik', $nik)
                      ->where('ujian_id', $ujianid)
                      ->first();
        if ($check) {
          return redirect()->back()->with('error', 'NIP / Nomor Peserta '.$nik.' sudah terdaftar!');
        }
      }
      
      $model->set(['nik'=>$nik, 
                   'nomor_peserta'=>$nik,
                   'nama'=>$nama,
                   'jabatan'=>$jabatan,
                   'lokasi_formasi'=>$lokasi_formasi,
                   'sesi_id'=>$sesiid])
            ->where('id', $pesertaid)->update();
      return redirect()->back()->with('message', 'Data Peserta telah diupdate');
    }

    public function delete($id) {
      $pesertaid = decrypt($id);
      $model = new PesertaModel;
      $peserta = $model->where('id', $pesertaid)->first();
      $log = new LogModel;
      $checklog = $log->where('peserta_id', $peserta->nik)
                      ->where('ujian_id', $peserta->ujian_id)
                      ->first();
      if ($checklog) {
        return redirect()->back()->with('error', 'NIP / Nomor Peserta '.$peserta->nik.' sudah melakukan ujian! NIP / Nomor Peserta tidak dapat dihapus!');
      }
      $model->delete($pesertaid);
      return redirect()->back()->with('message', 'Peserta telah dihapus');
    }

    public function import() {
      $ujianid = $this->request->getPost('ujianid');
      $file = $this->request->getFile('fileexcel');
      if ($file->isValid() && !$file->hasMoved()) {
        $filePath = WRITEPATH . 'uploads/' . $file->getName();
        if (file_exists($filePath)) {
          unlink($filePath); 
        }
        $file->move(WRITEPATH . 'uploads');
        
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $model = new PesertaModel;
        $message = null;
        $sesi = new SesiModel;
        for ($i=1; $i < count($data); $i++) {
          $checkpeserta = $model->where('nik', $data[$i][0])
                                ->where('ujian_id', $ujianid)
                                ->first();
          if ($checkpeserta) {
            if ($message != null) {
              $message .= ', NIP / Nomor Peserta '.$data[$i][0].' sudah terdaftar!';
            } else {
              $message = 'NIP / Nomor Peserta '.$data[$i][0].' sudah terdaftar!';
            }
          } else {
            $checksesi = $sesi->where('id', $data[$i][4])
                              ->where('ujian_id', $ujianid)
                              ->first();
            if (!$checksesi) {
              if ($message != null) {
                $message .= ', Sesi '.$data[$i][4].' tidak ditemukan!';
              } else {
                $message = 'Sesi '.$data[$i][4].' tidak ditemukan!';
              }
            } else {
              $datas = [
                'nik' => $data[$i][0],
                'nomor_peserta' => $data[$i][0],
                'nama' => $data[$i][1],
                'jabatan' => $data[$i][2],
                'lokasi_formasi' => $data[$i][3],
                'ujian_id' => $ujianid,
                'sesi_id' => $data[$i][4]
              ];
              $model->insert($datas);
            }
          }          
        };        
        if (file_exists($filePath)) {
          unlink($filePath); 
        }
      } else {
        return redirect()->back()->with('error', 'File upload Failed!');
      }
      if ($message != null) {
        return redirect()->back()->with('error', $message);
      } else {
        return redirect()->back()->with('message', 'Data Peserta telah diimport');
      }
    }
}
