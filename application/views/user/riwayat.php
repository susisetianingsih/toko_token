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
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pemesanan as $p) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo date('d F y', $p['tanggal']); ?></td>
                                <td><?php echo $p['jumlah']; ?></td>
                                <td><?php echo $p['harga']; ?></td>
                                <td><?php echo $p['total']; ?></td>
                                <td>
                                    <?php
                                    if ($p['bukti_bayar'] == null) { ?>

                                        <a href="<?php echo base_url('user/riwayat/') . $p['id_pemesanan'] ?>" class="btn btn-warning" data-toggle="modal" data-target="#bayarModal<?= $p['id_pemesanan'] ?>"><?php echo $p['name_status']; ?></a>
                                        <?php
                                    } else {
                                        if ($p['status'] == 3) {
                                        ?>
                                            <a href="<?php echo base_url('user/lihat_token/') . $p['id_pemesanan'] ?>" class="btn btn-success" data-toggle="modal" data-target="#lihatModal<?= $p['id_pemesanan'] ?>">Lihat Token</a>
                                        <?php
                                        } else {
                                        ?>
                                            <button type="button" class="btn btn-info"><?php echo $p['name_status']; ?></button>
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
    <div class="modal fade" id="bayarModal<?= $p['id_pemesanan'] ?>" tabindex="-1" aria-labelledby="bayarModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <?php echo form_open_multipart('user/riwayat') ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="bayarModal">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="id_pelanggan">Total pembayaran</label>
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                <?php echo 'Rp' . $p['total']; ?>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="id_pemesanan" name="id_pemesanan" value="<?php echo $p['id_pemesanan'] ?>">

                    </div>
                    <div class="form-group mb-3">
                        <label for="id_pelanggan">Info </label>
                        <ul>
                            <li>BRI : XXXXXXXX</li>
                            <li>Gopay : XXXXXXXX</li>
                        </ul>

                    </div>
                    <div class="form-group mb-3">
                        <label for="metode">Pilih Metode Pembayaran</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metode" id="metode" value="bri">
                            <label class="form-check-label" for="metode">
                                BRI
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metode" id="metode" value="gopay">
                            <label class="form-check-label" for="metode">
                                Gopay
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bukti_bayar" name="bukti_bayar">
                            <label class="custom-file-label" for="bukti_bayar">Unggah bukti pembayaran</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" value="submit" class="btn btn-primary">Bayar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal lihat token -->
<?php foreach ($pemesanan as $p) : ?>
    <div class="modal fade" id="lihatModal<?= $p['id_pemesanan'] ?>" tabindex="-1" aria-labelledby="lihatModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lihatModal">Token</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="id_pelanggan">Token Anda </label>
                        <input type="text" class="form-control" id="token" name="token" value="<?php echo $p['token'] ?>" readonly>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>