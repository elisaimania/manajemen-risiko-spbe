<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LevelDampakRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel level_dampak_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'level_dampak'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);


		// Membuat tabel level_dampak_risiko_SPBE
		$this->forge->createTable('level_dampak_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel level_dampak_risiko_SPBE
		$this->forge->dropTable('level_dampak_risiko_SPBE');
    }
}
