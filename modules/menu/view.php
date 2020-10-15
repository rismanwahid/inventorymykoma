<?php
$kd_kategori = $_GET['kd_kategori'];
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {

        $kd_menu = $_GET['kd_menu'];
        mysqli_query($db, "DELETE FROM menu WHERE kd_menu = '$kd_menu'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=menu&kd_kategori=" . $kd_kategori . "'</script>";
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
                        <a href="index.php?page=tammenu&kd_kategori=<?php echo $hitung['kd_kategori']; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Menu</a> <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>KD Menu</th>
                                    <th>Kategori</th>
                                    <th>Nama Menu</th>
                                    <th>Size</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no     = 1;
                                $query  = mysqli_query($db, "SELECT menu.*,kategori.* FROM menu JOIN Kategori ON kategori.kd_kategori=menu.kd_kategori WHERE kategori.kd_kategori ='$kd_kategori'");
                                $hitung = mysqli_num_rows($query);
                                if ($hitung > 0) {
                                    while ($pecah = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td style="width:100px;"><?= $pecah['kd_menu']; ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_kategori']; ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_menu']; ?></td>
                                            <td style="width:80px;"><?= $pecah['size']; ?></td>
                                            <td style="width:100px;"><button data-toggle="modal" id="aksigambar" data-target="#gambarrr" data-gambar="<?php echo $pecah['gambar']; ?>" data-namamenu="<?php echo $pecah['nm_menu']; ?>"> <img src="images/menu/<?php echo $pecah['gambar']; ?>" style="width:50px;"> </button>
                                            </td>
                                            <td style="width:10px;"><?= rupiah($pecah['harga']); ?></td>
                                            <td style="width:100px;"><?php if ($pecah['keterangan'] == 'Tersedia') {
                                                                            echo "<span class='badge badge-success right'>" . $pecah['keterangan'] . " </span>";
                                                                        }
                                                                        if ($pecah['keterangan'] == 'Tidak Tersedia') {
                                                                            echo "<span class='badge badge-secondary'>" . $pecah['keterangan'] . " </span>";
                                                                        } ?></td>
                                            <td style="width:90px;">
                                                <a class="btn btn-info btn-sm " href="index.php?page=editmenu&kd_menu=<?php echo $pecah['kd_menu']; ?>&kd_kategori=<?php echo $pecah['kd_kategori']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="index.php?page=menu&kd_kategori=<?php echo $kd_kategori; ?>&aksi=hapus&kd_menu=<?php echo $pecah['kd_menu']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                    <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
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

<div class="modal fade" id="gambarrr" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nama_menu"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body">
                <div id="gambarmenu">
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>