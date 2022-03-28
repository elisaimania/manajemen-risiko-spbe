<?php

namespace App\Models;

use CodeIgniter\Model;

class SeleraRisikoModel extends Model
{

    protected $table      = 'selera_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','id_kategori_risiko','id_jenis_risiko', 'besaran_risiko_min','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getSelera(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = selera_risiko_spbe.id_status_persetujuan');

        $this->builder()->join('kategori_risiko_spbe','kategori_risiko_spbe.id = selera_risiko_spbe.id_kategori_risiko');

        $this->builder()->join('jenis_risiko','jenis_risiko.id = selera_risiko_spbe.id_jenis_risiko');

        return $this->builder()->select('selera_risiko_spbe.id, id_kategori_risiko, id_jenis_risiko, id_status_persetujuan, status_persetujuan.status,komentar, kategori_risiko_spbe.kategori_risiko, jenis_risiko.jenis_risiko, besaran_risiko_min')->get()->getResultArray();
        
    }

}