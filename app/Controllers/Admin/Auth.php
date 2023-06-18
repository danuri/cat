<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\CrudModel;

class Auth extends BaseController
{

  public function index()
  {
    $this->login();
  }

  public function login()
  {
    if (!session()->get('isLoggedIn')) {
      return redirect()->to($_ENV['SSO_SIGNIN'].'?appid='.$_ENV['SSO_APPID']);
    }else{
      return redirect()->to('');
    }
  }

  public function callback()
  {
    $request = \Config\Services::request();
    $client = \Config\Services::curlrequest();

    $token = $request->getVar('token') ?? '';
    if($token){
      $verify_url = $_ENV['SSO_VERIFY'];

      $response = $client->request('POST', $verify_url, [
        'headers' => [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer '. $token,
        ],
        'verify' => false
      ]);

      $data = json_decode($response->getBody());

      if($data->status == 200){
        $data = $data->pegawai;

        $crud = new CrudModel;
        $checkrole = $crud->getRow('users',['username'=>$data->NIP]);

        if($checkrole){
          $ses_data = [
            'nip'        => $data->NIP,
            'niplama'    => $data->NIP_LAMA,
            'nama'       => $data->NAMA,
            'pangkat'    => $data->PANGKAT,
            'golongan'   => $data->GOLONGAN,
            'jabatan'    => $data->JABATAN,
            'role'     => $checkrole->role,
            'isLoggedIn' => TRUE
          ];
          session()->set($ses_data);
          return redirect()->to('admin');
        }else{
          return redirect()->to($_ENV['SSO_SIGNIN'].'?appid='.$_ENV['SSO_APPID'].'&info=2');
        }

      }else{
        echo $data->msg;
      }
    }else{
      echo 'no Token';
    }
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to($_ENV['SSO_SIGNIN'].'?appid='.$_ENV['SSO_APPID']);
  }
}
