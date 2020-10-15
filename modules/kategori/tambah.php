<?php
if (isset($_POST['simpan'])) {
    $kd_ktgr  = $_POST['kd_ktgr'];
    $ktgr   = $_POST['ktgr'];

    mysqli_query($db, "INSERT INTO kategori(kd_kategori,nm_kategori) VALUES ('$kd_ktgr','$ktgr')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
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
                            <div class="form-group">
                                <label>KD Kategori</label>
                                <?php

                                $sql1  = "SELECT max(kd_kategori) AS terakhirpas FROM kategori";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 5, 2);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "KTGR-" . sprintf("%02s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="kd_ktgr" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Kategori Menu</label>
                                <input type="text" name="ktgr" class="form-control" required>
                            </div>
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