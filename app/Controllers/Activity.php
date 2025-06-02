<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityModel;

class Activity extends BaseController
{
    function store()
    {
        $model = new \App\Models\ActivityModel;
        $data = [
            'user_id' => session('user_id'),
            'ujian_id' => session('ujian_id'),
            'sesi_id' => session('sesi_id'),
            'page' => $this->request->getVar('page'),
            'status' => $this->request->getVar('status'),
            'activity' => $this->request->getVar('reason')
        ];
        
        if ($model->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Activity logged successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to log activity']);
        }
        
    }

}