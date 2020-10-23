<?php

if (isset($_POST['simpan'])) {
    $id_bl  = $_POST['id_bl'];
    $tgl_bl   = $_POST['tgl_bl'];
    $suplier   = $_POST['suplier'];
    $kd_bahan = $_POST['kd_bahan'];
    $bahanbk   = $_POST['bahanbk'];
    $nw_bhnbk   = $_POST['nw_bhnbk'];
    $qty = $_POST['qty'];
    $harga  = $_POST['harga'];
    $tgl_exp  = $_POST['tgl_exp'];
    $id_pegawai  = $_POST['id_pgw'];

    if ($bahanbk == 'Tambah Bahan Baku') {
        mysqli_query($db, "INSERT INTO pembelian(id_pembelian,id_suplier,kd_bahanbk,tgl_beli,jumlah,harga,id_pegawai,tgl_exp) VALUES ('$id_bl','$suplier','$kd_bahan','$tgl_bl','$qty','$harga','$id_pegawai','$tgl_exp')");

        mysqli_query($db, "INSERT INTO bahan_bk(kd_bahanbk,id_suplier,nm_bahanbk,tgl_expire) VALUES ('$kd_bahan','$suplier','$nw_bhnbk','$tgl_exp')");

        mysqli_query($db, "INSERT INTO stok(kd_bahanbk,stok) VALUES ('$kd_bahan','$qty')");
    } else {

        mysqli_query($db, "INSERT INTO pembelian(id_pembelian,id_suplier,kd_bahanbk,tgl_beli,jumlah,harga,id_pegawai,tgl_exp) VALUES ('$id_bl','$suplier','$kd_bahan','$tgl_bl','$qty','$harga','$id_pegawai','$tgl_exp')");

        mysqli_query($db, "INSERT INTO bahan_bk(kd_bahanbk,id_suplier,nm_bahanbk,tgl_expire) VALUES ('$kd_bahan','$suplier','$bahanbk','$tgl_exp')");

        mysqli_query($db, "INSERT INTO stok(kd_bahanbk,stok) VALUES ('$kd_bahan','$qty')");
    }


    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=pembelian'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pembelian">Data Pembelian</a></li>
                    <li class="breadcrumb-item active">Tambah Pembelian</li>
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
                        <h3 class="card-title">Tambah Data Pembelian</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>ID Pembelian</label>
                                <?php

                                $sql1  = "SELECT max(id_pembelian) AS terakhirpas FROM pembelian";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 5, 5);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "PMBL-" . sprintf("%05s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="id_bl" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pembelian</label>
                                <input type="date" class="form-control" name="tgl_bl" required>
                            </div>
                            <div class="form-group">
                                <label>Suplier</label>
                                <select name="suplier" id="suplier" class="form-control" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <!-- <label>ID Bahan Baku</label> -->
                                <?php

                                $sql1  = "SELECT max(kd_bahanbk) AS terakhirpas FROM bahan_bk";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 6, 4);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "BAHAN-" . sprintf("%04s", $nexturut1);

                                ?>
                                <input type="hidden" class="form-control" name="kd_bahan" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <script type="text/javascript">
                                function yesnoCheck(that) {
                                    if (that.value == "Tambah Bahan Baku") {
                                        document.getElementById("nw_bhnbk").style.display = "block";

                                    } else {
                                        document.getElementById("nw_bhnbk").style.display = "none";
                                    }
                                }
                            </script>
                            <div class="form-group" id="selectbk" style="display: block;">
                                <label>Bahan Baku</label>
                                <select name="bahanbk" id="bahanbk" class="form-control" onchange="yesnoCheck(this);">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group" id="nw_bhnbk" style="display: none">
                                <label>Nama Bahan Baku</label>
                                <input type="text" name="nw_bhnbk" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" name="qty" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Expired</label>
                                <input type="date" name="tgl_exp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <!-- <label>ID Pegawai</label> -->
                                <input type="hidden" name="id_pgw" value="<?php echo $_SESSION['id_pegawai']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=pembelian" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/mykoma/modules/pembelian/getsuplier.php",
            cache: false,
            success: function(msg) {
                $("#suplier").html(msg);
            }
        });

        $("#suplier").change(function() {
            var suplier = $("#suplier").val();
            $.ajax({
                type: 'POST',
                url: "http://localhost/mykoma/modules/pembelian/getbahan.php",
                data: {
                    suplier: suplier
                },
                cache: false,
                success: function(msg) {
                    $("#bahanbk").html(msg);
                }
            });
        });
    });
</script>