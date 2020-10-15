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


    if ($_FILES["gambar"]["name"] == "") {
        $update_gambar  = "";
    } else {
        $nama_file  = $_FILES["gambar"]["name"];
        $gambar_new    = date('dmYHis') . $nama_file;
        $update_gambar = ",gambar='$gambar_new'";
        move_uploaded_file($_FILES['gambar']['tmp_name'], "images/menu/" . $gambar_new);
    }

    mysqli_query($db, "UPDATE menu SET
    nm_menu = '$menu',
    size = '$size',
    harga = '$harga',
    keterangan = '$keterangan' $update_gambar 
    WHERE kd_menu = '$kd_menu'");

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
                    <li class="breadcrumb-item active">Edit Menu <?php echo $ouput['nm_kategori']; ?></li>
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
                        <h3 class="card-title">Edit Menu <?php echo $ouput['nm_kategori']; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <?php
                        $kode_menu = $_GET['kd_menu'];
                        $query  = mysqli_query($db, "SELECT menu.*,kategori.* FROM menu JOIN Kategori ON kategori.kd_kategori=menu.kd_kategori WHERE menu.kd_menu ='$kode_menu'");
                        $hitung = mysqli_num_rows($query);
                        if ($hitung > 0) {
                            while ($pecah = mysqli_fetch_assoc($query)) {



                        ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>KD Menu</label>
                                        <input type="text" class="form-control" name="kd_menu" value="<?php echo  $pecah['kd_menu']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>ID Kategori</label>
                                        <input type="text" name="kd_kategorii" value="<?php echo $pecah['kd_kategori']; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Menu</label>
                                        <input type="text" name="nm_kategori" value="<?php echo $pecah['nm_kategori']; ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Menu</label>
                                        <input type="text" name="menu" class="form-control" value="<?php echo $pecah['nm_menu']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Size</label>
                                        <select name="size" class="form-control">
                                            <option <?php if ($pecah['size'] == "Medium") {
                                                        echo "selected='true'";
                                                    } ?>>Medium</option>
                                            <option <?php if ($pecah['size'] == "Small") {
                                                        echo "selected='true'";
                                                    } ?>>Small</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar Menu</label>
                                        <img src="images/menu/<?php echo $pecah['gambar']; ?> " width="100px">
                                        <input type="file" name="gambar" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <select name="keterangan" class="form-control">
                                            <option <?php if ($pecah['keterangan'] == "Tersedia") {
                                                        echo "selected='true'";
                                                    } ?>>Tersedia</option>
                                            <option <?php if ($pecah['keterangan'] == "Tidak Tersedia") {
                                                        echo "selected='true'";
                                                    } ?>>Tidak Tersedia</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                        <?php }
                        } ?>

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