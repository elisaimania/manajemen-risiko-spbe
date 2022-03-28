<?php

namespace App\Models;

use CodeIgniter\Model;

class LevelRisikoModel extends Model
{

    protected $table      = 'level_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['id','level_risiko','rentang_maks','rentang_min', 'ket_warna'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}