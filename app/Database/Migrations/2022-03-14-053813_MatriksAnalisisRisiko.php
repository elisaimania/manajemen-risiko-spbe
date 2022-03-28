<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MatriksAnalisisRisiko extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel matriks_analisi_risiko
		$this->forge->addField([
			'id_level_kemungkinan'      => [
				'type'           => 'INT',
				'constraint'     => 1
            ],
            'id_level_dampak'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'besaran_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 3
			]
		]);

		// Membuat primary key
		$this->forge->addKey(['id_level_kemungkinan','id_level_dampak']);

        // Membuat foreign key
		$this->forge->addForeignKey('id_level_kemungkinan', 'level_kemungkinan_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_level_dampak', 'level_dampak_risiko_spbe', 'id', 'CASCADE', 'CASCADE');


		// Membuat tabel matriks_analisi_risiko
		$this->forge->createTable('matriks_analisi_risiko', TRUE);
    }

    public function down()
    {
        // menghapus tabel matriks_analisi_risiko
		$this->forge->dropTable('matriks_analisi_risiko');
    }
}
