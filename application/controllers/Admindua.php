<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admindua extends CI_Controller
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

   public function pegawai()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Data Pegawai';

         $this->db->select('a.id,a.nama,c.nm_golongan,b.unit,d.jabatan,b.unit,a.nip');
         $this->db->join('unit b', 'a.id_unit = b.id');
         $this->db->join('golongan c', 'a.id_gol = c.id');
         $this->db->join('jabatan d', 'a.id_jabatan = d.id');
         $pegawai = $this->my_model->tampil('pegawai a');
         $data['pegawai'] = $pegawai->num_rows();
         $data['pegawailist'] = $pegawai->result();

         $golongan = $this->my_model->tampil('golongan');
         $data['golonganlist'] = $golongan->result();

         $unit = $this->my_model->tampil('unit');
         $data['unitlist'] = $unit->result();

         $jabatan = $this->my_model->tampil('jabatan');
         $data['jabatanlist'] = $jabatan->result();

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/pegawai', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function addpegawai()
   {
      if ($this->session->userdata('level') == 'Admin') {

         $nip = trim($this->security->xss_clean($this->input->post('nip')));
         $nmPegawai = trim($this->security->xss_clean($this->input->post('nmPegawai')));
         $password = trim($this->security->xss_clean($this->input->post('password')));
         $tmplahir = trim($this->security->xss_clean($this->input->post('tmplahir')));
         $tgllahir = trim($this->security->xss_clean($this->input->post('tgllahir')));
         $alamat = trim($this->security->xss_clean($this->input->post('alamat')));
         $telp = trim($this->security->xss_clean($this->input->post('telp')));
         $golongan = trim($this->security->xss_clean($this->input->post('golongan')));
         $unit = trim($this->security->xss_clean($this->input->post('unit')));
         $jabatan = trim($this->security->xss_clean($this->input->post('jabatan')));
         $akses = trim($this->security->xss_clean($this->input->post('akses')));

         $pass = password_hash($password, PASSWORD_DEFAULT);

         $addpeg = ['nip' => $nip, 'nama' => $nmPegawai, 'password' => $pass, 'tempat_lahir' => $tmplahir, 'tgl_lahir' => $tgllahir, 'alamat' => $alamat, 'no_telp' => $telp, 'id_gol' => $golongan, 'id_unit' => $unit, 'id_jabatan' => $jabatan, 'level' => $akses];
         $pegpush = $this->my_model->tambahdata('pegawai', $addpeg);
         if ($pegpush) {
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

   public function hapus_pegawai($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $where = array('id' => $id);
         if ($this->my_model->hapus("pegawai", $where)) {
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

   public function edit_pegawai($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Edit Pegawai';

         $where = array('a.id' => $id);
         $this->db->select('a.id,a.nip,a.nama,a.tempat_lahir,a.tgl_lahir,a.alamat,a.no_telp,a.id_gol,a.id_unit,a.id_jabatan,a.level, b.unit, c.nm_golongan,d.jabatan');
         $this->db->join('unit b', 'a.id_unit = b.id');
         $this->db->join('golongan c', 'a.id_gol = c.id');
         $this->db->join('jabatan d', 'a.id_jabatan = d.id');
         $edipeg = $this->my_model->cek_data("pegawai a", $where);
         $data['datapeg'] = $edipeg->result();

         $golongan = $this->my_model->tampil('golongan');
         $data['golonganlist'] = $golongan->result();

         $unit = $this->my_model->tampil('unit');
         $data['unitlist'] = $unit->result();

         $jabatan = $this->my_model->tampil('jabatan');
         $data['jabatanlist'] = $jabatan->result();


         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/vepegawai', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function updatepeg()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $id = trim($this->security->xss_clean($this->input->post('id')));
         $nip = trim($this->security->xss_clean($this->input->post('nip')));
         $nmPegawai = trim($this->security->xss_clean($this->input->post('nmPegawai')));
         // $password = trim($this->security->xss_clean($this->input->post('password')));
         $tmplahir = trim($this->security->xss_clean($this->input->post('tmplahir')));
         $tgllahir = trim($this->security->xss_clean($this->input->post('tgllahir')));
         $alamat = trim($this->security->xss_clean($this->input->post('alamat')));
         $telp = trim($this->security->xss_clean($this->input->post('telp')));
         $golongan = trim($this->security->xss_clean($this->input->post('golongan')));
         $unit = trim($this->security->xss_clean($this->input->post('unit')));
         $jabatan = trim($this->security->xss_clean($this->input->post('jabatan')));
         $akses = trim($this->security->xss_clean($this->input->post('akses')));

         $whereID = array('id' => $id);
         $updatepeg = ['nip' => $nip, 'nama' => $nmPegawai, 'tempat_lahir' => $tmplahir, 'tgl_lahir' => $tgllahir, 'alamat' => $alamat, 'no_telp' => $telp, 'id_gol' => $golongan, 'id_unit' => $unit, 'id_jabatan' => $jabatan, 'level' => $akses];

         $uppeg = $this->my_model->update("pegawai", $whereID, $updatepeg);
         if ($uppeg) {
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         </div>");
            redirect('Admindua/pegawai');
         } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('Admindua/pegawai');
         }
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function vepass($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Ubah Password';

         $whereid = array('id' => $id);
         $edipeg = $this->my_model->cek_data("pegawai", $whereid);
         $data['datapeg'] = $edipeg->result();

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/ubahpassword', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function updpass()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $id = trim($this->security->xss_clean($this->input->post('id')));
         $pass = trim($this->security->xss_clean($this->input->post('password')));

         $password = password_hash($pass, PASSWORD_DEFAULT);

         $whereID = array('id' => $id);
         $updpaspeg = ['password' => $password];

         $uppaspeg = $this->my_model->update("pegawai", $whereID, $updpaspeg);
         if ($uppaspeg) {
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
         </div>");
            redirect('Admindua/pegawai');
         } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('Admindua/pegawai');
         }
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function detail_pegawai($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Edit Pegawai';

         $whereid = array('a.id' => $id);
         // $this->db->select('a.id,a.nip,a.nama,a.tempat_lahir,a.tgl_lahir,a.alamat,a.no_telp,a.id_gol,a.id_unit,a.id_jabatan,a.level, b.unit, c.nm_golongan,d.jabatan');
         $this->db->join('unit b', 'a.id_unit = b.id');
         $this->db->join('golongan c', 'a.id_gol = c.id');
         $this->db->join('jabatan d', 'a.id_jabatan = d.id');
         $detailpeg = $this->my_model->cek_data("pegawai a", $whereid);
         $data['detailpeg'] = $detailpeg->result();

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/detail_pegawai', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function tugas()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Data Tugas';

         $jab = $this->my_model->tampil('jabatan');
         $data['jablist'] = $jab->result();

         $this->db->select('a.id,a.no_tugas,a.nama_tugas,a.periode,a.total_wpt,b.jabatan');
         $this->db->join('jabatan b', 'a.id_jab = b.id');
         $tugas = $this->my_model->tampil('tgs_jab a');
         $data['tugaslist'] = $tugas->result();


         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/tugas', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function addtugas()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $notugas = trim($this->security->xss_clean($this->input->post('notugas')));
         $nmtugas = trim($this->security->xss_clean($this->input->post('nmtugas')));
         $jab = trim($this->security->xss_clean($this->input->post('jab')));
         $periode = trim($this->security->xss_clean($this->input->post('periode')));
         $wpt = trim($this->security->xss_clean($this->input->post('wpt')));

         $addtugas = ['no_tugas' => $notugas, 'nama_tugas' => $nmtugas, 'id_jab' => $jab, 'periode' => $periode, 'total_wpt' => $wpt];
         $unitpush = $this->my_model->tambahdata('tgs_jab', $addtugas);
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

   public function hapus_tugas($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $where = array('id' => $id);
         if ($this->my_model->hapus("tgs_jab", $where)) {
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

   public function edit_tugas($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Edit Tugas';

         $whereid = array('a.id' => $id);
         $this->db->select('a.id,a.no_tugas,a.nama_tugas,a.periode,a.total_wpt,a.id_jab,b.jabatan');
         $this->db->join('jabatan b', 'a.id_jab = b.id');
         $vtugas = $this->my_model->cek_data('tgs_jab a', $whereid)->result();
         $data['vetugas'] = $vtugas;

         $jab = $this->my_model->tampil('jabatan');
         $data['jablist'] = $jab->result();

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/vetugas', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function updatetugas()
   {
      if ($this->session->userdata('level') == 'Admin') {
         // var_dump($_POST);
         $id = trim($this->security->xss_clean($this->input->post('id')));

         $notugas = trim($this->security->xss_clean($this->input->post('notugas')));
         $nmtugas = trim($this->security->xss_clean($this->input->post('nmtugas')));
         $jab = trim($this->security->xss_clean($this->input->post('jab')));
         $periode = trim($this->security->xss_clean($this->input->post('periode')));
         $wpt = trim($this->security->xss_clean($this->input->post('wpt')));

         $whereID = array('id' => $id);
         $updatgs = ['no_tugas' => $notugas, 'nama_tugas' => $nmtugas, 'id_jab' => $jab, 'periode' => $periode, 'total_wpt' => $wpt];

         $uppeg = $this->my_model->update("tgs_jab", $whereID, $updatgs);
         if ($uppeg) {
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            </div>");
            redirect('Admindua/tugas');
         } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('Admindua/tugas');
         }
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function beban_kerja()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Data Beban Tugas';

         $this->db->order_by('a.id');
         $this->db->select('a.id,a.id_pegawai,a.tahun,b.nama_tugas,a.beban_kerja,a.freq,a.skr');
         $this->db->join('tgs_jab b', 'b.no_tugas=a.no_tugas');
         $bbkerja = $this->my_model->tampil('beban_kerja a');
         $data['bbkerjalist'] = $bbkerja->result();

         $pegawailis = $this->my_model->tampil('pegawai');
         $data['listpeg'] = $pegawailis->result();

         $tugaslis = $this->my_model->tampil('tgs_jab');
         $data['listtgs'] = $tugaslis->result();

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/beban', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function addbeban()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $nip = trim($this->security->xss_clean($this->input->post('nip')));
         $tahun = trim($this->security->xss_clean($this->input->post('tahun')));
         $tugas = trim($this->security->xss_clean($this->input->post('tugas')));
         $bkt = trim($this->security->xss_clean($this->input->post('bkt')));
         $freq = trim($this->security->xss_clean($this->input->post('freq')));
         $skr = trim($this->security->xss_clean($this->input->post('skr')));

         $addbb = ['id_pegawai' => $nip, 'tahun' => $tahun, 'no_tugas' => $tugas, 'beban_kerja' => $bkt, 'freq' => $freq, 'skr' => $skr];
         $bbpush = $this->my_model->tambahdata('beban_kerja', $addbb);
         if ($bbpush) {
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

   public function hapus_beban($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $where = array('id' => $id);
         if ($this->my_model->hapus("beban_kerja", $where)) {
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

   public function edit_beban($id)
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Edit Tugas';

         $whereid = array('a.id' => $id);
         $this->db->select('a.id,a.id_pegawai,a.tahun,c.nama_tugas,a.beban_kerja,a.freq,a.skr,b.nama,a.no_tugas');
         $this->db->join('tgs_jab c', 'a.no_tugas=c.no_tugas');
         $this->db->join('pegawai b', 'b.nip=a.id_pegawai');
         $edbeban = $this->my_model->cek_data('beban_kerja a', $whereid);
         $data['edbebanlist'] = $edbeban->result();

         $pegawailis = $this->my_model->tampil('pegawai');
         $data['listpeg'] = $pegawailis->result();

         $tugaslis = $this->my_model->tampil('tgs_jab');
         $data['listtgs'] = $tugaslis->result();

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/vebeban', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function updatebeban()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $id = trim($this->security->xss_clean($this->input->post('id')));
         $nip = trim($this->security->xss_clean($this->input->post('nip')));
         $tahun = trim($this->security->xss_clean($this->input->post('tahun')));
         $tugas = trim($this->security->xss_clean($this->input->post('tugas')));
         $bkt = trim($this->security->xss_clean($this->input->post('bkt')));
         $freq = trim($this->security->xss_clean($this->input->post('freq')));
         $skr = trim($this->security->xss_clean($this->input->post('skr')));

         $whereID = array('id' => $id);
         $updbbkerja = ['id_pegawai' => $nip, 'tahun' => $tahun, 'no_tugas' => $tugas, 'beban_kerja' => $bkt, 'freq' => $freq, 'skr' => $skr];

         $upbb = $this->my_model->update("beban_kerja", $whereID, $updbbkerja);
         if ($upbb) {
            $this->session->set_flashdata("message", "<div class='alert alert-success alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Data berhasil diupdate!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            </div>");
            redirect('Admindua/beban_kerja');
         } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-bug'></i></span> Data Gagal diupdate<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect('Admindua/beban_kerja');
         }
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }

   public function analisasdm()
   {
      if ($this->session->userdata('level') == 'Admin') {
         $data['title'] = 'SIMPEG - PIJAY';
         $data['brand'] = 'SIMPEG - PIJAY';
         $data['label'] = 'Analisa SDM';

         $getjab = $this->my_model->tampil('jabatan')->result_array();
         // $getjab = $this->my_model->tampil('jabatan');
         $data['jablis'] = $getjab;

         foreach ($getjab as $gj) {
            $where = ['id_jab' => $gj['id']];
            $gettgs = $this->my_model->cek_data('tgs_jab', $where)->result_array();
            foreach ($gettgs as $gt) {
               // echo $gt['no_tugas'] . ' - ' . $gt['nama_tugas'];
               // echo '<br>';
               $wheregs = ['no_tugas' => $gt['no_tugas']];
               $getbeban = $this->my_model->cek_data('beban_kerja', $wheregs)->result_array();
               // var_dump($getbeban);
               foreach ($getbeban as $gb) {
                  // var_dump($gb);
               }
            }
         }

         $this->load->view('Admin/templateadmin/header', $data);
         $this->load->view('Admin/templateadmin/sidebar', $data);
         $this->load->view('Admin/templateadmin/navbar', $data);
         $this->load->view('Admin/analisasdm', $data);
         $this->load->view('Admin/templateadmin/footer', $data);
      } else {
         $this->session->set_flashdata("msg", "<div class='alert alert-warning alert-wth-icon alert-dismissible fade show' role='alert'><span class='alert-icon-wrap'><i class='zmdi zmdi-check-circle'></i></span>Anda tidak boleh Mengakses Fitur Admin!.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
         redirect('admin');
      }
   }
}
