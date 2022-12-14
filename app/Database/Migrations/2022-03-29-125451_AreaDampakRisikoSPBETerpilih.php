<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AreaDampakRisikoSPBETerpilih extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel area_dampak_SPBE_terpilih
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
            'id_area_dampak'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true
			],
            'id_upr'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true
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
		$this->forge->addForeignKey('id', 'area_dampak_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_upr', 'upr_spbe', 'id', 'CASCADE', 'CASCADE');
     

		// Membuat tabel area_dampak_SPBE_terpilih
		$this->forge->createTable('area_dampak_risiko_SPBE_terpilih', TRUE);
    }

    public function down()
    {
        // menghapus tabel kategori_risiko_SPBE_terpilih
		$this->forge->dropTable('area_dampak_risiko_SPBE_terpilih');
    }
}

