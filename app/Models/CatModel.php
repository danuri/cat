<?php

namespace App\Models;

use CodeIgniter\Model;

class CatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'soal_peserta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ujian_id','category_id','soal_id','peserta_id','pertanyaan','p1','p2','p3','p4','p5','jawaban_soal','jawaban_peserta','jawaban_nilai', 'value_type', 'bobot_p1', 'bobot_p2', 'bobot_p3', 'bobot_p4', 'bobot_p5', 'bobot'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
