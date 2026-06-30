<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$query=mysqli_query($conn,"
SELECT *
FROM rule_fuzzy
ORDER BY id_rule DESC
");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<div class="d-flex justify-content-between">

<h4>

<i class="fas fa-project-diagram"></i>

Rule Fuzzy Mamdani

</h4>

<a href="tambah.php" class="btn btn-light">

<i class="fas fa-plus"></i>

Tambah Rule

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead class="table-dark">

<tr>

<th>No</th>
<th>Aset</th>
<th>Rumah</th>
<th>Lantai</th>
<th>Dinding</th>
<th>Kepemilikan</th>
<th>Pekerjaan</th>
<th>Penghasilan</th>
<th>Tanggungan</th>
<th>Syarat Lain</th>
<th>Hasil</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['aset']; ?></td>

<td><?= $d['rumah']; ?></td>

<td><?= $d['lantai']; ?></td>

<td><?= $d['dinding']; ?></td>

<td><?= $d['kepemilikan']; ?></td>

<td><?= $d['pekerjaan']; ?></td>

<td><?= $d['penghasilan']; ?></td>

<td><?= $d['tanggungan']; ?></td>

<td><?= $d['syarat_lain']; ?></td>

<td>

<span class="badge bg-success">

<?= $d['hasil']; ?>

</span>

</td>

<td>

<a href="edit.php?id=<?= $d['id_rule']; ?>" class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $d['id_rule']; ?>"
onclick="return confirm('Hapus Rule?')"
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<?php

include "../template/footer.php";
include "../template/script.php";

?>