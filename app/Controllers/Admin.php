<?php
namespace App\Controllers;
use App\Models\PenggunaModel;
use App\Models\RoleModel;
use App\Models\KategoriRisikoModel;
use App\Models\AreaDampakRisikoModel;
use App\Models\OpsiPenangananModel;
use App\Models\JenisRisikoModel;
use App\Models\UPRSPBEModel;
use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;
    public $kategoriRisikoModel = null;
    public $areaDampakRisikoModel = null;
    public $opsiPenangananModel = null;
    public $penggunaModel = null;
	public $roleModel = null;
    public $jenisRisikoModel = null;
    public $uprSPBEModel = null;

	public function __construct()
    {
        session();
        $this->penggunaModel = new PenggunaModel();
		$this->roleModel = new RoleModel();
        $this->kategoriRisikoModel = new KategoriRisikoModel();
        $this->areaDampakRisikoModel = new AreaDampakRisikoModel();
        $this->opsiPenangananModel = new opsiPenangananModel();
        $this->jenisRisikoModel = new JenisRisikoModel();
        $this->uprSPBEModel = new UPRSPBEModel();
    }

    public function daftarPengguna(){

        $data = [
            'title'     => 'Daftar Pengguna',
            'subtitle'  =>  '',
            'script'    => 'admin',
            'active'    => 'Daftar Pengguna',
            'link'      => 'daftarPengguna'
        ];

        
        return view('admin/daftar-pengguna', $data);
        
    }

    public function daftarKategori(){

        $data = [
            'title'     => 'Daftar Kategori Risiko SPBE',
            'subtitle'  => '',
            'script'    => 'admin',
            'active'    => 'Daftar Kategori',
            'link'      => 'daftarKategori'
        ];

        return view('admin/daftar-kategori', $data);
        
    }

    public function daftarDampak(){

        $data = [
            'title'     => 'Daftar Area Dampak Risiko SPBE',
            'subtitle'  => '',
            'script'    => 'admin',
            'active'    => 'Daftar Dampak',
            'link'      => 'daftarDampak'
        ];

        return view('admin/daftar-dampak', $data);
        
    }

    public function daftarPenanganan(){

        $data = [
            'title'     => 'Daftar Opsi Penanganan Risiko SPBE',
            'subtitle'  => '',
            'script'    => 'admin',
            'active'    => 'Daftar Penanganan',
            'link'      => 'daftarPenanganan'
        ];
        
        return view('admin/daftar-penanganan', $data);
        
    }

    public function daftarUPR(){

        $data = [
            'title'     => 'Daftar Unit Pemilik Risiko (UPR) SPBE',
            'subtitle'  => '',
            'script'    => 'admin',
            'active'    => 'Daftar Unit Pemilik Risiko (UPR)',
            'link'      => 'daftarUPR'
        ];
        
        return view('admin/daftar-upr', $data);
        
    }

    public function getDaftarPengguna(){

        return $this->respond($this->penggunaModel->getPengguna());
        
    }

    public function inputDataPengguna()
    {
        if(isset($_POST['tambah'])){

            $rules = [
                'username' => 'required|is_unique[pengguna.username]',
                'email' => 'required|is_unique[pengguna.email]',
                'nama_pengguna' => 'required',
                'password' => 'min_length[8]',
                'konfirmasi_password' => 'matches[password]' 
            ];

            if(!$this->validate($rules)){
                return redirect()->back()->withInput();
            }

            $role = $this->roleModel->where('nama_role',$this->request->getPost('nama_role'))->get()->getRowArray();
            $id_role = $role['id'];

            $inputData = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'nama_pengguna' => $this->request->getPost('nama_pengguna'),
                'password' => password_hash($this->request->getPost('password') , PASSWORD_DEFAULT),
                'id_upr' => $this->request->getPost('upr'),
                'id_role' => $id_role
            ];

            $this->penggunaModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Pengguna baru berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title' => 'Daftar Pengguna',
            'subtitle' => 'Tambah Pengguna',
            'script' => 'admin',
            'active' => 'Daftar Pengguna',
            'link'      => 'daftarPengguna',
            'role' => $this->roleModel->findAll(),
            'upr' => $this->uprSPBEModel->findAll()
        ];

        return view('admin/form-tambah-pengguna' , $data);
    }

    public function updateDataPengguna($id=null){

        $pengguna = $this->penggunaModel->find($id);


        $data = [
            'title' => 'Daftar Pengguna',
            'subtitle' => 'Edit Data Pengguna',
            'script' => 'admin',
            'active' => 'Daftar Pengguna',
            'pengguna' => $pengguna,
            'id' => $pengguna['id'],
            'link'      => 'daftarPengguna',
            'role' => $this->roleModel->findAll(),
            'upr' => $this->uprSPBEModel->findAll()
        ];

        if(isset($_POST['submit'])){

            $role = $this->roleModel->where('nama_role',$this->request->getPost('nama_role'))->get()->getRowArray();
            $id_role = $role['id'];

            $this->penggunaModel
            ->set('nama_pengguna' , $this->request->getPost('nama_pengguna'))
            ->set('username' , $this->request->getPost('username'))
            ->set('email' , $this->request->getPost('email'))
            ->set('id_role' , $id_role)
            ->set('id_upr',$this->request->getPost('upr'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data pengguna berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('admin/daftarPengguna'));
        }
        return view('admin/form-edit-pengguna' , $data);
    }

    public function editPassword($id=null){

        $pengguna = $this->penggunaModel->find($id);

        $data = [
            'title' => 'Daftar Pengguna',
            'subtitle' => 'Edit Data Pengguna',
            'subsubtitle' => 'Edit Password',
            'script' => 'admin',
            'link'      => 'daftarPengguna',
            'sublink' => 'updateDataPengguna',
            'id'    => $id,
            'active' => 'Daftar Pengguna'
        ];

        if(isset($_POST['submit'])){

            $rules = [
                'password' => 'min_length[8]',
                'konfirmasi_password' => 'matches[password]' 
            ];

            if(!$this->validate($rules)){
                return redirect()->back()->withInput();
            }

            $this->penggunaModel
            ->set('password' , password_hash($this->request->getPost('password') , PASSWORD_DEFAULT))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Password pengguna berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';

            $flash = session()->setFlashdata('flash', $flash);
            return redirect()->to(base_url('admin/daftarPengguna'));
        }
        return view('admin/form-edit-password' , $data);
    }

    public function hapusDataPengguna($id = null)
    {
        
        $delete = $this->penggunaModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Data berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('admin/daftarPengguna'));
        
    }

    public function getDaftarKategori(){

        return $this->respond($this->kategoriRisikoModel->get()->getResultArray());
        
    }

    public function inputKategoriRisiko()
    {
        if(isset($_POST['tambah'])){
            $inputData = [
                'kategori_risiko' => $this->request->getPost('kategori_risiko')
            ];

            $this->kategoriRisikoModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kategori risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title' => 'Daftar Kategori Risiko SPBE',
            'subtitle' => 'Tambah Kategori Risiko',
            'script' => 'admin',
            'active' => 'Daftar Kategori',
            'link'  => 'daftarKategori'
        ];

        return view('admin/form-tambah-kategori' , $data);
    }

    public function updateKategoriRisiko($id=null){

        $kategori = $this->kategoriRisikoModel->find($id);

        $data = [
            'title' => 'Daftar Kategori Risiko SPBE',
            'subtitle' => 'Edit Kategori Risiko',
            'script' => 'admin',
            'active' => 'Daftar Kategori',
            'kategori' => $kategori,
            'id' => $kategori['id'],
            'link'      => 'daftarKategori'
        ];

        if(isset($_POST['submit'])){


            $this->kategoriRisikoModel
            ->set('kategori_risiko' , $this->request->getPost('kategori_risiko'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kategori risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('admin/daftarKategori'));
        }
        return view('admin/form-edit-kategori' , $data);
    }

   public function hapusKategoriRisiko($id = null)
    {
        
        $delete = $this->kategoriRisikoModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Kategori risiko berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('admin/daftarKategori'));
        
    }   
    
    public function getDaftarDampak(){

        return $this->respond($this->areaDampakRisikoModel->get()->getResultArray());
        
    }

    public function inputAreaDampak()
    {
        if(isset($_POST['tambah'])){
            $inputData = [
                'area_dampak' => $this->request->getPost('area_dampak')
            ];

            $this->areaDampakRisikoModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Area dampak risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title' => 'Daftar Area Dampak Risiko SPBE',
            'subtitle' => 'Tambah Area Dampak Risiko',
            'script' => 'admin',
            'active' => 'Daftar Dampak',
            'link'  => 'daftarDampak'
        ];

        return view('admin/form-tambah-dampak' , $data);
    }

    public function updateAreaDampak($id=null){

        $dampak = $this->areaDampakRisikoModel->find($id);

        $data = [
            'title' => 'Daftar Area Dampak Risiko SPBE',
            'subtitle' => 'Edit Area Dampak Risiko',
            'script' => 'admin',
            'active' => 'Daftar Dampak',
            'dampak' => $dampak,
            'id' => $dampak['id'],
            'link'      => 'daftarDampak'
        ];

        if(isset($_POST['submit'])){


            $this->areaDampakRisikoModel
            ->set('area_dampak' , $this->request->getPost('area_dampak'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Area dampak risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('admin/daftarDampak'));
        }
        return view('admin/form-edit-dampak' , $data);
    }

   public function hapusAreaDampak($id = null)
    {
        
        $delete = $this->areaDampakRisikoModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Area dampak risiko berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('admin/daftarDampak'));
        
    }

    public function getDaftarPenanganan(){

        return $this->respond($this->opsiPenangananModel->getOpsi());
        
    }

    public function inputOpsiPenanganan()
    {
        if(isset($_POST['tambah'])){

            $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko'))->get()->getRowArray();

            $inputData = [
                'opsi_penanganan' => $this->request->getPost('opsi_penanganan'),
                'id_jenis_risiko' => $jenisRisiko['id']
            ];

            $this->opsiPenangananModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Opsi penanganan risiko berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();

        $data = [
            'title' => 'Daftar Opsi Penanganan Risiko SPBE',
            'subtitle' => 'Tambah psi Penanganan Risiko',
            'script' => 'admin',
            'active' => 'Daftar Penanganan',
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'link'  => 'daftarPenanganan'
        ];

        return view('admin/form-tambah-penanganan' , $data);
    }

    public function updateOpsiPenanganan($id=null){

        $penanganan = $this->opsiPenangananModel->find($id);
        $daftarJenisRisiko = $this->jenisRisikoModel->findAll();

        $data = [
            'title' => 'Daftar Opsi Penanganan Risiko SPBE',
            'subtitle' => 'Edit Opsi Penanganan Risiko',
            'script' => 'admin',
            'active' => 'Daftar Penanganan',
            'penanganan' => $penanganan,
            'daftarJenisRisiko' => $daftarJenisRisiko,
            'id' => $penanganan['id'],
            'link'      => 'daftarPenanganan'
        ];

        if(isset($_POST['submit'])){

            $jenisRisiko = $this->jenisRisikoModel->where('jenis_risiko',$this->request->getPost('jenis_risiko'))->get()->getRowArray();

            $this->opsiPenangananModel
            ->set('opsi_penanganan' , $this->request->getPost('opsi_penanganan'))
            ->set('id_jenis_risiko' , $jenisRisiko['id'])
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Opsi penanganan risiko berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('admin/daftarPenanganan'));
        }
        return view('admin/form-edit-penanganan' , $data);
    } 

   public function hapusOpsiPenanganan($id = null)
    {
        
        $delete = $this->opsiPenangananModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Opsi penanganan risiko berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('admin/daftarPenanganan'));
        
    }
    
    public function getDaftarUPR(){

        return $this->respond($this->uprSPBEModel->get()->getResultArray());
        
    }

    public function inputUPR()
    {
        if(isset($_POST['tambah'])){
            $inputData = [
                'upr_SPBE' => $this->request->getPost('upr_SPBE')
            ];

            $this->uprSPBEModel->insert($inputData);

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Unit Pemilik Risiko (UPR) berhasil ditambahkan
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
            </div>';

            $flash = session()->setFlashdata('flash', $flash);
        }

        $data = [
            'title' => 'Daftar Unit Pemilik Risiko (UPR) SPBE',
            'subtitle' => 'Tambah Unit Pemilik Risiko (UPR)',
            'script' => 'admin',
            'active' => 'Daftar Unit Pemilik Risiko (UPR)',
            'link'  => 'daftarUPR'
        ];

        return view('admin/form-tambah-upr' , $data);
    }

    public function updateUPR($id=null){

        $upr = $this->uprSPBEModel->find($id);

        $data = [
            'title' => 'Daftar Unit Pemilik Risiko (UPR) SPBE',
            'subtitle' => 'Edit Unit Pemilik Risiko (UPR)',
            'script' => 'admin',
            'active' => 'Daftar Unit Pemilik Risiko (UPR)',
            'upr' => $upr,
            'id' => $upr['id'],
            'link'      => 'daftarUPR'
        ];

        if(isset($_POST['submit'])){


            $this->uprSPBEModel
            ->set('upr_SPBE' , $this->request->getPost('upr_SPBE'))
            ->where('id' , $id)
            ->update();

            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Unit Pemilik Risiko (UPR) berhasil diubah
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
            $flash = session()->setFlashdata('flash', $flash);

            return redirect()->to(base_url('admin/daftarKategori'));
        }
        return view('admin/form-edit-upr' , $data);
    }

   public function hapusUPR($id = null)
    {
        
        $delete = $this->uprSPBEModel->where('id', $id)
        ->delete();

        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Unit Pemilik Risiko (UPR) berhasil dihapus!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>';
                
        $flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url('admin/daftarUPR'));
        
    }   

}    