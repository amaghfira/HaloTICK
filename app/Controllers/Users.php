<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->UsersModel = new UsersModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $users = $this->db->query('SELECT * FROM users');
        $data['users'] = $users->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar');
        echo view('list_users', $data);
        echo view('layout/footer');
    }

    public function add()
    { //add users
        $username = $this->request->getPost('username');
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $email = $this->request->getPost('email');
        $password = md5('123456');
        $levelid = 3;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'level_id' => $levelid
        ];

        $q = $this->db->query("SELECT * FROM users WHERE `username`='$username'");
        if ($q->getNumRows() != 0) {
            $this->session->setFlashdata('pesan_add', 'Failed to add users. users already exists!');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            $this->UsersModel->insert($data);
            $this->session->setFlashdata('pesan_add', 'Data Added Successfully!');
            $this->session->setFlashdata('alert-class', 'alert-success');
        }

        return redirect('users');
    }

    public function delete()
    { // delete users 
        $id = $this->request->getPost('id');
        $query = $this->db->query("DELETE FROM users WHERE id = '$id'");
        if (!$query) {
            $this->session->setFlashdata('hapus_berhasil', 'Failed to delete users');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            $this->session->setFlashdata('hapus_berhasil', 'Data Deleted Successfully');
            $this->session->setFlashdata('alert-class', 'alert-success');
        }

        return redirect('users');
    }

    public function edit()
    { //update users
        $id = $this->request->getPost('id');
        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $email = $this->request->getPost('email');

        $data = [
            'firstaname' => $firstname,
            'lastname' => $lastname,
            'email' => $email
        ];

        if (!$this->UsersModel->update($id, $data)) {
            $this->session->setFlashdata('pesan_edit', 'Failed to Update users');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            $this->session->setFlashdata('pesan_edit', 'Data Updated Succesfully.');
            $this->session->setFlashdata('alert-class', 'alert-success');
        }
        return redirect('users');
    }
}
