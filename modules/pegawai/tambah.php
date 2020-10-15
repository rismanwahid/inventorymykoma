<?php
if (isset($_POST['simpan'])) {
    $kd_pgw  = $_POST['kd_pgw'];
    $nm_pgw   = $_POST['nm_pgw'];
    $email   = $_POST['email'];
    $pass   = $_POST['email'];
    $jk = $_POST['jk'];
    $status  = $_POST['status'];
    $alamat  = $_POST['alamat'];
    $nohp  = $_POST['nohp'];

    $result = mysqli_query($db, "SELECT email FROM users WHERE email='$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Email Sudah Terdaftar')</script>";
        echo "<script>window.location='index.php?page=tampgw'</script>";

        return false;
    }


    mysqli_query($db, "INSERT INTO pegawai(id_pegawai,nm_pegawai,jk,status,alamat,no_telp) VALUES ('$kd_pgw','$nm_pgw','$jk','$status','$alamat','$nohp')");

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO users(id_pegawai,email,password,level) VALUES ('$kd_pgw','$email','$pass','$status')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=pgw'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pgw">Data Pegawai</a></li>
                    <li class="breadcrumb-item active">Tambah Pegawai</li>
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
                        <h3 class="card-title">Tambah Data Pegawai</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode Pegawai</label>
                                <?php

                                $sql1  = "SELECT max(id_pegawai) AS terakhirpas FROM pegawai";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 4, 4);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "PGW-" . sprintf("%04s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="kd_pgw" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" name="nm_pgw" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="form-check">
                                    <input type="radio" name="jk" value="Laki-Laki">
                                    <label>Laki-Laki</label>&ensp;&ensp;&ensp;
                                    <input type="radio" name="jk" value="Perempuan">
                                    <label>Perempuan</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option>Admin</option>
                                    <option>Owner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" cols="30" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="number" name="nohp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
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