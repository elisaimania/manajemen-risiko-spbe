<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisRisiko extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel jenis_risiko
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'jenis_risiko'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);


		// Membuat tabel jenis_risiko
		$this->forge->createTable('jenis_risiko', TRUE);
    }

    public function down()
    {
        // menghapus tabel jenis_risiko
		$this->forge->dropTable('jenis_risiko');
    }
}
