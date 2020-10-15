<?php
if (isset($_POST['simpan'])) {
    $id_supl  = $_POST['id_supl'];
    $nm_supl   = $_POST['nm_supl'];
    $alamat   = $_POST['alamat'];
    $notelp   = $_POST['notelp'];
    $norek = $_POST['norek'];
    $bank  = $_POST['bank'];

    mysqli_query($db, "UPDATE suplier SET
    nm_suplier = '$nm_supl',
    alamat  = '$alamat',
    telp    = '$notelp',
    norek   = '$norek',
    bank    = '$bank' WHERE id_suplier = '$id_supl'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='index.php?page=suplier'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pgw">Data Suplier</a></li>
                    <li class="breadcrumb-item active">Edit Data Suplier</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Suplier</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <?php
                        $id_suplier = $_GET['id_suplier'];
                        $query  = mysqli_query($db, "SELECT * FROM suplier WHERE id_suplier='$id_suplier'");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ID Suplier</label>
                                        <input type="text" class="form-control" name="id_supl" value="<?php echo  $pecah['id_suplier']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Suplier</label>
                                        <input type="text" class="form-control" name="nm_supl" value="<?php echo  $pecah['nm_suplier']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" cols="30" rows="5" class="form-control" required><?php echo  $pecah['alamat']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>No Telephone</label>
                                        <input type="number" name="notelp" class="form-control" value="<?php echo  $pecah['telp']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No Rekening</label>
                                        <input type="number" name="norek" class="form-control" value="<?php echo  $pecah['norek']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank</label>
                                        <input type="text" name="bank" class="form-control" value="<?php echo  $pecah['bank']; ?>" required>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        <?php }
                        } ?>

                        <div class="card-footer">
                            <a href="index.php?page=suplier" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->