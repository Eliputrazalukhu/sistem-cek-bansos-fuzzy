<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$penduduk=mysqli_query($conn,"
SELECT *
FROM penduduk
ORDER BY nama
");

$kriteria=mysqli_query($conn,"
SELECT *
FROM kriteria
ORDER BY kode_kriteria
");

$sub=mysqli_query($conn,"
SELECT *
FROM sub_kriteria
ORDER BY nama_sub
");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>

Tambah Penilaian

</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<div class="mb-3">

<label>Penduduk</label>

<select name="id_penduduk" class="form-select" required>

<option value="">Pilih Penduduk</option>

<?php while($p=mysqli_fetch_assoc($penduduk)){ ?>

<option value="<?= $p['id_penduduk']; ?>">

<?= $p['nik']; ?> -

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Kriteria</label>

<select name="id_kriteria" class="form-select" required>

<option value="">Pilih Kriteria</option>

<?php while($k=mysqli_fetch_assoc($kriteria)){ ?>

<option value="<?= $k['id_kriteria']; ?>">

<?= $k['kode_kriteria']; ?>

-

<?= $k['nama_kriteria']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Sub Kriteria</label>

<select name="id_sub" class="form-select" required>

<option value="">Pilih Sub Kriteria</option>

<?php while($s=mysqli_fetch_assoc($sub)){ ?>

<option value="<?= $s['id_sub']; ?>">

<?= $s['nama_sub']; ?>

|

<?= $s['nilai']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Nilai</label>

<input
type="number"
name="nilai"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tanggal Penilaian</label>

<input
type="date"
name="tanggal_penilaian"
class="form-control"
value="<?= date('Y-m-d'); ?>">

</div>

<button class="btn btn-success">

Simpan

</button>

<a href="index.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

<?php

include "../template/footer.php";
include "../template/script.php";

?>