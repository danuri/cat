<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
      $model = new UsersModel;

      $data['users'] = $model->findAll();
      return view('admin/users/index', $data);
    }
}
