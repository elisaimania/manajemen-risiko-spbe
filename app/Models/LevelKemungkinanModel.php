<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelKemungkinanModel extends Model
{

    protected $table      = 'level_kemungkinan_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','level_kemungkinan'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}