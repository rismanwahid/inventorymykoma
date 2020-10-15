<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pembelian">Data Pembelian</a></li>
                    <li class="breadcrumb-item active">Detail Pembelian</li>
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
                        <h3 class="card-title">Detail Pembelian</h3>
                        <a href="index.php?page=pembelian" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">

                        <table id="datatable" class="table table-striped table-bordered" style="text-align:bold">
                            <?php

                            $id_bl = $_GET['id_pembelian'];

                            $query  = mysqli_query($db, "SELECT pembelian.*,bahan_bk.nm_bahanbk,suplier.nm_suplier,pembelian.jumlah*pembelian.harga AS totall FROM pembelian JOIN bahan_bk ON pembelian.kd_bahanbk=bahan_bk.kd_bahanbk JOIN suplier ON pembelian.id_suplier=suplier.id_suplier WHERE pembelian.id_pembelian='$id_bl'");
                            $hitung = mysqli_num_rows($query);
                            if ($hitung > 0) {
                                while ($pecah = mysqli_fetch_assoc($query)) {

                            ?>
                                    <tr>
                                        <td>ID Pembelian</td>
                                        <td><?php echo $pecah['id_pembelian']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembelian</td>
                                        <td><?php echo date("d-m-Y", strtotime($pecah['tgl_beli'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Suplier</td>
                                        <td><?php echo $pecah['nm_suplier']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bahan Baku</td>
                                        <td><?php echo $pecah['nm_bahanbk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bahan Baku</td>
                                        <td><?php echo date("d-m-Y", strtotime($pecah['tgl_exp'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td><?php echo $pecah['jumlah']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td><?php echo rupiah($pecah['harga']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><?php echo rupiah($pecah['totall']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pegawai</td>
                                        <td><?php echo $_SESSION['nama']; ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </table>

                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div>
</section>
<!-- /.card -->