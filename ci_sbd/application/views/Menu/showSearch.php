<!--THIS IS A DETAIL PRODUCT PAGE-->

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

        <!--SEARCH FEATURE STARTED-->
        <div class="">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('menu/searchObat'); ?>">
                <div class="input-group">
                    <?php echo form_open('menu/showSearch') ?>
                    <input type="text" class="shadow bg-white rounded form-control bg-light border-0 small" placeholder="KodeObat" name="keyword">
                    <div class="input-group-append">
                        <input class="btn btn-success" type="submit" name="submit" value="">
                    </div>
                    <?php echo form_close() ?>
                </div>
            </form>

        </div>
        <!--SEARCH FEATURE ENDED-->

    </div>

    <div class="row mt-3">

        <div class="col-lg-12">
            <!--ada ini tp gaada isinya-->
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
                        <th scope="col">Stok Obat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    ?>
                    <?php foreach ($obat as $row) : ?>
                        <?php  ?>
                        <tr>
                            <td name="tno"><?= $no++; ?></td>
                            <td><?= $row['KodeObat'] ?></td>
                            <td><?= $row['NamaObat'] ?></td>
                            <td><?= $row['BentukObat'] ?></td>
                            <td><?= $row['TglProduksi'] ?></td>
                            <td><?= $row['TglKadaluarsa'] ?></td>
                            <td>Rp. <?= $row['HargaSatuan'] ?></td>
                            <td><?= $row['JumlahSedia'] ?></td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>



    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->