<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>


    <?php echo $this->session->flashdata('message'); ?>

    <div class="row g-0">
        <?php foreach ($token as $t) : ?>
            <div class="col-md-3 mb-1">
                <a class="nav-link" href="<?php echo base_url('user/verifikasi/') . $t['id'] ?>" data-toggle="modal" data-target="#tambahModal<?= $t['id'] ?>">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <?php echo $t['judul']; ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Main Content -->

<!-- Modal Verifikasi -->
<?php foreach ($token as $t) : ?>
    <div class="modal fade" id="tambahModal<?= $t['id'] ?>" tabindex="-1" aria-labelledby="tambahModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <?php echo form_open_multipart('user/pemesanan') ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModal">Verifikasi Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $t['id'] ?>">
                        <input type="hidden" class="form-control" id="email_user" name="email_user" value="<?php echo $user['email'] ?>">
                        <input type="hidden" class="form-control" id="harga" name="harga" value="<?php echo $t['harga'] ?>">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $t['judul'] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_pelanggan">ID Pelanggan</label>
                        <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan">
                        <?php echo form_error('id_pelanggan', '<small class="text-danger pl-3">', '</small>');
                        ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="1">
                        <?php echo form_error('jumlah', '<small class="text-danger pl-3">', '</small>');
                        ?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="hidden" class="form-control" id="total" name="total" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" value="submit" class="btn btn-primary">Pesan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

</div>