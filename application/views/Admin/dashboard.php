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
                                    <h2 class="m-0 counter"><?= $jmldirektorat ?></h2>
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
                                    <h2 class="m-0 counter"><?= $jmlprodi ?></h2>
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
                                        <th>NIK/NIDN</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pegawailist as $pg) : ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $pg->nip; ?></td>
                                            <td><?= $pg->nama; ?></td>
                                            <td><?= $pg->tempat_lahir ?></td>
                                            <?php
                                            $jadwal = $pg->tgl_lahir;
                                            $tgllahir =  tgl_indo(date($jadwal)); ?>
                                            <td><?= $tgllahir ?></td>
                                            <td align="center">
                                                <a href="" class="btn btn-primary" title="atur"><i class="fa fa-fw fa-edit (alias)"></i></a>
                                                <a href="" class="btn btn-danger" title="detil"><i class="fa fa-fw fa fa-drivers-license-o"></i></a>
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
    <?= date('Y') ?> &copy; Simpeg UUI.
</footer>
<!--footer section end-->


<!-- Right Slidebar start -->
<div class="sb-slidebar sb-right sb-style-overlay">
    <div class="right-bar slimscroll">
        <span class="r-close-btn sb-close"><i class="fa fa-times"></i></span>

        <ul class="nav nav-tabs nav-justified-">
            <li class="">
                <a href="#chat" class="active" data-toggle="tab">Chat</a>
            </li>
            <li class="">
                <a href="#activity" data-toggle="tab">Activity</a>
            </li>
            <li class="">
                <a href="#settings" data-toggle="tab">Settings</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="chat">
                <div class="online-chat">
                    <div class="online-chat-container">
                        <div class="chat-list">
                            <form class="search-content" action="index.html" method="post">
                                <input type="text" class="form-control" name="keyword" placeholder="Search...">
                                <span class="search-button"><i class="ti ti-search"></i></span>
                            </form>
                        </div>
                        <div class="side-title-alt">
                            <h2>online</h2>
                        </div>

                        <ul class="team-list chat-list-side">
                            <li>
                                <a href="#" class="ml-3">
                                    <span class="thumb-small">
                                        <img class="rounded-circle" src="assets/images/users/avatar-1.jpg" alt="">
                                        <i class="online dot"></i>
                                    </span>
                                    <div class="inline">
                                        <span class="name">Alison Jones</span>
                                        <small class="text-muted">Start exploring</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="ml-3">
                                    <span class="thumb-small">
                                        <img class="rounded-circle" src="assets/images/users/avatar-3.jpg" alt="">
                                        <i class="online dot"></i>
                                    </span>
                                    <div class="inline">
                                        <span class="name">Jonathan Smith</span>
                                        <small class="text-muted">Alien Inside</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="ml-3">
                                    <span class="thumb-small">
                                        <img class="rounded-circle" src="assets/images/users/avatar-4.jpg" alt="">
                                        <i class="away dot"></i>
                                    </span>
                                    <div class="inline">
                                        <span class="name">Anjelina Doe</span>
                                        <small class="text-muted">Screaming...</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="ml-3">
                                    <span class="thumb-small">
                                        <img class="rounded-circle" src="assets/images/users/avatar-5.jpg" alt="">
                                        <i class="busy dot"></i>
                                    </span>
                                    <div class="inline">
                                        <span class="name">Franklin Adam</span>
                                        <small class="text-muted">Don't lose the hope</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="ml-3">
                                    <span class="thumb-small">
                                        <img class="rounded-circle" src="assets/images/users/avatar-6.jpg" alt="">
                                        <i class="online dot"></i>
                                    </span>
                                    <div class="inline">
                                        <span class="name">Jeff Crowford </span>
                                        <small class="text-muted">Just flying</small>
                                    </div>
                                </a>
                            </li>
                        </ul>

                        <div class="side-title-alt mb-3">
                            <h2>Friends</h2>
                        </div>
                        <ul class="list-unstyled friends">
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-7.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-8.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-9.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-10.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-2.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-1.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-3.jpg" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="rounded-circle" src="assets/images/users/avatar-4.jpg" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane " id="activity">

                <div class="aside-widget">
                    <div class="side-title-alt">
                        <h2>Recent Activity</h2>
                    </div>
                    <ul class="team-list chat-list-side info">
                        <li>
                            <span class="thumb-small">
                                <i class="fa fa-pencil"></i>
                            </span>
                            <div class="inline">
                                <span class="name">Mary Brown open a new company</span>
                                <span class="time">just now</span>
                            </div>
                        </li>
                        <li>
                            <span class="thumb-small">
                                <i class="fa fa-user-plus"></i>
                            </span>
                            <div class="inline">
                                <span class="name">Mary Brown send a new message </span>
                                <span class="time">50 min ago</span>
                            </div>
                        </li>
                        <li>
                            <span class="thumb-small">
                                <i class="fa fa-wrench"></i>
                            </span>
                            <div class="inline">
                                <span class="name">Holly Cobb Uploaded 6 new photos.</span>
                                <span class="time">3 Week Ago</span>
                            </div>
                        </li>
                        <li>
                            <span class="thumb-small">
                                <i class="fa fa-users"></i>
                            </span>
                            <div class="inline">
                                <span class="name">Mary Brown open a new company.</span>
                                <span class="time">1 Month Ago</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="aside-widget">

                    <div class="side-title-alt">
                        <h2>Events</h2>
                    </div>
                    <ul class="team-list chat-list-side info statistics border-less-list">
                        <li>
                            <div class="inline">
                                <p class="mb-1">Jamie Miller</p>
                                <span class="name">Contrary to popular belief, Lorem Ipsum is not simply random text.</span>
                                <span class="time text-muted">2 Week Ago</span>
                            </div>
                        </li>
                        <li>
                            <div class="inline">
                                <p class="mb-1">Robert Jones</p>
                                <span class="name">Lorem Ipsum is simply dummy text of the printing and typesetting .</span>
                                <span class="time text-muted">1 Month Ago</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane " id="settings">
                <div class="side-title-alt">
                    <h6 class="mb-0">Account Setting</h6>
                </div>
                <ul class="team-list chat-list-side info statistics border-less-list setting-list">
                    <li>
                        <div class="inline">
                            <span class="name">Auto updates</span>
                        </div>
                        <span class="thumb-small">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e" data-size="small" />
                        </span>
                    </li>
                    <li>
                        <div class="inline">
                            <span class="name">Show offline Contacts</span>
                        </div>
                        <span class="thumb-small">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e" data-size="small" />
                        </span>
                    </li>

                    <li>
                        <div class="inline">
                            <span class="name">Location Permission</span>
                        </div>
                        <span class="thumb-small">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e" data-size="small" />
                        </span>
                    </li>
                </ul>

                <div class="side-title-alt">
                    <h6 class="mb-0">General Setting</h6>
                </div>
                <ul class="team-list chat-list-side info statistics border-less-list setting-list">
                    <li>
                        <div class="inline">
                            <span class="name">Show me Online</span>
                        </div>
                        <span class="thumb-small">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e" data-size="small" />
                        </span>
                    </li>
                    <li>
                        <div class="inline">
                            <span class="name">Status visible to all</span>
                        </div>
                        <span class="thumb-small">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e" data-size="small" />
                        </span>
                    </li>

                    <li>
                        <div class="inline">
                            <span class="name">Notifications</span>
                        </div>
                        <span class="thumb-small">
                            <input type="checkbox" checked data-plugin="switchery" data-color="#079c9e" data-size="small" />
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--end Right Slidebar-->
</div>