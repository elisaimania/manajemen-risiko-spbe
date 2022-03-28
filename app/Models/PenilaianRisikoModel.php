<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianRisikoModel extends Model
{

    protected $table      = 'penilaian_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'id_sasaran_SPBE', 'id_jenis_risiko', 'kejadian', 'penyebab', 'id_kategori_risiko', 'dampak', 'id_area_dampak', 'sistem_pengendalian', 'id_level_kemungkinan', 'id_level_dampak', 'id_level_risiko', 'id_keputusan',  'id_status_persetujuan','komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPenilaian()
    {

        $db = db_connect();

        $query = "SELECT penilaian_risiko_spbe.id, id_sasaran_SPBE, penilaian_risiko_spbe.id_jenis_risiko, kejadian, penyebab, penilaian_risiko_spbe.id_kategori_risiko, dampak, penilaian_risiko_spbe.id_area_dampak, sistem_pengendalian, penilaian_risiko_spbe.id_level_kemungkinan, penilaian_risiko_spbe.id_level_dampak, penilaian_risiko_spbe.id_level_risiko, id_keputusan, penilaian_risiko_spbe.id_status_persetujuan, status_persetujuan.status, penilaian_risiko_spbe.komentar, sasaran_spbe.sasaran_SPBE, sasaran_spbe.indikator_kinerja_SPBE, jenis_risiko.jenis_risiko, kategori_risiko_spbe.kategori_risiko, area_dampak_risiko_spbe.area_dampak, matriks_analisi_risiko.besaran_risiko, level_risiko_spbe.level_risiko, keputusan.keputusan, kriteria_dampak_risiko_spbe.penjelasan, kriteria_kemungkinan_risiko_spbe.presentase_kemungkinan, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak,
            CASE 
                WHEN id_keputusan = 2 
                THEN DENSE_RANK() OVER (ORDER BY besaran_risiko DESC) ELSE ''
            END AS prioritas
            FROM penilaian_risiko_spbe
            INNER JOIN status_persetujuan
            ON status_persetujuan.id = penilaian_risiko_spbe.id_status_persetujuan
            INNER JOIN sasaran_spbe
            ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE
            INNER JOIN jenis_risiko
            ON jenis_risiko.id = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN kategori_risiko_spbe
            ON kategori_risiko_spbe.id = penilaian_risiko_spbe.id_kategori_risiko
            INNER JOIN area_dampak_risiko_spbe
            ON area_dampak_risiko_spbe.id = penilaian_risiko_spbe.id_area_dampak
            INNER JOIN level_kemungkinan_risiko_spbe
            ON level_kemungkinan_risiko_spbe.id = penilaian_risiko_spbe.id_level_kemungkinan
            INNER JOIN level_dampak_risiko_spbe
            ON level_dampak_risiko_spbe.id = penilaian_risiko_spbe.id_level_dampak
            INNER JOIN matriks_analisi_risiko
            ON matriks_analisi_risiko.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan AND 
            matriks_analisi_risiko.id_level_dampak = penilaian_risiko_spbe.id_level_dampak
            INNER JOIN kriteria_kemungkinan_risiko_spbe
            ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan
            INNER JOIN kriteria_dampak_risiko_spbe
            ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
            kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN level_risiko_spbe
            ON level_risiko_spbe.id = penilaian_risiko_spbe.id_level_risiko
            INNER JOIN keputusan
            ON keputusan.id = penilaian_risiko_spbe.id_keputusan
            ORDER BY besaran_risiko DESC
            ";
        return $db->query($query)->getResultArray();
    }


    public function getPenilaianByKeputusan()
    {

        $db = db_connect();

        $query = "SELECT penilaian_risiko_spbe.id, id_sasaran_SPBE, penilaian_risiko_spbe.id_jenis_risiko, kejadian, penyebab, penilaian_risiko_spbe.id_kategori_risiko, dampak, penilaian_risiko_spbe.id_area_dampak, sistem_pengendalian, penilaian_risiko_spbe.id_level_kemungkinan, penilaian_risiko_spbe.id_level_dampak, penilaian_risiko_spbe.id_level_risiko, id_keputusan, penilaian_risiko_spbe.id_status_persetujuan, status_persetujuan.status, penilaian_risiko_spbe.komentar, sasaran_spbe.sasaran_SPBE, sasaran_spbe.indikator_kinerja_SPBE, jenis_risiko.jenis_risiko, kategori_risiko_spbe.kategori_risiko, area_dampak_risiko_spbe.area_dampak, matriks_analisi_risiko.besaran_risiko, level_risiko_spbe.level_risiko, keputusan.keputusan, kriteria_dampak_risiko_spbe.penjelasan, kriteria_kemungkinan_risiko_spbe.presentase_kemungkinan, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak,
            CASE 
                WHEN id_keputusan = 2 
                THEN DENSE_RANK() OVER (ORDER BY besaran_risiko DESC) ELSE ''
            END AS prioritas
            FROM penilaian_risiko_spbe
            INNER JOIN status_persetujuan
            ON status_persetujuan.id = penilaian_risiko_spbe.id_status_persetujuan
            INNER JOIN sasaran_spbe
            ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE
            INNER JOIN jenis_risiko
            ON jenis_risiko.id = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN kategori_risiko_spbe
            ON kategori_risiko_spbe.id = penilaian_risiko_spbe.id_kategori_risiko
            INNER JOIN area_dampak_risiko_spbe
            ON area_dampak_risiko_spbe.id = penilaian_risiko_spbe.id_area_dampak
            INNER JOIN level_kemungkinan_risiko_spbe
            ON level_kemungkinan_risiko_spbe.id = penilaian_risiko_spbe.id_level_kemungkinan
            INNER JOIN level_dampak_risiko_spbe
            ON level_dampak_risiko_spbe.id = penilaian_risiko_spbe.id_level_dampak
            INNER JOIN matriks_analisi_risiko
            ON matriks_analisi_risiko.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan AND 
            matriks_analisi_risiko.id_level_dampak = penilaian_risiko_spbe.id_level_dampak
            INNER JOIN kriteria_kemungkinan_risiko_spbe
            ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan
            INNER JOIN kriteria_dampak_risiko_spbe
            ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
            kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN level_risiko_spbe
            ON level_risiko_spbe.id = penilaian_risiko_spbe.id_level_risiko
            INNER JOIN keputusan
            ON keputusan.id = penilaian_risiko_spbe.id_keputusan
            WHERE id_keputusan =2 AND penilaian_risiko_spbe.id NOT IN (
                                                                        SELECT id_risiko FROM rencana_penanganan_risiko_spbe)
            ORDER BY besaran_risiko DESC
            ";
        return $db->query($query)->getResultArray();
    }


    public function getPenilaianById($id)
    {

        $db = db_connect();

        $query = "SELECT penilaian_risiko_spbe.id, id_sasaran_SPBE, penilaian_risiko_spbe.id_jenis_risiko, kejadian, penyebab, penilaian_risiko_spbe.id_kategori_risiko, dampak, penilaian_risiko_spbe.id_area_dampak, sistem_pengendalian, penilaian_risiko_spbe.id_level_kemungkinan, penilaian_risiko_spbe.id_level_dampak, penilaian_risiko_spbe.id_level_risiko, id_keputusan, penilaian_risiko_spbe.id_status_persetujuan, status_persetujuan.status, penilaian_risiko_spbe.komentar, sasaran_spbe.sasaran_SPBE, sasaran_spbe.indikator_kinerja_SPBE, jenis_risiko.jenis_risiko, kategori_risiko_spbe.kategori_risiko, area_dampak_risiko_spbe.area_dampak, matriks_analisi_risiko.besaran_risiko, level_risiko_spbe.level_risiko, keputusan.keputusan, kriteria_dampak_risiko_spbe.penjelasan, kriteria_kemungkinan_risiko_spbe.presentase_kemungkinan, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak,
            CASE 
                WHEN id_keputusan = 2 
                THEN DENSE_RANK() OVER (ORDER BY besaran_risiko DESC) ELSE ''
            END AS prioritas
            FROM penilaian_risiko_spbe
            INNER JOIN status_persetujuan
            ON status_persetujuan.id = penilaian_risiko_spbe.id_status_persetujuan
            INNER JOIN sasaran_spbe
            ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE
            INNER JOIN jenis_risiko
            ON jenis_risiko.id = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN kategori_risiko_spbe
            ON kategori_risiko_spbe.id = penilaian_risiko_spbe.id_kategori_risiko
            INNER JOIN area_dampak_risiko_spbe
            ON area_dampak_risiko_spbe.id = penilaian_risiko_spbe.id_area_dampak
            INNER JOIN level_kemungkinan_risiko_spbe
            ON level_kemungkinan_risiko_spbe.id = penilaian_risiko_spbe.id_level_kemungkinan
            INNER JOIN level_dampak_risiko_spbe
            ON level_dampak_risiko_spbe.id = penilaian_risiko_spbe.id_level_dampak
            INNER JOIN matriks_analisi_risiko
            ON matriks_analisi_risiko.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan AND 
            matriks_analisi_risiko.id_level_dampak = penilaian_risiko_spbe.id_level_dampak
            INNER JOIN kriteria_kemungkinan_risiko_spbe
            ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan
            INNER JOIN kriteria_dampak_risiko_spbe
            ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
            kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN level_risiko_spbe
            ON level_risiko_spbe.id = penilaian_risiko_spbe.id_level_risiko
            INNER JOIN keputusan
            ON keputusan.id = penilaian_risiko_spbe.id_keputusan
            WHERE penilaian_risiko_spbe.id = ".$id.
            "
            ORDER BY besaran_risiko DESC
            ";
        return $db->query($query)->getResultArray();
        
    }




}