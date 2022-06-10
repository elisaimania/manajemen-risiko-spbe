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

    //Menampilkan profil pengguna
    public function profilPengguna(){

        $data = [
            'title'     => 'Profil Pengguna',
            'script'    => 'pemilik-risiko',
            'template'  => 'templates_pemilik_risiko',
            'active'    => '',
            'link'      => 'profilPengguna'
        ];
        
        return view('profil-pengguna', $data);
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
            'script'    => 'penilaian-risiko',
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
            'script'    => 'penanganan-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko'
        ];

        return view('PemilikRisiko/penanganan-risiko', $data);
    }

//Menampilkan halaman pemanataun risiko yang berisi tabel risiko yang telah ditangani
    public function pemantauanRisiko(){

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  =>  '',
            'script'    => 'pemantauan-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko'
        ];

        return view('PemilikRisiko/pemantauan-risiko', $data);
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
            'script'    => 'informasi-umum',
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
            'script'    => 'sasaran-spbe',
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
            'script'    => 'struktur-pelaksana',
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
            'script'    => 'pemangku-kepentingan',
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
            'script'    => 'peraturan-perundangan',
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
            'script'    => 'penetapan-kategori',
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
            'script'    => 'penetapan-area-dampak',
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
            'script'    => 'penetapan-kriteria-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];


        return view('PemilikRisiko/penetapan-kriteria',$data);
    }

    //Get daftar kriteria kemungkinan
    public function getDaftarKriteriaKemungkinan(){

        return $this->respond($this->kriteriaKemungkinanModel->where(['kriteria_kemungkinan_risiko_spbe.id_upr'=>session()->id_upr, 'kriteria_kemungkinan_risiko_spbe.id_status_persetujuan' => 2])->getKriteriaKemungkinan());

    }

    //Get daftar kriteria Dampak
    public function getDaftarKriteriaDampak(){

        return $this->respond($this->kriteriaDampakModel->where(['kriteria_dampak_risiko_spbe.id_upr'=>session()->id_upr, 'kriteria_dampak_risiko_spbe.id_status_persetujuan' => 2])->getKriteriaDampak());

    }

    public function matriksLevelRisiko(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Matriks Analisis dan Level Risiko SPBE (2.9)',
            'script'    => 'matriks-level-risiko',
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
            'script'    => 'selera-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PemilikRisiko/selera-risiko',$data);
    }

    //Get selera risiko
    public function getSeleraRisiko(){

        return $this->respond($this->seleraRisikoModel->orderBy('id','ASC')->where(['selera_risiko_spbe.id_upr'=>session()->id_upr, 'selera_risiko_spbe.id_status_persetujuan' => 2])->getSelera());
    }

    //Get daftar penilaian risiko
    public function getPenilaianRisiko(){

        return $this->respond($this->penilaianRisikoModel->getPenilaianSetuju());

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

        return $this->respond($this->penangananRisikoModel->getPenangananSetuju());

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

    public function getPemantauanRisiko(){

        return $this->respond($this->pemantauanRisikoModel->getPemantauanByPersetujuan());

    }

    public function detailRisikoPemantauan($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'koordinator-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'risiko' => $risiko
        ];

        return view('PemilikRisiko/detail-risiko' , $data);

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
            'script'    => 'pemilik-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'pemantauan' => $pemantauan,
            'risiko' => $risiko,
            'upr' => $upr,
            'daftarPemantauan' => $daftarPemantauan
        ];
        
        return view('PemilikRisiko/detail-pemantauan' , $data);

    }

    public function detailRencanaPenanganan($id){

        $rencana_penanganan = $this->penangananRisikoModel->find($id);
        $opsi_penanganan = $this->opsiPenangananModel->where('id',$rencana_penanganan['id_opsi_penanganan'])->get()->getRowArray();
        $status_persetujuan = $this->statusPersetujuanModel->find($rencana_penanganan['id_status_persetujuan']);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Rencana Penanganan Risiko SPBE',
            'script'    => 'pemilik-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'rencana_penanganan' => $rencana_penanganan,
            'opsi_penanganan' => $opsi_penanganan,
            'status_persetujuan' => $status_persetujuan,
        ];

        return view('pemilikRisiko/detail-rencana-penanganan' , $data);

    }


    

}  