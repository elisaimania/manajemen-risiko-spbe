<?php

namespace App\Validation;
use App\Models\SeleraRisikoModel;
use App\Models\KategoriRisikoModel;
use App\Models\JenisRisikoModel;
use CodeIgniter\I18n\Time;

class myRules
{
        public $seleraRisikoModel = null;
        public $kategoriRisikoModel = null;
        public $jenisRisikoModel = null;

	public function datePeriodeValidation(string $str, string $fields, array $data)
	{
		$date_mulai = Time::createFromFormat('Y-m-d', $data['tanggal_mulai']);
                $date_selesai = Time::createFromFormat('Y-m-d', $data['tanggal_selesai']);
                if($date_mulai->isBefore($date_selesai)){
        	       return true;
                }else{
        	       return false;
                }
	}

        public function jadwalValidation(string $str, string $fields, array $data)
        {
                $date_mulai = Time::createFromFormat('Y-m-d', $data['jadwal_mulai']);
                $date_selesai = Time::createFromFormat('Y-m-d', $data['jadwal_selesai']);
                if($date_mulai->isBefore($date_selesai)){
                       return true;
                }else{
                       return false;
                }
        }

        public function jenisRisikoValidation(string $str, string $fields, array $data)
        {
                $this->seleraRisikoModel = new SeleraRisikoModel();
                $this->kategoriRisikoModel = new KategoriRisikoModel();
                $this->jenisRisikoModel = new JenisRisikoModel();

                $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko',$data['kategori_risiko'])->get()->getRowArray();

                $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$data['jenis_risiko'])->get()->getRowArray();

                $multiClause = array('id_kategori_risiko' => $kategoriRisiko['id'], 'id_jenis_risiko' => $jenisRisiko['id']);

                $cek_jenis_risiko = $this->seleraRisikoModel->where($multiClause)->countAllResults();
                
                if($cek_jenis_risiko < 1){
                       return true;
                }else{
                       return false;
                }
        }

        public function updateJenisRisikoValidation(string $str, string $fields, array $data)
        {
                $this->seleraRisikoModel = new SeleraRisikoModel();
                $this->kategoriRisikoModel = new KategoriRisikoModel();
                $this->jenisRisikoModel = new JenisRisikoModel();

                $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko',$data['kategori_risiko'])->get()->getRowArray();

                $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$data['jenis_risiko'])->get()->getRowArray();

                $multiClause = array('id_kategori_risiko' => $kategoriRisiko['id'], 'id_jenis_risiko' => $jenisRisiko['id']);

                $cek_jenis_risiko = $this->seleraRisikoModel->where($multiClause)->countAllResults()-1;
                
                if($cek_jenis_risiko < 1){
                       return true;
                }else{
                       return false;
                }
        }
}		