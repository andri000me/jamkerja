<!--end body content-->
</section>

<!-- jQuery -->
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/popper.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery-migrate.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/modernizr.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/slidebars.min.js"></script>

<!--plugins js-->
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/counter/jquery.counterup.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/sparkline-chart/jquery.sparkline.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/pages/jquery.sparkline.init.js"></script>

<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/chart-js/Chart.bundle.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/morris-chart/raphael-min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/morris-chart/morris.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/pages/dashboard-init.js"></script>

<!-- Responsive and datatable js -->
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!--app js-->
<script src="assets/js/jquery.app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable(),
            $('#datatable2').DataTable();
    });
</script>

<!--app js-->
<script src="<?= base_url('vendors/syntra/Admin/') ?>assets/js/jquery.app.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>
</body>

</html>