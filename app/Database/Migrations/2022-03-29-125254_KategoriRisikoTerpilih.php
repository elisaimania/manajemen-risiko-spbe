<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriRisikoTerpilih extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel kategori_risiko_SPBE_terpilih
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true,
				'auto_increment' => true
			],
            'id_kategori_risiko'          => [
				'type'           => 'INT',
				'constraint'     => 4,
				'unsigned'       => true
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
		$this->forge->addForeignKey('id_kategori_risiko', 'kategori_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_upr', 'upr_spbe', 'id', 'CASCADE', 'CASCADE');
     

		// Membuat tabel kategori_risiko_SPBE_terpilih
		$this->forge->createTable('kategori_risiko_SPBE_terpilih', TRUE);
    }

    public function down()
    {
        // menghapus tabel kategori_risiko_SPBE_terpilih
		$this->forge->dropTable('kategori_risiko_SPBE_terpilih');
    }
}
