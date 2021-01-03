<!-- Begin Page Content -->
<div class="container-fluid">
    <!--THIS IS A DETAIL PRODUCT PAGE-->
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-9">

        <!--alert error-->
        <?= form_error('tkodeobat', '<div class="alert alert-danger" role="alert"> ', ' </div>'); ?>

        <!--alert success-->
        <?= $this->session->flashdata('message'); ?>

    </div>

    <div class="row">

        <div class="col-lg-8">
            <!--ada ini tp gaada isinya-->
            <a href="<?= base_url('menu') ?>" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#transaksiModal">Add</a>

            <a class="btn btn-success " href="<?= base_url('menu/exportPenjualan_Feb') ?>">
                <i class="fas fa-fw fa-file-excel"></i>
                <span>Export</span>
            </a>

            <!--Month Select Buttons Started-->

            <div>
                <a class="btn btn-outline-secondary" href="<?= base_url('menu/penjualan'); ?>">All</a>
                <a class="btn btn-outline-secondary" href="<?= base_url('menu/januari'); ?>">Januari</a>
                <a class="btn btn-outline-secondary" href="<?= base_url('menu/februari'); ?>">Februari</a>
                <a class="btn btn-outline-secondary" href="<?= base_url('menu/maret'); ?>">Maret</a>
            </div>


            <!--Month Select Buttons Ended-->

            <table class="table table-hover mt-3">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">No.</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Jumlah Terjual</th>
                        <th scope="col">Edit | Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data['penjualan'] = $this->db->get('penfebruari');

                    foreach ($data['penjualan']->result_array() as $row) : ?>
                        <tr>
                            <td name="tno"><?= $no++; ?></td>
                            <td><?= $row['KodeObat'] ?></td>
                            <td><?= $row['TglTransaksi'] ?></td>
                            <td><?= $row['Jumlah_Terjual'] ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>menu/editFebruari/<?= $row['id']; ?>" action="" class="btn btn-warning">
                                    Edit
                                </a>
                                <a href="<?php echo base_url(); ?>menu/deletePenFebruari/<?= $row['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" name="btndelete">
                                    Delete
                                </a>
                            </td>
                        </tr>

                    <?php
                    endforeach;

                    ?>
                </tbody>
            </table>
        </div>



    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<div class="modal fade" id="transaksiModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Transaction Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form action="<?= base_url('februari') ?>" method="post">
                    <div class="form-group">
                        <label for="">Kode Obat</label>
                        <input type="text" name="tkodeobat" maxlength="10" value="<?= $kodeobat = "" ?>" class="form-control" placeholder="Kode Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Transaksi</label>
                        <input type="date" name="transaksi" value="<?= $transaksi = "" ?>" class="form-control" placeholder="Tgl Produksi Obat" required>
                    </div>

                    <div class="form-group">
                        <label for="">Jumlah Terjual</label>
                        <input type="number" name="terjual" maxlength="30" value="<?= $terjual = "" ?>" class="form-control" placeholder="Jumlah Terjual" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" href="<?= base_url('februari') ?>" name="btnadd">Save</button>
                    <button type="reset" class="btn btn-secondary mt-3" name="btnreset">Reset</button>

                </form>
            </div>
        </div>
    </div>
</div>



<!-- Button trigger modal -->

<!-- Modal UPDATE OBAT-->
<div class="modal fade" id="updateHargaModal" tabindex="-1" role="dialog" aria-labelledby="updateHargaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateHargaModalLabel">Update Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/updateHarga'); ?>" method="post">

                <?php
                $data = $this->db->get('obat');

                ?>


                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Obat</label>
                        <input type="text" name="tkodeobat" maxlength="10" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Satuan</label>
                        <input type="number" name="thargasatuan" maxlength="30" value="" class="form-control" placeholder="Harga Satuan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" href="<?= base_url('menu/updateHarga') ?>">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>