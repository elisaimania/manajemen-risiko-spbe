<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelDampakModel extends Model
{

    protected $table      = 'level_dampak_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','level_dampak'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}