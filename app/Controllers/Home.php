<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
    }

    public function index() {
        if ($this->session->isLogin == true) {
            $ticket_total = $this->db->query("SELECT COUNT(*) as tot FROM tickets");
            $ticket_open = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE status_id='1'");
            $ticket_closed = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE status_id='2'");
            $ticket_pending = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE status_id='3'");
            $ticket_new = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE updated_at = null "); //tiket baru adalah tiket yg belum di update 

            $data['total_ticket'] = $ticket_total->getRow();
            $data['opened_ticket'] = $ticket_open->getRow();
            $data['closed_ticket'] = $ticket_closed->getRow();
            $data['pending_ticket'] = $ticket_pending->getRow();
            $data['new_ticket'] = $ticket_new->getRow();
            
            // return view('welcome_message');
            echo view("layout/header");
            echo view("layout/navbar");
            echo view("layout/sidebar");
            echo view("admin/home",$data);
            echo view("layout/footer");
        }
    }

    public function index_user()
    {
        if ($this->session->isLogin = true) {
            $username = $this->session->username;
            $role = $this->session->role;
            $name = $this->session->nama;

            $ticket_total = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE username = '$username'");
            $ticket_open = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE status_id='1' AND username = '$username'");
            $ticket_closed = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE (status_id='2' AND username = '$username')");
            $ticket_pending = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE (status_id='3' AND username = '$username')");
            $ticket_new = $this->db->query("SELECT COUNT(*) as tot FROM tickets WHERE (updated_at = null AND username = '$username')"); //tiket baru adalah tiket yg belum di update 

            $data['total_ticket'] = $ticket_total->getRow();
            $data['opened_ticket'] = $ticket_open->getRow();
            $data['closed_ticket'] = $ticket_closed->getRow();
            $data['pending_ticket'] = $ticket_pending->getRow();
            $data['new_ticket'] = $ticket_new->getRow();

            $data['username'] = $username;
            $data['role'] = $role;
            $data['nama'] = $name;

            echo view("layout/header");
            echo view("layout/navbar");
            echo view("layout/sidebar");
            echo view("user/home",$data);
            echo view("layout/footer");   
        }
    }
}
