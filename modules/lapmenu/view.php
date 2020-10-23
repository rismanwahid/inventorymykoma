<?php

if (isset($_POST['cetak'])) {

    $kd_kategori   = $_POST['ktg_menu'];
    $_SESSION['kd_kategori'] = $_POST['ktg_menu'];

    echo "<script>window.open('modules/lapmenu/laporan.php')</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=beranda">Beranda</a></li>
                    <li class="breadcrumb-item active">Laporan Menu</li>
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
                        <h3 class="card-title">Laporan Menu</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pilih Kategori Menu</label>
                                <select name="ktg_menu" class="form-control">
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM kategori");
                                    $hitung = mysqli_num_rows($query);
                                    if ($hitung > 0) {
                                        while ($pecah = mysqli_fetch_assoc($query)) {
                                    ?>
                                            <option value="<?php echo $pecah['kd_kategori']; ?>">
                                                <?php echo $pecah['nm_kategori']; ?>
                                            </option>
                                    <?php }
                                    } ?>
                                    <option value="semua">
                                        Semua
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=beranda" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="cetak" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->