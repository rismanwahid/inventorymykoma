<?php
include '../../database.php';

$kd_detbrgout = $_POST['kd_detbrgout'];

mysqli_query($db, "DELETE FROM tmpdetbrg_keluar WHERE kd_detbrgout='$kd_detbrgout'");
