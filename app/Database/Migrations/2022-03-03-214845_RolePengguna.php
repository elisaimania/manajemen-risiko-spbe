<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolePengguna extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel role_pengguna
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 2
			],
			'nama_role'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			]
        ]);

        // Membuat primary key
		$this->forge->addKey('id', TRUE);

        // Membuat tabel role_pengguna
		$this->forge->createTable('role_pengguna', TRUE);
    }

    public function down()
    {
        // menghapus tabel role_pengguna
		$this->forge->dropTable('role_pengguna');
    }
}
