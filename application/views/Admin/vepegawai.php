<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>
   <div class="row">
      <div class="col-lg-12 col-sm-12">
         <div class="card m-b-30">
            <div class="card-body">
               <h5 class="header-title pb-3">Edit Unit</h5>
               <div class="general-label">
                  <?php foreach ($datapeg as $peg) : ?>
                     <form action="<?= base_url('admindua/updatepeg'); ?>" method="post">
                        <input type="text" name="id" value="<?= $peg->id; ?>" hidden>
                        <div class="form-group row">
                           <label class="col-md-2 control-label">NIP</label>
                           <div class="col-md-10">
                              <input type="number" class="form-control" value="<?= $peg->nip; ?>" name="nip">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-md-2 control-label">Nama Lengkap</label>
                           <div class="col-md-10">
                              <input type="text" class="form-control" value="<?= $peg->nama; ?>" name="nmPegawai">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-md-2 control-label">Password</label>
                           <div class="col-md-6">
                              <input type="password" class="form-control" name="password" value="#####" disabled>
                           </div>
                           <div class="col-md-2">
                              <a href="" class="badge bg-danger m-1">Ubah Password ?</a>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-md-2 control-label">Tempat Lahir</label>
                           <div class="col-md-10">
                              <input type="text" class="form-control" value="<?= $peg->tempat_lahir; ?>" name="tmplahir">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="example-date-input" class="col-2 col-form-label">Tanggal Lahir</label>
                           <div class="col-6">
                              <input class="form-control" type="date" id="example-date-input" name="tgllahir" value="<?= $peg->tgl_lahir; ?>">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-md-2 control-label">Alamat Lengkap</label>
                           <div class="col-md-10">
                              <textarea class="form-control" rows="5" name="alamat"><?= $peg->alamat; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="example-tel-input" class="col-2 col-form-label">No. Telpon</label>
                           <div class="col-10">
                              <input class="form-control" type="tel" id="example-tel-input" value="<?= $peg->no_telp; ?>" name="telp">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 control-label">Golongan</label>
                           <div class="col-sm-10">
                              <select class="form-control" name="golongan">
                                 <option selected value="<?= $peg->id_gol; ?>"><?= $peg->nm_golongan; ?> (Terpilih)</option>
                                 <?php foreach ($golonganlist as $golist) : ?>
                                    <option value="<?= $golist->id ?>"><?= $golist->nm_golongan; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 control-label">Unit</label>
                           <div class="col-sm-10">
                              <select class="form-control" name="unit">
                                 <option selected value="<?= $peg->id_unit; ?>"><?= $peg->unit; ?> (Terpilih)</option>
                                 <?php foreach ($unitlist as $unli) : ?>
                                    <option value="<?= $unli->id ?>"><?= $unli->unit; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 control-label">Jabatan</label>
                           <div class="col-sm-10">
                              <select class="form-control" name="jabatan">
                                 <option selected value="<?= $peg->id_jabatan; ?>"><?= $peg->jabatan; ?> (Terpilih)</option>
                                 <?php foreach ($jabatanlist as $unjab) : ?>
                                    <option value="<?= $unjab->id ?>"><?= $unjab->jabatan; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-md-2 my-1 control-label">Peran akses</label>
                           <div class="col-md-10">
                              <?php if ($peg->level == "Admin") : ?>
                                 <div class="form-check-inline my-1">
                                    <label class="cr-styled" for="example-radio4">
                                       <input type="radio" id="example-radio4" name="akses" value="Admin" checked>
                                       <i class="fa"></i>
                                       Admin
                                    </label>
                                 </div>
                                 <div class="form-check-inline my-1">
                                    <label class="cr-styled" for="example-radio5">
                                       <input type="radio" id="example-radio5" name="akses" value="Pegawai">
                                       <i class="fa"></i>
                                       Pegawai
                                    </label>
                                 </div>
                              <?php else : ?>
                                 <div class="form-check-inline my-1">
                                    <label class="cr-styled" for="example-radio4">
                                       <input type="radio" id="example-radio4" name="akses" value="Admin">
                                       <i class="fa"></i>
                                       Admin
                                    </label>
                                 </div>
                                 <div class="form-check-inline my-1">
                                    <label class="cr-styled" for="example-radio5">
                                       <input type="radio" id="example-radio5" name="akses" value="Pegawai" checked>
                                       <i class="fa"></i>
                                       Pegawai
                                    </label>
                                 </div>
                              <?php endif; ?>
                           </div>
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