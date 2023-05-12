<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Toko Token <?php echo date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" dibawah jika Anda ingin mengakhiri session ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/Buttons-2.3.3/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/Buttons-2.3.3/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/Buttons-2.3.3/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/Buttons-2.3.3/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/DataTables/Buttons-2.3.3/js/buttons.colVis.min.js"></script>






<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/sweetalert/sweetalert2.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>

</body>

</html>
<!-- export file -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(functioon() {
        var harga = $("#harga").val();
        var jumlah = $("#jumlah").val();
        var total = parseInt(harga) * parseInt(jumlah);
        $("#total").val(total);
    })

    // function total() {
    //     $harga = document.getElementById('harga').value;
    //     $jumlah = document.getElementById('jumlah').value;
    //     $total = parseInt($harga) * parseInt($jumlah);
    //     document.getElementById('total').value = $total;
    // }
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#Table').DataTable({
            buttons: ['copy', 'excel', 'print', 'pdf', 'colvis']
        });

        table.buttons().container()
            .appendTo('#Table_wrapper .col-md-6:eq(0)');
    });
</script>
<script type="text/javascript">
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });



    $('.menu-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?php echo base_url('admin/changeAccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?php echo base_url('admin/roleaccess/'); ?>" + roleId;
            }
        })
    });
</script>