<?php

include '../../database.php';

date_default_timezone_set('Asia/Jakarta');

$kd_ambil = $_POST['kd_ambil'];
$kd_bk = $_POST['kd_bk'];
$qty = $_POST['qty'];

mysqli_query($db, "INSERT INTO tmpdetbrg_keluar(kd_brgout,kd_bahanbk,jum_brgout) VALUES ('$kd_ambil','$kd_bk','$qty')");

mysqli_query($db, "UPDATE stok SET stok=stok-'$qty' WHERE kd_bahanbk='$kd_bk'");

echo json_encode($result);
