<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>
   <div class="row">
      <div class="col-lg-12 col-sm-12">
         <div class="card m-b-30">
            <div class="card-body">
               <h5 class="header-title pb-3">Ubah Password?</h5>
               <div class="row">
                  <div class="col-12">
                     <div class="card m-b-30">
                        <div class="card-body">
                           <div class="general-label">
                              <form class="form-inline" action="<?= base_url('admindua/updpass') ?>" role="form" method="post">
                                 <div class="form-group">
                                    <?php foreach ($datapeg as $peg) : ?>
                                       <label class="text-capitalize mr-4">Nama Akun : <?= $peg->nama; ?> </label>
                                       <input type="text" name="id" value="<?= $peg->id; ?>" hidden>
                                    <?php endforeach; ?>
                                 </div>
                                 <div class="form-group m-l-10">
                                    <label class="sr-only" for="exampleInputPassword2">Password</label>
                                    <input type="password" name="password" class="form-control ml-2" id="exampleInputPassword2" placeholder="Password">
                                 </div>
                                 <button type="submit" class="btn btn-primary mx-2">Simpan</button>
                                 <a href="<?= base_url('admindua/pegawai') ?>" class="btn btn-warning"> Batal </a>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end row-->
            </div>
         </div>
      </div>
   </div>
</div>