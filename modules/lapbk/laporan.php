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

$pdf->Ln(5);

$query  = mysqli_query($db, "SELECT bahan_bk.*,stok.*,suplier.nm_suplier FROM bahan_bk JOIN stok ON stok.kd_bahanbk=bahan_bk.kd_bahanbk JOIN suplier ON bahan_bk.id_suplier=suplier.id_suplier");


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Bahan Baku', '0', '1', 'C', false);
$pdf->Ln(5);

$pdf->SetWidths(array(8, 25, 40, 40,  20, 30));

$pdf->SetLineHeight(6);
$pdf->Cell(15, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(25, 6, 'KD Bahan Baku', 1, 0, 'C');
$pdf->Cell(40, 6, 'Suplier', 1, 0, 'C');
$pdf->Cell(40, 6, 'Bahan Baku', 1, 0, 'C');
$pdf->Cell(20, 6, 'Stok', 1, 0, 'C');
$pdf->Cell(30, 6, 'Tanggal Expired', 1, 1, 'C');

$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(15, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        $item['kd_bahanbk'],
        $item['nm_suplier'],
        $item['nm_bahanbk'],
        $item['stok'],
        $item['tgl_expire'],
    ));
    $no++;
    $pdf->Cell(15, 6, '', 0, 0, 'C');
}

$pdf->Output("Laporan Bahan Baku.pdf", "I");
