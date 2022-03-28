<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaDampakModel extends Model
{

    protected $table      = 'kriteria_dampak_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','id_area_dampak', 'id_jenis_risiko', 'id_level_dampak','penjelasan','id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getKriteriaDampak(){

        $this->builder()->join('status_persetujuan','status_persetujuan.id = kriteria_dampak_risiko_spbe.id_status_persetujuan');

        $this->builder()->join('level_dampak_risiko_spbe','level_dampak_risiko_spbe.id = kriteria_dampak_risiko_spbe.id_level_dampak');

        $this->builder()->join('area_dampak_risiko_spbe','area_dampak_risiko_spbe.id = kriteria_dampak_risiko_spbe.id_area_dampak');

        $this->builder()->join('jenis_risiko','jenis_risiko.id = kriteria_dampak_risiko_spbe.id_jenis_risiko');

        return $this->builder()->select('kriteria_dampak_risiko_spbe.id, id_area_dampak, id_jenis_risiko, id_level_dampak, level_dampak_risiko_spbe.level_dampak, area_dampak_risiko_spbe.area_dampak, jenis_risiko.jenis_risiko, id_status_persetujuan, status_persetujuan.status,komentar, penjelasan')->get()->getResultArray();
        
    }

}