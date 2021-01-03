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

        <div class="col-lg-6">
            <!--ada ini tp gaada isinya-->
            <form action="<?= base_url('menu/editJanuariController'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Obat</label>
                        <input type="hidden" name="id" maxlength="10" value="<?= $obat['id']; ?>" class="form-control">
                        <input type="text" name="tkodeobat" maxlength="10" value="<?= $obat['KodeObat']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Transaksi</label>
                        <input type="date" name="transaksi" maxlength="30" value="<?= $obat['TglTransaksi']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Terjual</label>
                        <input type="number" name="jmlterjual" maxlength="30" value="<?= $obat['Jumlah_Terjual']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" href="<?= base_url('menu/editJanuariController') ?>">Save</button>
                </div>

            </form>
        </div>



    </div>

</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->