<?php

namespace App\Models;

use CodeIgniter\Model;

class PemantauanRisikoModel extends Model
{

    protected $table      = 'pemantauan_risiko_spbe';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'id_risiko', 'id_penanganan_risiko', 'jenis_laporan', 'periode_laporan', 'id_level_kemungkinan_pemantauan', 'id_level_dampak_pemantauan', 'deskripsi_risiko_saat_ini', 'rekomendasi', 'rencana_penanganan', 'penanggungjawab', 'waktu_pelaksanaan_rencana', 'id_status_persetujuan', 'komentar'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function getPemantauan()
    {

        $db = db_connect();

        $query = "SELECT pemantauan_risiko_spbe.id, pemantauan_risiko_spbe.id_risiko, pemantauan_risiko_spbe.id_penanganan_risiko, pemantauan_risiko_spbe.jenis_laporan, pemantauan_risiko_spbe.periode_laporan, pemantauan_risiko_spbe.id_level_kemungkinan_pemantauan, pemantauan_risiko_spbe.id_level_dampak_pemantauan, pemantauan_risiko_spbe.deskripsi_risiko_saat_ini, pemantauan_risiko_spbe.rekomendasi, pemantauan_risiko_spbe.rencana_penanganan, pemantauan_risiko_spbe.penanggungjawab, pemantauan_risiko_spbe.waktu_pelaksanaan_rencana, pemantauan_risiko_spbe.id_status_persetujuan, pemantauan_risiko_spbe.komentar, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak, status_persetujuan.status, opsi_penanganan_risiko_spbe.opsi_penanganan, penilaian_risiko_spbe.kejadian 
            FROM pemantauan_risiko_spbe
            INNER JOIN status_persetujuan
            ON status_persetujuan.id = pemantauan_risiko_spbe.id_status_persetujuan
            INNER JOIN rencana_penanganan_risiko_spbe
            ON rencana_penanganan_risiko_spbe.id = pemantauan_risiko_spbe.id_penanganan_risiko
            INNER JOIN opsi_penanganan_risiko_spbe
            ON opsi_penanganan_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_opsi_penanganan
            INNER JOIN penilaian_risiko_spbe
            ON penilaian_risiko_spbe.id = pemantauan_risiko_spbe.id_risiko
            INNER JOIN sasaran_spbe
            ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE
            INNER JOIN jenis_risiko
            ON jenis_risiko.id = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN kategori_risiko_spbe_terpilih
            ON kategori_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_kategori_risiko
            INNER JOIN kategori_risiko_spbe
            ON kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko
            INNER JOIN area_dampak_risiko_spbe_terpilih
            ON area_dampak_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_area_dampak
            INNER JOIN area_dampak_risiko_spbe
            ON area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id_area_dampak
            INNER JOIN kriteria_kemungkinan_risiko_spbe
            ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan AND kriteria_kemungkinan_risiko_spbe.id_upr = penilaian_risiko_spbe.id_upr
            INNER JOIN kriteria_dampak_risiko_spbe
            ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
            kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko AND kriteria_dampak_risiko_spbe.id_upr = penilaian_risiko_spbe.id_upr
            INNER JOIN keputusan
            ON keputusan.id = penilaian_risiko_spbe.id_keputusan
            INNER JOIN level_kemungkinan_risiko_spbe
            ON level_kemungkinan_risiko_spbe.id = pemantauan_risiko_spbe.id_level_kemungkinan_pemantauan
            INNER JOIN level_dampak_risiko_spbe
            ON level_dampak_risiko_spbe.id = pemantauan_risiko_spbe.id_level_dampak_pemantauan
            WHERE penilaian_risiko_spbe.id_upr = " . session()->id_upr.
            " AND kriteria_kemungkinan_risiko_spbe.id_status_persetujuan = 2 AND kriteria_dampak_risiko_spbe.id_status_persetujuan = 2 AND kategori_risiko_spbe_terpilih.id_status_persetujuan = 2 AND area_dampak_risiko_spbe_terpilih.id_status_persetujuan
             = 2 AND sasaran_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_keputusan = 2 AND penilaian_risiko_spbe.id_status_persetujuan = 2
            ";
        return $db->query($query)->getResultArray();
    }

    public function getPemantauanByPersetujuan()
    {

        $db = db_connect();

        $query = "SELECT pemantauan_risiko_spbe.id, pemantauan_risiko_spbe.id_risiko, pemantauan_risiko_spbe.id_penanganan_risiko, pemantauan_risiko_spbe.jenis_laporan, pemantauan_risiko_spbe.periode_laporan, pemantauan_risiko_spbe.id_level_kemungkinan_pemantauan, pemantauan_risiko_spbe.id_level_dampak_pemantauan, pemantauan_risiko_spbe.deskripsi_risiko_saat_ini, pemantauan_risiko_spbe.rekomendasi, pemantauan_risiko_spbe.rencana_penanganan, pemantauan_risiko_spbe.penanggungjawab, pemantauan_risiko_spbe.waktu_pelaksanaan_rencana, pemantauan_risiko_spbe.id_status_persetujuan, pemantauan_risiko_spbe.komentar, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak, status_persetujuan.status, opsi_penanganan_risiko_spbe.opsi_penanganan, penilaian_risiko_spbe.kejadian 
            FROM pemantauan_risiko_spbe
            INNER JOIN status_persetujuan
            ON status_persetujuan.id = pemantauan_risiko_spbe.id_status_persetujuan
            INNER JOIN rencana_penanganan_risiko_spbe
            ON rencana_penanganan_risiko_spbe.id = pemantauan_risiko_spbe.id_penanganan_risiko
            INNER JOIN opsi_penanganan_risiko_spbe
            ON opsi_penanganan_risiko_spbe.id = rencana_penanganan_risiko_spbe.id_opsi_penanganan
            INNER JOIN penilaian_risiko_spbe
            ON penilaian_risiko_spbe.id = pemantauan_risiko_spbe.id_risiko
            INNER JOIN sasaran_spbe
            ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE
            INNER JOIN jenis_risiko
            ON jenis_risiko.id = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN kategori_risiko_spbe_terpilih
            ON kategori_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_kategori_risiko
            INNER JOIN kategori_risiko_spbe
            ON kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko
            INNER JOIN area_dampak_risiko_spbe_terpilih
            ON area_dampak_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_area_dampak
            INNER JOIN area_dampak_risiko_spbe
            ON area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id_area_dampak
            INNER JOIN kriteria_kemungkinan_risiko_spbe
            ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan AND kriteria_kemungkinan_risiko_spbe.id_upr = penilaian_risiko_spbe.id_upr
            INNER JOIN kriteria_dampak_risiko_spbe
            ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
            kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko AND kriteria_dampak_risiko_spbe.id_upr = penilaian_risiko_spbe.id_upr
            INNER JOIN keputusan
            ON keputusan.id = penilaian_risiko_spbe.id_keputusan
            INNER JOIN level_kemungkinan_risiko_spbe
            ON level_kemungkinan_risiko_spbe.id = pemantauan_risiko_spbe.id_level_kemungkinan_pemantauan
            INNER JOIN level_dampak_risiko_spbe
            ON level_dampak_risiko_spbe.id = pemantauan_risiko_spbe.id_level_dampak_pemantauan
            WHERE penilaian_risiko_spbe.id_upr = " . session()->id_upr.
            " AND kriteria_kemungkinan_risiko_spbe.id_status_persetujuan = 2 AND kriteria_dampak_risiko_spbe.id_status_persetujuan = 2 AND kategori_risiko_spbe_terpilih.id_status_persetujuan = 2 AND area_dampak_risiko_spbe_terpilih.id_status_persetujuan
             = 2 AND sasaran_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_keputusan = 2 AND penilaian_risiko_spbe.id_status_persetujuan = 2 AND pemantauan_risiko_spbe.id_status_persetujuan = 2
            ";
        return $db->query($query)->getResultArray();
    }


    public function getPemantauanById($id)
    {

        $db = db_connect();

        $query = "SELECT pemantauan_risiko_spbe.id, pemantauan_risiko_spbe.id_risiko, pemantauan_risiko_spbe.id_penanganan_risiko, pemantauan_risiko_spbe.jenis_laporan, pemantauan_risiko_spbe.periode_laporan, pemantauan_risiko_spbe.id_level_kemungkinan_pemantauan, pemantauan_risiko_spbe.id_level_dampak_pemantauan, pemantauan_risiko_spbe.deskripsi_risiko_saat_ini, pemantauan_risiko_spbe.rekomendasi, pemantauan_risiko_spbe.rencana_penanganan, pemantauan_risiko_spbe.penanggungjawab, pemantauan_risiko_spbe.waktu_pelaksanaan_rencana, pemantauan_risiko_spbe.id_status_persetujuan, pemantauan_risiko_spbe.komentar, level_kemungkinan_risiko_spbe.level_kemungkinan, level_dampak_risiko_spbe.level_dampak, status_persetujuan.status, rencana_penanganan_risiko_spbe.rencana_aksi
            FROM pemantauan_risiko_spbe
            INNER JOIN status_persetujuan
            ON status_persetujuan.id = pemantauan_risiko_spbe.id_status_persetujuan
            INNER JOIN rencana_penanganan_risiko_spbe
            ON rencana_penanganan_risiko_spbe.id = pemantauan_risiko_spbe.id_penanganan_risiko
            INNER JOIN penilaian_risiko_spbe
            ON penilaian_risiko_spbe.id = pemantauan_risiko_spbe.id_risiko
            INNER JOIN sasaran_spbe
            ON sasaran_spbe.id = penilaian_risiko_spbe.id_sasaran_SPBE
            INNER JOIN jenis_risiko
            ON jenis_risiko.id = penilaian_risiko_spbe.id_jenis_risiko
            INNER JOIN kategori_risiko_spbe_terpilih
            ON kategori_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_kategori_risiko
            INNER JOIN kategori_risiko_spbe
            ON kategori_risiko_spbe.id = kategori_risiko_spbe_terpilih.id_kategori_risiko
            INNER JOIN area_dampak_risiko_spbe_terpilih
            ON area_dampak_risiko_spbe_terpilih.id = penilaian_risiko_spbe.id_area_dampak
            INNER JOIN area_dampak_risiko_spbe
            ON area_dampak_risiko_spbe.id = area_dampak_risiko_spbe_terpilih.id_area_dampak
            INNER JOIN kriteria_kemungkinan_risiko_spbe
            ON kriteria_kemungkinan_risiko_spbe.id_kategori_risiko = penilaian_risiko_spbe.id_kategori_risiko AND kriteria_kemungkinan_risiko_spbe.id_level_kemungkinan = penilaian_risiko_spbe.id_level_kemungkinan AND kriteria_kemungkinan_risiko_spbe.id_upr = penilaian_risiko_spbe.id_upr
            INNER JOIN kriteria_dampak_risiko_spbe
            ON kriteria_dampak_risiko_spbe.id_area_dampak = penilaian_risiko_spbe.id_area_dampak AND
            kriteria_dampak_risiko_spbe.id_level_dampak = penilaian_risiko_spbe.id_level_dampak AND
            kriteria_dampak_risiko_spbe.id_jenis_risiko = penilaian_risiko_spbe.id_jenis_risiko AND kriteria_dampak_risiko_spbe.id_upr = penilaian_risiko_spbe.id_upr
            INNER JOIN keputusan
            ON keputusan.id = penilaian_risiko_spbe.id_keputusan
            INNER JOIN level_kemungkinan_risiko_spbe
            ON level_kemungkinan_risiko_spbe.id = pemantauan_risiko_spbe.id_level_kemungkinan_pemantauan
            INNER JOIN level_dampak_risiko_spbe
            ON level_dampak_risiko_spbe.id = pemantauan_risiko_spbe.id_level_dampak_pemantauan
            WHERE penilaian_risiko_spbe.id_upr = " . session()->id_upr.
            " AND kriteria_kemungkinan_risiko_spbe.id_status_persetujuan = 2 AND kriteria_dampak_risiko_spbe.id_status_persetujuan = 2 AND kategori_risiko_spbe_terpilih.id_status_persetujuan = 2 AND area_dampak_risiko_spbe_terpilih.id_status_persetujuan
             = 2 AND sasaran_spbe.id_status_persetujuan = 2 AND penilaian_risiko_spbe.id_keputusan = 2 AND penilaian_risiko_spbe.id_status_persetujuan = 2 AND pemantauan_risiko_spbe.id =".$id
            ;
        return $db->query($query)->getResultArray();
    }

}