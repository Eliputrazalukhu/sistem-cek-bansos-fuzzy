<?php

include "../config/koneksi.php";

$data = mysqli_query($conn,"
SELECT

hasil_seleksi.*,
penduduk.nik,
penduduk.nama,
penduduk.alamat

FROM hasil_seleksi

INNER JOIN penduduk

ON hasil_seleksi.id_penduduk = penduduk.id_penduduk

ORDER BY hasil_seleksi.nilai_akhir DESC

") or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Laporan Hasil Seleksi Bansos</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    font-size:14px;
}

h2{
    text-align:center;
    margin-bottom:5px;
}

p{
    text-align:center;
    margin-top:0;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid #000;
}

th{
    background:#dddddd;
}

th,td{
    padding:8px;
    text-align:center;
}

</style>

</head>

<body>

<h2>
LAPORAN HASIL SELEKSI PENERIMA BANTUAN SOSIAL
</h2>

<p>
Sistem Pendukung Keputusan Menggunakan Logika Fuzzy Mamdani
</p>

<table>

<tr>

<th>No</th>
<th>NIK</th>
<th>Nama</th>
<th>Alamat</th>
<th>Nilai Akhir</th>
<th>Status</th>
<th>Keterangan</th>
<th>Tanggal</th>

</tr>

<?php

$no=1;

while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['nik']; ?></td>

<td><?= $d['nama']; ?></td>

<td><?= $d['alamat']; ?></td>

<td><?= number_format($d['nilai_akhir'],2); ?></td>

<td><?= $d['status_kelayakan']; ?></td>

<td><?= $d['keterangan']; ?></td>

<td><?= date('d-m-Y',strtotime($d['tanggal_cetak'])); ?></td>

</tr>

<?php } ?>

</table>

<br><br>

<table style="border:none;width:100%;">

<tr style="border:none;">

<td style="border:none;"></td>

<td style="border:none;text-align:center;width:250px;">

<?= date('d-m-Y'); ?>

<br><br><br><br><br>

<b>Administrator</b>

</td>

</tr>

</table>

<script>
window.print();
</script>

</body>
</html>