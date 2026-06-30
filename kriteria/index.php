<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$query=mysqli_query($conn,"
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

<div class="card-header bg-primary text-white">

<div class="d-flex justify-content-between">

<h4>

<i class="fas fa-list"></i>

Data Kriteria

</h4>

<a href="tambah.php" class="btn btn-light">

<i class="fas fa-plus"></i>

Tambah Kriteria

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>No</th>

<th>Kode</th>

<th>Nama Kriteria</th>

<th>Bobot</th>

<th>Tipe</th>

<th>Keterangan</th>

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

<td><?= $d['kode_kriteria']; ?></td>

<td><?= $d['nama_kriteria']; ?></td>

<td><?= $d['bobot']; ?> %</td>

<td>

<?php

if($d['tipe']=="Benefit"){

echo "<span class='badge bg-success'>Benefit</span>";

}else{

echo "<span class='badge bg-danger'>Cost</span>";

}

?>

</td>

<td><?= $d['keterangan']; ?></td>

<td>

<a href="edit.php?id=<?= $d['id_kriteria']; ?>" class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="hapus.php?id=<?= $d['id_kriteria']; ?>"
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