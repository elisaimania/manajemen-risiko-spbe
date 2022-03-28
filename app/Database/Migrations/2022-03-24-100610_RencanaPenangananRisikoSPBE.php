<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RencanaPenangananRisikoSPBE extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel rencana_penanganan_risiko_SPBE
		$this->forge->addField([
			'id'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true,
				'auto_increment' => true
            ],
            'id_risiko'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'id_opsi_penanganan'      => [
				'type'           => 'INT',
				'constraint'     => 4,
                'unsigned'       => true
            ],
            'rencana_aksi'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'keluaran'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
            ],
            'jadwal_mulai'      => [
				'type'           => 'DATE'
            ],
            'jadwal_selesai'      => [
				'type'           => 'DATE'
            ],
            'penanggungjawab'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100
            ],
            'risiko_residual'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
            ],
            'id_status_persetujuan'      => [
				'type'           => 'INT',
				'constraint'     => 1
			],
            'komentar'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
                'null'           => true
            ],
		]);

		// Membuat primary key
		$this->forge->addKey('id',TRUE);

        // Membuat foreign key
        $this->forge->addForeignKey('id_status_persetujuan', 'status_persetujuan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_risiko', 'penilaian_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_opsi_penanganan', 'opsi_penanganan_risiko_spbe', 'id', 'CASCADE', 'CASCADE');
        
		// Membuat tabel rencana_penanganan_risiko_SPBE
		$this->forge->createTable('rencana_penanganan_risiko_SPBE', TRUE);
    }

    public function down()
    {
        // menghapus tabel rencana_penanganan_risiko_SPBE
		$this->forge->dropTable('rencana_penanganan_risiko_SPBE');
    }
}

