<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mannat Themes">
    <meta name="keyword" content="">

    <title><?= $title ?></title>

    <!-- Theme icon -->
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">

    <!-- Theme Css -->
    <link href="<?= base_url('vendors/syntra/Admin/') ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('vendors/syntra/Admin/') ?>assets/css/slidebars.min.css" rel="stylesheet">
    <link href="<?= base_url('vendors/syntra/Admin/') ?>assets/css/icons.css" rel="stylesheet">
    <link href="<?= base_url('vendors/syntra/Admin/') ?>assets/css/menu.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('vendors/syntra/Admin/') ?>assets/css/style.css" rel="stylesheet">
</head>


<body class="sticky-header">
    <section class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="card-title text-center">
                                            <h5 class="mt-3"><b><?= $judul ?></b></h5>
                                            <h5 class="mt-3"><b><?= $company ?></b></h5>
                                        </div>
                                        <!-- <?= password_hash('admin', PASSWORD_DEFAULT); ?> -->
                                        <?php echo $this->session->flashdata("msg"); ?>
                                        <form class="form mt-5 contact-form" action="<?= base_url('home/cek_login'); ?>" method="post">
                                            <div class="form-group ">
                                                <div class="col-sm-12">
                                                    <input class="form-control form-control-line" type="text" placeholder="Masukan NIP" required="required" name="username">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-12">
                                                    <input class="form-control form-control-line" type="password" placeholder="Password" required="required" name="password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12 mt-4">
                                                    <button class="btn btn-primary btn-block" type="submit">Masuk</button>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <div class="col-sm-12 mt-4 text-center">
                                                    <a href="recoverpw.html"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                                                </div>
                                            </div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery-migrate.js"></script>
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/modernizr.min.js"></script>
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/slidebars.min.js"></script>


    <!--app js-->
    <script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery.app.js"></script>
</body>

</html>