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
    <?php if ($this->session->userdata('level') == 'Admin') { ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex align-items-center">
                                <div class="col-4">
                                    <div class="text-center"><i class="ti ti-user"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="dynamicbar">Loading..</div>
                                </div>
                                <div class="col-4">
                                    <h2 class="m-0 counter"><?= $pegawai ?></h2>
                                    <p>Total Pegawai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex align-items-center text-center">
                                <div class="col-4">
                                    <div class="text-center"><i class="ti ti-eye"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="inlinesparkline">Loading..</div>
                                </div>
                                <div class="col-4">
                                    <h2 class="m-0 counter"><?= $unit ?></h2>
                                    <p>Total Unit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex align-items-center">
                                <div class="col-4">
                                    <div class="text-center"><i class="ti ti-wallet"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="dynamicbar">Loading..</div>
                                </div>
                                <div class="col-4">
                                    <h2 class="m-0 counter"><?= $golongan ?></h2>
                                    <p>Total Golongan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body table-responsive">
                        <h5 class="header-title">Data Pegawai Universitasi Ubudiyah Indonesia</h5>
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
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
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
                                            <td><?= $pg->tempat_lahir ?></td>
                                            <?php
                                            $jadwal = $pg->tgl_lahir;
                                            $tgllahir =  tgl_indo(date($jadwal)); ?>
                                            <td><?= $tgllahir ?></td>
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
            <?= $this->session->flashdata('msg'); ?>
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
    <?= date('Y') ?> &copy; Simpeg-Pijay UUI.
</footer>
<!--end Right Slidebar-->
</div>