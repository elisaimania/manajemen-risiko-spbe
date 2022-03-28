<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SasaranSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel sasaran_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'sasaran_UPR_SPBE'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'sasaran_SPBE' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'indikator_kinerja_SPBE'      => [
				'type'           => 'VARCHAR',
                'constraint'     => 255
			],
            'target_kinerja'      => [
				'type'           => 'CHAR',
                'constraint'     => 10
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

		// Membuat tabel sasaran_SPBE
		$this->forge->createTable('sasaran_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel sasaran_SPBE
		$this->forge->dropTable('sasaran_SPBE');
    }
}
