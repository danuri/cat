<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\SesiModel;

class Auth extends BaseController
{
    public function index()
    {
      // check user agent
      $check = $this->checkUserAgent();
      if (!$check) {
        return view('errors/error');
      }
    
      return view('auth/login'); 
    }

    public function login()
    {
      // check user agent
      $check = $this->checkUserAgent();
      if (!$check) {
        return view('errors/error');
      }

      // $agent = $this->request->getUserAgent();
      // if(str_contains($agent,'ukompenyuluh')){
        $user = $this->request->getVar('nik');
        //$nopes = $this->request->getVar('nomor_peserta');
        $nopes = $user;
        $pass = $this->request->getVar('nik');
        $pin = $this->request->getVar('pinsesi');

        $sesi = new SesiModel;
        $findsesi = $sesi->where(['pin'=>$pin])->first();

        if($findsesi){
          $model = new PesertaModel;
          $find = $model->where(['nomor_peserta'=>$nopes,'nik'=>$pass,'sesi_id'=>$findsesi->id])->first();

          if($find){
            $newdata = [
              'user_id'  => $find->id,
              'nik'  => $find->nik,
              'nomor_peserta'  => $find->nomor_peserta,
              'ujian_id'  => $find->ujian_id,
              'nama'  => $find->nama,
              'jabatan'  => $find->jabatan,
              'lokasi_formasi'  => $find->lokasi_formasi,
              'pin'  => $find->pin,
              'sesi_id'  => $find->sesi_id,
              'logged_in' => true,
            ];

            session()->set($newdata);

            return redirect()->to('/');

          }else{
            return redirect()->back()->with('message', 'Username atau PIN tidak sesuai');
          }
        }else{
          return redirect()->back()->with('message', 'PIN Sesi tidak ditemukan');
        }
      // }else{
      //   return redirect()->back()->with('message', 'Silahkan gunakan Safe Exam Browser');
      // }
    }

    public function logout()
    {
      session()->destroy();
      return redirect()->to('');
    }

    public function checkUserAgent()
    {
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
