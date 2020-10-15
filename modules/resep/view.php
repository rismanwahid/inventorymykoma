<?php
$kd_kategori = $_GET['kd_kategori'];
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {

        $kd_resep = $_GET['kd_resep'];
        mysqli_query($db, "DELETE FROM resep WHERE kd_resep = '$kd_resep'");
        mysqli_query($db, "DELETE FROM det_resep WHERE kd_resep = '$kd_resep'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=resep&kd_kategori=" . $kd_kategori . "'</script>";
    }
}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=beranda">Beranda</a></li>
                    <?php
                    $query  = mysqli_query($db, "SELECT * FROM kategori WHERE kd_kategori='$kd_kategori'");
                    $hitung = mysqli_fetch_assoc($query);
                    ?>
                    <li class="breadcrumb-item active">Data Menu <?php echo $hitung['nm_kategori']; ?></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Menu <?php echo $hitung['nm_kategori']; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="index.php?page=tamresep&kd_kategori=<?php echo $hitung['kd_kategori']; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Resep</a>
                        <a href="./modules/resep/cetak.php?kd_kategori=<?php echo $hitung['kd_kategori']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Cetak Resep</a>
                        <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>KD Resep</th>
                                    <th>Nama Menu</th>
                                    <th>Size Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no     = 1;
                                $query1  = mysqli_query($db, "SELECT resep.*,menu.*,kategori.* FROM resep JOIN menu ON resep.kd_menu=menu.kd_menu JOIN Kategori ON kategori.kd_kategori=menu.kd_kategori WHERE kategori.kd_kategori ='$kd_kategori'");
                                $hitung1 = mysqli_num_rows($query1);
                                while ($pecah1 = mysqli_fetch_assoc($query1)) {
                                ?>
                                    <tr>
                                        <td style="width:100px;"><?= $pecah1['kd_resep']; ?></td>
                                        <td style="width:120px;"><?= $pecah1['nm_menu']; ?></td>
                                        <td style="width:80px;"><?= $pecah1['size']; ?></td>
                                        <td style="width:90px;">
                                            <a href="index.php?page=viewrs&kd_resep=<?php echo $pecah1['kd_resep']; ?>&kd_kategori=<?php echo $kd_kategori; ?>&nm=<?php echo $pecah1['nm_menu']; ?>" data-toggle="tooltip" data-placement="bottom" title="Lihat Resep" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="index.php?page=menu&kd_kategori=<?php echo $kd_kategori; ?>&aksi=hapus&kd_resep=<?php echo $pecah1['kd_resep']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->