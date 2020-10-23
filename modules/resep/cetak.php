<?php

include '../../database.php';
include '../../fpdf/pdf_mc_table.php';

$pdf = new PDF_MC_TABLE('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Image('../../asets/dist/img/logolap.png', 80);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, 'Lippo Plaza, 02, Jl. Laksda Adisucipto No.32, Demangan, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55221', '0', '1', 'C', false);
$pdf->Cell(190, 0.6, '', '0', '1', 'C', true);
$pdf->Ln(3);

$pdf->SetFont('Arial', '', 9);

$kd_kategori = $_GET['kd_kategori'];
$query = mysqli_query($db, "SELECT resep.*,kategori.*,det_resep.kd_resep,GROUP_CONCAT(bahan_bk.nm_bahanbk,' ',det_resep.takaran SEPARATOR ' | ') AS namabahan,menu.kd_kategori,menu.nm_menu FROM resep JOIN det_resep ON det_resep.kd_resep=resep.kd_resep JOIN bahan_bk ON det_resep.kd_bahanbk=bahan_bk.kd_bahanbk JOIN menu ON resep.kd_menu=menu.kd_menu JOIN kategori ON menu.kd_kategori=kategori.kd_kategori WHERE menu.kd_kategori ='$kd_kategori' GROUP BY resep.kd_resep");

$pdf->Ln(5);

$ktgr = mysqli_query($db, "SELECT kategori.nm_kategori FROM kategori WHERE kd_kategori='$kd_kategori'");
$hasilktgr = mysqli_fetch_assoc($ktgr);

$nama = $hasilktgr['nm_kategori'];

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 5, 'Resep Menu' . " $nama", '0', '1', 'C', false);
$pdf->Ln(5);

$pdf->SetWidths(array(8, 35, 35, 30, 40));

$pdf->SetLineHeight(6);
$pdf->Cell(20, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(35, 6, 'KD Resep', 1, 0, 'C');
$pdf->Cell(35, 6, 'Kategori Menu', 1, 0, 'C');
$pdf->Cell(30, 6, 'Nama Menu', 1, 0, 'C');
$pdf->Cell(40, 6, 'Resep', 1, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(20, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        $item['kd_resep'],
        $item['nm_kategori'],
        $item['nm_menu'],
        $item['namabahan'],

    ));
    $no++;
    $pdf->Cell(20, 6, '', 0, 0, 'C');
}


$pdf->Output("Resep Menu.pdf", "I");
