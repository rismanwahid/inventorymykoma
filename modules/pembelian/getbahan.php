<?php
include '../../database.php';
$suplier = $_POST['suplier'];

echo "<option value=''>Pilih Bahan Baku</option>
<option value='Tambah Bahan Baku'>Tambah Bahan Baku</option>";

$query = "SELECT bahan_bk.nm_bahanbk,bahan_bk.id_suplier FROM bahan_bk WHERE id_suplier='$suplier' GROUP BY nm_bahanbk ORDER BY nm_bahanbk ASC";
$dewan1 = $db->prepare($query);
$dewan1->bind_param("i", $suplier);
$dewan1->execute();
$res1 = $dewan1->get_result();
while ($row = $res1->fetch_assoc()) {
    echo "<option value='" . $row['nm_bahanbk'] . "'>" . $row['nm_bahanbk'] . "</option>";
}
