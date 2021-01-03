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
                    <button type="submit" class="btn btn-primary" id="submit" onclick="display()" href="<?= base_url('menu/updateHargaController') ?>">Save</button>
                </div>

            </form>
        </div>



    </div>

</div>

<script>
    function display() {
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;

        var dates = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        var fullDate = dates + "/" + month + "/" + year;

        var host = '<?= $user['name']; ?>';
        var arows = '<?= $this->db->affected_rows() ?>'

        if (document.getElementById('submit').innerHTML) {

            window.alert("Data Obat berhasil di UPDATE!" +
                "\nDimodifikasi : " + fullDate + " " + strTime +
                "\nNama Host : " + host +
                "\n(" + arows + " row(s) affected)"
            );

        }

    }
</script>
<!-- /.container-fluid -->

<!-- End of Main Content -->