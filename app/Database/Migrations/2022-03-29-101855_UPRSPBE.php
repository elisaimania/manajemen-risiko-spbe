<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UPRSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel UPR_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'upr_SPBE'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			]
	]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel 'UPR_SPBE
		$this->forge->createTable('UPR_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel 'UPR_SPBE
		$this->forge->dropTable('UPR_SPBE');
    }
}
