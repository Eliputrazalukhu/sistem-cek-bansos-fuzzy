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
FROM kriteria
WHERE id_kriteria='$id'
");

$d=mysqli_fetch_assoc($data);

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-warning">

<h4>

Edit Data Kriteria

</h4>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $d['id_kriteria']; ?>">

<div class="mb-3">

<label>Kode</label>

<input
type="text"
name="kode_kriteria"
class="form-control"
value="<?= $d['kode_kriteria']; ?>"
required>

</div>

<div class="mb-3">

<label>Nama Kriteria</label>

<input
type="text"
name="nama_kriteria"
class="form-control"
value="<?= $d['nama_kriteria']; ?>"
required>

</div>

<div class="mb-3">

<label>Bobot</label>

<input
type="number"
name="bobot"
class="form-control"
value="<?= $d['bobot']; ?>"
required>

</div>

<div class="mb-3">

<label>Tipe</label>

<select
name="tipe"
class="form-select">

<option value="Benefit"
<?=($d['tipe']=="Benefit")?"selected":"";?>>

Benefit

</option>

<option value="Cost"
<?=($d['tipe']=="Cost")?"selected":"";?>>

Cost

</option>

</select>

</div>

<div class="mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="4"><?= $d['keterangan']; ?></textarea>

</div>

<button class="btn btn-primary">

<i class="fas fa-save"></i>

Update

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