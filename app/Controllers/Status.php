<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StatusModel;

class Status extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->statusmodel = new StatusModel();
        $this->db = \Config\Database::connect() ;  
    }

    public function index()
    {
        $status = $this->db->query('SELECT * FROM statuses');
        $data['status'] = $status->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar');
        echo view('list_status', $data);
        echo view('layout/footer');
    }

    public function add() { //menambah status
        $nama = $this->request->getPost('nama');
        $color = $this->request->getPost('color');
        
        $q = $this->db->query("SELECT * FROM statuses WHERE `name`='$nama'");
        if ($q->getNumRows() != 0) {
            $this->session->setFlashdata('pesan_add','Failed to add status. Status already exists!');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->db->query("INSERT INTO statuses(`name`,`color`) VALUES ('$nama','$color')");
            $this->session->setFlashdata('pesan_add','Data Added Successfully!');
            $this->session->setFlashdata('alert-class','alert-success');
        }

        return redirect('status');
    }

    public function delete() { // delete status 
        $id = $this->request->getPost('id');
        $query = $this->db->query("DELETE FROM statuses WHERE id = '$id'");
        if (!$query) {
            $this->session->setFlashdata('hapus_berhasil','Failed to delete status');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->session->setFlashdata('hapus_berhasil','Status Deleted Successfully');
            $this->session->setFlashdata('alert-class','alert-success');
        }
        
        return redirect('status');
    }

    public function edit() { //update status
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $color = $this->request->getPost('color');
        
        $data = [
            'name' => $nama,
            'color' => $color
        ];

        if (!$this->statusmodel->update($id,$data)) {
            $this->session->setFlashdata('pesan_edit','Failed to Update Status');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->session->setFlashdata('pesan_edit','Status Updated Succesfully.');
            $this->session->setFlashdata('alert-class','alert-success');
        }
        return redirect('status');
    }


}
