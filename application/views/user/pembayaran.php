<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('user/pembayaran/') ?>
            <div class="form-group mb-3">
                <div class="col-md-3 mb-1">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <?php echo $t['judul']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $onetoken['id'] ?>">
                <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $user['name'] ?>">
                <input type="hidden" class="form-control" id="harga" name="harga" value="<?php echo $onetoken['harga'] ?>">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $onetoken['judul'] ?>" readonly>
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
            <!-- <div class="form-group mb-3">
                <label for="total">Total</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="total" name="total" readonly>
                    <?php echo form_error('total', '<small class="text-danger pl-3">', '</small>');
                    ?>
                </div>
            </div> -->
            <div class="form-group row justify-content-end">
                <div class="col-sm-12 mt-3">
                    <button type="submit" value="submit" class="btn btn-primary">Lanjut Pembayaran</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>



</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->