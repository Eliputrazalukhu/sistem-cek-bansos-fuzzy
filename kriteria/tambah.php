<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>

Tambah Data Kriteria

</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<div class="row">

<div class="col-md-4">

<label>Kode Kriteria</label>

<input
type="text"
name="kode_kriteria"
class="form-control"
placeholder="Contoh C1"
required>

</div>

<div class="col-md-8">

<label>Nama Kriteria</label>

<input
type="text"
name="nama_kriteria"
class="form-control"
required>

</div>

<div class="col-md-4 mt-3">

<label>Bobot (%)</label>

<input
type="number"
name="bobot"
class="form-control"
required>

</div>

<div class="col-md-4 mt-3">

<label>Tipe</label>

<select
name="tipe"
class="form-select">

<option value="Benefit">

Benefit

</option>

<option value="Cost">

Cost

</option>

</select>

</div>

<div class="col-md-12 mt-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control"
rows="4"></textarea>

</div>

</div>

<hr>

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