<?php
namespace App\Controllers;
use App\Models\PenggunaModel;
use App\Models\RoleModel;

class Auth extends BaseController
{
	public $penggunaModel = null;
	public $roleModel = null;

	public function __construct()
    {
        session();
        $this->penggunaModel = new PenggunaModel();
		$this->roleModel = new RoleModel();
    }

	public function index(){
		
		return view('auth/login');
	}

	public function login()
    {
        if(isset($_POST['login'])){
            $credential = $this->request->getPost('username');
            $user = $this->penggunaModel->where('username' , $credential)->orWhere('email',$credential)->get()->getRowArray();
            if(!$user){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									User tidak terdaftar!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
				$flash = session()->setFlashdata('flash', $flash);
                return redirect()->back();
            }
            if(!password_verify($this->request->getPost('password') , $user['password'])){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Password yang Anda masukkan salah!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
				$flash = session()->setFlashdata('flash', $flash);
                return redirect()->back();
            }
            session()->set('log' , true);
            session()->set('nama' , $user['nama_pengguna']);
            session()->set('username' , $user['username']);
			session()->set('role' , $user['id_role']);
            session()->set('email' , $user['email']);
			session()->set('id_upr' , $user['id_upr']);
            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
									Anda berhasil masuk!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
			$flash = session()->setFlashdata('flash', $flash);
			if(session()->role == 2){
				return redirect()->to(base_url('pengelolaRisiko/dashboard'));
			} elseif (session()->role == 3) {
				return redirect()->to(base_url('koordinatorRisiko/dashboard'));
			} elseif (session()->role == 4) {
				return redirect()->to(base_url('pemilikRisiko/dashboard'));
			} else {
				return redirect()->to(base_url('admin/daftarPengguna'));
			}
            	
        }
        $data = [
            'title' => 'Login',
            'active' => 'login',
        ];
        return view('auth/login' , $data);
		
    }

	public function logout(){

		if(session()->log){
            session()->remove(['log', 'nama', 'username', 'role', 'email']);
        }
        $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
									Anda berhasil keluar!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
		$flash = session()->setFlashdata('flash', $flash);
        return redirect()->to(base_url());
	}


}

