<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KriteriaDampakRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel kriteria_dampak_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'id_area_dampak'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
            ],
            'id_jenis_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'id_level_dampak'      => [
				'type'           => 'INT',
				'constraint'     => 4
			],
            'penjelasan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
            'id_upr'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
            ],
            'id_status_persetujuan'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'komentar'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

        // Membuat foreign key
		$this->forge->addForeignKey('id_status_persetujuan', 'status_persetujuan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_area_dampak', 'area_dampak_risiko_spbe_terpilih', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level_dampak', 'level_dampak_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_jenis_risiko', 'jenis_risiko', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_upr', 'upr_spbe', 'id', 'CASCADE', 'CASCADE');


		// Membuat tabel kriteria_dampak_risiko_SPBE
		$this->forge->createTable('kriteria_dampak_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel kriteria_dampak_risiko_SPBE
		$this->forge->dropTable('kriteria_dampak_risiko_SPBE');
    }
}
