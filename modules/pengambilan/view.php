<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_brgout = $_GET['kd_brgout'];

        mysqli_query($db, "DELETE FROM brg_keluar WHERE kd_brgout = '$kd_brgout'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=pengambilan'</script>";
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
                    <li class="breadcrumb-item active">Data Pengambilan Barang</li>
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
                        <h3 class="card-title">Data Pengambilan Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="index.php?page=ambil" class="btn btn-info"><i class="fa fa-cart-arrow-down"></i> Pengambilan Barang</a>
                        <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Pengambilan</th>
                                    <th>Tanggal Pengambilan</th>
                                    <th>Bahan Baku</th>
                                    <th>Qty</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query  = mysqli_query($db, "SELECT brg_keluar.*,bahan_bk.nm_bahanbk,detbrg_keluar.jum_brgout FROM brg_keluar JOIN detbrg_keluar ON detbrg_keluar.kd_brgout=brg_keluar.kd_brgout JOIN  bahan_bk ON detbrg_keluar.kd_bahanbk=bahan_bk.kd_bahanbk");
                                $hitung = mysqli_num_rows($query);
                                if ($hitung > 0) {
                                    while ($pecah = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td style="width:100px;"><?= $pecah['kd_brgout']; ?></td>
                                            <td style="width:140px;"><?= date('d-m-Y', strtotime($pecah['tgl_out'])); ?></td>
                                            <td style="width:140px;"><?= $pecah['nm_bahanbk']; ?></td>
                                            <td style="width:80px;"><?= $pecah['jum_brgout']; ?></td>
                                            <td style="width:90px;">
                                                <a href="index.php?page=detambil&kd_brgout=<?php echo $pecah['kd_brgout']; ?>" data-toggle="tooltip" data-placement="bottom" title="Detail Pengambilan" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="index.php?page=pengambilan&kd_brgout=<?php echo $pecah['kd_brgout']; ?>&aksi=hapus" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                    <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                }
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