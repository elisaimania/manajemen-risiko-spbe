<?php

namespace App\Models;

use CodeIgniter\Model;

class SasaranSPBEModel extends Model
{

    protected $table      = 'sasaran_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','sasaran_UPR_SPBE','sasaran_SPBE','indikator_kinerja_SPBE','target_kinerja', 'id_upr','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getSasaranSPBE(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = sasaran_spbe.id_status_persetujuan');
        return $this->builder()->select('sasaran_spbe.id, sasaran_UPR_SPBE, sasaran_SPBE, indikator_kinerja_SPBE,target_kinerja, id_upr, id_status_persetujuan, status_persetujuan.status,komentar')->get()->getResultArray();
        
    }

}