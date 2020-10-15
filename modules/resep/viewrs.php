<?php
$nm_menuu = $_GET['nm'];
$kd_kategorii = $_GET['kd_kategori'];
$kd_resepp = $_GET['kd_resep'];

$qrktgr = mysqli_query($db, "SELECT * FROM kategori WHERE kd_kategori='$kd_kategorii'");
$ouput = mysqli_fetch_assoc($qrktgr);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=menu&kd_kategori=<?php echo $kd_kategori ?>">Data Resep Menu <?php echo $ouput['nm_kategori']; ?></a></li>
                    <li class="breadcrumb-item active">Resep Menu <?php echo $nm_menuu; ?></li>
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
                        <h3 class="card-title">Resep Menu <?php echo $_GET['nm']; ?></h3>
                        <a href="index.php?page=resep&kd_kategori=<?php echo $kd_kategorii ?>" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></a>
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Bahan Baku</th>
                                    <th>Takaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $query2  = mysqli_query($db, "SELECT resep.kd_resep,resep.kd_menu,det_resep.kd_bahanbk,det_resep.takaran,bahan_bk.nm_bahanbk FROM resep JOIN det_resep ON det_resep.kd_resep=resep.kd_resep JOIN bahan_bk ON det_resep.kd_bahanbk=bahan_bk.kd_bahanbk WHERE resep.kd_resep='$kd_resepp'");
                                $hitung2 = mysqli_num_rows($query2);
                                if ($hitung2 > 0) {
                                    while ($pecah2 = mysqli_fetch_array($query2)) {

                                ?>
                                        <tr>
                                            <td><?php echo $pecah2['nm_bahanbk'] ?></td>
                                            <td><?php echo $pecah2['takaran'] ?></td>
                                        </tr>
                                <?php }
                                } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
</section>
<!-- /.card -->