<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRisikoModel extends Model
{

    protected $table      = 'jenis_risiko';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','jenis_risiko'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}