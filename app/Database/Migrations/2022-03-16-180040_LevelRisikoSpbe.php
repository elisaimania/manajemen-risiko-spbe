<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LevelRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel level_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 1,
				'unsigned'       => true,
				'auto_increment' => true
			],
            'level_risiko'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'rentang_min'      => [
				'type'           => 'INT',
				'constraint'     => 3
            ],
            'rentang_maks'      => [
				'type'           => 'INT',
				'constraint'     => 3
			],
            'ket_warna'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 30
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel level_risiko_SPBE
		$this->forge->createTable('level_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel level_risiko_SPBE
		$this->forge->dropTable('level_risiko_SPBE');
    }
}
