<?php

session_start();

include "../config/koneksi.php";

$id=$_GET['id'];

$data=mysqli_query($conn,"

SELECT

hasil_seleksi.*,

penduduk.*

FROM hasil_seleksi

JOIN penduduk

ON hasil_seleksi.id_penduduk=penduduk.id_penduduk

WHERE id_hasil='$id'

");

$d=mysqli_fetch_assoc($data);

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>

Detail Hasil Seleksi

</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="250">

NIK

</th>

<td>

<?= $d['nik']; ?>

</td>

</tr>

<tr>

<th>

Nama

</th>

<td>

<?= $d['nama']; ?>

</td>

</tr>

<tr>

<th>

Alamat

</th>

<td>

<?= $d['alamat']; ?>

</td>

</tr>

<tr>

<th>

Nilai Fuzzy

</th>

<td>

<?= number_format($d['nilai_akhir'],2); ?>

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

<?= $d['status_kelayakan']; ?>

</td>

</tr>

<tr>

<th>

Keterangan

</th>

<td>

<?= $d['keterangan']; ?>

</td>

</tr>

</table>

</div>

</div>

</div>

<?php

include "../template/footer.php";
include "../template/script.php";

?>