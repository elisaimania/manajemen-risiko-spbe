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


    }

// Menampilkan dashboard
    public function dashboard(){

    	$data = [
            'title'     => 'Dashboard',
            'subtitle'  =>  '',
            'script'    => 'pengelola-risiko',
            'active'    => 'Dashboard',
            'link'      => 'dashboard'
        ];

    	return view('PengelolaRisiko/dashboard',$data);
        
    }

//Menampilkan halaman penentapan konteks
    public function penetapanKonteks(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  =>  '',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PengelolaRisiko/penetapan-konteks',$data);
    }

//Menampilkan halaman penilaian risiko yang berisi tabel hasil penilaian risiko
    public function penilaianRisiko(){


        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  =>  '',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko'
        ];

        return view('PengelolaRisiko/penilaian-risiko',$data);
    }

//Menampilkan halaman penanganan risiko yang berisi tabel risiko yang telah ditangani
    public function penangananRisiko(){

        $data = [
            'title'     => 'Penanganan Risiko SPBE (4.0)',
            'subtitle'  =>  '',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko'
        ];

        return view('PengelolaRisiko/penanganan-risiko', $data);
    }

    public function informasiUmum(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PengelolaRisiko/informasi-umum',$data);
    }

    public function getInformasiUmum(){

        return $this->respond($this->informasiUmumModel->where('id_upr', session()->id_upr)->getInfoUmum());

    }

    public function inputInformasiUmum()
    {
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
                'nama_UPR' => $this->request->getPost('nama_UPR'),
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
            'sublink' => 'informasiUmum'
        ];

        return view('PengelolaRisiko/form-informasi-umum' , $data);
    }

//Menambah data informasi umum dengan melakukan import file excel
    // public function importInformasiUmum(){

    //     $file = $this->request->getFile('fileexcel');
    //     if($file){
    //         $excelReader  = new PHPExcel();
    //         //mengambil lokasi temp file
    //         $fileLocation = $file->getTempName();
    //         //baca file
    //         $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
    //         //ambil sheet active
    //         $sheet  = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    //         //looping untuk mengambil data
    //         foreach ($sheet as $idx => $data) {
    //             //skip index 1 karena title excel
    //             if($idx==1){
    //                 continue;
    //             }
    //             $nama = $data['A'];
    //             $hp = $data['B'];
    //             $email = $data['C'];
    //             // insert data
    //             $this->contact->insert([
    //                 'nama'=>$nama,
    //                 'handphone'=>$hp,
    //                 'email'=>$email
    //             ]);
    //         }
    //     }
    //     session()->setFlashdata('message','Berhasil import excel');
    //     return redirect()->to('/home');
    // }

    // }

    public function updateInformasiUmum($id=null){

        $informasiUmum = $this->informasiUmumModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Inventarisasi Informasi Umum (2.1)',
            'subsubtitle' => 'Edit Informasi Umum (2.1)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'informasiUmum' => $informasiUmum,
            'sublink' => 'informasiUmum'
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
            ->set('nama_UPR' , $this->request->getPost('nama_UPR'))
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
        
        $delete = $this->informasiUmumModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Informasi umum berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/informasiUmum'));
        
    }

    public function sasaranSPBE(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PengelolaRisiko/sasaran-SPBE',$data);
    }

    public function getDaftarSasaranSPBE(){

        return $this->respond($this->sasaranSPBEModel->where('id_upr',session()->id_upr)->getSasaranSPBE());

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
            'sublink' => 'sasaranSPBE'
        ];

        return view('PengelolaRisiko/form-sasaran-SPBE' , $data);
    }

    public function updateSasaranSPBE($id=null){

        $sasaranSPBE = $this->sasaranSPBEModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Sasaran SPBE (2.2)',
            'subsubtitle' => 'Edit Sasaran SPBE (2.2)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sasaranSPBE' => $sasaranSPBE,
            'sublink' => 'sasaranSPBE'
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
        
        $delete = $this->sasaranSPBEModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/sasaranSPBE'));
        
    }

    public function strukturPelaksana(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
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
            'role' => $role
        ];

        return view('PengelolaRisiko/form-struktur-pelaksana' , $data);
    }

    public function updateStrukturPelaksana($id=null){

        $strukturPelaksana = $this->strukturPelaksanaModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penentuan Struktur Pelaksana (2.3)',
            'subsubtitle' => 'Edit Struktur Pelaksana (2.3)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'strukturPelaksana' => $strukturPelaksana,
            'role' => $this->roleModel->findAll(),
            'sublink' => 'strukturPelaksana'
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
        
        $delete = $this->strukturPelaksanaModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/strukturPelaksana'));
        
    }

    public function pemangkuKepentingan(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
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

        $role = $this->roleModel->findAll();
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Tambah Pemangku Kepentingan (2.4)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'sublink' => 'pemangkuKepentingan'
        ];

        return view('PengelolaRisiko/form-pemangku-kepentingan' , $data);
    }

    public function updatePemangkuKepentingan($id=null){

        $pemangkuKepentingan = $this->pemangkuKepentinganModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Pemangku Kepentingan (2.4)',
            'subsubtitle' => 'Edit Pemangku Kepentingan (2.4)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'pemangkuKepentingan' => $pemangkuKepentingan,
            'sublink' => 'pemangkuKepentingan'
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
        
        $delete = $this->pemangkuKepentinganModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/pemangkuKepentingan'));
        
    }

    public function peraturanPerundangan(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
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
            'sublink' => 'peraturanPerundangan'
        ];

        return view('PengelolaRisiko/form-peraturan-perundangan' , $data);
    }

    public function updatePeraturanPerundangan($id=null){

        $peraturanPerundangan = $this->peraturanPerundanganModel->find($id);

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Identifikasi Peraturan Perundang-undangan (2.5)',
            'subsubtitle' => 'Edit Peraturan Perundang-undangan (2.5)',
            'script' => 'pengelola-risiko',
            'active' => 'Penetapan Konteks Risiko SPBE',
            'link'  => 'penetapanKonteks',
            'peraturanPerundangan' => $peraturanPerundangan,
            'sublink' => 'peraturanPerundangan'
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
        
        $delete = $this->peraturanPerundanganModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/peraturanPerundangan'));
        
    }

    public function kategoriRisikoTerpilih(){

        $kategoriRisiko = $this->kategoriRisikoModel->findAll();
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'kategoriRisiko' => $kategoriRisiko
        ];

        return view('PengelolaRisiko/penetapan-kategori',$data);
    }

    public function getDaftarKategoriRisikoTerpilih(){

        return $this->respond($this->kategoriRisikoTerpilihModel->where('id_upr',session()->id_upr)->getKategoriRisikoTerpilih());

    }

    public function inputKategoriRisikoTerpilih()
    {
        if(isset($_POST['tambah'])){

            $kategoriTerpilih = $this->kategoriRisikoModel->where('kategori_risiko',$this->request->getPost('kategori_risiko'))->get()->getRowArray();

            $cek_id = $this->kategoriRisikoTerpilihModel->where('id',$kategoriTerpilih['id'])->get()->getRowArray();


            if($cek_id){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Kategori risiko "'.$kategoriTerpilih['kategori_risiko'].'" telah dipilih sebelumnya. Pilih kategori risiko yang lain!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/inputKategoriRisikoTerpilih'));

            }


            $inputData = [
                'id' => $kategoriTerpilih['id'],
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->kategoriRisikoTerpilihModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kategori risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $kategoriRisiko = $this->kategoriRisikoModel->findAll();
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kategori Risiko SPBE (2.6)',
            'subsubtitle' => 'Tambah Kategori Risiko SPBE (2.6)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kategoriRisikoTerpilih',
            'kategoriRisiko' => $kategoriRisiko
        ];

         return view('PengelolaRisiko/form-penetapan-kategori',$data);
    }

    public function hapusKategoriRisikoTerpilih($id = null)
    {
        
        $delete = $this->kategoriRisikoTerpilihModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/kategoriRisikoTerpilih'));
        
    }

    public function areaDampakRisikoTerpilih(){

        $areaDampak = $this->areaDampakRisikoModel->findAll();
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'areaDampak' => $areaDampak
        ];

        return view('PengelolaRisiko/penetapan-area-dampak',$data);
    }

    public function getDaftarAreaDampakRisikoTerpilih(){

        return $this->respond($this->areaDampakRisikoTerpilihModel->where('id_upr', session()->id_upr)->getAreaDampakRisikoTerpilih());

    }

    public function inputAreaDampakRisikoTerpilih()
    {
        if(isset($_POST['tambah'])){

            $areaDampakTerpilih = $this->areaDampakRisikoModel->where('area_dampak',$this->request->getPost('area_dampak'))->get()->getRowArray();

            $cek_id = $this->areaDampakRisikoTerpilihModel->where('id',$areaDampakTerpilih['id'])->get()->getRowArray();


            if($cek_id){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Area dampak risiko "'.$areaDampakTerpilih['area_dampak'].'" telah dipilih sebelumny. Pilih kategori risiko yang lain!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
                $flash = session()->setFlashdata('flash', $flash);
                return redirect()->to(base_url('pengelolaRisiko/inputAreaDampakRisikoTerpilih'));

            }

            $inputData = [
                'id' => $areaDampakTerpilih['id'],
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->areaDampakRisikoTerpilihModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Area dampak risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $areaDampak = $this->areaDampakRisikoModel->findAll();
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Area Dampak Risiko SPBE (2.7)',
            'subsubtitle' => 'Tambah Area Dampak Risiko SPBE (2.7)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'areaDampakRisikoTerpilih',
            'areaDampak' => $areaDampak
        ];

         return view('PengelolaRisiko/form-penetapan-area-dampak',$data);
    }

    public function hapusAreaDampakRisikoTerpilih($id = null)
    {
        
        $delete = $this->areaDampakRisikoTerpilihModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/areaDampakRisikoTerpilih'));
        
    }

    public function kriteriaRisiko(){


        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PengelolaRisiko/penetapan-kriteria',$data);
    }

    public function getDaftarKriteriaKemungkinan(){

        return $this->respond($this->kriteriaKemungkinanModel->where('id_upr', session()->id_upr)->getKriteriaKemungkinan());

    }

    public function getDaftarKriteriaDampak(){

        return $this->respond($this->kriteriaDampakModel->where('id_upr', session()->id_upr)->getKriteriaDampak());

    }

    public function inputKriteriaKemungkinan()
    {
        if(isset($_POST['tambah'])){

            $rules =[
                'id_kategori_risiko' => 'is_unique[kriteria_kemungkinan_risiko_spbe.id_kategori_risiko]'
            ];

            $errors = [
                'id_kategori_risiko'=> [
                    'is_unique' => 'Kriteria kemungkinan risiko untuk kategori risiko ini telah lengkap. Pilih jenis risiko yang lain']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }


            $levelKemungkinan = $this->levelKemungkinanModel->findAll();

            $inputData1 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_level_kemungkinan' => $levelKemungkinan[0]['id'],
                'presentase_kemungkinan' => strtoupper($this->request->getPost('presentase_kemungkinan1')),
                'jumlah_frekuensi' => $this->request->getPost('jumlah_frekuensi1'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $inputData2 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_level_kemungkinan' => $levelKemungkinan[1]['id'],
                'presentase_kemungkinan' => strtoupper($this->request->getPost('presentase_kemungkinan2')),
                'jumlah_frekuensi' => $this->request->getPost('jumlah_frekuensi2'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $inputData3 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_level_kemungkinan' => $levelKemungkinan[2]['id'],
                'presentase_kemungkinan' => strtoupper($this->request->getPost('presentase_kemungkinan3')),
                'jumlah_frekuensi' => $this->request->getPost('jumlah_frekuensi3'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $inputData4 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_level_kemungkinan' => $levelKemungkinan[3]['id'],
                'presentase_kemungkinan' => strtoupper($this->request->getPost('presentase_kemungkinan4')),
                'jumlah_frekuensi' => $this->request->getPost('jumlah_frekuensi4'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $inputData5 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_level_kemungkinan' => $levelKemungkinan[4]['id'],
                'presentase_kemungkinan' => strtoupper($this->request->getPost('presentase_kemungkinan5')),
                'jumlah_frekuensi' => $this->request->getPost('jumlah_frekuensi5'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ];

            $this->kriteriaKemungkinanModel->insert($inputData1);
            $this->kriteriaKemungkinanModel->insert($inputData2);
            $this->kriteriaKemungkinanModel->insert($inputData3);
            $this->kriteriaKemungkinanModel->insert($inputData4);
            $this->kriteriaKemungkinanModel->insert($inputData5);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kriteria kemungkinan risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->getKategoriRisikoTerpilih();
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
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan
        ];

         return view('PengelolaRisiko/form-kriteria-kemungkinan',$data);
    }

    public function updateKriteriaKemungkinan($id=null){

        $kriteriaKemungkinan = $this->kriteriaKemungkinanModel->where('id_kategori_risiko',$id)->get()->getResultArray();
        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->getKategoriRisikoTerpilih();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Penetapan Kriteria Risiko SPBE (2.8)',
            'subsubtitle' => 'Edit Kriteria Kemungkinan Risiko SPBE (2.8A)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks',
            'sublink'   => 'kriteriaRisiko',
            'kriteriaKemungkinan' => $kriteriaKemungkinan,
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarLevelKemungkinan' => $daftarLevelKemungkinan
        ];

        if(isset($_POST['submit'])){

            $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko',$this->request->getPost('kategori_risiko'))->get()->getRowArray();

            $levelKemungkinan = $this->levelKemungkinanModel->findAll();
            
            $this->kriteriaKemungkinanModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_level_kemungkinan' , $levelKemungkinan[0]['id'])
            ->set('presentase_kemungkinan' , strtoupper($this->request->getPost('presentase_kemungkinan1')))
            ->set('jumlah_frekuensi' , $this->request->getPost('jumlah_frekuensi1'))
            ->where('id' , $kriteriaKemungkinan[0]['id'])
            ->update();

            $this->kriteriaKemungkinanModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_level_kemungkinan' , $levelKemungkinan[1]['id'])
            ->set('presentase_kemungkinan' , strtoupper($this->request->getPost('presentase_kemungkinan2')))
            ->set('jumlah_frekuensi' , $this->request->getPost('jumlah_frekuensi2'))
            ->where('id' , $kriteriaKemungkinan[1]['id'])
            ->update();

            $this->kriteriaKemungkinanModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_level_kemungkinan' , $levelKemungkinan[2]['id'])
            ->set('presentase_kemungkinan' , strtoupper($this->request->getPost('presentase_kemungkinan3')))
            ->set('jumlah_frekuensi' , $this->request->getPost('jumlah_frekuensi3'))
            ->where('id' , $kriteriaKemungkinan[2]['id'])
            ->update();

            $this->kriteriaKemungkinanModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_level_kemungkinan' , $levelKemungkinan[3]['id'])
            ->set('presentase_kemungkinan' , strtoupper($this->request->getPost('presentase_kemungkinan4')))
            ->set('jumlah_frekuensi' , $this->request->getPost('jumlah_frekuensi4'))
            ->where('id' , $kriteriaKemungkinan[3]['id'])
            ->update();

            $this->kriteriaKemungkinanModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_level_kemungkinan' , $levelKemungkinan[4]['id'])
            ->set('presentase_kemungkinan' , strtoupper($this->request->getPost('presentase_kemungkinan5')))
            ->set('jumlah_frekuensi' , $this->request->getPost('jumlah_frekuensi5'))
            ->where('id' , $kriteriaKemungkinan[4]['id'])
            ->update();

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

    public function hapusKriteriaKemungkinan($id = null)
    {
        
        $delete = $this->kriteriaKemungkinanModel->where('id_kategori_risiko', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
        
    }

    public function inputKriteriaDampak()
    {
        if(isset($_POST['tambah'])){

            $rules =[
                'id_area_dampak' => 'is_unique[kriteria_dampak_risiko_spbe.id_area_dampak]'
            ];

            $errors = [
                'id_area_dampak'=> [
                    'is_unique' => 'Kriteria kemungkinan risiko untuk kategori risiko ini telah lengkap. Pilih jenis risiko yang lain']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }


            $levelDampak = $this->levelDampakModel->findAll();

            $jenisRisiko = $this->jenisRisikoModel->findAll();


            $inputData = [[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[0]['id'],
                'id_level_dampak' => $levelDampak[0]['id'],
                'penjelasan' => $this->request->getPost('penjelasan1'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[0]['id'],
                'id_level_dampak' => $levelDampak[1]['id'],
                'penjelasan' => $this->request->getPost('penjelasan2'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[0]['id'],
                'id_level_dampak' => $levelDampak[2]['id'],
                'penjelasan' => $this->request->getPost('penjelasan3'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[0]['id'],
                'id_level_dampak' => $levelDampak[3]['id'],
                'penjelasan' => $this->request->getPost('penjelasan4'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[0]['id'],
                'id_level_dampak' => $levelDampak[4]['id'],
                'penjelasan' => $this->request->getPost('penjelasan5'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[1]['id'],
                'id_level_dampak' => $levelDampak[0]['id'],
                'penjelasan' => $this->request->getPost('penjelasan6'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[1]['id'],
                'id_level_dampak' => $levelDampak[1]['id'],
                'penjelasan' => $this->request->getPost('penjelasan7'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[1]['id'],
                'id_level_dampak' => $levelDampak[2]['id'],
                'penjelasan' => $this->request->getPost('penjelasan8'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[1]['id'],
                'id_level_dampak' => $levelDampak[3]['id'],
                'penjelasan' => $this->request->getPost('penjelasan9'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ],[
                'id_area_dampak' => $this->request->getPost('id_area_dampak'),
                'id_jenis_risiko' => $jenisRisiko[1]['id'],
                'id_level_dampak' => $levelDampak[4]['id'],
                'penjelasan' => $this->request->getPost('penjelasan10'),
                'id_upr' => session()->id_upr,
                'id_status_persetujuan' => 1
            ]];

            for ($i=0; $i < sizeof($inputData) ; $i++) { 

                $this->kriteriaDampakModel->insert($inputData[$i]);
            }

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kriteria dampak risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->getAreaDampakRisikoTerpilih();
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
            'daftarLevelDampak' => $daftarLevelDampak
        ];

         return view('PengelolaRisiko/form-kriteria-dampak',$data);
    }

    public function updateKriteriaDampak($id=null){

        $kriteriaDampak = $this->kriteriaDampakModel->where('id_area_dampak',$id)->get()->getResultArray();
        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->getAreaDampakRisikoTerpilih();
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
            'kriteriaDampak' => $kriteriaDampak,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'daftarAreaDampak' => $daftarAreaDampak,
            'daftarLevelDampak' => $daftarLevelDampak
        ];

        if(isset($_POST['submit'])){

            $levelDampak = $this->levelDampakModel->findAll();

            $jenisRisiko = $this->jenisRisikoModel->findAll();

            $k = 0;
            $l = 0;
        for ($i=0; $i < 2 ; $i++) { 
            for ($j=0; $j < 5 ; $j++) { 

                $k += 1;
                $this->kriteriaDampakModel
                ->set('id_area_dampak' , $this->request->getPost('id_area_dampak'))
                ->set('id_jenis_risiko' , $jenisRisiko[$i]['id'])
                ->set('id_level_dampak' , $levelDampak[$j]['id'])
                ->set('penjelasan' , $this->request->getPost('penjelasan'.strval($k)))
                ->where('id' , $kriteriaDampak[$l]['id'])
                ->update();
                $l += 1;
            }
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

    public function hapusKriteriaDampak($id = null)
    {
        
        $delete = $this->kriteriaDampakModel->where('id_area_dampak', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/kriteriaRisiko'));
        
    }

    public function matriksLevelRisiko(){

        $data = [
            'title'     => 'Penetapan Konteks Risiko SPBE (2.0)',
            'subtitle'  => 'Matriks Analisis dan Level Risiko SPBE (2.9)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
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
            'script'    => 'pengelola-risiko',
            'active'    => 'Penetapan Konteks Risiko SPBE',
            'link'      => 'penetapanKonteks'
        ];

        return view('PengelolaRisiko/selera-risiko',$data);
    }

    public function getSeleraRisiko(){

        return $this->respond($this->seleraRisikoModel->orderBy('id','ASC')->where('id_upr',session()->id_upr)->getSelera());
    }

    public function inputSeleraRisiko()
    {
        if(isset($_POST['tambah'])){


            $jenisRisiko1 = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko1'))->get()->getRowArray();
            $jenisRisiko2 = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko2'))->get()->getRowArray();


           $rules =[
                'id_kategori_risiko' => 'is_unique[selera_risiko_spbe.id_kategori_risiko]'
            ];

            $errors = [
                'id_kategori_risiko'=> [
                    'is_unique' => 'Selera risiko untuk kategori risiko ini telah lengkap. Pilih jenis risiko yang lain']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }
            
            $inputData1 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_jenis_risiko' => $jenisRisiko1['id'],
                'besaran_risiko_min' => $this->request->getPost('besaran_risiko_min1'),
                'id_status_persetujuan' => 1
            ];

            $inputData2 = [
                'id_kategori_risiko' => $this->request->getPost('id_kategori_risiko'),
                'id_jenis_risiko' => $jenisRisiko2['id'],
                'besaran_risiko_min' => $this->request->getPost('besaran_risiko_min2'),
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

        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->getKategoriRisikoTerpilih();
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
            'besaranRisiko' => $besaranRisiko
        ];

         return view('PengelolaRisiko/form-selera-risiko',$data);
    }

    public function updateSeleraRisiko($id=null){

        $seleraRisiko = $this->seleraRisikoModel->where('id_kategori_risiko',$id)->get()->getResultArray();
        $daftarKategoriRisiko = $this->kategoriRisikoTerpilihModel->getKategoriRisikoTerpilih();
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
            'seleraRisiko' => $seleraRisiko,
            'daftarKategoriRisiko' => $daftarKategoriRisiko,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'besaranRisiko' => $besaranRisiko
        ];

        if(isset($_POST['submit'])){

            $jenisRisiko = $this->jenisRisikoModel->findAll();

            $matriksRisiko1 = $this->matriksRisikoModel->where('besaran_risiko',$this->request->getPost('besaran_risiko_min1'))->get()->getRowArray();

            $this->seleraRisikoModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_jenis_risiko'  , $jenisRisiko[0]['id'])
            ->set('besaran_risiko_min' , $this->request->getPost('besaran_risiko_min1'))
            ->where('id' , $seleraRisiko[0]['id'])
            ->update();

            $this->seleraRisikoModel
            ->set('id_kategori_risiko' , $this->request->getPost('id_kategori_risiko'))
            ->set('id_jenis_risiko'  , $jenisRisiko[1]['id'])
            ->set('besaran_risiko_min' , $this->request->getPost('besaran_risiko_min2'))
            ->where('id' , $seleraRisiko[1]['id'])
            ->update();

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

    public function hapusSeleraRisiko($id = null)
    {
        
        $delete = $this->seleraRisikoModel->where('id_kategori_risiko', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/seleraRisiko'));
        
    }


    public function getPenilaianRisiko(){

        return $this->respond($this->penilaianRisikoModel->getPenilaian());

    }

    public function detailRisiko($id){

        $risiko = $this->penilaianRisikoModel->getPenilaianById($id);

        $data = [
            'title'     => 'Penilaian Risiko SPBE (3.0)',
            'subtitle'  => 'Detail Risiko SPBE',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penilaian Risiko SPBE',
            'link'      => 'penilaianRisiko',
            'risiko' => $risiko
        ];

        return view('PengelolaRisiko/detail-risiko' , $data);

    }

    public function inputPenilaianRisiko()
    {
        if(isset($_POST['tambah'])){

            $areaDampak = $this->areaDampakRisikoModel->where('area_dampak',$this->request->getPost('area_dampak'))->get()->getRowArray();

            $levelDampak = $this->levelDampakModel->where('level_dampak',$this->request->getPost('level_dampak'))->get()->getRowArray();

            $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko'))->get()->getRowArray();

            $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko',$this->request->getPost('kategori_risiko'))->get()->getRowArray();

            $indikatorKinerja = $this->sasaranSPBEModel->where('indikator_kinerja_SPBE',$this->request->getPost('indikator_kinerja_SPBE'))->get()->getRowArray();

            $levelKemungkinan = $this->levelKemungkinanModel->where('level_kemungkinan',$this->request->getPost('level_kemungkinan'))->get()->getRowArray();

            $multiClause = array('id_level_kemungkinan' => $levelKemungkinan['id'], 'id_level_dampak' => $levelDampak['id']);
            $multiClause2 = array('id_kategori_risiko' => $kategoriRisiko['id'], 'id_jenis_risiko' => $jenisRisiko['id']);

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
                'id_kategori_risiko' => $kategoriRisiko['id'],
                'dampak' => $this->request->getPost('dampak'),
                'id_area_dampak' => $areaDampak['id'],
                'sistem_pengendalian' => $this->request->getPost('sistem_pengendalian'),
                'id_level_kemungkinan' => $levelKemungkinan['id'],
                'id_level_dampak' => $levelDampak['id'],
                'id_level_risiko' => $levelRisiko['id'],
                'id_keputusan' => $id_keputusan,
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

        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->getAreaDampakRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $daftarLevelDampak = $this->levelDampakModel->findAll();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        $daftarKategoriRisiko = $this->kategoriRisikoModel->findAll();
        $daftarIndikatorKinerja = $this->sasaranSPBEModel->findAll();
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
            'daftarIndikatorKinerja' => $daftarIndikatorKinerja
        ];

         return view('PengelolaRisiko/form-penilaian-risiko',$data);
    }

    public function updatePenilaianRisiko($id=null){

        $risiko = $this->penilaianRisikoModel->find($id);
        $daftarAreaDampak = $this->areaDampakRisikoTerpilihModel->getAreaDampakRisikoTerpilih();
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();
        $daftarLevelDampak = $this->levelDampakModel->findAll();
        $daftarLevelKemungkinan = $this->levelKemungkinanModel->findAll();
        $daftarKategoriRisiko = $this->kategoriRisikoModel->findAll();
        $daftarIndikatorKinerja = $this->sasaranSPBEModel->findAll();
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
            'daftarIndikatorKinerja' => $daftarIndikatorKinerja
        ];

        if(isset($_POST['submit'])){

            $areaDampak = $this->areaDampakRisikoModel->where('area_dampak',$this->request->getPost('area_dampak'))->get()->getRowArray();

            $levelDampak = $this->levelDampakModel->where('level_dampak',$this->request->getPost('level_dampak'))->get()->getRowArray();

            $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko'))->get()->getRowArray();

            $kategoriRisiko = $this->kategoriRisikoModel->where('kategori_risiko',$this->request->getPost('kategori_risiko'))->get()->getRowArray();

            $indikatorKinerja = $this->sasaranSPBEModel->where('indikator_kinerja_SPBE',$this->request->getPost('indikator_kinerja_SPBE'))->get()->getRowArray();

            $levelKemungkinan = $this->levelKemungkinanModel->where('level_kemungkinan',$this->request->getPost('level_kemungkinan'))->get()->getRowArray();

            $multiClause = array('id_level_kemungkinan' => $levelKemungkinan['id'], 'id_level_dampak' => $levelDampak['id']);
            $multiClause2 = array('id_kategori_risiko' => $kategoriRisiko['id'], 'id_jenis_risiko' => $jenisRisiko['id']);

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
            ->set('id_kategori_risiko' , $kategoriRisiko['id'])
            ->set('dampak' , $this->request->getPost('dampak'))
            ->set('id_area_dampak' , $areaDampak['id'])
            ->set('sistem_pengendalian' , $this->request->getPost('sistem_pengendalian'))
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
        
        $delete = $this->penilaianRisikoModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/penilaianRisiko'));
        
    }

    public function getPenangananRisiko(){

        return $this->respond($this->penangananRisikoModel->getPenanganan());

    }

    public function getRisikoByKeputusan(){
        return $this->respond($this->penilaianRisikoModel->getPenilaianByKeputusan());
    }

    public function pilihRisiko(){
        $data = [
            'title'     => 'Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Ditangani (4.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko'
        ];

         return view('PengelolaRisiko/pilih-risiko',$data);
    } 

    public function inputPenangananRisiko($id=null){

        if(isset($_POST['tambah'])){

            $opsiPenanganan = $this->opsiPenangananModel->where('opsi_penanganan',$this->request->getPost('opsi_penanganan'))->get()->getRowArray();

            $rules =[
                'jadwal_mulai' => 'jadwalValidation[jadwal_mulai,jadwal_selesai]'
            ];

            $errors = [
                'jadwal_mulai'=> [
                    'jadwalValidation' => 'Tanggal memulai implementasi harus lebih dulu dari tanggal selesai']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }
            
            $inputData = [
                'id_risiko' => $id,
                'id_opsi_penanganan' => $opsiPenanganan['id'],
                'rencana_aksi' => $this->request->getPost('rencana_aksi'),
                'keluaran' => $this->request->getPost('keluaran'),
                'jadwal_mulai' => $this->request->getPost('jadwal_mulai'),
                'jadwal_selesai' => $this->request->getPost('jadwal_selesai'),
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
            'title'     => 'Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Memilih Risiko yang Akan Ditangani (4.0)',
            'subsubtitle'  => 'Tambah Rencana Penanganan Risiko (4.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'sublink'      => 'pilihRisiko',
            'id'        => $id,
            'daftarOpsiPenanganan' => $daftarOpsiPenanganan
        ];

        return view('PengelolaRisiko/form-penanganan-risiko' , $data);
    }

    public function updatePenangananRisiko($id=null){

        $rencana_penanganan = $this->penangananRisikoModel->find($id);

        $risiko = $this->penilaianRisikoModel->where('id',$rencana_penanganan['id_risiko'])->get()->getRowArray();

        $daftarOpsiPenanganan = $this->opsiPenangananModel->where('id_jenis_risiko', $risiko['id_jenis_risiko'])->get()->getResultArray();

        $data = [
            'title'     => 'Penanganan Risiko SPBE (4.0)',
            'subtitle'  => 'Edit Penanganan Risiko SPBE (4.0)',
            'script'    => 'pengelola-risiko',
            'active'    => 'Penanganan Risiko SPBE',
            'link'      => 'penangananRisiko',
            'rencana_penanganan' => $rencana_penanganan,
            'daftarOpsiPenanganan' => $daftarOpsiPenanganan
        ];

        if(isset($_POST['submit'])){

            $opsiPenanganan = $this->opsiPenangananModel->where('opsi_penanganan',$this->request->getPost('opsi_penanganan'))->get()->getRowArray();

            $rules =[
                'jadwal_mulai' => 'jadwalValidation[jadwal_mulai,jadwal_selesai]'
            ];

            $errors = [
                'jadwal_mulai'=> [
                    'jadwalValidation' => 'Tanggal memulai implementasi harus lebih dulu dari tanggal selesai']
            ];

            if(!$this->validate($rules, $errors)){
                return redirect()->back()->withInput();
            }            
            
            $this->penangananRisikoModel
            ->set('id_risiko' , $rencana_penanganan['id_risiko'])
            ->set('id_opsi_penanganan' , $opsiPenanganan['id'])
            ->set('rencana_aksi' , $this->request->getPost('rencana_aksi'))
            ->set('keluaran' , $this->request->getPost('keluaran'))
            ->set('jadwal_mulai' , $this->request->getPost('jadwal_mulai'))
            ->set('jadwal_selesai' ,$this->request->getPost('jadwal_selesai'))
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
        
        $delete = $this->penangananRisikoModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('pengelolaRisiko/penangananRisiko'));
        
    }


}  