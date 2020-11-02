<?php
if (isset($_POST['ganti'])) {
    $no_user = $_SESSION['no_user'];
    $passlama  = $_POST['passlama'];
    $passnew   = $_POST['passnew'];
    $repass   = $_POST['repass'];


    $query = mysqli_query($db, "SELECT * FROM users WHERE no='$no_user'");
    $row = mysqli_fetch_object($query);

    if (password_verify($passlama, $row->password)) {
        if ($passnew == $repass) {
            $query1 = mysqli_query($db, "UPDATE users SET password='" . password_hash($passnew, PASSWORD_DEFAULT) .
                "' WHERE no='$no_user'");
            echo "<script>alert('Password Berhasil Diganti')</script>";
            echo "<script>window.location='index.php?page=beranda'</script>";
        } else {
            echo "<script>alert('Password Tidak Sama')</script>";
        }
    } else {
        echo "<script>alert('Password Salah')</script>";
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=beranda">Beranda</a></li>
                    <li class="breadcrumb-item active">Ganti Password</li>
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
                        <h3 class="card-title">Ganti Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" class="form-control" name="passlama" required>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="passnew" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Re-Password</label>
                                <input type="password" name="repass" class="form-control" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=beranda" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="ganti" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->