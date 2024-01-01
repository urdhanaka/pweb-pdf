<?php
// memanggil library FPDF
require('./fpdf185/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string 
$pdf->Cell(190, 7, 'DATA MAHASISWA', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, 'TEKNIK INFORMATIKA', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Foto', 1, 0, 'C');
$pdf->Cell(40, 10, 'NIS', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 10, 'Jenis Kelamin', 1, 0, 'C');
$pdf->Cell(40, 10, 'Telepon', 1, 0, 'C');
$pdf->Cell(67, 10, 'Alamat', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

include 'koneksi.php';

$sql = $pdo->prepare("SELECT * FROM siswa ORDER BY nis");
$sql->execute();

while ($data = $sql->fetch()) {
  $imagePath = 'images/' . $data['foto'];
  if (file_exists($imagePath)) {
    list($width, $height) = getimagesize($imagePath);

    $aspectRatio = $width / $height;

    $maxHeight = 30;
    $maxWidth = 30 * $aspectRatio;

    $x = $pdf->GetX();
    $y = $pdf->GetY();

    $pdf->Cell(40, 40, '', 1, 0, 'C');
    $pdf->Image($imagePath, $x + 5, $y + 5, 30, 30);

    $pdf->SetXY($x + 40, $y);
  } else {
    $pdf->Cell(50, 50, 'Tidak Ada Gambar', 1, 0, 'C');
  }
  $pdf->Cell(40, 40, $data['nis'], 1, 0, 'C');
  $pdf->Cell(50, 40, $data['nama'], 1, 0, 'C');
  $pdf->Cell(40, 40, $data['jenis_kelamin'], 1, 0, 'C');
  $pdf->Cell(40, 40, $data['telp'], 1, 0, 'C');
  $pdf->Cell(67, 40, $data['alamat'], 1, 1, 'C');
}

$pdf->Output();

