<?php
if (isset($_POST['simpan'])) {
    $kd_ktgr  = $_POST['kd_ktgr'];
    $ktgr   = $_POST['ktgr'];

    mysqli_query($db, "UPDATE kategori SET
    nm_kategori = '$ktgr' WHERE kd_kategori ='$kd_ktgr'
    ");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='index.php?page=kategori'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=kategori">Data Kategori Menu</a></li>
                    <li class="breadcrumb-item active">Tambah Kategori Menu</li>
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
                        <h3 class="card-title">Tambah Kategori Menu</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <?php
                            $kd_kategori = $_GET['kd_kategori'];
                            $query  = mysqli_query($db, "SELECT * FROM kategori WHERE kd_kategori='$kd_kategori'");
                            $hitung = mysqli_num_rows($query);
                            if ($hitung > 0) {
                                while ($pecah = mysqli_fetch_assoc($query)) {

                            ?>
                                    <div class="form-group">
                                        <label>KD Kategori</label>
                                        <input type="text" class="form-control" name="kd_ktgr" value="<?php echo  $pecah['kd_kategori']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Menu</label>
                                        <input type="text" name="ktgr" class="form-control" value="<?php echo $pecah['nm_kategori'] ?>" required>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=kategori" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->