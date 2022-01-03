<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PriorityModel;

class Priority extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->prioritymodel = new PriorityModel();
        $this->db = \Config\Database::connect() ;  
    }

    public function index()
    {
        $priority = $this->db->query('SELECT * FROM priorities');
        $data['priority'] = $priority->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar');
        echo view('list_priority', $data);
        echo view('layout/footer');
    }

    public function add() { //menambah priority
        $nama = $this->request->getPost('nama');
        $color = $this->request->getPost('color');
        
        $q = $this->db->query("SELECT * FROM priorities WHERE `name`='$nama'");
        if ($q->getNumRows() != 0) {
            $this->session->setFlashdata('pesan_add','Failed to add priority. priority already exists!');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->db->query("INSERT INTO priorities(`name`,`color`) VALUES ('$nama','$color')");
            $this->session->setFlashdata('pesan_add','Data Added Successfully!');
            $this->session->setFlashdata('alert-class','alert-success');
        }

        return redirect('priority');
    }

    public function delete() { // delete priority 
        $id = $this->request->getPost('id');
        $query = $this->db->query("DELETE FROM priorities WHERE id = '$id'");
        if (!$query) {
            $this->session->setFlashdata('hapus_berhasil','Failed to delete priority');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->session->setFlashdata('hapus_berhasil','Data Deleted Successfully');
            $this->session->setFlashdata('alert-class','alert-success');
        }
        
        return redirect('priority');
    }

    public function edit() { //update priority
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $color = $this->request->getPost('color');
        
        $data = [
            'name' => $nama,
            'color' => $color
        ];
        
        if (!$this->prioritymodel->update($id,$data)) {
            $this->session->setFlashdata('pesan_edit','Failed to Update priority');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->session->setFlashdata('pesan_edit','Data Updated Succesfully.');
            $this->session->setFlashdata('alert-class','alert-success');
        }
        return redirect('priority');
    }
}
