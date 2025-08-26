<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peserta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nik','nomor_peserta','nama','jabatan','jenis_peserta','lokasi_formasi','pin','sesi_id','ujian_id'];

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

    public function getUsers($ujianid)
    {
        return $this->select('peserta.id, peserta.nik, peserta.nomor_peserta, peserta.nama, peserta.jabatan, peserta.lokasi_formasi, peserta.ujian_id, peserta.sesi_id, sesi.lokasi')
                    ->join('sesi', 'sesi.id = peserta.sesi_id', 'left')
                    ->where('peserta.ujian_id', $ujianid);
                    //->findAll();
    }
}
