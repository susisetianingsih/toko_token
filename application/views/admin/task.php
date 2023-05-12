<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php echo form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?php echo $this->session->flashdata('message'); ?>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Pesan</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Bukti Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pemesanan as $p) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $p['name']; ?></td>
                                <td><?php echo date('d F y', $p['tanggal']); ?></td>
                                <td>
                                    <?php
                                    if ($p['tanggal_bayar'] == 0) {
                                        echo "-";
                                    } else {
                                        echo date('d F y', $p['tanggal_bayar']);
                                    }
                                    ?>
                                </td>
                                <td><?php echo $p['jumlah']; ?></td>
                                <td><?php echo $p['harga']; ?></td>
                                <td><?php echo $p['total']; ?></td>
                                <td>
                                    <?php
                                    if ($p['bukti_bayar'] == null) {
                                        echo "-";
                                    } else {
                                    ?>
                                        <img src="<?php echo base_url('assets/img/bayar/') . $p['bukti_bayar']; ?>" class="img-fluid rounded-start" alt="...">
                                    <?php
                                    }
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    if ($p['bukti_bayar'] == null) { ?>
                                        <button type="button" class="btn btn-warning"><?php echo $p['name_status']; ?></button>
                                        <?php
                                    } else {
                                        if ($p['status'] == 3) {
                                        ?>
                                            <button type="button" class="btn btn-success"><?php echo $p['name_status']; ?></button>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="<?php echo base_url('admin/task/') . $p['id_pemesanan'] ?>" class="btn btn-info" data-toggle="modal" data-target="#konfirmModal<?= $p['id_pemesanan'] ?>"><?php echo $p['name_status']; ?></a>
                                    <?php

                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Main Content -->

<!-- Modal Verifikasi -->
<?php foreach ($pemesanan as $p) : ?>
    <div class="modal fade" id="konfirmModal<?= $p['id_pemesanan'] ?>" tabindex="-1" aria-labelledby="konfirmModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <?php echo form_open_multipart('admin/task') ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="konfirmModal">Pemberian token</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body needs-validation">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_pemesanan" name="id_pemesanan" value="<?= $p['id_pemesanan'] ?>">
                        <input type="text" class="form-control" id="token" name="token" placeholder="Berikan token">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" value="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>