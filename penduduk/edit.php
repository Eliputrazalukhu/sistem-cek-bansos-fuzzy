<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"
SELECT *
FROM penduduk
WHERE id_penduduk='$id'
");

$d = mysqli_fetch_assoc($data);

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-warning">

<h4>

<i class="fas fa-user-edit"></i>

Edit Data Penduduk

</h4>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $d['id_penduduk']; ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label>NIK</label>

<input
type="text"
name="nik"
class="form-control"
maxlength="16"
value="<?= $d['nik']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $d['nama']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Kelamin</label>

<select
name="jenis_kelamin"
class="form-select"
required>

<option value="Laki-laki"
<?= ($d['jenis_kelamin']=="Laki-laki")?"selected":""; ?>>

Laki-laki

</option>

<option value="Perempuan"
<?= ($d['jenis_kelamin']=="Perempuan")?"selected":""; ?>>

Perempuan

</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Tempat Lahir</label>

<input
type="text"
name="tempat_lahir"
class="form-control"
value="<?= $d['tempat_lahir']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Tanggal Lahir</label>

<input
type="date"
name="tanggal_lahir"
class="form-control"
value="<?= $d['tanggal_lahir']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Desa</label>

<input
type="text"
name="desa"
class="form-control"
value="<?= $d['desa']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Kecamatan</label>

<input
type="text"
name="kecamatan"
class="form-control"
value="<?= $d['kecamatan']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>Pekerjaan</label>

<input
type="text"
name="pekerjaan"
class="form-control"
value="<?= $d['pekerjaan']; ?>"
required>

</div>

<div class="col-md-6 mb-3">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control"
value="<?= $d['no_hp']; ?>">

</div>

<div class="col-md-12 mb-3">

<label>Alamat</label>

<textarea
name="alamat"
rows="4"
class="form-control"
required><?= $d['alamat']; ?></textarea>

</div>

</div>

<hr>

<button
type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Update

</button>

<a
href="index.php"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

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