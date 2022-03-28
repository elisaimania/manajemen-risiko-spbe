<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{

    protected $table      = 'pengguna';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['username','nama_pengguna','email','password','id_role','id'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPengguna(){
        $this->builder()->join('role_pengguna','role_pengguna.id = pengguna.id_role');
        return $this->builder()->select('username,nama_pengguna,email,password,nama_role,pengguna.id')->get()->getResultArray();
        
    }

}