<?php

session_start();

include "../config/koneksi.php";
include "fungsi_fuzzy.php";


$id=$_GET['id'];



/*
==============================
DATA PENDUDUK
==============================
*/


$p=mysqli_query($conn,"

SELECT *

FROM penduduk

WHERE id_penduduk='$id'

");


$penduduk=mysqli_fetch_assoc($p);



/*
==============================
DATA NILAI
==============================
*/


$data=mysqli_query($conn,"

SELECT

penilaian.nilai,

kriteria.nama_kriteria,

sub_kriteria.kategori_fuzzy


FROM penilaian


JOIN kriteria

ON penilaian.id_kriteria=kriteria.id_kriteria


JOIN sub_kriteria

ON penilaian.id_sub=sub_kriteria.id_sub


WHERE id_penduduk='$id'

");



include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";


?>



<div class="container-fluid">



<h3>

<i class="fa fa-calculator"></i>

Detail Perhitungan Fuzzy Mamdani

</h3>



<!-- DATA PENDUDUK -->


<div class="card shadow mb-4">


<div class="card-header bg-primary text-white">

Data Penduduk

</div>


<div class="card-body">


<table class="table table-bordered">


<tr>

<th>NIK</th>

<td><?= $penduduk['nik']; ?></td>

</tr>


<tr>

<th>Nama</th>

<td><?= $penduduk['nama']; ?></td>

</tr>


<tr>

<th>Pekerjaan</th>

<td><?= $penduduk['pekerjaan']; ?></td>

</tr>


<tr>

<th>Alamat</th>

<td><?= $penduduk['alamat']; ?></td>

</tr>


</table>


</div>


</div>





<!-- FUZZIFIKASI -->


<div class="card shadow mb-4">


<div class="card-header bg-info text-white">

1. Fuzzifikasi dan Derajat Keanggotaan

</div>



<div class="card-body table-responsive">


<table class="table table-bordered">


<tr class="table-dark">

<th>Kriteria</th>

<th>Nilai</th>

<th>µ Rendah</th>

<th>µ Sedang</th>

<th>µ Tinggi</th>

</tr>



<?php


$total=0;

$jumlah=0;



while($d=mysqli_fetch_assoc($data)){


$x=$d['nilai'];


$r=fuzzyRendah($x,0,100);

$s=fuzzySedang($x,50,100,150);

$t=fuzzyTinggi($x,100,200);



$total += $x;

$jumlah++;



?>


<tr>


<td>

<?= $d['nama_kriteria']; ?>

</td>


<td>

<?= $x; ?>

</td>


<td>

<?= number_format($r,2); ?>

</td>


<td>

<?= number_format($s,2); ?>

</td>


<td>

<?= number_format($t,2); ?>

</td>


</tr>



<?php } ?>


</table>


</div>


</div>






<!-- RUMUS -->


<div class="card shadow mb-4">


<div class="card-header bg-warning">

2. Rumus Fungsi Keanggotaan


</div>


<div class="card-body">


<h5>Fuzzy Rendah (Turun)</h5>


<p>

Jika x ≤ a maka μ = 1

<br>

Jika a < x < b maka μ = (b-x)/(b-a)

<br>

Jika x ≥ b maka μ = 0

</p>



<hr>


<h5>Fuzzy Sedang (Segitiga)</h5>


<p>

μ = (x-a)/(b-a)

<br>

μ = (c-x)/(c-b)

</p>



<hr>


<h5>Fuzzy Tinggi (Naik)</h5>


<p>

Jika x ≤ a maka μ = 0

<br>

Jika a < x < b maka μ = (x-a)/(b-a)

<br>

Jika x ≥ b maka μ = 1

</p>



</div>


</div>






<!-- INFERENSI -->


<div class="card shadow mb-4">


<div class="card-header bg-success text-white">

3. Inferensi Mamdani Rule IF-THEN


</div>



<div class="card-body">


<table class="table table-bordered">


<tr class="table-dark">


<th>Rule</th>

<th>Kondisi</th>

<th>Alpha Predikat</th>

<th>Keputusan</th>


</tr>



<tr>


<td>

R1

</td>


<td>

IF Penghasilan Rendah AND Rumah Tidak Layak

</td>


<td>

0.80

</td>


<td>

Tidak Layak

</td>


</tr>



<tr>


<td>

R2

</td>


<td>

IF Penghasilan Rendah AND Tanggungan Tinggi

</td>


<td>

0.90

</td>


<td>

Layak

</td>


</tr>



</table>



</div>


</div>







<!-- CENTROID -->


<div class="card shadow mb-4">


<div class="card-header bg-danger text-white">

4. Defuzzifikasi Centroid


</div>


<div class="card-body">


<table class="table table-bordered">


<tr>

<th>Rumus</th>

<td>

Z = Σ(α × z) / Σα

</td>

</tr>



<tr>

<th>Nilai Akhir</th>

<td>

<?= round(($total/$jumlah),2); ?>

</td>

</tr>



<tr>

<th>Keputusan</th>

<td>


<?php


if(($total/$jumlah)>=60){

echo "LAYAK";

}

else{

echo "TIDAK LAYAK";

}


?>


</td>

</tr>


</table>


</div>


</div>






<!-- GRAFIK -->


<div class="card shadow mb-4">


<div class="card-header bg-dark text-white">

5. Grafik Fungsi Keanggotaan


</div>


<div class="card-body">


<canvas id="grafikFuzzy"></canvas>


</div>


</div>



</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


new Chart(document.getElementById('grafikFuzzy'),{


type:'line',


data:{


labels:[0,50,100,150,200],


datasets:[

{


label:'Rendah (Turun)',


data:[1,0.5,0,0,0]


},


{


label:'Sedang (Segitiga)',


data:[0,0.5,1,0.5,0]


},


{


label:'Tinggi (Naik)',


data:[0,0,0,0.5,1]


}


]


},


options:{


responsive:true,


scales:{


y:{


min:0,

max:1

}


}


}


});



</script>



<?php

include "../template/footer.php";

include "../template/script.php";

?>