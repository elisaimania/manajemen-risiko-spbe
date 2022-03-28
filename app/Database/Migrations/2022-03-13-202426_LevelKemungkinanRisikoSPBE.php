<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LevelKemungkinanRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel level_kemungkinan_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'level_kemungkinan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);


		// Membuat tabel jenis_risiko
		$this->forge->createTable('level_kemungkinan_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel jenis_risiko
		$this->forge->dropTable('level_kemungkinan_risiko_SPBE');
    }
}
