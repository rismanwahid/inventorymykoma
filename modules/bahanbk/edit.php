<?php
if (isset($_POST['simpan'])) {
    $kd_bahan  = $_POST['kd_bahan'];
    $suplier   = $_POST['suplier'];
    $bahan   = $_POST['bahan'];
    $stok   = $_POST['stok'];
    $expired = $_POST['expired'];

    mysqli_query($db, "UPDATE bahan_bk SET
    id_suplier = '$suplier',
    nm_bahanbk = '$bahan',
    tgl_expire = '$expired' WHERE kd_bahanbk = '$kd_bahan'");

    mysqli_query($db, "UPDATE stok SET    
    stok = '$stok' WHERE kd_bahanbk = '$kd_bahan'");

    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='index.php?page=bahanbk'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=bahanbk">Data Bahan Baku</a></li>
                    <li class="breadcrumb-item active">Edit Bahan Baku</li>
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
                        <h3 class="card-title">Edit Bahan Baku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <?php
                        $kd_bahanbk = $_GET['kd_bahanbk'];
                        $query  = mysqli_query($db, "SELECT bahan_bk.*,stok.*,suplier.nm_suplier FROM bahan_bk JOIN stok ON stok.kd_bahanbk=bahan_bk.kd_bahanbk JOIN suplier ON bahan_bk.id_suplier=suplier.id_suplier WHERE bahan_bk.kd_bahanbk='$kd_bahanbk'");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {
                        ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ID Bahan Baku</label>
                                        <input type="text" class="form-control" name="kd_bahan" value="<?php echo  $pecah['kd_bahanbk']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Suplier</label>
                                        <select name="suplier" class="form-control">
                                            <?php
                                            $query = mysqli_query($db, "SELECT * FROM suplier");

                                            while ($row = mysqli_fetch_array($query)) {
                                                if ($pecah['id_suplier'] == $row['id_suplier']) {
                                                    echo "<option value=$row[id_suplier] selected>$row[nm_suplier]</option>";
                                                } else {
                                                    echo "<option value=$row[id_suplier]>$row[nm_suplier]</option>";
                                                }
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bahan Baku</label>
                                        <input type="text" name="bahan" class="form-control" value="<?php echo $pecah['nm_bahanbk']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Expired</label>
                                        <input type="date" name="expired" class="form-control" value="<?php echo $pecah['tgl_expire']; ?>" required>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        <?php }
                        } ?>

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