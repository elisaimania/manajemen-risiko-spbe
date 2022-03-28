<?php

namespace App\Models;

use CodeIgniter\Model;

class PemangkuKepentinganModel extends Model
{

    protected $table      = 'pemangku_kepentingan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','nama_unit','hubungan','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPemangkuKepentingan(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = pemangku_kepentingan.id_status_persetujuan');
        return $this->builder()->select('pemangku_kepentingan.id, nama_unit, hubungan, id_status_persetujuan, status_persetujuan.status,komentar')->get()->getResultArray();
        
    }

}