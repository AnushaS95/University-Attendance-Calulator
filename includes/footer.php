<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo SITE_URL; ?>logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo SITE_URL; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo SITE_URL; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo SITE_URL; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<?php if (CURRENT_PAGE_NAME == "Index" || CURRENT_PAGE_NAME == "Attendance-report") { ?>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo SITE_URL; ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo SITE_URL; ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo SITE_URL; ?>vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo SITE_URL; ?>js/sb-admin.min.js"></script>
    <!-- Demo scripts for this page-->
    <script src="<?php echo SITE_URL; ?>js/demo/datatables-demo.js"></script>
    <script src="<?php echo SITE_URL; ?>js/demo/chart-area-demo.js"></script>
<?php } ?>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    function changeUserActivity(current, userid) {
        $.ajax({
            method: "POST",
            url: "<?php echo SITE_URL; ?>includes/ajax.php",
            data: {userid: userid, action: 'changeUserStatus'},
            dataType: "json"
        }).done(function (response) {
            if (response.success == 0) {
                alert(response.message);
            }
            if (response.success == 1) {
                $(current).attr("data-original-title", response.title);
                $(current).find("i").removeClass().addClass("fa " + response.html);
            }
        });
    }
</script>
</body>
</html>