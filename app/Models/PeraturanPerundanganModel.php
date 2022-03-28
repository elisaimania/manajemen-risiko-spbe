<?php

namespace App\Models;

use CodeIgniter\Model;

class PeraturanPerundanganModel extends Model
{

    protected $table      = 'peraturan_perundangan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','nama_peraturan','amanat','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPeraturanPerundangan(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = peraturan_perundangan.id_status_persetujuan');
        return $this->builder()->select('peraturan_perundangan.id, nama_peraturan, amanat, id_status_persetujuan, status_persetujuan.status,komentar')->get()->getResultArray();
        
    }

}