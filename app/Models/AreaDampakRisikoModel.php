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



}