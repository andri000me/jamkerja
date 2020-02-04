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

        $this->db->join('unit b', 'a.id_unit = b.id');
        $this->db->join('golongan c', 'a.id_gol = c.id');
        $this->db->join('jabatan d', 'a.id_jabatan = d.id');
        $pegawai = $this->my_model->tampil('pegawai a');

        $data['pegawai'] = $pegawai->num_rows();
        $data['pegawailist'] = $pegawai->result();

        $unit = $this->my_model->tampil('unit');
        $data['unit'] = $unit->num_rows();

        $golongan = $this->my_model->tampil('golongan');
        $data['golongan'] = $golongan->num_rows();

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

    public function jabatan()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Kelola Jabatan';

            $jabatan = $this->my_model->tampil('jabatan');
            $data['jabatanlist'] = $jabatan->result();

            $this->load->view('Admin/templateadmin/header', $data);
            $this->load->view('Admin/templateadmin/sidebar', $data);
            $this->load->view('Admin/templateadmin/navbar', $data);
            $this->load->view('Admin/jabatan', $data);
            $this->load->view('Admin/templateadmin/footer', $data);
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function addjab()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $jabatan = trim($this->security->xss_clean($this->input->post('jabatan')));
            $ketjab = trim($this->security->xss_clean($this->input->post('ketjab')));

            $addunit = ['jabatan' => $jabatan, 'keterangan' => $ketjab];
            $jabpush = $this->my_model->tambahdata('jabatan', $addunit);
            if ($jabpush) {
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

    public function hapus_jab($id)
    {
        if ($this->session->userdata('level') == 'Admin') {
            $where = array('id' => $id);
            if ($this->my_model->hapus("jabatan", $where)) {
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

    public function edit_jab($id)
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Edit Jabatan';

            // $data['admin'] = $this->session->userdata('nama');
            // $data['level'] = $this->session->userdata('level');

            $where = array('id' => $id);
            $editjab = $this->my_model->cek_data("jabatan", $where);
            $data['datajabatan'] = $editjab->result();

            $this->load->view('Admin/templateadmin/header', $data);
            $this->load->view('Admin/templateadmin/sidebar', $data);
            $this->load->view('Admin/templateadmin/navbar', $data);
            $this->load->view('Admin/vejab', $data);
            $this->load->view('Admin/templateadmin/footer', $data);
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function updatejab()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Update Jabatan';

            $id = trim($this->security->xss_clean($this->input->post('id')));
            $jabatan = trim($this->security->xss_clean($this->input->post('jabatan')));
            $ketjabatan = trim($this->security->xss_clean($this->input->post('ketjabatan')));

            $whereID = array('id' => $id);
            $data = array('jabatan' => $jabatan, 'keterangan' => $ketjabatan);
            $uppeker = $this->my_model->update("jabatan", $whereID, $data);
            if ($uppeker) {
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         </div>");
                redirect('Admin/jabatan');
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect('Admin/jabatan');
            }
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function golongan()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Kelola Golongan';

            $golongan = $this->my_model->tampil('golongan');
            $data['golonganlist'] = $golongan->result();

            $this->load->view('Admin/templateadmin/header', $data);
            $this->load->view('Admin/templateadmin/sidebar', $data);
            $this->load->view('Admin/templateadmin/navbar', $data);
            $this->load->view('Admin/golongan', $data);
            $this->load->view('Admin/templateadmin/footer', $data);
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function addgol()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $golongan = trim($this->security->xss_clean($this->input->post('golongan')));
            $ketgol = trim($this->security->xss_clean($this->input->post('ketgol')));

            $addgol = ['nm_golongan' => $golongan, 'keterangan' => $ketgol];
            $golpush = $this->my_model->tambahdata('golongan', $addgol);
            if ($golpush) {
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

    public function hapus_gol($id)
    {
        if ($this->session->userdata('level') == 'Admin') {
            $where = array('id' => $id);
            if ($this->my_model->hapus("golongan", $where)) {
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

    public function edit_gol($id)
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Edit Golongan';

            $where = array('id' => $id);
            $editgol = $this->my_model->cek_data("golongan", $where);
            $data['datagol'] = $editgol->result();

            $this->load->view('Admin/templateadmin/header', $data);
            $this->load->view('Admin/templateadmin/sidebar', $data);
            $this->load->view('Admin/templateadmin/navbar', $data);
            $this->load->view('Admin/vegol', $data);
            $this->load->view('Admin/templateadmin/footer', $data);
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }

    public function updategol()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $data['title'] = 'SIMPEG - PIJAY';
            $data['brand'] = 'SIMPEG - PIJAY';
            $data['label'] = 'Update Golongan';

            $id = trim($this->security->xss_clean($this->input->post('id')));
            $golongan = trim($this->security->xss_clean($this->input->post('golongan')));
            $ketgolongan = trim($this->security->xss_clean($this->input->post('ketgolongan')));

            $whereID = array('id' => $id);
            $data = array('nm_golongan' => $golongan, 'keterangan' => $ketgolongan);
            $uppeker = $this->my_model->update("golongan", $whereID, $data);
            if ($uppeker) {
                $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         </div>");
                redirect('Admin/golongan');
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                redirect('Admin/golongan');
            }
        } else {
            $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('admin');
        }
    }
}
