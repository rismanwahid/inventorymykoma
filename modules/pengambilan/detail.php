<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pengambilan">Data Pengambilan Barang</a></li>
                    <li class="breadcrumb-item active">Detail Pengambilan Barang</li>
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
                        <h3 class="card-title">Detail Pengambilan Barang</h3>
                        <a href="index.php?page=pengambilan" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body">
                        <?php
                        $id_ambil = $_GET['kd_brgout'];

                        $query = mysqli_query($db, "SELECT brg_keluar.*,pegawai.nm_pegawai FROM brg_keluar JOIN pegawai ON brg_keluar.id_pegawai=pegawai.id_pegawai WHERE brg_keluar.kd_brgout='$id_ambil'");
                        $hasil = mysqli_fetch_assoc($query);

                        $query1  = mysqli_query($db, "SELECT brg_keluar.*,bahan_bk.kd_bahanbk,bahan_bk.nm_bahanbk,detbrg_keluar.jum_brgout,bahan_bk.tgl_expire FROM brg_keluar JOIN detbrg_keluar ON detbrg_keluar.kd_brgout=brg_keluar.kd_brgout JOIN  bahan_bk ON detbrg_keluar.kd_bahanbk=bahan_bk.kd_bahanbk WHERE brg_keluar.kd_brgout='$id_ambil'");
                        ?>

                        <table>

                            <tr>
                                <td>KD Pengambilan Barang</td>
                                <td>:</td>
                                <td><?php echo $hasil['kd_brgout']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengambilan</td>
                                <td>:</td>
                                <td><?php echo date("d-m-Y H:i", strtotime($hasil['tgl_out'])); ?></td>
                            </tr>
                            <tr>
                                <td>Pegawai</td>
                                <td>:</td>
                                <td><?php echo $hasil['nm_pegawai']; ?></td>
                            </tr>
                        </table><br>

                        <table class="table table-striped table-bordered" style="text-align:bold">

                            <tr>
                                <th>KD Bahan Baku</th>
                                <th>Bahan Baku</th>
                                <th>Qty</th>
                                <th>Tanggal Expired</th>
                            </tr>
                            <?php


                            $hitung1 = mysqli_num_rows($query1);
                            if ($hitung1 > 0) {
                                while ($pecah1 = mysqli_fetch_assoc($query1)) {

                            ?>
                                    <tr>
                                        <td><?php echo $pecah1['kd_bahanbk'] ?></td>
                                        <td><?php echo $pecah1['nm_bahanbk'] ?></td>
                                        <td><?php echo $pecah1['jum_brgout'] ?></td>
                                        <td><?php echo $pecah1['tgl_expire'] ?></td>
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