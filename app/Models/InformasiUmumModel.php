<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiUmumModel extends Model
{

    protected $table      = 'informasi_umum';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','fungsi_UPR','tugas_UPR','tanggal_mulai','tanggal_selesai', 'id_upr','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getInfoUmum(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = informasi_umum.id_status_persetujuan');
        $this->builder()->join('upr_spbe','upr_spbe.id = informasi_umum.id_upr');
        return $this->builder()->select('informasi_umum.id, tugas_UPR, fungsi_UPR, tanggal_mulai,tanggal_selesai, id_upr, id_status_persetujuan, status_persetujuan.status,komentar, upr_spbe.upr_SPBE')->get()->getResultArray();
        
    }

}