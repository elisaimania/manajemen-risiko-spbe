<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenilaianRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel penilaian_risiko_SPBE
		$this->forge->addField([
			'id'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
				'auto_increment' => true
            ],
            'id_sasaran_SPBE'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'id_jenis_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 1
            ],
            'kejadian'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'penyebab'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'id_kategori_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'dampak'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'id_area_dampak'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'sistem_pengendalian'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'id_level_kemungkinan'      => [
				'type'           => 'INT',
				'constraint'     => 1
            ],
            'id_level_dampak'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'id_level_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 1,
                'unsigned'       => true
			],
            'id_keputusan'      => [
				'type'           => 'INT',
				'constraint'     => 1
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
		$this->forge->addForeignKey('id_level_kemungkinan', 'level_kemungkinan_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level_dampak', 'level_dampak_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status_persetujuan', 'status_persetujuan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_sasaran_SPBE', 'sasaran_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_jenis_risiko', 'jenis_risiko', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kategori_risiko', 'kategori_risiko_spbe_terpilih', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_area_dampak', 'area_dampak_risiko_spbe_terpilih', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level_risiko', 'level_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_keputusan', 'keputusan', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel penilaian_risiko_SPBE
		$this->forge->createTable('penilaian_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel penilaian_risiko_SPBE
		$this->forge->dropTable('penilaian_risiko_SPBE');
    }
}

