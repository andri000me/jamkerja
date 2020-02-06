<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>
   <div class="row">
      <div class="col-lg-10 col-sm-10">
         <div class="card m-b-30">
            <div class="card-body">
               <h5 class="header-title pb-3">Edit Beban</h5>
               <div class="general-label">
                  <?php foreach ($edbebanlist as $tgs) : ?>
                     <form action="<?= base_url('admindua/updatebeban'); ?>" method="post">
                        <input type="text" name="id" value="<?= $tgs->id; ?>" hidden>
                        <div class="form-group row">
                           <label class="col-sm-2 control-label">Pegawai</label>
                           <div class="col-sm-10">
                              <select class="form-control" name="nip">
                                 <option value="<?= $tgs->id_pegawai ?>" selected><?= $tgs->id_pegawai ?> - <?= $tgs->nama ?>(Selected)</option>
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
                                 <option value="<?= $tgs->tahun ?>" selected><?= $tgs->tahun ?>(Selected)</option>
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
                                 <option value="<?= $tgs->no_tugas ?>" selected><?= $tgs->nama_tugas ?> - <?= $tgs->no_tugas ?>(Selected)</option>
                                 <?php foreach ($listtgs as $ls) : ?>
                                    <option value="<?= $ls->no_tugas ?>"><?= $ls->nama_tugas; ?> - <?= $ls->no_tugas ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="bkt">Beban Kerja Pertahun</label>
                           <input type="number" class="form-control" id="bkt" name="bkt" value="<?= $tgs->beban_kerja ?>">
                        </div>
                        <div class="form-group">
                           <label for="freq">Frekwensi</label>
                           <input type="number" class="form-control" id="freq" name="freq" value="<?= $tgs->freq ?>">
                        </div>
                        <div class="form-group">
                           <label for="skr">SKR</label>
                           <input type="number" class="form-control" id="skr" name="skr" value="<?= $tgs->skr ?>">
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