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

    public function getKategori(){

    	$db = db_connect();

    	$query = "SELECT kategori_risiko_spbe.id, kategori_risiko
        FROM kategori_risiko_spbe
    	WHERE kategori_risiko_spbe.id NOT IN (SELECT kategori_risiko_spbe_terpilih.id_kategori_risiko FROM kategori_risiko_spbe_terpilih WHERE id_upr = ".session()->id_upr.")";

    	return $db->query($query)->getResultArray();
    }

}