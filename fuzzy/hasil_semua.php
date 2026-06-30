<?php

session_start();

if(!isset($_SESSION['login'])){

header("Location:../login/index.php");
exit;

}


include "../config/koneksi.php";


/*
================================
DATA HASIL SELEKSI
================================
*/


$hasil=mysqli_query($conn,"

SELECT

hasil_seleksi.*,

penduduk.nik,

penduduk.nama,

penduduk.pekerjaan,

penduduk.alamat

FROM hasil_seleksi

JOIN penduduk

ON hasil_seleksi.id_penduduk=penduduk.id_penduduk

ORDER BY nilai_akhir DESC

");



/*
================================
DATA DETAIL FUZZY
================================
*/


$detail=mysqli_query($conn,"

SELECT

detail_fuzzy.*,

penduduk.nama

FROM detail_fuzzy

JOIN penduduk

ON detail_fuzzy.id_penduduk=penduduk.id_penduduk

ORDER BY penduduk.nama ASC

");



include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>



<div class="container-fluid">



<h3 class="mb-4">

<i class="fa fa-chart-line"></i>

Laporan Hasil Proses Semua Data Fuzzy Mamdani

</h3>



<!-- RINGKASAN -->


<div class="row mb-4">


<div class="col-md-4">

<div class="card bg-primary text-white shadow">

<div class="card-body">

<h2>

<?= $_SESSION['total_proses']; ?>

</h2>

Data Diproses


</div>

</div>

</div>



<div class="col-md-4">

<div class="card bg-success text-white shadow">

<div class="card-body">

<h2>

<?= $_SESSION['jumlah_layak']; ?>

</h2>

Layak / Sangat Layak


</div>

</div>

</div>



<div class="col-md-4">

<div class="card bg-danger text-white shadow">

<div class="card-body">

<h2>

<?= $_SESSION['jumlah_tidak']; ?>

</h2>

Tidak Layak


</div>

</div>

</div>



</div>





<!-- TABEL HASIL AKHIR -->


<div class="card shadow mb-4">


<div class="card-header bg-success text-white">


<h5>

1. Tabel Keputusan Akhir Fuzzy

</h5>


</div>


<div class="card-body table-responsive">



<table class="table table-bordered table-striped">


<tr class="table-dark">

<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>Pekerjaan</th>

<th>Nilai Fuzzy</th>

<th>Kategori</th>

<th>Status</th>

<th>Keterangan</th>


</tr>


<?php


$no=1;


while($h=mysqli_fetch_assoc($hasil)){


?>


<tr>


<td><?= $no++; ?></td>


<td><?= $h['nik']; ?></td>


<td><?= $h['nama']; ?></td>


<td><?= $h['pekerjaan']; ?></td>


<td>

<b>

<?= $h['nilai_akhir']; ?>

</b>

</td>


<td>


<?php


if($h['nilai_akhir']>=80){

echo "Tinggi";

}

elseif($h['nilai_akhir']>=60){

echo "Sedang";

}

else{

echo "Rendah";

}


?>


</td>


<td>


<?php


if($h['status_kelayakan']=="Sangat Layak"){

echo "<span class='badge bg-success'>Sangat Layak</span>";

}

elseif($h['status_kelayakan']=="Layak"){

echo "<span class='badge bg-primary'>Layak</span>";

}

else{

echo "<span class='badge bg-danger'>".$h['status_kelayakan']."</span>";

}


?>


</td>


<td>

<?= $h['keterangan']; ?>

</td>


</tr>


<?php } ?>


</table>


</div>

</div>



<td>

<a href="detail_fuzzy.php?id=<?= $h['id_penduduk']; ?>" 
class="btn btn-info btn-sm">

<i class="fa fa-eye"></i>
Detail

</a>

</td>


<!-- DETAIL FUZZY -->


<div class="card shadow mb-4">


<div class="card-header bg-info text-white">


<h5>

2. Tabel Fuzzifikasi dan Derajat Keanggotaan

</h5>


</div>


<div class="card-body table-responsive">



<table class="table table-bordered">


<tr class="table-dark">


<th>No</th>

<th>Nama</th>

<th>Kriteria</th>

<th>Nilai</th>

<th>Kategori</th>

<th>μ Rendah</th>

<th>μ Sedang</th>

<th>μ Tinggi</th>


</tr>


<?php


$no=1;


while($d=mysqli_fetch_assoc($detail)){


?>


<tr>


<td><?= $no++; ?></td>


<td><?= $d['nama']; ?></td>


<td><?= $d['nama_kriteria']; ?></td>


<td><?= $d['nilai']; ?></td>


<td><?= $d['kategori_fuzzy']; ?></td>


<td><?= number_format($d['mu_rendah'],2); ?></td>


<td><?= number_format($d['mu_sedang'],2); ?></td>


<td><?= number_format($d['mu_tinggi'],2); ?></td>


</tr>


<?php } ?>


</table>



</div>


</div>





<!-- TABEL KATEGORI -->


<div class="card shadow mb-4">


<div class="card-header bg-warning">


<h5>

3. Kategori Keputusan

</h5>


</div>


<div class="card-body">


<table class="table table-bordered">


<tr class="table-dark">

<th>Kategori</th>

<th>Range Nilai</th>

<th>Keputusan</th>


</tr>


<tr>

<td>80 - 100</td>

<td>Tinggi</td>

<td>Sangat Layak</td>

</tr>


<tr>

<td>60 - 79</td>

<td>Sedang</td>

<td>Layak</td>

</tr>


<tr>

<td>40 - 59</td>

<td>Rendah</td>

<td>Kurang Layak</td>

</tr>


<tr>

<td>0 - 39</td>

<td>Sangat Rendah</td>

<td>Tidak Layak</td>

</tr>


</table>


</div>


</div>






<!-- GRAFIK -->


<div class="card shadow mb-5">


<div class="card-header bg-dark text-white">


<h5>

4. Grafik Hasil Seleksi

</h5>


</div>


<div class="card-body">


<canvas id="grafik"></canvas>


</div>


</div>



</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


new Chart(document.getElementById('grafik'),{


type:'bar',


data:{


labels:[

'Layak',

'Tidak Layak'

],


datasets:[{

label:'Jumlah Penduduk',

data:[

<?= $_SESSION['jumlah_layak']; ?>,

<?= $_SESSION['jumlah_tidak']; ?>

]

}]


},


options:{


responsive:true


}


});


</script>



<?php

include "../template/footer.php";

include "../template/script.php";

?>