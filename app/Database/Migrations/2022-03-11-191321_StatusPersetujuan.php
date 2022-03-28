<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusPersetujuan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel status_persetujuan
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'status'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			]
	]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel status_persetujuan
		$this->forge->createTable('status_persetujuan', TRUE);
    }

    public function down()
    {
        // menghapus tabel status_persetujuan
		$this->forge->dropTable('status_persetujuan');
    }
}
