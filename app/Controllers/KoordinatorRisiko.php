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
use App\Models\PemantauanRisikoModel;
use App\Models\OpsiPenangananModel;
use App\Models\UPRSPBEModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;
use PHPExcel;
use PHPExcel_IOFactory;

class KoordinatorRisiko extends BaseController
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
    public $pemantauanRisikoModel = null;
    public $opsiPenangananModel = null;
    public $uprSPBEModel = null;

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
        $this->pemantauanRisikoModel = new PemantauanRisikoModel();
        $this->opsiPenangananModel = new OpsiPenangananModel();
        $this->uprSPBEModel = new UPRSPBEModel();


        $this->informasiUmum = $this->informasiUmumModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->sasaranSPBE = $this->sasaranSPBEModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->strukturPelaksana = $this->strukturPelaksanaModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->pemangkuKepentingan = $this->pemangkuKepentinganModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->peraturanPerundangan = $this->peraturanPerundanganModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->kategoriRisikoTerpilih = $this->kategoriRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->areaDampakTerpilih = $this->areaDampakRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->kriteriaKemungkinan = $this->kriteriaKemungkinanModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->kriteriaDampak = $this->kriteriaDampakModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->seleraRisiko = $this->seleraRisikoModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 1])->get()->getResultArray();
        $this->penilaianRisiko = $this->penilaianRisikoModel->getpenilaianBelumSetuju();
        $this->penangananRisiko = $this->penangananRisikoModel->getPenangananBelumSetuju();

    }

// Menampilkan dashboard.
    public function dashboard(){
    	$data = [
            'title'     => 'Dashboard',
            'script'    => 'dashboard',
            'active'    => 'Dashboard',
            'link'      => 'dashboard',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

    	return view('KoordinatorRisiko/dashboard',$data);
        
    }

    //Menampilkan profil pengguna
    public function profilPengguna(){

        $data = [
            'title'     => 'Profil Pengguna',
            'script'    => 'koordinator-risiko',
            'template'  => 'templates_koordinator_risiko',
            'active'    => '',
            'link'      => 'profilPengguna',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];
        
        return view('profil-pengguna', $data);
    }

//Menampilkan halaman penentapan konteks
    public function penetapanKonteks(){
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  =>  '',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/penetapan-konteks',$data);
    }

//Menampilkan halaman penilaian risiko yang berisi tabel hasil penilaian risiko
    public function penilaianRisiko(){

        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  =>  '',
            'script'    => 'penilaian-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/penilaian-risiko',$data);
    }

//Menampilkan halaman penanganan risiko yang berisi tabel risiko yang telah ditangani
    public function penangananRisiko(){
        
        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  =>  '',
            'script'    => 'penanganan-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/penanganan-risiko', $data);
    }

//Menampilkan halaman pemanataun risiko yang berisi tabel risiko yang telah ditangani
    public function pemantauanRisiko(){

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  =>  '',
            'script'    => 'pemantauan-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/pemantauan-risiko', $data);
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
            'risiko' => $risiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/detail-risiko' , $data);

    }

    //Menampilkan daftar informasi umum
    public function informasiUmum(){
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'script'    => 'informasi-umum',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/informasi-umum',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanInformasiUmum($id){

        $informasiUmum = $this->informasiUmumModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'informasiUmum',
            'status'    => $status,
            'data' => $informasiUmum,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->informasiUmumModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/informasiUmum'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    // Get data informasi umum
    public function getInformasiUmum(){

        return $this->respond($this->informasiUmumModel->where('id_upr', session()->id_upr)->getInfoUmum());

    }

    //Menampilkan halaman daftar sasaran SPBE
    public function sasaranSPBE(){
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'script'    => 'sasaran-spbe',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/sasaran-SPBE',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanSasaranSpbe($id){

        $sasaranSpbe = $this->sasaranSPBEModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'sasaranSPBE',
            'status'    => $status,
            'data' => $sasaranSpbe,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->sasaranSPBEModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/sasaranSPBE'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    // Get daftar sasaran SPBE
    public function getDaftarSasaranSPBE(){

        return $this->respond($this->sasaranSPBEModel->where('id_upr',session()->id_upr)->getSasaranSPBE());

    }

    // Menampilkan daftar struktur daftar pelaksana
    public function strukturPelaksana(){
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'script'    => 'struktur-pelaksana',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/struktur-pelaksana',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanStrukturPelaksana($id){

        $strukturPelaksana = $this->strukturPelaksanaModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'strukturPelaksana',
            'status'    => $status,
            'data' => $strukturPelaksana,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->strukturPelaksanaModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/strukturPelaksana'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    // Get daftar struktur pelaksana
    public function getDaftarStrukturPelaksana(){

        return $this->respond($this->strukturPelaksanaModel->where('id_upr', session()->id_upr)->getStrukturPelaksana());

    }

    //Menampilkan halaman daftar pemangku kepentingan
    public function pemangkuKepentingan(){
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'script'    => 'pemangku-kepentingan',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/pemangku-kepentingan',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanPemangkuKepentingan($id){

        $pemangkuKepentingan = $this->pemangkuKepentinganModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'pemangkuKepentingan',
            'status'    => $status,
            'data' => $pemangkuKepentingan,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->pemangkuKepentinganModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/pemangkuKepentingan'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar pemangku kepentingan
    public function getDaftarPemangkuKepentingan(){

        return $this->respond($this->pemangkuKepentinganModel->where('id_upr', session()->id_upr)->getPemangkuKepentingan());

    }

    //Menampilkan halaman daftar peraturan perundangan
    public function peraturanPerundangan(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'script'    => 'peraturan-perundangan',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/peraturan-perundangan',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanPeraturanPerundangan($id){

        $peraturanPerundangan = $this->peraturanPerundanganModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'peraturanPerundangan',
            'status'    => $status,
            'data' => $peraturanPerundangan,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->peraturanPerundanganModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/peraturanPerundangan'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar peraturan perundangan
    public function getDaftarPeraturanPerundangan(){

        return $this->respond($this->peraturanPerundanganModel->where('id_upr', session()->id_upr)->getPeraturanPerundangan());

    }

    //Menampilkan halaman daftar kategori risiko terpilih
    public function kategoriRisikoTerpilih(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'script'    => 'penetapan-kategori',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/penetapan-kategori',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanKategoriRisikoTerpilih($id){

        $kategoriRisikoTerpilih = $this->kategoriRisikoTerpilihModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kategoriRisikoTerpilih',
            'status'    => $status,
            'data' => $kategoriRisikoTerpilih,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->kategoriRisikoTerpilihModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/kategoriRisikoTerpilih'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar kategori risiko terpilih
    public function getDaftarKategoriRisikoTerpilih(){

        return $this->respond($this->kategoriRisikoTerpilihModel->where('id_upr',session()->id_upr)->getKategoriRisikoTerpilih());

    }

    public function areaDampakRisikoTerpilih(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'script'    => 'penetapan-area-dampak',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/penetapan-area-dampak',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanareaDampakTerpilih($id){

        $areaDampakRisikoTerpilih = $this->areaDampakRisikoTerpilihModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'areaDampakRisikoTerpilih',
            'status'    => $status,
            'data' => $areaDampakRisikoTerpilih,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){ 
            $this->areaDampakRisikoTerpilihModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/areaDampakRisikoTerpilih'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar area dampak risiko terpilih
    public function getDaftarAreaDampakRisikoTerpilih(){

        return $this->respond($this->areaDampakRisikoTerpilihModel->where('id_upr', session()->id_upr)->getAreaDampakRisikoTerpilih());

    }

    //Menampilkan halaman daftar kriteria risiko SPBE
    public function kriteriaRisiko(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'script'    => 'penetapan-kriteria-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];


        return view('KoordinatorRisiko/penetapan-kriteria',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanKriteriaKemungkinan($id,$tag){

        $kriteriaKemungkinan = $this->kriteriaKemungkinanModel->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])->get()->getRowArray();
        $status = $this->statusPersetujuanModel->findAll();

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'status'    => $status,
            'data' => $kriteriaKemungkinan,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->kriteriaKemungkinanModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/kriteriaRisiko'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Beri persetujuan
    public function beriPersetujuanKriteriaDampak($id,$tag){

        $kriteriaDampak = $this->kriteriaDampakModel->where(['id_area_dampak'=>$id, 'id_upr'=>session()->id_upr,'tag'=>$tag])->get()->getRowArray();
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'status'    => $status,
            'data' => $kriteriaDampak,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->kriteriaDampakModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where(['id_area_dampak'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/kriteriaRisiko'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar kriteria kemungkinan
    public function getDaftarKriteriaKemungkinan(){

        return $this->respond($this->kriteriaKemungkinanModel->where('kriteria_kemungkinan_risiko_spbe.id_upr', session()->id_upr)->getKriteriaKemungkinan());

    }

    //Get daftar kriteria Dampak
    public function getDaftarKriteriaDampak(){

        return $this->respond($this->kriteriaDampakModel->where('kriteria_dampak_risiko_spbe.id_upr', session()->id_upr)->getKriteriaDampak());

    }

    public function matriksLevelRisiko(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Matriks Analisis dan Level Risiko SPBE (2.9)',
            'script'    => 'matriks-level-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/matriks-level',$data);
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
            'script'    => 'selera-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/selera-risiko',$data);
    }

    //Beri persetujuan
    public function beriPersetujuanSeleraRisiko($id,$tag){

        $seleraRisiko = $this->seleraRisikoModel->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])->get()->getRowArray();
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Selera Risiko SPBE (2.10)',
            'subsubtitle' => 'Beri Persetujuan',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'seleraRisiko',
            'status'    => $status,
            'data' => $seleraRisiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->seleraRisikoModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/seleraRisiko'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get selera risiko
    public function getSeleraRisiko(){

        return $this->respond($this->seleraRisikoModel->orderBy('id','ASC')->where('selera_risiko_spbe.id_upr',session()->id_upr)->getSelera());
    }

    //Beri persetujuan
    public function beriPersetujuanPenilaianRisiko($id){

        $penilaianRisiko = $this->penilaianRisikoModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Beri Persetujuan',
            'subsubtitle' => '',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'sublink'   => '',
            'status'    => $status,
            'data' => $penilaianRisiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->penilaianRisikoModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id',$id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/penilaianRisiko'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar penilaian risiko
    public function getPenilaianRisiko(){

        return $this->respond($this->penilaianRisikoModel->getPenilaian());

    }

    //Lihat detail risiko
    public function detailRisiko($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'risiko' => $risiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/detail-risiko' , $data);

    }

    //Beri persetujuan
    public function beriPersetujuanPenangananRisiko($id){

        $penangananRisiko = $this->penangananRisikoModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Beri Persetujuan',
            'subsubtitle' => '',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'sublink'   => '',
            'status'    => $status,
            'data' => $penangananRisiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->penangananRisikoModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id',$id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/penangananRisiko'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }

    //Get daftar rencanan penanganan risiko
    public function getPenangananRisiko(){

        return $this->respond($this->penangananRisikoModel->getPenanganan());

    }

    //Lihat detail risiko
    public function detailRisikoPenanganan($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'risiko' => $risiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        return view('KoordinatorRisiko/detail-risiko' , $data);

    }

    public function detailRencanaPenanganan($id){

        $rencana_penanganan = $this->penangananRisikoModel->find($id);
        $opsi_penanganan = $this->opsiPenangananModel->where('id',$rencana_penanganan['id_opsi_penanganan'])->get()->getRowArray();
        $status_persetujuan = $this->statusPersetujuanModel->find($rencana_penanganan['id_status_persetujuan']);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Rencana Penanganan Risiko SPBE',
            'script'    => 'koordinator-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'rencana_penanganan' => $rencana_penanganan,
            'opsi_penanganan' => $opsi_penanganan,
            'status_persetujuan' => $status_persetujuan,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('KoordinatorRisiko/detail-rencana-penanganan' , $data);

    }

    //Beri persetujuan
    public function beriPersetujuanPemantauanRisiko($id){

        $pemantauanRisiko = $this->pemantauanRisikoModel->find($id);
        $status = $this->statusPersetujuanModel->findAll();
        
        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Beri Persetujuan',
            'subsubtitle' => '',
            'script'    => 'koordinator-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'sublink'   => '',
            'status'    => $status,
            'data' => $pemantauanRisiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penangananRisiko' => $this->penangananRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih
        ];

        if(isset($_POST['submit'])){
            $this->pemantauanRisikoModel
            ->set('id_status_persetujuan' , $this->request->getPost('id_status_persetujuan'))
            ->set('komentar' , $this->request->getPost('komentar'))
            ->where('id',$id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Persetujuan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('KoordinatorRisiko/pemantauanRisiko'));
        }
        return view('KoordinatorRisiko/beri-persetujuan' , $data);

    }


    public function detailRisikoPemantauan($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'koordinator-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'risiko' => $risiko,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('KoordinatorRisiko/detail-risiko' , $data);

    }


    public function getPemantauanRisiko(){

        return $this->respond($this->pemantauanRisikoModel->getPemantauan());

    }

    public function detailLaporanPemantauan($id){

        $pemantauan = $this->pemantauanRisikoModel->getPemantauanById($id);
        $risiko = $this->penilaianRisikoModel->getPenilaianById($pemantauan[0]['id_risiko']);

        if ($pemantauan[0]['jenis_laporan']=='bulanan') {
            $daftarPemantauan = $this->pemantauanRisikoModel->where(['id_risiko'=>$pemantauan[0]['id_risiko'], 'jenis_laporan'=>'bulanan', 'id <' => $id, 'id_status_persetujuan' => 2 ])->get()->getResultArray();
        } elseif ($pemantauan[0]['jenis_laporan']=='triwulan') {
            $daftarPemantauan = $this->pemantauanRisikoModel->where(['id_risiko'=>$pemantauan[0]['id_risiko'], 'jenis_laporan'=>'triwulan', 'id <' => $id, 'id_status_persetujuan' => 2 ])->get()->getResultArray();
        } elseif ($pemantauan[0]['jenis_laporan']=='semesteran') {
            $daftarPemantauan = $this->pemantauanRisikoModel->where(['id_risiko'=>$pemantauan[0]['id_risiko'], 'jenis_laporan'=>'semesteran', 'id <' => $id, 'id_status_persetujuan' => 2 ])->get()->getResultArray();
        } else {
            $daftarPemantauan = $this->pemantauanRisikoModel->groupStart()
            ->where('id_risiko',$pemantauan[0]['id_risiko'])->where('jenis_laporan','triwulan')->where('id <=', $id)->where('id_status_persetujuan' , 2 )
            ->groupEnd()
            ->orGroupStart()->where('id_risiko',$pemantauan[0]['id_risiko'])->where('jenis_laporan','bulanan')->where('id <=', $id)->where('id_status_persetujuan' , 2 )
            ->groupEnd()
            ->orGroupStart()->where('id_risiko',$pemantauan[0]['id_risiko'])->where('jenis_laporan','semesteran')->where('id <=', $id)->where('id_status_persetujuan' , 2 )
            ->groupEnd()->get()->getResultArray();
        }
        
        $upr = $this->uprSPBEModel->find(session()->id_upr);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'koordinator-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'pemantauan' => $pemantauan,
            'risiko' => $risiko,
            'upr' => $upr,
            'daftarPemantauan' => $daftarPemantauan,
            'informasiUmum' => $this->informasiUmum,
            'sasaranSPBE' => $this->sasaranSPBE,
            'strukturPelaksana' => $this->strukturPelaksana,
            'pemangkuKepentingan' => $this->pemangkuKepentingan,
            'peraturanPerundangan' => $this->peraturanPerundangan,
            'areaDampakTerpilih' => $this->areaDampakTerpilih,
            'kriteriaKemungkinan' => $this->kriteriaKemungkinan,
            'kriteriaDampak' => $this->kriteriaDampak,
            'seleraRisiko' => $this->seleraRisiko,
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];
        
        return view('KoordinatorRisiko/detail-pemantauan' , $data);

    }


}  