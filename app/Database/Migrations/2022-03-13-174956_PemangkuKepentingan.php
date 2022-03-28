<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PemangkuKepentingan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel pemangku_kepentingan
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_unit'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
			],
			'hubungan'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
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
     

		// Membuat tabel pemangku_kepentingan
		$this->forge->createTable('pemangku_kepentingan', TRUE);
    }

    public function down()
    {
        // menghapus tabel pemangku_kepentingan
		$this->forge->dropTable('pemangku_kepentingan');
    }
}
