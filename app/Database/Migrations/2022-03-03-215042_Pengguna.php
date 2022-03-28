<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel pengguna
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'id_role'       => [
				'type'           => 'INT',
				'constraint'     => 2
			],
			'nama_pengguna'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			],
			'username' => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			],
			'password'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'null'           => true
			],
            'email'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

        // Membuat foreign key
		$this->forge->addForeignKey('id_role', 'role_pengguna', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel pengguna
		$this->forge->createTable('pengguna', TRUE);
    }

    public function down()
    {
        // menghapus tabel pengguna
		$this->forge->dropTable('pengguna');
    }

}
