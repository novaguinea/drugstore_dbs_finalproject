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
            <form action="<?= base_url('menu/updateHargaController'); ?>" method="post">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Kode Obat</label>
                        <input type="text" name="tkodeobat" maxlength="10" value="<?= $obat['KodeObat']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Harga Satuan</label>
                        <input type="number" name="thargasatuan" maxlength="30" value="<?= $obat['HargaSatuan']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" href="<?= base_url('menu/updateHargaController') ?>">Save</button>
                </div>

            </form>
        </div>



    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->