<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$query=mysqli_query($conn,"

SELECT

hasil_seleksi.*,

penduduk.nik,

penduduk.nama,

penduduk.alamat

FROM hasil_seleksi

JOIN penduduk

ON hasil_seleksi.id_penduduk=penduduk.id_penduduk

ORDER BY nilai_akhir DESC

");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<div class="d-flex justify-content-between">

<h4>

<i class="fas fa-award"></i>

Hasil Seleksi Bansos

</h4>

<a href="cetak.php"
class="btn btn-light">

<i class="fas fa-print"></i>

Cetak Laporan

</a>

</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead class="table-dark">

<tr>

<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>Alamat</th>

<th>Nilai Akhir</th>

<th>Status</th>

<th>Tanggal</th>

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

<td><?= $d['alamat']; ?></td>

<td>

<b><?= number_format($d['nilai_akhir'],2); ?></b>

</td>

<td>

<?php

if($d['status_kelayakan']=="Sangat Layak"){

echo "<span class='badge bg-success'>Sangat Layak</span>";

}

elseif($d['status_kelayakan']=="Layak"){

echo "<span class='badge bg-primary'>Layak</span>";

}

elseif($d['status_kelayakan']=="Kurang Layak"){

echo "<span class='badge bg-warning text-dark'>Kurang Layak</span>";

}

else{

echo "<span class='badge bg-danger'>Tidak Layak</span>";

}

?>

</td>

<td>

<?= date("d-m-Y",strtotime($d['tanggal_cetak'])); ?>

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