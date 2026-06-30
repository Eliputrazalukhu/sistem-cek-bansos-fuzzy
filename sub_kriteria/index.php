<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$query=mysqli_query($conn,"

SELECT

sub_kriteria.*,
kriteria.nama_kriteria

FROM sub_kriteria

JOIN kriteria

ON sub_kriteria.id_kriteria=kriteria.id_kriteria

ORDER BY kriteria.kode_kriteria ASC

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

<i class="fas fa-layer-group"></i>

Data Sub Kriteria

</h4>

<a href="tambah.php" class="btn btn-light">

<i class="fas fa-plus"></i>

Tambah Data

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>No</th>

<th>Kriteria</th>

<th>Sub Kriteria</th>

<th>Nilai</th>

<th>Kategori Fuzzy</th>

<th width="15%">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nama_kriteria']; ?></td>

<td><?= $d['nama_sub']; ?></td>

<td><?= $d['nilai']; ?></td>

<td>

<span class="badge bg-success">

<?= $d['kategori_fuzzy']; ?>

</span>

</td>

<td>

<a href="edit.php?id=<?= $d['id_sub']; ?>" class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="hapus.php?id=<?= $d['id_sub']; ?>"
onclick="return confirm('Hapus data?')"
class="btn btn-danger btn-sm">

<i class="fas fa-trash"></i>

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