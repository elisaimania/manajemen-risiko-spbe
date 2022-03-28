<?php

namespace App\Models;

use CodeIgniter\Model;

class OpsiPenangananModel extends Model
{

    protected $table      = 'opsi_penanganan_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['opsi_penanganan','id','id_jenis_risiko'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function getOpsi(){

    	$this->builder()->join('jenis_risiko', 'jenis_risiko.id=opsi_penanganan_risiko_spbe.id_jenis_risiko');
    	return $this->builder()->select('opsi_penanganan, opsi_penanganan_risiko_spbe.id, id_jenis_risiko, jenis_risiko.jenis_risiko')->get()->getResultArray();
    }

}