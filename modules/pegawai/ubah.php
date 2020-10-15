<?php
if (isset($_POST['simpan'])) {
    $kd_pgw  = $_POST['kd_pgw'];
    $nm_pgw   = $_POST['nm_pgw'];
    $jk = $_POST['jk'];
    $status  = $_POST['status'];
    $alamat  = $_POST['alamat'];
    $nohp  = $_POST['nohp'];

    mysqli_query($db, "UPDATE pegawai SET
    nm_pegawai ='$nm_pgw',
    jk = '$jk',
    status = '$status',
    alamat = '$alamat',
    no_telp = '$nohp' WHERE id_pegawai = '$kd_pgw'");


    echo "<script>alert('Data Berhasil Diubah')</script>";
    echo "<script>window.location='index.php?page=pgw'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pgw">Data Pegawai</a></li>
                    <li class="breadcrumb-item active">Ubah Data Pegawai</li>
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
                        <h3 class="card-title">Ubah Data Pegawai</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?php
                    $id_pegawai = $_GET['id_pegawai'];
                    $query  = mysqli_query($db, "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'");
                    $hitung = mysqli_num_rows($query);
                    if ($hitung > 0) {
                        while ($pecah = mysqli_fetch_assoc($query)) {
                    ?>
                            <form role="form" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Kode Pegawai</label>
                                        <input type="text" class="form-control" name="kd_pgw" value="<?php echo  $pecah['id_pegawai']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input type="text" class="form-control" name="nm_pgw" value="<?php echo  $pecah['nm_pegawai']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input type="radio" name="jk" value="Laki-Laki" <?php if ($pecah['jk'] == "Laki-Laki") {
                                                                                                echo "checked='true'";
                                                                                            } ?>>
                                            <label>Laki-Laki</label>&ensp;&ensp;&ensp;
                                            <input type="radio" name="jk" value="Perempuan" <?php if ($pecah['jk'] == "Perempuan") {
                                                                                                echo "checked='true'";
                                                                                            } ?>>
                                            <label>Perempuan</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option <?php if ($pecah['status'] == "Admin") {
                                                        echo "selected='true'";
                                                    } ?>>Admin</option>
                                            <option <?php if ($pecah['status'] == "Owner") {
                                                        echo "selected='true'";
                                                    } ?>>Owner</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" cols="30" rows="5" class="form-control" required><?php echo $pecah['alamat'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input type="number" name="nohp" class="form-control" value="<?php echo $pecah['no_telp'] ?>" required>
                                    </div>
                                </div>
                        <?php }
                    } ?>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=pgw" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                            </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->