<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AreaDampakRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel area_dampak_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'area_dampak'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			]
	]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel area_dampak_risiko_SPBE
		$this->forge->createTable('area_dampak_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel area_dampak_risiko_SPBE
		$this->forge->dropTable('area_dampak_risiko_SPBE');
    }
}
