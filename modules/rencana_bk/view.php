<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=beranda">Beranda</a></li>
                    <li class="breadcrumb-item active">Laporan Bahan Baku</li>
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
                        <h3 class="card-title">Perencanaan Bahan Baku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <a href="modules/rencana_bk/laporan.php" target="_blank" class="btn btn-success" style="float:right;"><i class="fa fa-print"></i> Cetak Laporan</a> <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>KD Bahan Baku</th>
                                    <th>Suplier</th>
                                    <th>Bahan Baku</th>
                                    <th>Stok</th>
                                    <th>Rekomendasi Tambah Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no     = 1;
                                $query  = mysqli_query($db, "SELECT bahan_bk.*,stok.*,suplier.nm_suplier,pembelian.jumlah, pembelian.jumlah AS recomended FROM bahan_bk 
                                JOIN stok ON stok.kd_bahanbk=bahan_bk.kd_bahanbk 
                                JOIN suplier ON bahan_bk.id_suplier=suplier.id_suplier JOIN pembelian ON pembelian.kd_bahanbk=bahan_bk.kd_bahanbk 
                                WHERE stok.stok <10  GROUP BY bahan_bk.nm_bahanbk");
                                $hitung = mysqli_num_rows($query);
                                if ($hitung > 0) {
                                    while ($pecah = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td style="width:100px;"><?= $pecah['kd_bahanbk']; ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_suplier']; ?></td>
                                            <td style="width:100px;"><?= $pecah['nm_bahanbk']; ?></td>
                                            <td style="width:70px;"><?= $pecah['stok']; ?></td>
                                            <td style="width:100px;"><?= $pecah['recomended'] ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                        <!-- /.card-body -->


                    </div>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->