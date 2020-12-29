<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-9">

        <!--alert error-->
        <?= form_error('tkodeobat', '<div class="alert alert-danger" role="alert"> ', ' </div>'); ?>

        <!--alert success-->
        <?= $this->session->flashdata('message'); ?>

    </div>

    <div class="row">

        <div class="col-lg-12">
            <!--ada ini tp gaada isinya-->
            <a href="" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#newMenuModal">Add New Product</a>

            <table class="table table-hover">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">No.</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Bentuk Obat</th>
                        <th scope="col">Tgl Produksi</th>
                        <th scope="col">Tgl Kadaluarsa</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Edit | Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    $data = $this->db->get('obat');
                    ?>
                    <?php
                    foreach ($data->result_array() as $row) : ?>
                        <tr>
                            <td name="tno"><?= $no++; ?></td>
                            <td><?= $row['KodeObat'] ?></td>
                            <td><?= $row['NamaObat'] ?></td>
                            <td><?= $row['BentukObat'] ?></td>
                            <td><?= $row['TglProduksi'] ?></td>
                            <td><?= $row['TglKadaluarsa'] ?></td>
                            <td><?= $row['HargaSatuan'] ?></td>
                            <td>
                                <a href="druglist.php?hal=edit&id=<?= $row['id'] ?>" class="btn btn-warning" name="btnedit">
                                    Edit
                                </a>
                                <a href="druglist.php?hal=delete&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" name="btndelete">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!--card form started-->
        <div class="card mt-5 w-75">
            <div class="card-header bg-dark text-light">
                Drug Input Form
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="tkodeobat" maxlength="10" value="<?= @$kodeobat ?>" class="form-control" placeholder="Kode Obat" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tnamaobat" maxlength="20" value="<?= @$namaobat ?>" class="form-control" placeholder="Nama Obat" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tbentukobat" maxlength="10" value="<?= @$bentukobat ?>" class="form-control" placeholder="Bentuk Obat" required>
                    </div>
                    <div class="form-group">
                        <input type="date" name="tproduksiobat" value="<?= $tglprod = "" ?>" class="form-control" placeholder="Tgl Produksi Obat" required>
                    </div>
                    <div class="form-group">
                        <input type="date" name="tkadaluarsaobat" value="<?= $tglexp = "" ?>" class="form-control" placeholder="Tgl Kadaluarsa Obat" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="thargasatuan" maxlength="30" value="<?= $hargasatuan = "" ?>" class="form-control" placeholder="Harga Satuan" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" name="btnadd">Save</button>
                    <button type="reset" class="btn btn-secondary mt-3" name="btnreset">Reset</button>

                </form>
            </div>
        </div>

        <!--card form ended-->

    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Product Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Kode Obat</label>
                        <input type="text" name="tkodeobat" maxlength="10" value="<?= @$kodeobat ?>" class="form-control" placeholder="Kode Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Obat</label>
                        <input type="text" name="tnamaobat" maxlength="20" value="<?= @$namaobat ?>" class="form-control" placeholder="Nama Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Bentuk Obat</label>
                        <input type="text" name="tbentukobat" maxlength="10" value="<?= @$bentukobat ?>" class="form-control" placeholder="Bentuk Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Produksi</label>
                        <input type="date" name="tproduksiobat" value="<?= $tglprod ?>" class="form-control" placeholder="Tgl Produksi Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Kadaluarsa</label>
                        <input type="date" name="tkadaluarsaobat" value="<?= $tglexp ?>" class="form-control" placeholder="Tgl Kadaluarsa Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Harga Satuan</label>
                        <input type="number" name="thargasatuan" maxlength="30" value="<?= $hargasatuan ?>" class="form-control" placeholder="Harga Satuan" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" name="btnadd">Save</button>
                    <button type="reset" class="btn btn-secondary mt-3" name="btnreset">Reset</button>

                </form>
            </div>
        </div>
    </div>
</div>