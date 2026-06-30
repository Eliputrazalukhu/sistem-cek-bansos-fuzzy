<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$query = mysqli_query($conn,"
SELECT *
FROM penduduk
ORDER BY id_penduduk DESC
");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<div class="d-flex justify-content-between align-items-center">

<h4 class="mb-0">

<i class="fas fa-users"></i>

Data Penduduk

</h4>

<a href="tambah.php" class="btn btn-light">

<i class="fas fa-plus"></i>

Tambah Penduduk

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead class="table-dark">

<tr>

<th width="5%">No</th>

<th>NIK</th>

<th>Nama</th>

<th>Jenis Kelamin</th>

<th>Tempat Lahir</th>

<th>Tanggal Lahir</th>

<th>Desa</th>

<th>Kecamatan</th>

<th>Pekerjaan</th>

<th>No HP</th>

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

<td><?= $d['nik']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['jenis_kelamin']; ?></td>

<td><?= $d['tempat_lahir']; ?></td>

<td><?= date('d-m-Y',strtotime($d['tanggal_lahir'])); ?></td>

<td><?= $d['desa']; ?></td>

<td><?= $d['kecamatan']; ?></td>

<td><?= $d['pekerjaan']; ?></td>

<td><?= $d['no_hp']; ?></td>

<td>

<a href="edit.php?id=<?= $d['id_penduduk']; ?>" class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="hapus.php?id=<?= $d['id_penduduk']; ?>"
onclick="return confirm('Yakin ingin menghapus data?')"
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