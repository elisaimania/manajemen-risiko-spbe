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
            $user = $this->penggunaModel->where('username' , $credential)->getPengguna();
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
            if(!password_verify($this->request->getPost('password') , $user[0]['password'])){
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
            session()->set('nama' , $user[0]['nama_pengguna']);
            session()->set('username' , $user[0]['username']);
			session()->set('role' , $user[0]['id_role']);
			session()->set('nama_role' , $user[0]['nama_role']);
            session()->set('email' , $user[0]['email']);
			session()->set('id_upr' , $user[0]['id_upr']);
			session()->set('nama_upr' , $user[0]['upr_SPBE']);
			session()->set('img', base_url('assets/img/gambar_2.svg'));
            $flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
			Anda berhasil masuk!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</div>';
			$flash = session()->setFlashdata('flash', $flash);
			if(session()->role == 1){
				return redirect()->to(base_url('pengelolaRisiko/dashboard'));
			} elseif (session()->role == 2) {
				return redirect()->to(base_url('koordinatorRisiko/dashboard'));
			} elseif (session()->role == 3) {
				return redirect()->to(base_url('pemilikRisiko/dashboard'));
			} else {
				return redirect()->to(base_url('admin/daftarPengguna'));
			}
            	
        }
        $data = [
            'title' => 'Login',
        ];
        return view('auth/login' , $data);
		
    }

    public function loginSSO(){
    	if(isset($_POST['loginSSO'])){
    		$credential = $this->request->getPost('usernameSSO');

    		//get data json
    		$getJSON = $this->penggunaModel->getJSONbyusername($credential);

    		if($getJSON==FALSE){
                $flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Username salah!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
				$flash = session()->setFlashdata('flash', $flash);
				return redirect()->back();
            } else {
            	$dataJSON = json_decode($getJSON);

				$email = $dataJSON->email;
				$nama = $dataJSON->nama;
				$username = $dataJSON->username;
				$img = $dataJSON->foto;

				//periksa apakah username terdaftar dalam sistem manrisk
				$user = $this->penggunaModel->where('username' , $credential)->getPengguna();
				if (!$user) {
					$flash = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Username tidak terdaftar di dalam sistem!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
					$flash = session()->setFlashdata('flash', $flash);
					return redirect()->back();
				}

				//update  data user menggunakan data yang diambil dari SSO BPS
				$this->penggunaModel
            		->set('email' , $email)
            		->set('nama_pengguna' , $nama)
            		->where('username' , $username)
            		->update();

            	session()->set('log' , true);
            	session()->set('nama' , $nama);
            	session()->set('username' , $user[0]['username']);
				session()->set('role' , $user[0]['id_role']);
				session()->set('nama_role' , $user[0]['nama_role']);
            	session()->set('email' , $email);
				session()->set('id_upr' , $user[0]['id_upr']);
				session()->set('nama_upr' , $user[0]['upr_SPBE']);
				session()->set('img', $img);
            	$flash = '<div class="alert alert-success alert-dismissible fade show" role="alert">
									Anda berhasil masuk!
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>';
				$flash = session()->setFlashdata('flash', $flash);
				if(session()->role == 1){
					return redirect()->to(base_url('pengelolaRisiko/dashboard'));
				} elseif (session()->role == 2) {
					return redirect()->to(base_url('koordinatorRisiko/dashboard'));
				} elseif (session()->role == 3) {
					return redirect()->to(base_url('pemilikRisiko/dashboard'));
				} else {
					return redirect()->to(base_url('admin/daftarPengguna'));
				}

            }

    	}

    	$data = [
            'title' => 'Login',
        ];
        return view('auth/login' , $data);

    }

	public function logout(){

		if(session()->log){
            session()->remove(['log', 'nama', 'username', 'role', 'email', 'img', 'nama_role', 'upr_SPBE', 'id_upr']);
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

