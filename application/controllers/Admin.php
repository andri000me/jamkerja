<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('my_model');
        $this->load->helper('download');
        // $this->load->helper('myhelper');
        // $this->load->helper(array('url'));
        $this->load->library('pagination');
        ini_set('date.timezone', 'Asia/Jakarta');
        $this->load->model('my_model');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata("msg", "<div class='card bg-danger text-white shadow mb-3'><div class='card-body'>Silahkan login terlebih dahulu</div></div>");
            redirect('Home');
        }
    }

    public function index()
    {
        $data['title'] = 'SIMPEG - PIJAY';
        $data['brand'] = 'SIMPEG - PIJAY';
        $data['label'] = 'Dashboard';

        $pegawai = $this->my_model->tampil('pegawai');
        $data['pegawai'] = $pegawai->num_rows();
        $data['pegawailist'] = $pegawai->result();


        $this->load->view('Admin/templateadmin/header', $data);
        $this->load->view('Admin/templateadmin/sidebar', $data);
        $this->load->view('Admin/templateadmin/navbar', $data);
        $this->load->view('Admin/dashboard', $data);
        $this->load->view('Admin/templateadmin/footer', $data);
    }

    public function unit()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Kelola Unit';

            $pegawai = $this->my_model->tampil('unit');
            $data['unitlist'] = $pegawai->result();

            $this->load->view('Admin/templateadmin/header', $data);
            $this->load->view('Admin/templateadmin/sidebar', $data);
            $this->load->view('Admin/templateadmin/navbar', $data);
            $this->load->view('Admin/unit', $data);
            $this->load->view('Admin/templateadmin/footer', $data);
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Anda dilarang akses fitur ini!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }
}
