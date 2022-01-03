<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->categorymodel = new CategoryModel();
        $this->db = \Config\Database::connect() ;  
    }

    public function index()
    {
        $category = $this->db->query('SELECT * FROM categories');
        $data['category'] = $category->getResultArray();

        echo view('layout/header');
        echo view('layout/navbar');
        echo view('layout/sidebar');
        echo view('list_category', $data);
        echo view('layout/footer');
    }

    public function add() { //menambah category
        $nama = $this->request->getPost('nama');
        $color = $this->request->getPost('color');
        
        $q = $this->db->query("SELECT * FROM categories WHERE `name`='$nama'");
        if ($q->getNumRows() != 0) {
            $this->session->setFlashdata('pesan_add','Failed to add category. category already exists!');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->db->query("INSERT INTO categories(`name`,`color`) VALUES ('$nama','$color')");
            $this->session->setFlashdata('pesan_add','Data Added Successfully!');
            $this->session->setFlashdata('alert-class','alert-success');
        }

        return redirect('category');
    }

    public function delete() { // delete category 
        $id = $this->request->getPost('id');
        $query = $this->db->query("DELETE FROM categories WHERE id = '$id'");
        if (!$query) {
            $this->session->setFlashdata('hapus_berhasil','Failed to delete category');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->session->setFlashdata('hapus_berhasil','category Deleted Successfully');
            $this->session->setFlashdata('alert-class','alert-success');
        }
        
        return redirect('category');
    }

    public function edit() { //update category
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $color = $this->request->getPost('color');
        
        $data = [
            'name' => $nama,
            'color' => $color
        ];
        
        if (!$this->categorymodel->update($id,$data)) {
            $this->session->setFlashdata('pesan_edit','Failed to Update category');
            $this->session->setFlashdata('alert-class','alert-danger');
        } else {
            $this->session->setFlashdata('pesan_edit','category Updated Succesfully.');
            $this->session->setFlashdata('alert-class','alert-success');
        }
        return redirect('category');
    }
}
