<?php
if (isset($_POST['simpan'])) {
    $kd_bahan  = $_POST['kd_bahan'];
    $suplier   = $_POST['suplier'];
    $bahan   = $_POST['bahan'];
    $stok   = $_POST['stok'];
    $expired = $_POST['expired'];

    mysqli_query($db, "INSERT INTO bahan_bk(kd_bahanbk,id_suplier,nm_bahanbk,tgl_expire) VALUES ('$kd_bahan','$suplier','$bahan','$expired')");

    mysqli_query($db, "INSERT INTO stok(kd_bahanbk,stok) VALUES ('$kd_bahan','$stok')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=bahanbk'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=bahanbk">Data Bahan Baku</a></li>
                    <li class="breadcrumb-item active">Tambah Bahan Baku</li>
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
                        <h3 class="card-title">Tambah Bahan Baku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>ID Bahan Baku</label>
                                <?php

                                $sql1  = "SELECT max(kd_bahanbk) AS terakhirpas FROM bahan_bk";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 6, 4);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "BAHAN-" . sprintf("%04s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="kd_bahan" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Suplier</label>
                                <select name="suplier" class="form-control">
                                    <?php $query  = mysqli_query($db, "SELECT suplier.id_suplier,suplier.nm_suplier FROM suplier");
                                    $hitung = mysqli_num_rows($query);
                                    if ($hitung > 0) {
                                        while ($pecah = mysqli_fetch_assoc($query)) { ?>
                                            <option value="<?php echo $pecah['id_suplier']; ?>"><?php echo $pecah['nm_suplier']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bahan Baku</label>
                                <input type="text" name="bahan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Expired</label>
                                <input type="date" name="expired" class="form-control" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=bahanbk" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->