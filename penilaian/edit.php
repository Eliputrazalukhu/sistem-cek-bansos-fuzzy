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
FROM penilaian
WHERE id_penilaian='$id'
");

$d=mysqli_fetch_assoc($data);

$penduduk=mysqli_query($conn,"SELECT * FROM penduduk ORDER BY nama");
$kriteria=mysqli_query($conn,"SELECT * FROM kriteria ORDER BY kode_kriteria");
$sub=mysqli_query($conn,"SELECT * FROM sub_kriteria ORDER BY nama_sub");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-warning">

<h4>Edit Penilaian</h4>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input type="hidden" name="id" value="<?= $d['id_penilaian']; ?>">

<div class="mb-3">

<label>Penduduk</label>

<select name="id_penduduk" class="form-select">

<?php while($p=mysqli_fetch_assoc($penduduk)){ ?>

<option value="<?= $p['id_penduduk']; ?>"
<?=($p['id_penduduk']==$d['id_penduduk'])?'selected':'';?>>

<?= $p['nama']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Kriteria</label>

<select name="id_kriteria" class="form-select">

<?php while($k=mysqli_fetch_assoc($kriteria)){ ?>

<option value="<?= $k['id_kriteria']; ?>"
<?=($k['id_kriteria']==$d['id_kriteria'])?'selected':'';?>>

<?= $k['nama_kriteria']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Sub Kriteria</label>

<select name="id_sub" class="form-select">

<?php while($s=mysqli_fetch_assoc($sub)){ ?>

<option value="<?= $s['id_sub']; ?>"
<?=($s['id_sub']==$d['id_sub'])?'selected':'';?>>

<?= $s['nama_sub']; ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Nilai</label>

<input type="number"
name="nilai"
class="form-control"
value="<?= $d['nilai']; ?>">

</div>

<div class="mb-3">

<label>Tanggal Penilaian</label>

<input type="date"
name="tanggal_penilaian"
class="form-control"
value="<?= $d['tanggal_penilaian']; ?>">

</div>

<button class="btn btn-primary">

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