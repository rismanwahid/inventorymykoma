<?php
if (isset($_POST['simpan'])) {
    $id_supl  = $_POST['id_supl'];
    $nm_supl   = $_POST['nm_supl'];
    $alamat   = $_POST['alamat'];
    $notelp   = $_POST['notelp'];
    $norek = $_POST['norek'];
    $bank  = $_POST['bank'];

    mysqli_query($db, "INSERT INTO suplier(id_suplier,nm_suplier,alamat,telp,norek,bank) VALUES ('$id_supl','$nm_supl','$alamat','$notelp','$norek','$bank')");

    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=suplier'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=suplier">Data Suplier</a></li>
                    <li class="breadcrumb-item active">Tambah Suplier</li>
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
                        <h3 class="card-title">Tambah Data Suplier</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>ID Suplier</label>
                                <?php

                                $sql1  = "SELECT max(id_suplier) AS terakhirpas FROM suplier";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 6, 4);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "SUPLY-" . sprintf("%04s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="id_supl" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama Suplier</label>
                                <input type="text" class="form-control" name="nm_supl" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" cols="30" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>No Telephone</label>
                                <input type="number" name="notelp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>No Rekening</label>
                                <input type="number" name="norek" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Bank</label>
                                <input type="text" name="bank" class="form-control" required>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=suplier" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->