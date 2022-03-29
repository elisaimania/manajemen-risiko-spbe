<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaDampakRisikoTerpilihModel extends Model
{

    protected $table      = 'area_dampak_risiko_spbe_terpilih';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'id_upr', 'id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAreaDampakRisikoTerpilih(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = area_dampak_risiko_spbe_terpilih.id_status_persetujuan');
        $this->builder()->join('area_dampak_risiko_spbe','area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id');
        return $this->builder()->select('area_dampak_risiko_spbe_terpilih.id, area_dampak_risiko_spbe.area_dampak, id_upr, id_status_persetujuan, status_persetujuan.status, komentar')->get()->getResultArray();
        
    }

}