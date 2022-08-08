<?php
namespace App\Controllers;
use App\Models\PenggunaModel;
use App\Models\RoleModel;
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
use App\Models\LevelKemungkinanModel;
use App\Models\LevelDampakModel;
use App\Models\JenisRisikoModel;
use App\Models\MatriksRisikoModel;
use App\Models\LevelRisikoModel;
use App\Models\SeleraRisikoModel;
use App\Models\PenilaianRisikoModel;
use App\Models\PenangananRisikoModel;
use App\Models\OpsiPenangananModel;
use App\Models\UPRSPBEModel;
use App\Models\PemantauanRisikoModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;
use PHPExcel;
use PHPExcel_IOFactory;

class PengelolaRisiko extends BaseController
{
    use ResponseTrait;
    public $informasiUmumModel = null;
    public $statusPersetujuanModel = null;
    public $sasaranSPBEModel = null;
    public $strukturPelaksanaModel = null;
    public $roleModel = null;
    public $pemangkuKepentinganModel = null;
    public $peraturanPerundanganModel = null;
    public $kategoriRisikoTerpilihModel = null;
    public $kategoriRisikoModel = null;
    public $areaDampakRisikoTerpilihModel = null;
    public $areaDampakRisikoModel = null;
    public $kriteriaKemungkinanModel = null;
    public $kriteriaDampakModel = null;
    public $levelKemungkinanModel = null;
    public $levelDampakModel = null;
    public $jenisRisikoModel = null;
    public $matriksRisikoModel = null;
    public $LevelRisikoModel = null;
    public $seleraRisikoModel = null;
    public $penilaianRisikoModel = null;
    public $penangananRisikoModel = null;
    public $opsiPenangananModel = null;
    public $uprSPBEModel = null;
    public $pemantauanRisikoModel = null;

    public function __construct(){

        session();
        $this->informasiUmumModel = new InformasiUmumModel();
        $this->statusPersetujuanModel = new StatusPersetujuanModel();
        $this->sasaranSPBEModel = new SasaranSPBEModel();
        $this->strukturPelaksanaModel = new StrukturPelaksanaModel();
        $this->roleModel = new RoleModel();
        $this->pemangkuKepentinganModel = new PemangkuKepentinganModel();
        $this->peraturanPerundanganModel = new PeraturanPerundanganModel();
        $this->kategoriRisikoTerpilihModel = new KategoriRisikoTerpilihModel();
        $this->kategoriRisikoModel = new KategoriRisikoModel();
        $this->areaDampakRisikoTerpilihModel = new AreaDampakRisikoTerpilihModel();
        $this->areaDampakRisikoModel = new AreaDampakRisikoModel();
        $this->kriteriaKemungkinanModel = new KriteriaKemungkinanModel();
        $this->kriteriaDampakModel = new KriteriaDampakModel();
        $this->levelKemungkinanModel = new LevelKemungkinanModel();
        $this->levelDampakModel = new LevelDampakModel();
        $this->jenisRisikoModel = new JenisRisikoModel();
        $this->matriksRisikoModel = new MatriksRisikoModel();
        $this->levelRisikoModel = new LevelRisikoModel();
        $this->seleraRisikoModel = new SeleraRisikoModel();
        $this->penilaianRisikoModel = new PenilaianRisikoModel();
        $this->penangananRisikoModel = new PenangananRisikoModel();
        $this->opsiPenangananModel = new OpsiPenangananModel();
        $this->uprSPBEModel = new UPRSPBEModel();
        $this->pemantauanRisikoModel = new PemantauanRisikoModel();

        $this->informasiUmum = $this->informasiUmumModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->sasaranSPBE = $this->sasaranSPBEModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->strukturPelaksana = $this->strukturPelaksanaModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->pemangkuKepentingan = $this->pemangkuKepentinganModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->peraturanPerundangan = $this->peraturanPerundanganModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->kategoriRisikoTerpilih = $this->kategoriRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->areaDampakTerpilih = $this->areaDampakRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->kriteriaKemungkinan = $this->kriteriaKemungkinanModel->where(['kriteria_kemungkinan_risiko_spbe.id_upr'=>session()->id_upr, 'kriteria_kemungkinan_risiko_spbe.id_status_persetujuan' => 2])->getKriteriaKemungkinan();
        $this->kriteriaDampak = $this->kriteriaDampakModel->where(['kriteria_dampak_risiko_spbe.id_upr'=>session()->id_upr, 'kriteria_dampak_risiko_spbe.id_status_persetujuan' => 2])->getKriteriaDampak();
        $this->seleraRisiko = $this->seleraRisikoModel->where(['selera_risiko_spbe.id_upr'=>session()->id_upr, 'selera_risiko_spbe.id_status_persetujuan' => 2])->getSelera();
        $this->penilaianRisiko = $this->penilaianRisikoModel->getPenilaianSetuju();
        $this->kategoriRisikoTerpilih = $this->kategoriRisikoTerpilihModel->where(['id_upr'=>session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        $this->penangananRisiko = $this->penangananRisikoModel->getPenangananSetuju();

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

    	return view('PengelolaRisiko/dashboard',$data);
        
    }

    //Menampilkan profil pengguna
    public function profilPengguna(){

        $data = [
            'title'     => 'Profil Pengguna',
            'script'    => 'pengelola-risiko',
            'template'  => 'templates_pengelola_risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];
        
        return view('profil-pengguna', $data);
    }

//Menampilkan halaman penentapan konteks
    public function penetapanKonteks(){
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  =>  '',
            'script'    => 'pengelola-risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];
        
        return view('PengelolaRisiko/penetapan-konteks',$data);
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/penilaian-risiko',$data);
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/penanganan-risiko', $data);
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/pemantauan-risiko', $data);
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-risiko' , $data);

    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/informasi-umum',$data);
    }

    public function getInformasiUmum(){

        return $this->respond($this->informasiUmumModel->where('id_upr', session()->id_upr)->getInfoUmum());

    }

    public function inputInformasiUmum()
    {
        $namaUpr = $this->uprSPBEModel->where('id', session()->id_upr)->get()->getRowArray();
        if(isset($_POST['tambah'])){
            $rules =[
                'tanggal_mulai' => 'datePeriodeValidation[tanggal_mulai,tanggal_selesai]'
            ];

            $errors = [
                'tanggal_mulai'=> [
                    'datePeriodeValidation' => 'Tanggal mulai harus lebih dulu dari tanggal selesai']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }
            
            $inputData = [
                'tugas_UPR' => $this->request->getPost('tugas_UPR'),
                'fungsi_UPR' => $this->request->getPost('fungsi_UPR'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->informasiUmumModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Informasi umum berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'subsubtitle' => 'Tambah Informasi Umum (2.1)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'namaUpr' => $namaUpr,
            'sublink' => 'informasiUmum',
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

        return view('PengelolaRisiko/form-informasi-umum' , $data);
    }

//Menambah data informasi umum dengan melakukan import file excel
    public function importInformasiUmum(){

        
        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];
                    $kolom5 = $data['E'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
                    if (empty($kolom3)) {
                        continue;
                    }
                    if (empty($kolom4)) {
                        continue;
                    }
                    if (empty($kolom5)) {
                        continue;
                    }


                    $format= explode('-',$kolom4);
                    $format1= explode('-',$kolom5);

                    if (sizeof($format)==1 or sizeof($format1)==1) {
                        $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Format tanggal salah, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                        </div>';

                        $flash = session()->setFlashdata('flash', $flash);
                        return redirect()->to(base_url('pengelolaRisiko/informasiUmum'));
                    }
                    
                    $date_mulai = Time::createFromFormat('Y-m-d', $kolom4);
                    $date_selesai = Time::createFromFormat('Y-m-d', $kolom5);
                    if(!($date_mulai->isBefore($date_selesai))){
        	            continue;
                    }

                    // insert data
                    $this->informasiUmumModel->insert([
                        'tugas_UPR' => $kolom2,
                        'fungsi_UPR' => $kolom3,
                        'tanggal_mulai' => $kolom4,
                        'tanggal_selesai' =>$kolom5,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/informasiUmum'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/informasiUmum'));

        }

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'subsubtitle' => 'Import Data Informasi Umum (2.1)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'informasiUmum',
            'template' => 'informasi_umum.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }


    public function updateInformasiUmum($id=null){

        $infoUmum = $this->informasiUmumModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'subsubtitle' => 'Edit Informasi Umum (2.1)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'infoUmum' => $infoUmum,
            'sublink' => 'informasiUmum',
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

        if(isset($_POST['submit'])){
            $rules =[
                'tanggal_mulai' => 'datePeriodeValidation[tanggal_mulai,tanggal_selesai]'
            ];

            $errors = [
                'tanggal_mulai'=> [
                    'datePeriodeValidation' => 'Tanggal mulai harus lebih dulu dari tanggal selesai']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $this->informasiUmumModel
            ->set('tugas_UPR' , $this->request->getPost('tugas_UPR'))
            ->set('fungsi_UPR' , $this->request->getPost('fungsi_UPR'))
            ->set('tanggal_mulai' , $this->request->getPost('tanggal_mulai'))
            ->set('tanggal_selesai' , $this->request->getPost('tanggal_selesai'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Informasi umum berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/informasiUmum'));
        }
        return view('PengelolaRisiko/form-edit-informasi-umum' , $data);
    }

    public function hapusInformasiUmum($id = null)
    {
        if ($id==null) {
            $delete = $this->informasiUmumModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->informasiUmumModel->where('id', $id)->delete();
        }

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Informasi umum berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/informasiUmum'));
        
    }

    //Lihat detail persetujuan
    public function detailPersetujuanInformasiUmum($id){

        $infoUmum = $this->informasiUmumModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$infoUmum['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'informasiUmum',
            'status' => $status,
            'data' => $infoUmum,
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
        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/sasaran-SPBE',$data);
    }

    public function getDaftarSasaranSPBE(){

        return $this->respond($this->sasaranSPBEModel->orderBy('id','desc')->where('id_upr',session()->id_upr)->getSasaranSPBE());

    }

    public function inputSasaranSPBE()
    {
        if(isset($_POST['tambah'])){
            
            $inputData = [
                'sasaran_UPR_SPBE' => $this->request->getPost('sasaran_UPR_SPBE'),
                'sasaran_SPBE' => $this->request->getPost('sasaran_SPBE'),
                'indikator_kinerja_SPBE' => $this->request->getPost('indikator_kinerja_SPBE'),
                'target_kinerja' => $this->request->getPost('target_kinerja'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->sasaranSPBEModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data sasaran SPBE berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'subsubtitle' => 'Tambah Sasaran SPBE (2.2)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'sasaranSPBE',
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

        return view('PengelolaRisiko/form-sasaran-SPBE' , $data);
    }

//Menambah data sasaran SPBE dengan melakukan import file excel
    public function importSasaranSPBE(){

        
        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
                    if (empty($kolom3)) {
                        continue;
                    }
                    if (empty($kolom4)) {
                        continue;
                    }

                    // insert data
                    $this->sasaranSPBEModel->insert([
                        'sasaran_SPBE' => $kolom1,
                        'sasaran_UPR_SPBE' => $kolom2,
                        'indikator_kinerja_SPBE' => $kolom3,
                        'target_kinerja' => $kolom4,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/sasaranSPBE'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/sasaranSPBE'));

        }

        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'subsubtitle' => 'Import Data Sasaran SPBE (2.2)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'sasaranSPBE',
            'template' => 'sasaran_spbe.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }


    public function updateSasaranSPBE($id=null){

        $sasaranSPBEId = $this->sasaranSPBEModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'subsubtitle' => 'Edit Sasaran SPBE (2.2)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sasaranSPBEId' => $sasaranSPBEId,
            'sublink' => 'sasaranSPBE',
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

        if(isset($_POST['submit'])){
            
            $this->sasaranSPBEModel
            ->set('sasaran_UPR_SPBE' , $this->request->getPost('sasaran_UPR_SPBE'))
            ->set('sasaran_SPBE' , $this->request->getPost('sasaran_SPBE'))
            ->set('indikator_kinerja_SPBE' , $this->request->getPost('indikator_kinerja_SPBE'))
            ->set('target_kinerja' , $this->request->getPost('target_kinerja'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Sasaran SPBE berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/sasaranSPBE'));
        }
        return view('PengelolaRisiko/form-edit-sasaran-SPBE' , $data);
    }

    public function hapusSasaranSPBE($id = null)
    {
        if ($id==null) {
            $delete = $this->sasaranSPBEModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->sasaranSPBEModel->where('id', $id)->delete();
        }
        
        
        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/sasaranSPBE'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanSasaranSPBE($id){

        $sasaranSpbeId = $this->sasaranSPBEModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$sasaranSpbeId['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'status' => $status,
            'sublink'   => 'sasaranSPBE',
            'data' => $sasaranSpbeId,
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

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/struktur-pelaksana',$data);
    }

    public function getDaftarStrukturPelaksana(){

        return $this->respond($this->strukturPelaksanaModel->where('id_upr', session()->id_upr)->getStrukturPelaksana());

    }

    public function inputStrukturPelaksana()
    {
        if(isset($_POST['tambah'])){
            
            $id_role = $this->roleModel-> where('nama_role', $this->request->getPost('nama_role'))->get()->getRowArray();
            $inputData = [
                'id_role' => $id_role['id'],
                'pelaksana' => $this->request->getPost('pelaksana'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->strukturPelaksanaModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data struktur pelaksana manajemen risiko SPBE berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $role = $this->roleModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'subsubtitle' => 'Tambah Struktur Pelaksana (2.3)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'strukturPelaksana',
            'role' => $role,
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

        return view('PengelolaRisiko/form-struktur-pelaksana' , $data);
    }

//Menambah data sasaran SPBE dengan melakukan import file excel
    public function importStrukturPelaksana(){

        
        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1 || $idx==2){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
                    

                    $role = explode(' ',$kolom1);
                    if (sizeof($role)==3){
                        ucfirst($role[0]);
                        ucfirst($role[1]);
                        strtoupper($role[2]);
                    } else{
                        ucfirst($role[0]);
                    }

                    $kolom1 = implode(' ',$role);

                    //ambil data role di dalam database dimana nama_role nya sama dengan role yang diinput dalam excel
                    $id_role = $this->roleModel->where('nama_role', $kolom1)->get()->getRowArray();
                    if (!$id_role) {
                        continue;
                    }

                    // insert data
                    $this->strukturPelaksanaModel->insert([
                        'id_role' => $id_role['id'],
                        'pelaksana' => $kolom2,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            
            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/strukturPelaksana'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/strukturPelaksana'));

        }
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'subsubtitle' => 'Import Data Struktur Pelaksana (2.3)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'strukturPelaksana',
            'template' => 'struktur_pelaksana.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }

    public function updateStrukturPelaksana($id=null){

        $strukturPelaksanaId = $this->strukturPelaksanaModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'subsubtitle' => 'Edit Struktur Pelaksana (2.3)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'strukturPelaksanaId' => $strukturPelaksanaId,
            'role' => $this->roleModel->findAll(),
            'sublink' => 'strukturPelaksana',
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

        if(isset($_POST['submit'])){
            
            $id_role = $this->roleModel-> where('nama_role', $this->request->getPost('nama_role'))->get()->getRowArray();

            $this->strukturPelaksanaModel
            ->set('id_role' , $id_role['id'])
            ->set('pelaksana' , $this->request->getPost('pelaksana'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data struktur pelaksana manajemen risiko SPBE berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/strukturPelaksana'));
        }
        return view('PengelolaRisiko/form-edit-struktur-pelaksana' , $data);
    }

    public function hapusStrukturPelaksana($id = null)
    {
        if ($id==null) {
            $delete = $this->strukturPelaksanaModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->strukturPelaksanaModel->where('id', $id)->delete();
        }

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/strukturPelaksana'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanStrukturPelaksana($id){

        $strukturPelaksanaId = $this->strukturPelaksanaModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$strukturPelaksanaId['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'strukturPelaksana',
            'status' => $status,
            'data' => $strukturPelaksanaId,
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

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/pemangku-kepentingan',$data);
    }

    public function getDaftarPemangkuKepentingan(){

        return $this->respond($this->pemangkuKepentinganModel->where('id_upr', session()->id_upr)->getPemangkuKepentingan());

    }

    public function inputPemangkuKepentingan()
    {
        if(isset($_POST['tambah'])){
            
            $inputData = [
                'nama_unit' => $this->request->getPost('nama_unit'),
                'hubungan' => $this->request->getPost('hubungan'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->pemangkuKepentinganModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data pemangku kepentingan berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Tambah Pemangku Kepentingan (2.4)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'pemangkuKepentingan',
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

        return view('PengelolaRisiko/form-pemangku-kepentingan' , $data);
    }

//Menambah data pemangku kepentingan dengan melakukan import file excel
    public function importPemangkuKepentingan(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
            
                    // insert data
                    $this->pemangkuKepentinganModel->insert([
                        'nama_unit' => $kolom1,
                        'hubungan' => $kolom2,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/pemangkuKepentingan'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/pemangkuKepentingan'));

        }
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Import Data Pemangku Kepentingan (2.4)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'pemangkuKepentingan',
            'template' => 'pemangku_kepentingan.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }    


    public function updatePemangkuKepentingan($id=null){

        $pemangkuKepentinganId = $this->pemangkuKepentinganModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Edit Pemangku Kepentingan (2.4)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'pemangkuKepentinganId' => $pemangkuKepentinganId,
            'sublink' => 'pemangkuKepentingan',
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

        if(isset($_POST['submit'])){
            
            $this->pemangkuKepentinganModel
            ->set('nama_unit' , $this->request->getPost('nama_unit'))
            ->set('hubungan' , $this->request->getPost('hubungan'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data pemangku kepentingan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/pemangkuKepentingan'));
        }
        return view('PengelolaRisiko/form-edit-pemangku-kepentingan' , $data);
    }

    public function hapusPemangkuKepentingan($id = null)
    {
        if ($id==null) {
            $delete = $this->pemangkuKepentinganModel->where('id_upr', session()->id_upr)->delete();
        } else {
           $delete = $this->pemangkuKepentinganModel->where('id', $id)->delete();
        }

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/pemangkuKepentingan'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanPemangkuKepentingan($id){

        $pemangkuKepentinganId = $this->pemangkuKepentinganModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$pemangkuKepentinganId['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'pemangkuKepentingan',
            'status' => $status,
            'data' => $pemangkuKepentinganId,
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

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/peraturan-perundangan',$data);
    }

    public function getDaftarPeraturanPerundangan(){

        return $this->respond($this->peraturanPerundanganModel->where('id_upr', session()->id_upr)->getPeraturanPerundangan());

    }

    public function inputPeraturanPerundangan()
    {
        if(isset($_POST['tambah'])){
            
            $inputData = [
                'nama_peraturan' => $this->request->getPost('nama_peraturan'),
                'amanat' => $this->request->getPost('amanat'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->peraturanPerundanganModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data peraturan perundang-undangan berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $role = $this->roleModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'subsubtitle' => 'Tambah Peraturan Perundang-undangan (2.5)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'peraturanPerundangan',
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

        return view('PengelolaRisiko/form-peraturan-perundangan' , $data);
    }

//Menambah data peraturan perundangan dengan melakukan import file excel
    public function importPeraturanPerundangan(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
            
                    // insert data
                    $this->peraturanPerundanganModel->insert([
                        'nama_peraturan' => $kolom1,
                        'amanat' => $kolom2,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/peraturanPerundangan'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/peraturanPerundangan'));

        }

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'subsubtitle' => 'Import Data Peraturan Perundang-undangan (2.5)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'peraturanPerundangan',
            'template' => 'peraturan_perundangan.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }    


    public function updatePeraturanPerundangan($id=null){

        $peraturanPerundanganId = $this->peraturanPerundanganModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'subsubtitle' => 'Edit Peraturan Perundang-undangan (2.5)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'peraturanPerundanganId' => $peraturanPerundanganId,
            'sublink' => 'peraturanPerundangan',
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

        if(isset($_POST['submit'])){
            
            $this->peraturanPerundanganModel
            ->set('nama_peraturan' , $this->request->getPost('nama_peraturan'))
            ->set('amanat' , $this->request->getPost('amanat'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data peraturan perundang-undangan berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/peraturanPerundangan'));
        }
        return view('PengelolaRisiko/form-edit-peraturan-perundangan' , $data);
    }

    public function hapusPeraturanPerundangan($id = null)
    {
        if ($id==null) {
            $delete = $this->peraturanPerundanganModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->peraturanPerundanganModel->where('id', $id)->delete();
        }
        

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/peraturanPerundangan'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanPeraturanPerundangan($id){

        $peraturanPerundanganId = $this->peraturanPerundanganModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$peraturanPerundanganId['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'peraturanPerundangan',
            'status' => $status,
            'data' => $peraturanPerundanganId,
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

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/penetapan-kategori',$data);
    }

    public function getDaftarKategoriRisikoTerpilih(){

        return $this->respond($this->kategoriRisikoTerpilihModel->where('id_upr',session()->id_upr)->getKategoriRisikoTerpilih());

    }

    public function inputKategoriRisikoTerpilih()
    {
        if(isset($_POST['tambah'])){

            $data = $this->request->getPost('id_kategori_risiko');

            for ($i=0; $i < sizeof($data); $i++) { 
                $this->kategoriRisikoTerpilihModel->insert([
                    'id_kategori_risiko' => $data[$i],
                    'id_upr' => session()->id_upr,
                    'id_status_persetujuan' => 1
                ]);
            }

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kategori risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $kategoriRisiko = $this->kategoriRisikoModel->getKategori();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'subsubtitle' => 'Tambah Kategori Risiko SPBE (2.6)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kategoriRisikoTerpilih',
            'kategoriRisiko' => $kategoriRisiko,
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

         return view('PengelolaRisiko/form-penetapan-kategori',$data);
    }

    public function hapusKategoriRisikoTerpilih($id = null)
    {
        
        if ($id==null) {
            $delete = $this->kategoriRisikoTerpilihModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->kategoriRisikoTerpilihModel->where('id', $id)->delete();
        }
        
        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/kategoriRisikoTerpilih'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanKategoriRisikoTerpilih($id){

        $kategoriRisikoTerpilih = $this->kategoriRisikoTerpilihModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$kategoriRisikoTerpilih['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kategoriRisikoTerpilih',
            'status' => $status,
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-persetujuan' , $data);
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/penetapan-area-dampak',$data);
    }

    public function getDaftarAreaDampakRisikoTerpilih(){

        return $this->respond($this->areaDampakRisikoTerpilihModel->where('id_upr', session()->id_upr)->getAreaDampakRisikoTerpilih());

    }

    public function inputAreaDampakRisikoTerpilih()
    {
        if(isset($_POST['tambah'])){

            $data = $this->request->getPost('id_area_dampak');

            for ($i=0; $i < sizeof($data); $i++) { 
                $this->areaDampakRisikoTerpilihModel->insert([
                    'id_area_dampak' => $data[$i],
                    'id_upr' => session()->id_upr,
                    'id_status_persetujuan' => 1
                ]);
            }

            // $areaDampakTerpilih = $this->areaDampakRisikoModel->where('id',$this->request->getPost('id_area_dampak'))->get()->getRowArray();


            // $inputData = [
            //     'id_area_dampak' => $areaDampakTerpilih['id'],
            //     'id_upr' => session()->id_upr,
            //     'id_status_persetujuan' => 1
            // ];

            // $this->areaDampakRisikoTerpilihModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Area dampak risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $areaDampak = $this->areaDampakRisikoModel->getAreaDampak();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'subsubtitle' => 'Tambah Area Dampak Risiko SPBE (2.7)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'areaDampakRisikoTerpilih',
            'areaDampak' => $areaDampak,
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

         return view('PengelolaRisiko/form-penetapan-area-dampak',$data);
    }

    public function hapusAreaDampakRisikoTerpilih($id = null)
    {
        
        if ($id==null) {
            $delete = $this->areaDampakRisikoTerpilihModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->areaDampakRisikoTerpilihModel->where('id', $id)->delete();

        }
        
        
        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/areaDampakRisikoTerpilih'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanAreaDampakTerpilih($id){

        $areaDampakTerpilih = $this->areaDampakRisikoTerpilihModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$areaDampakTerpilih['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'areaDampakRisikoTerpilih',
            'status' => $status,
            'data' => $areaDampakTerpilih,
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

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/penetapan-kriteria',$data);
    }

    public function getDaftarKriteriaKemungkinan(){

        return $this->respond($this->kriteriaKemungkinanModel->where('kriteria_kemungkinan_risiko_spbe.id_upr', session()->id_upr)->getKriteriaKemungkinan());

    }

    public function getDaftarKriteriaDampak(){
        return $this->respond($this->kriteriaDampakModel->where('kriteria_dampak_risiko_spbe.id_upr', session()->id_upr)->getKriteriaDampak());

    }

    public function inputKriteriaKemungkinan()
    {
        $tag = md5(uniqid());
        if(isset($_POST['tambah'])){


            if ($this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'), 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getRowArray() || $this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'), 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 1])->get()->getRowArray()) {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Kriteria kemungkinan risiko untuk kategori risiko ini telah lengkap. Pilih kategori risiko yang lain
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->back();
            }

            $levelKemungkinan = $this->levelKemungkinanModel->findAll();

            $k = 0;
            for ($i=0; $i < sizeof($levelKemungkinan) ; $i++) { 

                $k += 1;
                $this->kriteriaKemungkinanModel->insert([
                    'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                    'tag' => $tag,
                    'id_level_kemungkinan' => $levelKemungkinan[$i]['id'],
                    'presentase_kemungkinan' => $this->request->getPost('presentase_kemungkinan'.strval($k)),
                    'jumlah_frekuensi' => $this->request->getPost('jumlah_frekuensi'.strval($k)),
                    'id_upr' => session()->id_upr,
                    'id_status_persetujuan' => 1
                ]);
                
            }            


            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kriteria kemungkinan risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }


        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->where(['id_upr'=>session()->id_upr,'id_status_persetujuan'=> 2])->getKategoriRisikoTerpilih();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Tambah Kriteria Kemungkinan Risiko SPBE (2.8A)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan,
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

         return view('PengelolaRisiko/form-kriteria-kemungkinan',$data);
    }

//Menambah data kriteria kemungkinan dengan melakukan import file excel
    public function importKriteriaKemungkinan(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;

                $tag = md5(uniqid());
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
                    if (empty($kolom3)) {
                        continue;
                    }
                    if (empty($kolom4)) {
                        continue;
                    }

                    // $kolom1 = explode(' ',$kolom1);
                    // $kolomBaru = array();
                    // for ($i=0; $i < sizeof($kolom1); $i++) { 
                    //     if (ctype_alpha($kolom1[$i])) {
                    //         array_push($kolomBaru,$kolom1[$i]);
                    //     }
                    // }
                    // $kolom1 = implode(' ', $kolomBaru);
                    // var_dump($kolomBaru);
                    $kategori = $this->kategoriRisikoTerpilihModel->where(['kategori_risiko' => $kolom1, 'id_status_persetujuan' => 2])->getKategoriRisikoTerpilih();
                    $level = $this->levelKemungkinanModel->where('id', $kolom2)->get()->getRowArray();

                    if (!$kategori) {
                        continue;
                    }
                    if (!$level) {
                        continue;
                    }
                    if ($this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $kategori[0]['id'], 'id_level_kemungkinan' => $level['id'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getRowArray() || $this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $kategori[0]['id'], 'id_level_kemungkinan' => $level['id'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 1])->get()->getRowArray()) {
                        continue;
                    }
            
                    //insert data
                    $this->kriteriaKemungkinanModel->insert([
                        'id_kategori_risiko' => $kategori[0]['id'],
                        'tag' => $tag,
                        'id_level_kemungkinan' => $level['id'],
                        'presentase_kemungkinan' => $kolom3,
                        'jumlah_frekuensi' =>$kolom4,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            
            return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));

        }
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Import Data Kriteria Kemungkinan Risiko SPBE (2.8A)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'kriteriaRisiko',
            'template' => 'kriteria_kemungkinan.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }  

    public function updateKriteriaKemungkinan($id=null, $tag=null){

        $kriteriaKemungkinan = $this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $id, 'id_upr' => session()->id_upr, 'tag'=> $tag])->get()->getResultArray();
        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->where('id_status_persetujuan', 2)->getKategoriRisikoTerpilih();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Edit Kriteria Kemungkinan Risiko SPBE (2.8A)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'kriteriaKemungkinanId' => $kriteriaKemungkinan,
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan,
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

        if(isset($_POST['submit'])){

            // $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko',$this->request->getPost('kategori_risiko'))->get()->getRowArray();

            $levelKemungkinan = $this->levelKemungkinanModel->findAll();
            
            $k = 0;
            $l = 0;
            for ($i=0; $i < sizeof($kriteriaKemungkinan) ; $i++) { 
            
                $k += 1;
                $this->kriteriaKemungkinanModel
                ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
                ->set('id_level_kemungkinan' , $kriteriaKemungkinan[$l]['id_level_kemungkinan'])
                ->set('presentase_kemungkinan' , $this->request->getPost('presentase_kemungkinan'.strval($k)))
                ->set('jumlah_frekuensi' , $this->request->getPost('jumlah_frekuensi'.strval($k)))
                ->where('id' , $kriteriaKemungkinan[$l]['id'])
                ->update();
                $l += 1;
            }
        

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data kriteria kemungkinan risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
        }
        return view('PengelolaRisiko/form-edit-kriteria-kemungkinan' , $data);
    }

    public function hapusKriteriaKemungkinan($id = null, $tag=null)
    {
        
        if ($id==null AND $tag==null) {
            $this->kriteriaKemungkinanModel->where('id_upr' , session()->id_upr)->delete();
        } else {
            $this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $id, 'id_upr' => session()->id_upr, 'tag' => $tag])->delete();
        }
        

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanKriteriaKemungkinan($id=null, $tag=null){

        $kriteriaKemungkinan = $this->kriteriaKemungkinanModel->where(['id_kategori_risiko' => $id, 'id_upr' => session()->id_upr, 'tag'=>$tag])->get()->getRowArray();
        $status = $this->statusPersetujuanModel->where('id',$kriteriaKemungkinan['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'status' => $status,
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];
        
        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

    public function inputKriteriaDampak()
    {
        $tag = md5(uniqid());
        if(isset($_POST['tambah'])){


            if ($this->kriteriaDampakModel->where(['id_area_dampak'=> $this->request->getPost('id_area_dampak'), 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getRowArray() || $this->kriteriaDampakModel->where(['id_area_dampak'=> $this->request->getPost('id_area_dampak'), 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 1])->get()->getRowArray()) {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Kriteria Dampak risiko untuk area dampak ini telah lengkap. Pilih area dampak yang lain
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->back();
            }

            $levelDampak = $this->levelDampakModel->findAll();

            $jenisRisiko = $this->jenisRisikoModel->findAll();

            $k = 0;
            $l = 0;
            for ($i=0; $i < sizeof($jenisRisiko) ; $i++) { 
                for ($j=0; $j < sizeof($levelDampak) ; $j++) {

                    $k += 1;
                    $this->kriteriaDampakModel->insert([
                        'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                        'tag' => $tag,
                        'id_jenis_risiko' => $jenisRisiko[$i]['id'],
                        'id_level_dampak' => $levelDampak[$j]['id'],
                        'penjelasan' => $this->request->getPost('penjelasan'.strval($k)),
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);
                }
            }            

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kriteria dampak risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->where('id_status_persetujuan', 2)->getAreaDampakRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $daftarLevelDampak = $this->levelDampakModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Tambah Kriteria Dampak Risiko SPBE (2.8B)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'daftarAreaDampak' => $daftarAreaDampak,
            'daftarLevelDampak' => $daftarLevelDampak,
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

         return view('PengelolaRisiko/form-kriteria-dampak',$data);
    }

    //Menambah data kriteria dampak dengan melakukan import file excel
    public function importKriteriaDampak(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;

                $tag = md5(uniqid());
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
                    if (empty($kolom3)) {
                        continue;
                    }
                    if (empty($kolom4)) {
                        continue;
                    }


                    $dampak = $this->areaDampakRisikoTerpilihModel->where(['area_dampak'=> $kolom1, 'id_status_persetujuan' => 2])->getAreaDampakRisikoTerpilih();
                    $level = $this->levelDampakModel->where('id', $kolom3)->get()->getRowArray();
                    $jenisRisiko = $this->jenisRisikoModel->where('id', $kolom2)->get()->getRowArray();

                    if (!$dampak) {
                        continue;
                    }
                    if (!$level) {
                        continue;
                    }
                    if (!$jenisRisiko) {
                        continue;
                    }
                    if ($this->kriteriaDampakModel->where(['id_area_dampak' => $dampak[0]['id'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_level_dampak' => $level['id'],  'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getRowArray() || $this->kriteriaDampakModel->where(['id_area_dampak' => $dampak[0]['id'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_level_dampak' => $level['id'],  'id_upr' => session()->id_upr, 'id_status_persetujuan' => 1])->get()->getRowArray()) {
                        continue;
                    }
            
                    //insert data
                    $this->kriteriaDampakModel->insert([
                        'id_area_dampak' => $dampak[0]['id'],
                        'tag' => $tag,
                        'id_jenis_risiko' => $jenisRisiko['id'],
                        'id_level_dampak' => $level['id'],
                        'penjelasan' => $kolom4,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            
            return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));

        }
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Import Data Kriteria Kemungkinan Risiko SPBE (2.8A)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'kriteriaRisiko',
            'template' => 'kriteria_dampak.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    }

    public function updateKriteriaDampak($id=null, $tag=null){

        $kriteriaDampak = $this->kriteriaDampakModel->where(['id_area_dampak' => $id, 'id_upr' => session()->id_upr, 'tag'=>$tag])->get()->getResultArray();
        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->where('id_status_persetujuan', 2)->getAreaDampakRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $daftarLevelDampak = $this->levelDampakModel->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Edit Kriteria Dampak Risiko SPBE (2.8A)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'kriteriaDampakId' => $kriteriaDampak,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'daftarAreaDampak' => $daftarAreaDampak,
            'daftarLevelDampak' => $daftarLevelDampak,
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

        if(isset($_POST['submit'])){

            // $levelDampak = $this->levelDampakModel->findAll();

            // $jenisRisiko = $this->jenisRisikoModel->findAll();

        $k = 0;
        $l = 0;
        for ($i=0; $i < sizeof($kriteriaDampak) ; $i++) {  

                $k += 1;
                $this->kriteriaDampakModel
                ->set('id_area_dampak' , $this->request->getPost('id_area_dampak'))
                ->set('penjelasan' , $this->request->getPost('penjelasan'.strval($k)))
                ->where('id' , $kriteriaDampak[$l]['id'])
                ->update();
                $l += 1;
            
        }
            
            

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data kriteria dampak risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
        }
        return view('PengelolaRisiko/form-edit-kriteria-dampak' , $data);
    }

    public function hapusKriteriaDampak($id = null, $tag=null)
    {
        
        if ($id==null AND $tag==null) {
            $delete = $this->kriteriaDampakModel->where('id_upr' ,session()->id_upr)->delete();
        } else {
            $delete = $this->kriteriaDampakModel->where(['id_area_dampak' => $id, 'id_upr' => session()->id_upr, 'tag'=>$tag])->delete();
        }
        

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanKriteriaDampak($id=null, $tag=null){

        $kriteriaDampak = $this->kriteriaDampakModel->where(['id_area_dampak' => $id, 'id_upr' => session()->id_upr, 'tag'=>$tag])->get()->getRowArray();
        $status = $this->statusPersetujuanModel->where('id',$kriteriaDampak['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'status' => $status,
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-persetujuan' , $data);
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/matriks-level',$data);
    }

    public function getMatriksRisiko(){

        return $this->respond($this->matriksRisikoModel->getMatriks());
    }

    public function getLevelRisiko(){

        return $this->respond($this->levelRisikoModel->findAll());
    }

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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/selera-risiko',$data);
    }

    public function getSeleraRisiko(){

        return $this->respond($this->seleraRisikoModel->orderBy('id','ASC')->where('selera_risiko_spbe.id_upr',session()->id_upr)->getSelera());
    }

    public function inputSeleraRisiko()
    {
        if(isset($_POST['tambah'])){

            $tag = md5(uniqid());
            $jenisRisiko1 = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko1'))->get()->getRowArray();
            $jenisRisiko2 = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko2'))->get()->getRowArray();


            if ($this->seleraRisikoModel->where(['id_kategori_risiko'=> $this->request->getPost('id_kategori_risiko'), 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getRowArray() || $this->seleraRisikoModel->where(['id_kategori_risiko'=> $this->request->getPost('id_kategori_risiko'), 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 1])->get()->getRowArray()) {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Selera risiko untuk kategori risiko ini telah lengkap. Pilih kategori risiko yang lain
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->back();
            }

            
            $inputData1 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'tag' => $tag,
                'id_jenis_risiko' => $jenisRisiko1['id'],
                'besaran_risiko_min' => $this->request->getPost('besaran_risiko_min1'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $inputData2 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'tag' => $tag,
                'id_jenis_risiko' => $jenisRisiko2['id'],
                'besaran_risiko_min' => $this->request->getPost('besaran_risiko_min2'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->seleraRisikoModel->insert($inputData1);
            $this->seleraRisikoModel->insert($inputData2);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Selera risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->where('id_status_persetujuan', 2)->getKategoriRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $besaranRisiko = $this->matriksRisikoModel->orderBy('besaran_risiko', 'ASC')->findAll();
    
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Selera Risiko SPBE (2.10)',
            'subsubtitle' => 'Tambah Selera Risiko SPBE (2.10)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'seleraRisiko',
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'besaranRisiko' => $besaranRisiko,
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

         return view('PengelolaRisiko/form-selera-risiko',$data);
    }

    //Menambah data selera risiko dengan melakukan import file excel
    public function importSeleraRisiko(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;

                $tag = md5(uniqid());
                foreach ($sheet as $idx => $data) {
                    //skip index 1 karena title excel
                    if($idx==1){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                   

                    if (empty($kolom1)) {
                        continue;
                    }
                    if (empty($kolom2)) {
                        continue;
                    }
                    if (empty($kolom3)) {
                        continue;
                    }


                    $kategori = $this->kategoriRisikoTerpilihModel->where(['kategori_risiko'=> $kolom1, 'id_status_persetujuan' => 2])->getKategoriRisikoTerpilih();
                    $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko', $kolom2)->get()->getRowArray();
                    $besaranRisiko = $this->matriksRisikoModel->where('besaran_risiko', $kolom3)->get()->getRowArray();

                    if (!$kategori) {
                        continue;
                    }
                    if ($this->seleraRisikoModel->where(['id_kategori_risiko' => $kategori[0]['id'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_upr' => session()->id_upr,'id_status_persetujuan' => 2])->get()->getRowArray() || $this->seleraRisikoModel->where(['id_kategori_risiko' => $kategori[0]['id'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_upr' => session()->id_upr,'id_status_persetujuan' => 1])->get()->getRowArray() ) {
                        continue;
                    }
                    if (!$jenisRisiko) {
                        continue;
                    }
                    if (!$besaranRisiko) {
                        continue;
                    }
            
                    //insert data
                    $this->seleraRisikoModel->insert([
                        'id_kategori_risiko' => $kategori[0]['id'],
                        'tag' => $tag,
                        'id_jenis_risiko' => $jenisRisiko['id'],
                        'besaran_risiko_min' => $besaranRisiko['besaran_risiko'],
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/seleraRisiko'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/seleraRisiko'));

        }
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Selera Risiko SPBE (2.10)',
            'subsubtitle' => 'Import Data Selera Risiko SPBE (2.10)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'seleraRisiko',
            'template' => 'selera_risiko.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    } 

    public function updateSeleraRisiko($id=null, $tag=null){

        $seleraRisiko = $this->seleraRisikoModel->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])->get()->getResultArray();
        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->where('id_status_persetujuan', 2)->getKategoriRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $besaranRisiko = $this->matriksRisikoModel->orderBy('besaran_risiko', 'ASC')->findAll();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Selera Risiko SPBE (2.10)',
            'subsubtitle' => 'Edit Selera Risiko SPBE (2.10)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'seleraRisiko',
            'seleraRisikoId' => $seleraRisiko,
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'besaranRisiko' => $besaranRisiko,
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

        if(isset($_POST['submit'])){

            $jenisRisiko = $this->jenisRisikoModel->findAll();

            $matriksRisiko1 = $this->matriksRisikoModel->where('besaran_risiko',$this->request->getPost('besaran_risiko_min1'))->get()->getRowArray();

            $k = 0;
            for ($i=0; $i < sizeof($seleraRisiko) ; $i++) { 

                $k++;
                $this->seleraRisikoModel
                    ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
                    ->set('besaran_risiko_min' , $this->request->getPost('besaran_risiko_min'.strval($k)))
                    ->where('id' , $seleraRisiko[$i]['id'])
                    ->update();
                
            }


            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data selera risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/seleraRisiko'));
        }
        return view('PengelolaRisiko/form-edit-selera-risiko' , $data);
    }

    public function hapusSeleraRisiko($id = null, $tag=null)
    {
        
        if ($id==null AND $tag==null) {
            $delete = $this->seleraRisikoModel->where('id_upr',session()->id_upr)->delete();
        } else {
            $delete = $this->seleraRisikoModel->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])->delete();
        }
        

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/seleraRisiko'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanSeleraRisiko($id=null, $tag=null){

        $seleraRisiko = $this->seleraRisikoModel->where(['id_kategori_risiko'=>$id, 'id_upr'=>session()->id_upr, 'tag'=>$tag])->get()->getRowArray();
        $status = $this->statusPersetujuanModel->where('id',$seleraRisiko['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Selera Risiko SPBE (2.10)',
            'subsubtitle' => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'seleraRisiko',
            'status' => $status,
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

    public function getPenilaianRisiko(){

        return $this->respond($this->penilaianRisikoModel->getPenilaian());

    }

    //Lihat detail risiko
    public function detailRisiko($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'pengelola-risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-risiko' , $data);

    }

    public function inputPenilaianRisiko()
    {
        if(isset($_POST['tambah'])){

            $areaDampak = $this->areaDampakRisikoTerpilihModel->where('area_dampak_risiko_spbe_terpilih.id',$this->request->getPost('id_area_dampak'))->getAreaDampakRisikoTerpilih();

            $levelDampak = $this->levelDampakModel->where('level_dampak',$this->request->getPost('level_dampak'))->get()->getRowArray();

            $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko'))->get()->getRowArray();

            $kategoriRisiko = $this->kategoriRisikoTerpilihModel->where('kategori_risiko_spbe_terpilih.id',$this->request->getPost('id_kategori_risiko'))->getKategoriRisikoTerpilih();

            $indikatorKinerja = $this->sasaranSPBEModel->where(['id'=> $this->request->getPost('id_sasaran_SPBE'), 'id_status_persetujuan' => 2, 'id_upr' => session()->id_upr])->get()->getRowArray();

            $levelKemungkinan = $this->levelKemungkinanModel->where('level_kemungkinan',$this->request->getPost('level_kemungkinan'))->get()->getRowArray();

            $multiClause = array('id_level_kemungkinan' => $levelKemungkinan['id'], 'id_level_dampak' => $levelDampak['id']);
            $multiClause2 = array('id_kategori_risiko' => $kategoriRisiko[0]['id_kategori_risiko'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2);

            $matriksRisiko = $this->matriksRisikoModel->where($multiClause)->get()->getRowArray();
            $besaranRisiko = $matriksRisiko['besaran_risiko'];
            $multiClause3 = array('rentang_min <=' => $besaranRisiko, 'rentang_maks >=' => $besaranRisiko);

            $levelRisiko = $this->levelRisikoModel->where($multiClause3)->get()->getRowArray();

            $seleraRisiko = $this->seleraRisikoModel->where($multiClause2)->get()->getRowArray();
            $besaranRisikoMin = $seleraRisiko['besaran_risiko_min'];

            if ($besaranRisiko >= $besaranRisikoMin) {
                $id_keputusan = 2;
            } else{

                $id_keputusan = 1;
            }


            $inputData = [
                'id_sasaran_SPBE' => $indikatorKinerja['id'],
                'id_jenis_risiko' => $jenisRisiko['id'],
                'kejadian' => $this->request->getPost('kejadian'),
                'penyebab' => $this->request->getPost('penyebab'),
                'id_kategori_risiko' => $kategoriRisiko[0]['id'],
                'dampak' => $this->request->getPost('dampak'),
                'id_area_dampak' => $areaDampak[0]['id'],
                'sistem_pengendalian' => $this->request->getPost('sistem_pengendalian'),
                'id_level_kemungkinan' => $levelKemungkinan['id'],
                'id_level_dampak' => $levelDampak['id'],
                'id_level_risiko' => $levelRisiko['id'],
                'id_keputusan' => $id_keputusan,
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->penilaianRisikoModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Penilaian risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->where('id_status_persetujuan', 2)->getAreaDampakRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $daftarLevelDampak = $this->levelDampakModel->findAll();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->where('id_status_persetujuan', 2)->getKategoriRisikoTerpilih();
        $daftarIndikatorKinerja = $this->sasaranSPBEModel->where(['id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        
        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Tambah Penilaian Risiko SPBE (3.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'daftarAreaDampak' => $daftarAreaDampak,
            'daftarLevelDampak' => $daftarLevelDampak,
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan,
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarIndikatorKinerja' => $daftarIndikatorKinerja,
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

         return view('PengelolaRisiko/form-penilaian-risiko',$data);
    }

    //Menambah data penilaian risiko dengan melakukan import file excel
    public function importPenilaianRisiko(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;

                foreach ($sheet as $idx => $data) {
                    //skip index 1,2,3 karena header excel
                    if($idx==1 || $idx==2 || $idx==3 || $idx==4 || $idx==5 || $idx==6 || $idx==7){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];
                    $kolom5 = $data['E'];
                    $kolom6 = $data['F'];
                    $kolom7 = $data['G'];
                    $kolom8 = $data['H'];
                    $kolom9 = $data['I'];
                    $kolom10 = $data['J'];
                   

                    if (empty($kolom1) || empty($kolom2) || empty($kolom3) || empty($kolom4) ||empty($kolom5) || empty($kolom6) || empty($kolom7) || empty($kolom8) ||empty($kolom9) || empty($kolom10)) {
                        continue;
                    }
                    
                    $indikatorKinerja = $this->sasaranSPBEModel->where('indikator_kinerja_SPBE',$kolom1)->get()->getRowArray();
                    $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko', $kolom5)->get()->getRowArray();
                    $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko', $kolom2)->get()->getRowArray();
                    $dampakRisiko = $this->areaDampakRisikoModel->where('area_dampak', $kolom7)->get()->getRowArray();
                    

                    if (!$kategoriRisiko) {
                        continue;
                    }
                    $kategoriRisikoTerpilih = $this->kategoriRisikoTerpilihModel->where(['id_kategori_risiko'=> $kategoriRisiko['id'], 'id_status_persetujuan' => 2])->getKategoriRisikoTerpilih();
                    if (!$kategoriRisikoTerpilih) {
                        continue;
                    }
                    if (!$this->sasaranSPBEModel->where(['indikator_kinerja_SPBE'=> $kolom1, 'id_status_persetujuan' => 2, 'id_upr' => session()->id_upr])->get()->getRowArray()) {
                        continue;
                    }
                    if (!$dampakRisiko) {
                        continue;
                    }
                    $dampakRisikoTerpilih = $this->areaDampakRisikoTerpilihModel->where(['id_area_dampak'=> $dampakRisiko['id'], 'id_status_persetujuan' => 2])->getAreaDampakRisikoTerpilih();
                    if (!$dampakRisikoTerpilih) {
                        continue;
                    }
                    if (!$jenisRisiko) {
                        continue;
                    }
                    if (!$this->levelKemungkinanModel->where('id',$kolom9)->get()->getRowArray()) {
                        continue;
                    }
                    if (!$this->levelDampakModel->where('id',$kolom10)->get()->getRowArray()) {
                        continue;
                    }

                    $matriksRisiko = $this->matriksRisikoModel->where(array('id_level_kemungkinan' => $kolom9, 'id_level_dampak' => $kolom10))->get()->getRowArray();

                    $besaranRisiko = $matriksRisiko['besaran_risiko'];
                    
                    $levelRisiko = $this->levelRisikoModel->where(array('rentang_min <=' => $besaranRisiko, 'rentang_maks >=' => $besaranRisiko))->get()->getRowArray();

                    $seleraRisiko = $this->seleraRisikoModel->where(array('id_kategori_risiko' => $kategoriRisiko['id'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2))->get()->getRowArray();

                    $besaranRisikoMin = $seleraRisiko['besaran_risiko_min'];

                    if ($besaranRisiko >= $besaranRisikoMin) {
                        $id_keputusan = 2;
                    } else{

                        $id_keputusan = 1;
                    }
            
                    //insert data
                    $this->penilaianRisikoModel->insert([
                        'id_sasaran_SPBE' => $indikatorKinerja['id'],
                        'id_jenis_risiko' => $jenisRisiko['id'],
                        'kejadian' => $kolom3,
                        'penyebab' => $kolom4,
                        'id_kategori_risiko' => $kategoriRisikoTerpilih[0]['id'],
                        'dampak' => $kolom6,
                        'id_area_dampak' => $dampakRisikoTerpilih[0]['id'],
                        'sistem_pengendalian' => $kolom8,
                        'id_level_kemungkinan' => $kolom9,
                        'id_level_dampak' => $kolom10,
                        'id_level_risiko' => $levelRisiko['id'],
                        'id_keputusan' => $id_keputusan,
                        'id_upr' => session()->id_upr,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/penilaianRisiko'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/penilaianRisiko'));

        }
        
        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Import Data Penilaian Risiko SPBE (3.0)',
            'subsubtitle'  => '',
            'script' => 'pengelola-risiko',
            'active' => 'Penilaian Risiko SPBE',
            'link'  => 'penilaianRisiko',
            'sublink' => 'penilaianRisiko',
            'template' => 'penilaian_risiko.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    } 

    public function updatePenilaianRisiko($id=null){

        $risiko = $this->penilaianRisikoModel->find($id);
        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->where('id_status_persetujuan', 2)->getAreaDampakRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $daftarLevelDampak = $this->levelDampakModel->findAll();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->where('id_status_persetujuan', 2)->getKategoriRisikoTerpilih();
        $daftarIndikatorKinerja = $this->sasaranSPBEModel->where(['id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getResultArray();
        
        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Edit Penilaian Risiko SPBE (3.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'risiko' => $risiko,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'daftarAreaDampak' => $daftarAreaDampak,
            'daftarLevelDampak' => $daftarLevelDampak,
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan,
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarIndikatorKinerja' => $daftarIndikatorKinerja,
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

        if(isset($_POST['submit'])){

            $areaDampak = $this->areaDampakRisikoTerpilihModel->where('area_dampak_risiko_spbe_terpilih.id',$this->request->getPost('id_area_dampak'))->getAreaDampakRisikoTerpilih();

            $levelDampak = $this->levelDampakModel->where('level_dampak',$this->request->getPost('level_dampak'))->get()->getRowArray();

            $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko'))->get()->getRowArray();

            $kategoriRisiko = $this->kategoriRisikoTerpilihModel->where('kategori_risiko_spbe_terpilih.id',$this->request->getPost('id_kategori_risiko'))->getKategoriRisikoTerpilih();

            $indikatorKinerja = $this->sasaranSPBEModel->where(['id'=> $this->request->getPost('id_sasaran_SPBE'), 'id_status_persetujuan' => 2, 'id_upr' => session()->id_upr])->get()->getRowArray();

            $levelKemungkinan = $this->levelKemungkinanModel->where('level_kemungkinan',$this->request->getPost('level_kemungkinan'))->get()->getRowArray();

            $multiClause = array('id_level_kemungkinan' => $levelKemungkinan['id'], 'id_level_dampak' => $levelDampak['id']);
            $multiClause2 = array('id_kategori_risiko' => $kategoriRisiko[0]['id'], 'id_jenis_risiko' => $jenisRisiko['id'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2);

            $matriksRisiko = $this->matriksRisikoModel->where($multiClause)->get()->getRowArray();
            $besaranRisiko = $matriksRisiko['besaran_risiko'];
            $multiClause3 = array('rentang_min <=' => $besaranRisiko, 'rentang_maks >=' => $besaranRisiko);

            $levelRisiko = $this->levelRisikoModel->where($multiClause3)->get()->getRowArray();

            $seleraRisiko = $this->seleraRisikoModel->where($multiClause2)->get()->getRowArray();
            $besaranRisikoMin = $seleraRisiko['besaran_risiko_min'];

            if ($besaranRisiko >= $besaranRisikoMin) {
                $id_keputusan = 2;
            } else{

                $id_keputusan = 1;
            }

            
            $this->penilaianRisikoModel
            ->set('id_sasaran_SPBE' , $indikatorKinerja['id'])
            ->set('id_jenis_risiko' , $jenisRisiko['id'])
            ->set('kejadian' , $this->request->getPost('kejadian'))
            ->set('id_kategori_risiko' , $kategoriRisiko[0]['id'])
            ->set('dampak' , $this->request->getPost('dampak'))
            ->set('id_area_dampak' , $areaDampak[0]['id'])
            ->set('sistem_pengendalian' , $this->request->getPost('sistem_pengendalian'))
            ->set('penyebab' , $this->request->getPost('penyebab'))
            ->set('id_level_kemungkinan' , $levelKemungkinan['id'])
            ->set('id_level_dampak' , $levelDampak['id'])
            ->set('id_level_risiko' , $levelRisiko['id'])
            ->set('id_keputusan' , $id_keputusan)
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data penilaian risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/penilaianRisiko'));
        }
        return view('PengelolaRisiko/form-edit-penilaian-risiko' , $data);
    }

    public function hapusPenilaianRisiko($id = null)
    {
        if ($id==null) {
            $delete = $this->penilaianRisikoModel->where('id_upr', session()->id_upr)->delete();
        } else {
            $delete = $this->penilaianRisikoModel->where('id', $id)->delete();
        }

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/penilaianRisiko'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanPenilaianRisiko($id){

        $penilaianRisiko = $this->penilaianRisikoModel->where('id',$id)->get()->getRowArray();
        $status = $this->statusPersetujuanModel->where('id',$penilaianRisiko['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Detail Persetujuan',
            'subsubtitle' => '',
            'script'    => 'pengelola-risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

    public function getPenangananRisiko(){

        return $this->respond($this->penangananRisikoModel->getPenanganan());

    }

    public function getRisikoByKeputusan(){
        return $this->respond($this->penilaianRisikoModel->getPenilaianByKeputusan());
    }

    public function pilihRisiko(){

        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Ditangani (4.0)',
            'script'    => 'pilih-risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

         return view('PengelolaRisiko/pilih-risiko',$data);
    } 

    public function inputPenangananRisiko($id=null){

        if(isset($_POST['tambah'])){

            $tanggal_mulai = '';
            $tanggal_selesai = '';

            if ($this->request->getPost('periode_implementasi')=="Tanggal") {
                $rules =[
                    'tanggal_mulai' => 'datePeriodeValidation[tanggal_mulai,tanggal_selesai]'
                ];

                $errors = [
                    'tanggal_mulai'=> [
                        'datePeriodeValidation' => 'Tanggal memulai implementasi harus lebih dulu dari tanggal selesai']
                ];

                if(!$this->validate($rules, $errors)){
                    return redirect()->back()->withInput();
                }

                $tanggal_mulai = $this->request->getPost('tanggal_mulai');
                $tanggal_selesai = $this->request->getPost('tanggal_selesai');
                $periode_implementasi = $this->request->getPost('periode_implementasi');
            } else{
                $periode_implementasi = strval($this->request->getPost('jadwal')) .' '. strval(date('Y'));
            } 
                
            $inputData = [
                'id_risiko' => $id,
                'id_opsi_penanganan' => $this->request->getPost('id_opsi_penanganan'),
                'rencana_aksi' => $this->request->getPost('rencana_aksi'),
                'keluaran' => $this->request->getPost('keluaran'),
                'jenis_periode_implementasi' => $this->request->getPost('periode_implementasi'),
                'periode_implementasi' => $periode_implementasi,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai,
                'penanggungjawab' => $this->request->getPost('penanggungjawab'),
                'risiko_residual' => $this->request->getPost('risiko_residual'),
                'id_status_persetujuan' => 1
            ];

            $this->penangananRisikoModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Rencana Penanganan risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
        }


        $risiko = $this->penilaianRisikoModel->where('id',$id)->get()->getRowArray();

        $daftarOpsiPenanganan = $this->opsiPenangananModel->where('id_jenis_risiko', $risiko['id_jenis_risiko'])->get()->getResultArray();
        
        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Ditangani (4.0)',
            'subsubtitle'  => 'Tambah Rencana Penanganan Risiko (4.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'sublink'      => 'pilihRisiko',
            'id'        => $id,
            'daftarOpsiPenanganan' => $daftarOpsiPenanganan,
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

        return view('PengelolaRisiko/form-penanganan-risiko' , $data);
    }

    //Menambah data rencana penanganan risiko dengan melakukan import file excel
    public function importPenangananRisiko(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;

                foreach ($sheet as $idx => $data) {
                    //skip index 1,2,3 karena header excel
                    if($idx==1 || $idx==2 || $idx==3){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];
                    $kolom5 = $data['E'];
                    $kolom6 = $data['F'];
                    $kolom7 = $data['G'];
                    $kolom8 = $data['H'];
                    $kolom9 = $data['I'];
                    $kolom10 = $data['J'];
                   

                    if (empty($kolom1) || empty($kolom2) || empty($kolom3) || empty($kolom4) ||empty($kolom5) || empty($kolom9) || empty($kolom10)) {
                        continue;
                    }

                    $kolom1 = explode('_', $kolom1);

                    
                    $kolom5 = strtolower($kolom5);
                    $kolom5 = ucfirst($kolom5);

                    $tanggal_mulai = '';
                    $tanggal_selesai = '';

                    if ($kolom5=="Tanggal") {

                        $format= explode('-',$kolom7);
                        $format1= explode('-',$kolom8);

                        if (sizeof($format)==1 or sizeof($format1)==1) {
                            $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Format tanggal salah, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>';

                            $flash = session()->setFlashdata('flash', $flash);
                            return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
                        }

                        $tanggal_mulai = $kolom7;
                        $tanggal_selesai = $kolom8;
                        $periode_implementasi = $kolom5;
                    } else {
                        $periode_implementasi = $kolom6 .' '. strval(date('Y'));
                    }

                    if (!$this->penilaianRisikoModel->where(['id' => $kolom1[1], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2])->get()->getRowArray()) {
                        continue;
                    }
                    
                    $risiko = $this->penilaianRisikoModel->where('id' , $kolom1[1])->get()->getRowArray();
                    $opsiPenanganan = $this->opsiPenangananModel->where(['opsi_penanganan'=> $kolom2, 'id_jenis_risiko' => $risiko['id_jenis_risiko']])->get()->getRowArray();

                    if ($this->penangananRisikoModel->where('id_risiko', $risiko['id'])->get()->getRowArray()) {
                        continue;
                    }

                    if ($risiko['id_keputusan'] == '1') {
                        continue;
                    }
                    if (!$opsiPenanganan) {
                        continue;
                    }
                    

                    //insert data
                    $this->penangananRisikoModel->insert([
                        'id_risiko' => $risiko['id'],
                        'id_opsi_penanganan' => $opsiPenanganan['id'],
                        'rencana_aksi' => $kolom3,
                        'keluaran' => $kolom4,
                        'jenis_periode_implementasi' => $kolom5,
                        'periode_implementasi' => $periode_implementasi,
                        'tanggal_mulai' => $tanggal_mulai,
                        'tanggal_selesai' => $tanggal_selesai,
                        'penanggungjawab' => $kolom9,
                        'risiko_residual' => $kolom10,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));

        }

        $data = [
            'title'     => 'Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Import Data Rencana Penanganan Risiko SPBE (4.0)',
            'subsubtitle'  => '',
            'script' => 'pengelola-risiko',
            'active' => 'Penanganan Risiko SPBE',
            'link'  => 'penangananRisiko',
            'sublink' => 'penangananRisiko',
            'template' => 'penanganan_risiko.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    } 

    public function updatePenangananRisiko($id=null){

        $rencana_penanganan = $this->penangananRisikoModel->find($id);

        $risiko = $this->penilaianRisikoModel->where('id',$rencana_penanganan['id_risiko'])->get()->getRowArray();

        $daftarOpsiPenanganan = $this->opsiPenangananModel->where('id_jenis_risiko', $risiko['id_jenis_risiko'])->get()->getResultArray();

        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Edit Penanganan Risiko SPBE (4.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'rencana_penanganan' => $rencana_penanganan,
            'daftarOpsiPenanganan' => $daftarOpsiPenanganan,
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

        if(isset($_POST['submit'])){

            $tanggal_mulai = '';
            $tanggal_selesai = '';

            if ($this->request->getPost('periode_implementasi')=="Tanggal") {
                $rules =[
                    'tanggal_mulai' => 'datePeriodeValidation[tanggal_mulai,tanggal_selesai]'
                ];

                $errors = [
                    'tanggal_mulai'=> [
                        'datePeriodeValidation' => 'Tanggal memulai implementasi harus lebih dulu dari tanggal selesai']
                ];

                if(!$this->validate($rules, $errors)){
                    return redirect()->back()->withInput();
                }

                $tanggal_mulai = $this->request->getPost('tanggal_mulai');
                $tanggal_selesai = $this->request->getPost('tanggal_selesai');
                $periode_implementasi = $this->request->getPost('periode_implementasi');
            } else{
                $periode_implementasi = strval($this->request->getPost('jadwal')) .' '. strval(date('Y'));
            }      
            
            $this->penangananRisikoModel
            ->set('id_risiko' , $rencana_penanganan['id_risiko'])
            ->set('id_opsi_penanganan' , $this->request->getPost('id_opsi_penanganan'))
            ->set('rencana_aksi' , $this->request->getPost('rencana_aksi'))
            ->set('keluaran' , $this->request->getPost('keluaran'))
            ->set('jenis_periode_implementasi' , $this->request->getPost('periode_implementasi'))
            ->set('periode_implementasi' , $periode_implementasi)
            ->set('tanggal_mulai' , $tanggal_mulai)
            ->set('tanggal_selesai' ,$tanggal_selesai)
            ->set('penanggungjawab' , $this->request->getPost('penanggungjawab'))
            ->set('risiko_residual' , $this->request->getPost('risiko_residual'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data rencana penanganan risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
        }
        return view('PengelolaRisiko/form-edit-penanganan-risiko' , $data);
    }

    public function hapusPenangananRisiko($id = null)
    {

        $risiko_upr = $this->penilaianRisikoModel->select('id')->where('id_upr',session()->id_upr)->get()->getResultArray();
        if ($id==null) {
            $delete = $this->penangananRisikoModel->whereIn('id_risiko', $risiko_upr[0])->delete();
        } else {
            $delete = $this->penangananRisikoModel->where('id', $id)->delete();
        }
        

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanPenangananRisiko($id){

        $penangananRisiko = $this->penangananRisikoModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$penangananRisiko['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subsubtitle' => '',
            'subtitle'  => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }

    //Lihat detail risiko
    public function detailRisikoPenanganan($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Rencana Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'pengelola-risiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-risiko' , $data);

    }


    public function getPemantauanRisiko(){

        return $this->respond($this->pemantauanRisikoModel->getPemantauan());

    }

    public function getRisikoByPenanganan(){
        return $this->respond($this->penilaianRisikoModel->getPenilaianByPenanganan());
    }

    public function pilihRisikoPemantauan(){

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Dipantau',
            'script'    => 'pilih-risiko-pemantauan',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

         return view('PengelolaRisiko/pilih-risiko-pemantauan',$data);
    }

    public function pilihJenisLaporanPemantauan($id_risiko=null){

        if(isset($_POST['tambah'])){

            if ($id_risiko==null) {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Pilih risiko, Anda belum memilih risiko yang ingin dipantau
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/pilihRisikoPemantauan'));
            }

            return redirect()->to(base_url('pengelolaRisiko/penilaianLanjutan/'.$id_risiko.'/'.$this->request->getPost('jenis_laporan')));
        }


        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Dipantau',
            'subsubtitle'  => 'Memilih Jenis Laporan Pemantauan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'sublink'  =>  'pilihRisikoPemantauan',
            'id_risiko' => $id_risiko,
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

         return view('PengelolaRisiko/pilih-jenis-laporan',$data);
    }

    public function penilaianLanjutan($id_risiko=null, $jenis_laporan=null, $tipe_halaman=null, $id_pemantauan=null){

        if(isset($_POST['tambah'])){

            if ($id_risiko==null or $jenis_laporan==null) {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Pilih risiko dan jenis laporan terlebih dahulu, Anda belum memilih risiko yang ingin dipantau serta jenis laporannya
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/pilihRisikoPemantauan'));
            }


            $risiko = $this->penilaianRisikoModel->where('id', $id_risiko)->get()->getRowArray();

            $id_level_kemungkinan = $this->request->getPost('id_level_kemungkinan_pemantauan');
            $id_level_dampak = $this->request->getPost('id_level_dampak_pemantauan');

            $multiClause = array('id_level_kemungkinan' => $id_level_kemungkinan, 'id_level_dampak' => $id_level_dampak); 
            $multiClause2 = array('id_kategori_risiko' => $risiko['id_kategori_risiko'], 'id_jenis_risiko' => $risiko['id_jenis_risiko'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2);

            $matriksRisiko = $this->matriksRisikoModel->where($multiClause)->get()->getRowArray();
            $besaranRisiko = $matriksRisiko['besaran_risiko'];
            $multiClause3 = array('rentang_min <=' => $besaranRisiko, 'rentang_maks >=' => $besaranRisiko);

            $levelRisiko = $this->levelRisikoModel->where($multiClause3)->get()->getRowArray();

            $seleraRisiko = $this->seleraRisikoModel->where($multiClause2)->get()->getRowArray();
            $besaranRisikoMin = $seleraRisiko['besaran_risiko_min'];

            if ($tipe_halaman=='edit') {
                $ganti_besaran_risiko = 'true';
                 return redirect()->to(base_url('pengelolaRisiko/updatePemantauanRisiko/'.$id_pemantauan.'/'.$id_risiko.'/'.$id_level_kemungkinan.'/'.$id_level_dampak.'/'.$besaranRisiko.'/'.$levelRisiko['level_risiko'].'/'.$besaranRisikoMin.'/'.$ganti_besaran_risiko));
            } else {
                return redirect()->to(base_url('pengelolaRisiko/inputPemantauanRisiko/'.$id_risiko.'/'.$jenis_laporan.'/'.$id_level_kemungkinan.'/'.$id_level_dampak.'/'.$besaranRisiko.'/'.$levelRisiko['level_risiko'].'/'.$besaranRisikoMin));
            }
            
        }

        $daftarLevelDampak = $this->levelDampakModel->findAll();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Dipantau',
            'subsubtitle'  => 'Memilih Jenis Laporan Pemantauan',
            'subsubsubtitle' => 'Memeriksa Besaran dan Level Risiko Saat ini',
            'script'    => 'pengelola-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'sublink'      => 'pilihRisikoPemantauan',
            'subsublink' => 'pilihJenisLaporanPemantauan',
            'id_risiko'   => $id_risiko,
            'daftarLevelDampak' => $daftarLevelDampak,
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan,
            'tipe_halaman' => $tipe_halaman,
            'jenis_laporan' => $jenis_laporan,
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

         return view('PengelolaRisiko/form-input-penilaian-lanjutan',$data);
    }


    public function inputPemantauanRisiko($id_risiko=null, $jenis_laporan=null, $id_level_kemungkinan=null, $id_level_dampak=null, $besaranRisiko=null, $levelRisiko=null, $besaranRisikoMin=null){


        if(isset($_POST['tambah'])){

            $penanganan_risiko = $this->penangananRisikoModel->where('id_risiko',$id_risiko)->get()->getRowArray();

            if ($jenis_laporan=='tahunan') {
                $jenis_laporan = $jenis_laporan.' '. strval(date('Y'));
                $periode_laporan = '';
                $waktu_pelaksanaan_rencana='';
            } else {
                $periode_laporan = $this->request->getPost('periode_laporan').' '. strval(date('Y'));
                if($this->request->getPost('rencana_penanganan') == ''){
                    $waktu_pelaksanaan_rencana = '';
                    $penanggungjawab ='';
                } else {
                    $waktu_pelaksanaan_rencana = $this->request->getPost('waktu_pelaksanaan_rencana').' '. strval(date('Y'));
                    $penanggungjawab = $this->request->getPost('penanggungjawab');
                }
            }
            

            $inputData = [
                'id_risiko' => $id_risiko,
                'id_penanganan_risiko' => $penanganan_risiko['id'],
                'id_level_kemungkinan_pemantauan' => $id_level_kemungkinan,
                'id_level_dampak_pemantauan' => $id_level_dampak,
                'jenis_laporan' => $jenis_laporan,
                'periode_laporan' => $periode_laporan,
                'deskripsi_risiko_saat_ini' => $this->request->getPost('deskripsi'),
                'rekomendasi' => $this->request->getPost('rekomendasi'),
                'rencana_penanganan' => $this->request->getPost('rencana_penanganan'),
                'penanggungjawab' => $this->request->getPost('penanggungjawab'),
                'waktu_pelaksanaan_rencana' => $waktu_pelaksanaan_rencana,
                'id_status_persetujuan' => 1
            ];

            $this->pemantauanRisikoModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Laporan Pemantauan risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/pemantauanRisiko'));
        }

    
        $risiko = $this->penilaianRisikoModel->getPenilaianById($id_risiko);
        $penanganan_risiko = $this->penangananRisikoModel->where(['id_risiko' => $id_risiko])->get()->getRowArray();

        $kriteria_dampak_pemantauan = $this->kriteriaDampakModel->where(['id_area_dampak'=>$risiko[0]['id_area_dampak'],'id_level_dampak' => $id_level_dampak, 'id_jenis_risiko' => $risiko[0]['id_jenis_risiko'], 'id_upr'=> session()->id_upr])->get()->getRowArray();
        $kriteria_kemungkinan_pemantauan = $this->kriteriaKemungkinanModel->where(['id_kategori_risiko'=> $risiko[0]['id_kategori_risiko'], 'id_level_kemungkinan'=>$id_level_kemungkinan, 'id_upr'=>session()->id_upr])->get()->getRowArray();
            
        

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Dipantau',
            'subsubtitle'  => 'Memilih Jenis Laporan Pemantauan',
            'subsubsubtitle' => 'Memeriksa Besaran dan Level Risiko Saat ini',
            'subsubsubsubtitle' => 'Menambah Laporan Pemantauan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'sublink'      => 'pilihRisikoPemantauan',
            'subsublink' => 'pilihJenisLaporanPemantauan',
            'subsubsublink' => 'penilaianLanjutan',
            'risiko'   => $risiko,
            'levelDampak' => $this->levelDampakModel->find($id_level_dampak),
            'levelKemungkinan' => $this->levelKemungkinanModel->find($id_level_kemungkinan),
            'penanganan_risiko' => $penanganan_risiko,
            'besaranRisiko' =>$besaranRisiko,
            'levelRisiko' => $levelRisiko,
            'besaranRisikoMin' => $besaranRisikoMin,
            'besaranRisikoMin' => $besaranRisikoMin,
            'kriteria_dampak_pemantauan' => $kriteria_dampak_pemantauan,
            'kriteria_kemungkinan_pemantauan' => $kriteria_kemungkinan_pemantauan,
            'jenis_laporan' => $jenis_laporan,
            'tipe_halaman' => 'input',
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

        return view('PengelolaRisiko/form-input-pemantauan-risiko',$data);

    }


    //Menambah data rencana penanganan risiko dengan melakukan import file excel
    public function importPemantauanRisiko(){

        if(isset($_POST['tambah'])){

            //Menambah rules untuk file excel yang di upload dengan ukuran maksimal 2 MB
            $rules =[
                'fileexcel' => 'uploaded[fileexcel]|max_size[fileexcel,2048]'
            ];

            $errors = [
                'fileexcel'=> [
                    'max_size' => 'Ukuran File Maksimal 2 MB']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }

            $file = $this->request->getFile('fileexcel');
            //var_dump($file);

            if ($file->isValid() && ! $file->hasMoved()) {

                $excelReader  = new PHPExcel();

                //mengambil lokasi temp file
                $fileLocation = $file->getTempName();

                //baca file
                $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);

                //ambil sheet active
                $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

                //looping untuk mengambil data
                $suksesImport = 0;

                foreach ($sheet as $idx => $data) {
                    //skip index 1,2,3 karena header excel
                    if($idx==1 || $idx==2 || $idx==3){
                        continue;
                    }
                    $kolom1 = $data['A'];
                    $kolom2 = $data['B'];
                    $kolom3 = $data['C'];
                    $kolom4 = $data['D'];
                    $kolom5 = $data['E'];
                    $kolom6 = $data['F'];
                    $kolom7 = $data['G'];
                    $kolom8 = $data['H'];
                    $kolom9 = $data['I'];
                   

                    if (empty($kolom1) || empty($kolom2) || empty($kolom3) || empty($kolom4)) {
                        continue;
                    }

                    $kolom1 = explode('_', $kolom1);

                    $jenis_laporan = strtolower($kolom2);

                    if(!$this->penilaianRisikoModel->getPenilaianById($kolom1[1])){
                        continue;
                    }

                    $risiko = $this->penilaianRisikoModel->getPenilaianById($kolom1[1]);
                    $penanganan_risiko = $this->penangananRisikoModel->where('id_risiko',$risiko[0]['id'])->get()->getRowArray();

                    if ($jenis_laporan=='triwulanan') {
                        $jenis_laporan= substr($jenis_laporan, 0, 8);
                    }

                    $id_level_kemungkinan_pemantauan = $kolom3;
                    $id_level_dampak_pemantauan= $kolom4;
                    $levelKemungkinanPemantauan= $this->levelKemungkinanModel->find($id_level_kemungkinan_pemantauan);
                    $levelDampakPemantauan= $this->levelDampakModel->find($id_level_dampak_pemantauan);

                    $rencana_penanganan = '';
                    $waktu_pelaksanaan_rencana = '';
                    $penanggungjawab = '';
                    $rekomendasi = '';
                    $periode_laporan = $kolom5.' '. strval(date('Y'));

                    $kolom5 = strtolower($kolom5);
                    $kolom5 = ucwords($kolom5);

                    if ($jenis_laporan=="tahunan") {
                        $jenis_laporan = $jenis_laporan .' '. strval(date('Y'));
                        $rekomendasi = $kolom9;
                    } elseif($jenis_laporan=="triwulan" AND $kolom5=='Triwulan 1') {
                        $periode_laporan = 'Triwulan I '. strval(date('Y'));
                    } elseif ($jenis_laporan=='triwulan' AND $kolom5=='Triwulan 2') {
                        $periode_laporan = 'Triwulan II '. strval(date('Y'));
                    } elseif ($jenis_laporan=='triwulan' AND $kolom5=='Triwulan 3') {
                        $periode_laporan = 'Triwulan III '. strval(date('Y'));
                    } elseif ($jenis_laporan=='triwulan' AND $kolom5=='Triwulan 4') {
                        $periode_laporan = 'Triwulan IV '. strval(date('Y'));
                    } elseif ($jenis_laporan=='semesteran' AND $kolom5=='Semester 1') {
                        $periode_laporan = 'Semester I '. strval(date('Y'));
                    } elseif ($jenis_laporan=='semesteran' AND $kolom5=='Semester 2') {
                        $periode_laporan = 'Semester II '. strval(date('Y'));
                    }

                    if ($jenis_laporan == "triwulan" OR $jenis_laporan == "semesteran" OR $jenis_laporan == 'bulanan') {
                        $rencana_penanganan = $kolom6;
                        $waktu_pelaksanaan_rencana = $kolom7.' '. strval(date('Y'));
                        $penanggungjawab = $kolom8;
                        if($rencana_penanganan == ''){
                            $waktu_pelaksanaan_rencana = '';
                            $penanggungjawab = '';
                        }
                     }


                    if (!$this->penangananRisikoModel->where(['id_risiko' => $kolom1[1], 'id_status_persetujuan' => 2])->get()->getRowArray()) {
                        continue;
                    }

                    
                    if (!$this->levelKemungkinanModel->where('id',$id_level_kemungkinan_pemantauan)->get()->getRowArray() OR !$this->levelDampakModel->where('id',$id_level_dampak_pemantauan)->get()->getRowArray()) {
                        continue;
                    }

                    $multiClause = array('id_level_kemungkinan' => $id_level_kemungkinan_pemantauan, 'id_level_dampak' => $id_level_dampak_pemantauan); 
                    $multiClause2 = array('id_kategori_risiko' => $risiko[0]['id_kategori_risiko'], 'id_jenis_risiko' => $risiko[0]['id_jenis_risiko'], 'id_upr' => session()->id_upr, 'id_status_persetujuan' => 2);

                    $matriksRisiko = $this->matriksRisikoModel->where($multiClause)->get()->getRowArray();
                    $besaranRisiko = $matriksRisiko['besaran_risiko'];
                    $multiClause3 = array('rentang_min <=' => $besaranRisiko, 'rentang_maks >=' => $besaranRisiko);

                    $levelRisiko = $this->levelRisikoModel->where($multiClause3)->get()->getRowArray();

                    $seleraRisiko = $this->seleraRisikoModel->where($multiClause2)->get()->getRowArray();
                    $besaranRisikoMin = $seleraRisiko['besaran_risiko_min'];

                    $kriteria_dampak_pemantauan = $this->kriteriaDampakModel->where(['id_area_dampak'=>$risiko[0]['id_area_dampak'],'id_level_dampak' => $id_level_dampak_pemantauan, 'id_jenis_risiko' => $risiko[0]['id_jenis_risiko'], 'id_upr'=> session()->id_upr])->get()->getRowArray();
                    $kriteria_kemungkinan_pemantauan = $this->kriteriaKemungkinanModel->where(['id_kategori_risiko'=> $risiko[0]['id_kategori_risiko'], 'id_level_kemungkinan'=>$id_level_kemungkinan_pemantauan, 'id_upr'=>session()->id_upr])->get()->getRowArray();

                    switch ($jenis_laporan) {
                        case 'triwulan':
                            $periode = 'triwulan';
                            break;
                        case 'bulanan':
                            $periode = 'bulan';
                            break;
                        case 'semesteran':
                            $periode = 'semester';
                            break;
                        default:
                            $periode = '';
                            break;
                    }

                    if ($besaranRisiko >=$besaranRisikoMin) {
                        $str="Besaran risiko ini masih berada di atas selera risiko SPBE.";
                    } else{
                        $str="Besaran risiko ini sudah berada di bawah selera risiko SPBE.";
                    }

                    if ($jenis_laporan=='triwulan' OR $jenis_laporan=='bulanan' OR $jenis_laporan=='semesteran') {
                        $deskripsi= 'Risiko SPBE pada awal tahun berada pada Level Risiko SPBE "'.$risiko[0]['level_risiko'].'" dengan Besaran Risiko SPBE sebesar '.$risiko[0]['besaran_risiko'].'. '.' <br><br> Risiko SPBE tersebut pada '.$periode.' ini  berada pada Level Risiko SPBE "'.$levelRisiko['level_risiko'].'" dengan Besaran Risiko SPBE sebesar '.$besaranRisiko.'. '.$str;
                    } else {
                        $deskripsi= 'Risiko SPBE pada awal tahun berada pada Level Risiko SPBE "'.$risiko[0]['level_risiko'].'" dengan Besaran Risiko SPBE sebesar '.$risiko[0]['besaran_risiko'].'.'.' <br><br> Secara umum Setelah dilakukan pemantauan selama satu tahun risiko SPBE berada pada  level risiko "'.$levelRisiko['level_risiko'].'" dengan besaran risiko SPBE sebesar '.$besaranRisiko.'. '.$str;
                    }
                    

                    

                    //insert data
                    $this->pemantauanRisikoModel->insert([
                        'id_risiko' => $risiko[0]['id'],
                        'id_penanganan_risiko' => $penanganan_risiko['id'],
                        'id_level_kemungkinan_pemantauan' => $id_level_kemungkinan_pemantauan,
                        'id_level_dampak_pemantauan' => $id_level_dampak_pemantauan,
                        'jenis_laporan' => $jenis_laporan,
                        'periode_laporan' => $periode_laporan,
                        'deskripsi_risiko_saat_ini' => $deskripsi,
                        'rekomendasi' => $rekomendasi,
                        'rencana_penanganan' => $rencana_penanganan,
                        'penanggungjawab' => $penanggungjawab,
                        'waktu_pelaksanaan_rencana' => $waktu_pelaksanaan_rencana,
                        'id_status_persetujuan' => 1
                    ]);

                    $suksesImport++;

                }

            } else {
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Gagal import data, periksa kembali file excel Anda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';

                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
            }

            $pesan = '';
            $alert = 'success';
            if ($suksesImport == 0) {
                $pesan = 'Periksa kembali data dalam file excel Anda.';
                $alert = 'danger';
            }
            $flash = '<div class="alert alert-'.$alert .' alert-dismissible fade show" role="alert">
                                    Jumlah baris data excel yang berhasil di-import adalah '.$suksesImport. ' baris. '.$pesan.
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('pengelolaRisiko/pemantauanRisiko'));

        }

        $data = [
            'title'     => 'Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Import Laporan Pemantauan Risiko SPBE (5.0)',
            'subsubtitle'  => '',
            'script' => 'pengelola-risiko',
            'active' => 'Pemantauan Risiko SPBE',
            'link'  => 'pemantauanRisiko',
            'sublink' => 'pemantauanRisiko',
            'template' => 'pemantauan_risiko.xlsx',
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

        return view('PengelolaRisiko/form-import' , $data);
    } 


    public function updatePemantauanRisiko($id=null, $id_risiko=null, $id_level_kemungkinan=null, $id_level_dampak=null, $besaranRisiko=null, $levelRisiko=null, $besaranRisikoMin=null, $ganti_besaran_risiko=null){

        $pemantauan_risiko = $this->pemantauanRisikoModel->find($id);
        if ($ganti_besaran_risiko=='true') {
            $risiko = $this->penilaianRisikoModel->getPenilaianById($id_risiko);
        } else {
            $risiko = $this->penilaianRisikoModel->getPenilaianById($pemantauan_risiko['id_risiko']);
        }
        $kriteria_dampak_pemantauan = null;
        $kriteria_kemungkinan_pemantauan = null;
        $levelKemungkinanPemantauan = null;
        $levelDampakPemantauan = null;
        if ($ganti_besaran_risiko=='true') {
            $kriteria_dampak_pemantauan = $this->kriteriaDampakModel->where(['id_area_dampak'=>$risiko[0]['id_area_dampak'],'id_level_dampak' => $id_level_dampak, 'id_jenis_risiko' => $risiko[0]['id_jenis_risiko'], 'id_upr'=> session()->id_upr])->get()->getRowArray();

            $kriteria_kemungkinan_pemantauan = $this->kriteriaKemungkinanModel->where(['id_kategori_risiko'=> $risiko[0]['id_kategori_risiko'], 'id_level_kemungkinan'=>$id_level_kemungkinan, 'id_upr'=>session()->id_upr])->get()->getRowArray();

            $levelKemungkinanPemantauan = $this->levelKemungkinanModel->where('id',$id_level_kemungkinan)->get()->getRowArray();
            $levelDampakPemantauan = $this->levelDampakModel->where('id',$id_level_dampak)->get()->getRowArray();
            
        }

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Mengedit Laporan Pemantauan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
            'tipe_halaman' => 'edit',
            'pemantauan_risiko' => $pemantauan_risiko,
            'risiko' => $risiko,
            'levelKemungkinanPemantauan' => $levelKemungkinanPemantauan,
            'levelDampakPemantauan' => $levelDampakPemantauan,
            'levelRisikoPemantauan' => $levelRisiko,
            'besaranRisikoPemantauan' => $besaranRisiko,
            'besaranRisikoMin' => $besaranRisikoMin,
            'kriteria_kemungkinan_pemantauan' => $kriteria_kemungkinan_pemantauan ,
            'kriteria_dampak_pemantauan' => $kriteria_dampak_pemantauan,
            'levelKemungkinan' => $this->levelKemungkinanModel->where('id',$pemantauan_risiko['id_level_kemungkinan_pemantauan'])->get()->getRowArray(),
            'levelDampak' => $this->levelDampakModel->where('id',$pemantauan_risiko['id_level_dampak_pemantauan'])->get()->getRowArray(),
            'ganti_besaran_risiko' => $ganti_besaran_risiko,
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

        if(isset($_POST['submit'])){
            $level_kemungkinan = $this->levelKemungkinanModel->where('level_kemungkinan',$this->request->getPost('level_kemungkinan'))->get()->getRowArray();
            $level_dampak = $this->levelDampakModel->where('level_dampak',$this->request->getPost('level_dampak'))->get()->getRowArray();


            $jenis_laporan = explode(' ', $pemantauan_risiko['jenis_laporan']);
            if ($jenis_laporan[0]=='tahunan') {
                $periode_laporan = '';
                $waktu_pelaksanaan_rencana='';
            } else {
                $periode_laporan = $this->request->getPost('periode_laporan').' '. strval(date('Y'));
                if($this->request->getPost('rencana_penanganan') == ''){
                    $waktu_pelaksanaan_rencana = '';
                    $penanggungjawab ='';
                } else {
                    $waktu_pelaksanaan_rencana = $this->request->getPost('waktu_pelaksanaan_rencana').' '. strval(date('Y'));
                    $penanggungjawab = $this->request->getPost('penanggungjawab');
                }
            }


            $this->pemantauanRisikoModel
            ->set('id_level_kemungkinan_pemantauan' , $level_kemungkinan['id'])
            ->set('id_level_dampak_pemantauan' , $level_dampak['id'])
            ->set('periode_laporan' , $periode_laporan)
            ->set('deskripsi_risiko_saat_ini' , $this->request->getPost('deskripsi'))
            ->set('rekomendasi' , $this->request->getPost('rekomendasi'))
            ->set('rencana_penanganan' ,$this->request->getPost('rencana_penanganan'))
            ->set('penanggungjawab' , $penanggungjawab)
            ->set('waktu_pelaksanaan_rencana' , $waktu_pelaksanaan_rencana)
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Laporan pemantauan risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('pengelolaRisiko/pemantauanRisiko'));
        }
        return view('PengelolaRisiko/form-edit-pemantauan-risiko' , $data);
    }

    public function detailRisikoPemantauan($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'pengelola-risiko',
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

        return view('PengelolaRisiko/detail-risiko' , $data);

    }

    public function detailRencanaPenanganan($id){

        $rencana_penanganan = $this->penangananRisikoModel->find($id);
        $opsi_penanganan = $this->opsiPenangananModel->where('id',$rencana_penanganan['id_opsi_penanganan'])->get()->getRowArray();
        $status_persetujuan = $this->statusPersetujuanModel->find($rencana_penanganan['id_status_persetujuan']);

        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subtitle'  => 'Detail Rencana Penanganan Risiko SPBE',
            'script'    => 'pengelola-risiko',
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

        return view('PengelolaRisiko/detail-rencana-penanganan' , $data);

    }

    public function detailLaporanPemantauan($id){

        $pemantauan = $this->pemantauanRisikoModel->getPemantauanById($id);
        $risiko = $this->penilaianRisikoModel->getPenilaianById($pemantauan[0]['id_risiko']);

        if ($pemantauan[0]['jenis_laporan']=='bulanan') {
            $daftarPemantauan = $this->pemantauanRisikoModel->where(['id_risiko'=>$pemantauan[0]['id_risiko'], 'jenis_laporan'=>'bulanan', 'id <' => $id,  ])->get()->getResultArray();
        } elseif ($pemantauan[0]['jenis_laporan']=='triwulan') {
            $daftarPemantauan = $this->pemantauanRisikoModel->where(['id_risiko'=>$pemantauan[0]['id_risiko'], 'jenis_laporan'=>'triwulan', 'id <' => $id,  ])->get()->getResultArray();
        } elseif ($pemantauan[0]['jenis_laporan']=='semesteran') {
            $daftarPemantauan = $this->pemantauanRisikoModel->where(['id_risiko'=>$pemantauan[0]['id_risiko'], 'jenis_laporan'=>'semesteran', 'id <' => $id,  ])->get()->getResultArray();
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
            'script'    => 'pengelola-risiko',
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
        
        return view('PengelolaRisiko/detail-pemantauan' , $data);

    }

    public function hapusPemantauanRisiko($id = null)
    {
        $risiko_upr = $this->penilaianRisikoModel->select('id')->where('id_upr',session()->id_upr)->get()->getResultArray();
        if ($id==null) {
            $delete = $this->pemantauanRisikoModel->whereIn('id_risiko', $risiko_upr[0])->delete();
        } else {
            $delete = $this->pemantauanRisikoModel->where('id', $id)->delete();
        }
        

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/pemantauanRisiko'));
        
    }

    //Melihat deatil persetujuan
    public function detailPersetujuanPemantauanRisiko($id){

        $pemantauanRisiko = $this->pemantauanRisikoModel->find($id);
        $status = $this->statusPersetujuanModel->where('id',$pemantauanRisiko['id_status_persetujuan'])->get()->getRowArray();
        
        $data = [
            'title'     => 'Laporan Pemantauan Risiko SPBE (5.0)',
            'subsubtitle' => '',
            'subtitle'  => 'Detail Persetujuan',
            'script'    => 'pengelola-risiko',
            'active'    => 'Pemantauan Risiko SPBE',
            'link'      => 'pemantauanRisiko',
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
            'penilaianRisiko' => $this->penilaianRisiko,
            'kategoriRisikoTerpilih' => $this->kategoriRisikoTerpilih,
            'penangananRisiko' => $this->penangananRisiko
        ];

        return view('PengelolaRisiko/detail-persetujuan' , $data);
    }


    public function downloadTemplateExcel($namaFile){
        // $data = file_get_contents(base_url('/public/Template_Excel/' . $namaFile));
        return $this->response->download(FCPATH.'public/Template_Excel/'.$namaFile, null);
        
    }

    

}  