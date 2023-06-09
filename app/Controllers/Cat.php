<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cat extends BaseController
{
    public function index()
    {
        return view('cat');
    }
}
