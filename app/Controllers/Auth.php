<?php

namespace App\Controllers;
use App\Models\User_model;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController {

    public function __construct()
    {
        // membuat user model utk koneksi ke db 
        $this->userModel = new User_model();

        // load validation 
        $this->validation =  \Config\Services::validation();

        // load session 
        $this->session = \Config\Services::session();
    }

    public function login() {
        return view('auth/login');
    }

    public function valid_login() {
        $db = \Config\Database::connect('lk');
        // ambil data dari form 
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cocokkan username post dan db 
        $query = $db->query("SELECT a.*, p.nama, p.id_org  FROM autentifikasi a, master_pegawai p WHERE a.niplama = p.niplama AND a.username = '$username'");
        if ($query->getNumRows() == 0) { //jk user tdk ditemukan
            $this->session->setFlashdata('login_dulu','Pengguna tidak ditemukan');
            $this->session->setFlashdata('alert-class','alert-danger');
            return redirect()->to('auth/login');
        } else { //jk user ditemukan 
            $user = $query->getRow();
            if ($user->password != md5($password)) {
                $this->session->setFlashData('login_dulu','Password Salah');
                $this->session->setFlashdata('alert-class','alert-danger');
                return redirect()->to('auth/login');
            } else if ($user->password != md5($password) && $user->id_org == '92600' || $user->id_org == '92610' || $user->id_org == '92620') { //cek id _org as admin
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'role' => $user->id_org,
                    'nama' => $user->nama
                ];
                $this->session->set($sessLogin);
                return redirect('admin/home');
            } else {
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'role' => $user->id_org,
                    'nama' => $user->nama
                ];
                $this->session->set($sessLogin);
                return redirect('user/home');
            }
        }
        
    }
    public function logout() {
        //hancurkan session 
        //balikan ke halaman login
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}

?>