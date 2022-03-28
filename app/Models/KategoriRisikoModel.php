<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriRisikoModel extends Model
{

    protected $table      = 'kategori_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['kategori_risiko','id'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;



}