<?php
$kd_kategori = $_GET['kd_kategori'];

$query2 = mysqli_query($db, "SELECT * FROM kategori WHERE kd_kategori='$kd_kategori'");
$ouput = mysqli_fetch_assoc($query2);

if (isset($_POST['simpan'])) {
    $kd_menu  = $_POST['kd_menu'];
    $kd_kategorii   = $_POST['kd_kategorii'];
    $menu = $_POST['menu'];
    $size = $_POST['size'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_new    = date('dmYHis') . $gambar;
    move_uploaded_file($_FILES['gambar']['tmp_name'], "images/menu/" . $gambar_new);

    mysqli_query($db, "INSERT INTO menu(kd_menu,kd_kategori,nm_menu,gambar,size,harga,keterangan) VALUES ('$kd_menu','$kd_kategorii','$menu','$gambar_new','$size','$harga','$keterangan')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=menu&kd_kategori=" . $kd_kategorii . "'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=menu&kd_kategori=<?php echo $ouput['kd_kategori'] ?>">Data Menu <?php echo $ouput['nm_kategori']; ?></a></li>
                    <li class="breadcrumb-item active">Tambah Menu <?php echo $ouput['nm_kategori']; ?></li>
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
                        <h3 class="card-title">Tambah Menu <?php echo $ouput['nm_kategori']; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>KD Menu</label>
                                <?php

                                $sql1  = "SELECT max(kd_menu) AS terakhirpas FROM menu";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 5, 4);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "MENU-" . sprintf("%04s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="kd_menu" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <!-- <label>ID Kategori</label> -->
                                <input type="hidden" name="kd_kategorii" value="<?php echo $ouput['kd_kategori']; ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <!-- <label>Kategori Menu</label> -->
                                <input type="hidden" name="nm_kategori" value="<?php echo $ouput['nm_kategori']; ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" name="menu" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Size</label>
                                <select name="size" class="form-control">
                                    <option>Medium</option>
                                    <option>Small</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Gambar Menu</label>
                                <input type="file" name="gambar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <select name="keterangan" class="form-control">
                                    <option>Tersedia</option>
                                    <option>Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=menu&kd_kategori=<?php echo $kd_kategori; ?>" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->