<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{

    protected $table      = 'role_pengguna';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $allowedFields =['id','nama_role'];

}