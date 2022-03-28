<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPersetujuanModel extends Model
{

    protected $table      = 'status_persetujuan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $allowedFields =['id','status'];

}