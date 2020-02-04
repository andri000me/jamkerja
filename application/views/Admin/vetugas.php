<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>
   <div class="row">
      <div class="col-lg-10 col-sm-10">
         <div class="card m-b-30">
            <div class="card-body">
               <h5 class="header-title pb-3">Edit Tugas</h5>
               <div class="general-label">
                  <?php foreach ($vetugas as $tgs) : ?>
                     <form action="<?= base_url('admindua/updatetugas'); ?>" method="post">
                        <input type="text" name="id" value="<?= $tgs->id; ?>" hidden>
                        <div class="form-group">
                           <label for="notgs">No Tugas</label>
                           <input type="number" class="form-control" id="notgs" value="<?= $tgs->no_tugas; ?>" name="notugas">
                        </div>
                        <div class="form-group">
                           <label for="nmtugas">Nama Tugas</label>
                           <input type="text" class="form-control" id="nmtugas" name="nmtugas" value="<?= $tgs->nama_tugas; ?>">
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 control-label" for="ketunit">Unit</label>
                           <div class="col-sm-6">
                              <select class="form-control" name="unit">
                                 <option selected value="<?= $tgs->id_unit; ?>"><?= $tgs->unit; ?> (selected)</option>
                                 <?php foreach ($unitlist as $unit) : ?>
                                    <option value="<?= $unit->id ?>"><?= $unit->unit; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 control-label">Periode</label>
                           <div class="col-sm-6">
                              <select class="form-control" name="periode">
                                 <option selected value="<?= $tgs->periode; ?>"><?= $tgs->periode; ?> (selected)</option>
                                 <option value="Perhari">Perhari</option>
                                 <option value="Persemester">Persemester</option>
                                 <option value="Pertahun">Pertahun</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="wpt">Total WPT (dalam Menit)</label>
                           <input type="number" class="form-control col-8" id="wpt" name="wpt" value="<?= $tgs->total_wpt; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                     </form>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>