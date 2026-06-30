<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$query=mysqli_query($conn,"

SELECT

penilaian.*,

penduduk.nama,

kriteria.nama_kriteria,

sub_kriteria.nama_sub

FROM penilaian

JOIN penduduk
ON penilaian.id_penduduk=penduduk.id_penduduk

JOIN kriteria
ON penilaian.id_kriteria=kriteria.id_kriteria

JOIN sub_kriteria
ON penilaian.id_sub=sub_kriteria.id_sub

ORDER BY penilaian.id_penilaian DESC

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

<i class="fas fa-star"></i>

Data Penilaian

</h4>

<a href="tambah.php" class="btn btn-light">

Tambah Penilaian

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>No</th>

<th>Nama Penduduk</th>

<th>Kriteria</th>

<th>Sub Kriteria</th>

<th>Nilai</th>

<th>Tanggal</th>

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

<td><?= $d['nama']; ?></td>

<td><?= $d['nama_kriteria']; ?></td>

<td><?= $d['nama_sub']; ?></td>

<td><?= $d['nilai']; ?></td>

<td><?= date('d-m-Y',strtotime($d['tanggal_penilaian'])); ?></td>

<td>

<a href="edit.php?id=<?= $d['id_penilaian']; ?>" class="btn btn-warning btn-sm">

Edit

</a>

<a href="hapus.php?id=<?= $d['id_penilaian']; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Hapus Data?')">

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