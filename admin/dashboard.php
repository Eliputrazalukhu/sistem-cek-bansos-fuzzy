<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$jmlPenduduk=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM penduduk"));
$jmlKriteria=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM kriteria"));
$jmlRule=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rule_fuzzy"));
$jmlHasil=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM hasil_seleksi"));

$layak=mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM hasil_seleksi
WHERE status_kelayakan='Layak'
OR status_kelayakan='Sangat Layak'
"));

$tidak=mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM hasil_seleksi
WHERE status_kelayakan='Tidak Layak'
"));

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";
?>

<div class="container-fluid">

<div class="row mb-4">

<div class="col-md-12">

<div class="card shadow border-0">

<div class="card-body">

<h2 class="fw-bold text-primary">

SISTEM CEK BANSOS MENGGUNAKAN LOGIKA FUZZY MAMDANI

</h2>

<p class="text-muted">

Selamat datang di Dashboard Administrator

</p>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-3 mb-4">

<div class="card bg-primary text-white shadow">

<div class="card-body text-center">

<h1><?= $jmlPenduduk; ?></h1>

<h5>Data Penduduk</h5>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card bg-success text-white shadow">

<div class="card-body text-center">

<h1><?= $jmlKriteria; ?></h1>

<h5>Data Kriteria</h5>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card bg-warning text-dark shadow">

<div class="card-body text-center">

<h1><?= $jmlRule; ?></h1>

<h5>Rule Fuzzy</h5>

</div>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="card bg-danger text-white shadow">

<div class="card-body text-center">

<h1><?= $jmlHasil; ?></h1>

<h5>Hasil Seleksi</h5>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white">

Penerima Bantuan

</div>

<div class="card-body">

<h1 class="text-success">

<?= $layak; ?>

</h1>

<p>Layak / Sangat Layak</p>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-danger text-white">

Tidak Layak

</div>

<div class="card-body">

<h1 class="text-danger">

<?= $tidak; ?>

</h1>

<p>Tidak Layak</p>

</div>

</div>

</div>

</div>

<br>

<div class="row">

<div class="col-md-12">

<div class="card shadow">

<div class="card-header bg-dark text-white">

5 Nilai Tertinggi Hasil Seleksi

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>Nilai</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$data=mysqli_query($conn,"

SELECT

hasil_seleksi.*,

penduduk.nik,

penduduk.nama

FROM hasil_seleksi

JOIN penduduk

ON hasil_seleksi.id_penduduk=penduduk.id_penduduk

ORDER BY nilai_akhir DESC

LIMIT 5

");

while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nik']; ?></td>

<td><?= $d['nama']; ?></td>

<td>

<b><?= number_format($d['nilai_akhir'],2); ?></b>

</td>

<td>

<?= $d['status_kelayakan']; ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php

include "../template/footer.php";
include "../template/script.php";

?>