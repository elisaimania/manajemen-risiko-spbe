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

        
}		