<?php
include '../../database.php';

$kd_detresep = $_POST['kd_detresep'];

mysqli_query($db, "DELETE FROM tmp_detresep WHERE kd_detresep='$kd_detresep'");
