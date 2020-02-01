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
   <div class="row">
      <div class="col-lg-12 col-sm-12">
         <div class="card m-b-30">
            <div class="card-body">
               <h5 class="header-title pb-3">Detail Pegawai</h5>
               <div class="general-label">
                  <div class="row">
                     <?php foreach ($detailpeg as $peg) : ?>
                        <div class="col-lg-12 col-sm-12">
                           <div class="card bg-white m-b-30">
                              <h5 class="card-header bg-secondary text-capitalize">Data Detail Pegawai</h5>
                              <div class="card-body">
                                 <div class="col-lg-8 col-sm-12">
                                    <div class="card bg-secondary m-b-30">
                                       <div class="card-body">
                                          <div class="card-title border-b mb-4">
                                             <h5 class="text-capitalize"><?= $peg->nama ?> </h5>
                                          </div>
                                          <dl class="row">
                                             <dt class="col-sm-3">NIP</dt>
                                             <dd class="col-sm-9"><?= $peg->nip ?></dd>

                                             <dt class="col-sm-3">Tempat Lahir</dt>
                                             <dd class="col-sm-9 text-capitalize"><?= $peg->tempat_lahir ?></dd>

                                             <dt class="col-sm-3">Tanggal Lahir</dt>
                                             <?php $tgllahirpeg = $peg->tgl_lahir;
                                             $tgllahir = tgl_indo($tgllahirpeg);
                                             ?>
                                             <dd class="col-sm-9 text-capitalize"><?= $tgllahir ?></dd>

                                             <dt class="col-sm-3">Alamat</dt>
                                             <dd class="col-sm-9">
                                                <p><?= $peg->alamat ?></p>
                                             </dd>

                                             <dt class="col-sm-3">Telepon</dt>
                                             <dd class="col-sm-9 text-capitalize"><?= $peg->no_telp ?></dd>

                                             <dt class="col-sm-3">Golongan</dt>
                                             <dd class="col-sm-9 text-capitalize"><?= $peg->nm_golongan ?></dd>

                                             <dt class="col-sm-3">Unit</dt>
                                             <dd class="col-sm-9 text-capitalize"><?= $peg->unit ?></dd>

                                             <dt class="col-sm-3">Jabatan</dt>
                                             <dd class="col-sm-9 text-capitalize"><?= $peg->jabatan ?></dd>

                                          </dl>
                                          <a href="<?= base_url('admindua/pegawai') ?>" class="btn btn-primary"> Kembali </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>