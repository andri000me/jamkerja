<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>
   <div class="row">
      <div class="col-lg-12 col-sm-12">
         <div class="card m-b-30">
            <div class="card-body">
               <h5 class="header-title pb-3">Edit Golongan</h5>
               <div class="general-label">
                  <?php foreach ($datagol as $gol) : ?>
                     <form action="<?= base_url('admin/updategol'); ?>" method="post">
                        <input type="text" name="id" value="<?= $gol->id; ?>" hidden>
                        <div class="form-group">
                           <label for="unit">Nama Golongan</label>
                           <input type="text" class="form-control" id="jabatan" value="<?= $gol->nm_golongan; ?>" name="golongan">
                        </div>
                        <div class="form-group">
                           <label for="ketunit">Keterangan</label>
                           <input type="text" class="form-control" id="ketunit" name="ketgolongan" value="<?= $gol->keterangan; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </form>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>