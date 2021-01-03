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
            <a href="" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#newMenuModal">Add</a>
            <a class="btn btn-success " href="<?= base_url('menu/exportPersediaan') ?>">
                <i class="fas fa-fw fa-file-excel"></i>
                <span>Export</span>
            </a>

            <table class="table table-hover mt-2">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">No.</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Stok Obat</th>
                        <th scope="col">Edit | Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    $data = $this->db->get('persediaan');
                    ?>
                    <?php
                    foreach ($data->result_array() as $row) { ?>
                        <tr>
                            <td name="tno"><?= $no++; ?></td>
                            <td><?= $row['KodeObat'] ?></td>
                            <td><?= $row['JumlahSedia'] ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>menu/editPersediaan/<?= $row['KodeObat']; ?>" action="" class="btn btn-warning">
                                    Edit
                                </a>
                                <a href="<?php echo base_url(); ?>menu/deletePersediaan/<?= $row['KodeObat']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger" name="btndelete">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>

        </div>



    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!--MODAL ADD PRODUCT-->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add Persediaan Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form action="<?= base_url('menu/addPersediaan'); ?>" method="post">
                    <div class="form-group">
                        <label for="">Kode Obat</label>
                        <input type="text" name="tkodeobat" maxlength="10" value="" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Sedia</label>
                        <input type="text" name="tjumlahsedia" maxlength="20" value="" class="form-control" placeholder="" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" name="btnadd">Save</button>
                    <button type="reset" class="btn btn-secondary mt-3" name="btnreset">Reset</button>

                </form>
            </div>
        </div>
    </div>
</div>



<!-- Button trigger modal -->