<?php
namespace App\Controllers;
use App\Models\InformasiUmumModel;
use App\Models\SasaranSPBEModel;
use App\Models\StatusPersetujuanModel;
use App\Models\StrukturPelaksanaModel;
use App\Models\PemangkuKepentinganModel;
use App\Models\PeraturanPerundanganModel;
use App\Models\KategoriRisikoTerpilihModel;
use App\Models\KategoriRisikoModel;
use App\Models\AreaDampakRisikoTerpilihModel;
use App\Models\AreaDampakRisikoModel;
use App\Models\KriteriaKemungkinanModel;
use App\Models\KriteriaDampakModel;
use App\Models\MatriksRisikoModel;
use App\Models\LevelRisikoModel;
use App\Models\SeleraRisikoModel;
use App\Models\PenilaianRisikoModel;
use App\Models\PenangananRisikoModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;
use PHPExcel;
use PHPExcel_IOFactory;

class PemilikRisiko extends BaseController
{
    use ResponseTrait;
    public $informasiUmumModel = null;
    public $statusPersetujuanModel = null;
    public $sasaranSPBEModel = null;
    public $strukturPelaksanaModel = null;
    public $pemangkuKepentinganModel = null;
    public $peraturanPerundanganModel = null;
    public $kategoriRisikoTerpilihModel = null;
    public $kategoriRisikoModel = null;
    public $areaDampakRisikoTerpilihModel = null;
    public $areaDampakRisikoModel = null;
    public $kriteriaKemungkinanModel = null;
    public $kriteriaDampakModel = null;
    public $matriksRisikoModel = null;
    public $LevelRisikoModel = null;
    public $seleraRisikoModel = null;
    public $penilaianRisikoModel = null;
    public $penangananRisikoModel = null;

    public function __construct(){

        session();
        $this->informasiUmumModel = new InformasiUmumModel();
        $this->statusPersetujuanModel = new StatusPersetujuanModel();
        $this->sasaranSPBEModel = new SasaranSPBEModel();
        $this->strukturPelaksanaModel = new StrukturPelaksanaModel();
        $this->pemangkuKepentinganModel = new PemangkuKepentinganModel();
        $this->peraturanPerundanganModel = new PeraturanPerundanganModel();
        $this->kategoriRisikoTerpilihModel = new KategoriRisikoTerpilihModel();
        $this->kategoriRisikoModel = new KategoriRisikoModel();
        $this->areaDampakRisikoTerpilihModel = new AreaDampakRisikoTerpilihModel();
        $this->areaDampakRisikoModel = new AreaDampakRisikoModel();
        $this->kriteriaKemungkinanModel = new KriteriaKemungkinanModel();
        $this->kriteriaDampakModel = new KriteriaDampakModel();
        $this->matriksRisikoModel = new MatriksRisikoModel();
        $this->levelRisikoModel = new LevelRisikoModel();
        $this->seleraRisikoModel = new SeleraRisikoModel();
        $this->penilaianRisikoModel = new PenilaianRisikoModel();
        $this->penangananRisikoModel = new PenangananRisikoModel();

    }

// Menampilkan dashboard.
    public function dashboard(){

    	$data = [
            'title'     => 'Dashboard',
            'script'    => 'dashboard',
            'active'    => 'Dashboard',
            'link'      => 'dashboard'
        ];

    	return view('PemilikRisiko/dashboard',$data);
        
    }

//Menampilkan halaman penentapan konteks
    public function penetapanKonteks(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  =>  '',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/penetapan-konteks',$data);
    }

//Menampilkan halaman penilaian risiko yang berisi tabel hasil penilaian risiko
    public function penilaianRisiko(){


        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  =>  '',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko'
        ];

        return view('PemilikRisiko/penilaian-risiko',$data);
    }

//Menampilkan halaman penanganan risiko yang berisi tabel risiko yang telah ditangani
    public function penangananRisiko(){

        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  =>  '',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko'
        ];

        return view('PemilikRisiko/penanganan-risiko', $data);
    }

    //Lihat detail risiko
    public function detailRisikoDashboard($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Dashboard',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'dashboard',
            'active'    => 'Dashboard',
            'link'      => 'dashboard',
            'risiko' => $risiko
        ];

        return view('PemilikRisiko/detail-risiko' , $data);

    }

    //Menampilkan daftar informasi umum
    public function informasiUmum(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/informasi-umum',$data);
    }

    // Get data informasi umum
    public function getInformasiUmum(){

        return $this->respond($this->informasiUmumModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getInfoUmum());

    }

    //Menampilkan halaman daftar sasaran SPBE
    public function sasaranSPBE(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/sasaran-SPBE',$data);
    }

    // Get daftar sasaran SPBE
    public function getDaftarSasaranSPBE(){

        return $this->respond($this->sasaranSPBEModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getSasaranSPBE());

    }

    // Menampilkan daftar struktur daftar pelaksana
    public function strukturPelaksana(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/struktur-pelaksana',$data);
    }

    // Get daftar struktur pelaksana
    public function getDaftarStrukturPelaksana(){

        return $this->respond($this->strukturPelaksanaModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getStrukturPelaksana());

    }

    //Menampilkan halaman daftar pemangku kepentingan
    public function pemangkuKepentingan(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/pemangku-kepentingan',$data);
    }

    //Get daftar pemangku kepentingan
    public function getDaftarPemangkuKepentingan(){

        return $this->respond($this->pemangkuKepentinganModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getPemangkuKepentingan());

    }

    //Menampilkan halaman daftar peraturan perundangan
    public function peraturanPerundangan(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/peraturan-perundangan',$data);
    }

    //Get daftar peraturan perundangan
    public function getDaftarPeraturanPerundangan(){

        return $this->respond($this->peraturanPerundanganModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getPeraturanPerundangan());

    }

    //Menampilkan halaman daftar kategori risiko terpilih
    public function kategoriRisikoTerpilih(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/penetapan-kategori',$data);
    }

    //Get daftar kategori risiko terpilih
    public function getDaftarKategoriRisikoTerpilih(){

        return $this->respond($this->kategoriRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getKategoriRisikoTerpilih());

    }

    public function areaDampakRisikoTerpilih(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/penetapan-area-dampak',$data);
    }

    //Get daftar area dampak risiko terpilih
    public function getDaftarAreaDampakRisikoTerpilih(){

        return $this->respond($this->areaDampakRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getAreaDampakRisikoTerpilih());

    }

    //Menampilkan halaman daftar kriteria risiko SPBE
    public function kriteriaRisiko(){


        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];


        return view('PemilikRisiko/penetapan-kriteria',$data);
    }

    //Get daftar kriteria kemungkinan
    public function getDaftarKriteriaKemungkinan(){

        return $this->respond($this->kriteriaKemungkinanModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getKriteriaKemungkinan());

    }

    //Get daftar kriteria Dampak
    public function getDaftarKriteriaDampak(){

        return $this->respond($this->kriteriaDampakModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getKriteriaDampak());

    }

    public function matriksLevelRisiko(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Matriks Analisis dan Level Risiko SPBE (2.9)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/matriks-level',$data);
    }

    public function getMatriksRisiko(){

        return $this->respond($this->matriksRisikoModel->getMatriks());
    }

    public function getLevelRisiko(){

        return $this->respond($this->levelRisikoModel->findAll());
    }

    // Menampilkan daftar halaman selera risiko
    public function seleraRisiko(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Selera Risiko SPBE (2.10)',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/selera-risiko',$data);
    }

    //Get selera risiko
    public function getSeleraRisiko(){

        return $this->respond($this->seleraRisikoModel->orderBy('id','ASC')->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->getSelera());
    }

    //Get daftar penilaian risiko
    public function getPenilaianRisiko(){

        return $this->respond($this->penilaianRisikoModel->getPenilaianByStatusPersetujuan());

    }

    //Lihat detail risiko
    public function detailRisiko($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'risiko' => $risiko
        ];

        return view('PemilikRisiko/detail-risiko' , $data);

    }

    //Get daftar rencanan penanganan risiko
    public function getPenangananRisiko(){

        return $this->respond($this->penangananRisikoModel->where(['id_upr'=>session()->id_upr, 'rencana_penanganan_risiko_spbe.id_status_persetujuan' => 2])->getPenanganan());

    }

    //Lihat detail risiko
    public function detailRisikoPenanganan($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'pemilik-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'risiko' => $risiko
        ];

        return view('PemilikRisiko/detail-risiko' , $data);

    }

    

}  