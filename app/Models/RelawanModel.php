<?php

namespace App\Models;

use CodeIgniter\Model;

class RelawanModel extends Model
{
    protected $table            = 'relawan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nik','nkk','nama','jenis_kelamin','no_hp','jenis','id_wilayah','alamat','kecamatan','kelurahan','rw','rt','tps','tps_id','created_by'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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

    function rekapWilayah($parent) {
        $query = $this->db->query("SELECT
                                    	a.id_wilayah,
                                    	a.nama_wilayah,
                                    	a.jumlah_target,
                                    	(SELECT COUNT(id) FROM relawan WHERE id_wilayah LIKE CONCAT(a.id_wilayah,'%')) AS jumlah,
                                    	b.nama, b.no_hp
                                    FROM
                                    	wilayah a
                                    	LEFT JOIN
                                    	relawan b
                                    	ON
                                    		a.id_wilayah = b.id_wilayah
                                      WHERE a.parent = '$parent'
                                    GROUP BY
                                    	a.id_wilayah,
                                    	a.nama_wilayah");

        return $query->getResult();
    }

    function rekapInput($parent) {
        $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM relawan WHERE id_wilayah LIKE '$parent%'");

        return $query->getRow()->jumlah;
    }

    function rekapInputJenis($jenis) {
        $query = $this->db->query("SELECT COUNT(id) AS jumlah FROM relawan WHERE jenis='$jenis'");

        return $query->getRow()->jumlah;
    }

    // function rekapKelurahan($id) {
    //     $query = $this->db->query("SELECT a.id_wilayah, a.nama_wilayah,
    //                                 (SELECT COUNT(id) FROM relawan WHERE id_wilayah = a.id_wilayah) jumlah,
    //                                 b.nama, b.no_hp
    //                                 FROM wilayah a
    //                                 LEFT JOIN
    //                                 relawan b
    //                                 ON
    //                                   a.id_wilayah = b.id_wilayah
    //                                 WHERE a.parent='$id'
    //                                 GROUP BY a.id_wilayah, a.nama_wilayah");
    //
    //     return $query->getResult();
    // }
    //
    // function rekapRt($id) {
    //     $query = $this->db->query("SELECT a.id_kelurahan, a.kelurahan,
    //                                 (SELECT COUNT(id) FROM relawan WHERE id_wilayah = a.id_kelurahan) jumlah,
    //                                 b.nama, b.no_hp
    //                                 FROM tm_wilayah a
    //                                 LEFT JOIN
    //                                 relawan b
    //                                 ON
    //                                   a.id_kelurahan = b.id_wilayah
    //                                 WHERE a.id_kecamatan='$id'
    //                                 GROUP BY a.id_kelurahan, kelurahan");
    //
    //     return $query->getResult();
    // }
}
