<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PemantauanRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel pemantauan_risiko_SPBE
        $this->forge->addField([
			'id'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
				'auto_increment' => true
            ],
            'id_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'id_penanganan_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'jenis_laporan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 20
            ],
            'periode_laporan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
                'null'           => true
            ],
            'id_level_kemungkinan_pemantauan'      => [
				'type'           => 'INT',
				'constraint'     => 1
            ],
            'id_level_dampak_pemantauan'      => [
				'type'           => 'INT',
				'constraint'     => 1
            ],
            'deskripsi_risiko_saat_ini'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'rekomendasi'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
                'null'           => true
            ],
            'rencana_penanganan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
                'null'           => true
            ],
            'penanggungjawab'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
                'null'           => true
            ],
            'waktu_pelaksanaan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
                'null'           => true
            ],
            'id_status_persetujuan'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'komentar'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
                'null'           => true
            ],
		]);

		// Membuat primary key
		$this->forge->addKey('id',TRUE);

        // Membuat foreign key
        $this->forge->addForeignKey('id_status_persetujuan', 'status_persetujuan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_risiko', 'penilaian_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_penanganan_risiko', 'rencana_penanganan_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level_kemungkinan_pemantauan', 'level_kemungkinan_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level_dampak_pemantauan', 'level_dampak_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        
		// Membuat tabel pemantauan_risiko_SPBE
		$this->forge->createTable('pemantauan_risiko_SPBE', TRUE);
        
    }

    public function down()
    {
        // menghapus tabel pemantauan_risiko_SPBE
		$this->forge->dropTable('pemantauan_risiko_SPBE');
    }
}
