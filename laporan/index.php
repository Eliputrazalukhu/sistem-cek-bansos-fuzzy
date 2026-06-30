<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$total = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM hasil_seleksi
"));

$layak = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM hasil_seleksi
WHERE status_kelayakan='Layak'
OR status_kelayakan='Sangat Layak'
"));

$tidak = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM hasil_seleksi
WHERE status_kelayakan='Tidak Layak'
OR status_kelayakan='Kurang Layak'
"));

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Laporan Hasil Seleksi Bansos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3 class="mb-0">

Laporan Hasil Seleksi Bansos Menggunakan Logika Fuzzy Mamdani

</h3>

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-md-4">

<div class="card border-primary">

<div class="card-body">

<h2 class="text-primary">

<?= $total; ?>

</h2>

<p>Total Hasil Seleksi</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card border-success">

<div class="card-body">

<h2 class="text-success">

<?= $layak; ?>

</h2>

<p>Layak / Sangat Layak</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card border-danger">

<div class="card-body">

<h2 class="text-danger">

<?= $tidak; ?>

</h2>

<p>Tidak / Kurang Layak</p>

</div>

</div>

</div>

</div>

<hr>

<div class="text-center">

<a href="cetak.php" target="_blank" class="btn btn-success">

🖨 Cetak Laporan

</a>

<a href="../hasil/index.php" class="btn btn-secondary">

⬅ Kembali

</a>

</div>

</div>

</div>

</div>

</body>

</html>