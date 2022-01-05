<?php

namespace App\Controllers;
use App\Models\User_model;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController {

    public function __construct()
    {
        // load db 
        $this->userModel = new User_model();
        $this->db = \Config\Database::connect() ; 

        // load validation 
        $this->validation =  \Config\Services::validation();

        // load session 
        $this->session = \Config\Services::session();
    }

    public function login() {
        return view('auth/login');
    }

    public function valid_login() {
        // ambil data dari form 
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cocokkan username post dan db 
        $query = $this->db->query("SELECT * FROM users WHERE username = '$username'");
        if ($query->getNumRows() == 0) { //if user not found
            $this->session->setFlashdata('login_dulu','User Not Found!');
            $this->session->setFlashdata('alert-class','alert-danger');
            return redirect()->to('auth/login');
        } else { //if user found
            $user = $query->getRow();
            if ($user->password != md5($password)) {
                $this->session->setFlashData('login_dulu','Wrong Password!');
                $this->session->setFlashdata('alert-class','alert-danger');
                return redirect()->to('auth/login');
            } else if ($user->password == md5($password) && $user->level_id == 1) { //check if user is admin
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'role' => $user->level_id,
                    'nama' => $user->firstname . ' ' . $user->lastname
                ];
                $this->session->set($sessLogin);
                return redirect('admin/home');
            } else if ($user->password == md5($password) && $user->level_id != 1){
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user->username,
                    'role' => $user->level_id,
                    'nama' => $user->firstname . ' ' . $user->lastname
                ];
                $this->session->set($sessLogin);
                return redirect('user/home');
            } else {
                $this->session->setFlashData('login_dulu','User Not Found!');
                $this->session->setFlashdata('alert-class','alert-danger');
                return redirect()->to('auth/login');
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
