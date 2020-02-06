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
                     <h5 class="header-title">Data Beban Tugas <span class="float-right"><a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah Tugas</a></span></h5>
                  </div>
                  <hr>
                  <div class="table-odd">
                     <table id="datatable" class="table table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th>No.</th>
                              <th>NIP</th>
                              <th>Tahun</th>
                              <th>Nama Tugas</th>
                              <th>Beban Kerja</th>
                              <th>Frekwensi</th>
                              <th>BKT</th>
                              <th>SKR</th>
                              <th>WPT</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1;
                           foreach ($bbkerjalist as $bb) : ?>
                              <tr>
                                 <td class="text-center"><?= $no; ?></td>
                                 <td><?= $bb->id_pegawai; ?></td>
                                 <td><?= $bb->tahun; ?></td>
                                 <td><?= $bb->nama_tugas; ?></td>
                                 <td><?= $bb->beban_kerja; ?></td>
                                 <td><?= $bb->freq; ?></td>
                                 <?php
                                 $bkt = $bb->beban_kerja * $bb->freq;
                                 $wpt = $bkt * $bb->skr;
                                 ?>
                                 <td><?php echo $bkt ?></td>
                                 <td><?= $bb->skr; ?></td>
                                 <td><?= $wpt; ?></td>
                                 <td align="center">
                                    <a href="<?= base_url('admindua/edit_beban/'); ?><?= $bb->id; ?>" class="btn btn-primary" title="atur"><i class="fa fa-fw fa-edit (alias)"></i></a>
                                    <a href="<?= base_url('admindua/hapus_beban/') ?><?= $bb->id; ?>" class="btn btn-danger" title="hapus" onclick="return confirm('Anda yakin menghapus?')"><i class=" fa fa-fw fa-trash-o"></i></a>
                                 </td>
                              </tr>
                           <?php $no++;
                           endforeach ?>
                        </tbody>
                     </table>
                  </div>
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

<!--footer section end-->
<form action="<?= base_url('admindua/addbeban') ?>" method="post">
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Tambah Beban Kerja</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-sm-2 control-label">Pegawai</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="nip">
                        <?php foreach ($listpeg as $peg) : ?>
                           <option value="<?= $peg->nip ?>"><?= $peg->nip; ?> (<?= $peg->nama; ?>)</option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 control-label">Tahun</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="tahun">
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 control-label">Tugas</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="tugas">
                        <?php foreach ($listtgs as $tgs) : ?>
                           <option value="<?= $tgs->no_tugas ?>"><?= $tgs->nama_tugas; ?> </option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label for="bkt">Beban Kerja Pertahun</label>
                  <input type="number" class="form-control" id="bkt" name="bkt" placeholder="Masukan bkt">
               </div>
               <div class="form-group">
                  <label for="freq">Frekwensi</label>
                  <input type="number" class="form-control" id="freq" name="freq" placeholder="Masukan Frekwensi">
               </div>
               <div class="form-group">
                  <label for="skr">SKR</label>
                  <input type="number" class="form-control" id="skr" name="skr" placeholder="Masukan SKR">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </div>
      </div>
   </div>
</form>