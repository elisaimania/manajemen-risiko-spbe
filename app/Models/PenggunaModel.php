<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{

    protected $table      = 'pengguna';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields =['username','nama_pengguna','email','password','id_role','id', 'id_upr'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPengguna(){
        $this->builder()->join('role_pengguna','role_pengguna.id = pengguna.id_role');
        $this->builder()->join('upr_spbe','upr_spbe.id = pengguna.id_upr');
        return $this->builder()->select('username, nama_pengguna, email,password, nama_role, pengguna.id, upr_spbe.upr_SPBE, pengguna.id_role, pengguna.id_upr')->get()->getResultArray();
        
    }

        public function getJSONbyusername($username){
        $foto = base_url('assets/img/undraw_profile.svg');
        // $foto = 'https://community.bps.go.id/images/avatar/340059519.jpg';
        // $foto = 'https://community.bps.go.id/images/avatar/340059799.jpg';
        // $foto = 'https://community.bps.go.id/images/avatar/340059601.jpg';

        $erik = array(
            'id_user' => '199901042022080001',
            'nama' => 'Erik Rihendri Chandra',
            'username' => 'erik',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022080001',
            'nip' => '340059001',
            'role' => 'super_admin',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => 'PUSAT',
            'provinsi' => 'PUSAT',
            'kdprov' => '00',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $dimass = array(
            'id_user' => '199901042022081002',
            'nama' => 'Dimasa Al khusuufi',
            'username' => 'dimass',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022081002',
            'nip' => '340059102',
            'role' => 'admin_pusat',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => 'PUSAT',
            'provinsi' => 'PUSAT',
            'kdprov' => '00',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $okta_vania = array(
            'id_user' => '199901042022081003',
            'nama' => 'Vania Oktaviasari',
            'username' => 'okta_vania',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022081003',
            'nip' => '340059103',
            'role' => 'admin_pusat',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => 'PUSAT',
            'provinsi' => 'PUSAT',
            'kdprov' => '00',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $yudis = array(
            'id_user' => '199901042022080004',
            'nama' => 'Yudistira Elton',
            'username' => 'yudis',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022080004',
            'nip' => '340059004',
            'role' => 'super_admin',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => 'PUSAT',
            'provinsi' => 'PUSAT',
            'kdprov' => '00',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $fatkhul = array(
            'id_user' => '199901042022082005',
            'nama' => 'Fatkhul Muklish',
            'username' => 'fatkhul',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022082005',
            'nip' => '340059205',
            'role' => 'admin_prov',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => '-',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $meytry = array(
            'id_user' => '199901042022082006',
            'nama' => 'Meytry Petronella Purba',
            'username' => 'meytry',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022082006',
            'nip' => '340059206',
            'role' => 'admin_prov',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => '-',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $mitha_simatupang = array(
            'id_user' => '199901042022082007',
            'nama' => 'Paramitha Madelin',
            'username' => 'mitha_simatupang',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022082007',
            'nip' => '340059207',
            'role' => 'admin_prov',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => '-',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $nugroho = array(
            'id_user' => '199901042022082008',
            'nama' => 'Nugroho Purnomo Aji',
            'username' => 'nugroho',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022082008',
            'nip' => '340059208',
            'role' => 'admin_prov',
            'wilayah_kerja' => array(
                0 => '00'
            ),
            'foto' => $foto,
            'kabupaten' => '-',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '00',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $raka1 = array(
            'id_user' => '199901042022083009',
            'nama' => 'Raka Ikmana',
            'username' => 'raka1',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022083009',
            'nip' => '340059309',
            'role' => 'admin_kab',
            'wilayah_kerja' => array(
                0 => '03'
                // 1 => '07'
            ),
            'foto' => $foto,
            'kabupaten' => 'ACEH SINGKIL',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '02',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $raka2 = array(
            'id_user' => '199901042022083010',
            'nama' => 'Raka Artian',
            'username' => 'raka2',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022083010',
            'nip' => '340059310',
            'role' => 'admin_kab',
            'wilayah_kerja' => array(
                0 => '03'
            ),
            'foto' => $foto,
            'kabupaten' => 'ACEH SELATAN',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '03',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $gaberiel = array(
            'id_user' => '199901042022083011',
            'nama' => 'Gaberiel',
            'username' => 'gaberiel',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022083011',
            'nip' => '340059311',
            'role' => 'admin_kab',
            'wilayah_kerja' => array(
                0 => '02',
                1 => '04'
            ),
            'foto' => $foto,
            'kabupaten' => 'ACEH TENGGARA',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '04',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $rizkaindah = array(
            'id_user' => '199901042022083012',
            'nama' => 'Rizka Indah',
            'username' => 'rizka.indah',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022083012',
            'nip' => '340059312',
            'role' => 'admin_kab',
            'wilayah_kerja' => array(
                0 => '05'
            ),
            'foto' => $foto,
            'kabupaten' => 'ACEH TIMUR',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '05',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $viona = array(
            'id_user' => '199901042022083013',
            'nama' => 'vionaansyah',
            'username' => 'viona',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022083013',
            'nip' => '340059313',
            'role' => 'admin_kab',
            'wilayah_kerja' => array(
                0 => '06'
            ),
            'foto' => $foto,
            'kabupaten' => 'ACEH TENGAH',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '06',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        $tasya = array(
            'id_user' => '199901042022083014',
            'nama' => 'Tasya Mina',
            'username' => 'tasya',
            'email' => 'bisa@gmail.com',
            'nip_baru' => '199901042022083014',
            'nip' => '340059314',
            'role' => 'admin_kab',
            'wilayah_kerja' => array(
                0 => '07'
            ),
            'foto' => $foto,
            'kabupaten' => 'ACEH BARAT',
            'provinsi' => 'ACEH',
            'kdprov' => '11',
            'kdkab' => '07',
            'kode_organisasi' => '000000031430',
            'token' => 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSld'
        );

        

        switch ($username) {
          case "erik":
            $myJSON = json_encode($erik);
            break;
          case "dimass":
            $myJSON = json_encode($dimass);
            break;
          case "okta_vania":
            $myJSON = json_encode($okta_vania);
            break;
          case "yudis":
            $myJSON = json_encode($yudis);
            break;
          case "fatkhul":
            $myJSON = json_encode($fatkhul);
            break;
          case "meytry":
            $myJSON = json_encode($meytry);
            break;
          case "mitha_simatupang":
            $myJSON = json_encode($mitha_simatupang);
            break;
          case "nugroho":
            $myJSON = json_encode($nugroho);
            break;
          case "raka1":
            $myJSON = json_encode($raka1);
            break;
          case "raka2":
            $myJSON = json_encode($raka2);
            break;
          case "gaberiel":
            $myJSON = json_encode($gaberiel);
            break;
          case "rizka.indah":
            $myJSON = json_encode($rizkaindah);
            break;
          case "viona":
            $myJSON = json_encode($viona);
            break;
          case "tasya":
            $myJSON = json_encode($tasya);
            break;
          
          default:
            $myJSON = FALSE;
        }

        return $myJSON;
    }


}