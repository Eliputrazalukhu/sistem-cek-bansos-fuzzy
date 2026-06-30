<?php

session_start();

if(!isset($_SESSION['nilai_akhir'])){
    header("Location:index.php");
    exit;
}

include "../config/koneksi.php";

$id=$_SESSION['id_penduduk'];

$nilai=$_SESSION['nilai_akhir'];

if($nilai>=80){

$status="Sangat Layak";

}elseif($nilai>=60){

$status="Layak";

}elseif($nilai>=40){

$status="Kurang Layak";

}else{

$status="Tidak Layak";

}

mysqli_query($conn,"

INSERT INTO proses_fuzzy(

id_penduduk,
nilai_fuzzy,
kategori,
tanggal_proses

)

VALUES(

'$id',
'$nilai',
'$status',
CURDATE()

)

");

mysqli_query($conn,"

INSERT INTO hasil_seleksi(

id_penduduk,
nilai_akhir,
status_kelayakan,
keterangan,
tanggal_cetak

)

VALUES(

'$id',
'$nilai',
'$status',
'Hasil Perhitungan Logika Fuzzy Mamdani',
CURDATE()

)

");

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>

Hasil Perhitungan Fuzzy Mamdani

</h3>

</div>

<div class="card-body text-center">

<h2>

Nilai Akhir

</h2>

<h1 class="display-3 text-primary">

<?= number_format($nilai,2); ?>

</h1>

<h2>

Status :

<span class="badge bg-success">

<?= $status; ?>

</span>

</h2>

<hr>

<a href="../hasil_seleksi/index.php"

class="btn btn-primary">

Lihat Hasil Seleksi

</a>

</div>

</div>

</div>

<?php

include "../template/footer.php";
include "../template/script.php";

?>