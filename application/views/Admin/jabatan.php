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
                     <h5 class="header-title">Data Unit Sekda Pidie Jaya <span class="float-right"><a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah Jabatan</a></span></h5>
                  </div>
                  <hr>
                  <div class="table-odd">
                     <table id="datatable" class="table table-bordered">
                        <thead>
                           <tr class="text-center">
                              <th>No.</th>
                              <th>Jabatan</th>
                              <th>Keterangan</th>
                              <th>Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1;
                           foreach ($jabatanlist as $jab) : ?>
                              <tr>
                                 <td class="text-center"><?= $no; ?></td>
                                 <td><?= $jab->jabatan; ?></td>
                                 <td><?= $jab->keterangan; ?></td>
                                 <td align="center">
                                    <a href="<?= base_url('admin/edit_jab/'); ?><?= $jab->id; ?>" class="btn btn-primary" title="atur"><i class="fa fa-fw fa-edit (alias)"></i></a>
                                    <a href="<?= base_url('admin/hapus_jab/') ?><?= $jab->id; ?>" class="btn btn-danger" title="hapus" onclick="return confirm('Anda yakin menghapus?')"><i class=" fa fa-fw fa-trash-o"></i></a>
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
<form action="<?= base_url('admin/addjab') ?>" method="post">
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="unit">Nama Jabatan</label>
                  <input type="text" class="form-control" id="unit" placeholder="Masukan Jabatan" name="jabatan">
               </div>
               <div class="form-group">
                  <label for="ketunit">Keterangan</label>
                  <input type="text" class="form-control" id="ketunit" name="ketjab" placeholder="Masukan Keterangan">
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