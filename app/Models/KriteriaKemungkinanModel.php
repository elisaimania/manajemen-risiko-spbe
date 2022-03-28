<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaKemungkinanModel extends Model
{

    protected $table      = 'kriteria_kemungkinan_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','id_kategori_risiko','id_level_kemungkinan','presentase_kemungkinan','id_status_persetujuan','komentar', 'jumlah_frekuensi'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getKriteriaKemungkinan(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = kriteria_kemungkinan_risiko_spbe.id_status_persetujuan');
        $this->builder()->join('level_kemungkinan_risiko_spbe','level_kemungkinan_risiko_spbe.id = kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan');
        $this->builder()->join('kategori_risiko_spbe','kategori_risiko_spbe.id = kriteria_kemungkinan_risiko_spbe.id_kategori_risiko');
        return $this->builder()->select('kriteria_kemungkinan_risiko_spbe.id, id_kategori_risiko, id_level_kemungkinan, level_kemungkinan_risiko_spbe.level_kemungkinan, kategori_risiko_spbe.kategori_risiko, id_status_persetujuan, status_persetujuan.status,komentar, presentase_kemungkinan, jumlah_frekuensi')->get()->getResultArray();
        
    }

}