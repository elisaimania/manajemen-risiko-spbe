<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeraturanPerundangan extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel peraturan_perundangan
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_peraturan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'amanat'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
            'id_upr'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true
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
        $this->forge->addForeignKey('id_upr', 'upr_spbe', 'id', 'CASCADE', 'CASCADE');
     

		// Membuat tabel peraturan_perundangan
		$this->forge->createTable('peraturan_perundangan', TRUE);
    }

    public function down()
    {
        // menghapus tabel peraturan_perundangan
		$this->forge->dropTable('peraturan_perundangan');
    }
}
