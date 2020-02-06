<?php
error_reporting('0');
?>
<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>
   <?= $this->session->flashdata('message'); ?>

   <?php if ($this->session->userdata('level') == 'Admin') { ?>
      <div class="row">
         <div class="col-lg-12 col-sm-12">
            <div class="card m-b-30">
               <div class="card-body table-responsive">
                  <div class="m-b-30">
                     <h5 class="header-title">Data Kebutuhan SDM</h5>
                  </div>
                  <hr>
                  <div class="row">
                     <?php foreach ($jablis as $jbl) : ?>
                        <div class="col-lg-6 col-sm-6">
                           <div class="card bg-white m-b-30">
                              <div class="card-body">
                                 <h5 class="header-title pb-3"><?= $jbl['jabatan']; ?></h5>
                                 <div class="">
                                    <?php
                                    foreach ($jbl as $gj) {
                                       $where = ['id_jab' => $gj['id']];
                                       $gettgs = $this->my_model->cek_data('tgs_jab', $where)->result_array();
                                       foreach ($gettgs as $gt) { ?>
                                          <div class="row">
                                             <div class="col-4">
                                                <p>Nomor Tugas</p>
                                             </div>
                                             <div class="col-8">
                                                <p><?= $gt['no_tugas']; ?></p>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-4">
                                                <p>Nama Tugas</p>
                                             </div>
                                             <div class="col-8">
                                                <p><?= $gt['nama_tugas']; ?></p>
                                             </div>
                                          </div>
                                          <?php
                                          // echo $gt['no_tugas'] . ' - ' . $gt['nama_tugas'];
                                          // echo '<br>';
                                          $wheregs = ['no_tugas' => $gt['no_tugas']];
                                          $this->db->join('pegawai b', 'b.nip=a.id_pegawai');
                                          $getbeban = $this->my_model->cek_data('beban_kerja a', $wheregs)->result_array();
                                          // var_dump($getbeban);
                                          foreach ($getbeban as $gb) { ?>
                                             <div class="row">
                                                <div class="col-4">
                                                   <p>Nama Pegawai</p>
                                                </div>
                                                <div class="col-8">
                                                   <p><?= $gb['nama']; ?></p>
                                                </div>
                                             </div>
                                    <?php
                                             $bkt = $gb['beban_kerja'] * $gb['freq'];
                                             $wpt = $bkt * $gb['skr'];
                                             echo '<hr>';
                                             echo $wpt;

                                             echo '<hr>';

                                             $wke = 124740;

                                             $jmlsdm = $wpt / $wke;

                                             echo $jmlsdm;
                                          }
                                       }
                                    }
                                    ?>
                                    <div class="progress my-3" style="height: 14px;">
                                       <div class="progress-bar grad-progress-3" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress my-3" style="height: 14px;">
                                       <div class="progress-bar grad-progress-2" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress my-3" style="height: 14px;">
                                       <div class="progress-bar grad-progress-1" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>
                  </div>
                  <!--end row-->
               </div>
            </div>
         </div>
      </div>
   <?php } else { ?>
      <div class="row align-center">
         <div class="col-lg-12 col-sm-12">
            <div class="card text-center bg-white m-b-30">
               <div class="card-header">
                  Selamat Datang
               </div>
               <div class="card-body">
                  <h5 class="card-title">Afrizal</h5>
                  <p class="card-text">Jabatan</p>
                  <a href="#" class="btn btn-primary">Atur Profil</a>
               </div>
               <div class="card-footer text-muted">
                  2 days ago
               </div>
            </div>
         </div>
      </div>
      <!--end row-->
   <?php } ?>
   <!--end row-->


</div>
<!--end container-->

<!--footer section start-->
<footer class="footer">
   <?= date('Y') ?> &copy; Simpeg UUI.
</footer>