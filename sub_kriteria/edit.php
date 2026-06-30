<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=$_GET['id'];

$data=mysqli_query($conn,"
SELECT *
FROM sub_kriteria
WHERE id_sub='$id'
");

$d=mysqli_fetch_assoc($data);

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

<div class="card-header bg-warning">

<h4>Edit Sub Kriteria</h4>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $d['id_sub']; ?>">

<div class="mb-3">

<label>Kriteria</label>

<select
name="id_kriteria"
class="form-select">

<?php

while($k=mysqli_fetch_assoc($kriteria)){

?>

<option
value="<?= $k['id_kriteria']; ?>"
<?=($k['id_kriteria']==$d['id_kriteria'])?"selected":"";?>>

<?= $k['kode_kriteria']; ?>

-

<?= $k['nama_kriteria']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Nama Sub</label>

<input
type="text"
name="nama_sub"
class="form-control"
value="<?= $d['nama_sub']; ?>"
required>

</div>

<div class="mb-3">

<label>Nilai</label>

<input
type="number"
name="nilai"
class="form-control"
value="<?= $d['nilai']; ?>"
required>

</div>

<div class="mb-3">

<label>Kategori Fuzzy</label>

<select
name="kategori_fuzzy"
class="form-select">

<option value="Rendah"
<?=($d['kategori_fuzzy']=="Rendah")?"selected":"";?>>

Rendah

</option>

<option value="Sedang"
<?=($d['kategori_fuzzy']=="Sedang")?"selected":"";?>>

Sedang

</option>

<option value="Tinggi"
<?=($d['kategori_fuzzy']=="Tinggi")?"selected":"";?>>

Tinggi

</option>

</select>

</div>

<button class="btn btn-primary">

Update

</button>

<a href="index.php"
class="btn btn-secondary">

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