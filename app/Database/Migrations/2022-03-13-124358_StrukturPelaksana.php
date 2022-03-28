<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StrukturPelaksana extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel struktur_pelaksana
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
			'pelaksana'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			],
			'id_status_persetujuan'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
			'komentar'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

        // Membuat foreign key
		$this->forge->addForeignKey('id_status_persetujuan', 'status_persetujuan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_role', 'role_pengguna', 'id', 'CASCADE', 'CASCADE');

		// Membuat tabel struktur_pelaksana
		$this->forge->createTable('struktur_pelaksana', TRUE);
    }

    public function down()
    {
        // menghapus tabel struktur_pelaksana
		$this->forge->dropTable('struktur_pelaksana');
    }
}
