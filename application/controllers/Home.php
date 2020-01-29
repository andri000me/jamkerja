<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('my_model');
        $this->load->helper('download');
        // $this->load->helper(array('url'));
        $this->load->library('pagination');
        ini_set('date.timezone', 'Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = 'SIMPEG - Sekda Pijay';
        $data['judul'] = 'Selamat Datang di Sistem Pegawai';
        $data['company'] = 'Sekretaris Daerah Pidie Jaya';
        $this->load->view('login', $data);
    }

    public function cek_login()
    {
        $username = trim($this->security->xss_clean($this->input->post('username')));
        $password = trim($this->security->xss_clean($this->input->post('password')));

        $where = array('nip' => $username);
        $akses = $this->my_model->cek_data("pegawai", $where);
        if ($akses->num_rows() >= 1) {
            $data = $akses->row_array();
            if (password_verify($password, $data['password'])) {
                $session['username'] = $data['nip'];
                $session['nama'] = $data['nama'];
                $session['unit'] = $data['id_unit'];
                $session['level'] = $data['level'];
                $this->session->set_userdata($session);
                redirect('admin');
            } else {
                $this->session->set_flashdata("msg", "<div class='alert alert-info alert-dismissible fade show' role='alert'>Username atau Password Salah!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect('Home');
                echo 'salah password';
            }
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-info alert-dismissible fade show' role='alert'>Username atau Password Salah!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('Home');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Home');
    }
}
