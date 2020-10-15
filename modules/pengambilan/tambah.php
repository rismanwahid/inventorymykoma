<?php

if (isset($_POST['simpan'])) {
    $kd_ambil  = $_POST['kd_ambil'];
    $jam = date('H:i:s');
    $tgl_ambil  = $_POST['tgl_ambil'] . " " . $jam;
    $id_pgw  = $_POST['id_pgw'];

    mysqli_query($db, "INSERT INTO brg_keluar(kd_brgout,tgl_out,id_pegawai) VALUES ('$kd_ambil','$tgl_ambil','$id_pgw')");

    mysqli_query($db, "INSERT INTO detbrg_keluar(kd_brgout,kd_bahanbk,jum_brgout) SELECT kd_brgout,kd_bahanbk,jum_brgout FROM tmpdetbrg_keluar WHERE kd_brgout='$kd_ambil'");


    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=pengambilan'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=pengambilan">Data Pengambilan Barang</a></li>
                    <li class="breadcrumb-item active">Pengambilan Barang</li>
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
                        <h3 class="card-title">Pengambilan Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>KD Pengambilan Barang</label>
                                <?php
                                $date = date("Y-m-d");
                                $query = mysqli_query($db, "SELECT max(kd_brgout) as maxKode FROM brg_keluar");
                                $data = mysqli_fetch_array($query);
                                $noOrder = $data['maxKode'];
                                $noUrut = (int) substr($noOrder, 9, 4);
                                $noUrut++;
                                $char = "OUT-";
                                $tahun = substr($date, 0, 4);
                                $bulan = substr($date, 5, 2);
                                $id_Order = $char . $tahun . $bulan . sprintf("%03s", $noUrut);

                                ?>
                                <input type="text" class="form-control" name="kd_ambil" value="<?php echo  $id_Order; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pengambilan</label>
                                <input type="date" name="tgl_ambil" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>KD Bahan Baku</label>
                                <input type="text" id="kd_bkout" name="kd_bk" class="form-control" readonly>
                            </div>
                            <label>Bahan Baku</label>
                            <div class="form-group input-group">
                                <input type="text" id="bahan_bkout" name="bahan_bk" class="form-control" readonly class="col-md-10">
                                <span class="input-group-append">
                                    <button type="button" data-toggle="modal" data-target="#databahan" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>ID Pegawai</label>
                                <input type="text" name="id_pgw" value="<?php echo $_SESSION['id_pegawai'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" name="qty" class="form-control"><br>
                                <input type="button" value="Tambah" onclick="insertdata()" class="btn btn-primary">
                            </div>
                            <table id="tableadd" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bahan Baku</th>
                                        <th>Qty</th>
                                        <th>Tanggal Expired</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="barisdata">

                                </tbody>
                            </table>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script type="text/javascript">
                                // view data

                                function loaddata() {
                                    var datahandler = $("#barisdata");
                                    var kd_brgout = $("[name='kd_ambil']").val();
                                    datahandler.html("");
                                    $.ajax({
                                        type: "POST",
                                        data: "kd_brgout=" + kd_brgout,
                                        url: 'http://localhost/mykoma/modules/pengambilan/f_view.php',
                                        success: function(result) {
                                            var resultobj = JSON.parse(result);
                                            var nomor = 1;


                                            $.each(resultobj, function(key, val) {
                                                var newrow = $("<tr>");
                                                newrow.html("<td>" + nomor + "</td><td>" + val.nm_bahanbk + "</td><td>" + val.jum_brgout + "</td><td>" + val.tgl_expire + "</td><td><input type='button' onclick='hapusdata(" + val.kd_detbrgout + ")' class='btn btn-danger' value='Batal'></td>");

                                                datahandler.append(newrow);
                                                nomor++;
                                            });
                                        }
                                    });
                                }

                                // insert data
                                loaddata();

                                function insertdata() {
                                    var kd_ambil = $("[name='kd_ambil']").val();
                                    var kd_bk = $("[name='kd_bk']").val();
                                    var qty = $("[name='qty']").val();
                                    var bahan_bk = $("[name='bahan_bk']").val();

                                    $.ajax({
                                        type: "POST",
                                        data: "kd_ambil=" + kd_ambil + "&kd_bk=" + kd_bk + "&qty=" + qty,
                                        url: 'http://localhost/mykoma/modules/pengambilan/f_insert.php',
                                        success: function(result) {
                                            $("[name='kd_bk']").val("");
                                            $("[name='bahan_bk']").val("");
                                            $("[name='qty']").val("");
                                            loaddata();
                                        }
                                    });
                                }

                                // Hapus

                                function hapusdata(kd_detbrgout) {
                                    var tanya = confirm("Anda Yakin Akan Menghapus Bahan Baku Ini?");
                                    if (tanya) {
                                        $.ajax({
                                            type: "POST",
                                            data: "kd_detbrgout=" + kd_detbrgout,
                                            url: "http://localhost/mykoma/modules/pengambilan/f_delete.php",
                                            success: function(result) {
                                                loaddata();
                                            }
                                        });
                                    }
                                }
                            </script>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="index.php?page=menu&kd_kategori=<?php echo $kd_kategori; ?>" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- /.card -->

<div class="modal fade modal fade bs-example-modal-lg" id="databahan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Bahan Baku</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <table id="example3" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bahan Baku</th>
                                            <th>Stok</th>
                                            <th>Tanggal Expired</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        $no2    = 1;
                                        $query2  = mysqli_query($db, "SELECT bahan_bk.kd_bahanbk,bahan_bk.nm_bahanbk,bahan_bk.tgl_expire,stok.stok as stokk FROM bahan_bk JOIN stok ON stok.kd_bahanbk=bahan_bk.kd_bahanbk");
                                        $hitung2 = mysqli_num_rows($query1);
                                        if ($hitung2 > 0) {
                                            while ($pecah2 = mysqli_fetch_assoc($query2)) {

                                        ?>
                                                <tr>
                                                    <td style="width: 60px;"><?php echo $no2; ?></td>
                                                    <td style="width:120px;"><?php echo $pecah2['nm_bahanbk']; ?></td>
                                                    <td style="width:80px;"><?php echo $pecah2['stokk']; ?></td>
                                                    <td style="width:100px;"> <?php echo $pecah2['tgl_expire']; ?></td>
                                                    <td style="width:80px;">
                                                        <button id="pilbkout" data-kdbahanout="<?php echo $pecah2['kd_bahanbk']; ?>" data-nmbahanout="<?php echo $pecah2['nm_bahanbk']; ?>"><i class="fa fa-check"></i>Pilih</button>
                                                    </td>
                                                </tr>
                                        <?php $no2++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>