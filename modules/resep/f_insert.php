<?php

include '../../database.php';

date_default_timezone_set('Asia/Jakarta');

$kd_resep = $_POST['kd_resep'];
$kd_bk = $_POST['kd_bk'];
$takaran = $_POST['takaran'];

mysqli_query($db, "INSERT INTO tmp_detresep(kd_resep,kd_bahanbk,takaran) VALUES ('$kd_resep','$kd_bk','$takaran')");

echo json_encode($result);
