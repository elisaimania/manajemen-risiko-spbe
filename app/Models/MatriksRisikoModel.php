<?php

namespace App\Models;

use CodeIgniter\Model;

class MatriksRisikoModel extends Model
{

    protected $table      = 'matriks_analisi_risiko';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id_level_kemungkinan', 'id_level_dampak','besaran_risiko'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function getMatriks(){
    	$this->builder()->join('level_kemungkinan_risiko_spbe', 'level_kemungkinan_risiko_spbe.id = matriks_analisi_risiko.id_level_kemungkinan');
    	$this->builder()->join('level_dampak_risiko_spbe', 'level_dampak_risiko_spbe.id = matriks_analisi_risiko.id_level_dampak');
    	return $this->builder()->select('id_level_kemungkinan, id_level_dampak, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak, besaran_risiko')->get()->getResultArray();
    }

}