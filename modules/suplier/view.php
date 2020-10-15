<?php

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $id_suplier = $_GET['id_suplier'];
        mysqli_query($db, "DELETE FROM suplier WHERE id_suplier = '$id_suplier'");

        echo "<script>alert('Data Berhasil Dihapus')</script>";
        echo "<script>window.location='index.php?page=suplier'</script>";
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
                    <li class="breadcrumb-item active">Data Suplier</li>
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
                        <h3 class="card-title">Data Suplier</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="index.php?page=tamsuplier" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Suplier</a> <br> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Suplier</th>
                                    <th>Nama Suplier</th>
                                    <th>Alamat</th>
                                    <th>No Telephone</th>
                                    <th>No Rekening</th>
                                    <th>Bank</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no     = 1;
                                $query  = mysqli_query($db, "SELECT * FROM suplier");
                                $hitung = mysqli_num_rows($query);
                                if ($hitung > 0) {
                                    while ($pecah = mysqli_fetch_assoc($query)) {
                                ?>
                                        <tr>
                                            <td style="width:100px;"><?= $pecah['id_suplier']; ?></td>
                                            <td style="width:120px;"><?= $pecah['nm_suplier']; ?></td>
                                            <td style="width:100px;"><?= $pecah['alamat']; ?></td>
                                            <td style="width:100px;"><?= $pecah['telp']; ?></td>
                                            <td style="width:100px;"><?= $pecah['norek']; ?></td>
                                            <td style="width:80px;"><?= $pecah['bank']; ?></td>
                                            <td style="width:80px;">
                                                <a class="btn btn-info btn-sm " href="index.php?page=editsupli&id_suplier=<?php echo $pecah['id_suplier']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a onclick="return confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger btn-sm" href="index.php?page=suplier&aksi=hapus&id_suplier=<?php echo $pecah['id_suplier']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus">
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