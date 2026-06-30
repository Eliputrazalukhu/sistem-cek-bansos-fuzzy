<?php

session_start();


if(!isset($_SESSION['nilai'])){

    header("Location:index.php");
    exit;

}


include "../config/koneksi.php";
include "fungsi_fuzzy.php";


$nilai=$_SESSION['nilai'];

$id_penduduk=$_SESSION['id_penduduk'];



/*
=====================================
 DATA PENDUDUK
=====================================
*/

$q=mysqli_query($conn,"

SELECT *

FROM penduduk

WHERE id_penduduk='$id_penduduk'

");


$penduduk=mysqli_fetch_assoc($q);



include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";



$fuzzifikasi=array();



?>


<div class="container-fluid">


<div class="card shadow">


<div class="card-header bg-primary text-white">

<h4>

<i class="fa fa-calculator"></i>

Fuzzifikasi Fuzzy Mamdani

</h4>

</div>


<div class="card-body">



<!-- =====================
TABEL 1 DATA PENDUDUK
===================== -->


<div class="card mb-4">


<div class="card-header bg-dark text-white">

Tabel 1. Data Penduduk

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





<!-- =====================
TABEL 2 NILAI KRITERIA
===================== -->


<h5 class="mt-4">

Tabel 2. Nilai Input Kriteria

</h5>


<table class="table table-bordered table-striped">


<tr class="table-dark">


<th>No</th>

<th>Kriteria</th>

<th>Nilai</th>

<th>Kategori</th>


</tr>



<?php


$no=1;


foreach($nilai as $n){


?>


<tr>


<td><?= $no++; ?></td>


<td><?= $n['nama_kriteria']; ?></td>


<td><?= $n['nilai']; ?></td>


<td><?= $n['kategori_fuzzy']; ?></td>


</tr>


<?php } ?>


</table>







<!-- =====================
TABEL 3 FUZZIFIKASI
===================== -->


<h5>

Tabel 3. Derajat Keanggotaan Fuzzy

</h5>



<table class="table table-bordered">


<tr class="table-success">


<th>No</th>

<th>Kriteria</th>

<th>Nilai</th>

<th>μ Rendah</th>

<th>μ Sedang</th>

<th>μ Tinggi</th>


</tr>



<?php


$no=1;


foreach($nilai as $n){


$x=$n['nilai'];



$r=fuzzyRendah($x,0,100);


$s=fuzzySedang($x,50,100,150);


$t=fuzzyTinggi($x,100,200);



$fuzzifikasi[]=array(

"id_kriteria"=>$n['id_kriteria'],

"nama_kriteria"=>$n['nama_kriteria'],

"nilai"=>$x,

"rendah"=>$r,

"sedang"=>$s,

"tinggi"=>$t


);



?>


<tr>


<td><?= $no++; ?></td>


<td><?= $n['nama_kriteria']; ?></td>


<td><?= $x; ?></td>


<td><?= number_format($r,2); ?></td>


<td><?= number_format($s,2); ?></td>


<td><?= number_format($t,2); ?></td>


</tr>



<?php } ?>



</table>





<?php


$_SESSION['fuzzifikasi']=$fuzzifikasi;


?>






<!-- =====================
TABEL 4 RUMUS
===================== -->


<h5>

Tabel 4. Perhitungan Matematika Fuzzy

</h5>


<table class="table table-bordered">


<tr class="table-warning">


<th>Kriteria</th>

<th>Nilai</th>

<th>Rumus</th>

<th>Hasil</th>


</tr>



<?php


foreach($fuzzifikasi as $f){


?>


<tr>


<td><?= $f['nama_kriteria']; ?></td>


<td><?= $f['nilai']; ?></td>


<td>

μ = (x-a)/(b-a)

</td>


<td>


<?= 

number_format(

max(

$f['rendah'],

$f['sedang'],

$f['tinggi']

)

,2)

?>


</td>


</tr>



<?php } ?>



</table>






<!-- =====================
GRAFIK
===================== -->


<h5>

Tabel 5. Grafik Fungsi Keanggotaan

</h5>


<div class="row">


<div class="col-md-4">


<canvas id="rendah"></canvas>


</div>


<div class="col-md-4">


<canvas id="sedang"></canvas>


</div>


<div class="col-md-4">


<canvas id="tinggi"></canvas>


</div>



</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>



new Chart(document.getElementById('rendah'),{


type:'line',


data:{


labels:[0,25,50,75,100],


datasets:[{

label:'Rendah',

data:[1,.75,.5,.25,0]

}]


}



});





new Chart(document.getElementById('sedang'),{


type:'line',


data:{


labels:[50,75,100,125,150],


datasets:[{

label:'Sedang',

data:[0,.5,1,.5,0]

}]


}



});





new Chart(document.getElementById('tinggi'),{


type:'line',


data:{


labels:[100,125,150,175,200],


datasets:[{

label:'Tinggi',

data:[0,.25,.5,.75,1]

}]


}



});



</script>







<a href="inferensi.php"

class="btn btn-success mt-4">


<i class="fa fa-arrow-right"></i>

Lanjut Inferensi


</a>



</div>


</div>


</div>





<?php

include "../template/footer.php";

include "../template/script.php";


?>