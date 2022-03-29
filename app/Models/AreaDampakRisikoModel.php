<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaDampakRisikoModel extends Model
{

    protected $table      = 'area_dampak_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['area_dampak','id'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getAreaDampak(){

    	$db = db_connect();

    	$query = "SELECT id, area_dampak
        FROM area_dampak_risiko_spbe
    	WHERE area_dampak_risiko_spbe.id NOT IN (SELECT area_dampak_risiko_spbe_terpilih.id_area_dampak FROM area_dampak_risiko_spbe_terpilih)";

    	return $db->query($query)->getResultArray();
    }


}