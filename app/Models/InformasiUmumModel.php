<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiUmumModel extends Model
{

    protected $table      = 'informasi_umum';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','nama_UPR','fungsi_UPR','tugas_UPR','tanggal_mulai','tanggal_selesai','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getInfoUmum(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = informasi_umum.id_status_persetujuan');
        return $this->builder()->select('informasi_umum.id, nama_UPR, tugas_UPR, fungsi_UPR, tanggal_mulai,tanggal_selesai, id_status_persetujuan, status_persetujuan.status,komentar')->get()->getResultArray();
        
    }

}