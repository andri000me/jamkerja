<?php
error_reporting('0');
function tgl_indo($date)
{
   $bulan = array(
      1 => 'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
   );
   $pecahkan = explode('-', $date);
   return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<div class="container-fluid">
   <div class="page-head">
      <h4 class="mt-2 mb-2"><?= $label; ?></h4>
   </div>

   <?= $this->session->flashdata('message'); ?>

   <div class="row">
      <div class="col-lg-12 col-sm-12">
         <div class="card m-b-30">
            <div class="card-body table-responsive">
               <h5 class="header-title">Data Pegawai <span class="float-right"><a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah Pegawai</a></span></h5>
               <hr>
               <div class="table-odd">
                  <table id="datatable" class="table table-bordered">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>NIP</th>
                           <th>Nama Lengkap</th>
                           <th>Golongan</th>
                           <th>unit</th>
                           <th>Jabatan</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;
                        foreach ($pegawailist as $pg) : ?>
                           <tr>
                              <td align="center"><?= $no; ?></td>
                              <td><?= $pg->nip; ?></td>
                              <td><?= $pg->nama; ?></td>
                              <td><?= $pg->nm_golongan ?></td>
                              <td><?= $pg->unit ?></td>
                              <td><?= $pg->jabatan ?></td>
                              <td align="center">
                                 <a href="<?= base_url('admindua/edit_pegawai/'); ?><?= $pg->id; ?>" class="btn btn-primary" title="atur"><i class="fa fa-fw fa-edit (alias)"></i></a> |
                                 <a href="<?= base_url('admindua/detail_pegawai/'); ?><?= $pg->id; ?>" class="btn btn-warning" title="detil"><i class="fa fa-fw fa fa-drivers-license-o"></i></a> |
                                 <a href="<?= base_url('admindua/hapus_pegawai/'); ?><?= $pg->id; ?>" onclick="return confirm('Anda yakin menghapus?')" class="btn btn-danger" title="hapus"><i class="fa fa-fw fa fa-trash"></i></a>
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
</div>

<!-- modal -->
<form action="<?= base_url('admindua/addpegawai') ?>" method="post" class="form-horizontal" role="form">
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group row">
                  <label class="col-md-2 control-label">NIP</label>
                  <div class="col-md-10">
                     <input type="number" class="form-control" placeholder="Masukan Nomor Pegawai..." name="nip">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-2 control-label">Nama Lengkap</label>
                  <div class="col-md-10">
                     <input type="text" class="form-control" placeholder="Masukan Nama lengkap..." name="nmPegawai">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-2 control-label">Password</label>
                  <div class="col-md-10">
                     <input type="password" class="form-control" placeholder="Masukan password..." name="password">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-2 control-label">Tempat Lahir</label>
                  <div class="col-md-10">
                     <input type="text" class="form-control" placeholder="Masukan Tempat Lahir..." name="tmplahir">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-6">
                     <input class="form-control" type="date" id="example-date-input" name="tgllahir">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-2 control-label">Alamat Lengkap</label>
                  <div class="col-md-10">
                     <textarea class="form-control" rows="5" name="alamat"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="example-tel-input" class="col-2 col-form-label">No. Telpon</label>
                  <div class="col-10">
                     <input class="form-control" type="tel" id="example-tel-input" placeholder="1234" name="telp">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 control-label">Golongan</label>
                  <div class="col-sm-10">
                     <select class="form-control" name="golongan">
                        <option selected>--Pilih Golongan--</option>
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
                        <option selected>--Pilih Unit--</option>
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
                        <option selected>--Pilih Jabatan--</option>
                        <?php foreach ($jabatanlist as $unjab) : ?>
                           <option value="<?= $unjab->id ?>"><?= $unjab->jabatan; ?></option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-2 my-1 control-label">Peran akses</label>
                  <div class="col-md-10">
                     <div class="form-check-inline my-1">
                        <label class="cr-styled" for="example-radio4">
                           <input type="radio" id="example-radio4" name="akses" value="Admin">
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
                  </div>
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
<!-- endmodal -->