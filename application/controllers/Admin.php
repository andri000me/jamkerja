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
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function addunit()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $unit = trim($this->security->xss_clean($this->input->post('unit')));
            $ketunit = trim($this->security->xss_clean($this->input->post('ketunit')));

            $addunit = ['unit' => $unit, 'keterangan' => $ketunit];
            $unitpush = $this->my_model->tambahdata('unit', $addunit);
            if ($unitpush) {
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil disimpan!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal disimpan<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function hapus_unit($id)
    {
        if ($this->session->userdata('level') == 'Admin') {
            $where = array('id' => $id);
            if ($this->my_model->hapus("unit", $where)) {
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil dihapus!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         </div>");
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal dihapus<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function edit_unit($id)
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Edit Unit';

            // $data['admin'] = $this->session->userdata('nama');
            // $data['level'] = $this->session->userdata('level');

            $where = array('id' => $id);
            $editunit = $this->my_model->cek_data("unit", $where);
            $data['datunit'] = $editunit->result();

            $this->load->view('Admin/templateadmin/header', $data);
            $this->load->view('Admin/templateadmin/sidebar', $data);
            $this->load->view('Admin/templateadmin/navbar', $data);
            $this->load->view('Admin/veunit', $data);
            $this->load->view('Admin/templateadmin/footer', $data);
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }
    public function updateunit()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Update Unit';

            $id = trim($this->security->xss_clean($this->input->post('id')));
            $unit = trim($this->security->xss_clean($this->input->post('unit')));
            $ketunit = trim($this->security->xss_clean($this->input->post('ketunit')));

            $whereID = array('id' => $id);
            $data = array('unit' => $unit, 'keterangan' => $ketunit);
            $uppeker = $this->my_model->update("unit", $whereID, $data);
            if ($uppeker) {
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         </div>");
                redirect('Admin/unit');
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect('Admin/unit');
            }
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }
}
