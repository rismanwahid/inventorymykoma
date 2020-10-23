<?php
$kd_kategori = $_GET['kd_kategori'];

$qrktgr = mysqli_query($db, "SELECT * FROM kategori WHERE kd_kategori = '$kd_kategori'");
$ouput = mysqli_fetch_assoc($qrktgr);



if (isset($_POST['simpan'])) {
    $kd_resep  = $_POST['kd_resep'];
    $kd_menu  = $_POST['kd_menu'];

    mysqli_query($db, "INSERT INTO resep(kd_resep,kd_menu) VALUES ('$kd_resep','$kd_menu')");

    mysqli_query($db, "INSERT INTO det_resep(kd_resep,kd_bahanbk,takaran) SELECT kd_resep,kd_bahanbk,takaran FROM tmp_detresep WHERE kd_resep='$kd_resep'");


    echo "<script>alert('Data Berhasil Tersimpan')</script>";
    echo "<script>window.location='index.php?page=resep&kd_kategori=" . $kd_kategori . "'</script>";
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=menu&kd_kategori=<?php echo $kd_kategori ?>">Data Resep Menu <?php echo $ouput['nm_kategori']; ?></a></li>
                    <li class="breadcrumb-item active">Tambah Resep Menu <?php echo $ouput['nm_kategori']; ?></li>
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
                        <h3 class="card-title">Tambah Resep Menu <?php echo $ouput['nm_kategori']; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>KD Resep</label>
                                <?php

                                $sql1  = "SELECT max(kd_resep) AS terakhirpas FROM resep";
                                $hasil1  = mysqli_query($db, $sql1);
                                $data1   = mysqli_fetch_array($hasil1);
                                $lastid1 = $data1['terakhirpas'];
                                $lastnourut1 = (int)substr($lastid1, 3, 4);
                                $nexturut1   = $lastnourut1 + 1;
                                $nextid1     = "RS-" . sprintf("%04s", $nexturut1);

                                ?>
                                <input type="text" class="form-control" name="kd_resep" value="<?php echo  $nextid1; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <!-- <label>KD Menu</label> -->
                                <input type="hidden" id="kd_menursp" name="kd_menu" class="form-control" readonly>
                            </div>
                            <label>Nama Menu</label>
                            <div class="form-group input-group">

                                <input type="text" class="form-control" id="nm_menursp" name="nm_menu" readonly>
                                <span class="input-group-append">
                                    <button type="button" data-toggle="modal" data-target="#datamenursp" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-group">
                                <!-- <label>KD Bahan Baku</label> -->
                                <input type="hidden" id="kd_bkrs" name="kd_bk" class="form-control" readonly>
                            </div>
                            <label>Bahan Baku</label>
                            <div class="form-group input-group">
                                <input type="text" id="bahan_bkrs" name="bahan_bk" class="form-control" readonly class="col-md-10">
                                <span class="input-group-append">
                                    <button type="button" data-toggle="modal" data-target="#databkrsp" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Takaran</label>
                                <input type="text" name="takaran" class="form-control"><br>
                                <input type="button" value="Tambah" onclick="insertdata()" class="btn btn-primary">
                            </div>
                            <table id="tableadd" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bahan Baku</th>
                                        <th>Takaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="barisdata">

                                </tbody>
                            </table>
                            <script type="text/javascript">
                                // view data

                                function loaddata() {
                                    var datahandler = $("#barisdata");
                                    var kd_resep = $("[name='kd_resep']").val();
                                    datahandler.html("");
                                    $.ajax({
                                        type: "POST",
                                        data: "kd_resep=" + kd_resep,
                                        url: 'http://localhost/mykoma/modules/resep/f_view.php',
                                        success: function(result) {
                                            var resultobj = JSON.parse(result);
                                            var nomor = 1;


                                            $.each(resultobj, function(key, val) {
                                                var newrow = $("<tr>");
                                                newrow.html("<td>" + nomor + "</td><td>" + val.nm_bahanbk + "</td><td>" + val.takaran + "</td><td><input type='button' onclick='hapusdata(" + val.kd_detresep + ")' class='btn btn-danger' value='Batal'></td>");

                                                datahandler.append(newrow);
                                                nomor++;
                                            });
                                        }
                                    });
                                }

                                // insert data
                                loaddata();

                                function insertdata() {
                                    var kd_resep = $("[name='kd_resep']").val();
                                    var kd_bk = $("[name='kd_bk']").val();
                                    var bahan_bk = $("[name='bahan_bk']").val();
                                    var takaran = $("[name='takaran']").val();

                                    $.ajax({
                                        type: "POST",
                                        data: "kd_resep=" + kd_resep + "&kd_bk=" + kd_bk + "&takaran=" + takaran,
                                        url: 'http://localhost/mykoma/modules/resep/f_insert.php',
                                        success: function(result) {
                                            $("[name='kd_bk']").val("");
                                            $("[name='bahan_bk']").val("");
                                            $("[name='takaran']").val("");
                                            loaddata();
                                        }
                                    });
                                }

                                Hapus

                                function hapusdata(kd_detresep) {
                                    var tanya = confirm("Anda Yakin Akan Mengghapus Bahan Baku Ini?");
                                    if (tanya) {
                                        $.ajax({
                                            type: "POST",
                                            data: "kd_detresep=" + kd_detresep,
                                            url: "http://localhost/mykoma/modules/resep/f_delete.php",
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

<div class="modal fade modal fade bs-example-modal-lg" id="datamenursp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Data Menu <?php echo $ouput['nm_kategori'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Menu</th>
                                            <th>Nama Menu</th>
                                            <th>Size</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        $no1     = 1;
                                        $query1  = mysqli_query($db, "SELECT * FROM menu WHERE kd_kategori='$kd_kategori'");
                                        $hitung1 = mysqli_num_rows($query1);
                                        if ($hitung1 > 0) {
                                            while ($pecah1 = mysqli_fetch_assoc($query1)) {

                                        ?>
                                                <tr>
                                                    <td style="width: 60px;"><?php echo $no1; ?></td>
                                                    <td style="width:100px;"> <?php echo $pecah1['kd_menu']; ?></td>
                                                    <td style="width:120px;"><?php echo $pecah1['nm_menu']; ?></td>
                                                    <td style="width:120px;"><?php echo $pecah1['size']; ?></td>
                                                    <td style="width:80px;">
                                                        <button id="pilihresepmn" data-kdmenursp="<?php echo $pecah1['kd_menu']; ?>" data-namamenursp="<?php echo $pecah1['nm_menu']; ?>"><i class="fa fa-check"></i>Pilih</button>
                                                    </td>
                                                </tr>
                                        <?php $no1++;
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

<div class="modal fade modal fade bs-example-modal-lg" id="databkrsp" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <th>KD Bahan Baku</th>
                                            <th>Nama Bahan Baku</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        $no2    = 1;
                                        $query2  = mysqli_query($db, "SELECT bahan_bk.kd_bahanbk,bahan_bk.nm_bahanbk FROM bahan_bk");
                                        $hitung2 = mysqli_num_rows($query1);
                                        if ($hitung2 > 0) {
                                            while ($pecah2 = mysqli_fetch_assoc($query2)) {

                                        ?>
                                                <tr>
                                                    <td style="width: 60px;"><?php echo $no2; ?></td>
                                                    <td style="width:100px;"> <?php echo $pecah2['kd_bahanbk']; ?></td>
                                                    <td style="width:120px;"><?php echo $pecah2['nm_bahanbk']; ?></td>
                                                    <td style="width:80px;">
                                                        <button id="pilihresepbk" data-kdbahanrsp="<?php echo $pecah2['kd_bahanbk']; ?>" data-nmbahanrsp="<?php echo $pecah2['nm_bahanbk']; ?>"><i class="fa fa-check"></i>Pilih</button>
                                                    </td>
                                                </tr>
                                        <?php $no1++;
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