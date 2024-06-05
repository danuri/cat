<?php

namespace App\Models;

use CodeIgniter\Model;

class CrudModel extends Model
{

      protected $db;

      public function __construct()
      {
        $this->db = \Config\Database::connect('default', false);

      }

      public function getRow($table,$where)
      {
        $builder = $this->db->table($table);
        $query = $builder->getWhere($where);

        return $query->getRow();
      }

      public function getResult($table,$where=false)
      {
        $builder = $this->db->table($table);

        if($where){
          $query = $builder->getWhere($where);
        }else{
          $query = $builder->get();
        }

        return $query->getResult();
      }

      public function getSoal($catid,$jumlah)
      {
        $query = $this->db->query("SELECT * FROM bank_soal_choice WHERE category_id='$catid' ORDER BY RAND() LIMIT 0, $jumlah")->getResult();
        return $query;
      }

      public function getNilai($nopes)
      {
      //   $query = $this->db->query("SELECT b.category_id, SUM(b.nilai) jumlah, c.nama
      //                             FROM
      //                             (SELECT id,category_id,(CASE WHEN jawaban_soal = jawaban_peserta THEN '1' ELSE '0' END) nilai
      //                             FROM soal_peserta WHERE peserta_id='$nopes') b
      //                             INNER JOIN bank_soal_category c ON b.category_id = c.id
      //                             GROUP BY b.category_id")->getResult();
        $query = $this->db->query("SELECT b.category_id, c.jenis, SUM(b.nilai) jumlah, c.standar
                                  FROM
                                  (SELECT id,category_id,(
                                  	CASE
                                  		WHEN category_id = '13' THEN jawaban_nilai
                                  		WHEN jawaban_soal = jawaban_peserta THEN '5' ELSE '0'
                                  	 END
                                  	) nilai
                                  FROM soal_peserta WHERE peserta_id='$nopes') b
                                  INNER JOIN bank_soal_category c ON b.category_id = c.id
                                  GROUP BY c.standar")->getResult();
        return $query;
      }

      public function getAccess($kodesatker)
      {
        $query = $this->db->query("SELECT
                                    UM_USER.ID,
                                    UM_USER.KODE_SATKER,
                                    UM_USER.NIP,
                                    UM_USER.ROLE,
                                    UM_USER.APP_ID,
                                    UM_APP.APP_NAME,
                                    UM_ROLES.REMARK,
                                    TEMP_PEGAWAI.NAMA_LENGKAP,
                                    TEMP_PEGAWAI.NO_HP
                                  FROM
                                    dbo.UM_USER
                                    INNER JOIN
                                    dbo.UM_APP
                                    ON
                                      UM_USER.APP_ID = UM_APP.ID
                                    INNER JOIN
                                      dbo.UM_ROLES
                                    ON
                                      UM_USER.ROLE = UM_ROLES.ROLE AND UM_USER.APP_ID = UM_ROLES.APP_ID
                                    INNER JOIN
                                    dbo.TEMP_PEGAWAI
                                    ON
                                      UM_USER.NIP = TEMP_PEGAWAI.NIP_BARU
                                  WHERE
                                    KODE_SATKER LIKE '$kodesatker%' AND UM_USER.APP_ID !='2'")->getResult();
        return $query;
      }

      public function getAccessAll()
      {
        $query = $this->db->query("SELECT
                                    UM_USER.ID,
                                    UM_USER.KODE_SATKER,
                                    UM_USER.NIP,
                                    UM_USER.ROLE,
                                    UM_USER.APP_ID,
                                    UM_APP.APP_NAME,
                                    UM_ROLES.REMARK,
                                    TEMP_PEGAWAI.NAMA_LENGKAP,
                                    TEMP_PEGAWAI.SATKER_3,
                                    TEMP_PEGAWAI.NO_HP
                                  FROM
                                    dbo.UM_USER
                                    INNER JOIN
                                    dbo.UM_APP
                                    ON
                                      UM_USER.APP_ID = UM_APP.ID
                                    INNER JOIN
                                      dbo.UM_ROLES
                                    ON
                                      UM_USER.ROLE = UM_ROLES.ROLE AND UM_USER.APP_ID = UM_ROLES.APP_ID
                                    INNER JOIN
                                    dbo.TEMP_PEGAWAI
                                    ON
                                      UM_USER.NIP = TEMP_PEGAWAI.NIP_BARU
                                  ")->getResult();
        return $query;
      }

      public function getSatkerKelola($kelola)
      {
        $query = $this->db->query("SELECT * FROM TM_SATUAN_KERJA WHERE KODE_SATUAN_KERJA='$kelola' OR KODE_ATASAN='$kelola'")->getResult();
        return $query;
      }
}
