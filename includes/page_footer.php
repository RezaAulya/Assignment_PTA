<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>v</b>
        <?php echo $app_version  . ' | <b>Today</b> : ' . date("d-m-Y")   ;?>
    </div>
    <strong><?= $cpr . ' | ' . $app_name  ?></strong>
</footer>

</div>
<!-- ./wrapper -->





<!-- Bootstrap js -->
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/bootstrap/bootstrap.min.js' ?>"></script>
<!-- Style js -->
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/inilabs/style.js' ?>"></script>

<!-- Jquery datatable tools js -->
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/tools/jquery.dataTables.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/tools/dataTables.buttons.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/tools/jszip.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/tools/pdfmake.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/tools/vfs_fonts.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/tools/buttons.html5.min.js' ?>"></script>
<!-- dataTables Tools / -->
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datatables/dataTables.bootstrap.js' ?>"></script>

<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/inilabs/inilabs.js' ?>"></script>


<!-- Jquery gritter -->
<!-- datatable with buttons -->
<script>
    $(document).ready(function () {
        $('#example3, #example1, #example2').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            search: false
        });
    });
</script>
<!-- dataTable with buttons end -->

<script type="text/javascript">
    $(function () {
        $("#withoutBtn").dataTable();
    });
</script>

    <script type="text/javascript">
        $("ul.sidebar-menu li").each(function (index, value) {

            if ($(this).attr('class') == 'active') {
                $(this).parents('li').addClass('active');
            }

        });
    </script>
    </body>
</html>



