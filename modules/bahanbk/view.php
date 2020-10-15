<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_bahanbk = $_GET['kd_bahanbk'];
        mysqli_query($db, "DELETE FROM bahan_bk WHERE kd_bahanbk = '$kd_bahanbk'");
        mysqli_query($db, "DELETE FROM stok WHERE kd_bahanbk = '$kd_bahanbk'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=bahanbk'</script>";
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
                    <li class="breadcrumb-item active">Data Bahan Baku</li>
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
                        <h3 class="card-title">Data Bahan Baku</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="index.php?page=tambahanbk" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Bahan Baku</a> <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>KD Bahan Baku</th>
                                    <th>Suplier</th>
                                    <th>Bahan Baku</th>
                                    <th>Stok</th>
                                    <th>Tanggal Expired</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no     = 1;
                                $query  = mysqli_query($db, "SELECT bahan_bk.*,stok.*,suplier.nm_suplier FROM bahan_bk JOIN stok ON stok.kd_bahanbk=bahan_bk.kd_bahanbk JOIN suplier ON bahan_bk.id_suplier=suplier.id_suplier");
                                $hitung = mysqli_num_rows($query);
                                if ($hitung > 0) {
                                    while ($pecah = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td style="width:100px;"><?= $pecah['kd_bahanbk']; ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_suplier']; ?></td>
                                            <td style="width:100px;"><?= $pecah['nm_bahanbk']; ?></td>
                                            <td style="width:100px;"><?= $pecah['stok']; ?></td>
                                            <td style="width:100px;"><?= date('d-m-Y', strtotime($pecah['tgl_expire'])); ?></td>
                                            <td style="width:80px;">
                                                <a class="btn btn-info btn-sm " href="index.php?page=editbahanbk&kd_bahanbk=<?php echo $pecah['kd_bahanbk']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="index.php?page=bahanbk&aksi=hapus&kd_bahanbk=<?php echo $pecah['kd_bahanbk']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
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