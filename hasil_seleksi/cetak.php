<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

require('../fpdf/fpdf.php');

include "../config/koneksi.php";

$pdf=new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,10,'LAPORAN HASIL SELEKSI PENERIMA BANTUAN SOSIAL',0,1,'C');

$pdf->SetFont('Arial','',11);

$pdf->Cell(0,7,'Menggunakan Metode Logika Fuzzy Mamdani',0,1,'C');

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(10,8,'No',1);

$pdf->Cell(35,8,'NIK',1);

$pdf->Cell(55,8,'Nama',1);

$pdf->Cell(70,8,'Alamat',1);

$pdf->Cell(30,8,'Nilai',1);

$pdf->Cell(45,8,'Status',1);

$pdf->Cell(35,8,'Tanggal',1);

$pdf->Ln();

$pdf->SetFont('Arial','',10);

$no=1;

$data=mysqli_query($conn,"

SELECT

hasil_seleksi.*,

penduduk.nik,

penduduk.nama,

penduduk.alamat

FROM hasil_seleksi

JOIN penduduk

ON hasil_seleksi.id_penduduk=penduduk.id_penduduk

ORDER BY nilai_akhir DESC

");

while($d=mysqli_fetch_assoc($data)){

$pdf->Cell(10,8,$no++,1);

$pdf->Cell(35,8,$d['nik'],1);

$pdf->Cell(55,8,$d['nama'],1);

$pdf->Cell(70,8,substr($d['alamat'],0,35),1);

$pdf->Cell(30,8,number_format($d['nilai_akhir'],2),1);

$pdf->Cell(45,8,$d['status_kelayakan'],1);

$pdf->Cell(35,8,date("d-m-Y",strtotime($d['tanggal_cetak'])),1);

$pdf->Ln();

}

$pdf->Ln(10);

$pdf->Cell(260,7,"Dicetak : ".date("d-m-Y"),0,1,'R');

$pdf->Ln(10);

$pdf->Cell(260,7,"Administrator",0,1,'R');

$pdf->Ln(18);

$pdf->Cell(260,7,"_________________________",0,1,'R');

$pdf->Output();

?>