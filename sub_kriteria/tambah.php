<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$kriteria=mysqli_query($conn,"
SELECT *
FROM kriteria
ORDER BY kode_kriteria ASC
");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>

Tambah Sub Kriteria

</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<div class="mb-3">

<label>Kriteria</label>

<select
name="id_kriteria"
class="form-select"
required>

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

<label>Nama Sub Kriteria</label>

<input
type="text"
name="nama_sub"
class="form-control"
required>

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

<label>Kategori Fuzzy</label>

<select
name="kategori_fuzzy"
class="form-select">

<option>Rendah</option>

<option>Sedang</option>

<option>Tinggi</option>

</select>

</div>

<button class="btn btn-success">

<i class="fas fa-save"></i>

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