<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $kd_bahanbk = $_GET['kd_bahanbk'];
        $id_bl = $_GET['id_pembelian'];
        mysqli_query($db, "DELETE FROM pembelian WHERE id_pembelian = '$id_bl'");
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
                    <li class="breadcrumb-item active">Data Pembelian</li>
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
                        <h3 class="card-title">Data Pembelian</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="index.php?page=tambeli" class="btn btn-info"><i class="fa fa-shopping-cart"></i> Pembelian</a>
                        <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Pembelian</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Suplier</th>
                                    <th>Bahan Baku</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query  = mysqli_query($db, "SELECT pembelian.*,bahan_bk.nm_bahanbk,suplier.nm_suplier FROM pembelian JOIN bahan_bk ON pembelian.kd_bahanbk=bahan_bk.kd_bahanbk JOIN suplier ON pembelian.id_suplier=suplier.id_suplier");
                                $hitung = mysqli_num_rows($query);
                                if ($hitung > 0) {
                                    while ($pecah = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td style="width:100px;"><?= $pecah['id_pembelian']; ?></td>
                                            <td style="width:140px;"><?= date('d-m-Y', strtotime($pecah['tgl_beli'])); ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_suplier']; ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_bahanbk']; ?></td>
                                            <td style="width:40px;"><?= $pecah['jumlah']; ?></td>
                                            <td style="width:100px;"><?= rupiah($pecah['harga']); ?></td>
                                            <td style="width:90px;">
                                                <a href="index.php?page=detailbl&id_pembelian=<?php echo $pecah['id_pembelian']; ?>" data-toggle="tooltip" data-placement="bottom" title="Detail Pembelian" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="index.php?page=pembelian&id_pembelian=<?php echo $pecah['id_pembelian']; ?>&kd_bahanbk=<?php echo $pecah['kd_bahanbk']; ?>&aksi=hapus" data-toggle="tooltip" data-placement="bottom" title="Hapus">
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