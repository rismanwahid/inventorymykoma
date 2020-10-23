<?php

include '../../database.php';
include '../../fpdf/pdf_mc_table.php';

function rupiah($angka)
{
    $hasil_rupiah = "Rp." . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}

$pdf = new PDF_MC_TABLE('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->Image('../../asets/dist/img/logolap.png', 80);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, 'Lippo Plaza, 02, Jl. Laksda Adisucipto No.32, Demangan, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55221', '0', '1', 'C', false);
$pdf->Cell(190, 0.6, '', '0', '1', 'C', true);
$pdf->Ln(3);

$pdf->SetFont('Arial', '', 9);

$kd_kategori = $_SESSION['kd_kategori'];
$query1 = mysqli_query($db, "SELECT menu.*,kategori.nm_kategori FROM menu JOIN kategori ON menu.kd_kategori=kategori.kd_kategori WHERE menu.kd_kategori='$kd_kategori' ORDER BY menu.nm_menu ASC");

$query = mysqli_query($db, "SELECT menu.*,kategori.nm_kategori FROM menu JOIN kategori ON menu.kd_kategori=kategori.kd_kategori ORDER BY menu.nm_menu ASC");

$pdf->Ln(5);

if ($kd_kategori == 'semua') {

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 5, 'Laporan Menu', '0', '1', 'C', false);
    $pdf->Ln(5);

    $pdf->SetWidths(array(8, 35, 35, 30, 20, 20, 20));

    $pdf->SetLineHeight(6);
    $pdf->Cell(10, 6, '', 0, 0, 'C');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(8, 6, 'No', 1, 0, 'C');
    $pdf->Cell(35, 6, 'KD Menu', 1, 0, 'C');
    $pdf->Cell(35, 6, 'Kategori Menu', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Nama Menu', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Size', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Keterangan', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $no = 1;
    $pdf->Cell(10, 6, '', 0, 0, 'C');
    foreach ($query as $item) {

        $pdf->Row(array(
            $no,
            $item['kd_menu'],
            $item['nm_kategori'],
            $item['nm_menu'],
            $item['size'],
            rupiah($item['harga']),
            $item['keterangan'],

        ));
        $no++;
        $pdf->Cell(10, 6, '', 0, 0, 'C');
    }
} else {
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 5, 'Menu', '0', '1', 'C', false);
    $pdf->Ln(5);


    $pdf->SetWidths(array(8, 35, 35, 30, 20, 20, 20));

    $pdf->SetLineHeight(6);
    $pdf->Cell(10, 6, '', 0, 0, 'C');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(8, 6, 'No', 1, 0, 'C');
    $pdf->Cell(35, 6, 'KD Menu', 1, 0, 'C');
    $pdf->Cell(35, 6, 'Kategori Menu', 1, 0, 'C');
    $pdf->Cell(30, 6, 'Nama Menu', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Size', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
    $pdf->Cell(20, 6, 'Keterangan', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $no = 1;
    $pdf->Cell(10, 6, '', 0, 0, 'C');
    foreach ($query1 as $item1) {

        $pdf->Row(array(
            $no,
            $item1['kd_menu'],
            $item1['nm_kategori'],
            $item1['nm_menu'],
            $item1['size'],
            $item1['harga'],
            $item1['keterangan'],

        ));
        $no++;
        $pdf->Cell(10, 6, '', 0, 0, 'C');
    }
}


$pdf->Output("Laporan Menu.pdf", "I");
