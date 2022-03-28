<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keputusan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel keputusan
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'keputusan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 20
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);


		// Membuat tabel keputusan
		$this->forge->createTable('keputusan', TRUE);
    }

    public function down()
    {
        // menghapus tabel keputusan
		$this->forge->dropTable('keputusan');
    }
}
