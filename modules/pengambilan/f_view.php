<?php
include "../../database.php";

$kd_brgout = $_POST['kd_brgout'];

$query = mysqli_query($db, "SELECT tmpdetbrg_keluar.*,bahan_bk.nm_bahanbk,bahan_bk.tgl_expire FROM tmpdetbrg_keluar JOIN bahan_bk ON tmpdetbrg_keluar.kd_bahanbk=bahan_bk.kd_bahanbk WHERE tmpdetbrg_keluar.kd_brgout='$kd_brgout'");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $result[] = $fethdata;
}

echo json_encode($result);
