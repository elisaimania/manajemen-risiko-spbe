<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriRisikoSpbe extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel kategori_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'kategori_risiko'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			]
	]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel kategori_risiko_SPBE
		$this->forge->createTable('kategori_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel kategori_risiko_SPBE
		$this->forge->dropTable('kategori_risiko_SPBE');
    }
}
