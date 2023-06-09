<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\SesiModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $user = $this->request->getVar('nik');
        $nopes = $this->request->getVar('nomor_peserta');
        $pass = $this->request->getVar('pin');
        $pin = $this->request->getVar('pinsesi');

        $sesi = new SesiModel;
        $findsesi = $sesi->where(['pin'=>$pin])->first();

        if($findsesi){
          $model = new PesertaModel;
          $find = $model->where(['nik'=>$user,'nomor_peserta'=>$nopes,'pin'=>$pass,'sesi_id'=>$findsesi->id])->first();

          if($find){
            $newdata = [
              'user_id'  => $find->id,
              'nik'  => $find->nik,
              'nomor_peserta'  => $find->nomor_peserta,
              'nama'  => $find->nama,
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
    }

    public function logout()
    {
      session()->destroy();
      return redirect()->to('');
    }
}
