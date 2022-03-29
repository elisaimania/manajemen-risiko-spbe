<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SeleraRisikoSpbe extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel selera_risiko_SPBE
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'id_kategori_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
            ],
			'id_jenis_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'besaran_risiko_min'      => [
				'type'           => 'INT',
				'constraint'     => 3
			],
            'id_upr'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('id_kategori_risiko', 'kategori_risiko_spbe_terpilih', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_upr', 'upr_spbe', 'id', 'CASCADE', 'CASCADE');


		// Membuat tabel selera_risiko_SPBE
		$this->forge->createTable('selera_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel selera_risiko_SPBE
		$this->forge->dropTable('selera_risiko_SPBE');
    }
}
