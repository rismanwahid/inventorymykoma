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

$mintgl = $_SESSION['mintgl'];
$maxtgl = $_SESSION['maxtgl'];


$query = mysqli_query($db, "SELECT pembelian.*,bahan_bk.nm_bahanbk,suplier.nm_suplier,pegawai.nm_pegawai FROM pembelian JOIN bahan_bk ON pembelian.kd_bahanbk=bahan_bk.kd_bahanbk JOIN suplier ON pembelian.id_suplier=suplier.id_suplier JOIN pegawai ON pembelian.id_pegawai=pegawai.id_pegawai WHERE tgl_beli BETWEEN '$mintgl' AND '$maxtgl' ORDER BY pembelian.tgl_beli ASC");

$qrtotal = mysqli_query($db, "SELECT SUM(harga) AS totall FROM pembelian");
$total = mysqli_fetch_assoc($qrtotal);

$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 5, 'Laporan Pembelian Periode:' . date('d.m.Y', strtotime($mintgl)) . " - " . date('d.m.Y', strtotime($maxtgl)), '0', '1', 'L', false);
$pdf->Ln(5);

$pdf->SetWidths(array(8, 25, 25, 25,  30, 20, 10, 20, 20));

$pdf->SetLineHeight(6);
$pdf->Cell(5, 6, '', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(8, 6, 'No', 1, 0, 'C');
$pdf->Cell(25, 6, 'ID Pembelian', 1, 0, 'C');
$pdf->Cell(25, 6, 'Tanggal Pembelian', 1, 0, 'C');
$pdf->Cell(25, 6, 'Tanggal Expired', 1, 0, 'C');
$pdf->Cell(30, 6, 'Suplier', 1, 0, 'C');
$pdf->Cell(20, 6, 'Bahan Baku', 1, 0, 'C');
$pdf->Cell(10, 6, 'Qty', 1, 0, 'C');
$pdf->Cell(20, 6, 'Nama Pegawai', 1, 0, 'C');
$pdf->Cell(20, 6, 'Subtotal', 1, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$no = 1;
$pdf->Cell(5, 6, '', 0, 0, 'C');
foreach ($query as $item) {

    $pdf->Row(array(
        $no,
        $item['id_pembelian'],
        date('d-m-Y', strtotime($item['tgl_beli'])),
        date('d-m-Y', strtotime($item['tgl_exp'])),
        $item['nm_suplier'],
        $item['nm_bahanbk'],
        $item['jumlah'],
        $item['nm_pegawai'],
        rupiah($item['harga']),

    ));
    $no++;
    $pdf->Cell(5, 6, '', 0, 0, 'C');
}

$pdf->Cell(143, 6, 'Total', 1, 0, 'C');
$pdf->Cell(40, 6, rupiah($total['totall']), 1, 1, 'C');



$pdf->Output("Laporan Pembelian.pdf", "I");
