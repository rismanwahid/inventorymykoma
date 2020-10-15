<?php
include "../../database.php";

$kd_resep = $_POST['kd_resep'];

$query = mysqli_query($db, "SELECT tmp_detresep.*,bahan_bk.nm_bahanbk FROM tmp_detresep JOIN bahan_bk ON tmp_detresep.kd_bahanbk=bahan_bk.kd_bahanbk WHERE tmp_detresep.kd_resep='$kd_resep'");
$result = array();

while ($fethdata = $query->fetch_assoc()) {
    $result[] = $fethdata;
}

echo json_encode($result);
