<?php

namespace App\Controllers;

use App\Models\Reply_model;
use App\Models\Ticket_model;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Autoloader\Helper;

class Tiket extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
        $this->ticketModel = new Ticket_model();
        $this->replyModel = new Reply_model();
        $this->admin = [1];
    }
    public function index()
    {
        if (!in_array($this->session->role, $this->admin)) { //user    
            $username = $this->session->username;
            $query = $this->db->query("SELECT t.*, s.name as nama_status FROM tickets t, statuses s WHERE t.status_id=s.id AND t.username = '$username'");
        } else { //admin
            $query = $this->db->query("SELECT t.*, s.name as nama_status FROM tickets t, statuses s WHERE t.status_id=s.id");
        }

        // show tickets list
        $data['tickets'] = $query->getResultArray();

        // layout
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("ticket_lists", $data);
        echo view("layout/footer");
    }

    public function view($id)
    { //only show ticket 
        $tiketquery = $this->db->query("SELECT t.*, s.name as nama_status FROM `tickets` t, statuses s WHERE t.id = '$id' AND t.status_id = s.id ");
        $data['ticket'] = $tiketquery->getRowArray();
        $query = $this->db->query("SELECT * FROM tickets_reply WHERE ticket_id = '$id'");
        $data['reply'] = $query->getResultArray();
        $data['solver_name'] = $query->getRow();

        // show 404 error if data not found 
        if (!$data['ticket']) {
            throw PageNotFoundException::forPageNotFound();
        }

        // layout
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("ticket_view", $data);
        echo view("layout/footer");
    }

    public function show($id)
    { //show ticket before editing
        $query2 = $this->db->query("SELECT * FROM users WHERE level_id=1");
        $data['orang'] = $query2->getResultArray();
        $data['ticket'] = $this->ticketModel->where([
            'id' => $id
        ])->first();
        $data['admin'] = $this->admin;
        // show 404 if data is not found 
        if (!$data['ticket']) {
            throw PageNotFoundException::forPageNotFound();
        }

        // layout
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("ticket_edit", $data);
        echo view("layout/footer");
    }

    public function edit($id)
    { //update ticket and send email on update
        helper('date');
        date_default_timezone_set('Asia/Singapore');
        $format = "Y-m-d h:i:s";
        $data['ticket'] = $this->ticketModel->where('id', $id)->first();

        $title = $this->request->getPost('title'); //get data from edit form
        $content = $this->request->getPost('content');
        $created = $this->request->getPost('created');
        $status = $this->request->getPost('status');
        $authorName = $this->request->getPost('author_name');
        $authorEmail = $this->request->getPost('author_email');
        $updated_at = date($format);
        $solver_name = $this->request->getPost('solver_name');
        $reply_exp = $this->request->getPost('comment');
        $reply_date = date($format);
        $ticket_id = $id;
        $datanew = [
            'title' => $title,
            'content' => $content,
            'status_id' => $status,
            'author_name' => $authorName,
            'author_email' => $authorEmail,
            'updated_at' => $updated_at,
            'solver' => $solver_name
        ];

        $datakomen = [
            'ticket_id' => $ticket_id,
            'reply_exp' => $reply_exp,
            'name' => $solver_name,
            'reply_date' => $reply_date
        ];


        // SETTING EMAIL
        // email from admin
        if (in_array($_SESSION['role'], $this->admin)) {
            $to = $authorEmail;
            $subject = $solver_name . ' has added a comment on your ticket " ' . $title . ' "';
            $message = $solver_name . ' has added a comment. Please, check in ' . base_url() . ' Thank You.</p>';
        } else {
            // email from user 
            $to = ['aulia.maghfira15@gmail.com']; //admin's email address
            $subject = $authorName . ' has added a comment.';
            $message = $authorName . '<p> has added a comment. Please, check in ' . base_url() . '</p>';
        }

        if ($this->ticketModel->update($id, $datanew)) {
            if ($reply_exp == null) {
                session()->setFlashdata('pesan', 'Tiket berhasil di update');
                session()->setFlashdata('alert-class', 'alert-success');
            } else {
                $this->replyModel->insert($datakomen);
                session()->setFlashdata('pesan', 'Tiket berhasil di update');
                session()->setFlashdata('alert-class', 'alert-success');

                $email = \Config\Services::email();

                $email->setTo($to);
                $email->setFrom('admin@dummy.com', 'HaloTICK, Your Ticketing Partner');

                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    session()->setFlashData('email_send', 'Email sent successfully');
                    session()->setFlashdata('alert-class', 'alert-success');
                } else {
                    session()->setFlashData('email_send', 'Failed to send email');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }
                session()->setFlashdata('pesan', 'Ticket updated successfully');
                session()->setFlashdata('alert-class', 'alert-success');
            }
        } else {
            session()->setFlashdata('pesan', 'Failed to update ticket');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect('ticket');
    }

    public function delete($id)
    { //delete ticket 
        $ticketModel = new Ticket_model();
        $ticketModel->delete($id);
        return redirect('ticket');
    }

    public function add()
    { // show 'add ticket' form
        $nama = $this->session->get('nama');
        $username = $this->session->get('username');
        $query = $this->db->query("SELECT * FROM users WHERE level_id=1");
        $kat = $this->db->query("SELECT * FROM categories");
        $data['mail'] = $query->getRowArray();
        $data['nama'] = $nama;
        $data['orang'] = $query->getResultArray();
        $data['admin'] = $this->admin;
        $data['categories'] = $kat->getResultArray();
        // layout
        echo view("layout/header");
        echo view("layout/navbar");
        echo view("layout/sidebar");
        echo view("ticket_add", $data);
        echo view("layout/footer");
    }

    public function add_new()
    { // add new ticket here 
        helper('date');
        date_default_timezone_set('Asia/Singapore');
        $format = "Y-m-d h:i:s";

        $ticketModel = new Ticket_model();
        $replyModel = new Reply_model();

        $title = $this->request->getPost('title'); //get data dari form 
        $content = $this->request->getPost('content');
        $status = $this->request->getPost('status');
        $authorName = $this->request->getPost('author_name');
        $authorEmail = $this->request->getPost('author_email');
        $category = $this->request->getPost('category');
        $created = date($format);
        $solver_name = $this->request->getPost('solver_name');
        $reply_exp = $this->request->getPost('comment');
        $reply_date = date($format);
        $username = session('username');

        $datanew = [
            'title' => $title,
            'content' => $content,
            'status_id' => 1,
            'author_name' => $authorName,
            'author_email' => $authorEmail,
            'created_at' => $created,
            'solver' => $solver_name,
            'category_id' => $category,
            'username' => $username
        ];

        $datakomen = [
            'name' => $solver_name,
            'reply_date' => $reply_date
        ];



        if ($ticketModel->insert($datanew)) {
            if ($reply_exp != null) {
                $replyModel->insert($datakomen);
            }
            // EMAIL SETTING 
            $to = ['aulia.maghfira15@gmail.com']; //admin's email address
            $subject = 'New ticket';
            $message = '
            <p>Hi, You got a new Ticket.</p>' . 
            '<p>Reporter: ' . $authorName . '</p>' .
            '<p>Problem: </p>' . $title . 
            '<p>For more detail information, please visit <a>' . base_url() . '</p>';
            
            $email = \Config\Services::email();

            $email->setTo($to);
            $email->setFrom('admin@dummy.com', 'HaloTICK, Your Ticketing Partner');

            $email->setSubject($subject);
            $email->setMessage($message);

            if ($email->send()) {
                session()->setFlashData('email_send', 'Email sent successfully');
                session()->setFlashdata('alert-class', 'alert-success');
            } else {
                session()->setFlashData('email_send', 'Failed to send email');
                session()->setFlashdata('alert-class', 'alert-danger');
                // $data = $email->printDebugger(['headers']);
                // print_r($data);
            }
            session()->setFlashdata('pesan_add_tiket', 'Ticket added successfully');
            session()->setFlashdata('alert-class', 'alert-success');
        } else {
            session()->setFlashdata('pesan_add_tiket', 'Failed to add ticket');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        return redirect('ticket');
    }
}
