<?php

if (isset($_POST['cetak'])) {

    $mintgl  = $_POST['mintgl'];
    $maxtgl  = $_POST['maxtgl'];

    $query  = mysqli_query($db, "SELECT * FROM pembelian WHERE tgl_beli BETWEEN '$mintgl' AND '$maxtgl' ORDER BY tgl_beli ASC");

    $hitung = mysqli_num_rows($query);
    if ($hitung > 0) {
        $_SESSION['mintgl'] = $_POST['mintgl'];
        $_SESSION['maxtgl'] = $_POST['maxtgl'];
        echo "<script>window.open('modules/lapbeli/laporan.php')</script>";
    } else {
        echo "<script>alert('Laporan Tidak Ditemukan')</script>";
        echo "<script>window.location='index.php?page=ceklapbeli'</script>";
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=beranda">Beranda</a></li>
                    <li class="breadcrumb-item active">Laporan Pembelian</li>
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
                        <h3 class="card-title">Laporan Pembelian</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Dari Tanggal</label>
                                <input type="date" name="mintgl" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="maxtgl" class="form-control">
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
    </div>
</section>
<!-- /.card -->