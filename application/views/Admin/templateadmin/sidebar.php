<!-- sidebar left start-->
<div class="sidebar-left">
    <div class="sidebar-left-info">

        <div class="user-box">
            <div class="d-flex justify-content-center">
                <img src="<?= base_url('vendors/syntra/Admin/') ?>assets/images/users/avatar-1.jpg" alt="" class="img-fluid rounded-circle">
            </div>
            <div class="text-center text-white mt-2">
                <h6><?= $this->session->userdata('nama') ?></h6>
                <?php if ($this->session->userdata('unit') == '1' or ($this->session->userdata('unit') == '12')) : ?>
                    <p class="text-muted m-0">Admin</p>
                <?php else : ?>
                    <p class="text-muted m-0">Pegawai</p>
                <?php endif; ?>
            </div>
        </div>

        <!--sidebar nav start-->
        <ul class="side-navigation">
            <?php if ($this->session->userdata('level') == 'Admin') { ?>
                <!-- kelola simpeg -->
                <li>
                    <h3 class="navigation-title">Penglola SIMPEG</h3>
                </li>
                <li class="active">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-gauge"></i> <span>Dashboard</span></a>
                </li>
                <li class="menu-list"><a href=""><i class="mdi mdi-buffer"></i> <span>Kelola Komponen</span></a>
                    <ul class="child-list">
                        <li><a href="<?= base_url('admin/unit'); ?>"> Kelola Unit</a></li>
                        <li><a href="<?= base_url('admin/jabatan'); ?>"> Kelola Jabatan</a></li>
                        <li><a href="<?= base_url('admin/golongan'); ?>"> Kelola Golongan</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="mdi mdi-account"></i> <span>Kelola Data</span></a>
                    <ul class="child-list">
                        <li><a href="<?= base_url('admindua/pegawai'); ?>"> Pegawai </a></li>
                        <li><a href="<?= base_url('admindua/tugas'); ?>"> Tugas </a></li>
                        <!-- <li><a href="<?= base_url('admindua/pegawai'); ?>"> Beban Kerja </a></li> -->
                    </ul>
                </li>
                <!-- end kelola simpeg -->
                <li>
                    <h3 class="navigation-title">Kelola Profil</h3>
                </li>
                <li class="active">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-account-circle"></i> <span>Analisis</span></a>
                </li>
                <!-- <li class="">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-paperclip"></i> <span>Lembar Kerja</span></a>
                </li>
                <li class="">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-account-convert"></i> <span>Pengajuan Izin</span></a>
                </li> -->
            <?php } else { ?>
                <li>
                    <h3 class="navigation-title">Kelola Profil</h3>
                </li>
                <li class="active">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-account-circle"></i> <span>Analisis</span></a>
                </li>
                <!-- <li class="">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-paperclip"></i> <span>Lembar Kerja</span></a>
                </li>
                <li class="">
                    <a href="<?= base_url('Admin') ?>"><i class="mdi mdi-account-convert"></i> <span>Pengajuan Izin</span></a>
                </li> -->
            <?php } ?>
        </ul>
        <!--sidebar nav end-->
    </div>
</div><!-- sidebar left end-->

<!-- body content start-->
<div class="body-content">
    <!-- header section start-->
    <div class="header-section">
        <!--logo and logo icon start-->
        <div class="logo">
            <a href="<?= base_url('admin') ?>">
                <span class="logo-img">
                    <!-- <img src="<?= base_url('vendors/syntra/Admin/') ?>assets/images/download.jpg" alt="" height="26"> -->
                </span>
                <!--<i class="fa fa-maxcdn"></i>-->
                <span class="brand-name"><?= $brand ?></span>
            </a>
        </div>