<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LevelsModel;

class Levels extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->levelsmodel = new LevelsModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $levels = $this->db->query('SELECT * FROM levels');
        $data['levels'] = $levels->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar');
        echo view('list_levels', $data);
        echo view('layout/footer');
    }

    public function add()
    { //menambah levels
        $nama = $this->request->getPost('nama');

        $q = $this->db->query("SELECT * FROM levels WHERE `name`='$nama'");
        if ($q->getNumRows() != 0) {
            $this->session->setFlashdata('pesan_add', 'Failed to add level. Level already exists!');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            $this->db->query("INSERT INTO levels(`name`) VALUES ('$nama')");
            $this->session->setFlashdata('pesan_add', 'Data Added Successfully!');
            $this->session->setFlashdata('alert-class', 'alert-success');
        }

        return redirect('levels');
    }

    public function delete()
    { // delete levels 
        $id = $this->request->getPost('id');
        $query = $this->db->query("DELETE FROM levels WHERE id = '$id'");
        if (!$query) {
            $this->session->setFlashdata('hapus_berhasil', 'Failed to delete level');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            $this->session->setFlashdata('hapus_berhasil', 'Data Deleted Successfully');
            $this->session->setFlashdata('alert-class', 'alert-success');
        }

        return redirect('levels');
    }

    public function edit()
    { //update levels
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');

        $data = [
            'name' => $nama
        ];

        if (!$this->levelsmodel->update($id, $data)) {
            $this->session->setFlashdata('pesan_edit', 'Failed to Update level');
            $this->session->setFlashdata('alert-class', 'alert-danger');
        } else {
            $this->session->setFlashdata('pesan_edit', 'Data Updated Succesfully.');
            $this->session->setFlashdata('alert-class', 'alert-success');
        }
        return redirect('levels');
    }
}
