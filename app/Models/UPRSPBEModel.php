<?php

namespace App\Models;

use CodeIgniter\Model;

class UPRSPBEModel extends Model
{

    protected $table      = 'upr_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','upr_SPBE'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}