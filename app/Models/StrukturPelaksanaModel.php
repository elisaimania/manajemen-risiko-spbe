<?php

namespace App\Models;

use CodeIgniter\Model;

class StrukturPelaksanaModel extends Model
{

    protected $table      = 'struktur_pelaksana';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','id_role','pelaksana','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getStrukturPelaksana(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = struktur_pelaksana.id_status_persetujuan');
        $this->builder()->join('role_pengguna','role_pengguna.id = struktur_pelaksana.id_role');
        return $this->builder()->select('struktur_pelaksana.id, id_role, role_pengguna.nama_role, pelaksana, id_status_persetujuan, status_persetujuan.status,komentar')->get()->getResultArray();
        
    }

}