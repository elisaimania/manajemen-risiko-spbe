<?php

namespace App\Models;

use CodeIgniter\Model;

class PenangananRisikoModel extends Model
{

    protected $table      = 'rencana_penanganan_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'id_risiko', 'id_opsi_penanganan', 'rencana_aksi', 'keluaran', 'jenis_periode_implementasi', 'periode_implementasi','tanggal_mulai', 'tanggal_selesai', 'penanggungjawab', 'risiko_residual', 'id_status_persetujuan', 'komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPenangananBelumSetuju(){

        $db = db_connect();

        $query = "
        SELECT rencana_penanganan_risiko_spbe.id, id_risiko, id_opsi_penanganan, opsi_penanganan_risiko_spbe.opsi_penanganan, rencana_aksi, keluaran, jenis_periode_implementasi, periode_implementasi, penanggungjawab, risiko_residual, rencana_penanganan_risiko_spbe.id_status_persetujuan, status_persetujuan.status, rencana_penanganan_risiko_spbe.komentar, tanggal_mulai,tanggal_selesai, penilaian_risiko_spbe.id_upr
        FROM rencana_penanganan_risiko_spbe
        INNER JOIN status_persetujuan
        ON status_persetujuan.id = rencana_penanganan_risiko_spbe.id_status_persetujuan
        INNER JOIN opsi_penanganan_risiko_spbe
        ON opsi_penanganan_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_opsi_penanganan
        INNER JOIN penilaian_risiko_spbe
        ON penilaian_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_risiko
        INNER JOIN kategori_risiko_spbe_terpilih
        ON kategori_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_kategori_risiko
        INNER JOIN kategori_risiko_spbe
        ON kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko
        INNER JOIN area_dampak_risiko_spbe_terpilih
        ON area_dampak_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_area_dampak
        INNER JOIN area_dampak_risiko_spbe
        ON area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id_area_dampak
        INNER JOIN kriteria_kemungkinan_risiko_spbe
        ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan
        INNER JOIN kriteria_dampak_risiko_spbe
        ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
        kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko

        INNER JOIN sasaran_spbe
        ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE 

        WHERE penilaian_risiko_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_keputusan= 2 AND kriteria_kemungkinan_risiko_spbe.id_status_persetujuan = 2 AND kriteria_dampak_risiko_spbe.id_status_persetujuan=2 AND kategori_risiko_spbe_terpilih.id_status_persetujuan = 2 AND area_dampak_risiko_spbe_terpilih.id_status_persetujuan = 2 AND sasaran_spbe.id_status_persetujuan = 2 AND rencana_penanganan_risiko_spbe.id_status_persetujuan = 1 AND penilaian_risiko_spbe.id_upr = ".session()->id_upr

        ;
        return $db->query($query)->getResultArray();

    }

    public function getPenanganan(){

        $db = db_connect();

        $query = "
        SELECT rencana_penanganan_risiko_spbe.id, id_risiko, id_opsi_penanganan, opsi_penanganan_risiko_spbe.opsi_penanganan, rencana_aksi, keluaran, jenis_periode_implementasi, periode_implementasi, penanggungjawab, risiko_residual, rencana_penanganan_risiko_spbe.id_status_persetujuan, status_persetujuan.status, rencana_penanganan_risiko_spbe.komentar, tanggal_mulai,tanggal_selesai, penilaian_risiko_spbe.id_upr
        FROM rencana_penanganan_risiko_spbe
        INNER JOIN status_persetujuan
        ON status_persetujuan.id = rencana_penanganan_risiko_spbe.id_status_persetujuan
        INNER JOIN opsi_penanganan_risiko_spbe
        ON opsi_penanganan_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_opsi_penanganan
        INNER JOIN penilaian_risiko_spbe
        ON penilaian_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_risiko
        INNER JOIN kategori_risiko_spbe_terpilih
        ON kategori_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_kategori_risiko
        INNER JOIN kategori_risiko_spbe
        ON kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko
        INNER JOIN area_dampak_risiko_spbe_terpilih
        ON area_dampak_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_area_dampak
        INNER JOIN area_dampak_risiko_spbe
        ON area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id_area_dampak
        INNER JOIN kriteria_kemungkinan_risiko_spbe
        ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan
        INNER JOIN kriteria_dampak_risiko_spbe
        ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
        kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko

        INNER JOIN sasaran_spbe
        ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE 

        WHERE penilaian_risiko_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_keputusan= 2 AND kriteria_kemungkinan_risiko_spbe.id_status_persetujuan = 2 AND kriteria_dampak_risiko_spbe.id_status_persetujuan=2 AND kategori_risiko_spbe_terpilih.id_status_persetujuan = 2 AND area_dampak_risiko_spbe_terpilih.id_status_persetujuan = 2 AND sasaran_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_upr = ".session()->id_upr

        ;
        return $db->query($query)->getResultArray();
    }

    public function getPenangananSetuju(){

        $db = db_connect();

        $query = "
        SELECT rencana_penanganan_risiko_spbe.id, id_risiko, id_opsi_penanganan, opsi_penanganan_risiko_spbe.opsi_penanganan, rencana_aksi, keluaran, jenis_periode_implementasi, periode_implementasi, penanggungjawab, risiko_residual, rencana_penanganan_risiko_spbe.id_status_persetujuan, status_persetujuan.status, rencana_penanganan_risiko_spbe.komentar, tanggal_mulai,tanggal_selesai, penilaian_risiko_spbe.id_upr
        FROM rencana_penanganan_risiko_spbe
        INNER JOIN status_persetujuan
        ON status_persetujuan.id = rencana_penanganan_risiko_spbe.id_status_persetujuan
        INNER JOIN opsi_penanganan_risiko_spbe
        ON opsi_penanganan_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_opsi_penanganan
        INNER JOIN penilaian_risiko_spbe
        ON penilaian_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_risiko
        INNER JOIN kategori_risiko_spbe_terpilih
        ON kategori_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_kategori_risiko
        INNER JOIN kategori_risiko_spbe
        ON kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko
        INNER JOIN area_dampak_risiko_spbe_terpilih
        ON area_dampak_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_area_dampak
        INNER JOIN area_dampak_risiko_spbe
        ON area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id_area_dampak
        INNER JOIN kriteria_kemungkinan_risiko_spbe
        ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan
        INNER JOIN kriteria_dampak_risiko_spbe
        ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
        kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko

        INNER JOIN sasaran_spbe
        ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE 

        WHERE penilaian_risiko_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_keputusan= 2 AND kriteria_kemungkinan_risiko_spbe.id_status_persetujuan = 2 AND kriteria_dampak_risiko_spbe.id_status_persetujuan=2 AND kategori_risiko_spbe_terpilih.id_status_persetujuan = 2 AND area_dampak_risiko_spbe_terpilih.id_status_persetujuan = 2 AND sasaran_spbe.id_status_persetujuan = 2 AND rencana_penanganan_risiko_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_upr = ".session()->id_upr

        ;
        return $db->query($query)->getResultArray();
    }


}