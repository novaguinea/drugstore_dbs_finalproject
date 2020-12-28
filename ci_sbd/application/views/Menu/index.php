<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

        <div class="col-lg-12">
            <a href="" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                Add New Product
            </a>
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
                                <a href="druglist.php?hal=edit&id=<?= $row['id_obat'] ?>" class="btn btn-warning" name="btnedit">
                                    Edit
                                </a>
                                <a href="druglist.php?hal=delete&id=<?= $row['id_obat'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" name="btndelete">
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
                        <input type="date" name="tproduksiobat" value="<?= $tglprod = "" ?>" class="form-control" placeholder="Tgl Produksi Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tgl Kadaluarsa</label>
                        <input type="date" name="tkadaluarsaobat" value="<?= $tglexp = "" ?>" class="form-control" placeholder="Tgl Kadaluarsa Obat" required>
                    </div>
                    <div class="form-group">
                        <label for="">Harga Satuan</label>
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