<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\UjianModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/loginadmin');
    }

    public function login()
    {
      $model = new UsersModel;
      $find = $model->where(['username'=>$username,'password'=>$password,'role'=>1])->first();
      $ujian = $model->where(['status'=>1])->first();

      if($find){
        $newdata = [
          'nama'  => $find->nama,
          'ujian_id'  => $ujian->id,
          'is_admin' => true,
        ];

        session()->set($newdata);
        return redirect()->to('/');
      }else{
        return redirect()->back()->with('message', 'Username atau Password tidak sesuai');
      }
    }
}
