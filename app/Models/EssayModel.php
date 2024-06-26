<?php

namespace App\Models;

use CodeIgniter\Model;

class EssayModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bank_soal_essay';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pertanyaan','bobot'];

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

    public function getsoal($jenjang)
    {
      $db = \Config\Database::connect('default', false);

      $query = $this->db->query("SELECT kompetensi,kompetensi_dasar,kode FROM bank_soal_essay WHERE jenjang='$jenjang' GROUP BY kompetensi, kompetensi_dasar, kode")->getResult();
      return $query;
    }

    public function getcontohsoal($kode)
    {
      $db = \Config\Database::connect('default', false);

      $query = $this->db->query("SELECT soal FROM bank_soal_essay WHERE kode='$kode' GROUP BY soal")->getResult();
      return $query;
    }
}
