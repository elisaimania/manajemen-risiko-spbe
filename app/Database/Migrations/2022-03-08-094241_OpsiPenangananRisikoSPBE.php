<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OpsiPenangananRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel opsi_penanganan_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'opsi_penanganan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'id_jenis_risiko'       => [
				'type'           => 'INT',
				'constraint'     => 1
			]
	]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat foreign key
		$this->forge->addForeignKey('id_jenis_risiko', 'jenis_risiko', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel opsi_penanganan_risiko_SPBE
		$this->forge->createTable('opsi_penanganan_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel opsi_penanganan_risiko_SPBE
		$this->forge->dropTable('opsi_penanganan_risiko_SPBE');
    }
}
