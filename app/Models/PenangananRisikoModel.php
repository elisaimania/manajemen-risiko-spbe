<?php

namespace App\Models;

use CodeIgniter\Model;

class PenangananRisikoModel extends Model
{

    protected $table      = 'rencana_penanganan_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'id_risiko', 'id_opsi_penanganan', 'rencana_aksi', 'keluaran', 'jadwal_mulai', 'jadwal_selesai', 'penanggungjawab', 'risiko_residual', 'id_status_persetujuan', 'komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPenanganan(){

        $this->builder()->join('status_persetujuan','status_persetujuan.id = rencana_penanganan_risiko_spbe.id_status_persetujuan');

        $this->builder()->join('penilaian_risiko_spbe','penilaian_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_risiko');

        $this->builder()->join('opsi_penanganan_risiko_spbe','opsi_penanganan_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_opsi_penanganan');

        return $this->builder()->select('rencana_penanganan_risiko_spbe.id, id_risiko, id_opsi_penanganan, opsi_penanganan_risiko_spbe.opsi_penanganan, rencana_aksi, keluaran, penanggungjawab, risiko_residual, rencana_penanganan_risiko_spbe.id_status_persetujuan, status_persetujuan.status, rencana_penanganan_risiko_spbe.komentar, jadwal_mulai,jadwal_selesai')->get()->getResultArray();
    }

}