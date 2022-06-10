<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InformasiUmum extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel informasi_umum
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'tugas_UPR'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'fungsi_UPR' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'tanggal_mulai'      => [
				'type'           => 'DATE'
			],
            'tanggal_selesai'      => [
				'type'           => 'DATE'
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

		// Membuat tabel informasi_umum
		$this->forge->createTable('informasi_umum', TRUE);
    }

    public function down()
    {
        // menghapus tabel informasi_umum
		$this->forge->dropTable('informasi_umum');
    }

}
