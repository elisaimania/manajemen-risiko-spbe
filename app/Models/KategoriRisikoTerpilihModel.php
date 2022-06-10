<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriRisikoTerpilihModel extends Model
{

    protected $table      = 'kategori_risiko_spbe_terpilih';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['id','id_kategori_risiko', 'id_upr', 'id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getKategoriRisikoTerpilih(){
        $this->builder()->join('status_persetujuan','status_persetujuan.id = kategori_risiko_spbe_terpilih.id_status_persetujuan');
        $this->builder()->join('kategori_risiko_spbe','kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko');
        return $this->builder()->select('kategori_risiko_spbe_terpilih.id, id_kategori_risiko, kategori_risiko_spbe.kategori_risiko, id_upr, id_status_persetujuan, status_persetujuan.status, komentar')->orderBy('id_status_persetujuan', 'DESC')->where('id_upr',session()->id_upr)->get()->getResultArray();
        
    }



}